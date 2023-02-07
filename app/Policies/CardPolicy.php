<?php

namespace App\Policies;

use App\Models\Card;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CardPolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Card  $card
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Card $card)
    {
        return $user->id === $card->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Card  $card
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Card $card)
    {
        return $user->id === $card->user_id;
    }
}
