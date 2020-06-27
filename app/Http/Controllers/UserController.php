<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\DataTables\UsersDataTable;
use App\Http\Requests\Dashboard\UserRequest;

use App\Traits\ProfileTrait;


class UserController extends Controller
{

    use ProfileTrait;

    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UsersDataTable $datatable)
    {
        return $datatable->render('dashboard.users.index',[
            
            'title' => trans('software.users'),

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.users.create',[

            'title' => trans('software.add_new_user'),
            
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {

        $this->userService->store($request);

        toast()->success(trans('software.success_added'));

        return redirect()->route('dashboard.users.index');
    }

    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('dashboard.users.edit',[
            'title' => "تعديل عضو($user->name)",
            'user'  => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        
        $this->userService->update($request,$user);

        toast()->success(trans('software.success_updated'));

        return redirect()->route('dashboard.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */

     
    public function destroy(User $user)
    {
        $this->userService->destroy($user);

        toast()->success(trans('software.success_deleted'));

        return redirect()->route('dashboard.users.index');
    }


   
}
