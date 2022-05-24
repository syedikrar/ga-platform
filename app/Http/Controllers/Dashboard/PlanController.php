<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PlanRequest;
use App\Models\Plan;
use App\Models\Challenge;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\JsonResponse;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $challenge_id = $request->challenge_id;
        $plans = Plan::where(['challenge_id'=>$challenge_id, 'parent_id'=>null])->latest()->get();
        return view('plan.create',compact('plans','challenge_id'))->render();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PlanRequest $request)
    {
        try {
            $validated = $request->validated();
            $challenge = Challenge::where('id', $validated['challenge'])->firstOrFail();
            $plan = Plan::create([
                'uuid'         => Str::uuid(),
                'title_en'     => $validated['title_en'],
                'title_ar'     => $validated['title_ar'],
                'challenge_id' => $validated['challenge'],
                'parent_id'    => $validated['parent_id'],
                'added_by'     => \Auth::user()->id,
                'status'       => $validated['status'],
                'priority'     => $validated['priority'],
                'stage_id'     => $challenge->stage_id,   
                'start_date'   => \carbon\carbon::parse($validated['start_date'])->format('y/m/d'),
                'end_date'     => \carbon\carbon::parse($validated['end_date'])->format('y/m/d'),     
                 
            ]);
            return response()->json([
                'status' => JsonResponse::HTTP_OK,
                'message' => 'Plan added successfully.'
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
    public function edit(Request $request, $uuid)
    {
        $challenge_id = $request->challenge_id;
        $plan = Plan::where('uuid',$uuid)->firstOrFail();
        $plans = Plan::where(['challenge_id'=>$challenge_id, 'parent_id'=>null])->latest()->get();
        
        return view('plan.edit',compact('plan','plans','challenge_id'))->render();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PlanRequest $request, $uuid)
    {
        try {
            $validated = $request->validated();
            $plan = Plan::where('uuid',$uuid)->firstOrFail();      
            $plan->update([
                'title_en'     => $validated['title_en'],
                'title_ar'     => $validated['title_ar'],
                'challenge_id' => $validated['challenge'],
                'parent_id'    => $validated['parent_id'],
                'added_by'     => \Auth::user()->id,
                'status'       => $validated['status'],
                'priority'     => $validated['priority'],
                'start_date'   => \carbon\carbon::parse($validated['start_date'])->format('y/m/d'),
                'end_date'     => \carbon\carbon::parse($validated['end_date'])->format('y/m/d'),     
                 
            ]);
            return response()->json([
                'status' => JsonResponse::HTTP_OK,
                'message' => 'Plan updated successfully.'
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
