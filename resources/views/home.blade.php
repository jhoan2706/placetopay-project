@extends('layouts.app') 
@section('content')
{{-- <div class="border-bottom  p-1 ">
        <h3 class="ml-3" id="myModalLabel">
                LISTADO DE PRODUCTOS
        </h3>
    </div> --}}
<div class="row">
    <div class="col-md-4 col-md-offset-4">
            <h2 style="text-align:center">Producto</h2>

            <div class="card">
              <img src="https://dummyimage.com/200/787878/ffffff.png&text=img+product" alt="Denim Jeans" style="width:100%">
              <h1>{{$product['name']}}</h1>
              <p class="price">$&nbsp;{{$product['price']}}</p>
              <p>{{$product['detail']}}</p>
              <p><a class="btn btn-primary btn-lg btn-block" href="{{route('create_payment_form')}}" role="button">Comprar</a></p>
            </div>

        {{-- <div class="card" style="width: 18rem;">
            <img class="card-img-top" src="https://dummyimage.com/200/787878/ffffff.png&text=img+product" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">{{$product['name']}}</h5>
                <p class="card-text">{{$product['detail']}}</p>
                <a href="{{route('create_payment_form')}}" class="btn btn-primary">Comprar</a>
            </div>
        </div> --}}
    </div>
</div>
@endsection