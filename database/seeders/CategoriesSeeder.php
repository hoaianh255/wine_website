<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
    }
}
