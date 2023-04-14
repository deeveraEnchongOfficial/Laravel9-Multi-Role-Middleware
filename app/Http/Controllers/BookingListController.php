<?php

namespace App\Http\Controllers;

use App\Models\BookingList;
use App\Models\BookedServce;
use Illuminate\Http\Request;

class BookingListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        dd($request->toArray());
        // $userId = auth()->id();
        // $usersAndShops = DB::table('users')
        //                 ->join('shops', 'users.id', '=', 'shops.users_id')
        //                 ->select('shops.id')
        //                 ->where('users.id', '=', $userId)
        //                 ->get();
        //  dd($usersAndShops[0]->id);               
        // $data = $request->all();
        // $data['shop_id'] = $usersAndShops[0]->id; // Set the default value for vehicle_type
        // $service = Service::create($data);
        // dd($request->toArray());
        // $service = Service::create($request->all());

        // $example = new ExampleModel();
        // $example->name = $request->input('name');
        // $example->description = $request->input('description');
        // $example->save();

        $booking_lists = new BookingList();
        $booking_lists->shop_id = $request->input('shop_id');
        $booking_lists->vehicle_lists_id = $request->input('vehicle_list');
        $booking_lists->client_name = $request->input('name');
        $booking_lists->email = $request->input('email');
        $booking_lists->address = $request->input('address');
        $booking_lists->schedule_date = $request->input('date');
        $booking_lists->total_amount = $request->input('total_price');
        $booking_lists->save();

        $booked_service = new BookedServce();


        return redirect()->back()->with('message', 'Booked Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BookingList  $bookingList
     * @return \Illuminate\Http\Response
     */
    public function show(BookingList $bookingList)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BookingList  $bookingList
     * @return \Illuminate\Http\Response
     */
    public function edit(BookingList $bookingList)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BookingList  $bookingList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BookingList $bookingList)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BookingList  $bookingList
     * @return \Illuminate\Http\Response
     */
    public function destroy(BookingList $bookingList)
    {
        //
    }
}
