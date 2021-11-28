<?php

namespace App\Http\Controllers;

use App\Product;
use App\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stocks = Stock::join('products', 'stocks.product_id', 'products.id')
            ->selectRaw('stocks.*, products.product_name as product_name')
            ->orderBy('stocks.date', 'desc')
            ->get();

        $products = Product::all();
        return view('Stock.index', [
            'stocks' => $stocks,
            'products' => $products,
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
        //checking duplicate entry
        $duplicate_stock_checker = Stock::where('date', $request->date)
            ->where('product_id', $request->product_id)
            ->count();
        if ($duplicate_stock_checker > 0) {
            $notification = array(
                'message' => 'Stock is already registered for this input.',
                'alert-type' => 'alert-warning'
            );
            return redirect()->back()->with($notification);
        }

        $stock = new Stock();
        $stock->date = $request->date;
        $stock->product_id = $request->product_id;
        //getting previous day
        $previous_day_balance = Stock::where('date', '<', $request->date)
            ->where('product_id', $request->product_id)
            ->orderBy('date', 'desc')
            ->value('balance');

        $stock->receipts = $request->receipts + $previous_day_balance;
        $stock->sell = 0;
        $stock->balance = $stock->receipts; //as no sell is Registered for this record

        if ($stock->save()) {

            $notification = array(
                'message' => 'Stock registered Successfully.',
                'alert-type' => 'alert-success'
            );
            return redirect()->back()->with($notification);
        } else {

            $notification = array(
                'message' => 'Error Registering Stock',
                'alert-type' => 'alert-danger'
            );
            return redirect()->back()->with($notification);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function show(Stock $stock)
    {
        return $stock;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function edit(Stock $stock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stock $stock)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stock $stock)
    {
        //
    }
}
