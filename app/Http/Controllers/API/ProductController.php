<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\Order;
use App\Detail;
use Illuminate\Support\Str;


class ProductController extends Controller
{
    public function products(Request $request, $slug){
        $category = Category::where('slug', $slug)->firstOrFail();
        $products = Product::where('categories_id', $category->id)->get();
      foreach ($products as $value) {
        $value->photo = Storage::url($value->photo);
      }
       return $products;
    }

    public function productsHome(Request $request){
        
         $products = Product::take(4)->orderBy('id', 'desc')->get();
      foreach ($products as $value) {
        $value->photo = Storage::url($value->photo);
      }
       return $products;
    }

    public function cariProducts(Request $request, $name){
      
       $products = Product::where('name', 'like','%'.$name.'%')->get();
        foreach ($products as $value) {
          $value->photo = Storage::url($value->photo);
        }
       return $products;
    }

    public function order(Request $request){
      $data = $request->all();
      $total = 0;
      foreach ($data['products'] as $value) {
        if ($value['diskon'] > 0) {
          $diskon = ($value['diskon'] / 100) * $value['price'];  
          $harga = $value['price'] - $diskon;
          $total += $harga * $value['qty'];
        }else{
          $total += $value['price'] * $value['qty'];
        }
      }

      $order = Order::create([
        'total_price' => $total,
        'name' => $data['name'],
        'no_tlp' => $data['no_tlp'],
        'kota' => $data['kota'],
        'kecamatan' => $data['kecamatan'],
        'desa' => $data['desa'],
        'detail_alamat' => $data['detail_alamat']
      ]);
      
      foreach ($data['products'] as $val) {
        $detail_order = Detail::create([
          'products_id' => $val['id'],
          'order_id' => $order['id'],
          'qty' => $val['qty']
        ]);
      }

      return response()->json([
          'status' => 'success',
          'data' => $order
      ]);
    }
}
