<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Auth;
use Session;
use Image;
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
           // upload image   
           if($request->hasfile('image')){
               $image_tmp= Input::file('image');
               if($image_tmp->isValid()){
                   $extension= $image_tmp->getClientOriginalExtension();
                   $filename= rand(111,99999).'.'.$extension;
                   $large_image_path= 'images/backend_images/prodotti/large/'.$filename;
                   $medium_image_path= 'images/backend_images/prodotti/medium/'.$filename;
                   $small_image_path= 'images/backend_images/prodotti/small/'.$filename;
                    //Resize image code
                    Image::make($image_tmp)->save($large_image_path);
                    Image::make($image_tmp)->resize(600,600)->save($medium_image_path);
                    Image::make($image_tmp)->resize(300,300)->save($small_image_path);
                    //store image name in product table
                    $product->image=$filename;
               }
           }
           $product->save();
          // return redirect()->back()->with('flash_message_success','Prodotto aggiunto con successo!');   
           return redirect('/admin/view-products')->with('flash_message_success','Prodotto aggiunto con successo!');        


        }
        //Categories drop down start
        $categories= Category::where(['parent_id'=>0])->get();
        $categories_dropdown= "<option selected disabled>Select</option>";
        foreach($categories as $cat){
            $categories_dropdown .= "<option value='".$cat->id."'>".$cat->name."</option>";
            $sub_categories= Category::where(['parent_id'=>$cat->id])->get();
            foreach($sub_categories as $sub_cat){
                $categories_dropdown .= "<option value='".$sub_cat->id."'>&nbsp;--&nbsp;".$sub_cat->name."</option>";
            }

        }
        
        //Categories drop down start
        return view('admin.products.add_product')->with(compact('categories_dropdown'));


    }
    public function editProduct(Request $request, $id=null){

          // upload image   
          if($request->hasfile('image')){
            $image_tmp= Input::file('image');
            if($image_tmp->isValid()){
                $extension= $image_tmp->getClientOriginalExtension();
                $filename= rand(111,99999).'.'.$extension;
                $large_image_path= 'images/backend_images/prodotti/large/'.$filename;
                $medium_image_path= 'images/backend_images/prodotti/medium/'.$filename;
                $small_image_path= 'images/backend_images/prodotti/small/'.$filename;
                 //Resize image code
                 Image::make($image_tmp)->save($large_image_path);
                 Image::make($image_tmp)->resize(600,600)->save($medium_image_path);
                 Image::make($image_tmp)->resize(300,300)->save($small_image_path);
            }
        }else{
           
            $filename= $data['current_image'];
        }


        if($request->isMethod('post')){
            $data=$request->all();
            
           //echo"<pre>";print_r($data);die;
           Product::where(['id'=>$id])->update(['category_id'=>$data['category_id'],
             'product_name'=>$data['product_name'],'product_code'=>$data['product_code'],
            'product_color'=>$data['product_color'],'description'=>$data['description'],
            'price'=>$data['price'],'image'=>$filename]);
            return redirect()->back()->with('flash_message_success','Prodotto caricato con successo');
        }
        // get product details
        $productDetails= Product::where(['id'=>$id])->first();
          //Categories drop down start
          $categories= Category::where(['parent_id'=>0])->get();
          $categories_dropdown= "<option selected disabled>Select</option>";
          foreach($categories as $cat){
              if($cat->id==$productDetails->categotry_id){
                  $selected="selected";
              }else{
                  $selected="";
              }
              $categories_dropdown .= "<option value='".$cat->id."'".$selected.">".$cat->name."</option>";
              $sub_categories= Category::where(['parent_id'=>$cat->id])->get();
              foreach($sub_categories as $sub_cat){
                if($sub_cat->id==$productDetails->categotry_id){
                    $selected="selected";
                }else{
                    $selected="";
                }
                  $categories_dropdown .= "<option value='".$sub_cat->id."'".$selected.">&nbsp;--&nbsp;".$sub_cat->name."</option>";
              }
  
          }
          
          //Categories drop down start
        return view('admin.products.edit_product')->with(compact('productDetails','categories_dropdown'));

    }
    public function viewProducts(Request $request){
        $products= Product::get();
        foreach($products as $key=> $val){
            $category_name= Category::where(['id'=>$val->category_id])->first();
            $products[$key]->category_name= $category_name->name;
         }
        $products=json_decode(json_encode($products));
        return view('admin.products.view_products')->with(compact('products'));;
    }
    
}
