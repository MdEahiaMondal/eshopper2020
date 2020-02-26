<?php

namespace App\Exports;

use App\Category;
use App\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductsExport implements WithHeadings, FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $products = Product::select('category_id', 'name', 'price', 'code','color', 'details')->get();
        foreach ($products as $key => $product){
//            $categoryName = Category::select('name')->where('id', $product->category_id)->first();
            $products[$key]->category_id = $product->productCategory->name;
        }
        return $products;
    }

    public function headings(): array
    {
        // TODO: Implement headings() method.
        return  [
            'Category Name',
            'Product Name',
            'Product Price',
            'Product Code',
            'Product Color',
            'Product Details',
        ];
    }

}
