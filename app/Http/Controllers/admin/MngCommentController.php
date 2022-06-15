<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravelista\Comments\Comment;
class MngCommentController extends Controller
{
    public function index(){
        $comments = Comment::all();
        return view('admin.comment.index')->with(['comments' => $comments]);
    }

    public function destroy(Comment $comment)
    {
      if($comment){
        $comment->delete();
      }
      return redirect()->back();
    }

    public function deleteAll(Request $request)
    {
      $comments_id = explode(',',$request->comment_id[0]);
      $deleted = Comment::whereIn('id',$comments_id)->delete();
      if($deleted) {
        return redirect()->back()->with('message', 'Da xoa thanh cong');
      }
      return redirect()->back()->with('message', 'Xoa khong thanh cong');
    }
    public function approvedComment($id)
    {
      $comment = Comment::find($id);
      if($comment){
        $comment->approved = !$comment->approved;
        $comment->save();
      }
      return redirect()->back();
    }
}
