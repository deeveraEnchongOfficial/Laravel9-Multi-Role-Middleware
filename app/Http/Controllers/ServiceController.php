<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
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
        $userId = auth()->id();
        $services = DB::table('services')
                        ->join('shops', 'services.shop_id', '=', 'shops.id')
                        ->join('service_lists', 'services.service_list_id', '=', 'service_lists.id')
                        ->join('vehicle_lists', 'services.vehicle_lists_id', '=', 'vehicle_lists.id')
                        ->select('services.*', 'shops.*', 'service_lists.*', 'vehicle_lists.*')
                        ->where('shops.users_id', '=', $userId)
                        ->get();
        // dd( $services->toArray());
        return view('admin.services.index', compact('services'));
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
        $service = Service::create($request->all());
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
    public function update(Request $request, Service $service)
    {
        $service->update($request->all());
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
        $service->delete();
        return redirect()->back()->with('message', 'Service Deleted Successfully.');
    }
}
