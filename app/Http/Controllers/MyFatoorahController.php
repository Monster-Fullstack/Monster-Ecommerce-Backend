<?php

namespace App\Http\Controllers;

use App\Models\User;
use AymanElmalah\MyFatoorah\Facades\MyFatoorah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MyFatoorahController extends Controller
{
    public function index(Request $request)
    {
        // the user
        $user = Auth::user();
        // the data send to myfatoora
        $data = [
            'CustomerName' => $user->name,
            'NotificationOption' => 'all',
            'MobileCountryCode' => $user->phone_country,
            'CustomerMobile' => str_replace(' ', '', $user->phone_number),
            'DisplayCurrencyIso' => 'USD',
            'CustomerEmail' => $user->email,
            'InvoiceValue' => $request->price,
            'Language' => 'en',
            'CallBackUrl' => env("CallBackURL"),
            'ErrorUrl' => env('ErrorURL'),
        ];

        // And this one if you need to access token from config
        $myfatoorah = MyFatoorah::createInvoice($data);

        // add the InvoiceId to the transaction table
        DB::table("transaction")->insert([
            "InvoiceId" => $myfatoorah["Data"]["InvoiceId"],
            "user_id" => $user->id,
        ]);

        // when you got a response from myFatoorah API, you can redirect the user to the myfatoorah portal
        return response()->json($myfatoorah);
    }

    public function callback(Request $request)
    {
        $myfatoorah = MyFatoorah::payment($request->paymentId);

        // It will check that payment is success or not
        // return response()->json($myfatoorah->isSuccess());

        // It will return payment response with all data
        if (response()->json($myfatoorah->isSuccess())) {
            $myfatoorahData = $myfatoorah->get();
            // get the user id by the email
            $id = User::where("email", $myfatoorahData["Data"]["CustomerEmail"])->value("id");
            $InvoiceId = $myfatoorahData["Data"]["InvoiceId"];
            $payment = DB::table("transaction")->where("InvoiceId", $InvoiceId)->first();
            if ($payment) {
                DB::table("transaction")->where("InvoiceId", $InvoiceId)->update([
                    "status" => 1,
                ]);

                $allProductsInCart = DB::table("product_user")->where("user_id", $id)->get();

                foreach ($allProductsInCart as $product) {
                    DB::table("orders")->insert([
                        "user_id" => $id,
                        "product_id" => $product->id,
                        "total" => $product->total,
                        "color" => $product->color,
                        "quantity" => $product->quantity,
                    ]);
                }

                // delete all the products inside the cart
                DB::table("product_user")->where("user_id", $id)->delete();

                header("Location: http://localhost:3000/orders");
                exit();
            }
        }

        // Show error actions
        header("Location: http://localhost:3000/cart/error");
        exit();
    }

    public function error(Request $request)
    {
        // Show error actions
        header("Location: http://localhost:3000/cart/error");
        exit();
    }
}
