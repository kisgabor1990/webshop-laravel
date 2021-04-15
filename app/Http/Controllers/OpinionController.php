<?php

namespace App\Http\Controllers;

use App\Models\Opinion;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;

class OpinionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $model = new Product();
        $product = $model->getProduct($id);

        $user  = User::find(auth()->user()->id);
        $user->rate($product, $request->stars);

        $opinion = [
            'user_id' => $user->id,
            'product_id' => $product->id,
            'rate' => $request->stars,
            'comment' => $request->opinion
        ];

        Opinion::create($opinion);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Opinion  $opinion
     * @return \Illuminate\Http\Response
     */
    public function show(Opinion $opinion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Opinion  $opinion
     * @return \Illuminate\Http\Response
     */
    public function edit(Opinion $opinion, $id)
    {
        $model = new Product();
        $product = $model->getProduct($id);
        $user  = User::find(auth()->user()->id);
        $myOpinion = $opinion->getOpinion($product->id, $user->id);

        if (!session()->has('url.intended')) {
            session(['url.intended' => url()->previous()]);
        }

        return view('products.editOpinion')->with([
            'product' => $product,
            'myOpinion' => $myOpinion
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Opinion  $opinion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Opinion $opinion, $id)
    {
        $model = new Product();
        $product = $model->getProduct($id);
        
        $opinion->updateOpinion($product, $request->stars, $request->opinion);

        return redirect()->intended();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Opinion  $opinion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Opinion $opinion, $id)
    {
        $model = new Product();
        $product = $model->getProduct($id);

        $opinion->destroyOpinion($product);

        return redirect()->back();
    }
}
