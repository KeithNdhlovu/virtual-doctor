<?php

namespace App\Http\Controllers;

use File;
use Auth;
use Storage;
use Response;
use Validator;
use Notification;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Translation;
use Illuminate\Http\Request;
use jeremykenedy\LaravelRoles\Models\Role;

// Forgot password
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Password;

use Google\Cloud\Translate\TranslateClient;

class UserController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        if ($user->isAdministrator()) {

            // $translations = Translation::all();
            $users = User::all();

            // // Total Translations this week
            // $weeklyTranslations = $translations->filter(function($trans, $key) {
            //     $predicateO = $trans->created_at->gte(Carbon::today()->startOfWeek());
            //     $predicateT = $trans->created_at->lte(Carbon::today()->endOfWeek());
            //     return  $predicateO && $predicateT;
            // })->count();

            // $weeklyUsers = $users->filter(function($user, $key) {
            //     $predicateO = $user->created_at->gte(Carbon::today()->startOfWeek());
            //     $predicateT = $user->created_at->lte(Carbon::today()->endOfWeek());
            //     return  $predicateO && $predicateT;
            // })->count();

            $data = [
                'lectures' => 0,
                'students' => 0,
                'attendances' => 0,
                'users' => $users
            ];

            return view('pages.admin.home', $data);    
        }

        return view('pages.user.home');
    }

    public function getProfileUrl(Request $request)
    {
        $path = Storage::disk('local')->path("profiles/" . Auth::user()->profile_picture);

        if (!File::exists($path)) {
            abort(404);
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $user = Auth::user();

        // dd($user);
        return view('pages.user.profile')->withUser($user);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showTransactions()
    {
        $user = Auth::user();

        return view('pages.user.404')->withUser($user);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showOrders()
    {
        $user = Auth::user();

        return view('pages.user.404')->withUser($user);
    }  
    
    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function reports()
    {
        $user = Auth::user();

        if ($user->isAdministrator()) {
            $translations = Translation::all();
            $users = User::where('user_type', 2)->get();

            // Total Translations this week
            $weeklyTranslations = $translations->filter(function($trans, $key) {
                $predicateO = $trans->created_at->gte(Carbon::today()->startOfWeek());
                $predicateT = $trans->created_at->lte(Carbon::today()->endOfWeek());
                return  $predicateO && $predicateT;
            })->count();

            $weeklyUsers = $users->filter(function($user, $key) {
                $predicateO = $user->created_at->gte(Carbon::today()->startOfWeek());
                $predicateT = $user->created_at->lte(Carbon::today()->endOfWeek());
                return  $predicateO && $predicateT;
            })->count();

            $maleUsers = $users->filter(function($user, $key) {
                return  ($this->getGender($user->id_number) == 'M');
            });

            $femaleUsers = $users->filter(function($user, $key) {
                return  ($this->getGender($user->id_number) == 'F');
            });

            $mostTranslatedWords = $translations->groupBy('original_text');

            $users->each(function($user) {
                $user->gender = $this->getGender($user->id_number);
            });

            $data = [
                'translations' => $translations,
                'mostTranslatedWords' => $mostTranslatedWords,
                'allTranslations' => $translations->count(),
                'weeklyTranslations' => $weeklyTranslations,
                'weeklyUsers' => $weeklyUsers,
                'maleUsers' => $maleUsers,
                'femaleUsers' => $femaleUsers,
                'users' => $users,
                'allUsers' => $users->count(),
            ];

            return view('pages.admin.report', $data);
        } else {
         
            $weeklyTranslations = $user->translations->filter(function($trans, $key) {
                $predicateO = $trans->created_at->gte(Carbon::today()->startOfWeek());
                $predicateT = $trans->created_at->lte(Carbon::today()->endOfWeek());
                return  $predicateO && $predicateT;
            })->count();

            $mostTranslatedWords = $user->translations->groupBy('original_text');

            $data = [
                'translations' => $user->translations,
                'allTranslations' => $user->translations->count(),
                'mostTranslatedWords' => $mostTranslatedWords,
                'weeklyTranslations' => $weeklyTranslations,
            ];

            return view('pages.user.report', $data);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = Auth::user();

        $data = [
            'user' => $user
        ];

        return view('pages.user.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $user = Auth::user();
        $emailCheck = ($request->input('email') != '') && ($request->input('email') != $user->email);

        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');

        if ($emailCheck) {
            $user->email = $request->input('email');
        }

        if ($request->input('password') != null) {
            $user->password = bcrypt($request->input('password'));
        }

        $user->save();

        return back()->with('success', trans('usersmanagement.updateSuccess'));
    }   
}