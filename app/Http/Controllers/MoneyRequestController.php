<?php

namespace App\Http\Controllers;

use App\User;
use App\MoneyRequest;
use App\Notifications\MoneyRequestCanceld;
use App\Notifications\MoneyRequestConfirmed;
use Illuminate\Http\Request;
use App\Rules\LimitRequestedMoney;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewMoneyRequestCreated;

class MoneyRequestController extends Controller
{
    public function index()
    {
        return view('dashboard.money_requests.index',[
            'title'    => trans('software.money_requests'),
            'requests' => MoneyRequest::with('user')->latest()->paginate(10), 
        ]);
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        $data = $request->validate([
            'phone'        => 'required',
            'money_needed' => ['required','numeric',new LimitRequestedMoney($user->commission)], 
        ]);

        $moneyRequest = $user->moneyRequests()->create($data);

        Notification::send(User::admins()->get(),new NewMoneyRequestCreated($moneyRequest));

        return back();

    }

    public function update(Request $request,MoneyRequest $moneyRequest )
    {
        $data = $request->validate([

            'phone'        => 'required',
            'money_needed' => ['required','numeric',new LimitRequestedMoney(user()->commission)],

        ]);

        $moneyRequest->update($data);

        return back();
        

        
    }

    public function cancelRequest(MoneyRequest $moneyRequest)
    {
        $moneyRequest->update([

            'is_canceld' => 1,
            'canceld_at' => now(),
        ]);

        $moneyRequest->user->notify(new MoneyRequestCanceld());

        return back();
    }

    public function confirmRequest(MoneyRequest $moneyRequest)
    {
        $moneyRequest->update([
            'is_confirmed'   => 1,
            'confirmed_at' => now(), 
        ]);

        $moneyRequest->user()->update([

            'commission' => $moneyRequest->user->commission - $moneyRequest->money_needed,

        ]);

        $moneyRequest->user->notify(new MoneyRequestConfirmed());



        return back();
    }
}
