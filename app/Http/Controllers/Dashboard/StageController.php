<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StageRequest;
use App\Models\Stage;
use App\Traits\FIleUploadTrait;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\JsonResponse;

class StageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('stage.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('stage.create')->render();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StageRequest $request)
    {
        try {
            $validated = $request->validated();
  
            $stage = Stage::create([
                'uuid'    => Str::uuid(),
                'name_en' => $validated['name_en'],
                'name_ar' => $validated['name_ar'],
            ]);
            return response()->json([
                'status' => JsonResponse::HTTP_OK,
                'message' => 'Stage added successfully.'
            ], JsonResponse::HTTP_OK);
        } 
        catch (\Exception $e) {
            return response()->json([
                'status' => JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage()
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($uuid)
    {
        $stage = Stage::where('uuid',$uuid)->firstOrFail();
        return view('stage.edit',compact('stage'))->render();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StageRequest $request, Stage $stage)
    {
        try {
            $validated = $request->validated();

            $stage->update([
                'name_en'  => $validated['name_en'],
                'name_ar'  => $validated['name_ar'],
            ]);
            return response()->json([
                'status'  => JsonResponse::HTTP_OK,
                'message' => 'Stage updated successfully.'
            ], JsonResponse::HTTP_OK);
        } 
        catch (\Exception $e) {
            return response()->json([
                'status'  => JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage()
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function dataTable()
    {
        $authUser = auth()->user();
        $stages = Stage::latest()->get();
        return Datatables::of($stages)
            ->addColumn('actions', function ($stage) use ($authUser) {
                $actions = '<div class="export text-right"> 
                                <a href="javascript:void(0);" data-act="ajax-modal" data-complete-location="true" data-method="get"
                                    data-action-url="'.route("dashboard.stages.edit",$stage->uuid).'" data-table="stages-table"
                                    data-title="EDIT COHORT STAGE"> <em class="icon ni ni-edit"></em> 
                                Edit</a>
                            </div>';
                return $actions;
            })
            ->rawColumns(['actions' ])
            ->addIndexColumn()->make(true);
    }
}
