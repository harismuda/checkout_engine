<?php

namespace App\Http\Controllers;

use App\Actions\CheckoutAction;
use App\Http\Requests\CheckoutRequest;
use Illuminate\Http\JsonResponse;

class CheckoutController extends Controller
{
    /**
     * SRP Rule: Controller HANYA bertugas menerima HTTP Request,
     * menyuruh CheckoutAction mengeksekusi logika bisnis,
     * dan mengembalikan HTTP JSON Response.
     */
    public function __invoke(CheckoutRequest $request, CheckoutAction $action): JsonResponse
    {
        $result = $action->execute($request->validated());

        return response()->json([
            'status' => 'success',
            'message' => 'Checkout berhasil diproses',
            'data' => $result
        ], 201);
    }
}
