<?php

namespace App\Http\Controllers;

use App\Models\BookingList;
use App\Models\BookedServce;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BookingListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = auth()->id();
        $userEmail = Auth::user()->email;
        // dd( $user);
        // $bookedList = DB::table('booking_lists')
        // ->join('booked_servces', 'booking_lists.id', '=', 'booked_servces.booking_lists_id')
        // ->select('booking_lists.*', 'booked_servces.*')
        // ->where('booked_servces.user_id', '=', $userId)
        // ->get();

        $bookedList = DB::table('booking_lists')
        ->select('booking_lists.*')
        ->where('email', '=', $userEmail)
        ->get();

        // dd($bookedList);

        $bookedListJson = $bookedList->toJson();

        // dd($bookedList->toArray());

        return view('user.bookedList.index', compact('bookedListJson'));
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
        $services = Service::whereIn('id', $request->services)->get();
        $userId = auth()->id();
    
        $bookingList = new BookingList();
        $bookingList->shop_id = $request->input('shop_id');
        $bookingList->vehicle_lists_id = $request->input('vehicle_list');
        $bookingList->client_name = $request->input('name');
        $bookingList->email = $request->input('email');
        $bookingList->address = $request->input('address');
        $bookingList->schedule_date = $request->input('date');
        $bookingList->total_amount = $request->input('total_price');
        $bookingList->save();
    
        foreach ($services as $service) {
            $bookedService = new BookedServce();
            $bookedService->booking_lists_id = $bookingList->id;
            $bookedService->services_id = $service->id;
            $bookedService->vehicle_lists_id = $request->input('vehicle_list');
            $bookedService->user_id = $userId;
            $bookedService->service_name = $service->service; // Get service name
            $bookedService->service_amount = $service->price; // Get service price
            $bookedService->status = 1; // replace with the actual description
            $bookedService->save();
        }
    
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
