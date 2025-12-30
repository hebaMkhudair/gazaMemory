<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Story;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Store a newly created comment in storage.
     */
    public function store(Request $request, Story $story): RedirectResponse
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $story->comments()->create([
            'user_id' => Auth::id(),
            'content' => $request->input('content'),
        ]);

        return redirect()->route('stories.show', $story->slug)
            ->with('success', 'تم إضافة التعليق بنجاح!');
    }

    /**
     * Delete a comment.
     */
    public function destroy(Comment $comment): RedirectResponse
    {
        $storySlug = $comment->story->slug;

        if (Auth::id() !== $comment->user_id && Auth::id() !== $comment->story->user_id) {
            abort(403, 'Unauthorized action.');
        }

        $comment->delete();

        return redirect()->route('stories.show', $storySlug)
            ->with('success', 'تم حذف التعليق بنجاح!');
    }
}
