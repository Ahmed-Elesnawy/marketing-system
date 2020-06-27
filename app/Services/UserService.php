<?php

namespace App\Services;

use App\Repositories\Contracts\UserRepositoryInterface;


class UserService 
{
    private $userRepo;

    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function store($request)
    {
        $data = $request->except(['image']);

        if ( $request->hasFile('image') )
        {
            $data['image'] = upload('image','users',52,52);
        }

        $this->userRepo->create($data);

    }


    public function update($request,$user)
    {

        $data = $request->except(['image','password']);

        if ( $request->hasFile('image') )
        {
            $data['image'] = upload('image','users',52,52,$user->image);
        }

        if ( $request->has('password') and !empty($request->password) )
        {
            $data['password'] = $request->password;
        }

        $this->userRepo->update($user,$data);
    }

    public function destroy($user)
    {
        $this->userRepo->delete($user);
    }


    public function updateProfile($request,$user)
    {
        $data = $request->validated();

        if ( $request->hasFile('image') )
        {
            $data['image'] = upload('image','users',52,52,$user->image);
        }

        $this->userRepo->update($user,$data);
    }


    public function ChangePassword($request,$user)
    {
        $data  = ['password' => $request->password];
        $this->userRepo->update($user,$data);
        auth()->logout();
    }
}