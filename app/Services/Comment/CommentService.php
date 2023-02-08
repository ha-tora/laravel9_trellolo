<?php

namespace App\Services\Comment;
use App\Http\Requests\Comment\StoreCommentRequest;
use App\Http\Requests\Comment\UpdateCommentRequest;
use App\Models\Card;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CommentService
{
    public function index(Card $card)
    {
        return Comment::query()->where('card_id', $card->id)->paginate(5);
    }

    public function store(StoreCommentRequest $request, Card $card)
    {
        $comment = new Comment($request->validated());

        $user = User::find(Auth::id());

        $comment->user()->associate($user);

        $card->comments()->save($comment);

        return $comment;
    }

    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        $comment->updateOrFail($request->validated());
    }

    public function destroy(Comment $comment)
    {
        $comment->deleteOrFail();
    }
}