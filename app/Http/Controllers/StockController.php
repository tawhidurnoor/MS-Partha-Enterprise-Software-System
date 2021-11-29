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
        $previous_day_previous_day_balance = Stock::where('date', '<', $request->date)
            ->where('product_id', $request->product_id)
            ->orderBy('date', 'desc')
            ->value('previous_day_balance');

        $previous_day_receipts = Stock::where('date', '<', $request->date)
            ->where('product_id', $request->product_id)
            ->orderBy('date', 'desc')
            ->value('receipts');

        $previous_day_sell = Stock::where('date', '<', $request->date)
            ->where('product_id', $request->product_id)
            ->orderBy('date', 'desc')
            ->value('sell');

        $previous_day_balance = $previous_day_previous_day_balance + $previous_day_receipts - $previous_day_sell;

        $previous_day = Stock::where('date', '<', $request->date)
            ->where('product_id', $request->product_id)
            ->orderBy('date', 'desc')
            ->value('date');

        if ($previous_day_balance == null) {
            $previous_day_balance = 0;
            $previous_day = date('1111-11-11');
        }

        $stock->previous_day_balance = $previous_day_balance;
        $stock->previous_day = $previous_day;
        $stock->receipts = $request->receipts;
        $stock->sell = 0;
        $stock->balance = $request->receipts + $previous_day_balance; //as no sell is Registered for this record

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
        if ($stock->receipts < $request->receipts) {
            Stock::where('product_id', $stock->product_id)
                ->whereDate('date', '>', $stock->date)
                ->increment('previous_day_balance', $request->receipts - $stock->receipts);
        } else {
            Stock::where('product_id', $stock->product_id)
                ->whereDate('date', '>', $stock->date)
                ->decrement('previous_day_balance', $stock->receipts - $request->receipts);
        }

        $stock->receipts = $request->receipts;

        /*
        //updating previous day
        $next_day = Stock::where('previous_day', $stock->date)->first();

        if ($next_day != '[]' || $next_day != null) {
            $next_day->balance = $next_day->balance - $next_day->previous_day_balance +  $updated_balance;
            $next_day->previous_day_balance = $updated_balance;
            $next_day->save();
        }
        */

        if ($stock->save()) {

            $notification = array(
                'message' => 'Stock Register Updated Successfully.',
                'alert-type' => 'alert-success'
            );
            return redirect()->back()->with($notification);
        } else {

            $notification = array(
                'message' => 'Error Updating Stock Register',
                'alert-type' => 'alert-danger'
            );
            return redirect()->back()->with($notification);
        }
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
