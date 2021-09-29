<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Notifications\OrderStatusUpdated;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index() {
        $orders = Order::get();

        return view('admin.rendelesek.index')->with([
            'orders' => $orders,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return Application|Factory|View|RedirectResponse
     */
    public function show($id) {
        if ( ! $order = Order::with(['user', 'customer', 'billing.address', 'shipping.address', 'products'])->find($id)) {
            return redirect()->to("/admin/rendelesek")->withErrors(['message' => 'Nem létező rendelés!']);
        }

        return view('admin.rendelesek.mutat')->with('order', $order);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $id
     * @return Application|Factory|View|RedirectResponse
     */
    public function edit($id)
    {
        if ( ! $order = Order::with(['user', 'customer', 'billing.address', 'shipping.address', 'products'])->find($id)) {
            return redirect()->to("/admin/rendelesek")->withErrors(['message' => 'Nem létező rendelés!']);
        }
        if ($order->status == "Lezárt") {
            return redirect()->to("/admin/rendelesek")->withErrors(['message' => 'Lezárt rendelés nem módosítható!']);
        }

        return view('admin.rendelesek.szerkeszt')->with('order', $order);
    }

    /**
     * Update the specified resource.
     *
     * @param Request $request
     * @param  $id
     * @return Application|Factory|View|RedirectResponse
     */
    public function update(Request $request, $id) {
        if ( ! $order = Order::with(['user', 'customer', 'billing.address', 'shipping.address', 'products'])->find($id)) {
            return redirect()->to("/admin/rendelesek")->withErrors(['message' => 'Nem létező rendelés!']);
        }
        if ($order->status == "Lezárt") {
            return redirect()->to("/admin/rendelesek")->withErrors(['message' => 'Lezárt rendelés nem módosítható!']);
        }

        if ($order->status != $request->status) {
            $order->customer->notify(new OrderStatusUpdated($order));
            $order->status = $request->status;
        }

        $order->isPaid = $request->isPaid ?? 1;

        $order->save();

        return redirect()->to('admin/rendelesek')->withSuccess("#" . str_pad($order->id, 6, '0', STR_PAD_LEFT) . ' számú rendelés sikeresen módosítva!');
    }

    /**
     * Update the specified resource.
     *
     * @param Request $request
     * @param  $id
     * @return Application|Factory|View|RedirectResponse
     */
    public function delete($id) {
        if ( ! $order = Order::with(['user', 'customer', 'billing.address', 'shipping.address', 'products'])->find($id)) {
            return redirect()->to("/admin/rendelesek")->withErrors(['message' => 'Nem létező rendelés!']);
        }
        if ($order->status == "Lezárt" || $order->status == "Futárnak átadva") {
            return redirect()->to("/admin/rendelesek")->withErrors(['message' => 'Lezárt vagy futárnak átadott rendelés nem törölhető!']);
        }

        $order->status = "Törölt";

        $order->save();

        return redirect()->to('admin/rendelesek')->withSuccess("#" . str_pad($order->id, 6, '0', STR_PAD_LEFT) . ' számú rendelés sikeresen törölve!');
    }
}
