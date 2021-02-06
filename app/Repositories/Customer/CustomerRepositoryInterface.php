<?php

namespace App\Repositories\Customer;

interface CustomerRepositoryInterface
{
    public function getObjs();
    public function getObjByID($id);
}
