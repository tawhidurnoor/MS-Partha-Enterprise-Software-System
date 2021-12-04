<?php

namespace App\Http\Controllers;

use App\Stock;
use Illuminate\Http\Request;

class SelldetailsController extends Controller
{
    public function store(Request $request)
    {
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
    }
}
