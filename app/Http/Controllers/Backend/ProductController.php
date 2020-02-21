<?php

namespace App\Http\Controllers\Backend;

use App\Category;
use App\Http\Controllers\Component\FileHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Product;
use App\ProductAttribute;
use App\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
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
        $products = Product::with('productCategory')->get();
        return view('backend.product.index', compact('products'));
    }


    public function create()
    {
        if(Session::get('adminDetails')->product_all_access == 0 || Session::get('adminDetails')->product_create_access == 0)
        {
            return redirect('admin/dashboard')->with('warning', 'you are not allow');
        }
        $main_categories = Category::with('parent', 'children')->orderBy('id', 'desc')->where('parent_id', null)->get();
        return view('backend.product.create',compact('main_categories'));
    }


    public function store(ProductRequest $request)
    {
        $img =   $request->file('img');
        if ($img)
        {
           $setImageName = rand(). '.'. $img->getClientOriginalExtension();
            // set location of images
           $large_image_path = public_path('backend/uploads/images/product/large/'.$setImageName);
           $medium_image_path = public_path('backend/uploads/images/product/medium/'.$setImageName);
           $small_image_path = public_path('backend/uploads/images/product/small/'.$setImageName);
           // set image size
            Image::make($img)->save($large_image_path,100);
            Image::make($img)->resize('600','600')->save($medium_image_path,100);
            Image::make($img)->resize('300','300')->save($small_image_path,100);
            // store the image
            $request['image'] = $setImageName;
        }
            $request['slug'] = $request->name;
            Product::create($request->except('_token','img'));
            return redirect()->back()->with('success', 'Product Created successfully !');
    }



    public function show(Product $product)
    {
        //
    }


    public function edit(Product $product)
    {
        if(Session::get('adminDetails')->product_all_access == 0 || Session::get('adminDetails')->product_edit_access == 0)
        {
            return redirect('admin/dashboard')->with('warning', 'you are not allow');
        }
        $main_categories = Category::with('parent', 'children')->orderBy('id', 'desc')->where('parent_id', null)->get();
        return view('backend.product.edit', compact('main_categories', 'product'));
    }


    public function update(Request $request, Product $product)
    {
        //
    }


    public function destroy(Product $product)
    {
        if(Session::get('adminDetails')->product_all_access == 0 || Session::get('adminDetails')->product_delete_access == 0)
        {
            return redirect('admin/dashboard')->with('warning', 'you are not allow');
        }
    }



    public function addProductAttribute($id = null)
    {
        $product = Product::find($id);
        return view('backend.product.add_attribute', compact('product'));
    }


    public function addProductAttributeStore(Request $request, $id = null)
    {
        $data = $request->all();
        foreach ($data['sku'] as $key => $value)
        {
            // prevent duplicate sku for all
            $attrSku = ProductAttribute::where('sku', $value)->count();
            if ($attrSku > 0){
                return redirect()->back()->with('error', 'Product  SKU Already Exist!! Please try again another ');
            }

            // prevent duplicate size for perticular product
            $checkSize = ProductAttribute::where(['product_id' => $id, 'size' => $data['size'][$key]])->count();
            if ($checkSize > 0){
                return redirect()->back()->with('error', 'Product  Size Already Exist!! Please try again another ');
            }

            ProductAttribute::create([
                'product_id' => $id,
                'sku' => $value,
                'size' => $data['size'][$key],
                'price' => $data['price'][$key],
                'stock' => $data['stock'][$key],
            ]);
        }
        return redirect()->back()->with('success', 'Product Attribute added Success');
    }


    public function updateProductAttributeStore(Request $request)
    {
        $data = $request->all();
        foreach ($data['idAttr'] as $key => $value)
        {
            ProductAttribute::where('id', $value)->update([
                'price' => $data['price'][$key],
                'stock' => $data['stock'][$key],
            ]);
        }
        return redirect()->back()->with('success', 'Product Attribute Updated Success !');
    }




    public function ShowProductImageForm(Request $request, $id = null)
    {
        $product = Product::findOrFail($id);
        return view('backend.product.alter_images', compact('product'));
    }


    public function addProductImageStore(Request $request, $id = null)
    {
        $files =   $request->file('img');
        if ($files)
        {
            foreach ($files as $image){
                $setImageName = rand(). '.'. $image->getClientOriginalExtension();
                // set location of images
                $large_image_path = public_path('backend/uploads/images/product/large/'.$setImageName);
                $medium_image_path = public_path('backend/uploads/images/product/medium/'.$setImageName);
                $small_image_path = public_path('backend/uploads/images/product/small/'.$setImageName);
                // set image size
                Image::make($image)->save($large_image_path,100);
                Image::make($image)->resize('600','600')->save($medium_image_path,100);
                Image::make($image)->resize('300','300')->save($small_image_path,100);
                // store the image
                $request['image'] = $setImageName;
                $request['product_id'] = $id;
                ProductImage::create($request->except('_token','img'));
            }
        }
        return redirect()->back()->with('success', 'Product Images Store successfully !');
    }






}
