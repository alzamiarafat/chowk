<?php

namespace App\Http\Controllers;

use App\Models\CustomOrder;
use Illuminate\Http\Request;
use App\User;
use App\Order;
Use App\Restorant;
use App\Categories;
use App\Items;
use Illuminate\Support\Facades\DB;

class CustomOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*return view('custom_order.create', [
            'users' => User::role('client')->where(['active'=>1])->paginate(15),

        ]);*/
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->hasRole('admin')) {
            return view('custom_order.create', [
                    'users' => User::role('client')->where(['active'=>1])->get(),
                    'restaurants' => Restorant::get(),

                ]
            );
        } else {
            return redirect()->back()->withStatus(__('Permission Denied'));
        }
        /*return view('custom_order.create');*/
    }



  /* public function getProductByCategory(Request $request){

        $category_id = $request->category->id;
        $category = Categories::finOrFail($category_id);
        $item_id = $category->restorant_id;
        $item_name = Items::find($item_id);
        $html = '<option value="' . $item_name->id . '">' . $item_name->name . '</option>';
        echo $html;
        exit;

    }*/


   /* public function customers(Request $request){
        return User::all();
    }*/


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CustomOrder  $customOrder
     * @return \Illuminate\Http\Response
     */
    public function show(CustomOrder $customOrder)
    {
        //
    }

    public function getById(Request $request){

        $userId = $request->get('id');
        $result = User::where(['id'=>$userId])->first();
        return response()->json(['data'=>$result]);

    }

    public function getItem($id){
        $result = Items::where(['id'=>$id])->first();
        return response()->json(['data'=>$result]);




    }

    function getProduct(Request $request){

        $productId = $request->get('id');

        $product = DB::table('restorants')
            ->join('categories', 'categories.restorant_id', '=', 'restorants.id')
            ->join('items', 'items.category_id', '=', 'categories.id')
            ->select('items.*','items.name','items.price')
            ->where('restorants.id','=', $productId)
            ->get();

        return response()->json($product);
    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CustomOrder  $customOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(CustomOrder $customOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CustomOrder  $customOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CustomOrder $customOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CustomOrder  $customOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustomOrder $customOrder)
    {
        //
    }
}
