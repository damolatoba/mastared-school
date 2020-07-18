<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Course;
use App\Subjects;
use App\UserRole;
use App\Classes;
use App\EnrolClass;
use App\Terms;
use App\Assignments;
use App\Sections;
// use Illuminate\Foundation\Auth\User;
use Auth;
use Illuminate\Support\Facades\Hash;

class AssignmentController extends Controller
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
        if (Auth::check() && Auth::user()->role->first()->name == "Author") {
            $teacher_id = Auth::id();
            $lectures = Course::where('user_id', '=', $teacher_id)->orderBy('created_at', 'DESC')->skip(0)->take(10)->get();
            $subjects = Subjects::where('status', '=', 1)->get();
            // dd($lectures);
            return view('assignment', compact('lectures', 'subjects'));
        }
        return redirect(route('home'));
    }

    public function create(Request $request)
    {
        // dd($request);
        
        if (Auth::check() && Auth::user()->role->first()->name == "Author") {
            $assignment_info = $request->all();
            $teacher_id = Auth::id();
            $class_id = EnrolClass::where('term_id', '=', $this->current_term->id)->where('user_id', '=', $teacher_id)->value('class_id');
            $input = $request->all();
            $input['teacher_id'] = $teacher_id;
            $input['class_id'] = $class_id;
            $input['publish_status'] = 0;
            $input['assignment_type'] = $request->input('ass_type');
            $input['has_sections'] = $request->input('sec_type');
            $input['answerable_questions'] = 10;

            if($request->input('ass_type') == 0){
                $input['subject_id'] = $request->input('as_subjects');
                $input['lecture_id'] = 0;
            }

            if($request->input('ass_type') == 1){
                $input['lecture_id'] = $request->input('as_lecture');
                $input['subject_id'] = 0;
            }

            $result = Assignments::create($input);
            $assignment_id = $result->id;
            // dd($assignment_id);

            if($request->input('ass_type') == 1){
                $section_name = $request->input('section_name');
                $section_input['assignment_id'] = $assignment_id;
                $section_input['section_name'] = $section_name;
                $section_result = Sections::create($section_input);
                $section_id = $section_result->id;
            }else{
                $section_id = 0;
            }

            // $course_id = $request->input('course_id');
            return view('questions', compact('assignment_id', 'section_id') );
        }else{
            return redirect(route('home'));
        }
    }

    public function store(Request $request)
    {
        dd($request);
        
        if (Auth::check() && Auth::user()->role->first()->name == "Author") {
            // return redirect(route('questions'));
            // dd($request->all());
            $question_info = $request->all();
            return view('questions', compact('question_info') );
        }else{
            return redirect(route('home'));
        }
    }

    // public function questions(Request $request)
    // {
    //     return view('questions');
    // }
}
