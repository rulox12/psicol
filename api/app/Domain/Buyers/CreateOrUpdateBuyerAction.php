<?php

namespace App\Domain\Buyers;

use App\Models\Buyer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CreateOrUpdateBuyerAction
{
    public static function execute(Request $request, Buyer $buyer): Buyer
    {
        $buyer->name = $request->input('name');
        $buyer->surname = $request->input('surname');
        $buyer->email = $request->input('email');
        $buyer->mobile = $request->input('mobile');
        $buyer->created_by = Auth::user()->id;

        $buyer->save();

        return $buyer;
    }
}
