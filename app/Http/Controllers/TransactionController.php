<?php

namespace App\Http\Controllers;

use App\Transaction;
use App\User;
use Dnetix\Redirection\PlacetoPay;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::orderBy('response_date', 'DESC')->paginate(5);
        return view("transactions.index", compact('transactions'));
    }
    public function show(Request $request, $reference)
    {
        if ($reference) {
            $transaction = Transaction::where('reference', '=', $reference)->first();
            if ($transaction) {

                $user_transaction = User::find($transaction->user_id);

                $response = $this->get_transaction_status($transaction->transaction_id);

                if ($response->isSuccessful()) {

                    $payment = $response->payment();

                    $response_date = new \DateTime($payment[0]->status()->date());
                    // Actualizo la transaccion despues de consultar el estado
                    $transaction->amount = $payment[0]->amount()->to()->total();
                    $transaction->status = $payment[0]->status()->status();
                    $transaction->response_date = $response_date->format('Y-m-d H:i:s');
                    $transaction->response_message = $payment[0]->status()->message();
                    $transaction->response_reason = $payment[0]->status()->reason();
                    $transaction->response_authorization = $payment[0]->authorization();

                    $transaction->save();

                    switch ($transaction->status) {
                        case 'APPROVED':
                            $class = 'label label-success';
                            break;
                        case 'PENDING':
                            $class = 'label label-info';
                            break;
                        case '':
                            $class = '';
                            break;
                        default:
                            $class = 'label label-danger';
                            break;
                    }
                    $transaction->class_status = $class;
                    $transaction->franquicia = $payment[0]->paymentMethodName();
                    $transaction->banco = $payment[0]->issuerName();
                    $transaction->receipt = $payment[0]->receipt();
                    $transaction->ip_address = $response->request()->ipAddress();

                    //return $transaction;
                    return view('transactions.show', compact('transaction', 'user_transaction'));

                } else {
                    // There was some error with the connection so check the message
                    print_r($response->status()->message() . "\n");
                }
            }
        }
    }
    public function get_transaction_status($transaction_id)
    {
        $config = config('placetopay.auth');
        $placetopay = new PlacetoPay($config);

        $transaction = $placetopay->query($transaction_id);

        return $transaction;
    }
}
