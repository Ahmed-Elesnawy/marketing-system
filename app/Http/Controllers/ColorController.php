<?php

namespace App\Http\Controllers;

use App\Color;
use Illuminate\Http\Request;
use App\Services\ColorService;
use App\DataTables\ColorsDataTable;
use App\Http\Requests\Dashboard\ColorRequest;

class ColorController extends Controller
{
    private $colorService;

    public function __construct(ColorService $colorService)
    {
        $this->colorService = $colorService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ColorsDataTable $datatable)
    {
        return $datatable->render('dashboard.colors.index', [
            
            'title' => trans('software.colors'),

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.colors.create', [

            'title' => trans('software.add_color')
            
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ColorRequest $request)
    {
        $this->colorService->store($request);

        toast()->success(trans('software.success_added'));
        
        return redirect()->route('dashboard.colors.index');
    }

   

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Color  $Color
     * @return \Illuminate\Http\Response
     */
    public function edit(Color $color)
    {
        return view('dashboard.colors.edit', [

            'title'     => "تعديل لون($color->name)",

            'color'  => $color
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Color  $Color
     * @return \Illuminate\Http\Response
     */
    public function update(ColorRequest $request, Color $color)
    {
        $this->colorService->update($request,$color);

        toast()->success(trans('software.success_updated'));

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Color  $Color
     * @return \Illuminate\Http\Response
     */
    public function destroy(Color $color)
    {
        $this->colorService->destroy($color);

        toast()->success(trans('software.success_deleted'));

        return redirect()->route('dashboard.colors.index');
    }
}
