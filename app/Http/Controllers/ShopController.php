<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shops;
use App\Models\User;
use App\Models\VehicleList;
use App\Notifications\ShopApproved;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Hash;

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
        $updated = $shops->update([
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

        if($updated == true){
            Notification::route('mail', $request->input('email'))
            ->notify(new ShopApproved($request->input('status')));
        }

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
        $usersAndShops = DB::table('users')
        ->join('shops', 'users.id', '=', 'shops.users_id')
        ->select('users_id')
        ->where('shops.id', '=', $id)
        ->get();
        $user = User::find($usersAndShops[0]->users_id);
        $user->delete();

        return redirect()->back()->with('message', 'Shops Deleted Successfully.');
    }



///////////////////////////////////////////////////////////////////////////////////////////////////// FUNCTION FOR ADMIN///////////////////////////////////////////////////////////////////////////////////// ///////////////////////// 

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

    public function myShopUpdate(Request $request, Shops $shops, User $user, $id)
    {
        $shops = Shops::findOrFail($id);
        $shops->update([
            'shop_name' => $request->input('shop_name'),
            'address' => $request->input('address'),
        ]);
    
        $user = User::findOrFail($request->users_id);
        $user->update([
            'email' => $request->input('email'),
            'name' => $request->input('name'),
        ]);
    
        return redirect()->back()->with('message', 'Shops Updated successfully.');
    }


///////////////////////////////////////////////////////////////////////////////////////////////////// FUNCTION FOR USER///////////////////////////////////////////////////////////////////////////////////// ///////////////////////// 

    public function userShop()
    {
        // $user = auth()->user();
        $userId = auth()->id();
        $usersAndShops = DB::table('users')
                        ->join('shops', 'users.id', '=', 'shops.users_id')
                        ->select('users.*', 'shops.*')
                        ->where('shops.status', '=', 1)
                        ->where('users.active', '=', 1)
                        ->get();
        
        // dd($usersAndShops);
        return view('user.shop.index', compact('usersAndShops'));
    }

    public function userShopView($id)
    {
        $user = auth()->user();
        $userId = auth()->id();
        $usersAndShops = DB::table('users')
                        ->join('shops', 'users.id', '=', 'shops.users_id')
                        ->select('users.*', 'shops.*')
                        ->where('shops.status', '=', 1)
                        ->where('users.active', '=', 1)
                        ->where('shops.id', '=', $id)
                        ->get();
        $services = DB::table('services')
                        ->join('shops', 'services.shop_id', '=', 'shops.id')
                        ->join('service_lists', 'services.service_list_id', '=', 'service_lists.id')
                        ->join('vehicle_lists', 'services.vehicle_lists_id', '=', 'vehicle_lists.id')
                        ->select('shops.*', 'service_lists.*', 'vehicle_lists.*', 'services.*')
                        ->where('shops.id', '=', $id)
                        ->get();
        $vehicle_lists = VehicleList::all();
        
        // dd($vehicle_lists->toArray());
        return view('user.shop.view', compact('usersAndShops', 'vehicle_lists', 'user'));
    }

    public function changeLogo(Request $request, Shops $shop) {
        $shop->update([
            'logo' => $request->logo->getClientOriginalName()
        ]);

        $fileNameImage = $request->logo->getClientOriginalName();
        $filePathImage = 'storage/images/' . $fileNameImage;
        $request->logo->move(public_path('storage/images/'), $fileNameImage);
        return redirect()->back()->with('updateImg', 'Your Logo Image Update Successfully');
    }
}