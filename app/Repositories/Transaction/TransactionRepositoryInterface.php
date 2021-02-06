<?php

namespace App\Repositories\Transaction;

interface TransactionRepositoryInterface
{
    public function getObjs();
    public function getObjsByUserID($user_id);
    public function create($paramObj);
    public function update($paramObj);
    public function getObjByID($id);
    public function destroy($id);
    public function getArrays();
}
