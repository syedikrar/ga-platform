<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\JsonResponse;
use Spatie\TranslationLoader\LanguageLine;
use Illuminate\Support\Facades\Validator;


class TranslationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('translation.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('translation.modal');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validator::extend('uniqueKeyAndGroup', function() use ($request) {
            return LanguageLine::where('key', $request->key)->where('group', $request->group)->count() === 0;
        }, 'Same key and group already exists.');

        $validator = Validator::make($request->all(), [
            'group'     => ['required', 'uniqueKeyAndGroup'],
            'key'       => ['required'],
            'english'   => ['required'],
            'arabic'    => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => JsonResponse::HTTP_UNPROCESSABLE_ENTITY,
                'message' => $validator->errors()->first(),
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            $inputs = $request->all();
            $inputs['text'] = ['en'=> $request->english, 'ar'=> $request->arabic];           
            LanguageLine::create($inputs);

             return response()->json([
                'success' => JsonResponse::HTTP_OK,
                'message' => 'Translation created successfully.'
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
        $translation = LanguageLine::find($id);
        return view('translation.modal', compact('translation'));
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
        $validator = Validator::make($request->all(), [
            'english' => ['required'],
            'arabic' => ['required'],
        ]);

        if ($validator->fails()) {
            flash()->error($validator->errors()->first());
            return redirect()->back();
        }

        try {
            $translation = LanguageLine::find($id);
            $inputs = [];
            $inputs['text'] = ['en'=> $request->english, 'ar'=> $request->arabic];           
            $translation->update($inputs);

            return response()->json([
                'success' => JsonResponse::HTTP_OK,
                'message' => 'Translation updated successfully.'
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
        $languageLine = LanguageLine::orderBy('created_at','desc')->get();

        return Datatables::of($languageLine)
            ->addColumn('edit', function ($languageLine) use ($authUser) {
                $actions = '<div class="export"><a href="javascript:void(0);" data-act="ajax-modal" data-complete-location="true" data-method="get"
                                data-action-url="'.route("dashboard.translations.edit",$languageLine->id).'" data-table="translations-table">  <em class="icon ni ni-edit"></em> Edit</a></div>';
                return $actions;
            })->addColumn('english', function($languageLine) {
                return addEllipsis($languageLine->text['en']);
            })
            ->addColumn('arabic', function($languageLine) {
                return addEllipsis($languageLine->text['ar']);
            })
            ->rawColumns(['edit','created_at' ])
            ->addIndexColumn()->make(true);
    }
    public function setLocale($locale)
    {
        session()->put('locale', $locale );
        return response()->json([
            'status' => true,
            'message' => 'Language changed!'
        ]);
    }
}
