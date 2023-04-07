<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shops;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usersAndShops = DB::table('users')
                        ->join('shops', 'users.id', '=', 'shops.users_id')
                        ->select('users.*', 'shops.*')
                        ->get();
        return view('superadmin.shop.index', compact('usersAndShops'));
    }

    public function myShop()
    {
        // $user = auth()->user();
        $userId = auth()->id();
        $usersAndShops = DB::table('users')
                        ->join('shops', 'users.id', '=', 'shops.users_id')
                        ->select('users.*', 'shops.*')
                        ->where('users.id', '=', $userId)
                        ->get();
        
        // dd($usersAndShops);
        return view('admin.shop.index', compact('usersAndShops'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $shops = Shops::create($request->all());
        return redirect()->back()->with('message', 'Shop Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $usersAndShops = DB::table('users')
        ->join('shops', 'users.id', '=', 'shops.users_id')
        ->select('users.*', 'shops.*')
        ->where('shops.id', '=', $id)
        ->get();

        return view('superadmin.shop.view', compact('usersAndShops'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $usersAndShops = DB::table('users')
        ->join('shops', 'users.id', '=', 'shops.users_id')
        ->select('users.*', 'shops.*')
        ->where('shops.id', '=', $id)
        ->get();
        return view('superadmin.shop.edit', compact('usersAndShops', 'id'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shops $shops, User $user, $id)
    {
        $shops = Shops::findOrFail($id);
        $shops->update([
            'shop_name' => $request->input('shop_name'),
            'status' => $request->input('status'),
            'address' => $request->input('address'),
        ]);
    
        $user = User::findOrFail($request->users_id);
        $user->update([
            'email' => $request->input('email'),
            'name' => $request->input('name'),
            'active' => $request->input('status'),
        ]);
    
        return redirect()->back()->with('message', 'Shops Updated successfully.');
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shops $shops, User $user, $id)
    {
        // $user = User::findOrFail($request->users_id);

        $usersAndShops = DB::table('users')
        ->join('shops', 'users.id', '=', 'shops.users_id')
        ->select('users_id')
        ->where('shops.id', '=', $id)
        ->get();
        $user = User::find($usersAndShops[0]->users_id);
        $user->delete();

        // $shops = Shops::find($id);
        // // dd($shops);
        // $shops->delete();
        return redirect()->back()->with('message', 'Shops Deleted Successfully.');
    }
}
