<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventRequest;
use App\Jobs\SendEventInvitationEmail;
use App\Models\Challenge;
use App\Models\ChallengeUser;
use App\Models\Cohort;
use App\Models\Event;
use App\Models\EventImage;
use App\Models\EventMeeting;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::where('status', 'active')->get();
        $formated_events = [];
        foreach ($events as $key => $event) {
            $formated_events [] = [
                'id' =>  $event->id,
                'title' =>  $event->subject_en,
                'start' => $event->start_date,
                'end' => $event->end_date,
                'className' => "fc-event-success",
                'description' => $event->agenda,
            ]; 
        }
        $formated_events = json_encode($formated_events);
        return view('events.index', compact('formated_events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $challenges = Challenge::all();
        $users = User::where('status','active')->get();
        return view('events.modal',compact('challenges','users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventRequest $request)
    {
        try{
            $event = Event::create([
                'subject_en' => $request->subject_en,
                'uuid' => Str::uuid(),
                'subject_ar' => $request->subject_ar,
                'platform' =>   $request->is_online ? $request->platform : null,
                'meeting_link' => $request->is_online ?  $request->meeting_link : null,
                'start_date' =>  $request->start_date,
                'end_date' =>  $request->end_date,
                'type' =>  $request->type,
                'event_on' =>  $request->event_on,
                'event_on_id' =>  $request->event_on_id,
                'agenda' => $request->agenda,
                'is_online' => $request->is_online ? 1 : 0,
                'location_en' => $request->is_online ? null : $request->location_en,
                'location_ar' => $request->is_online ? null : $request->location_ar,
                'longitude' => $request->is_online ? null : $request->longitude,
                'latitude' => $request->is_online ? null : $request->latitude,
            ]);
            if ($request->has('images')) {
                foreach ($request->images as $image) {
                    $event->images()->create([
                        'url' => $image
                    ]);
                }
            }
            $userIds = $request->invitation_type == 'user' ? $request->users : ($request->challenges ? ChallengeUser::whereIn('challenge_id',$request->challenges)->pluck('user_id')->all() : null);
            if($userIds != null){
            $event->invitations()->sync($userIds);
            $users = User::find($userIds);
            dispatch(new SendEventInvitationEmail($users, $event));
        }
            return response()->json([
                'status' => JsonResponse::HTTP_OK,
                'message' => 'Event added successfully.'
            ], JsonResponse::HTTP_OK);
        }
        catch(Exception $e){
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
        try {
            $event = Event::findOrFail($id);
            $events_show = view('events.show', compact('event'))->render();
            return \response()->json([
                'status' => JsonResponse::HTTP_OK,
                'view' => $events_show
            ], JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return \response()->json([
                'status' => JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage()
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $challenges = Challenge::all();
            $users = User::where('status','active')->get();
            $event = Event::find($id);
            $data = null;
            if($event->event_on == 'challenges')
            {
                $data = Challenge::select('name_en','id')->get();
            }if($event->event_on == 'cohorts'){
                $data = Cohort::select('name_en','id')->get();
            }
            return  view('events.modal',compact('event','data','challenges','users'));
        } catch (Exception $e) {
            return response()->json([
                'status' => JsonResponse::HTTP_UNPROCESSABLE_ENTITY,
                'message' => $e->getMessage()
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY,);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EventRequest $request, $id)
    {
        
        try{
            $event = Event::find($id);
            $event->update([
                'subject_en' => $request->subject_en,
                'subject_ar' => $request->subject_ar,
                'platform' =>   $request->is_online ? $request->platform : null,
                'meeting_link' => $request->is_online ?  $request->meeting_link : null,
                'start_date' =>  $request->start_date,
                'end_date' =>  $request->end_date,
                'type' =>  $request->type,
                'event_on' =>  $request->event_on,
                'event_on_id' =>  $request->event_on_id,
                'agenda' => $request->agenda,
                'is_online' => $request->is_online ? 1 : 0,
                'location_en' => $request->is_online ? null : $request->location_en,
                'location_ar' => $request->is_online ? null : $request->location_ar,
                'longitude' => $request->is_online ? null : $request->longitude,
                'latitude' => $request->is_online ? null : $request->latitude,
            ]);
            if ($request->has('images')) {
                foreach ($request->images as $image) {
                    $event->images()->updateOrCreate([
                        'url' => $image
                    ]);
                }
            }
            $userIds = $request->invitation_type == 'user' ? $request->users : ( $request->challenges ? ChallengeUser::whereIn('challenge_id',$request->challenges)->pluck('user_id')->all() : null);
            $new_users = $userIds ?  array_diff($userIds,$event->invitations()->pluck('user_id')->toArray()) : null;
            if($new_users != null){
                $event->invitations()->attach($new_users);
                $users = User::find($new_users);
                dispatch(new SendEventInvitationEmail($users, $event));
            }
            if($request->attendance_ids){
                $event->attendance()->sync($request->attendance_ids);
            }
            else{
                $event->attendance ? $event->attendance()->detach() : '';
            }
            if($request->meeting_documents){
                foreach ($request->meeting_documents as $doc) {
                    $event->meeting_documents()->updateOrCreate([
                        'url' => $doc
                    ]);
                }
            }
            return response()->json([
                'status' => JsonResponse::HTTP_OK,
                'message' => 'Event Updated successfully.'
            ], JsonResponse::HTTP_OK);
        }
        catch(Exception $e){
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
            $event = Event::findOrFail($id);
            $event->delete();
            return response()->json([
                'success' => JsonResponse::HTTP_OK,
                'message' => 'Event deleted successfully'
            ], JsonResponse::HTTP_OK);
        } catch(\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage()
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR); 
        }
    }

    public function getEventTypes($name){
        try{ 
            $data = null;
            if($name == 'challenges')
            {
                $data = Challenge::select('name_en','id')->get();
            }if($name == 'cohorts'){
                $data = Cohort::select('name_en','id')->get();
            }
            return \response()->json([
                'status' => JsonResponse::HTTP_OK,
                'data' => $data
            ], JsonResponse::HTTP_OK);
        }catch(Exception $e){

        }
    }
    public function storeImage(Request $request)
    {
        $file = $request->file('file');
        $name = saveResizeImage($request->file('file'),'events',$request->file->getClientOriginalExtension());
        return response()->json([
            'name'          => $name,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }
    public function removeImage($name, $id = null)
    {
        try {
            if ($id != null) {
                $image = EventImage::find($id);
                $image->delete();
            }
            unlink(storage_path('/app/public/events/') . $name);
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
    public function storeMeetingDocument(Request $request)
    {
        $file = $request->file('file');
        $name = saveResizeImage($request->file('file'),'meetings',$request->file->getClientOriginalExtension());
        return response()->json([
            'name'          => $name,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }
    public function removeMeetingDocument($name, $id = null)
    {
        try {
            if ($id != null) {
                $image = EventMeeting::find($id);
                $image->delete();
            }
            unlink(storage_path('/app/public/meetings/') . $name);
            return response()->json([
                'success' => JsonResponse::HTTP_OK,
                'message' => 'Document Removed successfull'
            ], JsonResponse::HTTP_OK);
        } catch (Exception $e) {
            return response()->json([
                'status' => JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage()
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
