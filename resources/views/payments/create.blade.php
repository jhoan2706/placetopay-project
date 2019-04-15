@extends('layouts.app') 
@section('content')
<div class="border-bottom  p-1 ">
    <h3 class="ml-3" id="myModalLabel">
        DATOS PARA FINALIZAR COMPRA
    </h3>
</div>
<div class="row">
    <div class="col-12">
    @include('common.errors')
     @if(session()->has('status'))
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Atencion!</strong>{{ session()->get('status') }}
        </div>
        @endif
    </div>
</div>
<div class="row" style="margin-bottom:20px;">
    <div class="col-md-9">
        <form action="{{route('payment.store')}}" method="post">
            {{ csrf_field() }}
            <!--Grid row-->
            <div class="row mb-2">

                <!--Grid column-->
                <div class="col-md-6">

                    <div class="form-group">
                        <label for="user_nombre" class="dark-grey-text font-weight-bold">Nombre</label>
                        <input type="text" name="first_name" class="form-control" placeholder="Nombre" />
                    </div>

                </div>
                <!--Grid column-->

                <!--Grid column-->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="user_apellido" class="dark-grey-text font-weight-bold">Apellido</label>
                        <input type="text" name="last_name" class="form-control" placeholder="Apellido" />
                    </div>
                </div>
            </div>
            <!--Grid row-->
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Tipo Documento</label>
                        <select class="form-control" name="document_type" id="">
                                            @foreach ($document_types as $document_type)
                                                <option value="{{$document_type->name}}">{{$document_type->description}}</option>
                                            @endforeach
                        </select>
                    </div>
                </div>
                <!--Grid column-->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="document">#Documento</label>
                        <input type="text" class="form-control" name="document" id="document" aria-describedby="helpId" placeholder="Documento">
                    </div>
                </div>
            </div>

            <div class="row">

                <!--Grid column-->
                <div class="col-md-8 mb-2">
                    <div class="form-group">
                        <label for="email">Correo electrónico</label>
                        <input type="email" class="form-control" name="email" id="email" aria-describedby="" placeholder="Correo electrónico">
                    </div>

                </div>
                <!--Grid column-->

                <!--Grid column-->
                <div class="col-md-4 mb-2">
                    <div class="form-group">
                        <label for="">Teléfono</label>
                        <input type="text" class="form-control" name="phone" id="" placeholder="Teléfono">
                    </div>

                </div>
                <!--Grid column-->

            </div>
            <!--Grid row-->
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="street">Dirección</label>
                        <input type="text" class="form-control" name="street" id="street" aria-describedby="" placeholder="Dirección ">
                    </div>
                </div>
            </div>

            <!--Grid row-->
            <div class="row">

                <!--Grid column-->
                <div class="col-lg-4 col-md-12 mb-4">

                    <div class="form-group">
                        <label for="country">País</label>
                        <select class="form-control" name="country" id="country">
                        <option value="CO" selected>Colombia</option>
                      </select>
                    </div>

                </div>
                <!--Grid column-->

                <!--Grid column-->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="form-group">
                        <label for="">Región/Provincia</label>
                        <select class="form-control" name="state" id="">
                        <option value="Antioquia" selected>Antioquia</option>
                      </select>
                    </div>

                </div>
                <!--Grid column-->

                <!--Grid column-->
                <div class="col-lg-4 col-md-6 mb-4">

                    <div class="form-group">
                        <label for="city">Ciudad</label>
                        <select class="form-control" name="city" id="city">
                        <option value="Medellin" selected>Medellín</option>                        
                      </select>
                    </div>

                </div>
                <!--Grid column-->

            </div>
            <!--Grid row-->


            <hr>

            <div class="mb-1">
                <input type="checkbox" id="checkboxTerms" class="form-check-input filled-in" id="chekboxRules">
                <!-- Button trigger modal -->
                <label class="form-check-label" for="chekboxRules">
                    <a href="#" data-toggle="modal" data-target="#modelId">Acepto los términos y condiciones</a>
                    
                </label>
            </div>

            <button class="btn btn-primary btn-lg btn-block" id="btnGoCheckout" type="submit">Ir a Checkout</button>

        </form>
    </div>
    <div class="col-md-3">
            <h2 style="text-align:center">Producto</h2>

            <div class="card">
              <img src="https://dummyimage.com/200/787878/ffffff.png&text=img+product" alt="Denim Jeans" style="width:100%">
              <h1>{{$current_product['name']}}</h1>
              <p class="price">$&nbsp;{{$current_product['price']}}</p>
              <p>{{$current_product['detail']}}</p>
              {{-- <p><button>Add to Cart</button></p> --}}
            </div>
        {{-- <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">{{$current_product['name']}}</h5>
                <p class="card-text">{{$current_product['detail']}}</p>
            </div>
            <div class="card-body">
                <li class="list-group-item">{{$current_product['price']}}</li>
            </div>
        </div> --}}
    </div>
</div>
@include('payments.terms_modal')
@endsection
@section('scripts')
    <script>
    $(function () {
        var terms_accepted=false;
        $("#btnGoCheckout").attr('disabled', true);
        $("#checkboxTerms").change(function (e) { 
            terms_accepted=!terms_accepted;            
            $("#btnGoCheckout").attr('disabled', !terms_accepted);
        });
        
    });
    </script>
@endsection