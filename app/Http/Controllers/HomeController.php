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
    }

    public function index(Request $request)
    {
        $sort = $request->sort;
        $sql = Product::where('status', '=', 1);

        if ($sort) {          
            if ($request->sort === "asc" || $request->sort === "desc") {
                $products = $sql->orderBy('price', $request->sort)->get();
                return view('frontend.index', compact('products', 'sort'));
            }
            if ($request->sort === "none") {
                $products = $sql->latest()->get();
                return view('frontend.index', compact('products', 'sort'));
            }
        } else {
            $products = $sql->latest()->get();
            return view('frontend.home', compact('products', 'sort'));
        }
    }
}