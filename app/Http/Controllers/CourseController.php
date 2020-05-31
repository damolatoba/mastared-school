<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Course;
use Auth;
use App\UserCourse;
use App\UserRole;
use App\EnrolClass;
use App\Terms;
use App\Comments;
use App\Subjects;
use App\CourseAttendance;
use Carbon\Carbon;

class CourseController extends Controller
{

    public function __construct()
    {
        $this->current_term = Terms::where('term_status' ,'=' ,1)->first();
        $this->subjects = Subjects::where('status', '=', 1)->get();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check() && Auth::user()->role->first()->name == "Author") {
            $courses = Course::where('user_id', '=', Auth::id())->get();
            if ($courses->isEmpty()) {
                \Session::flash('course', 'Not enrolled to any courses');
            } else {
                foreach ($courses as $course) {
                    $course->author = User::find($course->user_id);
                }
            }
            return view('courses', compact('courses'));
        } elseif (Auth::check()  && Auth::user()->role->first()->name == "Admin") {
            $courses = Course::all();
            if ($courses->isEmpty()) {
                \Session::flash('course', 'Not enrolled to any courses');
            } else {
                foreach ($courses as $course) {
                    $course->author = User::find($course->user_id);
                }
            }
            return view('courses', compact('courses'));
        }else{
            return redirect(route('home'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::check() && Auth::user()->role->first()->name == "Author") {
        $submitbuttontext = "Create";
        $subjects = $this->subjects;
        return view('courses.create', compact('submitbuttontext', 'subjects'));
        }else{

        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::check() && Auth::user()->role->first()->name == "Author") {

        $current_class = EnrolClass::where('term_id' ,'=' ,$this->current_term['id'])->where('user_id' ,'=' ,Auth::id())->first();
        // dd($current_class['class_id']);
        $input = $request->all();

        if ($request->hasFile('video')){
            $video = $request->file('video');
            $videoName = time().''.rand().''.$video->getClientOriginalName();
            $video->move(public_path('uploads/videos'), $videoName);
            $input['video'] = $videoName;
        }else{
            $input['video'] = 'null';
        }
        
        $input['user_id'] = Auth::id();
        $input['class_id'] = $current_class['class_id'];
        $input['description'] = $request->input('editor1');
        $course = Course::create($input);
        \Session::flash('flash_message', 'A new course has been created!');
        $author = User::find($course->user_id);
        }
        return redirect(route('home'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\r  $r
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        if (Auth::check() && Auth::user()->role->first()->name == "Author" || Auth::user()->role->first()->name == "Admin" ) {
            $comments = Comments::where('course_id', '=', $course->id)->orderBy('created_at', 'DESC')->get();
            foreach($comments as $comment){
                $comment->userinfo = User::where('id', '=', $comment->user_id)->first();
                $comment->role = UserRole::where('user_id', '=', $comment->user_id)->value('role_id');
            }
            return view('courses.singlecourse', compact('course', 'comments'));
        }else{
            return redirect(route('home'));
        }
    }

    public function startcourse(Course $course)
    {
        if (Auth::check() && Auth::user()->role->first()->name == "Student") {
            $ongoing = CourseAttendance::where('course_id' ,'=' , $course->id)->where('user_id' ,'=' ,Auth::id())->first();
            if(empty($ongoing)){
                $input['user_id'] = Auth::id();
                $input['course_id'] = $course->id;
                $input['status'] = 1;
                $start = CourseAttendance::create($input);
            }
            $ongoing = CourseAttendance::where('course_id' ,'=' , $course->id)->where('user_id' ,'=' ,Auth::id())->first();
            $subject = Subjects::find($course->subject_id);
            $author = User::find($course->user_id);
            $student = Auth::user();
            $comments = Comments::where('course_id', '=', $course->id)->orderBy('created_at', 'DESC')->get();
            foreach($comments as $comment){
                $comment->userinfo = User::where('id', '=', $comment->user_id)->first();
                $comment->role = UserRole::where('user_id', '=', $comment->user_id)->value('role_id');
            }
            // dd($comments);
            return view('portal.lecture', compact('course', 'author', 'ongoing', 'subject', 'student', 'comments'));
        }else{
            return redirect(route('home'));
        }
    }

    public function attendance(Course $course)
    {
        if (Auth::check() && Auth::user()->role->first()->name == "Author" || Auth::user()->role->first()->name == "Admin" ) {
        $course->subject = Subjects::where('id', '=', $course->subject_id)->value('subject');
        $roles = UserRole::where('role_id' ,'=' ,3)->pluck('user_id')->toArray();
        $students = EnrolClass::where('term_id' ,'=' ,$this->current_term['id'])->where('class_id' ,'=' ,$course->class_id)->whereIn('user_id', $roles)->get();
        //get attendance of each student for the course
            foreach($students as $student){
                $student->info = User::where('id', '=', $student->user_id)->first();
                $student->attendance = CourseAttendance::where('user_id', '=', $student->user_id)->where('course_id', '=', $course->id)->first();
            }
            return view('attendance', compact('course', 'students'));
        }
        return redirect(route('home'));
    }

    public function comment(Request $request)
    {
        if (Auth::check()) {
        $input = $request->all();
        $course_id = $request->input('course_id');
        $input['user_id'] = Auth::id();
        $comment = Comments::create($input);
        if(Auth::user()->role->first()->name == "Author" || Auth::user()->role->first()->name == "Admin"){
            return redirect()->route('course.show', ['course' => $course_id]);
        }
        return redirect()->route('startcourse', ['course' => $course_id]);
        }else{
            return redirect(route('home'));
        }
    }

    public function complete(Course $course)
    {
        if (Auth::check() && Auth::user()->role->first()->name == "Student") {
            $ongoing = CourseAttendance::where('course_id' ,'=' , $course->id)->where('user_id' ,'=' ,Auth::id())->first();
            if(empty($ongoing)){
                $input['user_id'] = Auth::id();
                $input['course_id'] = $course->id;
                $input['status'] = 2;
                $start = CourseAttendance::create($input);
            }

            CourseAttendance::where('user_id', '=', Auth::id())
                    ->where('course_id', '=', $course->id)
                    ->update(['status' => 2, 'updated_at' => Carbon::now()]);
            \Session::flash('flash_message', 'Course marked as completed!');
            return redirect(route('home'));
        }else{
            return redirect(route('home'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\r  $r
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        if (Auth::check() && (Auth::user()->role->first()->name == 'Author')) {
            $subjects = $this->subjects;
            return view('courses.edit', compact('course', 'subjects'));
        }
        // return view('/');
        return redirect(route('home'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\r  $r
     * @return \Illuminate\Http\Response
     */
    public function update(Course $course, Request $request)
    {
        if (Auth::check() && (Auth::user()->role->first()->name == 'Author')) {
        $course = Course::find($course->id);
        $course->title = $request->input('title');
        $course->description = $request->input('editor1');
        $course->subject_id = $request->input('subject_id');
        $course->updated_at = Carbon::now();
        if ($request->hasFile('video')){
            $video = $request->file('video');
            $videoname = time().''.rand().''.$video->getClientOriginalName();
            $video->move(public_path('uploads/videos'), $videoname);
            $course->video = $videoname;
        }

        if ($request->input('start_date')){
            $course->start_date = $request->input('start_date');
        }

        $result = $course->save();
        \Session::flash('flash_message', 'Course has been updated successfully by you.');
        }
        return redirect(route('home'));
    }

    public function delete(Request $request)
    {
        if (Auth::check() && (Auth::user()->role->first()->name == 'Author')) {
        $courseid = $request->input('course_id');
        $Course = Course::find($courseid);
        $Course->delete();
        \Session::flash('flash_message', 'Course has been deleted successfully by you.');
        }
        return redirect(route('home'));
    }
}
