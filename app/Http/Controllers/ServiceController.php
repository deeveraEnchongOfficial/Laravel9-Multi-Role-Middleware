<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\ServiceList;
use App\Models\VehicleList;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    // +"id": 1
    // +"shop_id": 1
    // +"service_list_id": 1
    // +"vehicle_lists_id": 1
    // +"service": "Wash"
    // +"price": 1000
    // +"created_at": "2023-04-08 11:45:17"
    // +"updated_at": "2023-04-08 11:45:17"
    // +"shop_name": "shopName"
    // +"user_role_id": 2
    // +"users_id": 4
    // +"status": 1
    // +"logo": "default.png"
    // +"address": "dagups"
    // +"vehicle_type": "2 Wheeler"
        $vehicleLists = VehicleList::all();
        $serviceLists = ServiceList::all();
        $userId = auth()->id();
        $services = DB::table('services')
                        ->join('shops', 'services.shop_id', '=', 'shops.id')
                        ->join('service_lists', 'services.service_list_id', '=', 'service_lists.id')
                        ->join('vehicle_lists', 'services.vehicle_lists_id', '=', 'vehicle_lists.id')
                        ->select('shops.*', 'service_lists.*', 'vehicle_lists.*', 'services.*')
                        ->where('shops.users_id', '=', $userId)
                        ->get();
        // dd( $services->toArray());
        return view('admin.services.index', compact('services','vehicleLists', 'serviceLists'));
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
        $userId = auth()->id();
        $usersAndShops = DB::table('users')
                        ->join('shops', 'users.id', '=', 'shops.users_id')
                        ->select('shops.id')
                        ->where('users.id', '=', $userId)
                        ->get();
        //  dd($usersAndShops[0]->id);               
        $data = $request->all();
        $data['shop_id'] = $usersAndShops[0]->id; // Set the default value for vehicle_type
        $service = Service::create($data);
        // dd($request->toArray());
        // $service = Service::create($request->all());
        return redirect()->back()->with('message', 'Service Created Successfully.');
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
        //
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
        $userId = auth()->id();
        $getShopID = DB::table('users')
                        ->join('shops', 'users.id', '=', 'shops.users_id')
                        ->select('shops.id')
                        ->where('users.id', '=', $userId)
                        ->get();
        //  dd($getShopID[0]->id); 
        // $data = $request->all();
        // $data['shop_id'] = $getShopID[0]->id;
        $service = Service::findOrFail($id);
        // dd($request->toArray());
        $service->update([
            'shop_id' => $getShopID[0]->id,
            'service_list_id' => $request->input('service_list_id'),
            'vehicle_lists_id' => $request->input('vehicle_lists_id'),
            'service' => $request->input('service'),
            'price' => $request->input('price'),
        ]);
        // dd($service->id);
        // $service->update($request->all());
        return redirect()->back()->with('message', 'Service Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        // dd($service->toArray());
        $service->delete();
        return redirect()->back()->with('message', 'Service Deleted Successfully.');
    }

    public function getServices(Request $request)
    {

        // $vehicle_id = $request->input('vehicle_id');
        // $services = Service::where('vehicle_id', $vehicle_id)->pluck('name', 'id');

        $vehicle_lists_id = $request->input('vehicle_lists_id');
        $serviceLists = Service::where('vehicle_lists_id', $vehicle_lists_id)->get();
        // $serviceLists = ServiceList::all();

        return response()->json($serviceLists);
    }

    // public function processServices(Request $request)
    // {
    //     dd($request->toArray());
    //     // $userId = auth()->id();
    //     // $usersAndShops = DB::table('users')
    //     //                 ->join('shops', 'users.id', '=', 'shops.users_id')
    //     //                 ->select('shops.id')
    //     //                 ->where('users.id', '=', $userId)
    //     //                 ->get();
    //     //  dd($usersAndShops[0]->id);               
    //     // $data = $request->all();
    //     // $data['shop_id'] = $usersAndShops[0]->id; // Set the default value for vehicle_type
    //     // $service = Service::create($data);
    //     // dd($request->toArray());
    //     // $service = Service::create($request->all());
    //     return redirect()->back()->with('message', 'Service Created Successfully.');
    // }
}
