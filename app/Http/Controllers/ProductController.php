<?php

namespace App\Http\Controllers;

use App\Models\Product as ModelsProduct;
use App\Models\Category as ModelsCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as RootController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon as CarbonCarbon;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Database\Eloquent\Model;

class ProductController extends Controller
{
    public function add_product()
    {
        # code...
        (new RootController)->AuthLogin();
        $all_category = ModelsCategory::orderBy('Category_id')->get();
        return view('admin.add_product')->with('category', $all_category);
    }
    public function all_product()
    {
        (new RootController)->AuthLogin();
        # code...
        // $all_category = DB::table('tbl_category')->get();
        $all_product =  ModelsProduct::join('tbl_category', 'tbl_category.category_id', '=', 'tbl_product.category_id')
            ->orderBy('product_id')
            ->paginate(10);

        // $manager_product = view('admin.all_product')->with('all_product', $all_product);
        // return view('admin_layout')->with('all_product', $manager_product);
        return view('admin.all_product')->with('all_product',$all_product);

    }
    public function save_product(Request $request)
    {
        # code...

        (new RootController)->AuthLogin();
        $data = $request->all();

        $product = new ModelsProduct();
        $product->product_name = $data['product_name'];
        $product->category_id = $data['category_id'];
        $product->product_desc = $data['product_desc'];
        $product->product_status = $data['product_status'];
        $product->product_price = $data['product_price'];
        $product->product_quantity = $data['product_quantity'];
        
        $product->created_at = CarbonCarbon::now();
        $get_image = $request->file('product_image');
        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/products', $new_image);
            $product->product_image = $new_image;
            $product->save();
            Session::put('message', 'Thêm thành công!');
            return Redirect::to('all-product');
        }
        $product->product_image = '';
        Session::put('message', 'Thêm thành công!');
        $product->save();
        return Redirect::to('all-product');
    }
    public function unactive_product($product_id)
    {
        (new RootController)->AuthLogin();
        # code...
        $product = ModelsProduct::find($product_id);
        $product->product_status = 0;
        $product->save();
        Session::put('message', 'Hủy kích hoạt thành công!');
        return Redirect::to('all-product');
    }

    public function active_product($product_id)
    {
        (new RootController)->AuthLogin();
        # code...
        // DB::table('tbl_category')->where('category_id',$product_id)->update(['category_status'=> 1]);
        $product = ModelsProduct::find($product_id);
        $product->product_status = 1;
        $product->save();
        Session::put('message', 'Kích hoạt thành công!');
        return Redirect::to('all-product');
    }
    public function edit_product($product_id)
    {
        (new RootController)->AuthLogin();
        // $edit_category = DB::table('tbl_category')->where('category_id',$category_id)->get();
        $edit_product = ModelsProduct::find($product_id);
        $category = ModelsCategory::all();
        $manager_product = view('admin.edit_product')->with('edit_product', $edit_product)->with('category', $category);
        return view('admin_layout')->with('admin.edit_product', $manager_product)->with('edit_product', $edit_product);
    }
    public function update_product($product_id, Request $request)
    {
        (new RootController)->AuthLogin();
        # code...
        $data = $request->all();

        $product = ModelsProduct::find($product_id);
        $product->product_name = $data['product_name'];
        $product->category_id = $data['category_id'];
        $product->product_desc = $data['product_desc'];
        $product->product_price = $data['product_price'];
        $product->product_quantity = $data['product_quantity'];
        $product->created_at = CarbonCarbon::now();
        $get_image = $request->file('product_image');
        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName(); 
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/products', $new_image);
            $product->product_image = $new_image;
            $product->save();
            Session::put('message', 'Update thành công!');
            return Redirect::to('all-product');
        }
        Session::put('message', 'Update thành công!');
        $product->save();
        return Redirect::to('all-product');
    }
    public function del_product($product_id)
    {
        (new RootController)->AuthLogin();
        # code...
        // DB::table('tbl_category')->where('category_id',$category_id)->delete();
        ModelsProduct::find($product_id)->delete();
        Session::put('message', 'Xóa thành công!');
        return Redirect::to('all-product');
    }
    ////end Admin-product

    public function new_product(){
    // {
        $category = ModelsCategory::where('category_status','1')->orderBy('category_id')->get();
        $all_product =  ModelsProduct::where('product_status','1')
                            ->orderBy('created_at','desc')
                            ->paginate(9);

        # code...
        
        return view('pages.products.new_product')->with('product',$all_product)->with('category',$category);
       
        // $all_product =  ModelsProduct::join('tbl_category', 'tbl_category.category_id', '=', 'tbl_product.category_id')
        //     ->orderBy('product_id')
        //     ->get();

        // $manager_product = view('pages.products.new_product')->with('all_product', $all_product);
        // return view('layout')->with('all_product', $manager_product);
    }
    public function category_product($category_id)
    {
        # code...
        $category = ModelsCategory::where('category_status','1')->orderBy('category_name')->get();
    
        $category_get = ModelsCategory::find($category_id);
        $cate_product = ModelsProduct::where('category_id',$category_id)
                                        ->where('product_status','1')
                                        ->orderBy('product_id','desc')
                                        ->paginate(9);
        return view('pages.products.category_product')->with('product',$cate_product)->with('category',$category)->with('category_get',$category_get);                                
    }
    public function details_product($product_id)
    {
        # code...
        

        $category = ModelsCategory::where('category_status','1')->orderBy('category_name')->get();
        $details_product = ModelsProduct::join('tbl_category', 'tbl_category.category_id', '=', 'tbl_product.category_id')
                                ->find($product_id);
        $cate_product = ModelsProduct::where('category_id',$details_product->category_id)
                                ->whereNotIn('product_id',[$details_product->product_id])
                                ->where('product_status','1')
                                ->inRandomOrder()
                                ->limit(3)->get();
        return view('pages.products.details_product')->with('product',$details_product)
                                                    ->with('category',$category)
                                                    ->with('cate_product',$cate_product);                                
    }
}
