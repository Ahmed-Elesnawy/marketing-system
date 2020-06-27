<?php

namespace App\Http\Controllers;

use App\Notifications\CardReplied;
use App\Notifications\NewCardCreated;
use App\TechCard;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class TechCardController extends Controller
{
    public function index()
    {
        return view('dashboard.tech-cards.index',[
            'title' => trans('software.tech_cards'),
            'cards' => TechCard::with('user')->latest()->get(),
        ]);
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'title'   => 'required|max:255|string',
            'content' => 'required', 
        ]);

        $card = user()->techCards()->create($data);

        Notification::send(User::admins()->get(),new NewCardCreated($card));

        return back();
    }


    public function update(Request $request,$id)
    {
        $card = TechCard::findOrFail($id);

        $data = $request->validate([

            'title' => 'required',
            'content' => 'required',
        ]);

        $card->update($data);

        return back();

    }


    public function destroy($id)
    {
        TechCard::findOrFail($id)->delete();

        return back();
    }

    public function replyCard(Request $request,$id)
    {
        $card = TechCard::findOrFail($id);

        $data = $request->validate([
            'reply' => 'required',
        ]);

        $data = array_merge($data,['closed_at' => now()]);

        $card->update($data);

        $card->user->notify(new CardReplied($card->title));

        return back();
    }
}
