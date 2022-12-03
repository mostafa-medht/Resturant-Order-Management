<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShowOrderRequest;
use App\Http\Requests\ShowProductRequest;
use App\Http\Requests\StoreOrderRequest;
use App\Services\OrderServices;
use App\Services\ProductServices;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * @param OrderServices $orderServices
     */
    public function __construct(private OrderServices $orderServices){}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return $this->orderServices->getAllOrders();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreOrderRequest $request
     * @return JsonResponse
     */
    public function store(StoreOrderRequest $request)
    {
        return $this->orderServices->storeOrder($request->validated(), new ProductServices());
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function show(ShowOrderRequest $request)
    {
        return $this->orderServices->showOrder($request->validated());
    }

}
