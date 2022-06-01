<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{

    public function index() {
        $users = User::all();
        return response()->json($users);
    }

    public function store(Request $request) {
        $user = $request->all();
        $password = $request->input('password');
        $user['password'] = bcrypt($password);
        User::create($user);
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
