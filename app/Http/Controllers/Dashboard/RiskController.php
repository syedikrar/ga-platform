<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RiskRequest;
use App\Models\Risk;
use App\Models\Challenge;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\JsonResponse;

class RiskController extends Controller
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RiskRequest $request)
    {
        try {
            $validated = $request->validated();
            $challenge = Challenge::where('id',$request->challenge)->firstOrFail();
            $risk = Risk::create([
                'uuid'         => Str::uuid(),
                'title_en'     => $validated['title_en'],
                'title_ar'     => $validated['title_ar'],
                'description_en' => $validated['description_en'],
                'description_ar' => $validated['description_ar'],
                'challenge_id' => $validated['challenge'],
                'added_by'     => \Auth::user()->id,
                'status'       => $validated['status'],
                'impact'       => $validated['impact'],
                'probability'  => $validated['probability'],
                'stage_id'     => $challenge->stage_id,   
                'identification_date'   => \carbon\carbon::parse($validated['identification_date'])->format('y/m/d'),  
                
                 
            ]);
            return response()->json([
                'status' => JsonResponse::HTTP_OK,
                'message' => 'Risk added successfully.'
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
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
    public function dataTable(Request $request)
    {
        $authUser = auth()->user();
        $risks = Risk::select('*');

        if ($request->get('challenge')) {
            $challenge = Challenge::where('id',$request->challenge)->firstOrFail();
            $risks->where('challenge_id', $challenge->id)->where('stage_id',$challenge->stage_id);
        }
        $risks = $risks->latest()->get();
        return Datatables::of($risks)
        ->addColumn('impact', function ($risk) use ($authUser) {
            if($risk->impact == "High") $bage_color = "badge-danger"; 
            elseif($risk->impact == "Very High") $bage_color = "badge-danger"; 
            elseif($risk->impact == "Medium")  $bage_color = "badge-success";
            elseif($risk->impact == "Low") $bage_color = "badge-warning";
            $action = ' <span class="badge badge-dim '.$bage_color .'"><span>'.$risk->impact.'</span></span>';
            return $action;
        })
        ->rawColumns(['impact'])
        ->addIndexColumn()->make(true);
    }
}
