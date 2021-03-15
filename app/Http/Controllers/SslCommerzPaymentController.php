<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Library\SslCommerz\SslCommerzNotification;
use App\Order;
use App\Repositories\Orders\OrderRepoGenerator;
use App\Exports\OrdersExport;
use App\Notifications\OrderNotification;
use App\Restorant;
use App\Status;
use App\User;
use Carbon\Carbon;
use Cart;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use willvincent\Rateable\Rating;
use App\Services\ConfChanger;
class SslCommerzPaymentController extends Controller
{

    public function exampleEasyCheckout(Order $order)
    {
        return view('exampleEasycheckout',['order'=>$order/*, 'statuses'=>Status::pluck('name', 'id'), 'drivers'=>$drivers*/]);
    }

    public function exampleHostedCheckout()
    {
        return view('exampleHosted');
    }

    public function index(Request $request)
    {
        # Here you have to receive all the order data to initate the payment.
        # Let's say, your oder transaction informations are saving in a table called "orders"
        # In "orders" table, order unique identity is "transaction_id". "status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.

        $post_data = array();
        $post_data['total_amount'] = '10'; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = 'Customer Name';
        $post_data['cus_email'] = 'customer@mail.com';
        $post_data['cus_add1'] = 'Customer Address';
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = '8801XXXXXXXXX';
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Store Test";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";

        #Before  going to initiate the payment order status need to insert or update as Pending.
        $update_product = DB::table('online_payment')
            ->where('transaction_id', $post_data['tran_id'])
            ->updateOrInsert([
                'name' => $post_data['cus_name'],
                'email' => $post_data['cus_email'],
                'phone' => $post_data['cus_phone'],
                'amount' => $post_data['total_amount'],
                'status' => 'Pending',
                'address' => $post_data['cus_add1'],
                'transaction_id' => $post_data['tran_id'],
                'currency' => $post_data['currency']
            ]);

        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'hosted');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }

    }

    public function payViaAjax(Request $request)
    {
       $requestData= (array)json_decode($request->cart_json);

        # Here you have to receive all the order data to initate the payment.
        # Lets your oder trnsaction informations are saving in a table called "orders"
        # In orders table order uniq identity is "transaction_id","status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.

        $post_data = array();
        $post_data['total_amount'] = $requestData['amount'];  # You cant not pay less than 10
//        $post_data['total_amount'] = $requestData['delivery'];  # You cant not pay less than 10
        $post_data['order_id'] = $requestData['id'];  # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique
//
        # CUSTOMER INFORMATION
        $post_data['cus_name'] = 'Rakib';
        $post_data['cus_email'] = 'Customer Name';
        $post_data['cus_add1'] = 'Customer Name';
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = '8801XXXXXXXXX';
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Store Test";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";


        #Before  going to initiate the payment order status need to update as Pending.
        $update_product = DB::table('online_payment')
            ->where('transaction_id', $post_data['tran_id'])
            ->updateOrInsert([
//                'name' => $post_data['cus_name'],
//                'email' => $post_data['cus_email'],
//                'phone' => $post_data['cus_phone'],
                'amount' => $post_data['total_amount'],
                'order_id' => $post_data['order_id'],
                'status' => 'Pending',
//                'address' => $post_data['cus_add1'],
                'transaction_id' => $post_data['tran_id'],
                'currency' => $post_data['currency']
            ]);
        $update_payment_status= DB:: table('orders')
            ->where('id',$post_data['order_id'])
            ->update([
                'payment_method' => 'Online Payment',
                'transaction_id' => $post_data['tran_id']
            ]);

        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'checkout', 'json');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }

    }

    public function success(Request $request)
    {
        //dd($request->all());

        $get_data=array();

        $get_data['tran_id'] = $request->input('tran_id');
        $get_data['amount'] = $request->input('amount');
        $get_data['currency'] = $request->input('currency');
        $get_data['card_type'] = $request->input('card_type');
//        $get_data['status'] = $request->input('status');
        $get_data['card_no'] = $request->input('card_no');
        $get_data['bank_tran_id'] = $request->input('bank_tran_id');
        $get_data['tran_date'] = $request->input('tran_date');
        $get_data['card_issuer'] = $request->input('card_issuer');
        $get_data['card_brand'] = $request->input('card_brand');
        $get_data['card_sub_brand'] = $request->input('card_sub_brand');
        $get_data['card_issuer_country'] = $request->input('card_issuer_country');
        $get_data['card_issuer_country_code'] = $request->input('card_issuer_country_code');
        $get_data['verify_sign'] = $request->input('verify_sign');
        $get_data['currency_rate'] = $request->input('currency_rate');


        $sslc = new SslCommerzNotification();

        #Check order status in order tabel against the transaction id or order id.
        $order_detials = DB::table('online_payment')
            ->where('transaction_id', $get_data['tran_id'])
            ->select('transaction_id', 'status', 'currency', 'amount','card_type', 'status', 'card_no','bank_tran_id','tran_date','card_issuer','card_brand','card_sub_brand','card_issuer_country','verify_sign','currency_rate')->first();

        if ($order_detials->status == 'Pending') {
            $validation = $sslc->orderValidate($request->all(), $get_data['tran_id'], $get_data['amount'], $get_data['currency']);
            if ($validation == TRUE) {
                /*
                That means IPN did not work or IPN URL was not set in your merchant panel. Here you need to update order status
                in order table as Processing or Complete.
                Here you can also sent sms or email for successfull transaction to customer
                */
                $update_product = DB::table('online_payment')
                    ->where('transaction_id', $get_data['tran_id'])
                    ->update(['status' => 'complete',
                    ]);

                $update_payment_status= DB:: table('orders')
                    ->where('transaction_id',$get_data['tran_id'])
                    ->update([
                        'payment_status' => 'Paid'
                    ]);
//             echo "Transaction is successfully Completed on success section middle";
                return view('orders.confirm');
            } else {
                /*
                That means IPN did not work or IPN URL was not set in your merchant panel and Transation validation failed.
                Here you need to update order status as Failed in order table.
                */
                $update_product = DB::table('online_payment')
                    ->where('transaction_id', $get_data['tran_id'])
                    ->update(['status' => 'Failed']);
                echo "validation Fail";
            }
        }
        else if ($order_detials->status == 'processing' || $order_detials->status == 'complete') {
            /*
             That means through IPN Order status already updated. Now you can just show the customer that transaction is completed. No need to udate database.
             */
            $update_product = DB::table('online_payment')
                ->where('transaction_id', $get_data['tran_id'])
                ->update(['status' => 'complete',
                ]);
            $update_payment_status= DB:: table('orders')
                ->where('transaction_id',$get_data['tran_id'])
                ->update([
                    'payment_status' => 'Paid'
                ]);

//            echo "Transaction is successfully Completed on success section";
            return view('orders.confirm');
        }
        else
            {
            #That means something wrong happened. You can redirect customer to your product page.
            echo "Invalid Transaction-success";
            return view('orders.confirm');
        }

    }

    public function fail(Request $request)

    {

        $tran_id = $request->input('tran_id');

        $order_detials = DB::table('online_payment')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_detials->status == 'Pending') {
            $update_product = DB::table('online_payment')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Failed']);

            $update_payment_status= DB:: table('orders')
                ->where('transaction_id',$tran_id)
                ->update([
                    'payment_status' => 'Failed'
                ]);
            echo "Transaction is Falied";
        } else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
            echo "Transaction is already Successful";
        } else {
            echo "Transaction is Invalid";
        }
    }

    public function cancel(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_detials = DB::table('online_payment')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_detials->status == 'Pending') {
            $update_product = DB::table('online_payment')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Canceled']);
            echo "Transaction is Cancel";
        } else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
            echo "Transaction is already Successful";
        } else {
            echo "Transaction is Invalid";
        }


    }

    public function ipn(Request $request)
    {
        $get_data=array();

        $get_data['tran_id'] = $request->input('tran_id');
        $get_data['amount'] = $request->input('amount');
        $get_data['currency'] = $request->input('currency');
        $get_data['card_type'] = $request->input('card_type');
//        $get_data['status'] = $request->input('status');
        $get_data['card_no'] = $request->input('card_no');
        $get_data['bank_tran_id'] = $request->input('bank_tran_id');
        $get_data['tran_date'] = $request->input('tran_date');
        $get_data['card_issuer'] = $request->input('card_issuer');
        $get_data['card_brand'] = $request->input('card_brand');
        $get_data['card_sub_brand'] = $request->input('card_sub_brand');
        $get_data['card_issuer_country'] = $request->input('card_issuer_country');
        $get_data['card_issuer_country_code'] = $request->input('card_issuer_country_code');
        $get_data['verify_sign'] = $request->input('verify_sign');
        $get_data['currency_rate'] = $request->input('currency_rate');
        #Received all the payement information from the gateway
        if ($request->input('tran_id')) #Check transation id is posted or not.
        {

            $tran_id = $request->input('tran_id');

            #Check order status in order tabel against the transaction id or order id.
            $order_details = DB::table('online_payment')
                ->where('transaction_id', $tran_id)
                ->select('transaction_id', 'status', 'currency', 'amount')->first();

            if ($order_details->status == 'Pending') {
                $sslc = new SslCommerzNotification();
                $validation = $sslc->orderValidate($request->all(), $tran_id, $order_details->amount, $order_details->currency);
                if ($validation == TRUE) {
                    /*
                    That means IPN worked. Here you need to update order status
                    in order table as Processing or Complete.
                    Here you can also sent sms or email for successful transaction to customer
                    */
                    $update_product = DB::table('online_payment')
                        ->where('transaction_id', $tran_id)
                        ->update(['status' => 'pending',
                            'card_type' => $get_data['card_type'],
//                            'status' => $get_data['status'],
                            'card_no' => $get_data['card_no'],
                            'bank_tran_id' => $get_data['bank_tran_id'],
                            'tran_date' => $get_data['tran_date'],
                            'card_issuer' => $get_data['card_issuer'],
                            'card_brand' => $get_data['card_brand'],
                            'card_sub_brand' => $get_data['card_sub_brand'],
                            'card_issuer_country' => $get_data['card_issuer_country'],
                            'card_issuer_country_code' => $get_data['card_issuer_country_code'],
                            'verify_sign' => $get_data['verify_sign'],
                            'currency_rate' => $get_data['currency_rate'],
                        ]);

                    echo "Transaction is successfully Completed on ipn section";
                } else {
                    /*
                    That means IPN worked, but Transation validation failed.
                    Here you need to update order status as Failed in order table.
                    */
                    $update_product = DB::table('online_payment')
                        ->where('transaction_id', $tran_id)
                        ->update(['status' => 'Failed']);

                    echo "validation Fail";
                }

            } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {

                #That means Order status already updated. No need to udate database.

                echo "Transaction is already successfully Completed";
            } else {
                #That means something wrong happened. You can redirect customer to your product page.

                echo "Invalid Transaction ipn";
            }
        } else {
            echo "Invalid Data";
        }
    }

}
