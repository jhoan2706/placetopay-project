<?php

namespace App\Console\Commands;

use App\Http\Controllers\TransactionController;
use App\Transaction;
use Illuminate\Console\Command;
use Dnetix\Redirection\PlacetoPay;

class CheckPendingTransactions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'CheckPendingTransactions:cronjob';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'All transaction states checked!';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $config = config('placetopay.auth');
        $placetopay = new PlacetoPay($config);

        $transactions = Transaction::where(function ($query) {$query->where('status', 'PENDING')->orWhereNull('status');})->whereRaw('TIMESTAMPDIFF(MINUTE, created_at, "' . now() . '") > 7')->get();

        foreach ($transactions as $transaction) {

            $transaction_info = $placetopay->query($transaction->transaction_id);

            $payment = $transaction_info->payment();

            $response_date = new \DateTime($payment[0]->status()->date());

            $transaction->status = $payment[0]->status()->status();
            $transaction->response_date = $response_date->format('Y-m-d H:i:s');
            $transaction->response_message = $payment[0]->status()->message();
            $transaction->response_reason = $payment[0]->status()->reason();
            $transaction->response_authorization = $payment[0]->authorization();

            $transaction->save();
        }
        $this->info('All transaction states checked!');
    }
}
