<?php

namespace App\Http\Controllers;

use App\Client;
use App\Product;
use App\Sell;
use App\Selldetail;
use Illuminate\Http\Request;

class SellController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sells = Sell::join('clients', 'sells.client_id', 'clients.id')
            ->selectRaw('sells.*, clients.client_name as client_name')
            ->get();
        $clients = Client::all();
        return view('Sell.index', [
            'sells' => $sells,
            'clients' => $clients,
        ]);
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
    public function store(Request $request)
    {
        $sell = new Sell();
        $sell->client_id = $request->client_id;
        $sell->total = 0;
        $sell->received = 0;

        if ($sell->save()) {

            $notification = array(
                'message' => 'Sell registered Successfully.',
                'alert-type' => 'alert-success'
            );
            return redirect()->back()->with($notification);
        } else {

            $notification = array(
                'message' => 'Error Registering Sell',
                'alert-type' => 'alert-danger'
            );
            return redirect()->back()->with($notification);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sell  $sell
     * @return \Illuminate\Http\Response
     */
    public function show(Sell $sell)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sell  $sell
     * @return \Illuminate\Http\Response
     */
    public function edit(Sell $sell)
    {
        $client = Client::findOrFail($sell->client_id);
        $clients =  Client::all();
        $selldetails = Selldetail::where('sell_id', $sell->id)
            ->join('products', 'selldetails.product_id', 'products.id')
            ->selectRaw('selldetails.*, products.product_name as product_name')
            ->get();
        $products = Product::all();
        return view('Sell.edit', [
            'client' => $client,
            'clients' => $clients,
            'sell' => $sell,
            'selldetails' => $selldetails,
            'products' => $products,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sell  $sell
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sell $sell)
    {
        $sell->client_id = $request->client_id;

        if ($sell->save()) {

            $notification = array(
                'message' => 'Sell Register Updated Successfully.',
                'alert-type' => 'alert-success'
            );
            return redirect()->back()->with($notification);
        } else {

            $notification = array(
                'message' => 'Error Updating Sell Register',
                'alert-type' => 'alert-danger'
            );
            return redirect()->back()->with($notification);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sell  $sell
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sell $sell)
    {
        //
    }
}
