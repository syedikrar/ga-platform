<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EntityContact;
use App\Models\Entity;
use App\Http\Requests\EntityContactRequest;
use App\Traits\FIleUploadTrait;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\JsonResponse;

class EntityContactController extends Controller
{
    use FIleUploadTrait;
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('entity.contact')->render();
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EntityContactRequest $request)
    {
        try {
            $validated = $request->validated();
            $entity = Entity::where('uuid',$validated['entity'])->firstOrFail();
            $contact = EntityContact::create([
                'uuid'      => Str::uuid(),
                'entity_id' => $entity->id,
                'name_en'   => $validated['name_en'],
                'name_ar'   => $validated['name_ar'],
                'title'     => $validated['title'],
                'email'     => $validated['email'],
                'remarks'   => $validated['remarks'],
                'designation_en' => $validated['designation_en'],
                'designation_ar' => $validated['designation_ar'],
                'phone_number'   => '+971'.$validated['phone'],
                'mobile_number'  => '+971'.$validated['mobile'],
            ]);
            if ($request->has('avatar')) {
                $this->uploadLogo($request->file('avatar'), $contact);
            }
            return response()->json([
                'status' => JsonResponse::HTTP_OK,
                'message' => 'Entity contact added successfully.'
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
       
    }
    public function edit($uuid)
    {
        $contact = EntityContact::where('uuid',$uuid)->firstOrFail();
        return view('entity.contact',compact('contact'))->render();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EntityContactRequest $request, $uuid)
    {
        try {
            
            $validated = $request->validated();
            $contact = EntityContact::where('uuid',$uuid)->firstOrFail();
            $contact->update([
                'name_en'   => $validated['name_en'],
                'name_ar'   => $validated['name_ar'],
                'title'     => $validated['title'],
                'email'     => $validated['email'],
                'remarks'   => $validated['remarks'],
                'designation_en' => $validated['designation_en'],
                'designation_ar' => $validated['designation_ar'],
                'phone_number'   => '+971'.$validated['phone'],
                'mobile_number'  => '+971'.$validated['mobile'],
            ]);

            if ($request->has('avatar')) {
                $this->uploadLogo($request->file('avatar'), $contact);
            }
            
            return response()->json([
                'status' => JsonResponse::HTTP_OK,
                'message' => 'Contact updated successfully.'
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
        $contacts = EntityContact::select('*');

        if ($request->get('entity')) {
            $contacts->where('entity_id', $request->get('entity'));
        }
        $contacts = $contacts->latest()->get();
        return Datatables::of($contacts)
        ->addColumn('name', function ($contact) {
            $contact->avatar ? $url = asset('storage/'.$contact->avatar) : $url = asset('images/dashboard/placeholder-image.png');
            return '<div class="user-card">
                        <div class="user-avatar">
                            <img src="'. $url .'" alt="">
                        </div>
                        <div class="user-info">
                            <a href="javascript:void(0)">'.$contact->title.$contact->name_en.'</a>
                        </div>
                     </div>';
        })
        ->addColumn('actions', function ($contact) use ($authUser) {
            return '<div class="export"> 
                            <a href="javascript:void(0);" data-act="ajax-modal" data-complete-location="true" data-method="get"
                                data-action-url="'.route("dashboard.entity-contacts.edit",$contact->uuid).'" data-table="entity-types-table"
                                data-title="EDIT ENTITY TYPE"> <em class="icon ni ni-edit"></em> 
                            Edit</a>
                        </div>';
        })
        ->rawColumns(['name','actions'])
        ->addIndexColumn()->make(true);
    }
    protected function uploadLogo($logo, $contact)
    {
        $name = Str::slug($contact->name_en).'_'.time();
        $folder = 'uploads/images/contacts/';
        $filePath = $folder . $name. '.' . $logo->getClientOriginalExtension();
        $this->uploadFile($logo, $folder, 'public', $name);
        $contact->update(['avatar'=>$filePath]);
    }
}
