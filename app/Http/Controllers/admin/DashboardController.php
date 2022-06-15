<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Comments;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Egulias\EmailValidator\Warning\Comment;

class DashboardController extends Controller
{
    public function index(){
        $products =  Product::all();$users = User::all();$blogs = Blog::all();$categories = Category::all();$orders = Order::all();$comments = Comments::all();
        $productsCount = $products->count();$usersCount = $users->count();$blogsCount = $blogs->count();$categoriesCount = $categories->count();
        $ordersCount = $orders->count();$reviewsCount = $comments->count();

        $blogViews = Blog::select('blogs.*')->where('is_published', '1')->orderBy('view', 'desc')->get();

        return view('admin.dashboard.index')->with
        ([
            "products"=>$products,"users"=>$users,"blogs"=>$blogs,"categories"=>$categories,"blogViews"=>$blogViews,
            'productsCount'=>$productsCount,"usersCount"=>$usersCount,"blogsCount"=>$blogsCount,"categoriesCount"=>$categoriesCount,
            'orders'=>$orders,'ordersCount'=>$ordersCount,'reviewsCount'=>$reviewsCount
        ]);
    }
}
