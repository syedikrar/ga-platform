<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Whoops\RunInterface;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Redirect::to('login');
});

Route::get('/register', function () {
    return Redirect::to('login');
});

Route::get('/set-locale/{locale}', [App\Http\Controllers\Dashboard\TranslationController::class, 'setLocale']);

Route::namespace('App\Http\Controllers\Dashboard')
    ->middleware(['auth:sanctum', 'verified'])
    ->as('dashboard.')
    ->prefix('dashboard')
    ->group(function () {

        Route::get('/home', function(){
            return view('dashboard');
        })->name('home');

        //user 
        Route::resource('user', UserController::class);
        Route::put('/user/resend_email_verification/{email}', [App\Http\Controllers\Dashboard\UserController::class, 'sendWelcomeMail'])->name('user.send-welcome-mail');
        Route::post('/user/store_user', [App\Http\Controllers\Dashboard\UserController::class, 'storeUser']);
        Route::get('/user-dt', [App\Http\Controllers\Dashboard\UserController::class, 'dataTable'])
                ->name('user.datatable');
        Route::get('/entities-user-datatable', [App\Http\Controllers\Dashboard\UserController::class, 'entitiesUsersDataTable'])
        ->name('entities.users.datatable');
        Route::put('/user/update_user_role/{role}/{user}/{challenge}', [App\Http\Controllers\Dashboard\RoleController::class, 'udpdateUserRole'])
                ->name('role.updateUserRole');        
        Route::get('/user/edit-form/{id}', [App\Http\Controllers\Dashboard\UserController::class, 'editUserForm'])->name('user.edit-form');    
        Route::get('/user/entity-form/{role}', [App\Http\Controllers\Dashboard\UserController::class, 'entityUserForm'])->name('user.entity-form');    
        Route::get('/user/entity-edit-form/{id}', [App\Http\Controllers\Dashboard\UserController::class, 'editEntityUserForm'])->name('user.entity-edit-form');
        //roles 
        Route::resource('roles', RoleController::class);
        // Entites
        Route::resource('entities', EntityController::class); 
        Route::get('/entities-dt', [App\Http\Controllers\Dashboard\EntityController::class, 'dataTable'])
                ->name('entities.datatable');
        Route::get('/entity-types-filter', [App\Http\Controllers\Dashboard\EntityController::class, 'entityTypesFilter'])
                ->name('entities.entity-types-filter');
        
        Route::get('/entity/user/entity-user-form/{id}/{role}', [App\Http\Controllers\Dashboard\EntityController::class, 'createEntityUserForm'])->name('entities.user.entity-user-form');

        Route::get('/entity/user/edit-form/{id}', [App\Http\Controllers\Dashboard\EntityController::class, 'editEntityUserForm'])->name('entities.user.edit-form');

        Route::get('/entityusers-dt/{id}', [App\Http\Controllers\Dashboard\EntityController::class, 'entityUsersdataTable'])
        ->name('entityUsers.dataTable');
        Route::put('entity/change-status/{id}', [App\Http\Controllers\Dashboard\EntityController::class, 'changeStatus'])
                ->name('entities.user.change-status');
        Route::put('entity/user/remove-challenge/{challengeId}/{userId}', [App\Http\Controllers\Dashboard\ChallengeController::class, 'removeChallenge'])
        ->name('entities.user.remove-challenge');
        Route::put('entity/user-role-switch/{userId}/{entityId}', [App\Http\Controllers\Dashboard\EntityController::class, 'updateUserRole'])
        ->name('entities.user.role.switch');
        // Entity Types
        Route::resource('entity-types', EntityTypeController::class);
        Route::get('/entity-types-dt', [App\Http\Controllers\Dashboard\EntityTypeController::class, 'dataTable'])
                ->name('entity-types.datatable');

        // Entity Contact
        Route::resource('entity-contacts', EntityContactController::class);
        Route::get('/entity-contacts-dt', [App\Http\Controllers\Dashboard\EntityContactController::class, 'dataTable'])
                ->name('entity-contacts.datatable');

        // calendar
        Route::resource('calendars', EventController::class);
        Route::get('event/data/{name}',[App\Http\Controllers\Dashboard\EventController::class,'getEventTypes'])->name('event-types');
        Route::post('event/store/Image',[App\Http\Controllers\Dashboard\EventController::class,'storeImage'])->name('event.storeImage');
        Route::delete('event/remove/Image/{name}/{id?}',[App\Http\Controllers\Dashboard\EventController::class,'removeImage'])->name('event.removeImage');
        Route::post('event/store/meeting/document',[App\Http\Controllers\Dashboard\EventController::class,'storeMeetingDocument'])->name('event.store-meeting-document');
        Route::delete('event/remove/meeting/document/{name}/{id?}',[App\Http\Controllers\Dashboard\EventController::class,'removeMeetingDocument'])->name('event.remove-meeting-document');
        
        
       
        //Cohorts 
        Route::resource('cohorts', CohortController::class);
        Route::get('/cohorts-dt', [App\Http\Controllers\Dashboard\CohortController::class, 'dataTable'])
                ->name('cohorts.datatable');
        Route::get('/cohort-show-dt', [App\Http\Controllers\Dashboard\CohortController::class, 'dataTableShow'])
        ->name('cohorts.datatable-show');
        Route::put('update-cohort-status/{uuid}', [App\Http\Controllers\Dashboard\CohortController::class, 'updateStatus'])
                ->name('cohorts.update-status');

        // Cohort Types
        Route::resource('cohort-types', CohortTypeController::class);
        Route::get('/cohort-types-dt', [App\Http\Controllers\Dashboard\CohortTypeController::class, 'dataTable'])
                ->name('cohort-types.datatable');

        // Cohort Stages
        Route::resource('stages', StageController::class);
        Route::get('/stages-dt', [App\Http\Controllers\Dashboard\StageController::class, 'dataTable'])
                ->name('stages.datatable');

        // Challenges
        Route::resource('challenges', ChallengeController::class);
        Route::get('/challenges-dt', [App\Http\Controllers\Dashboard\ChallengeController::class, 'dataTable'])
                ->name('challenges.datatable');
        Route::get('/challenges-members-dt/{id}', [App\Http\Controllers\Dashboard\ChallengeController::class, 'membersDataTable'])
        ->name('challenges.membersDataTable');
        Route::get('/challenge/get_plans', [App\Http\Controllers\Dashboard\ChallengeController::class,'getPlans']);
        Route::put('update-challenge-stage/{uuid}', [App\Http\Controllers\Dashboard\ChallengeController::class, 'change_stage'])
                ->name('challenges.update-stage');
        Route::get('/challenge/get_existing_user_form/{id}/{role}', [App\Http\Controllers\Dashboard\ChallengeController::class, 'existingUserForm'])
                ->name('challenges.existing-user-form');
        
        Route::get('/challenge/add-user-form/{id}/{role}', [App\Http\Controllers\Dashboard\ChallengeController::class, 'userForm'])->name('challenge.add-user-form');
        
        Route::post('/challenge/add_user', [App\Http\Controllers\Dashboard\ChallengeController::class,'addUsers'])->name('challenge.add_user');
        Route::get('/challenge/plan/get_work_stream_form', [App\Http\Controllers\Dashboard\WorkStreamController::class,'getWorkStreamForm']);
        
        //Plan-->Workstream
        Route::resource('workstreams', WorkStreamController::class)->except(['create']);
        Route::get('workstream/create/{challenge_id}',[App\Http\Controllers\Dashboard\WorkStreamController::class,'create'])->name('workstream.create');
        Route::get('workstream/datatable',[App\Http\Controllers\Dashboard\WorkStreamController::class,'datatable'])->name('workstream.datatable');
       
        //Plan-->Acceleration Workstream
        Route::resource('acceleration-workstreams',AccelerationWorkStream::class)->except(['create']);
        Route::get('acceleration/workstreams/create/{challenge_id}',[App\Http\Controllers\Dashboard\AccelerationWorkStream::class,'create'])->name('acceleration-workstreams.create');
        Route::get('acceleration/workstream/datatable',[App\Http\Controllers\Dashboard\AccelerationWorkStream::class,'datatable'])->name('acceleration.workstream.datatable');
        
        //challange Entities
        Route::resource('challenge-entities',ChallengeEntity::class)->except('destroy');
        Route::get('challenge/entity/create/{challenge_id}',[App\Http\Controllers\Dashboard\ChallengeEntity::class,'create'])->name('challenge-entity.create');
        Route::get('challenge/entities/datatable',[App\Http\Controllers\Dashboard\ChallengeEntity::class,'datatable'])->name('challenge-entities.datatable');
        Route::put('challange/leadentity/change/{id}',[App\Http\Controllers\Dashboard\ChallengeEntity::class,'leadentityChange'])->name('challange-leadentity-change');
        Route::delete('challenge-entities/destroy/{id}/{challenge_id}',[App\Http\Controllers\Dashboard\ChallengeEntity::class,'destroy'])->name('challenge-entity.destroy');
        //Tasks
        Route::resource('acc-workstream-tasks', TaskController::class)->except(['create']);
        Route::get('acc-workstream/tasks/create/{workstream_id}',[App\Http\Controllers\Dashboard\TaskController::class,'create'])->name('acc-workstream.tasks.create');
        Route::post('task/store/Image',[App\Http\Controllers\Dashboard\TaskController::class,'storeImage'])->name('task.storeImage');
        Route::delete('task/remove/Image/{name}/{id?}',[App\Http\Controllers\Dashboard\TaskController::class,'removeImage'])->name('task.removeImage');
        
        //touchpoints

        Route::resource('touchpoints',TouchpointController::class)->except(['create']);
        Route::get('touchpoint/create/{cohort_id}',[App\Http\Controllers\Dashboard\TouchpointController::class,'create'])->name('touchpoint.create');
        Route::get('touchpoint/datatable',[App\Http\Controllers\Dashboard\TouchpointController::class,'datatable'])->name('touchpoint.datatable');
        Route::put('complete/touchpoint/{id}',[App\Http\Controllers\Dashboard\TouchpointController::class,'completeTouchpoint'])->name('complete-touchpoint');
        Route::put('active/touchpoint/{id}',[App\Http\Controllers\Dashboard\TouchpointController::class,'activeTouchpoint'])->name('active-touchpoint');

        
        //Plans
        Route::resource('plans', PlanController::class);

        // Risk
        Route::resource('risks', RiskController::class);
        Route::get('/risks-dt', [App\Http\Controllers\Dashboard\RiskController::class, 'dataTable'])
        ->name('risks.datatable');

        
        // Translations
        Route::resource('translations', TranslationController::class);
        Route::get('/translations-dt', [App\Http\Controllers\Dashboard\TranslationController::class, 'dataTable'])
                ->name('translations.datatable');
        

});