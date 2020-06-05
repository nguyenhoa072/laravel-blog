<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Category;
use App\Http\Resources\CategoryCollection;
use App\Http\Requests\CategoryRequest;

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
        $category = Category::paginate(15);
        return view('backend.category.index', ['category' => $category]);
    }

    public function list()
    {
        return Category::get();
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

    /**y
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //   $post = new Category([
    //     'title' => $request->get('title'),
    //     'description' => $request->get('description')
    //   ]);

    //   $post->save();

    //   return response()->json('successfully added');
    // }
    
    public function store(CategoryRequest $request)
    {

        // $data = new Category;

        // dd($data);

        // $data = $request->all();
        
        // $data->title = $request->title;
        // $data->description = $request->description;
        // $data->status = $request->status;

        // $data->save();

        // return response()->json($data);
        
        // return redirect('category')->with('message_success', 'Thêm mới thành công');
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
    public function edit(Category $category)
    {
        return view('backend.category.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, Category $category)
    {
  
        $data = Category::find($category->id);    

        $data->title = $request->title;
        $data->description = $request->description;
        $data->status = $request->status;
        
        $data->save();
        
        return redirect('category')->with('message_success', 'Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {       
       
        // Category::destroy($request->id);
        $category = Category::findOrFail($request->id);
        $category->delete();
        // session()->put('message_danger', 'Xóa danh mục thành công');
        
        return redirect('category')->with('message_danger', 'Xóa danh mục thành công');
    }

    public function delete($id)
    {       
       
        $category = Category::findOrFail($id);
        $category->delete();

        return response(['result' => 'success'], 200);
    }

    public function deactivated($id)
    {
        Category::where('id', $id)->update(['status'=>0]);
        return redirect('category')>with('message_danger', 'Ngừng kích hoạt thành công');
    }

    public function activated($id)
    {
        Category::where('id', $id)->update(['status'=>1]);
        return redirect('category')>with('message_danger', 'Kích hoạt thành công');
    }
}