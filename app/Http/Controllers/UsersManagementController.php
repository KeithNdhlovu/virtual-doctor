<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use App\Traits\CaptureIpTrait;
use Auth;
use Illuminate\Http\Request;
use jeremykenedy\LaravelRoles\Models\Role;
use Validator;

class UsersManagementController extends Controller
{
    protected $roles;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $roles = collect([]);

        $role = new \StdClass;
        $role->id = User::USER_TYPE_ADMIN;
        $role->name = 'Admin';
        $role->slug = 'Admin';
        $roles->push($role);

        $role = new \StdClass;
        $role->id = User::USER_TYPE_PATIENT;
        $role->name = 'Patient';
        $role->slug = 'Patient';
        $roles->push($role);

        $role = new \StdClass;
        $role->id = User::USER_TYPE_DOCTOR;
        $role->name = 'Doctor';
        $role->slug = 'Doctor';
        $roles->push($role);

        $role = new \StdClass;
        $role->id = User::USER_TYPE_PHARMACY_ADMIN;
        $role->name = 'Pharmacy Admin';
        $role->slug = 'Pharmacy Admin';
        $roles->push($role);

        $this->roles = $roles;

        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $roles = $this->roles;
        
        // dd($users->first()->roles());
        return View('usersmanagement.show-users', compact('users', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = $this->roles;
        
        $data = [
            'roles' => $roles,
        ];

        return view('usersmanagement.create-user')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = $request->all();

        $rules = [
            'first_name'            => 'required',
            'last_name'             => 'required',
            'email'                 => 'required|email|max:255|unique:users',
            'password'              => 'required|min:6|max:20|confirmed',
            'password_confirmation' => 'required|same:password',
            'role'                  => 'required',
            'id_number'             => 'required|max:13|unique:users',
        ];

        $messages = [
            'first_name.required'   => trans('auth.fNameRequired'),
            'last_name.required'    => trans('auth.lNameRequired'),
            'email.required'        => trans('auth.emailRequired'),
            'email.email'           => trans('auth.emailInvalid'),
            'password.required'     => trans('auth.passwordRequired'),
            'password.min'          => trans('auth.PasswordMin'),
            'password.max'          => trans('auth.PasswordMax'),
            'role.required'         => trans('auth.roleRequired'),
            'id_number.required'    => 'Please enter ID Number',
        ];

        if ($request->has('role')) {
            
            if ($request->input('role') == User::USER_TYPE_PATIENT) {
                $rules['medical_aid_number'] = 'required|unique:users';
                $messages['medical_aid_number.required'] = 'Please provide the medical aid number for this patient';
                $messages['medical_aid_number.unique'] = 'Medical aid number is already in use by a different patient';
            }
        }

        $validator = Validator::make($data, $rules, $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'first_name'        => $request->input('first_name'),
            'last_name'         => $request->input('last_name'),
            'email'             => $request->input('email'),
            'password'          => bcrypt($request->input('password')),
            'user_type'         => $request->input('role'),
            'id_number'         => $request->input('id_number'),
        ]);

        if ($request->input('medical_aid_number') != null) {
            $user->medical_aid_number = $request->input('medical_aid_number');
            $user->save();
        }

        return redirect('users')->with('success', trans('usersmanagement.createSuccess'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);

        return view('usersmanagement.show-user')->withUser($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = $this->roles;

        $currentRole = $this->roles->filter(function($role) use ($user) {
            return $user->user_type == $role->id;
        })->first();

        $data = [
            'user'          => $user,
            'roles'         => $roles,
            'currentRole'   => $currentRole
        ];

        return view('usersmanagement.edit-user')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $currentUser = Auth::user();
        $user = User::find($id);
        $emailCheck = ($request->input('email') != '') && ($request->input('email') != $user->email);

        if ($emailCheck) {
            $validator = Validator::make($request->all(), [
                'email'     => 'email|max:255|unique:users',
                'password'  => 'present|confirmed|min:6',
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'password'  => 'nullable|confirmed|min:6',
            ]);
        }

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');

        if ($emailCheck) {
            $user->email = $request->input('email');
        }

        if ($request->input('password') != null) {
            $user->password = bcrypt($request->input('password'));
        }

        if ($request->input('id_number') != null) {
            $user->id_number = $request->input('id_number');
        }

        if ($request->input('medical_aid_number') != null) {
            $user->medical_aid_number = $request->input('medical_aid_number');
        }

        if ($request->input('role') != null) {
            $user->user_type = $request->input('role');
        }

        $user->save();

        return back()->with('success', trans('usersmanagement.updateSuccess'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $currentUser = Auth::user();
        $user = User::findOrFail($id);

        if ($user->id != $currentUser->id) {
            $user->forceDelete();
            return redirect('users')->with('success', trans('usersmanagement.deleteSuccess'));
        }

        return back()->with('error', trans('usersmanagement.deleteSelfError'));
    }
}
