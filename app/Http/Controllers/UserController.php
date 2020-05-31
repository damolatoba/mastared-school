<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Terms;
use App\UserRole;
use App\Classes;
use App\EnrolClass;
use App\Enrollments;
use Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->current_term = Terms::where('term_status' ,'=' ,1)->first();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check() && (Auth::user()->role->first()->name == 'Admin')) {
        $roles = UserRole::where('role_id' ,'=' ,2)->pluck('user_id')->toArray();
        $users = User::whereIn('id', $roles)->get();
        foreach($users as $user){
            $class_id = EnrolClass::where('term_id', '=', $this->current_term->id)->where('user_id', '=', $user->id)->value('class_id');
            $user->class = Classes::where('id', '=', $class_id)->value('class_name');
        }
        return view('user', compact('users'));
        }else{
            return redirect(route('home'));
        }
    }

    public function profile()
    {
        if (Auth::check()) {
            $personal = Auth::user();
            $term = $this->current_term;
            $roles = UserRole::where('role_id' ,'=' ,2)->pluck('user_id')->toArray();
            $class_id = EnrolClass::where('term_id', '=', $term->id)->where('user_id', '=', $personal->id)->value('class_id');
            
            $class = Classes::where('id', '=', $class_id)->first();
            $teacher_id = EnrolClass::where('term_id', '=', $term->id)->where('class_id', '=', $class_id)->whereIn('user_id', $roles)->value('user_id');
            $teacher = User::where('id', '=', $teacher_id)->first();

            if((Auth::user()->role->first()->name == 'Student')){
                return view('portal.profile', compact('personal', 'term', 'class', 'teacher' ));
            }

            if((Auth::user()->role->first()->name == 'Author') || (Auth::user()->role->first()->name == 'Admin')){
                return view('profile', compact('personal', 'term', 'class' ));
            }
        }
        return redirect(route('home'));
    }

    public function password()
    {
        if (Auth::check() && (Auth::user()->role->first()->name == 'Student')) {
        $personal = Auth::user();
        return view('portal.password', compact('personal'));
        }
        return redirect(route('home'));
    }

    public function display()
    {
        if (Auth::check() && Auth::user()->role->first()->name == 'Admin') {
        $roles = UserRole::where('role_id' ,'=' ,3)->pluck('user_id')->toArray();
        $classed_students = EnrolClass::where('term_id' ,'=' ,$this->current_term->id)->pluck('user_id')->toArray();
        $classes = Classes::all();

        $users = User::whereIn('id', $roles)->get();
        $students = [];
        foreach($users as $user){
            if(!in_array($user->id, $classed_students) ){
                array_push($students, $user);
            }
            
        }
        return view('student', compact('students', 'classes'));
        }
        return redirect(route('home'));
    }

    public function classlist()
    {
        if (Auth::check() && (Auth::user()->role->first()->name == 'Admin') || (Auth::user()->role->first()->name == 'Author')) {
        //get class
        $current_class = EnrolClass::where('term_id' ,'=' ,$this->current_term['id'])->where('user_id' ,'=' ,Auth::id())->value('class_id');
        // all students in class id
        $studentslist = EnrolClass::where('term_id' ,'=' ,$this->current_term->id)->where('class_id' ,'=' ,$current_class)->where('user_id' ,'!=' ,Auth::id())->pluck('user_id')->toArray();
        //get student info with array
        $students = User::whereIn('id', $studentslist)->get();
        return view('students', compact('students'));
        }
        return redirect(route('home'));
    }

    public function studetslist(Classes $classes)
    {
        if (Auth::check() && (Auth::user()->role->first()->name == 'Admin') || (Auth::user()->role->first()->name == 'Author')) {
        $roles = UserRole::where('role_id' ,'=' ,2)->pluck('user_id')->toArray();
        $studentslist = EnrolClass::where('term_id' ,'=' ,$this->current_term->id)->where('class_id' ,'=' ,$classes->id)->pluck('user_id')->toArray();
        $students = User::whereIn('id', $studentslist)->whereNotIn('id', $roles)->get();


        return view('students', compact('students'));
        }
        return redirect(route('home'));
    }

    public function assign(Request $request)
    {
        if (Auth::check() && (Auth::user()->role->first()->name == 'Admin')) {
        $input = $request->all();
        $input['term_id'] = $this->current_term['id'];
        $class = EnrolClass::create($input);
        \Session::flash('flash_message', 'Student assigned to class successfully!');
        return redirect(route('student'));
        }
        return redirect(route('home'));
    }

    public function changepassword(Request $request)
    {
        if (Auth::check()) {
            
        $new_password = $request->input('new_password');
        $confirm_password = $request->input('confirm_password');
        
        $current_password = Auth::User()->password;           
        if(Hash::check($request->input('current_password'), $current_password)){
            if($new_password == $confirm_password){
                $user_id = Auth::User()->id;                       
                $user = User::find($user_id);
                $user->password = Hash::make($confirm_password);
                $user->save();
                \Session::flash('flash_message', 'Passwords changed successfully!');
                return redirect(route('profile'));
            }else{
                \Session::flash('error_message2', 'Passwords do not match!');
                if(Auth::user()->role->first()->name == 'Student'){
                    return redirect(route('profile.password'));
                }
    
                if(Auth::user()->role->first()->name == 'Admin' || Auth::user()->role->first()->name == 'Author'){
                    return redirect(route('profile'));
                }
            }
        }else{
            \Session::flash('error_message', 'Incorrect Password!');
            if(Auth::user()->role->first()->name == 'Student'){
                return redirect(route('profile.password'));
            }

            if(Auth::user()->role->first()->name == 'Admin' || Auth::user()->role->first()->name == 'Author'){
                return redirect(route('profile'));
            }
        }
        // return redirect(route('student'));
        }
        return redirect(route('home'));
    }

    // public function dashboard()
    // {
    //     return view('portal.dashboard');
    // }

    // public function account(User $user)
    // {
    //     $user = User::find(Auth::id());
    //     $roles = Role::pluck('name', 'id');
    //     $submitbuttontext = "Update";
    //     return view('users.edit', compact('submitbuttontext', 'user', 'roles'));
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::check() && (Auth::user()->role->first()->name == 'Admin')) {
        $submitbuttontext = "Create";
        $roles = Role::pluck('name', 'id');
        return view('users.create', compact('submitbuttontext', 'roles'));
        }
        return redirect(route('home'));
    }

    public function createstudent()
    {
        if (Auth::check() && (Auth::user()->role->first()->name == 'Admin')) {
        return view('students.create');
        }
        return redirect(route('home'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::check() && (Auth::user()->role->first()->name == 'Admin')) {
        $usernames = User::all()->pluck('username')->toArray();
        if (in_array($request->input('username'), $usernames)){
            \Session::flash('flash_message', 'Username already exist!');
            return view('users.create');
        }
        $input = $request->all();
        $input['password'] = Hash::make('mastared@2020');
        $user = User::create($input);
        $user->role()->attach(2);
        \Session::flash('flash_message', 'New Teacher Account Created!');
        return redirect(route('user.index'));
        }
        return redirect(route('home'));
    }

    public function storestudent(Request $request)
    {
        if (Auth::check() && (Auth::user()->role->first()->name == 'Admin')) {
        $usernames = User::all()->pluck('username')->toArray();
        if (in_array($request->input('username'), $usernames)){
            \Session::flash('flash_message', 'Username already exist!');
            return view('students.create');
        }
        $input = $request->all();
        $input['password'] = Hash::make('welcome2mastared');
        $user = User::create($input);
        $user->role()->attach(3);
        \Session::flash('flash_message', 'New Student Account Created!');
        return redirect(route('student'));
        }
        return redirect(route('home'));
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
        if (Auth::check() && (Auth::user()->role->first()->name == 'Admin')) {
        $submitbuttontext = "Update";
        $user = User::find($id);
        $roles = Role::pluck('name', 'id');
        return view('users.edit', compact('submitbuttontext', 'user', 'roles'));
        }
        return redirect(route('home'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user)
    {
        if (Auth::check() && (Auth::user()->role->first()->name == 'Admin')) {
        $input = $request->all();
        if(empty($request->password)) {
            $input = $request->except('password');
        }
        $user = User::find($user);
        $user->update($input);
        $user->role()->sync($input['role']);
        \Session::flash('flash_message', 'User was updated!');
        return redirect(route('user.index'));
        }
        return redirect(route('home'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::check() && (Auth::user()->role->first()->name == 'Admin')) {
        $user = User::find($id);
        $user->delete();
        \Session::flash('flash_message', 'User Deleted!');
        return redirect(route('user.index'));
        }
        return redirect(route('home'));
    }
}
