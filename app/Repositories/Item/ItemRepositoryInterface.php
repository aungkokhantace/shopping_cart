<?php

namespace App\Repositories\Item;

interface ItemRepositoryInterface
{
    public function getObjs();
    public function create($paramObj);
    public function update($paramObj);
    public function getObjByID($id);
    public function destroy($id);
    public function getArrays();
}
