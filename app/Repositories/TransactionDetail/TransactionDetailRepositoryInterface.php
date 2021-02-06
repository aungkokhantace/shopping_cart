<?php

namespace App\Repositories\TransactionDetail;

interface TransactionDetailRepositoryInterface
{
    public function getObjs();
    public function getObjsByTransactionID($transaction_id);
    public function create($paramObj);
    public function update($paramObj);
    public function getObjByID($id);
    public function destroy($id);
    public function getArrays();
}
