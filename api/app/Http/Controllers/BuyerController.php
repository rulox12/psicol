<?php

namespace App\Http\Controllers;

use App\Domain\Buyers\CreateOrUpdateBuyerAction;
use App\Http\Requests\StoreBuyerRequest;
use App\Http\Resources\BuyerResource;
use App\Models\Buyer;
use Illuminate\Http\JsonResponse;

class BuyerController extends BaseController
{
    public function index(): JsonResponse
    {
        $buyers = Buyer::forIndex()->paginate();

        return $this->successResponse(BuyerResource::collection($buyers));
    }

    public function store(StoreBuyerRequest $request): JsonResponse
    {
        $buyer = CreateOrUpdateBuyerAction::execute($request, new Buyer());

        return $this->successResponse(new BuyerResource($buyer));
    }
}
