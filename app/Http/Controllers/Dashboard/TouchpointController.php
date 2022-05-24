<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\TouchpointRequest;
use App\Models\Cohort;
use App\Models\Touchpoint;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class TouchpointController extends Controller
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
    public function create($cohort_id)
    {
        return view('cohort.touch_points.modal',compact('cohort_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TouchpointRequest $request)
    {
        try{
            DB::beginTransaction();
            Touchpoint::create([
                'uuid' => Str::uuid(),
                'title_en' => $request->title_en,
                'title_ar' => $request->title_ar,
                'subtitle_en' => $request->subtitle_en,
                'subtitle_ar' => $request->subtitle_ar,
                'default_image' => saveResizeImage($request->default_image,'touchpoints',$request->default_image->getClientOriginalExtension()),
                'done_image' => saveResizeImage($request->done_image,'touchpoints',$request->done_image->getClientOriginalExtension()),
                'is_completed' => $request->is_completed ? 1 : 0,
                'is_send_update' => $request->is_send_update ? 1 : 0,
                'cohort_id' => $request->cohort_id
            ]);
            DB::commit();
            return response()->json([
                'success' => JsonResponse::HTTP_OK,
                'message' => 'Touchpoint Added successfully'
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
        $touch_point = Touchpoint::find($id);
        return view('cohort.touch_points.modal',compact('touch_point'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TouchpointRequest $request, $id)
    {
        try{
            DB::beginTransaction();
            $touch_point = Touchpoint::find($id);
            $touch_point->update([
                'title_en' => $request->title_en,
                'title_ar' => $request->title_ar,
                'subtitle_en' => $request->subtitle_en,
                'subtitle_ar' => $request->subtitle_ar,
                'default_image' => $request->default_image ? saveResizeImage($request->default_image,'touchpoints',$request->default_image->getClientOriginalExtension()) : $touch_point->default_image,
                'done_image' => $request->done_image ?  saveResizeImage($request->done_image,'touchpoints',$request->done_image->getClientOriginalExtension()) : $touch_point->done_image,
                'is_completed' => $request->is_completed ? 1 : 0,
                'is_send_update' => $request->is_send_update ? 1 : 0,
            ]);
            DB::commit();
            return response()->json([
                'success' => JsonResponse::HTTP_OK,
                'message' => 'Touchpoint Updated successfully'
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
            Touchpoint::find($id)->delete();
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
        $touch_points = Cohort::find($request->cohort)->touchpoints;
        return DataTables::of($touch_points)
        ->editColumn('default_image', function ($record) {
                $url = asset('storage/' . $record->default_image);
                return '<img src="' . $url . '" class="img img-thumbnail img-rounded" style="width:100px;height:100px" />';
        })
        ->editColumn('done_image', function ($record) {
            $url = asset('storage/' . $record->done_image);
            return '<img src="' . $url . '" class="img img-thumbnail img-rounded" style="width:100px;height:100px" />';
        })
        ->editColumn('is_completed', function ($cohort) {

            $isChecked = $cohort->is_completed== 1 ? 'checked' : '';
            $statusTobeUpdate = $cohort->is_completed == 1 ? 0 : 1;
            $actions = '<div class="preview-block">
                            <div class="custom-control custom-switch custom-control-sm">
                                <input type="checkbox" class="custom-control-input toggle-clicked is-completed-toggle"  id="customSwitch-' . $cohort->id . '" ' . $isChecked . ' data-status="' . $statusTobeUpdate . '" data-url="' . route('dashboard.complete-touchpoint', $cohort->id) . '" data-table="#touch_point_table">
                                <label class="custom-control-label switch-style2" for="customSwitch-' . $cohort->id . '"></label>
                            </div>
                        </div>';
            return $actions;
        })
        ->editColumn('is_active', function ($touch) {

            $isChecked = $touch->is_active== 1 ? 'checked' : '';
            $statusTobeUpdate = $touch->is_active == 1 ? 0 : 1;
            $actions = '<div class="preview-block">
                            <div class="custom-control custom-switch custom-control-sm">
                                <input type="checkbox" class="custom-control-input toggle-clicked is-active-toggle"  id="customSwitch-' . $touch->uuid . '" ' . $isChecked . ' data-status="' . $statusTobeUpdate . '" data-url="' . route('dashboard.active-touchpoint', $touch->id) . '" data-table="#touch_point_table">
                                <label class="custom-control-label switch-style2" for="customSwitch-' . $touch->uuid . '"></label>
                            </div>
                        </div>';
            return $actions;
        })
        ->addColumn('actions', function ($record) {
            return '<div class="page-right-dot-option table-options"><div class="dropdown">
            <a href="" class="dropdown-toggle btn btn-sm btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
            <div class="dropdown-menu dropdown-menu-right">
                <ul class="link-list-opt no-bdr">
                <li><a href="javascript:void(0)" data-act="ajax-modal"  data-table="touch_point_table" data-action-url="' . route('dashboard.touchpoints.edit', $record->id) . '" data-method="get" data-title="Edit Touchpoint"><em class="icon ni ni-edit"></em><span>Edit Touchpoint</span></a></li>
                <li><a href="javascript:void(0)" class="delete " data-table="touch_point_table" data-url="' . route('dashboard.touchpoints.destroy', $record->id) . '"><em class="icon ni ni-trash text-danger"></em><span>Remove Touchpoint</span> </a></li>  
                </ul>
            </div>
        </div></div>';
        })
        ->rawColumns(['default_image','done_image','actions','is_completed','is_active'])
        ->addIndexColumn()->make(true);
    }
    public function completeTouchpoint(Request $request,$id){
        try {
            $touch_point = Touchpoint::find($id);
            $touch_point->update([
                'is_completed' => $request->status == 1 ? 1 : 0,
                'is_active' => 0
            ]);
            
            return response()->json([
                'status' => JsonResponse::HTTP_OK,
                'message' => 'Touchpoint updated successfully.'
            ], JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'status' => JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage()
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function activeTouchpoint(Request $request,$id){
        try {
            $touch_point = Touchpoint::find($id);
            if($request->status == 1 ){
                Touchpoint::where('cohort_id', $touch_point->cohort_id)->where('id','!=',$id)->update(['is_active' => 0]);
            }
            $touch_point->update([
                'is_active' => $request->status == 1 ? 1 : 0,
                'is_completed' => 0
            ]);
            
            return response()->json([
                'status' => JsonResponse::HTTP_OK,
                'message' => 'Touchpoint updated successfully.'
            ], JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'status' => JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage()
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
