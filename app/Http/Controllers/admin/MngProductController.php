<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\LanguageSwitch;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class MngProductController extends Controller
{
    public function index(Product $product)
    {
      $products = Product::
      orderBy('created_at','desc')->paginate(12);
      // $products =  Product::join('language_switches', function ($join) {
      //   $join->on('language_id', '=', 'language_switches.id')
      //     ->where('language_switches.slug', '=', App()->getLocale());
      // })->select('products.*')->orderBy('created_at','desc')->paginate(12);
      return view('admin.product.index')->with(["product"=>$product,"products"=>$products]);
    }
    public function orderPro($order)
    {
      if($order === "old"){
        $products = Product::paginate(12);
        $old = "selected";
        return view('admin.product.index',compact('products','old'));
      }
        $new = "selected";
        $products = Product::orderBy('created_at','desc')->paginate(12);
        return view('admin.product.index',compact('products','new'));
    }
    public function search(Request $request){
      $products = Product::
      where('name','like','%'.$request->name.'%')
      ->paginate(12);
      return view('admin.product.index')->with(["products"=>$products]);
    }

    public function create()
    {

      $categories = Category::where('type','=','0')->get();
      $languages = LanguageSwitch::all();
      $Tag = Tag::select('tags.*')->where('primary', '1')->get();
      return view('admin.product.create')->with(['categories'=>$categories,'languages'=>$languages,'Tag'=>$Tag]);
    }

    public function store(Request $request)
    {
      $request->validate([
          'name' => 'required | string | max:255',
          'codePro' => 'required| string',
          'price' => 'required | integer',
          'size' => 'required | string | max:255',
          'vintage' => 'required | string | max:255',
          'detail' => 'max:255',
          'discount' => 'required | integer',
          'nation' => 'required | string | max:255',
          'amount' => 'required | integer',
          'thumbnail' => 'image|max:2048',
      ],
      [
          'name.required' => 'M???ng :attribute y??u c???u b???t bu???c.',
          'name.unique'=>'T??n s???n ph???m ???? t???n t???i',
          'codePro.required' => 'M???ng :attribute y??u c???u b???t bu???c.',
          'codePro.unique'=>'M?? s???n ph???m b??? tr??ng',
          'price.required' => 'M???ng :attribute y??u c???u b???t bu???c.',
          'price.integer' => 'M???ng :attribute y??u c??u s??? nguy??n.',

          'size.required' => 'M???ng :attribute y??u c???u b???t bu???c.',

          'vintage.required' => 'M???ng :attribute y??u c???u b???t bu???c.',

          'detail.required' => 'M???ng :attribute y??u c???u b???t bu???c.',

          'discount.required' => 'M???ng :attribute y??u c???u b???t bu???c.',
          'discount.integer' => 'M???ng :attribute y??u c??u s??? nguy??n.',

          'nation.required' => 'M???ng :attribute y??u c???u b???t bu???c.',

          'description.required' => 'M???ng :attribute y??u c???u b???t bu???c.',

          'amount.required' => 'M???ng :attribute y??u c???u b???t bu???c.',
          'amount.integer' => 'M???ng :attribute y??u c??u s??? nguy??n.',

          'thumbnail.image' => 'M???ng :attribute y??u c???u l?? h??nh ???nh.',
          'thumbnail.max' => 'M???ng :attribute v?????t qu?? m???c b??ng th??ng cho ph??p (2048).',
      ]);
      $user_id = Auth()->user()->id;
      $product = new Product;
      $product->user_id = $user_id;
      $product->codeProduct = $request->codePro;
      $product->name = $request->name;
      $product->slug = str_slug($request->name);
      if( $request->hasFile('thumbnail')){
        $name = $product->id.$request->thumbnail->getClientOriginalName();
        $path = $request->thumbnail->storeAs('product_images',$name,'public');
        $product->thumbnail  = $path;
      }
      $product->price = $request->price;
      $product->size = $request->size;
      $product->vintage = $request->vintage;
      $product->detail = $request->detail;
      $product->discount = $request->discount;
      $product->nation = $request->nation;
      $product->description = $request->description;
      $product->language_id  = $request->language_id;
      $product->is_published  = $request->is_published;
      $product->especially  = $request->especially;
      $product->amount = $request->amount;
      $saved = $product->save();
      if(isset($request->categories) && $saved === true){
        $product->categories()->sync($request->categories);
      }
      if($saved === false){ //ERRORS < HERE
        Storage::delete($name);
      };
      session()->flash('success', 'Th??m th??nh c??ng');

      return redirect()->route('MngProduct.index');
    }

    public function edit(Product $id)
    {
      $categories = [];
      $CategoryCheckeds = $id->categories()->get();
      $AllCategory = Category::where('type','0')->get();
      foreach ($AllCategory as $Category){
        $Category['checked'] = false;
        foreach ($CategoryCheckeds as $CategoryChecked){
          if ($Category['slug'] === $CategoryChecked->slug){
            $Category['checked'] = true;
          }
        }
          $categories[] = $Category;
      }
      return view('admin.product.edit')->with(['product'=>$id,'categories'=>$categories]);
    }

    public function update(Request $request,$id)
    {
      $request->validate([
        'thumbnail' => 'image|max:2048',
      ],
      [
        'thumbnail.image' => 'M???ng :attribute y??u c???u l?? h??nh ???nh.',

        'thumbnail.max' => 'M???ng :attribute v?????t qu?? m???c b??ng th??ng cho ph??p (2048).',
      ]);
      $product = Product::find($id);
      $user_id = Auth()->user()->id;
      if($user_id != false){
        $product->user_id = $user_id;
      }
      if(isset($request->name)){
        $product->name = $request->name;
        $product->slug = str_slug($request->name);
      }
      if(isset($request->codeProduct)){
        $product->codeProduct = $request->codeProduct;
      }
      if(isset($request->size)){
        $product->size = $request->size;
      }
      if(isset($request->vintage)){
        $product->vintage = $request->vintage;
      }
      if(isset($request->detail)){
        $product->detail = $request->detail;
      }
      if( $request->hasFile('thumbnail')){
        $name = $product->id.$request->thumbnail->getClientOriginalName();
        $path = $request->thumbnail->storeAs('product_images',$name,'public');
        $product->thumbnail  = $path;
      }
      if(isset($request->price)){
        $product->price = $request->price;
      }
      if(isset($request->discount)){
        $product->discount = $request->discount;
      }
      if(isset($request->description)){
        $product->description = $request->description;
      }
      if(isset($request->nation)){
        $product->nation = $request->nation;
      }
      if(isset($request->amount)){
        $product->amount = $request->amount;
      }
      if(isset($request->is_published)){
        $product->is_published = $request->is_published;
      }
      if(isset($request->especially)){
        $product->especially = $request->especially;
      }
      if(isset($request->language_id)){
        $product->language_id = $request->language_id;
      }
      $saved = $product->save();
      /* L???i ??? ????y */
      if(isset($request->categories) && $saved === true){
        $product->categories()->sync($request->categories);
      }

      /* END L???i ??? ????y */
      if($saved === false){
        Storage::delete($name);

      };
      session()->flash('message','success');
      return redirect()->route('MngProduct.index');
    }

    public function destroy(Product $id)
    {
      $id->delete();
      session()->flash('message', 'X??a Ng?????i d??ng th??nh c??ng');
      return redirect()->back();
    }

    public function deleteAll(Request $request) {
      $productId = explode(',',$request->productId[0]);
      $deleted = Product::whereIn('id',$productId)->delete();
      if($deleted) {
        return redirect()->back()->with('message', 'Da xoa thanh cong');
      }
      return redirect()->back()->with('message', 'Xoa khong thanh cong');
    }


}
