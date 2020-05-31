@extends('layouts.portal')
@section('content')
<style>
.cour {
    margin:10px;
    border-style: solid;
    border-width: 1px;
    border-color: black;
    padding:10px;
    height: 100%;
}
.thumb {
    /* width:25%;
    float:left; */
    overflow:hidden;
    margin: 0;
}
.info {
    position: relative;
    height: 240px;
    padding:10px 0 0 5px;
}
.studbuts {
    position: absolute;
    bottom: 10px;
    width: 100%;
}
</style>
<div class="module">
@if (session('flash_message'))
    <div class="card-body">
        <div class="alert alert-success">
            {{ session('flash_message') }}
        </div>
    </div>
@endif
    <div class="module-head">
        <h3>Lectures</h3>
    </div>
    <div class="module-body">
    @if ($courses->isEmpty())
    <div id="" class="row cour">
        <h3>No lectures available for this day.</h3>
    </div>
    @else
            @foreach ($courses as $course)
            <div class="row cour">
                    <h2 style="text-transform:capitalize;font-size:20px;">{{$course->title}}</h2>
                    <p class="pull-right" style="font-weight:500;">{{ date('l, d M Y',(strtotime($course['start_date']))) }}</p>
                    <p style="font-weight:500;">{{ $course['subject'] }}</p>
                    <div>
                        @if($course['status'] == 2)
                        <a href="lecture/{{$course->id}}" class="btn btn-large btn-primary pull-right">Revisit Course</a>
                        <p style="font-size:11px;color:#123d82;font-weight:700;margin:15px 0;">You have already completed this lecture.</p>
                        @elseif($course['status'] == 1)
                        <a href="lecture/{{$course->id}}" class="btn btn-large btn-primary pull-right" style="margin:15px 0;">Continue Lecture</a>
                        @else
                        <a href="lecture/{{$course->id}}" class="btn btn-large btn-primary pull-right" style="margin:15px 0;">Start Lecture</a>
                        @endif
                    </div>
            </div>
            @endforeach
    @endif
    </div>
</div>
@endsection