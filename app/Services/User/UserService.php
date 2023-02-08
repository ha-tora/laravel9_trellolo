<?php

namespace App\Services\User;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;

class UserService 
{
    public function index()
    {
        return User::paginate(5);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->validated());
    }

    public function destroy(User $user)
    {
        $user->deleteOrFail();
    }
}