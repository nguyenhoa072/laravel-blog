<?php

namespace App\Http\Controllers;

use App\Product;
use App\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use DB;


class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function __construct()     
    {
        $brand = Brand::where('status', '=', 1)->whereExists(function ($query) {
                $query->select(DB::raw(1))
                      ->from('products')
                      ->whereRaw('products.brand_id = brands.id');
            })->get();

        View::share('brand', $brand);
        // view()->share('brand', $brand);        
    } 
    
    public function index()
    {        
        $products = Product::where('status', '=', 1)->latest()->get();
        return view('frontend.home', compact('products'));
    }

    public function Sort(Request $request)
    {
        $sortprice = $request->get('id');
        // $sortprice = Input::get('id');
        // dd($sortprice);
        if($sortprice === "none")
            $products = Product::where('status', '=', 1)->latest()->get();
        else
            $products = Product::where('status', '=', 1)->orderBy('price', $sortprice)->get();

        // return view('frontend.home', compact('products', 'sortprice'));
        return response()->json(['products' => $products]);

    }

    public function brand(Request $request, $slug, $id)
    {
        $products = Product::where('brand_id', '=', $id)->where('status', '=', 1)->latest()->get();      
          
        // $sortprice = $request->get('sort_price');
        // dd($sortprice);
        // if($sortprice === "none")
            // $products = Product::where('status', '=', 1)->latest()->get();
        // else
            // $products = Product::where('status', '=', 1)->orderBy('price', $sortprice)->get();
            
        return view('frontend.home', compact('products'));
    }

}