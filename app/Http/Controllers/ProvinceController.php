<?php

namespace App\Http\Controllers;

use App\Province;
use App\Services\ProvinceService;
use App\DataTables\ProvincesDataTable;
use App\Http\Requests\Dashboard\ProvinceRequest;

class ProvinceController extends Controller
{

    protected $provinceService;


    public function __construct(ProvinceService $provinceService)
    {
        $this->provinceService = $provinceService ;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProvincesDataTable $datatable)
    {
        return $datatable->render('dashboard.provinces.index', [
            
            'title' => trans('software.provinces'),

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.provinces.create', [
            'title' => trans('software.add_province')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProvinceRequest $request)
    {
        $this->provinceService->store($request);
        toast()->success(trans('software.success_added'));
        return redirect()->route('dashboard.provinces.index');
    }

   

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Province  $Province
     * @return \Illuminate\Http\Response
     */
    public function edit(Province $province)
    {
        return view('dashboard.provinces.edit', [
            'title'     => "تعديل محافظه($province->name)",
            'province'  => $province
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Province  $Province
     * @return \Illuminate\Http\Response
     */
    public function update(ProvinceRequest $request, Province $province)
    {
        $this->provinceService->update($province,$request);
        toast()->success(trans('software.success_updated'));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Province  $Province
     * @return \Illuminate\Http\Response
     */
    public function destroy(Province $province)
    {
        $this->provinceService->destroy($province);
        toast()->success(trans('software.success_deleted'));
        return redirect()->route('dashboard.provinces.index');
    }
}
