<?php

/**
 * Author: Aung Ko Khant
 * Created Date: 2019-07-01
 * Created Time: 06:26 PM
 */

namespace App\Repositories\Customer;

use Illuminate\Support\Facades\DB;
use App\User;
use App\Core\ReturnMessage;
use App\Core\Utility;

class CustomerRepository implements CustomerRepositoryInterface
{
    public function getObjs()
    {
        $objs = User::where('role_id', 2)->get();
        return $objs;
    }

    public function getObjByID($id)
    {
        /* retrieve an object by its id */
        $result = User::findOrFail($id);
        return $result;
    }
}
