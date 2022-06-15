<?php

namespace App\Mail;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaymentSuccess extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function parseMoney($money){
        return (float)preg_replace('/[^\d.]/', '',$money);
    }
    public function build(Product $product)
    {
        $subtotal = $this->parseMoney(Cart::subtotal());
        $discount = session()->get('coupon')['discount'] ?? 0;
        $total = ($subtotal + $this ->parseMoney(Cart::tax())) - $discount;
        if($total < 0){
            $total = 0;
        }

        $idRelation = [];
        $arrProRel = $product->productRelation()->get();
        foreach ($arrProRel as $id){
            $idRelation[] = $id->product_relation_id;
        }
        $productRelations = Product::whereIn('id',$idRelation)->limit('3')->get();
        
        return $this->view('emails.PaymentSuccess')->with([
            'product'=>$product,'productRelations'=>$productRelations,
            'discount'=>$discount,
            'total'=>$total
        ]);
    }
}
