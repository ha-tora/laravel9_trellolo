<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\User\UserResource;
use App\Http\Resources\User\UserShortResource;
use App\Models\User;
use App\Services\User\UserService;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function index(UserService $userService)
    {
        $users = $userService->index();

        return UserShortResource::collection($users);
    }

    public function show(User $user)
    {
        return new UserResource($user);
    }

    public function edit(User $user)
    {
        Gate::authorize('update', $user);

        return [
            "_token" => csrf_token(),
        ];
    }

    public function update(UpdateUserRequest $request, User $user, UserService $userService)
    {
        Gate::authorize('update', $user);

        $userService->update($request, $user);

        return new UserResource($user);
    }

    public function destroy(User $user, UserService $userService)
    {
        Gate::authorize('delete', $user);

        $userService->destroy($user);

        return response()->noContent();
    }
}
