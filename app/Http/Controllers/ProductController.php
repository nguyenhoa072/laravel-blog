<?php

namespace App\Http\Controllers;

use App\Product;
use App\Brand;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use ImageResize;


class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('show');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $products = Product::latest()->paginate(10)->join();
        // $products = Product::join('brands', 'products.brand_id', '=', 'brands.id')->get();
        $products = Product::select(['products.*', 'brands.title as brand_title', 'categories.title as category_title'])
        ->join('categories', 'products.category_id', '=', 'categories.id')
        ->join('brands', 'products.brand_id', '=', 'brands.id')->latest()->paginate(10);
        // return view('backend.products.index',compact('products'))
        //     ->with('i', (request()->input('page', 1) - 1) * 5);
        // dd($products);
        return view('backend.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands = Brand::orderBy('title', 'asc')->get();
        $category = Category::orderBy('title', 'asc')->get();
        return view('backend.products.form', compact('brands', 'category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        if($request->file('image')) {
            $slug = Str::slug($request->title, '-');
            // $fileName = $request->file('image')->store('upload/product', 'public');
            $fileExtension  = $request->file('image')->getClientOriginalExtension();
            $uploadPath = 'upload/products/';        
            // $fileName = $uploadPath . time() . "_" . rand(0,9999999) . "_" . md5(rand(0,9999999)) . "." . $fileExtension;    
            $fileName = $uploadPath . $slug . "." . $fileExtension;  
            
            
            $image = $request->file('image');
            
            $img = ImageResize::make($image->path());

            // dd($img);
            
            $img->resize(500, 500, function ($constraint) {
                $constraint->aspectRatio();
            })->save($fileName);

            // dd($img);
            
            
            // $image->move($uploadPath, $fileName);           
            
            
            $data = $request->all();
            $data['image'] = $fileName;
        } else {
            $data = $request->all();
        }         
            
        Product::create($data);

        return redirect('products');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($slug, $id)
    {
        $product = Product::where('id', '=', $id)->first();        

        return view('frontend.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $brands = Brand::orderBy('title', 'asc')->get();
        $category = Category::orderBy('title', 'asc')->get();
        return view('backend.products.form', compact('product', 'brands', 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {

        if($request->file('image')) {

            $fileImage = $product->image;

            if(file_exists($fileImage)) {
                unlink($fileImage); 
            }  
            $slug = Str::slug($product->title, '-');
            $fileExtension  = $request->file('image')->getClientOriginalExtension();
            $uploadPath = 'upload/products/';        
            $fileName = $uploadPath . $slug . "." . $fileExtension;
            $request->file('image')->move($uploadPath, $fileName);
            
            $data = $request->all();
            $data['image'] = $fileName;

            
        } else {
            $data = $request->all();
        }        

        $product->update($data);
  
        return redirect('products')->with('message_success','Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return back();
    }

    public function delete_multiple(Request $request)
    {
        $id = $request->input('ids');
        
        $ids = Product::findOrFail($id);

        $files_to_delete = $ids->pluck('image')->toArray();

        \File::delete($files_to_delete);        
        Product::whereIn('id', $id)->delete();

        return back();
    }

    public function massremove(Request $request)
    {
        $id = $request->input('id');

        $ids = Product::findOrFail($id);

        $files_to_delete = $ids->pluck('image')->toArray();

        // Storage::disk('public')->delete($files_to_delete);        
        \File::delete($files_to_delete);
        Product::whereIn('id', $id)->delete();

        return redirect()->route('products.index')->with('message_warning', 'Xóa sản phẩm thành công');
    }

    public function unactive_product($id)
    {
        Product::where('id', $id)->update(['status'=>0]);
        // session()->put('message_warning', 'Ngừng kích hoạt sản phẩm thành công');
        return redirect()->route('products.index')->with('message_warning', 'Ngừng kích hoạt sản phẩm thành công');
    }

    public function active_product($id)
    {
        Product::where('id', $id)->update(['status'=>1]);
        // session()->put('message_success', 'Kích hoạt sản phẩm thành công');
        return redirect('products')->with('message_success', 'Kích hoạt sản phẩm thành công');
    }

    public function search(Request $request)
    {
        $search = $request->get('search');
        
        $products = Product::where('title', 'like', '%'.$search.'%')->paginate(10);

        return view('backend.products.index', compact('products'));
    }
}