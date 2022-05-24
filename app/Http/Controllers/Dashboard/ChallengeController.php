<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Challenge;
use App\Models\Entity;
use App\Models\User;
use App\Models\Cohort;
use App\Models\Plan;
use App\Models\Stage;
use App\Http\Requests\ChallengeRequest;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\JsonResponse;
use App\Jobs\SendChallengeInvitationEmail;
use App\Http\Requests\StoreChallengeUser;
use App\Models\AccWorkstream;
use App\Models\ChallengeUsers;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Auth;
use DB;
class ChallengeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('challenge.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $leadEntities = Entity::where('status', 'active')->latest()->get();
        $cohorts =  Cohort::latest()->get();
        return view('challenge.create', compact('leadEntities', 'cohorts'))->render();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ChallengeRequest $request)
    {
        try {
            $validated = $request->validated();

            $challenge = Challenge::create([
                'uuid'           => Str::uuid(),
                'name_en'        => $validated['name_en'],
                'name_ar'        => $validated['name_ar'],
                'description_en' => $validated['description_en'],
                'description_ar' => $validated['description_ar'],
                'cohort_id'      => $validated['cohort'],
                'lead_entity_id' => $validated['lead_entity'],
                'baseline'       => $validated['baseline'],
                'status'         => 'active',
                'thumbnail_icon' => $request->thumbnail_icon ? saveResizeImage($request->thumbnail_icon,'challenges',$request->thumbnail_icon->getClientOriginalExtension()) : null,
                'sidebar_icon'   => $request->sidebar_icon ? saveResizeImage($request->sidebar_icon,'challenges',$request->sidebar_icon->getClientOriginalExtension()) : null,


            ]);
            return response()->json([
                'status' => JsonResponse::HTTP_OK,
                'message' => 'Challenge added successfully.'
            ], JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
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
        $leadEntities = Entity::where('status', 'active')->latest()->get();
        $cohorts =  Cohort::latest()->get();
        $challenge = Challenge::where('uuid', $uuid)->firstOrFail();
        $acc_workstreams = $challenge->acc_work_stream;
        $stages = Stage::where('status', 'active')->latest()->get();
        $entities = Entity::all();
        return view('challenge.show', compact('leadEntities','cohorts','challenge', 'stages', 'entities','acc_workstreams'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($uuid)
    {
        $challenge = Challenge::where('uuid', $uuid)->firstOrFail();
        $leadEntities = Entity::where('status', 'active')->latest()->get();
        $cohorts =  Cohort::latest()->get();
        return view('challenge.edit', compact('challenge', 'leadEntities', 'cohorts'))->render();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ChallengeRequest $request, $id)
    {
        try {
            $challenge = Challenge::find($id);
            $validated = $request->validated();
            $challenge->update([
                'name_en'        => $validated['name_en'],
                'name_ar'        => $validated['name_ar'],
                'description_en' => $validated['description_en'],
                'description_ar' => $validated['description_ar'],
                'lead_entity_id' => $validated['lead_entity'],
                'cohort_id'      => $validated['cohort'],
                'baseline'       => $validated['baseline'],
                'thumbnail_icon' => $request->thumbnail_icon ? saveResizeImage($request->thumbnail_icon,'challenges',$request->thumbnail_icon->getClientOriginalExtension()) : $challenge->thumbnail_icon,
                'sidebar_icon'   => $request->sidebar_icon ? saveResizeImage($request->sidebar_icon,'challenges',$request->sidebar_icon->getClientOriginalExtension()) : $challenge->sidebar_icon,

            ]);

            return response()->json([
                'status' => JsonResponse::HTTP_OK,
                'message' => 'Challenge updated successfully.'
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
    public function destroy($id)
    {
        //
    }
    public function dataTable(Request $request)
    {
        $authUser = auth()->user();
        $challenges = Challenge::select('*');

        if ($request->get('cohort')) {
            $challenges->where('cohort_id', $request->get('cohort'));
        }
        if ($request->get('entity')) {
            $challenges->where('lead_entity_id', $request->get('entity'));
        }
        if ($request->get('with_cohorts')) {
            if ($request->get('with_cohorts') == 'yes')
                $challenges->where('cohort_id', '!=', NULL);
            else
                $challenges->where('cohort_id', NULL);
        }
        $challenges = $challenges->latest()->get();

        return Datatables::of($challenges)
            ->addColumn('name', function ($challenge) {
                $url = $challenge->sidebar_icon ? asset('storage/' . $challenge->sidebar_icon) : asset('images/dashboard/placeholder-image.png');
                return '<div class="user-card">
                        <div class="user-info">
                            <a href="'.route('dashboard.challenges.show', $challenge->uuid).'">
                            <img src="' . $url . '" class="img img-rounded mr-1" style="border-radius:50%;width:40px;height:40px" />
                            <span>'.$challenge->name_en.'</span>
                            </a>
                        </div>
                     </div>';
            })
            ->addColumn('edit', function ($challenge) use ($authUser) {
                /*$action = '<div class="export"><a href="javascript:void(0);" data-act="ajax-modal" data-complete-location="true" data-method="get"
                        data-action-url="'.route("dashboard.challenges.edit", $challenge->uuid) . '" data-table="challenges-table">  <em class="icon ni ni-edit"></em> Edit</a></div>';
                return $action;*/

                return '<div class="page-right-dot-option table-options"><div class="dropdown">
                            <a href="" class="dropdown-toggle btn btn-sm btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <ul class="link-list-opt no-bdr">
                                    <li>
                                        <a href="'.route('dashboard.challenges.show', $challenge->uuid).'"><img src="'.asset('images/dashboard/dot-icon1.png').'"><span>View Challenge</span> 
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div></div>';


            })
            ->addColumn('export', function ($challenge) use ($authUser) {
                $action = '<div class="export">  <em class="icon ni ni-download"></em> Export</div>';
                return $action;
            })
            ->addColumn('stage', function ($challenge) use ($authUser) {
                return 'Acceleration';
            })
            ->addColumn('lead_entity', function ($challenge) use ($authUser) {
                return $challenge->leadEntity->name_en ?? '';
            })
            ->addColumn('entities', function ($challenge) use ($authUser) {
                return '-';
            })
            ->addColumn('cohort', function ($challenge) use ($authUser) {
                return $challenge->cohort->name_en ?? '-';
            })
            ->addColumn('participants', function ($challenge) use ($authUser) {
                return '';
            })
            ->addColumn('entity_role', function ($challenge) use ($authUser) {
                return '';
            })
            ->addColumn('progress', function ($challenge) use ($authUser) {
                return  '<div class="progressBar">
                        <span class="progressTitle">
                            Services connections
                        </span>
                        <div class="progress progress-md">
                            <div class="progress-bar" data-progress="75" style="width: 75%;"></div>
                        </div>
                        <div class="progressText">
                            Progress: 75%
                        </div>
                    </div>';
            })
            
            ->addColumn('duration', function ($challenge) use ($authUser,$request) {
                $start_date = \Carbon\Carbon::createFromFormat('Y-m-d', $challenge->cohort->start_date);
                $end_date = \Carbon\Carbon::createFromFormat('Y-m-d', $challenge->cohort->end_date);
                $duration =  $start_date->diffInDays($end_date).' Days';
                return $duration;
            })

            ->addColumn('start_date', function ($challenge) use ($authUser) {
                $start_date = \Carbon\Carbon::createFromFormat('Y-m-d', $challenge->cohort->start_date);
                return $start_date->format('d M Y');
            })

            ->addColumn('end_date', function ($challenge) use ($authUser) {
                $end_date = \Carbon\Carbon::createFromFormat('Y-m-d', $challenge->cohort->end_date);
                return $end_date->format('d M Y');
            })

            ->rawColumns(['edit','export','progress', 'stage','name'])
            ->addIndexColumn()->make(true);
    }
    function getPlans(Request $request)
    {
        return view('challenge.plan.index')->render();  
    }
    
    public function change_stage(Request $request, $uuid)
    {
        try {
            $challenge = Challenge::where('uuid',$uuid)->firstOrFail();
            $stage = Stage::where('name_en',$request->stage)->firstOrFail();
            $challenge->update([
                'stage_id' =>$stage->id
            ]);

            return response()->json([
                'status' => JsonResponse::HTTP_OK,
                'message' => 'Challenge stage changed to '.$stage->name_en.' successfully.'
            ], JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'status' => JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage()
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * return the view 
     *
     * @param  int  $id
     * @return view
     */
    public function existingUserForm($id, $role)
    {
        $challenge = Challenge::findOrFail($id);
        $users = User::all();
        
        return view('challenge.modal.existing_user_form',compact('users','challenge','role'));
    }

    /**
     * Store users and challenges in challenges_users
     *
     * @param  \Illuminate\Http\Request  $request
     * @return 
     */
    public function addUsers(StoreChallengeUser $request)
    {
        try {
            $validated = $request->all();
            
            $challenge = Challenge::where('id', $validated['challenge_id'])->first();
            $challengeUsers = ChallengeUsers::where('challenge_id', $challenge->id)
                                         ->where('user_id', $validated['users'])->get();
            $role = $validated['role'];
            $users = User::findOrFail($validated['users']);
            
            foreach($challengeUsers as $user){
                $user = User::findOrFail($user->user_id);
                return response()->json([
                    'status' => JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
                    'message' => $user->first_name.' '.$user->last_name. ' already added to Challenge. Please select other user'
                ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
            }
            
            if($role != null){
                $role = Role::where('name', $role)->first();
                foreach($users as $user){
                    $user = User::findOrFail($user->id);
                    $entityModel = class_basename(App\Models\Challenge::class);
                    $model = new User;
                    $model->storeUserRoles($role->id, $user->id, $entityModel, $challenge->id);  
                }
            }
            
            $challenge->users()->attach($validated['users']);
            
            if ($request->has('send_email')) {
                foreach ($validated['users'] as $user) {
                    $user = User::findOrFail($user);
                    dispatch(new SendChallengeInvitationEmail($user->email, $user, $challenge));
                }
            }

            return response()->json([
                'status' => JsonResponse::HTTP_OK,
                'message' => 'User successfully added in challenge'
            ], JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'status' => JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage()
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function membersDataTable($id)
    {
        $usersId = ChallengeUsers::where('challenge_id', $id)->pluck('user_id')->all();
        $users = User::with('challenges')->orderBy('created_at', 'desc')->find($usersId);
        $challenge = Challenge::findOrFail($id);
        
        return Datatables::of($users)
            ->addColumn('team_members', function ($user) {
                return '<div class="user-card">
                            <div class="user-avatar">
                                <img src="'. getImage($user->profile_photo_path) .'" alt="">
                            </div>
                            <div class="user-info">
                                <a href=""><span>'.$user->name_en.'</span></a>
                            </div>
                         </div>';
            })->addColumn('role', function ($user) use ($challenge){
                $role = '';
                foreach($user->roles as $role){
                    if($role->name != 'team member' && $role->name != 'team leader'){
                        $checkRole = DB::table('model_has_roles')->where(['role_id' => $role->id, 'model_id' => $user->id, 'entityable_type' => 'Challenge', 'entityable_id' => $challenge])->get();
                        
                        if($checkRole->count() > 0){
                            $role = Role::where('id', $checkRole[0]->role_id)->first();
                            $roleName = $role->name;
                            $role = $roleName;
                            // dd($role);
                        }
                        
                        $roleName = $role->name;
                        $role = ucwords($roleName);
                        
                    }
                    else{
                        $switcher ='
                        <a href="javascript:void(0);" id="customSwitch' . $user->id . '" class="toggle-clicked" data-status="'.$role->name.'"  data-url="' . route('dashboard.role.updateUserRole', ['role'=>$role->id,'user'=>$user->id, 'challenge' => $challenge]) . '" data-table="#challenges-table"> 
                            <i class="fa-solid fa-repeat"></i>            
                        </a>';
                        $roleName = $role->name;
                        $role = ucwords($roleName).$switcher;
                    }
                    
                }
                
                return $role;
            })->addColumn('entity', function ($user) {
               return $user->entity ? $user->entity->name_en : '';
            })->addColumn('email', function ($user) {
                return $user->email;
            })
            ->addColumn('phone', function ($user) {
                return $user->phone;
            })
            ->addColumn('action', function ($user) use($challenge) {
                return '<div class="page-right-dot-option table-options"><div class="dropdown">
                            <a href="" class="dropdown-toggle btn btn-sm btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <ul class="link-list-opt no-bdr">
                                    <li>
                                        <a href="javascript:void(0);" id="customSwitch' . $user->id . '" class="toggle-clicked" data-status="1"  data-url="' . route('dashboard.entities.user.remove-challenge' ,[$challenge->id,$user->id]) . '" data-table="#challenges-table"><img src="'.asset('images/dashboard/dot-icon1.png').'"><span>Remove From Challenge</span> 
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div></div>';
            })
            ->rawColumns(['team_members', 'role', 'entity', 'email', 'phone', 'action' ])
            ->addIndexColumn()->make(true);
    }

    public function removeChallenge($challengeId, $userId)
    {
        try {
            $challenge = Challenge::findOrFail($challengeId);
            $user = User::findOrFail($userId);
            $challenge->users()->detach($userId);

            return response()->json([
                'status' => JsonResponse::HTTP_OK,
                'message' => ''.$user->name_en.' removed from '.$challenge->name_en.' challenge successfully.'
            ], JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'status' => JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage()
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function userForm($challengeId, $role)
    {
        $challenge = Challenge::findOrFail($challengeId);
        $entities = Entity::all();
        return view('challenge.modal.add_user_form', compact('entities', 'challenge','role'));    
    }
}