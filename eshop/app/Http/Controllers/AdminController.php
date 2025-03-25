<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Brand;

class AdminController extends Controller
{
    public function index(){
        return view('admin.index');
    }

    public function brands(){
        $brands = Brand::orderBy('id','DESC')->paginate(10);
        return view('admin.brands',compact('brands'));
    }

    public function add_brand(){
        return view('admin.brand-add');
    }

    public function brand_store(Request $request){
        $request->vaildate([
            'name' => 'required',
            'slug' => 'required|unique:brands.slug',
            'image' => 'mimes:png,jpg,jpeg,svg|max:2048.'
        ]);

        $brand = new Brand();
        $brand->name = $request->name;
        $brand->slug = Str::slug($request->$name);
        $image = $request->file('image');
        $file_extention = $request->file('image')->extension();
        $file_name = carbon::now()->timestamp.'.'.$file_extension;
        $brand->image = $file_name;
        $brand->save();
        return redirect()->route('admin.brands')->with('status','Brand has been added successfully!');

    }

    public function 
}

