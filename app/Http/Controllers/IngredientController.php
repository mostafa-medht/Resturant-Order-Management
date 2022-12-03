<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChargeIngredientRequest;
use App\Http\Requests\ShowIngredientRequest;
use App\Http\Requests\StoreIngredientRequest;
use App\Models\Ingredient;
use App\Services\IngredientServices;
use App\Traits\StandardRessponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class IngredientController extends Controller
{

    /**
     * @param IngredientServices $ingredientService
     */
    public function __construct(private IngredientServices $ingredientService){}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->ingredientService->getAllIngredients();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreIngredientRequest $request
     * @return JsonResponse
     */
    public function store(StoreIngredientRequest $request): JsonResponse
    {
        return $this->ingredientService->storeIngrdient($request->validated());
    }

    /**
     * Display the specified resource.
     *
     * @param ShowIngredientRequest $request
     * @return JsonResponse
     */
    public function show(ShowIngredientRequest $request): JsonResponse
    {
        return $this->ingredientService->showIngredint($request->validated());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ChargeIngredientRequest $request
     * @return void|null
     */
    public function chargeIngredient(ChargeIngredientRequest $request): JsonResponse
    {
        return $this->ingredientService->chargeIngredint($request->validated());
    }

}
