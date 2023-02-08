<?php

namespace App\Services\Card;
use App\Http\Requests\Card\StoreCardRequest;
use App\Http\Requests\Card\UpdateCardRequest;
use App\Models\Card;
use App\Models\Column;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CardService 
{
    public function index(Column $column)
    {
        return Column::where('column_id', $column->id)->get();
    }

    public function store(StoreCardRequest $request, Column $column)
    {
        $card = new Card($request->validated());

        $user = User::find(Auth::id());

        $card->user()->associate($user);

        $column->cards()->save($card);

        return $card;
    }

    public function update(UpdateCardRequest $request, Card $card)
    {
        $card->updateOrFail($request->validated());
    }

    public function destroy(Card $card)
    {
        $card->deleteOrFail();
    }
}