<?php

namespace App\Services\Column;

use App\Http\Requests\Column\StoreColumnRequest;
use App\Http\Requests\Column\UpdateColumnRequest;
use App\Models\Column;
use App\Models\User;

class ColumnService
{
    public function index(User $user)
    {
        return Column::where('user_id', $user->id)->get();
    }

    public function store(StoreColumnRequest $request, User $user)
    {
        $column = $user->columns()->create($request->validated());

        return $column;
    }

    public function update(UpdateColumnRequest $request, Column $column)
    {
        $column->updateOrFail($request->validated());
    }

    public function destroy(Column $column)
    {
        $column->deleteOrFail();
    }
}