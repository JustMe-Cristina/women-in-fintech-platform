<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class SuccessStoryController extends Controller
{
    // Pagina separată cu poveștile unui membru + form add
    public function index(Member $member)
    {
        $stories = $member->successStories()->latest()->paginate(10);
        return view('stories.index', compact('member', 'stories'));
    }

    // Adaugă o poveste nouă pentru membrul selectat
    public function store(Request $request, Member $member)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'story' => ['required', 'string'],
        ]);

        $member->successStories()->create($data);

        return redirect()
            ->route('stories.index', $member->id)
            ->with('success', 'Success story added!');
    }

    // Șterge o poveste (opțional, dar util)
    public function destroy(Member $member, $storyId)
    {
        $story = $member->successStories()->findOrFail($storyId);
        $story->delete();

        return redirect()
            ->route('stories.index', $member->id)
            ->with('success', 'Story deleted!');
    }
}
