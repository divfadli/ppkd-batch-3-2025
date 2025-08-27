<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Reservations;
use App\Models\Rooms;
use Illuminate\Http\Request;

class ReservationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = Reservations::orderByDesc('id')->get();
        $title = 'Data Reservasi';
        return view('layout.reservation.index',compact('title','datas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Categories::get();

        $title = 'Reservasi Baru';
        return view('layout.reservation.create', compact('title','categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // Output: RSV-tgl hari ini - 001
        try {
            $data = $request->validate([
                'reservation_number' => 'required',
                'total_night' => 'required',
                'guest_name' => 'required',
                'guest_email' => 'nullable|string',
                'guest_phone' => 'nullable|string',
                'guest_qty' => 'required',
                'guest_note' => 'nullable|string',
                'room_id' => 'required',
                'guest_room_number' => 'nullable|string',
                'guest_check_in' => 'required|date',
                'guest_check_out' => 'required|date|after:checkin', //after-> kondisi jika id->checkin harus sudah terisi
                'payment_method' => 'required',
                'sub_total' => 'required',
                'tax' => 'required',
                'total_amount' => 'required',
            ]);
            $create = Reservations::create($data);
            return response()->json(['status'=>'success', "message"=>"Reservasi Create Success", 'data'=>$create], 201);
        } catch (\Illuminate\Validation\ValidationException $err) {
            return response()->json(["status"=>"Error","message"=>"Validation Error", "error"=>$err->errors()],422);
        }catch(\Exception $e){
            return response()->json(["status"=> "error", "message"=>"Something went wrong", "error"=>$e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function getRoomByCategory($id){
        try {
            $rooms = Rooms::where('category_id',$id)->get();
            return response()->json(['data'=>$rooms,'message'=>'Fetch Success']);
        } catch (\Throwable $th) {
            return response()->json(['message'=>'Errorrrr', 'error' => $th->getMessage()]);
        }
    }
}