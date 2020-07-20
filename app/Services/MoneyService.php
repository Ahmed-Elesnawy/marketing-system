<?php

namespace App\Services;

use App\Events\MoneyRequestConfirmedEvent;
use App\Notifications\MoneyRequestCanceld;
use App\Notifications\MoneyRequestConfirmed;
use App\Notifications\NewMoneyRequestCreated;
use App\Repositories\Contracts\MoneyRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Rules\LimitRequestedMoney;
use Illuminate\Support\Facades\Notification;


class MoneyService 
{
    protected $moneyRepo;

    protected $userRepo;


    public function __construct(MoneyRepositoryInterface $moneyRepo,UserRepositoryInterface $userRepo)
    {
        $this->moneyRepo = $moneyRepo;
        $this->userRepo  = $userRepo;
    }



    public function store($request,$user)
    {

        $moneyRequest = $this->moneyRepo
                              ->create($this->data($request,$user));

        $this->sendNotificationToAdmins($moneyRequest);

    }


    public function update($request,$moneyRequest,$user)
    {
        $this->moneyRepo->update($moneyRequest,$this->data($request,$user));
    }


    public function cancelRequest($moneyRequest)
    {


        $this->moneyRepo->update($moneyRequest,[
            'is_canceld' => 1,
            'canceld_at' => now(),
        ]);



        $this->sendNotificationToMarkter($moneyRequest,false);


    }


    public function confirmRequest($moneyRequest)
    {
        $this->moneyRepo->update($moneyRequest,[

             'is_confirmed'   => 1,
             'confirmed_at' => now(),
             
        ]);

        event(new MoneyRequestConfirmedEvent($moneyRequest->user,$moneyRequest->money_needed));

        $this->sendNotificationToMarkter($moneyRequest);

    }


    public function getPaginatedRequests($num=10)
    {
        return $this->moneyRepo->getPaginatedRequests($num);
    }


    private function data($request,$user)
    {
        $data = $request->validate([

            'phone'        => 'required',
            'money_needed' => [new LimitRequestedMoney($user->commission)] 
            
        ]);

        $data['user_id'] = $user->id;

        return $data; 
    }


    protected function sendNotificationToAdmins($moneyRequest)
    {
        Notification::send($this->userRepo->getAdmins(),new NewMoneyRequestCreated($moneyRequest));
    }

    protected function sendNotificationToMarkter($moneyRequest,$confirmed= true)
    {
        if ( $confirmed ) $moneyRequest->user->notify(new MoneyRequestConfirmed());

        $moneyRequest->user->notify(new MoneyRequestCanceld());
    }


    

    
}