<?php

namespace App\Http\Controllers\Auth;

use Storage;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\StudentCourse;
use App\Traits\ActivationTrait;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Validator;
use jeremykenedy\LaravelRoles\Models\Role;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
     */

    use ActivationTrait;
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', [
            'except' => 'logout',
        ]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data,
            [
                'first_name'            => 'required',
                'last_name'             => 'required',
                'course_id'             => 'required',
                'id_number'             => 'required|max:13|unique:users',
                'email'                 => 'required|email|max:255|unique:users',
                'password'              => 'required|min:6|max:20|confirmed',
                'password_confirmation' => 'required|same:password',
                "profile_picture"       => 'max:1024', // (max size 1 MB)
            ]
        );
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     *
     * @return User
     */
    protected function create(array $data)
    {

        $user = User::create([
            'first_name'        => $data['first_name'],
            'last_name'         => $data['last_name'],
            'email'             => $data['email'],
            'password'          => bcrypt($data['password']),
            'user_type'         => User::USER_TYPE_PATIENT,
            'id_number'         => $data['id_number'],
        ]);

        if (isset($data['profile_picture'])) {
            $file = $data['profile_picture'];
            $name = uniqid() . "." . $file->getClientOriginalExtension();
            $path = "/profiles/" . $name;
            Storage::disk('local')->put($path, file_get_contents($data['profile_picture']));
            $user->profile_picture = $name;
        }
        
        $user->save();

        // Lets create a link between this user and the selected course
        if (isset($data['course_id'])) {
            StudentCourse::create([
                'student_id' => $user->id,
                'course_id' => $data['course_id']
            ]);
        }

        return $user;
    }
}
