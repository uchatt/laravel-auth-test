<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('/login')->group(function () {
    Route::get('/', function () {
        return response()->json("Welcome to Login get method.");
    });
    Route::post('/', function () {
        return response()->json("Welcome to Login post method.");
    });
});

Route::prefix('/admin')->group(function () {

    Route::get('/users', function () {

        $filters = [
            'verification_status',
            'active'
        ];

        $all = request()->all();
        if (request()->has($filters[0]) && request()->has($filters[1])) {
            return response()->json([
                "status" => "success",
                "users" => User::all()
                    ->where($filters[0], $all[$filters[0]])
                    ->where($filters[1], $all[$filters[1]])
            ]);
        }
        return response()->json([
            "status" => "success",
            "data" => User::all()
        ]);
    });

    Route::post('/approve', function () {
        $user_inputs = request()->all();

        $temp_user = User::find($user_inputs['id']);
        if ($temp_user) {
            $temp_user->verification_status = $user_inputs['verification_status'];
            $temp_user->active = $user_inputs['active'];
            $temp_user->mem_id = 'CAC-' . $user_inputs['mem_id'];
            $temp_user->updated_at = Carbon::now();
            $temp_user->save();
        } else {
            return response()->json([
                'error' => 'true',
                'msg' => "User Not Found."
            ]);
        }

        return response()->json(User::find($temp_user['id']));
    });
});
