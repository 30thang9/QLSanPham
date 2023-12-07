<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    
    public function productList(){
        return view('product-list');
    }

    public function productAdd(){
        return view('product-add');
    }

    public function productEdit($id){
        $product = Product::find($id);

        return view('product-edit',compact('product'));
    }

}
