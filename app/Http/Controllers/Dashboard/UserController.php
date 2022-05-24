<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Http\JsonResponse;
use App\Models\User;
use App\Http\Requests\UserRequest;
use Database\Seeders\UserSeeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use App\Jobs\SendEmailJob;
use App\Jobs\SendWelcomeEmailJob;
use App\Models\Challenge;
use App\Models\Entity;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use App\Models\Role;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;
use DB;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::where('type', 'system_user')->get();
        return view('user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        try {
            $validated = $request->validated();
           
            $user = User::create([
                'uuid'           => Str::uuid(),
                'name_en'        => $validated['name_en'],
                'name_ar'        => $validated['name_ar'],
                'email'          => $validated['email'],
                'phone'          => '+971' .$validated['phone'],
                'entity_id'      => $validated['entity'],
                'status'         => 'active',
                'password'       => Hash::make('12345678')
            ]);

            if (array_key_exists('challenge_id', $validated)) {
                $challenge = Challenge::where('id', $validated['challenge_id'])->firstOrFail();
                $challenge->users()->attach($user);
                $role = Role::where('name', $validated['role'])->first();
                $baseClass = class_basename(App\Models\Challenge::class);
                $model = new User;
                $model->storeUserRoles($role->id, $user->id, $baseClass, $challenge->id);
                $entity = Entity::findOrFail($validated['entity'])->first();
                $model->storeUserRoles(6, $user->id, 'Entity', $entity->id);
                Password::sendResetLink(array('email' => $validated['email']));
            } else {
                $role = Role::where('name', $validated['role'])->first();
                $entity = Entity::findOrFail($validated['entity']);
                $baseClass = class_basename(App\Models\Entity::class);
                $model = new User;
                $model->storeUserRoles($role->id, $user->id, $baseClass, $entity->id);
                Password::sendResetLink(array('email' => $validated['email']));
            }
            
            if ($request->has('send_email')) {
                dispatch(new SendEmailJob($validated['email'], $user, $challenge = null));
            }

            return response()->json([
                'status' => JsonResponse::HTTP_OK,
                'message' => 'User added successfully.'
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
        $user = User::with('entity')->findOrFail($id);
        $entities = Entity::all();
        return view('user.edit', compact('user', 'entities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        
        try {
            $validated = $request->validated();
            
            if(array_key_exists("entity",$validated))
            {
                $user = $user->update([
                    'uuid'           => Str::uuid(),
                    'name_en'        => $validated['name_en'],
                    'name_ar'        => $validated['name_ar'],
                    'email'          => $validated['email'],
                    'phone'          => $validated['phone'],
                    'entity_id'      => $validated['entity'],
                ]);
            }
            else{
                $user = $user->update([
                    'uuid'           => Str::uuid(),
                    'name_en'        => $validated['name_en'],
                    'name_ar'        => $validated['name_ar'],
                    'email'          => $validated['email'],
                    'phone'          => $validated['phone'],
                ]);
            }
            return response()->json([
                'status' => JsonResponse::HTTP_OK,
                'message' => 'User updated successfully.'
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
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json([
            'status' => JsonResponse::HTTP_OK,
            'message' => 'User Deleted successfully.'
        ], JsonResponse::HTTP_OK);
    }

    /**
     * Store a newly created user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeUser(UserRequest $request)
    {
        try {
            $validated = $request->validated();
            
            $user = User::create([
                'uuid'           => Str::uuid(),
                'name_en'        => $validated['name_en'],
                'name_ar'        => $validated['name_ar'],
                'email'          => $validated['email'],
                'phone'          => $validated['phone'],
                'entity_id'      => $validated['entity'],
                'status'         => 'active',
                'password'       => Hash::make('12345678')
            ]);

            $user->assignRole($validated['role']);
            Password::sendResetLink(array('email' => $validated['email']));
            if ($request->has('send_email')) {
                dispatch(new SendEmailJob($validated['email'], $user, $challenge = null));
            }

            return response()->json([
                'status' => JsonResponse::HTTP_OK,
                'message' => 'User added successfully.'
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
        $usersIds = DB::table('model_has_roles')->where('entityable_type', null)->pluck('model_id');
        $users = User::findMany($usersIds)->sortByDesc('updated_at');
      
        return Datatables::of($users)
            ->addColumn('English Name', function ($user) {
                return '<div class="user-card">
                            <div class="user-avatar">
                                <img src="' . getImage($user->profile_photo_path) . '" alt="">
                            </div>
                            <div class="user-info">
                                <a href="#"><span>' . $user->name_en . '</span></a>
                            </div>
                         </div>';
            })->addColumn('Arabic Name', function ($user) {
                return $user->name_ar;
            })->addColumn('email', function ($user) {
                return $user->email;
            })->addColumn('role', function ($user) {
                $role = [];
                if (count($user->roles)) {
                    foreach ($user->roles as $role) {
                        $role =  $role->name;
                    }
                }
                return $role;
            })->addColumn('active', function ($user) {
                $isChecked = $user->status == 'active' ? 'checked' : '';
                $statusTobeUpdate = $user->status == 'active' ? 'inactive' : 'active';
                return '<div class="preview-block">
                <div class="custom-control custom-switch custom-control-sm">
                    <input type="checkbox" class="custom-control-input toggle-clicked"  id="customSwitch' . $user->id . '" ' . $isChecked . ' data-status="' . $statusTobeUpdate . '" data-url="' . route('dashboard.entities.user.change-status', $user->id) . '" data-table="#entities_table">
                    <label class="custom-control-label switch-style2" for="customSwitch' . $user->id . '"></label>
                </div>
            </div>';
            })->addColumn('last seen', function ($user) {
                return '12 November 2022, 12:00pm';
            })
            ->addColumn('actions', function ($user) {
                return '<div class="page-right-dot-option table-options">
                <div class="dropdown">
                    <a href="" class="dropdown-toggle btn btn-sm btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <ul class="link-list-opt no-bdr">
                            <li>
                                <a href="javascript:void(0);" data-act="ajax-modal" data-complete-location="true" data-method="get"
                                data-action-url="' . route("dashboard.user.edit-form", $user->id) . '" data-table="#entities_table"> <span class="fa-icon"> <i class="fa-solid fa-pen-to-square"></i></span> Edit
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" id="customSwitch' . $user->id . '" class="toggle-clicked" data-status="resend_email_verification"  data-url="' . route('dashboard.user.send-welcome-mail', $user->email) . '" data-table="#entities_table">
                                <span class="fa-icon"><i class="fa-solid fa-envelope"></i></span><span>Resend Activation Email</span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" class="delete" data-table="entities_table" data-url="' . route('dashboard.user.destroy', $user->id) . '"><span class="fa-icon"><i class="fa-solid fa-trash-can"></i></span><span>DELETE</span> </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>';
            })
            ->rawColumns(['English Name', 'actions', 'name', 'challenges', 'active'])
            ->addIndexColumn()->make(true);
    }

    public function sendWelcomeMail($email){
        try {
            if ($email) {
                dispatch(new SendWelcomeEmailJob($email));
            }
            return response()->json([
                'status' => JsonResponse::HTTP_OK,
                'message' => 'Email ('.$email.') sent to User successfully.'
            ], JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'status' => JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage()
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
     }

     public function editUserForm($id)
     {
        $user = User::findOrFail($id);
        $entities = Entity::all();
        return view('user.edit', compact('user', 'entities'));
     }

     public function entityUserForm($roleName)
     {
        $role = Role::where('name', $roleName)->first();
        $entities = Entity::all();
        return view('user.entities_users.create', compact('role', 'entities'));
     }

     public function entitiesUsersDataTable(Request $request)
    {
        $entitiesUsers = User::with('entity')->where('entity_id', '!=', null)->get()->sortByDesc('updated_at');
        
        return Datatables::of($entitiesUsers)
            ->addColumn('English Name', function ($user) {
                return '<div class="user-card">
                            <div class="user-avatar">
                                <img src="' . getImage($user->profile_photo_path) . '" alt="">
                            </div>
                            <div class="user-info">
                                <a href="#"><span>' . $user->name_en . '</span></a>
                            </div>
                         </div>';
            })->addColumn('Arabic Name', function ($user) {
                return $user->name_ar;
            })->addColumn('email', function ($user) {
                return $user->email;
            })->addColumn('entity', function ($user) {
                return $user->entity ? $user->entity->name_en : '';
            })->addColumn('active', function ($user) {
                $isChecked = $user->status == 'active' ? 'checked' : '';
                $statusTobeUpdate = $user->status == 'active' ? 'inactive' : 'active';
                return '<div class="preview-block">
                <div class="custom-control custom-switch custom-control-sm">
                    <input type="checkbox" class="custom-control-input toggle-clicked"  id="customSwitch' . $user->id . '" ' . $isChecked . ' data-status="' . $statusTobeUpdate . '" data-url="' . route('dashboard.entities.user.change-status', $user->id) . '" data-table="#entities_users_table">
                    <label class="custom-control-label switch-style2" for="customSwitch' . $user->id . '"></label>
                </div>
            </div>';
            })->addColumn('last seen', function ($user) {
                return '12 November 2022, 12:00pm';
            })
            ->addColumn('actions', function ($user) {
                return '<div class="page-right-dot-option table-options">
                <div class="dropdown">
                    <a href="" class="dropdown-toggle btn btn-sm btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <ul class="link-list-opt no-bdr">
                            <li>
                                <a href="javascript:void(0);" data-act="ajax-modal" data-complete-location="true" data-method="get"
                                data-action-url="' . route("dashboard.user.entity-edit-form", $user->id) . '" data-table="#entities_users_table"> <span class="fa-icon"> <i class="fa-solid fa-pen-to-square"></i></span> Edit
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" id="customSwitch' . $user->id . '" class="toggle-clicked" data-status="resend_email_verification"  data-url="' . route('dashboard.user.send-welcome-mail', $user->email) . '" data-table="#entities_users_table">
                                <span class="fa-icon"><i class="fa-solid fa-envelope"></i></span><span>Resend Activation Email</span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" class="delete" data-table="#entities_users_table" data-url="' . route('dashboard.user.destroy', $user->id) . '"><span class="fa-icon"><i class="fa-solid fa-trash-can"></i></span><span>DELETE</span> </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>';
            })
            ->rawColumns(['English Name', 'actions', 'name', 'challenges', 'active'])
            ->addIndexColumn()->make(true);
    }

    public function editEntityUserForm($id)
    {
        $user = User::findOrFail($id);
        $entities = Entity::all();
        return view('user.entities_users.edit', compact('user', 'entities'));
    }
}
