<?php

namespace App\Http\Controllers\Column;

use App\Http\Controllers\Controller;
use App\Http\Requests\Column\StoreColumnRequest;
use App\Http\Requests\Column\UpdateColumnRequest;
use App\Http\Resources\Column\ColumnResource;
use App\Models\Column;
use App\Models\User;
use App\Services\Column\ColumnService;
use Illuminate\Support\Facades\Gate;

class ColumnController extends Controller
{
    public function index(User $user, ColumnService $columnService)
    {
        $columns = $columnService->index($user);

        return ColumnResource::collection($columns);
    }

    public function create(User $user)
    {
        Gate::authorize('update', $user);

        return [
            '_token' => csrf_token()
        ];
    }

    public function store(User $user, StoreColumnRequest $request, ColumnService $columnService)
    {
        Gate::authorize('update', $user);

        $column = $columnService->store($request, $user);

        return new ColumnResource($column);
    }

    public function show(Column $column)
    {
        return new ColumnResource($column);
    }

    public function edit(Column $column)
    {
        Gate::authorize('update', $column);

        return [
            '_token' => csrf_token()
        ];
    }

    public function update(UpdateColumnRequest $request, Column $column, ColumnService $columnService)
    {
        Gate::authorize('update', $column);

        $columnService->update($request, $column);

        return new ColumnResource($column);
    }
    
    public function destroy(Column $column, ColumnService $columnService)
    {
        Gate::authorize('delete', $column);

        $columnService->destroy($column);

        return response()->noContent();
    }
}
