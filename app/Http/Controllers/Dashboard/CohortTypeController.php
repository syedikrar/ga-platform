<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CohortTypeRequest;
use App\Models\CohortType;
use App\Traits\FIleUploadTrait;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\JsonResponse;

class CohortTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cohort_type.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cohort_type.create')->render();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CohortTypeRequest $request)
    {

        try {
            $validated = $request->validated();
  
            $cohortType = CohortType::create([
                'uuid'    => Str::uuid(),
                'name_en' => $validated['name_en'],
                'name_ar' => $validated['name_ar'],
                'status'  => $request->status ? 'active' : 'inactive',
            ]);
            return response()->json([
                'status' => JsonResponse::HTTP_OK,
                'message' => 'Cohort type added successfully.'
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
        $cohortType = CohortType::where('uuid',$uuid)->firstOrFail();
        return view('cohort_type.edit',compact('cohortType'))->render();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CohortTypeRequest $request, CohortType $cohortType)
    {
        try {
            $validated = $request->validated();
  
            $cohortType->update([
                'name_en'  => $validated['name_en'],
                'name_ar'  => $validated['name_ar'],
                'status'   => $request->status ? 'active' : 'inactive',
            ]);
            return response()->json([
                'status'  => JsonResponse::HTTP_OK,
                'message' => 'Cohort type updated successfully.'
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
        $cohortTypes = CohortType::latest()->get();
        return Datatables::of($cohortTypes)
            ->addColumn('actions', function ($type) use ($authUser) {
                $actions = '<div class="export"> 
                                <a href="javascript:void(0);" data-act="ajax-modal" data-complete-location="true" data-method="get"
                                    data-action-url="'.route("dashboard.cohort-types.edit",$type->uuid).'" data-table="cohort-types-table"
                                    data-title="EDIT COHORT TYPE"> <em class="icon ni ni-edit"></em> 
                                Edit</a>
                            </div>';
                return $actions;
            })
            ->rawColumns(['actions' ])
            ->addIndexColumn()->make(true);
    }
}
