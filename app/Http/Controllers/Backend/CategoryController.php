<?php

namespace App\Http\Controllers\Backend;

use App\Category;
use App\Http\Controllers\Component\FileHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{


    /**
     * @var FileHandler
     */
    public $fileHandler;

    public function __construct()
    {
        $this->fileHandler = new FileHandler();
    }


    public function index()
    {
        if(Session::get('adminDetails')->category_access == 0)
        {
            return redirect('admin/dashboard')->with('warning', 'you are not allow');
        }
        $categories = Category::with('parent')->withCount('categoryProducts')->orderBy('id', 'desc')->get();
        return view('backend.category.index', compact('categories'));
    }



    public function create()
    {
        if(Session::get('adminDetails')->category_access == 0)
        {
            return redirect('admin/dashboard')->with('warning', 'you are not allow');
        }
        $main_categories = Category::with('parent', 'children')->orderBy('id', 'desc')->where('parent_id', null)->get();
        return view('backend.category.create', compact('main_categories'));
    }


    public function store(CategoryRequest $request)
    {
        $img =   $request->file('img');
        if ($img)
        {
            $getImageName = $this->fileHandler->fileUpload($img,'img');
            if ($getImageName)
            {
                $request['image'] = $getImageName;
            }
        }
        $request['slug'] = $request->name;
        Category::create($request->except('_token'));
        return redirect()->back()->with('success', 'Category Created successfully !');

    }

    public function edit(Category $category)
    {
        if(Session::get('adminDetails')->category_access == 0)
        {
            return redirect('admin/dashboard')->with('warning', 'you are not allow');
        }
        $main_categories = Category::with('parent', 'children')->orderBy('id', 'desc')->where('parent_id', null)->get();
        return view('backend.category.edit', compact( 'category' ,'main_categories'));
    }


    public function update(CategoryRequest $request, Category $category)
    {

        $image = $request->file('img');
        if ($image)
        {
            $getImageName = $this->fileHandler->fileUpload($image,'img');
            if ($getImageName)
            {
                $request['image'] = $getImageName;
            }
            // delete the old image
            $this->fileHandler->fileDelete($category->image);
        }
        $request['slug'] = $request->name;
        $request['parent_id'] = $request->parent_id;
        $category->update($request->except('_token'));
        return redirect()->back()->with('success', 'Category Updated successfully !');
    }


    public function destroy(Category $category)
    {
        if(Session::get('adminDetails')->category_access == 0)
        {
            return redirect('admin/dashboard')->with('warning', 'you are not allow');
        }

        if (($category->children->count() == 0) and (count($category->categoryProducts) == 0)){
            if ($category->delete()){

                //Delete image
                if ($category->image){
                    $this->fileHandler->fileDelete($category->image);
                }

                return back()->with('success', 'Category delete successfully');

            }else{
                return back()->with('error', 'Category could not be delete');
            }
        }else{
            return back()->with('warning', 'You are not allow to delete this category');
        }


    }


    public function changeStatus(Request $request, Category $category)
    {
        $request['status'] = ($request['old'] == 1)?0:1;
        $update = $category->update($request->all());

        if ($update){
            return back()->with('success', 'Category status change successfully');
        }else{
            return back()->with('error', 'Category status could not be change');
        }
    }

}
