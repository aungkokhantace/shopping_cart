<?php

namespace App\Http\Controllers;

use Session;
use App\Models\Item;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\ItemEditRequest;
use App\Http\Requests\ItemEntryRequest;
use App\Repositories\Item\ItemRepositoryInterface;

class ItemController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ItemRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* retrieve the records and return to list view */
        $items = $this->repo->getObjs();
        return view('item.index')->with('items', $items);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /* display create form */
        return view('item.item');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ItemEntryRequest $request)
    {
        /* store a new record */

        //get validated input
        $name   = (Input::has('name')) ? Input::get('name') : NULL;
        $price  = (Input::has('price')) ? Input::get('price') : 0.0;

        //create object
        $paramObj         = new Item();
        $paramObj->name   = $name;
        $paramObj->price  = $price;

        // save the object using repository
        $result = $this->repo->create($paramObj);

        return redirect()->action('ItemController@index')->with('status', $result['statusMessage']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        /* retrieve the object by id and display edit form */
        $item = $this->repo->getObjByID($id);
        return view('item.item')->with('item', $item);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        /* update the specified object */
        //get validated input
        $name     = (Input::has('name')) ? Input::get('name') : NULL;
        $price    = (Input::has('price')) ? Input::get('price') : 0.0;

        // get object by ID
        $paramObj = $this->repo->getObjByID($id);
        $paramObj->name   = $name;
        $paramObj->price  = $price;

        // save the object using repository
        $result = $this->repo->update($paramObj);

        return redirect()->action('ItemController@index')->with('status', $result['statusMessage']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /* destroy the specified object */
        // destroy the model using repository
        $result = $this->repo->destroy($id);

        return redirect()->action('ItemController@index')->with('status', $result['statusMessage']);
    }
}
