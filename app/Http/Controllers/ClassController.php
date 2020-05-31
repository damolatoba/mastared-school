<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\UserRole;
use App\Classes;
use App\EnrolClass;
use App\Terms;
// use Illuminate\Foundation\Auth\User;
use Auth;
use Illuminate\Support\Facades\Hash;

class ClassController extends Controller
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
        if (Auth::check() && Auth::user()->role->first()->name == "Admin") {
            $classes = Classes::all();
            //roles contains id of all teachers
            $roles = UserRole::where('role_id' ,'=' ,2)->pluck('user_id')->toArray();
            $class_teachers = User::whereIn('id', $roles)->get();
            $current_term = $this->current_term;
            foreach ($classes as $class) {
                $enroled_class = EnrolClass::where('class_id' ,'=' ,$class->id)->where('term_id' ,'=' ,$this->current_term['id'])->whereIn('user_id', $roles)->first();
                $class->teacher_info = User::find($enroled_class['user_id']);
            }

        return view('class', compact('classes', 'current_term', 'class_teachers'));
        }else{
            return redirect(route('home'));
        }
    }

    public function create()
    {
        if (Auth::check() && Auth::user()->role->first()->name == "Admin") {
        // $classes = Classes::all();
        return view('classes.create');
        }else{
            return redirect(route('home'));
        }
    }

    public function store(Request $request)
    {
        if (Auth::check() && Auth::user()->role->first()->name == "Admin") {
        $input = $request->all();
        $class = Classes::create($input);
        \Session::flash('flash_message', 'Class created succesfully!');
        return redirect(route('class'));
        }else{
            return redirect(route('home'));
        }
    }

    public function assign(Request $request)
    {
        if (Auth::check() && Auth::user()->role->first()->name == "Admin") {
        $input = $request->all();
        $input['term_id'] = $this->current_term['id'];
        $check_class = EnrolClass::where('term_id', '=', $this->current_term['id'])->where('class_id', '=', $request->input('class_id'))->get();
        if(count($check_class) > 0)
        {
            $class = EnrolClass::find($check_class[0]['id']);
            $class->user_id = $request->input('user_id');
            $result = $class->save();
            \Session::flash('flash_message', 'Class has been assigned to teacher successfully Successful!');
            return redirect(route('class'));
        }
        $class = EnrolClass::create($input);
        \Session::flash('flash_message', 'Class has been assigned to teacher successfully Successful!');
        return redirect(route('class'));
        }else{
            return redirect(route('home'));
        }
    }
}
