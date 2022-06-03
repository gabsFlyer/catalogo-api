<?php
namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;

class UserService extends Service
{
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'phone' => 'required',
            'email' => 'required|unique:users|',
            'password' => 'required',
        ]);

        $user = $request->all();
        $password = $request->input('password');
        $user['password'] = bcrypt($password);

        try {
            $return = User::create($user);
            return response()->json($return, 201);
        }
        catch (\Illuminate\Database\QueryException $e) {
            $error = array(
                "message" => "error saving user - " . $e->getMessage(),
            );

            if ($this->getUniqueValidationError($e)) {
                $field = $this->getUniqueValidationError($e);
                $error['message'] = "$field already taken";

                return response()->json($error, 400);
            }

            return response()->json($error, 400);
        }
    }
}
