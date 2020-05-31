<?php

namespace App\Http\Controllers;

use App\Terms;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Carbon\Carbon;

class TermsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check() && Auth::user()->role->first()->name == "Admin") {
            $currentTerms = Terms::where('term_status' , '=', 1)->get()->first();
            $terms = Terms::orderBy('start_date', 'DESC')->get();
            foreach ($terms as $term) {
                if($term->term_status == 0){
                    $term->statusmeaning = 'Future Term';
                }
                if($term->term_status == 1){
                    $term->statusmeaning = 'Ongoing Term';
                }
                if($term->term_status == 2){
                    $term->statusmeaning = 'Past Term';
                }
            }
            if ($terms->isEmpty()) {
                \Session::flash('terms', 'No Term Records Created.');
            }
            return view('terms', compact('terms', 'currentTerms'));
        }else{
            return redirect(route('home'));
        }
    }

    public function create(Request $request)
    {
        if (Auth::check() && Auth::user()->role->first()->name == "Admin") {
        $input = $request->all();
        
        $input['start_term'] = $request->input('start_date');
        $input['end_term'] = $request->input('end_date');
        $input['term_status'] = 0;
        $terms = Terms::create($input);
        \Session::flash('flash_message', 'You have successfully created a new term.');
        return redirect(route('terms'));
        }else{
            return redirect(route('home'));
        }
    }

    public function start(Request $request)
    {
        if (Auth::check() && Auth::user()->role->first()->name == "Admin") {
        $currentTerm = Terms::where('term_status' , '=', 1)->get();
        if(count($currentTerm) == 0){
            $term = Terms::find($request->input('term_id'));
            $term->start_term = Carbon::now();
            $term->term_status = 1;
            $result = $term->save();
            \Session::flash('flash_message', 'You have successfully started the term.');
            return redirect(route('terms'));    
        }else{
            \Session::flash('flash_message_danger', 'You must end the currently running term before you start a new term');
            return redirect(route('terms'));
        }
        }else{
            return redirect(route('home'));
        }
    }

    public function complete(Request $request)
    {
        if (Auth::check() && Auth::user()->role->first()->name == "Admin") {
            $term = Terms::find($request->input('term_id'));
            $term->end_term = Carbon::now();
            $term->term_status = 2;
            $result = $term->save();
            \Session::flash('flash_message', 'You have successfully completed the term.');
            return redirect(route('terms')); 
        }else{
            return redirect(route('home'));
        }
    }
}
