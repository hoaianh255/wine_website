<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Table;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      \App\Models\User::factory(20)->create();
      DB::table('language_switches')->insert([
             [
                 'name'=>'Việt Nam',
                 'slug'=>'vn',
                 'created_at'=>now(),
                 'updated_at'=>now()
             ],
             [
                 'name'=>'English',
                 'slug'=>'en',
                 'created_at'=>now(),
                 'updated_at'=>now()
             ],
         ]);
      DB::table('categories')->insert([
        [
          'user_id'=>20,
          'name'=>'rượu vang đỏ',
          'slug'=>'ruou_vang_do',
          'type'=>'0',
          'is_published'=>'1',
          'language_id'=>'1',
          'order'=>null,
          'created_at'=>Carbon::now(),
          'updated_at'=>Carbon::now()
        ],
        [
          'user_id'=>20,
          'name'=>'rượu vang hồng',
          'slug'=>'ruu_vang_hong',
          'type'=>'0',
          'is_published'=>'1',
          'language_id'=>'1',
          'order'=>null,
          'created_at'=>Carbon::now(),
          'updated_at'=>Carbon::now()
        ],
        [
          'user_id'=>20,
          'name'=>'Rượu vang sủi',
          'slug'=>'ruou_vang_sui',
          'type'=>'0',
          'is_published'=>'1',
          'language_id'=>'1',
          'order'=>null,
          'created_at'=>Carbon::now(),
          'updated_at'=>Carbon::now()
        ],
        [
          'user_id'=>20,
          'name'=>'Rượu trắng',
          'slug'=>'ruou_trang',
          'type'=>'0',
          'is_published'=>'1',
          'language_id'=>'1',
          'order'=>null,
          'created_at'=>Carbon::now(),
          'updated_at'=>Carbon::now()
        ],
        [
          'user_id'=>20,
          'name'=>'red wines',
          'slug'=>'red_wines',
          'type'=>'0',
          'is_published'=>'1',
          'language_id'=>'2',
          'order'=>null,
          'created_at'=>Carbon::now(),
          'updated_at'=>Carbon::now()
        ],
        [
          'user_id'=>20,
          'name'=>'rose wines',
          'slug'=>'rose_wines',
          'type'=>'0',
          'is_published'=>'1',
          'language_id'=>'2',
          'order'=>null,
          'created_at'=>Carbon::now(),
          'updated_at'=>Carbon::now()
        ],
        [
          'user_id'=>20,
          'name'=>'Sparkling',
          'slug'=>'sparkling',
          'type'=>'0',
          'is_published'=>'1',
          'language_id'=>'2',
          'order'=>null,
          'created_at'=>Carbon::now(),
          'updated_at'=>Carbon::now()
        ],
        [
          'user_id'=>20,
          'name'=>'White wines',
          'slug'=>'white_wines',
          'type'=>'0',
          'is_published'=>'1',
          'language_id'=>'2',
          'order'=>null,
          'created_at'=>Carbon::now(),
          'updated_at'=>Carbon::now()
        ],
        [
          'user_id'=>20,
          'name'=>'Kết hợp thực phẩm',
          'slug'=>'ket_hop_thuc_pham',
          'type'=>'1',
          'is_published'=>'1',
          'language_id'=>'1',
          'order'=>null,
          'created_at'=>Carbon::now(),
          'updated_at'=>Carbon::now()
        ],
        [
          'user_id'=>20,
          'name'=>'người sản xuất',
          'slug'=>'nguoi_san_xuat',
          'type'=>'1',
          'is_published'=>'1',
          'language_id'=>'1',
          'order'=>null,
          'created_at'=>Carbon::now(),
          'updated_at'=>Carbon::now()
        ],
        [
          'user_id'=>20,
          'name'=>'vùng rượu vang',
          'slug'=>'vung_ruou_vang',
          'type'=>'1',
          'is_published'=>'1',
          'language_id'=>'1',
          'order'=>null,
          'created_at'=>Carbon::now(),
          'updated_at'=>Carbon::now()
        ],
        [
          'user_id'=>20,
          'name'=>'Food pairings',
          'slug'=>'food_pairings',
          'type'=>'1',
          'is_published'=>'1',
          'language_id'=>'2',
          'order'=>null,
          'created_at'=>Carbon::now(),
          'updated_at'=>Carbon::now()
        ],
        [
          'user_id'=>20,
          'name'=>'Producers',
          'slug'=>'producers',
          'type'=>'1',
          'is_published'=>'1',
          'language_id'=>'2',
          'order'=>null,
          'created_at'=>Carbon::now(),
          'updated_at'=>Carbon::now()
        ],
        [
          'user_id'=>20,
          'name'=>'Wine regions',
          'slug'=>'wine_regions',
          'type'=>'1',
          'is_published'=>'1',
          'language_id'=>'2',
          'order'=>null,
          'created_at'=>Carbon::now(),
          'updated_at'=>Carbon::now()
        ],
      ]);
      DB::table('info_sites')->insert([
        'fan_page'=>null,
        'email'=>'wineteam@gmail.com',
        'phone'=>'0983454248',
        'address'=>'Công viên phần mềm, Toà nhà Innovation lô 24, Quang Trung, Quận 12, Thành phố Hồ Chí Minh, Việt Nam',
        'created_at'=>now(),
        'updated_at'=>now()
      ]);
      DB::table('roles')->insert([
        [
          'name'=>'Manager all',
          'slug'=>'manager_all',
          'created_at'=>now(),
          'updated_at'=>now()
        ],
        [
          'name'=>'Manager categories',
          'slug'=>'manager_categories',
          'created_at'=>now(),
          'updated_at'=>now()
        ],
        [
          'name'=>'Manager Users',
          'slug'=>'manager_users',
          'created_at'=>now(),
          'updated_at'=>now()
        ],
        [
          'name'=>'Manager products',
          'slug'=>'manager_products',
          'created_at'=>now(),
          'updated_at'=>now()
        ],
        [
          'name'=>'Manager coupons',
          'slug'=>'manager_coupons',
          'created_at'=>now(),
          'updated_at'=>now()
        ],
        [
          'name'=>'Manager blogs',
          'slug'=>'manager_blogs',
          'created_at'=>now(),
          'updated_at'=>now()
        ],
        [
          'name'=>'Manager orders',
          'slug'=>'manager_orders',
          'created_at'=>now(),
          'updated_at'=>now()
        ],

      ]);
      \App\Models\Product::factory(110)->create();
      \App\Models\Blog::factory(110)->create();
      \App\Models\Tag::factory(150)->create();
      \App\Models\CategoryProduct::factory(200)->create();
      \App\Models\CategoryBlog::factory(200)->create();

    }
}
