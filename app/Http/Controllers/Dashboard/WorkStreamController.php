<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\WorkstreamRequest;
use App\Models\Challenge;
use App\Models\Entity;
use App\Models\WorkStream;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class WorkStreamController extends Controller
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
        $entity_names = Entity::where('status','active')->get();
        return view('challenge.plan.workstream.modal',compact('entity_names','challenge_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WorkstreamRequest $request)
    {
        try{
            WorkStream::create([
                'mode' => $request->mode,
                'name_en' => $request->name_en,
                'name_ar' => $request->name_ar,
                'priority' => $request->priority,
                'is_existing_entity' => 1,
                'is_send_email' => $request->is_send_email ? 1 : 0,
                'is_send_sms' => $request->is_send_sms ? 1 : 0,
                'entity_id' => $request->entity_id,
                'challenge_id' => $request->challenge_id
            ]);
            return response()->json([
                'success' => JsonResponse::HTTP_OK,
                'message' => 'Work Stream Added successfully'
            ], JsonResponse::HTTP_OK);
        }
        catch(Exception $e){
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
        $entity_names = Entity::where('status','active')->get();
        $work_stream = WorkStream::find($id);
        return view('challenge.plan.workstream.modal',compact('entity_names','work_stream'));
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
        try{
            
            WorkStream::find($id)->update([
                'mode' => $request->mode,
                'name_en' => $request->name_en,
                'name_ar' => $request->name_ar,
                'priority' => $request->priority,
                'is_existing_entity' => 1,
                'is_send_email' => $request->is_send_email ? 1 : 0,
                'is_send_sms' => $request->is_send_sms ? 1 : 0,
                'entity_id' => $request->entity_id,
            ]);
            return response()->json([
                'success' => JsonResponse::HTTP_OK,
                'message' => 'Work Stream Updated successfully'
            ], JsonResponse::HTTP_OK);
        }
        catch(Exception $e){
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
            WorkStream::find($id)->delete();
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

    /**
     * load add work stream form 
     * @param 
     * @return view 
     */
    public function getWorkStreamForm()
    {
        return view('challenge.plan.workstream.add_work_stream_form');
    }

    public function datatable(Request $request)
    {
        $challenge = Challenge::where('id',$request->challenge)->firstOrFail();
        $workstream = $challenge->work_stream();
        return DataTables::of($workstream)
        ->addColumn('priority', function ($workstream)  {
            if($workstream->priority == "high") $bage_color = "badge-danger"; 
            elseif($workstream->priority == "medium")  $bage_color = "badge-success";
            elseif($workstream->priority == "low") $bage_color = "badge-warning";
            $action = ' <span class="badge badge-dim '.$bage_color .'"><span>'.$workstream->priority.'</span></span>';
            return $action;
        })
        ->editColumn('status', function ($record) {
            return $record->status == 'active' ? 'Active' : 'In Active';;
        })
        ->addColumn('actions', function ($record) {
            return '<div class="page-right-dot-option table-options"><div class="dropdown">
            <a href="" class="dropdown-toggle btn btn-sm btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
            <div class="dropdown-menu dropdown-menu-right">
                <ul class="link-list-opt no-bdr">
                <li><a href="javascript:void(0);" data-act="ajax-modal"   data-action-url="' . route('dashboard.workstream-tasks.create') . '" data-table="work_stream" data-method="get" ><img src="'.asset('images/dashboard/dot-icon1.png').'"><span>Add New Activity</span> </a></li>
                <li><a href="javascript:void(0)" data-act="ajax-modal"  data-table="work_stream" data-action-url="' . route('dashboard.workstreams.edit', $record->id) . '" data-method="get" data-title="Edit Work Stream"><em class="icon ni ni-edit"></em><span>Edit Work Stream</span></a></li>
                <li><a href="javascript:void(0)" class="delete " data-table="work_stream" data-url="' . route('dashboard.workstreams.destroy', $record->id) . '"><em class="icon ni ni-trash text-danger"></em><span>Remove Work Stream</span> </a></li>  
                </ul>
            </div>
        </div></div>';
        })
        ->rawColumns(['priority','actions','status'])
        ->addIndexColumn()->make(true);
    }
}
