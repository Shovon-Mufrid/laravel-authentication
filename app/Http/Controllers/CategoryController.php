<?php

namespace App\Http\Controllers;
use App\http\Requests\CategoryRequest;
use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CategoryController extends Controller
{
    function index(){
        $categories = category::all();
        $trash_cat  = category::onlyTrashed()->get();
        return view('admin.category.index',[
            'categories' => $categories,
            'trash_cat' => $trash_cat,
        ]);
    }
    function insert(CategoryRequest $request){
        // print_r($request -> category_name);

        // $request-> validate([
        //     'category_name' => 'required | unique:categories',
        // ],[
        //     // custom message
        //     'category_name.required' => 'Enter a category name please',
        //     'category_name.unique' => 'Name is already here',
        // ]);

        category::insert([
            'user_id' => Auth::id(),
            'category_name' => $request -> category_name,
            'created_at' => Carbon::now(),
        ]);
        return back() -> with('success','Category added successfully');
    }
    function delete($category_id){
        category::find($category_id)-> delete();
        return back()->with('delete', 'category deleted successfilly');
    }
    function edit($category_id){
        $category_info = category::find($category_id);

        return view('admin.category.edit',compact('category_info'));
    }
    function update(Request $request){
        category::find($request->id)->update([
            'user_id' => Auth::id(),
            'category_name' => $request->category_name,
            'updated_at' => Carbon::now(),
        ]);
        return redirect('/category');
    }
    function restore($category_id){
       category::onlyTrashed()->find($category_id)-> restore();
       return back();
    }
    function hard_delete($category_id){
        category::onlyTrashed()->find($category_id)->forceDelete();
        return back();
    }
    function mark_delete(Request $request){
        foreach($request-> mark as $mark){
            category:: find($mark)->delete();
        }
        return back()->with('mark_delete', 'All deleted');
    }


}
