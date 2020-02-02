<?php

namespace App\Http\Controllers\Backend;

use App\Banner;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class BannerController extends Controller
{


    public function index()
    {
        $banners = Banner::all();
        return view('backend.banners.index', compact('banners'));
    }


    public function create()
    {
        return view('backend.banners.create');
    }


    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'img' => 'required',
            'status' => 'nullable',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $files =   $request->file('img');
        if ($files)
        {
                $setImageName = rand(). '.'. $files->getClientOriginalExtension();
                // set location of images
                $large_image_path = public_path('backend/uploads/images/banners/'.$setImageName);
                // set image size
                Image::make($files)->resize('1140','340')->save($large_image_path,100);
                // store the image
                $request['image'] = $setImageName;
                $request['slug'] = $request->title .uniqid();
                $request['status'] = $request->status ?? 0;
                Banner::create($request->except('_token','img'));
            }
        return redirect()->back()->with('success', 'Banner create Success !');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function show(Banner $banner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function edit(Banner $banner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Banner $banner)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banner $banner)
    {
        //
    }
}
