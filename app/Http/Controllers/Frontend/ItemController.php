<?php

namespace App\Http\Controllers\Frontend;

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
use App\Repositories\TransactionDetail\TransactionDetailRepository;

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

    public function index()
    {
        $cart_total_qty = 0;

        $cart = session()->get('cart');

        if (isset($cart)) {
            foreach ($cart as $id => $details) {
                $cart_total_qty += $details['quantity'];
            }
        }

        /* retrieve the records and return to list view */
        $items = $this->repo->getObjs();
        return view('frontend.item.index')->with('items', $items)->with('cart_total_qty', $cart_total_qty);
    }

    public function viewCart()
    {
        return view('frontend.item.cart');
    }

    public function addToCart($id)
    {
        $item = Item::find($id);

        if (!$item) {
            abort(404);
        }

        $cart = session()->get('cart');
        // if cart is empty then this the first item
        if (!$cart) {
            $cart = [
                $id => [
                    "name" => $item->name,
                    "quantity" => 1,
                    "price" => $item->price
                ]
            ];
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Item added to cart successfully!');
        }
        // if cart not empty then check if this item exist then increment quantity
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Item added to cart successfully!');
        }
        // if item not exist in cart then add to cart with quantity = 1
        $cart[$id] = [
            "name" => $item->name,
            "quantity" => 1,
            "price" => $item->price
        ];
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Item added to cart successfully!');
    }

    public function updateCart(Request $request)
    {
        if ($request->id and $request->quantity) {
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }
    }
    public function removeFromCart(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }
    }

    public function checkout(Request $request)
    {
        $transactionRepo        = new TransactionRepository();
        $transactionDetailRepo  = new TransactionDetailRepository();

        $cart = session()->get('cart');

        $total_amount = 0.0;

        if (!isset($cart)) {
            return redirect()->action('Frontend\ItemController@index')->with('status', 'Cart is empty');
        }

        foreach ($cart as $id => $details) {
            $total_amount += $details['price'] * $details['quantity'];
        }

        $user_id = Utility::getCurrentUserID();

        $current_timestamp_string   = date('YmdHis'); // to use as unique string in transaction code

        $transaction_date   = date('Y-m-d'); // to use as unique string in transaction code

        /* to rollback if something is wrong, commit only after all database transactions are successful. */
        DB::beginTransaction();

        //create object
        $transactionObj                     = new Transaction();
        $transactionObj->transaction_code   = $current_timestamp_string;
        $transactionObj->user_id            = $user_id;
        $transactionObj->date               = $transaction_date;
        $transactionObj->total_amount       = $total_amount;

        // save the object using repository
        $transaction_result = $transactionRepo->create($transactionObj);

        if ($transaction_result['statusCode'] !== ReturnMessage::OK) {
            DB::rollBack();
            return redirect()->action('Frontend\ItemController@index')->with('status', $transaction_result['statusMessage']);
        }

        // if transaction store is successful, continue to transaction detail

        $transaction_detail_array = array();

        foreach ($cart as $id => $details) {
            $transaction_detail_array[$id]['transaction_id'] = $transaction_result['id'];
            $transaction_detail_array[$id]['item_id'] = $id;
            $transaction_detail_array[$id]['price'] = $details['price'];
            $transaction_detail_array[$id]['qty'] = $details['quantity'];
        }

        $transaction_detail_result = $transactionDetailRepo->insertArray($transaction_detail_array);

        if ($transaction_result['statusCode'] !== ReturnMessage::OK) {
            DB::rollBack();
            return redirect()->action('Frontend\ItemController@index')->with('status', $transaction_result['statusMessage']);
        }

        // after all transactions are successful, commit DB
        DB::commit();

        session()->forget('cart'); // clear cart data

        return redirect()->action('Frontend\ItemController@index')->with('status', $transaction_result['statusMessage']);
    }
}
