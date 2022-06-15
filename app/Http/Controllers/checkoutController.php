<?php

namespace App\Http\Controllers;

use App\Mail\PaymentSuccess;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use App\Models\NL_Checkout;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class checkoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {

      $subtotal = $this->parseMoney(Cart::subtotal());
      $discount = session()->get('coupon')['discount'] ?? 0;
      $total = ($subtotal + $this ->parseMoney(Cart::tax())) - $discount;
      if($total < 0){
        $total = 0;
      }
      return view('client.checkout')->with([
        'discount'=>$discount,
        'total'=>$total,
      ]);
    }
     public function parseMoney($money)
     {
       return (float)preg_replace('/[^\d.]/', '', $money);
     }
    



     public function create(Request $request)
     {
      $request->validate([
        'user_name' => 'required | string | max:255',
        'ship_address' => 'required | string | max:255',
        'ship_phone' => 'required|numeric|digits_between:10,11',
        'ship_mail' => 'required|email',
        ],
        [
            'name.required' => 'Mảng :attribute yêu cầu bắt buộc.',
        ]);
        $user_name = $request->input('user_name');
        $ship_address = $request->input('ship_address');
        $ship_mail = $request->input('ship_mail');
        $ship_phone = $request->input('ship_phone');
        $total = $request->input('total');
        $order_id = $request->input('order_id');
        $contentbilling = $request->input('contentbilling');
        session()->put('UserName', $user_name);
        session()->put('AddressShip', $ship_address);
        session()->put('EmailShip', $ship_mail);
        session()->put('PhoneShip', $ship_phone);
        session()->put('ToTal', $total);
        session()->put('Bills', $order_id);
        session()->put('contentbilling', $contentbilling);
         session(['cost_id' => $request->id]);
         session(['url_prev' => url()->previous()]);
         $vnp_TmnCode = "A7ZSUS6G"; //Mã website tại VNPAY 
         $vnp_HashSecret = "O9YI22PK3GNOJE1KKP6OEXW4B1UOKPZM"; //Chuỗi bí mật
         $vnp_Url = "http://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
         $vnp_Returnurl = route('checkout.return');//Return về khi thanh toán thành công < Lấy cái này làm request cho Create Store ORDERS
         $vnp_TxnRef = date("YmdHis"); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
         $vnp_OrderInfo = "Thanh toán hóa đơn sản phẩm";
         $vnp_OrderType = 'billpayment';
         $vnp_Amount = $request->input('amount');
         $vnp_Locale = 'vn';
         $vnp_IpAddr = request()->ip();
 
         $inputData = array(
             "vnp_Version" => "2.0.0",
             "vnp_TmnCode" => $vnp_TmnCode,
             "vnp_Amount" => $vnp_Amount,
             "vnp_Command" => "pay",
             "vnp_CreateDate" => date('YmdHis'),
             "vnp_CurrCode" => "VND",
             "vnp_IpAddr" => $vnp_IpAddr,
             "vnp_Locale" => $vnp_Locale,
             "vnp_OrderInfo" => $vnp_OrderInfo,
             "vnp_OrderType" => $vnp_OrderType,
             "vnp_ReturnUrl" => $vnp_Returnurl,
             "vnp_TxnRef" => $vnp_TxnRef,
         );
 
         if (isset($vnp_BankCode) && $vnp_BankCode != "") {
             $inputData['vnp_BankCode'] = $vnp_BankCode;
         }
         ksort($inputData);
         $query = "";
         $i = 0;
         $hashdata = "";
         foreach ($inputData as $key => $value) {
             if ($i == 1) {
                 $hashdata .= '&' . $key . "=" . $value;
             } else {
                 $hashdata .= $key . "=" . $value;
                 $i = 1;
             }
             $query .= urlencode($key) . "=" . urlencode($value) . '&';
         }
 
         $vnp_Url = $vnp_Url . "?" . $query;
         if (isset($vnp_HashSecret)) {
            // $vnpSecureHash = md5($vnp_HashSecret . $hashdata);
             $vnpSecureHash = hash('sha256', $vnp_HashSecret . $hashdata);
             $vnp_Url .= 'vnp_SecureHashType=SHA256&vnp_SecureHash=' . $vnpSecureHash;
         }



         return redirect($vnp_Url);
     }


     public function return(Request $request)
     {
        $UserName = session()->get('UserName');
        $AddressShip = session()->get('AddressShip');
        $EmailShip = session()->get('EmailShip');
        $PhoneShip = session()->get('PhoneShip');
        $ToTal = session()->get('ToTal');
        $Bills = session()->get('Bills');
        $contentbilling = session()->get('contentbilling');
         //$url = session('url_prev','/checkout/return');
         if($request->vnp_ResponseCode == "00") {
           
            $newDateTime = Carbon::now()->addDays(6);
            $orders = new Order();
            $orders->user_name = $UserName;
            $orders->ship_address = $AddressShip;
            $orders->ship_mail = $EmailShip;
            $orders->ship_phone = $PhoneShip;
            $orders->contentbilling = $contentbilling;
            $orders->status = '0';
            $orders->payment_type = '1';
            $orders->day_buy = date('d/m/Y');
            $orders->day_ship = $newDateTime->format('d/m/Y');
            $orders->total = $ToTal;
            $orders->bill = $Bills;
            $saved = $orders->save();

            $finalArray = array();
            foreach(Cart::content() as $products){
              array_push($finalArray, array(
                'order_id' => $orders->id,
                'product_id' => $products->id,
                'product_code' => $products->options->codeProduct,
                'product_name' => $products->name,
                'price' => $products->price(0,"",""),
                'quantity' => $products->qty,
              ));
              DB::table('products')->where('id', $products->id)->increment('bought',$products->qty);
            }
            
            OrderDetail::insert($finalArray);

            
            // DB::table('products')
            // ->where('id', $products->id)
            // ->increment('bought');
            $user = auth()->user();
            Mail::to($EmailShip)->send(new PaymentSuccess($EmailShip));
            Cart::destroy();
            session()->forget('UserName','AddressShip','EmailShip','PhoneShip','ToTal','Bills','contentbilling');
            return view('client.return')->with('success' ,'Đã thanh toán phí dịch vụ');
         }
         //session()->forget('url_prev');
         return view('client.return')->with('errors' ,'Lỗi trong quá trình thanh toán phí dịch vụ');
     }
    
}
