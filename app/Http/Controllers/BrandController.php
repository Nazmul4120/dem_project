<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;

use Illuminate\Support\Carbon;
use Image;
use Auth;


class BrandController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }


    public function AllBrand()
    {

        $brands = Brand::latest()->paginate(5);
        return view('admin.brand.index', compact('brands'));
    }


    public function StoreBrand(Request $request): \Illuminate\Http\RedirectResponse
    {
        $validatedData = $request->validate([
            'brand_name' => 'required|unique:brands|min:4',
            'brand_image' => 'required|mimes:jpg.jpeg,png',

        ],
            [
                'brand_name.required' => 'Please Input Brand Name',
                'brand_image.min' => 'Brand Longer then 4 Characters',
            ]);

        $brand_image = $request->file('brand_image');

        $name_gen = hexdec(uniqid());
        $img_ext = strtolower($brand_image->getClientOriginalExtension());
        $img_name = $name_gen.'.'.$img_ext;
        $up_location = 'image/brand/';
        $last_img = $up_location.$img_name;
        $brand_image->move($up_location,$img_name);



        Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_image' => $last_img,
            'created_at' => Carbon::now()
        ]);


        return Redirect()->back()->with('success','Brand  Updated Successful');

    }
}

