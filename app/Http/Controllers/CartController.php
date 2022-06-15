<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
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
      return view('client.cartDetails')->with([
        'discount'=>$discount,
        'total'=>$total
      ]);
    }
    public function parseMoney($money){
      return (float)preg_replace('/[^\d.]/', '',$money);
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
   * @param \Illuminate\Http\Request $request
   * @param int $qty
   * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
   */
    public function store(Request $request, $qty = 1)
    {
      $products = Product::all();
      if (!isset($request->product_id)){
        return response('Not found',404)->header('Content-Type','text/plain');
      }
      $product = $products->find($request->product_id);
      $categories = $product->categories()->get();
      $price = $product->price;
      $codeProduct = $product->codeProduct;
      if($product->discount != 0 || $product->discount != null){
        $price =  $product->discount;
      }
      if (isset($request->qty) && $request->qty != null){
        $qty = (int) $request->qty;
      }

      Cart::add(['id' => $product->id, 'name' => $product->name, 'codeProduct'=>$codeProduct, 'qty' => $qty,
        'price' => $price,'image'=>$product->thumbnail,'categories'=>$categories,'options'=>['size'=>$product->size,
        'vintage'=>$product->vintage,'codeProduct'=>$codeProduct,'bought'=>$product->bought,]])->associate(Product::class);
//      return redirect()->back();
     //DD(Cart::content());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
      Cart::remove($id);
      return redirect()->back();
    }
}
