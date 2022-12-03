<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShowProductRequest;
use App\Http\Requests\StoreProductRequest;
use App\Services\ProductServices;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    /**
     * @param ProductServices $productServices
     */
    public function __construct(private ProductServices $productServices){}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return $this->productServices->getAllProducts();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreProductRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreProductRequest $request)
    {
        return $this->productServices->storeProduct($request->validated());
    }

    /**
     * Display the specified resource.
     *
     * @param ShowProductRequest $request
     * @return JsonResponse
     */
    public function show(ShowProductRequest $request)
    {
        return $this->productServices->showProduct($request->validated());
    }
}
