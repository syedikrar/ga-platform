<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Models\AccWorkstream;
use App\Models\ChallengeUsers;
use App\Models\Task;
use App\Models\TaskImage;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TaskController extends Controller
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
    public function create($workstream_id)
    {
        
        $workstream = AccWorkstream::find($workstream_id);
        $usersId = $workstream->members()->pluck('user_id')->all();
        $members = User::with('challenges')->orderBy('created_at', 'desc')->find($usersId);
        return view('challenge.plan.acceleration_workstreams.tasks.modal',compact('workstream_id','members'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskRequest $request)
    {
        try{
            DB::beginTransaction();
            $task = Task::create([
                'uuid' => Str::uuid(),
                'title_en' => $request->title_en,
                'title_ar' => $request->title_ar,
                'priority' => $request->priority,
                'progress' => $request->progress,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'status' => $request->status,
                'acc_workstream_id' => $request->acc_workstream_id
            ]);
            $task->members()->sync($request->member_id);
            if ($request->has('images')) {
                foreach ($request->images as $image) {
                    $task->images()->create([
                        'url' => $image
                    ]);
                }
            }
            DB::commit();
            return response()->json([
                'success' => JsonResponse::HTTP_OK,
                'message' => 'Task Added successfully'
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
        $task = Task::find($id);
        $workstream = AccWorkstream::find($task->acc_workstream_id);
        $usersId = $workstream->members()->pluck('user_id')->all();
        $members = User::with('challenges')->orderBy('created_at', 'desc')->find($usersId);
        return view('challenge.plan.acceleration_workstreams.tasks.modal',compact('task','members'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TaskRequest $request, $id)
    {
        try{
            DB::beginTransaction();
            $task =Task::find($id);
             $task->update([
                'title_en' => $request->title_en,
                'title_ar' => $request->title_ar,
                'priority' => $request->priority,
                'progress' => $request->progress,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'status' => $request->status,
            ]);
            $task->members()->sync($request->member_id);
            if ($request->has('images')) {
                foreach ($request->images as $image) {
                    $task->images()->updateOrCreate([
                        'url' => $image
                    ]);
                }
            }
            DB::commit();
            return response()->json([
                'success' => JsonResponse::HTTP_OK,
                'message' => 'Task Updated successfully'
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
            Task::find($id)->delete();
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
    public function storeImage(Request $request)
    {
        $file = $request->file('file');
        $name = saveResizeImage($request->file('file'),'tasks',$request->file->getClientOriginalExtension());
        return response()->json([
            'name'          => $name,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }
    public function removeImage($name, $id = null)
    {
        try {
            if ($id != null) {
                $image = TaskImage::find($id);
                $image->delete();
            }
            unlink(storage_path('/app/public/tasks/') . $name);
            return response()->json([
                'success' => JsonResponse::HTTP_OK,
                'message' => 'Image Removed successfull'
            ], JsonResponse::HTTP_OK);
        } catch (Exception $e) {
            return response()->json([
                'status' => JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage()
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
