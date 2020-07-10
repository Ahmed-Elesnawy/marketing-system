<?php

namespace App\Http\Controllers;

use App\MoneyRequest;
use App\Notifications\MoneyRequestCanceld;
use App\Notifications\MoneyRequestConfirmed;
use App\Notifications\NewMoneyRequestCreated;
use App\Rules\LimitRequestedMoney;
use App\Services\MoneyService;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class MoneyRequestController extends Controller
{

    private $moneyServie;

    public function __construct(MoneyService $moneyService)
    {
        $this->moneyService = $moneyService;
    }

    public function index()
    {
        return view('dashboard.money_requests.index',[

            'title'    => trans('software.money_requests'),
            'requests' => $this->moneyService->getPaginatedRequests(), 
            
        ]);
    }

    public function store(Request $request)
    {
        $this->moneyService->store($request,auth()->user());
        return back();
    }

    public function update(Request $request,MoneyRequest $moneyRequest )
    {
        
        $this->moneyService->update($request,$moneyRequest,auth()->user());
        return back();
    
    }

   
}
