<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::has('comments')->get();
        return view('admin.comments.all', compact('users'));
    }

    public function all(User $user)
    {
        $comments = $user->comments()->latest()->get();
        return view('admin.comments.user-comments', compact('comments', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Comment $comment
     * @return void
     */
    public function show(Comment $comment)
    {
        return view('admin.comments.replay', compact('comment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {

        return view('admin.comments.edit' , compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Comment $comment
     * @return void
     */
    public function update(Request $request, Comment $comment)
    {
        $request->validate([
            'comment' => 'required'
        ]);

        $comment->update($request->all());

        alert()->success('با موفقیت ویرایش شد');

       return redirect(route('admin.user.comment',['user' =>  $comment->user->id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Comment $comment
     * @return void
     * @throws \Exception
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        alert()->success('نظر با موفقیت حذف گردید');
        return back();
    }

    public function approved(Comment $comment)
    {
        $comment->approved = 1;
        $comment->save();
        alert()->success('نظر با موفقیت تایید گردید');
        return back();


    }

    public function replay(Request $request, Comment $comment)
    {
        $request->validate([
            'comment' => 'required'
        ]);
        auth()->user()->comments()->create([
            'commentable_id' => $comment->commentable_id,
            'commentable_type' => $comment->commentable_type,
            'comment' => $request->input('comment'),
            'approved' => 1,
            'parent_id' => $comment->id
        ]);
        alert()->success('پاسخ به نظر با موفقیت ثبت گردید');
        return redirect(route('admin.user.comment' , ['user' => $comment->user->id]));
    }
}
