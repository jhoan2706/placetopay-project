<?php
namespace App\Classes;

use App\Interfaces\CheckoutMethodInterface;
use App\Transaction;
use App\User;
use Dnetix\Redirection\PlacetoPay;
use Illuminate\Http\Request;

class CheckoutMethod implements CheckoutMethodInterface
{
    private $user = [];
    private $data_transaction = [];

    public function __construct(Request $request, User $user)
    {
        //referencia importante unica e irrepetible en el proceso
        $reference = uniqid();
        $product = session('producto');

        //tiempo para que el usuario pueda hacer la compra en P2P
        $expiration = date('c', strtotime('+20 minutes', strtotime(date('c'))));

        $this->user['document'] = $user->document;
        $this->user['documentType'] = $user->document_type->name;
        $this->user['name'] = $user->name;
        $this->user['surname'] = $user->last_name;
        $this->user['email'] = $user->email;
        $this->user['address']['street'] = $user->street;
        $this->user['address']['city'] = $user->city;
        $this->user['address']['country'] = $user->country;
        $this->user['mobile'] = $user->phone;

        $this->data_transaction['locale'] = "en_US";
        $this->data_transaction['buyer'] = $this->user;
        $this->data_transaction['payment']['reference'] = $reference;
        $this->data_transaction['payment']['description'] = "Pago de prueba";
        $this->data_transaction['payment']['amount']['currency'] = "COP";
        $this->data_transaction['payment']['amount']['total'] = $product['price'];
        $this->data_transaction['payment']['allowPartial'] = false;
        $this->data_transaction['expiration'] = $expiration;
        $this->data_transaction['returnUrl'] = route('show_transaction_detail', $reference);
        $this->data_transaction['userAgent'] = $request->userAgent();
        $this->data_transaction['ipAddress'] = $request->ip();

    }
    public function sendCheckoutRequest()
    {
        try {
            $config = config('placetopay.auth');
            $placetopay = new PlacetoPay($config);
            //metodo request de paquete dntix
            $response = $placetopay->request($this->data_transaction);

            if ($response->isSuccessful()) {

                $this->create_transaction($response); //creo la transaccion en mi sistema

                return $response->processUrl(); //retorna url

            } else {
                // There was some error so check the message
                $response->status()->message();

                return false;
            }
        } catch (Exception $e) {
            var_dump($e->getMessage());
        }

        return false;

    }

    public function create_transaction($p2p_transaction_result)
    {
        $req_id=$p2p_transaction_result->requestId();

        $trasaction=new Transaction;
        $trasaction->transaction_id=$req_id;
        $trasaction->reference=$this->data_transaction['payment']['reference'];
        $trasaction->date=date("Y-m-d H:i:s");
        $trasaction->description = $this->data_transaction['payment']['description'];
        $trasaction->user_id=session('user_id');
        $trasaction->status="PENDING";
        
        $trasaction->save();
    }

}
