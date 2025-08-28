<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Reservations;
use App\Models\Rooms;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReservationsController extends Controller
{

    public function createReservationNumber()
    {
        // RSV-TODAY-001
        $code_format = "RSV";
        $today       = Carbon::now()->format('Ymd'); //20250828
        $prefix      = $code_format . "-" . $today . "-";

        $lastReservation = Reservations::whereDate('created_at', Carbon::today())
            ->orderBy('id', 'desc')->first();

        if ($lastReservation) {
            $lastNumber = substr($lastReservation->reservation_number, -3); //rsv-0001
            // $lastNumber = $lastReservation->id; //4
            $newNumber  = str_pad($lastNumber + 1,  3, "0", STR_PAD_LEFT); //004
        } else {
            $newNumber = "001";
        }

        $reservation_number = $prefix . $newNumber;

        return $reservation_number;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = Reservations::with('room')->orderBy('id', 'desc')->get();
        $title = 'Data Reservasi';
        return view('layout.reservation.index',compact('title','datas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $reservation_number = $this->createReservationNumber();

        $categories = Categories::get();

        $title = 'Reservasi Baru';
        return view('layout.reservation.create', compact('title','categories', 'reservation_number'));
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
                'isReserve' => 'nullable|in:0,1,2',
            ]);
            $data['isReserve'] = $data['isReserve'] ?? 1;
            
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