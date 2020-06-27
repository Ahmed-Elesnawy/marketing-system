<?php

namespace App\Http\Controllers;

use App\User;
use App\Message;
use Illuminate\Http\Request;
use App\Http\Requests\Dashboard\MessageRequest;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')->except(['index']);
    }

    public function index()
    {
        
        $title = trans('software.admin_messages');

        $markter_choices = User::markters()->pluck('name','id');

        $messages = Message::latest()->paginate(10);

        if ( user()->is_markter )
        {
            $messages = Message::where('user_id',user()->id)
                        ->orWhereNull('user_id')
                        ->latest()
                        ->paginate(10);
        }

        return view('dashboard.messages.index',compact('title','messages','markter_choices'));
    }



    public function store(MessageRequest $request)
    {
       $data = $request->validated();

       Message::create($data);


       toast()->success(trans('software.success_added'));


       return back();

    }




    public function destroy(Message $message)
    {
        $message->delete();
        toast()->success(trans('software.success_deleted'));
        return back();
    }


}
