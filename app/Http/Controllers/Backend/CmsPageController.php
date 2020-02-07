<?php

namespace App\Http\Controllers\Backend;

use App\CmsPage;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Intervention\Image\Facades\Image;

class CmsPageController extends Controller
{

    public function index()
    {
        $cms_pages = CmsPage::all();
        return view('backend.cms_pages.index', compact('cms_pages'));
    }


    public function create()
    {
        return view('backend.cms_pages.create');
    }



    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:cms_pages,title',
            'description' => 'required',
        ]);
        $request['slug'] = $request->title;

        $img =   $request->file('img');
        if ($img)
        {
            $setImageName = rand(). '.'. $img->getClientOriginalExtension();
            // set location of images
            $large_image_path = public_path('backend/uploads/images/cms_pages/'.$setImageName);
            // set image size
            Image::make($img)->save($large_image_path,100);
            // store the image
            $request['image'] = $setImageName;
        }

        CmsPage::create($request->except('_token','img'));
        return redirect()->back()->with('success', 'Cms Create done');

    }



    public function show(CmsPage $cmsPage)
    {
        //
    }


    public function edit(CmsPage $cmsPage)
    {
        //
    }


    public function update(Request $request, CmsPage $cmsPage)
    {
        //
    }


    public function destroy(CmsPage $cmsPage)
    {
        //
    }
}
