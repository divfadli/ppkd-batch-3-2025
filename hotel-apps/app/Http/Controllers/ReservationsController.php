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
        //
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