<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\EntityType;
use Illuminate\Http\Request;
use App\Http\Requests\EntityRequest;
use App\Models\Challenge;
use Illuminate\Support\Str;
use App\Models\Entity;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Facades\DataTables;


class ChallengeEntity extends Controller
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
        $challenge = Challenge::find($challenge_id);
        $entities = Entity::where('status', 'active')->get();
        $entityTypes = EntityType::where('status', 'active')->latest()->get();
        return view('challenge.entities.modal', compact('challenge', 'entityTypes', 'entities'));
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
            $challenge = Challenge::find($request->challenge_id);
            DB::beginTransaction();
            if ($request->is_existing == true) {
                $challenge->secondary_entities()->sync($request->entities);
            } else {
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
                $challenge->secondary_entities()->attach($entity->id);
            }
            $ids = $challenge->secondary_entities()->pluck('entity_id')->toArray();
            if (!in_array($challenge->lead_entity_id, $ids)) {
                $challenge->secondary_entities()->attach($challenge->lead_entity_id);
            }
            DB::commit();
            return response()->json([
                'status' => JsonResponse::HTTP_OK,
                'message' => 'Entity added successfully.'
            ], JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            DB::rollBack();
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
        //
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
    public function destroy($id, $challenge_id)
    {
        try {
            $challenge = Challenge::find($challenge_id);
            $challenge->secondary_entities()->detach($id);
            return response()->json([
                'success' => JsonResponse::HTTP_OK,
                'message' => 'Successfully Remove',
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
        $challenge = Challenge::where('id', $request->challenge)->firstOrFail();
        $entities = $challenge->secondary_entities;
        return DataTables::of($entities)
            ->addColumn('lead_entity_id', function ($entities) use ($challenge) {
                $isReadOnly = $entities->id == $challenge->lead_entity_id ? 'disabled' : '';
                $isChecked = $entities->id == $challenge->lead_entity_id ? 'checked' : '';
                $statusTobeUpdate = $entities->id;
                $actions = '<div class="preview-block">
                            <div class="custom-control custom-switch custom-control-sm">
                                <input type="checkbox" class="custom-control-input toggle-clicked is-completed-toggle"  id="lead_entity_switch-' . $entities->id . '" ' . $isChecked . ' ' . $isReadOnly . ' data-status="' . $statusTobeUpdate . '" data-url="' . route('dashboard.challange-leadentity-change', $challenge->id) . '" data-table="#entities_table">
                                <label class="custom-control-label switch-style2"  for="lead_entity_switch-' . $entities->id . '"></label>
                            </div>
                        </div>';
                return $actions;
            })->addColumn('actions', function ($record) use ($challenge) {
                $action = '';
                $action .= '<div class="page-right-dot-option table-options"><div class="dropdown">
                                            <a href="" class="dropdown-toggle btn btn-sm btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <ul class="link-list-opt no-bdr">';
                if ($record->id == $challenge->lead_entity_id) {
                    $action .= '<li class="p-2">Cannot Remove Lead Entity</li>';
                } else {
                    $action .= ' <li><a href="javascript:void(0)" class="delete " data-table="entities_table" data-url="' . route('dashboard.challenge-entity.destroy', [$record->id, $challenge->id]) . '"><em class="icon ni ni-trash text-danger"></em><span>Remove Entity from challenge</span> </a></li>  
                                                ';
                }
                $action .=  '</ul>
                            </div>
                        </div>
                    </div>';
                return $action;
            })
            ->addColumn('members', function ($record) {
                return $record->users->count();
            })
            ->addColumn('sponsor', function ($record) {
                return '----';
            })
            ->rawColumns(['members', 'lead_entity_id', 'actions','sponsor'])
            ->addIndexColumn()->make(true);
    }
    public function leadentityChange(Request $request, $id)
    {
        try {

            $challenge = Challenge::find($id);
            $challenge->update([
                'lead_entity_id' => $request->status
            ]);

            return response()->json([
                'status' => JsonResponse::HTTP_OK,
                'message' => 'Entity lead updated successfully.'
            ], JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'status' => JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage()
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
