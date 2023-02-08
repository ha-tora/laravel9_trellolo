<?php

namespace App\Http\Controllers\Comment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Comment\StoreCommentRequest;
use App\Http\Requests\Comment\UpdateCommentRequest;
use App\Http\Resources\Comment\CommentResource;
use App\Models\Card;
use App\Models\Comment;
use App\Services\Comment\CommentService;
use Illuminate\Support\Facades\Gate;

class CommentController extends Controller
{
    public function index(Card $card, CommentService $commentService)
    {
        $comments = $commentService->index($card);

        return CommentResource::collection($comments);
    }

    public function create()
    {
        return [
            '_token' => csrf_token()
        ];
    }

    public function store(StoreCommentRequest $request, Card $card, CommentService $commentService)
    {
        $comment = $commentService->store($request, $card);

        return new CommentResource($comment);
    }

    public function show(Comment $comment)
    {
        return new CommentResource($comment);
    }

    public function edit(Comment $comment)
    {
        Gate::authorize('update', $comment);

        return [
            '_token' => csrf_token()
        ];
    }

    public function update(UpdateCommentRequest $request, Comment $comment, CommentService $commentService)
    {
        Gate::authorize('update', $comment);

        $commentService->update($request, $comment);

        return new CommentResource($comment);
    }

    public function destroy(Comment $comment, CommentService $commentService)
    {
        $commentService->destroy($comment);

        return response()->noContent();
    }
}
