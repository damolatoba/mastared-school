@extends('layouts.index')
@section('content')
<style>
    textarea {
        width: 100%;
        padding: 22px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    input[type=submit] {
        text-align: right;
        background-color: dodgerblue;
        width:100px;
        height: 25px;
        padding:0;
    }
</style>
@if (session('flash_message'))
    <div class="card-body">
        <div class="alert alert-success">
            {{ session('flash_message') }}
        </div>
    </div>
@endif
@if (Auth::check() && (Auth::user()->role->first()->name == 'Author' or Auth::user()->role->first()->name == "Admin"))
<div class="jumbotron">
    <div class="course-title">
        <h4 class="costit">{{ $course->title }}</h4>
    </div>

    <div class="published">
        <h6 class= "lead"><span>Lecture Date: {{ date('d-m-Y',(strtotime($course['start_date']))) }}</span></h6>
    </div>

    <a href="/attendance/{{ $course->id }}" class="btn btn-secondary" id="course_button">Students Attendance</a>

    <div class="course-content singdisc" style="word-wrap: break-word;">
            {!! $course->description !!}
    </div>

    @if($course->video != 'null')
    <div class="course-content">
        <video width="100%" controls>
            <source src="{{url('')}}/uploads/videos/{{ $course->video }}" type="video/mp4">
            <source src="{{url('')}}/uploads/videos/{{ $course->video }}" type="video/ogg">
            Your browser does not support HTML video.
        </video>
    </div>
    @endif

    <!-- comments -->
    <div style="padding:40px 3px;">
    @if(Auth::user()->role->first()->name == 'Author')
        <div style="position: relative;height:100px;">
            <form action="/comment" method="POST">
            @csrf
                <input type="hidden" name="course_id" value="{{$course['id']}}"/>
                <textarea name="comment" placeholder="Comment Here" required></textarea>
                <input type="submit" name="submit" value="Add Comment" style="position: absolute;bottom:0px;right:25px;"/>
            </form>
        </div>
    @endif
        <div style="margin:25px 0;">
            @foreach($comments as $comment)
            <div style="margin:5px;border: 1px solid dodgerblue;border-radius: 8px;padding:10px;">
                @if($comment->role == 2)
                <p style="text-align:right;text-transform:uppercase;"><b>{{ $comment->userinfo->firstname.' '.$comment->userinfo->lastname }}</b></p>
                @else
                <p><b>{{ $comment->userinfo->firstname.' '.$comment->userinfo->lastname }}</b></p>
                @endif
                <p>{{ $comment->comment }}</p>
            </div>
            @endforeach
        </div>
</div>
@endif
</div>
@endsection