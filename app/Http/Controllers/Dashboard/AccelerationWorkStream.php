<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\AccWorkstreamRequest;
use App\Models\AccelerationWorkstream as ModelsAccelerationWorkstream;
use App\Models\AccWorkstream;
use App\Models\Challenge;
use App\Models\ChallengeUsers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class AccelerationWorkStream extends Controller
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
    public function create($challenge_id)
    {
        $usersId = ChallengeUsers::where('challenge_id', $challenge_id)->pluck('user_id')->all();
        $members = User::with('challenges')->orderBy('created_at', 'desc')->find($usersId);
        return view('challenge.plan.acceleration_workstreams.modal',compact('members','challenge_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AccWorkstreamRequest $request)
    {
        
        try{
            DB::beginTransaction();
           $workstream = AccWorkstream::create([
                'uuid' => Str::uuid(),
                'name_en' => $request->name_en,
                'name_ar' => $request->name_ar,
                'description_en' => $request->description_en,
                'description_ar' => $request->description_ar,
                'leader_id' => $request->leader_id,
                'challenge_id' => $request->challenge_id
            ]);
            // dd($request->member_id);
            $workstream->members()->sync($request->member_id);
            
            DB::commit();
            return response()->json([
                'success' => JsonResponse::HTTP_OK,
                'message' => 'Work Stream Added successfully'
            ], JsonResponse::HTTP_OK);
        }
        catch(Exception $e){
            DB::rollBack();
            return response()->json([
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
    public function edit($id)
    {
        $acc_workstream = AccWorkstream::find($id);
        $usersId = ChallengeUsers::where('challenge_id', $acc_workstream->challenge_id)->pluck('user_id')->all();
        $members = User::with('challenges')->orderBy('created_at', 'desc')->find($usersId);
        return view('challenge.plan.acceleration_workstreams.modal',compact('members','acc_workstream'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AccWorkstreamRequest $request, $id)
    {
        try{
            DB::beginTransaction();
            $acc_workstream =AccWorkstream::find($id);
            $workstream = $acc_workstream->update([
                'name_en' => $request->name_en,
                'name_ar' => $request->name_ar,
                'description_en' => $request->description_en,
                'description_ar' => $request->description_ar,
                'leader_id' => $request->leader_id,
            ]);
            $acc_workstream->members()->sync($request->member_id);
            DB::commit();
            return response()->json([
                'success' => JsonResponse::HTTP_OK,
                'message' => 'Work Stream Updated successfully'
            ], JsonResponse::HTTP_OK);
        }
        catch(Exception $e){
            DB::rollBack();
            return response()->json([
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
        try {
            AccWorkstream::find($id)->delete();
            return response()->json([
                'success' => JsonResponse::HTTP_OK,
                'message' => 'Successfully Deleted',
            ], JsonResponse::HTTP_OK);
        } catch (Exception $e) {
            return response()->json([
                'status' => JsonResponse::HTTP_UNPROCESSABLE_ENTITY,
                'message' => $e->getMessage()
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }
    }
    public function datatable(Request $request)
    {
        $challenge = Challenge::where('id',$request->challenge)->firstOrFail();
        $workstream = $challenge->acc_work_stream();
        return DataTables::of($workstream)
        ->editColumn('leader_id', function ($record) {
            return $record->ws_leader($record->leader_id);
        })
        ->addColumn('members', function ($record) {
            return $record->members->count();
        })
        ->addColumn('actions', function ($record) {
            return '<div class="page-right-dot-option table-options"><div class="dropdown">
            <a href="" class="dropdown-toggle btn btn-sm btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
            <div class="dropdown-menu dropdown-menu-right">
                <ul class="link-list-opt no-bdr">
                <li><a href="javascript:void(0);" data-act="ajax-modal"   data-action-url="' . route('dashboard.acc-workstream.tasks.create',$record->id) . '" data-table="work_stream" data-method="get" ><img src="'.asset('images/dashboard/dot-icon1.png').'"><span>Add New Task</span> </a></li>
                <li><a href="javascript:void(0)" data-act="ajax-modal"  data-table="work_stream" data-action-url="' . route('dashboard.acceleration-workstreams.edit', $record->id) . '" data-method="get" data-title="Edit Work Stream"><em class="icon ni ni-edit"></em><span>Edit Work Stream</span></a></li>
                <li><a href="javascript:void(0)" class="delete " data-table="work_stream" data-url="' . route('dashboard.acceleration-workstreams.destroy', $record->id) . '"><em class="icon ni ni-trash text-danger"></em><span>Remove Work Stream</span> </a></li>  
                </ul>
            </div>
        </div></div>';
        })
        ->rawColumns(['priority','actions','status'])
        ->addIndexColumn()->make(true);
    }
}
