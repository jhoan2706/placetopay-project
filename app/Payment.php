<?php

namespace App;

use App\User;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class Payment
{
    public $user_data = [];
    public $transaction = [];

    public function __construct(Request $request,User $user)
    {
        $reference = time();
        $product=session('producto');

        $this->user_data['document'] = $user->document;
        $this->user_data['documentType'] = $user->document_type->name;
        $this->user_data['name'] = $user->name;
        $this->user_data['surname'] = $user->last_name;
        $this->user_data['email'] = $user->email;
        $this->user_data['address'] = [
            'street'=>$user->street,
            'city'=>$user->city,
            'country'=>$user->country
        ];
        $this->user_data['city'] = $user->city;
        $this->user_data['province'] = $user->state;
        $this->user_data['country'] = $user->country;
        $this->user_data['phone'] = $user->phone;

        //datos necesarios para la transaccion
        //$this->transaction['auth']=config('placetopay.auth'); 
        $this->transaction['reference'] =$reference;
        $this->transaction['returnURL'] = route('show_transaction_detail',$reference);
        $this->transaction['payment']['reference']=$reference;
        $this->transaction['payment']['description'] = 'Pago Prueba (B)';        
        $this->transaction['payment']['amount']['currency']='COP';
        $this->transaction['payment']['amount']['total']=$product['price'];

        $this->transaction['language'] = strtoupper(config('app.locale'));
        $this->transaction['buyer'] = $this->user_data;
        $this->transaction['ipAddress'] = $request->ip();
        $this->transaction['userAgent'] = $request->userAgent();
    }
}
