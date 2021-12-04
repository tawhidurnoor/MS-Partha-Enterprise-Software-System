<?php

namespace App\Http\Controllers;

use App\Selldetail;
use App\Stock;
use Illuminate\Http\Request;

class SelldetailsController extends Controller
{
    public function store(Request $request)
    {
        //stock checking
        $stock_counter = Stock::where('date', $request->date)
            ->where('product_id', $request->product_id)
            ->count();

        if ($stock_counter == 0) {
            $notification = array(
                'message' => 'Stock is not opened for ' . $request->date . ' yet.',
                'alert-type' => 'alert-warning'
            );
            return redirect()->back()->with($notification);
        }

        //stock sufficincy checking
        $stock_checker = Stock::first();

        if (($stock_checker->receipts - $stock_checker->sell) < $request->total_unit) {
            $notification = array(
                'message' => 'Insufficient ammount of product',
                'alert-type' => 'alert-warning'
            );
            return redirect()->back()->with($notification);
        }

        //sell registering
        $sell = new Selldetail();
        $sell->sell_id = $request->sell_id;
        $sell->date = $request->date;
        $sell->product_id = $request->product_id;
        $sell->unit_price = $request->unit_price;
        $sell->total_unit = $request->total_unit;

        Stock::where('date', $request->date)
            ->where('product_id', $request->product_id)
            ->increment('sell', $request->total_unit);

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
}
