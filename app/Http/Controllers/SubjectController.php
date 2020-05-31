<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subjects;
use App\User;
use Auth;

class SubjectController extends Controller
{
    //
    public function index()
    {
        if (Auth::check() && (Auth::user()->role->first()->name == 'Admin')) {
        $subjects = Subjects::where('status', '=', 1)->get();

        return view('subjects', compact('subjects'));
        }
        return redirect(route('home'));
    }

    public function create(Request $request)
    {
        if (Auth::check() && (Auth::user()->role->first()->name == 'Admin')) {
        $input = $request->all();
        $input['status'] = 1;
        $subject = Subjects::create($input);
        \Session::flash('flash_message', 'Subject created succesfully!');
        }
        return redirect(route('home'));
    }

    public function edit(Request $request)
    {
        if (Auth::check() && (Auth::user()->role->first()->name == 'Admin')) {
        $subject = Subjects::find($request->input('sub_id'));
        $subject->subject = $request->input('subject');
        $result = $subject->save();
        \Session::flash('flash_message', 'Subject has been edited successfully!');
        return redirect(route('subjects'));
        }
        return redirect(route('home'));

    }

    public function delete(Request $request)
    {
        if (Auth::check() && (Auth::user()->role->first()->name == 'Admin')) {
        $subject = Subjects::find($request->input('sub_id'));
        $subject->status = 0;
        $result = $subject->save();
        \Session::flash('flash_message', 'Subject has been deleted successfully!');
        return redirect(route('subjects'));
        }else{
            return redirect(route('home'));
        }
    }
}
