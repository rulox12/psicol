<?php

namespace App\Domain\Authentications;

use App\Models\Buyer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CreateOrUpdateAuthenticationAction
{
    public static function execute(Request $request, User $user): User
    {
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));

        $user->save();

        return $user;
    }
}
