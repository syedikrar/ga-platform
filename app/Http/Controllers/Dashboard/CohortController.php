<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CohortRequest;
use App\Models\Cohort;
use App\Models\Entity;
use App\Models\CohortType;
use App\Models\Stage;
use App\Traits\FIleUploadTrait;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\JsonResponse;

class CohortController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cohort.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cohortTypes = CohortType::where('status','active')->latest()->get();
        $stages = Stage::where('status','active')->latest()->get();
        $leadEntities = Entity::where('status','active')->latest()->get();
        return view('cohort.create',compact('cohortTypes','leadEntities','stages'))->render();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CohortRequest $request)
    {
        try {
            $validated = $request->validated();
  
            $cohort = Cohort::create([
                'uuid'           => Str::uuid(),
                'name_en'        => $validated['name_en'],
                'name_ar'        => $validated['name_ar'],
                'cohort_type_id' => $validated['type'],
                'lead_entity_id' => $validated['lead_entity'],
                'stage_id'       => $validated['stage'],
                'status'         => $validated['status'],
                'start_date'     => \carbon\carbon::parse($validated['start_date'])->format('y/m/d'),
                'end_date'       => \carbon\carbon::parse($validated['end_date'])->format('y/m/d'),     
            ]);
            return response()->json([
                'status' => JsonResponse::HTTP_OK,
                'message' => 'Cohort added successfully.'
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
    public function show($uuid)
    {
        $cohort = Cohort::where('uuid',$uuid)->firstOrFail();
        $leadEntities = Entity::where('status','active')->latest()->get();
        $stages = Stage::where('status','active')->latest()->get();
        $cohortTypes = CohortType::where('status','active')->latest()->get();
        return view('cohort.show', compact('cohort','leadEntities','stages', 'cohortTypes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($uuid)
    {
        $cohort = Cohort::where('uuid',$uuid)->firstOrFail();
        $cohortTypes = CohortType::where('status','active')->latest()->get();
        $leadEntities = Entity::where('status','active')->latest()->get();
        $stages = Stage::where('status','active')->latest()->get();
        return view('cohort.edit',compact('cohort','cohortTypes','leadEntities','stages'))->render();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CohortRequest $request, Cohort $cohort)
    {
        try {
            $validated = $request->validated();
            $cohort->update([
                'name_en'        => $validated['name_en'],
                'name_ar'        => $validated['name_ar'],
                'cohort_type_id' => $validated['type'],
                'lead_entity_id' => $validated['lead_entity'],
                'stage_id'       => $validated['stage'],
                'status'         => $validated['status'],
                'start_date'     => \carbon\carbon::parse($validated['start_date'])->format('y/m/d'),
                'end_date'       => \carbon\carbon::parse($validated['end_date'])->format('y/m/d'), 
                'is_active'      => $request->has('is_active') ? 1 : 0
            ]);
            
            return response()->json([
                'status' => JsonResponse::HTTP_OK,
                'message' => 'Cohort updated successfully.'
            ], JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
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
    public function destroy($uuid)
    {
        try {
            $cohort = Cohort::where('uuid',$uuid)->firstOrFail();
            $cohort->delete();
            return response()->json([
                'status' => JsonResponse::HTTP_OK,
                'message' => 'Cohort deleted successfully.'
            ], JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'status' => JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage()
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function dataTable(Request $request)
    {
        $authUser = auth()->user();
        $cohorts = Cohort::select('*');
        if ($request->get('status')) {
            $cohorts->where('status', $request->get('status'));
        }

        $cohorts =  $cohorts->latest()->get();

        return Datatables::of($cohorts)
            ->addColumn('name', function ($cohort) {
                return '<div class="user-card">
                            <div class="user-info">
                                <a href="'. route('dashboard.cohorts.show', $cohort->uuid) .'"><span>'.$cohort->name_en.'</span></a>
                            </div>
                         </div>';
            })->addColumn('challenges', function ($cohort) {

                if(count($cohort->challenges)){
                    $challengesProgress = '';

                    foreach($cohort->challenges as $challenge){
                        $challengesProgress .= '<li>
                        <div class="progressGrid">
                            <div class="progressIcon">
                                <div class="nk-notification-icon">
                                    <em class="icon icon-circle bg-violate-50 ni ni-share"></em>
                                </div>
                            </div>
                            <div class="progressBar">
                                <span class="progressTitle">
                                    '.$challenge->name_en.'
                                </span>
                                <div class="progress progress-md">
                                    <div class="progress-bar" data-progress="75" style="width: 75%;"></div>
                                </div>
                                <div class="progressText">
                                    Progress: 75%
                                </div>
                            </div>
                            <div class="progreeArrow">
                                <em class="ni ni-chevron-right"></em>
                            </div>
                        </div>
                    </li>';
                    }
                    
                    $challenges = '<div class="dropdown">
                    <a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown" aria-expanded="false">'.count($cohort->challenges).'<em class="icon ni ni-caret-down-fill"></em></a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-md left-100">
                        <ul class="link-list-plain">
                            '.$challengesProgress.'
                        </ul>
                    </div>
                </div>';
                }else $challenges = 0;
                
                return $challenges;
            })
            ->addColumn('active', function ($cohort) use ($authUser) {

                $isChecked = $cohort->is_active== 1 ? 'checked' : '';
                $statusTobeUpdate = $cohort->is_active == 1 ? 0 : 1;

                $actions = '<div class="preview-block">
                                <div class="custom-control custom-switch custom-control-sm">
                                    <input type="checkbox" class="custom-control-input toggle-clicked"  id="customSwitch' . $cohort->uuid . '" ' . $isChecked . ' data-status="' . $statusTobeUpdate . '" data-url="' . route('dashboard.cohorts.update-status', $cohort->uuid) . '" data-table="#cohorts-table">
                                    <label class="custom-control-label switch-style2" for="customSwitch' . $cohort->uuid . '"></label>
                                </div>
                            </div>';
                return $actions;
            })
            ->addColumn('edit', function ($cohort) use ($authUser) {
                $actions = '<div class="export"><a href="javascript:void(0);" data-act="ajax-modal" data-complete-location="true" data-method="get"
                                data-action-url="'.route("dashboard.cohorts.edit",$cohort->uuid).'" data-table="cohorts-table">  <em class="icon ni ni-edit"></em> Edit</a></div>';
                return $actions;
            })
            ->addColumn('export', function ($cohort) use ($authUser) {
                $actions = '<div class="export">  <em class="icon ni ni-download"></em> Export</div>';
                return $actions;
            })
            ->addColumn('status', function ($cohort) use ($authUser) {
                return ucfirst($cohort->status);
            })
            ->addColumn('methodology', function ($cohort) use ($authUser) {
                return $cohort->cohortType->name_en;
            })
            ->addColumn('participant', function ($cohort) use ($authUser) {
                return '-';
            })
             ->addColumn('entities', function ($cohort) use ($authUser) {
                return '1';
            })
            ->addColumn('stage', function ($cohort) use ($authUser) {
                return ucfirst($cohort->stage->name_en);
            })
            ->addColumn('duration', function ($cohort) use ($authUser) {

                $start_date = \Carbon\Carbon::createFromFormat('Y-m-d', $cohort->start_date);
                $end_date = \Carbon\Carbon::createFromFormat('Y-m-d', $cohort->end_date);
                $duration =  $start_date->diffInDays($end_date).' Days';
                return $duration;
            })
            ->rawColumns(['active','edit','export', 'challenges','name','duration' ])
            ->addIndexColumn()->make(true);
    }
    public function dataTableShow(Request $request)
    {
        $authUser = auth()->user();
       
        $cohorts = Cohort::where('id',$request->get('cohort'))->get();

        return Datatables::of($cohorts)
            
            
            ->addColumn('actions', function ($cohort) use ($authUser) {
                $actions = '<div class="delete-update-btn">
                <a href="javascript:void(0);" data-act="ajax-modal" data-complete-location="true" data-method="get"
                data-action-url="'.route("dashboard.cohorts.edit",$cohort->uuid).'" data-table="cohorts-table"
                 class="btn btn-round btn-update bg-green text-white"><em class="icon ni ni-edit mr-1 text-white"></em>Edit</a>
                <a href="javascript:void(0)" class="btn btn-round btn-delete text-white delete" data-url="'.route('dashboard.cohorts.destroy', $cohort->uuid).'" data-table="cohorts-table" data-redirect="'.route('dashboard.cohorts.index').'"><em class="icon ni ni-trash mr-1"></em>Delete </a>  
            </div>';
               
                return $actions;
            })
            ->rawColumns(['actions' ])
            ->addIndexColumn()->make(true);
    }
    public function updateStatus(Request $request, $uuid){
      
        try {
            $cohort = Cohort::where('uuid',$uuid)->firstOrFail();
            $cohort->update([
                'is_active' => $request->status ? 1 : 0
            ]);
            
            return response()->json([
                'status' => JsonResponse::HTTP_OK,
                'message' => 'Cohort status updated successfully.'
            ], JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'status' => JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage()
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
