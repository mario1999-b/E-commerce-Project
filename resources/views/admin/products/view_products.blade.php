@extends('layouts.adminLayout.admin_design')
@section('content')
<div id="content">
  <div id="content-header">
  <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Prodotti</a> <a href="#" class="current">visualizza Prodotti</a> </div>
    <h1>Prodotti</h1>
    @if(Session::has('flash_message_error'))
    <div class="alert alert-success alert-block">
    	<button type="button" class="close" data-dismiss="alert">×</button>
            <strong> {!! session ('flash_message_error') !!}</strong>
    </div>
     @endif

    @if(Session::has('flash_message_success'))
    <div class="alert alert-success alert-block">
    	<button type="button" class="close" data-dismiss="alert">×</button>
            <strong> {!! session ('flash_message_success') !!}</strong>
    </div>

    @endif
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">

        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>visualizza Prodotti</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>ID Prodotto</th>
                  <th>ID Categoria</th>
                  <th>Nome Categoria</th>
                  <th>Nome Prodotto</th>
                  <th>Codice Prodotto</th>
                  <th>Colore Prodotto</th>
                  <th>Prezzo</th>
                  <th>Immagine</th>
                  <th>Operazioni</th>
                </tr>
              </thead>
              <tbody>
              @foreach($products as $product)
                <tr class="gradeX">
                  <td>{{$product->id}}</td>
                  <td>{{$product->category_id}}</td>
                  <td>{{$product->category_name}}</td>
                  <td>{{$product->product_name}}</td>
                  <td>{{$product->product_code}}</td>
                  <td>{{$product->product_color}}</td>
                  <td>{{$product->price}}</td>
                  <td>{{$product->image}}
                      @if(!empty($product->image)))
                       <img src="{{asset('/images/backend_images/prodotti/small/'.$product->image)}}" style="width:50px;">
                       @endif
                  </td>
                  <td class="center"><a href="#myModal{{$product->id}}" data-toggle="modal" class="btn btn-success btn-mini">Visualizza</a><a href="{{ url('/admin/edit-product/'.$product->id)  }} " class="btn btn-primary btn-mini">Edit</a>  
                  <a id="delCat"href="{{ url('/admin/delete-product/'.$product->id)  }} " class="btn btn-danger btn-mini">Delete</a></div></td> 
                </tr>
                <div id="myModal{{$product->id}}" class="modal hide">
              <div class="modal-header">
                <button data-dismiss="modal" class="close" type="button">×</button>
                <h3>{{$product->product_name}} Dettagli</h3>
              </div>
              <div class="modal-body">
                <p>ID Prodotto:{{$product->id}}</p>
                <p>ID Categoria:{{$product->category_id}}</p>
                <p>Codice Prodotto:{{$product->product_code}}</p>
                <p>Colore Prodotto:{{$product->product_color}}</p>
                <p>Prezzo:{{$product->price}}</p>
                <p>Descrizione:{{$product->description}}</p>
              </div>
            </div>
                @endforeach
                 
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection