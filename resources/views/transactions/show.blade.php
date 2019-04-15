@extends('layouts.app')
@section('content')
<div class="border-bottom  p-1 ">
    <h3 class="ml-3" id="myModalLabel">
        DETALLE DE LA TRANSACCIÓN
    </h3>
</div>
<div class="row">
    <div class="col">
        <table class="table table-condensed table-bordered">
            <thead>
                <tr>
                    <th>Label</th>
                    <th>Información</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td scope="row"><b>Razón social</b></td>
                    <td>Razon social comercio</td>
                </tr>
                <tr>
                    <td scope="row"><b>NIT</b></td>
                    <td>800.000.000</td>
                </tr>
                <tr>
                    <td scope="row"><b>Fecha y hora </b></td>
                    <td>{{$transaction->response_date}}</td>
                </tr>
                <tr>
                    <td scope="row"><b>Estado</b></td>
                    <td><span class="{{$transaction->class_status}}">{{$transaction->status}}</span></td>
                </tr>
                <tr>
                    <td scope="row"><b>Motivo</b></td>
                    <td>{{$transaction->response_reason}}</td>
                </tr>
                <tr>
                    <td scope="row"><b>Valor</b></td>
                    <td>{{$transaction->amount}}</td>
                </tr>
                <tr>
                    <td scope="row"><b>Franquicia</b></td>
                    <td>{{$transaction->franquicia}}</td>
                </tr>
                <tr>
                    <td scope="row"><b>Banco</b></td>
                    <td>{{$transaction->banco}}</td>
                </tr>
                <tr>
                    <td scope="row"><b>Autorización/CUS</b></td>
                    <td>{{$transaction->response_authorization}}</td>
                </tr>
                <tr>
                    <td scope="row"><b>Recibo</b></td>
                    <td>{{$transaction->receipt}}</td>
                </tr>
                <tr>
                    <td scope="row"><b>Referencia</b></td>
                    <td>{{$transaction->reference}}</td>
                </tr>
                <tr>
                    <td scope="row"><b>Descripción</b></td>
                    <td>{{$transaction->description}}</td>
                </tr>
                <tr>
                    <td scope="row"><b>DirecciónIp</b></td>
                    <td>{{$transaction->ip_address}}</td>
                </tr>
                <tr>
                    <td scope="row"><b>Cliente</b></td>
                    <td>{{$user_transaction->name." ".$user_transaction->last_name}}</td>
                </tr>
                <tr>
                    <td scope="row"><b>Email</b></td>
                    <td>{{$user_transaction->email}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-md-3 col-md-offset-3"><button type="button" class="btn btn-info">Imprimir</button></div>
    <div class="col-md-3">
        @switch($transaction->status)
            @case("APPROVED")
                <a name="" id="" class="btn btn-primary" href="{{route('home')}}" role="button">Volver al inicio</a>
                @break
            @case("PENDING")
                <a name="" id="" class="btn btn-primary" href="{{route('home')}}" role="button">Volver al inicio</a>
                @break
            @default
                <a name="" id="" class="btn btn-primary" href="{{route('create_payment_form')}}" role="button">Reintentar</a>
                
        @endswitch
    </div>
</div>
    
@endsection