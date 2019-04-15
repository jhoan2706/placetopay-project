<?php

namespace App\Http\Controllers;

use App\Classes\CheckoutMethod;
use App\DocumentType;
use App\Http\Requests\PaymentRequest;
use App\Interfaces\CheckoutMethodInterface;
use App\User;
use Facades\App\Http\Controllers\UserController;

class PaymentController extends Controller
{
    public function create()
    {
        $product=[
            'name'=>'Producto #1',
            'detail'=>'Detalle Producto',
            'price'=>15500,
        ];
        session(['producto'=>$product]);
        
        $document_types = DocumentType::all();
        $current_product = session('producto');
        
        return view('payments.create', compact('person_types', 'document_types', 'current_product'));
    }

    public function store(PaymentRequest $request)
    {   
        //Metodo para validar al usuario
        $user=UserController::store($request);
        
        //Uso de poo e interfaz para redireccionar el cliente a P2P Checkout
        if ($user) {
             return $this->make_redirection(new CheckoutMethod($request, $user));
        }

        return redirect()->back()->with('status', 'Error, Los datos del usuario no son correctos, por favor verifique.');
    }
    public function make_redirection(CheckoutMethodInterface $paymentMethod)
    {
        $transactionResult = $paymentMethod->sendCheckoutRequest();
        if ($transactionResult) {
            return redirect()->away($transactionResult);
        }
        //return back();
        return redirect()->back()->with('status', 'Lo sentimos, han habido problemas al conectar con la Pasarela de pagos PlaceToPay');

    }
}
