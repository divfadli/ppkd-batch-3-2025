<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use function Pest\Laravel\json;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() //Select * from user
    {
        $users = User::get();
        return response()->json([
            'status' => true,
            'message' => 'Fetch data Success',
            'data' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Create user succes',
                'data' => $user
            ], 201);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => $th->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $user = User::findOrFail($id);
            // $user = User::where('id', $id)->first();
            return response()->json([
                'status' => true,
                'message' => 'Fetch detail data Success',
                'data' => $user,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
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
        // Status 200, 201 (Berhasil)
        // Status 401,404,403,422 (Error web)
        // Status 500 (Error database)
        // payload {column1 => $user->column1,column2 => $user->column2}
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'email' => [
                    'required',
                    'string',
                    'email',
                    Rule::unique('users', 'email')->ignore($id),
                ],
                'password' => 'nullable|min:8' // password boleh kosong saat update
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validation Fail',
                    'errors' => $validator->errors()
                ], 422);
            }
            $user = User::findOrFail($id); // 404
            // $user = User::find($id); // blank

            $user->name = $request->name;
            $user->email = $request->email;
            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }

            $user->save();

            return response()->json([
                'status' => true,
                'message' => 'User updated successfully',
                'user' => $user
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            User::findOrFail($id)->delete();

            return response()->json([
                'status' => true,
                'message' => 'Deleted User Success',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
