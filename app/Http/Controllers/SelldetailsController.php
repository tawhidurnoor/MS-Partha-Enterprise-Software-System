<?php

namespace App\Http\Controllers;

use App\Sell;
use App\Selldetail;
use App\Stock;
use Illuminate\Http\Request;

class SelldetailsController extends Controller
{
    public function store(Request $request)
    {
        $saveAlert = 0;
        $message = '';

        $sell_id = $request->sell_id;
        $date = $request->date;
        $product_id = $request->product_id;
        $unit_price = $request->unit_price;
        $total_unit = $request->total_unit;
        $is_chceked = $request->is_chceked;

        for ($i = 0; $i < count($sell_id); $i++) {

            if ($is_chceked[$i] == 'no') {
                //if no is selected
                continue;
            } elseif ($unit_price[$i] == 0 || $total_unit[$i] == 0) {
                //if any of input values are zero
                $message .= 'Some product coud not be added because of invalid input. ';
                continue;
            } else {
                //all exceptions are checked

                //stock checking
                $stock_counter = Stock::where('date', $date[$i])
                    ->where('product_id', $product_id[$i])
                    ->count();

                if ($stock_counter == 0) {
                    $message .= 'Some product coud not be added because the stock is not opened. ';
                    continue;
                }

                //stock sufficincy checking
                $stock_checker = Stock::first();

                if (($stock_checker->receipts - $stock_checker->sell) < $total_unit[$i]) {
                    $message .= 'Some product coud not be added because of insufficient stock. ';
                    continue;
                }


                $counting_duplicate_sell = Selldetail::where('sell_id', $sell_id[$i])
                    ->where('product_id',  $product_id[$i])
                    ->count();

                if ($counting_duplicate_sell > 0) {
                    $message .= 'Product is already in sell register. ';
                    continue;
                }

                //sell registering
                //$sell = new Selldetail();
                $dataSave = [
                    'sell_id' => $sell_id[$i],
                    'date' => $date[$i],
                    'product_id' => $product_id[$i],
                    'unit_price' => $unit_price[$i],
                    'total_unit' => $total_unit[$i],
                ];

                $selldetailsSave = Selldetail::insert($dataSave);
                /*
                $sell->sell_id = $request->sell_id;
                $sell->date = $request->date;
                $sell->product_id = $request->product_id;
                $sell->unit_price = $request->unit_price;
                $sell->total_unit = $request->total_unit;
                */

                Stock::where('date', $date[$i])
                    ->where('product_id', $product_id[$i])
                    ->increment('sell', $total_unit[$i]);

                //updating total in sell
                Sell::where('id', $sell_id[$i])
                    ->increment('total', $total_unit[$i] * $unit_price[$i]);



                if (!$selldetailsSave) {

                    $saveAlert++;
                }
            }
        }


        if ($saveAlert == 0) {
            $notification = array(
                'message' => 'Sell Register Updated Successfully. ' . $message,
                'alert-type' => 'alert-success'
            );
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Error Updating Sell Register.',
                'alert-type' => 'alert-success'
            );
            return redirect()->back()->with($notification);
        }
    }

    public function show(Selldetail $selldetail)
    {
        return $selldetail;
    }

    public function update(Request $request, Selldetail $selldetail)
    {
        return $selldetail;
    }
}
