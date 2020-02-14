<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_category = Category::get();
        return view('backend.category.index', ['category' => $all_category]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.category.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = array();

        $data['title'] = $request->title;
        $data['description'] = $request->description;
        $data['status'] = $request->status;
        
        Category::insert($data);

        return redirect('category');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::where('id', $id)->get();
        return view('backend.category.edit', ['category' => $category]);
        // return view('backend.category.edit', compact('category'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = array();

        $data['title'] = $request->title;
        $data['description'] = $request->description;
        $data['status'] = $request->status;
        
        Category::where('id', $id)->update($data);

        session()->put('message_title', $data['title']);
        session()->put('message_success', 'Cập nhật danh mục Category thành công');
        
        return redirect('category');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {       
        Category::where('id', $id)->delete();
        session()->put('message_danger', 'Xóa danh mục Category thành công');
        return redirect('category');
    }

    public function unactive_category($id)
    {
        Category::where('id', $id)->update(['status'=>0]);
        session()->put('message_warning', 'Ngừng kích hoạt Category thành công');
        return redirect('category');
    }

    public function active_category($id)
    {
        Category::where('id', $id)->update(['status'=>1]);
        session()->put('message_success', 'Kích hoạt Category thành công');
        return redirect('category');
    }
}