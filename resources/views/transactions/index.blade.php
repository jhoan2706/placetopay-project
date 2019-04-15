@extends('layouts.app')
@section('content')
    <table class="table table-inverse">
        <thead class="thead-default">
            <tr>
                <th>Fecha y hora</th>
                <th>Referencia</th>
                <th>Autorizacion/CUS</th>
                <th>Estado</th>
                <th>Valor</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $transaction)
                    <tr>
                        <td>{{$transaction->response_date}}</td>
                        <td>{{$transaction->reference}}</td>
                        <td>{{$transaction->response_authorization}}</td>
                        <td>{{$transaction->status}}</td>
                        <td>COP $&nbsp;{{$transaction->amount}}</td>
                        <td><a name="" id="" class="btn btn-success" href="{{route('show_transaction_detail',$transaction->reference)}}" role="button">Ver Detalle</a></td>
                    </tr>
                @endforeach
            </tbody>
    </table>
    {{ $transactions->links() }}
@endsection