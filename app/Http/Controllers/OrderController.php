<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Http\Requests\RegistrationRequest;
use App\Models\Address;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Order_billing;
use App\Models\Order_shipping;
use App\Models\User;
use App\Notifications\Welcome;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {
            return redirect('/megrendeles/adatok');
        }
        return view('orders.orderas');
    }

    public function showCart()
    {
        return view('orders.cart');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createRegistration()
    {
        return view('orders.order_registration');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeRegistration(RegistrationRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $address = Address::updateOrCreate([
            'city' => $request->billing_city,
            'address' => $request->billing_address,
            'address2' => $request->billing_address2,
            'zip' => $request->billing_zip,
        ]);

        $billing_address = $user->billing_address()->create([
            'choose_company' => $request->choose_company,
            'name' => $request->billing_name,
            'tax_num' => $request->taxnum,
        ]);

        $billing_address->address()->associate($address);

        $billing_address->save();

        $address = Address::updateOrCreate([
            'city' => $request->shipping_city,
            'address' => $request->shipping_address,
            'address2' => $request->shipping_address2,
            'zip' => $request->shipping_zip,
        ]);

        $shipping_address = $user->shipping_address()->create([
            'name' => $request->shipping_name,
            'phone' => $request->phone,
        ]);

        $shipping_address->address()->associate($address);

        $shipping_address->save();

        if ($cart = session()->get('cart')) {
            foreach ($cart as $key => $product) {

                $user->carts()->updateOrCreate(
                    ['product_id' => $key],
                    ['quantity' => DB::raw('quantity + ' . $product['quantity'])]
                );
            }
        }

        $customer = session()->get('customer');
        foreach ($request->all() as $key => $value) {
            $customer[$key] = $value;
        }
        unset($customer["_token"]);
        unset($customer["password"]);
        unset($customer["password_confirmation"]);
        session()->put('customer', $customer);

        $user->notify(new Welcome());
        Auth::login($user);
        event(new Registered($user));

        return redirect('/megrendeles/fizetes-es-szallitas');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createData()
    {
        $user = null;
        if (auth()->check()) {
            $user = User::find(auth()->id());
        }
        return view('orders.order_data')->with([
            'user' => $user,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeData(CustomerRequest $request)
    {
        $customer = session()->get('customer');
        foreach ($request->all() as $key => $value) {
            $customer[$key] = $value;
        }
        unset($customer["_token"]);
        session()->put('customer', $customer);

        return redirect('/megrendeles/fizetes-es-szallitas');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createPaymentAndShipping()
    {
        if (!session('customer')) {
            return redirect('/');
        }
        return view('orders.order_shippingAndPayment');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storePaymentAndShipping(Request $request)
    {
        $customer = session()->get('customer');
        $customer['payment'] = $request->payment;
        $customer['shipping_mode'] = explode("|", $request->shipping)[0];
        $customer['shipping_price'] = explode("|", $request->shipping)[1];

        session()->put('customer', $customer);

        return redirect('/megrendeles/ellenorzes');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createCheckData()
    {
        if (!session('customer')) {
            return redirect('/');
        }

        return view('orders.order_checkData');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeCheckData(Request $request)
    {
        $user = null;
        if (auth()->check()) {
            $user = User::find(auth()->id());

            $cart = [];
                
                foreach ($user->carts()->with(['product', 'product.images', 'product.brand'])->get() as $key => $db_cart) {
                    $cart[$db_cart->product_id] = [
                        'name' => $db_cart->product->name,
                        'slug' => $db_cart->product->slug,
                        'price' => $db_cart->product->price,
                        'image' => $db_cart->product->coverImage()->path,
                        'brand' => $db_cart->product->brand->name,
                        'quantity' => $db_cart->quantity,
                    ];
                }

            $user->carts()->delete();

        } else {
            $cart = session()->pull('cart');
        }

        $cart_total_price = 0;
        foreach ($cart as $key => $product) {
            $cart_total_price += $product['quantity'] * $product['price'];
        }

        $customer = session()->pull('customer');
        $customer['comment'] = $request->comment;

        $db_customer = Customer::updateOrCreate([
            'name' => $customer['name'],
            'email' => $customer['email'],
            'phone' => $customer['phone'],
        ]);

        $address = Address::updateOrCreate([
            'city' => $customer['billing_city'],
            'address' => $customer['billing_address'],
            'address2' => $customer['billing_address2'],
            'zip' => $customer['billing_zip'],
        ]);
        $db_billing = Order_billing::create([
            'name' => $customer['billing_name'],
            'taxnum' => $customer['taxnum'] ?? null,
            'choose_company' => $customer['choose_company'],
        ]);
        $db_billing->address()->associate($address);
        $db_billing->save();

        $address = Address::updateOrCreate([
            'city' => $customer['shipping_city'],
            'address' => $customer['shipping_address'],
            'address2' => $customer['shipping_address2'],
            'zip' => $customer['shipping_zip'],
        ]);
        $db_shipping = Order_shipping::create([
            'name' => $customer['shipping_name'],
        ]);
        $db_shipping->address()->associate($address);
        $db_shipping->save();

        $order = Order::create([
            'payment' => $customer['payment'],
            'shipping_mode' => $customer['shipping_mode'],
            'shipping_price' => $customer['shipping_price'],
            'amount' => $cart_total_price + $customer['shipping_price'],
            'status' => 'Új megrendelés',
            'comment' => $customer['comment'],
        ]);
        foreach ($cart as $key => $product) {
            $order->products()->attach($key, [
                'product_name' => $product['name'],
                'quantity' => $product['quantity'],
                'price' => $product['price'],
            ]);
        }
        $order->user()->associate($user);
        $order->customer()->associate($db_customer);
        $order->billing()->associate($db_billing);
        $order->shipping()->associate($db_shipping);
        $order->save();

        session()->put('order', $order->id);

        return redirect('/megrendeles/elkuldve');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        if (!session('order')) {
            return redirect('/');
        }

        $order = Order::find(session()->get('order'));

        return view('orders.order_finish')->with('order', $order);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
