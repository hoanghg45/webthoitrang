<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon as CarbonCarbon;
use App\Models\Category as ModelsCategory;
use App\Http\Controllers\Controller as RootController;




class CategoryProduct extends Controller
{
    public function add_category()
    {
        (new RootController)-> AuthLogin();
        # code...
        return view('admin.add_category');
    }
    
    public function all_category()
    {
        
        (new RootController)-> AuthLogin();
        # code...
        // $all_category = DB::table('tbl_category')->get();
        $all_category = ModelsCategory::orderBy('category_id')->paginate(10);
        $manager_category = view('admin.all_category')->with('all_category',$all_category);
        return view('admin_layout')->with('all_category',$manager_category);
    }
    public function save_category(Request $request)
    {
        (new RootController)-> AuthLogin();
        # code...
        $data = $request->all();

        $category = new ModelsCategory();
        $category->category_name = $data['category_name'];
        $category->category_desc = $data['category_desc'];
        $category->category_status = $data['category_status'];
        $category->created_at = CarbonCarbon::now(); 
        Session::put('message','Thêm thành công!');
        $category->save();
        return Redirect::to('all-category');
    }
    // public function unactive_category_product($category_product_id){
    //     $this->authLogin();
    //     DB::table('category_product')->where('category_id', $category_product_id)->update(['category_status'=>1]);
    //     Session::put('message','Không kích hoạt danh mục sản phẩm thành công');
    //     return Redirect::to('all-category-product');
        
    // }
    public function unactive_category($category_id)
    {   
        # code...
        (new RootController)-> AuthLogin();
        $category = ModelsCategory::find($category_id);
        $category->category_status= 0;
        $category->save();
        Session::put('message','Hủy kích hoạt thành công!');
        return Redirect::to('/all-category');
        
    }
    public function active_category($category_id)
    {
        (new RootController)-> AuthLogin();
        # code...
        // DB::table('tbl_category')->where('category_id',$category_id)->update(['category_status'=> 1]);
        $category = ModelsCategory::find($category_id);
        $category->category_status= 1;
        $category->save();
        
        Session::put('message','Kích hoạt thành công!');
        Session::save();
        
        return Redirect::to('/all-category');
    }
    public function edit_category($category_id)
    {
        (new RootController)-> AuthLogin();
        // $edit_category = DB::table('tbl_category')->where('category_id',$category_id)->get();
        $edit_category = ModelsCategory::find($category_id);
        // $manager_category = view('admin.edit_category')->with('edit_category',$edit_category);
        // return view('admin_layout')->with('admin.edit_category',$manager_category);
        return view('admin.edit_category')->with('edit_category',$edit_category);
    }

    
    public function update_category($category_id,Request $request)
    {
        (new RootController)-> AuthLogin();
        # code...
        $data = $request->all();
        
        $category =ModelsCategory::find($category_id);
        $category->category_name = $data['category_name'];
        $category->category_desc = $data['category_desc'];
        $category->updated_at = CarbonCarbon::now(); 
        $category->save();
        Session::put('message','Update thành công!');
        
        return Redirect::to('all-category');
    }
    public function del_category($category_id)
    {
        (new RootController)-> AuthLogin();
        # code...
        // DB::table('tbl_category')->where('category_id',$category_id)->delete();
         ModelsCategory::find($category_id)->delete();
        
        Session::put('message','Xóa thành công!');
        return Redirect::to('all-category');
    }
    
}   