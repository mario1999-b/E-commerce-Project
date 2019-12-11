<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use App\Category;
use App\Product;

class ProductsController extends Controller
{
    public function addProduct(Request $request){
        if($request->isMethod('post')){
            $data=$request->all();
           // echo "<pre>";print_r($data);die;
           if(empty($data['category_id'])){
            return redirect()->back()->with('flash_message_error','Sottocategoria mancante!');    
               
           }
           $product= new Product;
           $product->category_id= $data['category_id'];
           $product->product_name= $data['product_name'];
           $product->product_code= $data['product_code'];
           $product->product_color= $data['product_color'];  
           if(!empty($data['description'])) {
            $product->description= $data['description'];
           }else{
            $product->description= '';
           }
           $product->price= $data['price'];    
           $product->image='';
           $product->save();
           return redirect()->back()->with('flash_message_success','Prodotto aggiunto con successo!');         


        }
        $categories= Category::where(['parent_id'=>0])->get();
        $categories_dropdown= "<option selected disabled>Select</option>";
        foreach($categories as $cat){
            $categories_dropdown .= "<option value='".$cat->id."'>".$cat->name."</option>";
            $sub_categories= Category::where(['parent_id'=>$cat->id])->get();
            foreach($sub_categories as $sub_cat){
                $categories_dropdown .= "<option value='".$sub_cat->id."'>&nbsp;--&nbsp;".$sub_cat->name."</option>";
            }

        }
        return view('admin.products.add_product')->with(compact('categories_dropdown'));


    }
    
}
