<?php


namespace App\Traits;

use App\Http\Requests\Dashboard\ProfileRequest;
use App\Http\Requests\Dashboard\ChangePasswordRequest;


trait ProfileTrait 
{
    public function showEditProfileForm()
    {
        return view('dashboard.users.profiles.edit',[

            'title' => trans('software.edit_profile'),
            'user'  => auth()->user(),
            
        ]);
    }

    public function updateProfile(ProfileRequest $request)
    {
        $this->userService->updateProfile($request,auth()->user());
        toast()->success(trans('software.success_updated'));
        return back();
    }


    public function changePasswordForm()
    {
        return view('dashboard.users.profiles.change',[

            'title' => trans('software.change_password'),

        ]);
    }


    public function changePassword(ChangePasswordRequest $request)
    {
    
        $this->userService->changePassword($request,auth()->user());
        alert()->success(trans('software.success'),trans('software.success_updated'));
        return redirect()->route('dashboard.home');
    }
}