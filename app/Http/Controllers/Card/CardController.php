<?php

namespace App\Http\Controllers\Card;

use App\Http\Controllers\Controller;
use App\Http\Requests\Card\StoreCardRequest;
use App\Http\Requests\Card\UpdateCardRequest;
use App\Http\Resources\Card\CardResource;
use App\Http\Resources\Card\CardShortResource;
use App\Models\Card;
use App\Models\Column;
use App\Services\Card\CardService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class CardController extends Controller
{
    public function index(Column $column, CardService $cardService)
    {
        $cards = $cardService->index($column);

        return CardShortResource::collection($cards);
    }

    public function create()
    {
        return [
            '_token' => csrf_token()
        ];
    }

    public function store(StoreCardRequest $request, CardService $cardService, Column $column)
    {
        $card = $cardService->store($request, $column);

        return new CardResource($card);
    }

    public function show(Card $card)
    {
        return new CardResource($card);
    }

    public function edit(Card $card)
    {
        Gate::authorize('update', $card);

        return [
            '_token' => csrf_token()
        ];
    }

    public function update(UpdateCardRequest $request, Card $card, CardService $cardService)
    {
        Gate::authorize('update', $card);

        $cardService->update($request, $card);

        return new CardResource($card);
    }

    public function destroy(Card $card, CardService $cardService)
    {
        Gate::authorize('delete', $card);

        $cardService->destroy($card);

        return response()->noContent();
    }
}
