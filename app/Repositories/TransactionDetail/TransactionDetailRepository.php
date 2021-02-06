<?php

/**
 * Author: Aung Ko Khant
 * Created Date: 2019-07-01
 * Created Time: 06:26 PM
 */

namespace App\Repositories\TransactionDetail;

use Illuminate\Support\Facades\DB;
use App\Models\TransactionDetail;
use App\Core\ReturnMessage;
use App\Core\Utility;

class TransactionDetailRepository implements TransactionDetailRepositoryInterface
{
    public function getObjs()
    {
        $objs = TransactionDetail::all();
        return $objs;
    }

    public function getObjsByTransactionID($transaction_id)
    {
        $objs = TransactionDetail::where('transaction_id', $transaction_id)->get();
        return $objs;
    }

    public function getArrays()
    {
        /*
         Retrieve records as array 
         */
        $table_name = (new TransactionDetail())->getTable();
        $arr = DB::select("SELECT * FROM  $table_name WHERE deleted_at IS NULL");
        return $arr;
    }

    public function create($paramObj)
    {
        /* 
        Save the object passed in parameter 
        */

        /* initially set to internal server error, will be set to success after object is successfully saved */
        $returnObj = array();
        $returnObj['statusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;

        /* for logging purpose later */
        $currentUser = Utility::getCurrentUserID(); //get currently logged in user

        try {
            /* add created_by and updated_by value to the object, and save */
            $tempObj = Utility::addCreatedBy($paramObj);
            $tempObj->save();

            /* set status to success and return */
            $returnObj['statusCode'] = ReturnMessage::OK;
            $returnObj['statusMessage'] = "TransactionDetail is successfully created";
            return $returnObj;
        } catch (\Exception $e) {
            /* there is an exception,
            get error message and return */
            $returnObj['statusMessage'] = $e->getMessage();
            return $returnObj;
        }
    }

    public function update($paramObj)
    {
        /* 
        Update the object passed in parameter 
        */

        /* initially set to internal server error, will be set to success after object is successfully saved */
        $returnObj = array();
        $returnObj['statusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;

        /* for logging purpose later */
        $currentUser = Utility::getCurrentUserID(); //get currently logged in user

        try {
            /* add updated_by value to the object, and save */
            $tempObj = Utility::addUpdatedBy($paramObj);
            $tempObj->save();

            /* set status to success and return */
            $returnObj['statusCode'] = ReturnMessage::OK;
            $returnObj['statusMessage'] = "TransactionDetail is successfully updated";
            return $returnObj;
        } catch (\Exception $e) {
            /* there is an exception,
            get error message and return */
            $returnObj['statusMessage'] = $e->getMessage();
            return $returnObj;
        }
    }

    public function destroy($id)
    {
        /* 
        Destroy the object with id passed in parameter 
        */

        /* initially set to internal server error, will be set to success after object is successfully saved */
        $returnObj = array();
        $returnObj['statusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;

        /* for logging purpose later */
        $currentUser = Utility::getCurrentUserID(); //get currently logged in user

        try {
            /* Retrieve record and add deleted_by value */
            $tempObj = TransactionDetail::findOrFail($id);

            if (!isset($tempObj)) {
                // record not found
                $returnObj['statusMessage'] = "The requested record is not found";
            } else {
                //add deleted_by value
                $tempObj = Utility::addDeletedBy($tempObj);
                $tempObj->save();
            }

            /*  Then, softdelete the record and store the delete result */
            $delete_result = TransactionDetail::destroy($id);

            if ($delete_result > 0) {
                /* if delete_result is greater than 0, this means record is deleted,
                set statusCode to success, and return */
                $returnObj['statusCode'] = ReturnMessage::OK;
                $returnObj['statusMessage'] = "TransactionDetail is successfully deleted";
                return $returnObj;
            } else {
                /* Record is not deleted,
                return with above-predefined INTERNAL_SERVER_ERROR */
                $returnObj['statusMessage'] = "TransactionDetail is not deleted";
                return $returnObj;
            }
        } catch (\Exception $e) {
            /* If there is an exception, 
            get the error message and return */
            $returnObj['statusMessage'] = $e->getMessage();
            return $returnObj;
        }
    }

    public function getObjByID($id)
    {
        /* retrieve an object by its id */
        $result = TransactionDetail::findOrFail($id);
        return $result;
    }

    public function insertArray($array)
    {
        $result = DB::table('transaction_details')->insert($array);
        return $result;
    }
}
