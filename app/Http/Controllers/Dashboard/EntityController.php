<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\EntityRequest;
use App\Models\Entity;
use App\Models\EntityType;
use App\Traits\FIleUploadTrait;
use Dotenv\Parser\Entry;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\JsonResponse;
use App\Models\User;
use App\Models\Role;
use App\Models\Challenge;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class EntityController extends Controller
{
    use FIleUploadTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $entityTypes = EntityType::where('status', 'active')->latest()->get();
        return view('entity.index', compact('entityTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $entityTypes = EntityType::where('status', 'active')->latest()->get();
        return view('entity.create', compact('entityTypes'))->render();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EntityRequest $request)
    {
        try {
            $validated = $request->validated();

            $entity = Entity::create([
                'uuid'          => Str::uuid(),
                'name_en'       => $validated['name_en'],
                'name_ar'       => $validated['name_ar'],
                'short_name'    => $validated['short_name'],
                'entity_type_id' => $validated['type'],
                'website'       => $validated['website'],
                'email'         => $validated['email'],
                'phone'         => '+971' . $validated['phone'],
                'address_en'    => $validated['address_en'],
                'address_ar'    => $validated['address_ar'],
                'longitude'     => $validated['longitude'],
                'latitude'      => $validated['latitude'],
                'location'      => $validated['location'],
                'status'        => $request->status ? 'active' : 'inactive',
            ]);
            if ($request->has('logo')) {
                $validator = \Validator::make(
                    ['extension' => strtolower($request->file('logo')->getClientOriginalExtension())],
                    ['extension' => 'required|in:png,jpg,jpeg']
                );
                if ($validator->fails()) {
                    return response()->json([
                        'status' => JsonResponse::HTTP_UNPROCESSABLE_ENTITY,
                        'message' => 'Logo must be an image of type png or jpg ',
                    ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
                }

                $this->uploadLogo($request->file('logo'), $entity);
            }
            return response()->json([
                'status' => JsonResponse::HTTP_OK,
                'message' => 'Entity added successfully.'
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
        $entity = Entity::where('uuid', $uuid)->firstOrFail();
        $entityLeader = '';

        $entityRoles = $entity->with([
            'users'  => function ($query) {
                $query->with(['roles' => function ($q) {
                    $q->where(['name' => 'entity leader']);
                }]);
            }
        ])->where(['uuid' => $uuid])->get()->toArray();

        foreach ($entityRoles[0]['users'] as $user) {
            foreach ($user['roles'] as $role) {
                $entityLeader = $role['name'];
            }
        }

        $message = $entityLeader  ? '' : 'Add Team Leader -- To Complete the entity basic profile';

        $entityTypes = EntityType::where('status', 'active')->latest()->get();
        return view('entity.show', compact('entity', 'entityTypes', 'message'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EntityRequest $request, Entity $entity)
    {
        try {
            $validated = $request->validated();

            $entity->update([
                'name_en'       => $validated['name_en'],
                'name_ar'       => $validated['name_ar'],
                'short_name'    => $validated['short_name'],
                'entity_type_id' => $validated['type'],
                'website'       => $validated['website'],
                'email'         => $validated['email'],
                'phone'         => '+971' . $validated['phone'],
                'address_en'    => $validated['address_en'],
                'address_ar'    => $validated['address_ar'],
                'longitude'     => $validated['longitude'],
                'latitude'      => $validated['latitude'],
                'location'      => $validated['location'],
                'status'        => $request->status ? 'active' : 'inactive',
            ]);
            if ($request->has('logo')) {
                $validator = \Validator::make(
                    ['extension' => strtolower($request->file('logo')->getClientOriginalExtension())],
                    ['extension' => 'required|in:png,jpg,jpeg']
                );
                if ($validator->fails()) {
                    return response()->json([
                        'status' => JsonResponse::HTTP_UNPROCESSABLE_ENTITY,
                        'message' => 'Logo must be an image of type png or jpg ',
                    ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
                }
                $this->uploadLogo($request->file('logo'), $entity);
            }
            return response()->json([
                'status' => JsonResponse::HTTP_OK,
                'message' => 'Entity updated successfully.'
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
        try {
            $entity = Entity::findOrFail($id);
            $entity->delete();
            return response()->json([
                'status' => JsonResponse::HTTP_OK,
                'message' => 'Entity deleted successfully.'
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
        $entities = Entity::select('*');

        if ($request->get('filter_type')) {
            $entities->whereIn('entity_type_id', $request->get('filter_type'));
        }
        if ($request->get('sector')) {
            $entities = $entities->whereHas('entityType', function ($type) use ($request) {
                $type->where('sector', $request->get('sector'));
            });
        }
        $entities = $entities->latest()->get();

        return Datatables::of($entities)
            ->addColumn('name', function ($entity) {
                $entity->logo ? $url = asset('storage/' . $entity->logo) : $url = asset('images/dashboard/placeholder-image.png');
                return '<div class="user-card">
                            <div class="user-avatar">
                                <img src="' . $url . '" alt="">
                            </div>
                            <div class="user-info">
                                <a href="' . route('dashboard.entities.show', $entity->uuid) . '"><span>' . $entity->name_en . '</span></a>
                            </div>
                         </div>';
            })->addColumn('entityType', function ($entity) {
                return $entity->entityType->name_en;
            })->addColumn('challenges', function ($entity) {
                if (count($entity->challenges)) {
                    $challengesProgress = '';

                    foreach ($entity->challenges as $challenge) {
                        $challengesProgress .= '<li>
                        <div class="progressGrid">
                            <div class="progressIcon">
                                <div class="nk-notification-icon">
                                    <em class="icon icon-circle bg-violate-50 ni ni-share"></em>
                                </div>
                            </div>
                            <div class="progressBar">
                                <span class="progressTitle">
                                    ' . $challenge->name_en . '
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
                    <a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown" aria-expanded="false">' . count($entity->challenges) . '<em class="icon ni ni-caret-down-fill"></em></a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-md left-100">
                        <ul class="link-list-plain">
                            ' . $challengesProgress . '
                        </ul>
                    </div>
                </div>';
                } else $challenges = 0;

                return $challenges;
            })->addColumn('users', function ($entity) {
                return count($entity->users);
            })
            ->addColumn('actions', function ($entity) use ($authUser) {
                $actions = '<div class="export">  <em class="icon ni ni-download"></em> Export</div>';
                return $actions;
            })
            ->rawColumns(['actions', 'name', 'challenges'])
            ->addIndexColumn()->make(true);
    }
    public function entityTypesFilter(Request $request)
    {
        $entityTypes = EntityType::where('status', 'active')
            ->where('name_en', 'like', '%' . $request->get('search') . '%')
            ->when($request->get('sector'), function ($query) use ($request) {
                return $query->where('sector', $request->get('sector'));
            })

            ->latest()->get();

        return view('entity.entity-types-filters', compact('entityTypes'))->render();
    }
    protected function uploadLogo($logo, $entity)
    {
        $name = Str::slug($entity->name_en) . '_' . time();
        $folder = 'uploads/images/entities/';
        $filePath = $folder . $name . '.' . $logo->getClientOriginalExtension();
        $this->uploadFile($logo, $folder, 'public', $name);
        $entity->update(['logo' => $filePath]);
    }

    public function entityUsersdataTable($id)
    {
        $data = Entity::with(['users.experiences'])->orderBy("created_at", "desc")->findOrFail($id);
        return Datatables::of($data->users)
            ->addColumn('user_name', function ($user) {
                return '<div class="user-card">
                            <div class="user-avatar">
                                <img src="' . getImage($user->profile_photo_path) . '" alt="">
                            </div>
                            <div class="user-info">
                                <a href="#"><span>' . $user->name_en . '</span></a>
                            </div>
                         </div>';
            })->addColumn('job_title', function ($user) {
                $job_title = '';
                if (count($user->experiences) > 0) {
                    foreach ($user->experiences as $experience) {
                        $job_title = $experience->job_title;
                    }
                }
                return $job_title;
            })->addColumn('user_email', function ($user) {
                return $user->email;
            })->addColumn('mobile_number', function ($user) {
                return $user->phone;
            })->addColumn('challenges', function ($user) {

                if (count($user->challenges)) {
                    $challengesProgress = '';

                    foreach ($user->challenges as $challenge) {
                        $challengesProgress .= '<li>
                        <div class="progressGrid">
                            <div class="progressIcon">
                                <div class="nk-notification-icon">
                                    <em class="icon icon-circle bg-violate-50 ni ni-share"></em>
                                </div>
                            </div>
                            <div class="progressBar">
                                <span class="progressTitle">
                                    ' . $challenge->name_en . '
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
                    <a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown" aria-expanded="false">' . count($user->challenges) . '<em class="icon ni ni-caret-down-fill"></em></a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-md left-100">
                        <ul class="link-list-plain">
                            ' . $challengesProgress . '
                        </ul>
                    </div>
                </div>';
                } else $challenges = 0;

                return $challenges;
            })->addColumn('entity_leader', function ($user) use($id) {
                $role = $user->roles()->where('entityable_type', 'Entity')->where('entityable_id', $id)->first();
                $role = $role->name;
                $isChecked = $role == 'entity leader' ? 'checked' : '';
                $statusTobeUpdate = $role == 'entity leader' ? 'entity user' : 'entity leader';
                
                $actions = '<div class="preview-block">
                                <div class="custom-control custom-switch custom-control-sm">
                                    <input type="checkbox" class="custom-control-input toggle-clicked"  id="customSwitch' . $user->id . 's" ' . $isChecked . ' data-status="' . $statusTobeUpdate . '" data-url="' . route('dashboard.entities.user.role.switch', [$user->id, $id]) . '" data-table="#entities_users_table">
                                    <label class="custom-control-label switch-style2" for="customSwitch' . $user->id . 's"></label>
                                </div>
                            </div>';
                return $actions;
            })
            ->addColumn('actions', function ($user) {
                $userStatus = $user->status == 'active' ? 'Deactivate' : 'Activate';
                $status = $user->status == 'active' ? 'inactive' : 'active';
                $actions = '<div class="page-right-dot-option table-options">
                            <div class="dropdown">
                                <a href="" class="dropdown-toggle btn btn-sm btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <ul class="link-list-opt no-bdr">
                                        <li><a href="javascript:void(0);" id="customSwitch' . $user->id . '" class="toggle-clicked" data-status="resend_email_verification"  data-url="' . route('dashboard.user.send-welcome-mail', $user->email) . '" data-table="#entities_users_table">
                                        <span class="fa-icon"><i class="fa-solid fa-envelope"></i></span><span>Resend Activation Email</span></a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" data-act="ajax-modal" data-complete-location="true" data-method="get"
                                            data-action-url="' . route("dashboard.entities.user.edit-form", $user->id) . '" data-table="#entities_users_table"> <span class="fa-icon"> <i class="fa-solid fa-pen-to-square"></i></span> Edit
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" id="customSwitch' . $user->id . '" class="toggle-clicked"  data-status="' . $status . '"  data-url="' . route('dashboard.entities.user.change-status', $user->id) . '" data-table="#entities_users_table"><span class="fa-icon"><i class="fa-solid fa-toggle-on"></i></span><span>' . $userStatus . '</span> 
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)" class="delete" data-table="entities_users_table" data-url="' . route('dashboard.user.destroy', $user->id) . '"><span class="fa-icon"><i class="fa-solid fa-trash-can"></i></span><span>DELETE</span> </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>';
                return $actions;
            })
            ->rawColumns(['user_name', 'actions', 'user_email', 'challenges', 'active', 'entity_leader'])
            ->addIndexColumn()->make(true);
    }

    public function changeStatus(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);

            if ($user->status !== null && $user->status == 'inactive' && $request->status == 'inactive') {
                return response()->json([
                    'status' => JsonResponse::HTTP_OK,
                    'message' => 'User already Dactivated.'
                ], JsonResponse::HTTP_OK);
            }

            if ($user->status !== null && $user->status == 'active' && $request->status == 'active') {
                return response()->json([
                    'status' => JsonResponse::HTTP_OK,
                    'message' => 'User already activated.'
                ], JsonResponse::HTTP_OK);
            }

            $user->update([
                'status' => $request->status
            ]);

            return response()->json([
                'status' => JsonResponse::HTTP_OK,
                'message' => 'User status updated successfully.'
            ], JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'status' => JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage()
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function updateUserRole(Request $request, $userId, $entityId)
    {
        try {
            $user = User::findOrFail($userId);
            $entityModel = class_basename(App\Models\Entity::class);
            $entityId = Entity::where('id', $entityId)->first();
            $model = new User;
            $model->updateUserRole($request->status, $user, $entityModel, $entityId);

            return response()->json([
                'status' => JsonResponse::HTTP_OK,
                'message' => 'User role updated successfully.'
            ], JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'status' => JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage()
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function editEntityUserForm($id)
    {
        $user = User::findOrFail($id);
        $entities = Entity::all();
        return view('entity.users.modal', compact('entities', 'user'));
    }

    public function removeChallenge($challengeId, $userId)
    {
        $challenge = Challenge::findOrFail($challengeId);
        $challenge->users()->detach($userId);
    }

    public function createEntityUserForm($entity, $role)
    {
        return view('entity.users.modal', compact('entity', 'role'));
    }
}
