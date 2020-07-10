<?php

namespace App\Http\Controllers;

use App\MoneyRequest;
use App\Services\MoneyService;
use Illuminate\Http\Request;

class CancelConfirmMoneyController extends Controller
{

	private $moneyServie;

    public function __construct(MoneyService $moneyService)
    {
        $this->moneyService = $moneyService;
    }
    
     public function cancelRequest(MoneyRequest $moneyRequest)
     {

        $this->moneyService->cancelRequest($moneyRequest);

        return back();
     }

    public function confirmRequest(MoneyRequest $moneyRequest)
    {
        

        $this->moneyService->confirmRequest($moneyRequest);

        return back();
    }
}
