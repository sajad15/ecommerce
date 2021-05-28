<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Models\UserDetail;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(Request $request)
    {
        $user = $request->user();
        $detail = $user->userDetail;

        return response(['user' => $user]);
    }

    public function add(Request $request)
    {
        $userId = $request->user()->id;

        $detail = new UserDetail();
        $detail->address = $request->address;
        $detail->phone = $request->phone;
        $detail->image_link = $request->image_link;
        $detail->user_id = $userId;
        $detail->save();

        return response (['success' => true]);
    }

    public function update(Request $request)
    {
        $userId = $request->user()->id;
        $detail = UserDetail::where('user_id', $userId)->first();

        if(isset($request->address)){
            $detail->address = $request->address;
        }

        if (isset($request->phone)){
            $detail->phone = $request->phone;
        }
        $detail->save();

        return response(['Update Success' => true]);
    }
}
