<?php

namespace App\Http\Controllers;

use Session;
use App\Models\Item;
use App\Core\Utility;
use App\Http\Requests;
use App\Core\ReturnMessage;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Repositories\Item\ItemRepositoryInterface;
use App\Repositories\Transaction\TransactionRepository;
use App\Repositories\Transaction\TransactionRepositoryInterface;
use App\Repositories\TransactionDetail\TransactionDetailRepository;

class TransactionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(TransactionRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function index()
    {
        /* retrieve the records and return to list view */
        $transactions = $this->repo->getObjs();

        return view('transaction.index')->with('transactions', $transactions);
    }

    public function show($id)
    {
        $transaction = $this->repo->getObjByID($id);

        $transactionDetailRepo = new TransactionDetailRepository();
        /* retrieve the records and return to list view */
        $transaction_details = $transactionDetailRepo->getObjsByTransactionID($id);

        return view('transaction.detail')
            ->with('transaction', $transaction)
            ->with('transaction_details', $transaction_details);
    }
}
