<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Auth;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        // $this->authorizeResource(Category::class, 'category');
    }    

    public function index()
    {
        $category = Category::paginate(15);
        return view('backend.category.index', ['category' => $category]);
    }

    public function create()
    {
        return view('backend.category.create');
    }
    
    public function store(CategoryRequest $request)
    {

        $data = $request->all();
        $data['user_id'] = Auth::user()->id;

        Category::create($data);
        
        return redirect('category')->with('message_success', 'Thêm mới thành công');
    }

    public function show($id)
    {
        //
    }

    public function edit(Category $category)
    {
        return view('backend.category.edit', ['category' => $category]);
    }

    public function update(CategoryRequest $request, Category $category)
    {
  
        $data = Category::find($category->id);    

        $data->title = $request->title;
        $data->description = $request->description;
        $data->status = $request->status;
        
        $data->save();
        
        return redirect('category')->with('message_success', 'Cập nhật thành công');
    }

    public function destroy(Request $request)
    {       

        $category = Category::findOrFail($request->id);
        $category->delete();
        // session()->put('message_danger', 'Xóa danh mục thành công');
        
        return redirect('category')->with('message_danger', 'Xóa danh mục thành công');
    }

    public function deactivated($id)
    {
        dd('dsad');
        Category::where('id', $id)->update(['status'=>0]);
        return redirect('category')->with('message_warning', 'Ngừng kích hoạt thành công');
    }

    public function activated($id)
    {
        Category::where('id', $id)->update(['status'=>1]);
        return redirect('category')->with('message_success', 'Kích hoạt thành công');
    }
}