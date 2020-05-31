<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\User;
use App\Terms;
use App\EnrolClass;
use App\Subjects;
use App\CourseAttendance;
use App\Classes;
use Auth;
use Carbon\Carbon;
use App\Providers\Paginator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->current_term = Terms::where('term_status' ,'=' ,1)->first();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $today = date("Y-m-d");
        if ($request->input('filtdate')){
            $today = $request->input('filtdate');
        }
        if (Auth::check() && Auth::user()->role->first()->name == "Admin") {
            $courses = Course::where('start_date', '=', $today)->orderBy('created_at', 'DESC')->get();
            foreach ($courses as $course) {
                $course->teacher = User::find($course->user_id);
                $course->subject = Subjects::where('id', $course->subject_id)->value('subject');
                $course->class = Classes::where('id', $course->class_id)->value('class_name');
            }
            // dd($courses);
            if ($courses->isEmpty()) {
                \Session::flash('course', 'No Courses Created Today.');
            }
            return view('courses', compact('courses'));
        }
        if (Auth::check() && Auth::user()->role->first()->name == "Student") {
            $current_class = EnrolClass::where('term_id' ,'=' ,$this->current_term['id'])->where('user_id' ,'=' ,Auth::id())->first();
            $courses = Course::where('class_id', '=', $current_class->class_id)->where('start_date', '=', $today)->get();
            foreach ($courses as $course) {
            $course->author = User::where('id', $course->user_id)->value('firstname', 'lastname');
            $course->subject = Subjects::where('id', $course->subject_id)->value('subject');
            $course->status = CourseAttendance::where('user_id' ,'=' ,Auth::id())->where('course_id' ,'=' ,$course->id)->value('status');
            }
            return view('dashboard', compact('courses'));
        }
        if (Auth::check() && Auth::user()->role->first()->name == "Author") {
            $courses = Course::where('user_id', '=', Auth::id())->where('start_date', '=', $today)->get();
            foreach ($courses as $course) {
            $course->author = User::where('id', $course->user_id)->value('firstname');
            $course->subject = Subjects::where('id', $course->subject_id)->value('subject');
            }
            if ($courses->isEmpty()) {
                \Session::flash('course', 'No Courses Created Today.');
            }
            return view('courses', compact('courses'));
        }

        return view('auth.login');
    }
}
