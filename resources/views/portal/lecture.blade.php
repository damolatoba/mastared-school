@extends('layouts.portal')
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
    }
</style>
<div class="module">
    <div class="module-head">
        <h3 style="float:right">{{$subject['subject']}}</h3>
        <h3 style="text-transform: capitalize;">{{$author['firstname'].' '.$author['lastname']}}</h3>
    </div>
    <div class="module-body">
        <h2 style="text-align:center;">{{$course['title']}}</h2>
        <div style="word-wrap: break-word;">
            {!! $course['description'] !!}
        </div>

    @if($course->video != 'null')
        <div>
            <video width="100%" controls>
                <source src="{{url('')}}/uploads/videos/{{ $course['video'] }}" type="video/mp4">
                <source src="{{url('')}}/uploads/videos/{{ $course['video'] }}" type="video/ogg">
                Your browser does not support HTML video.
            </video>
        </div>
    @endif
        <!-- {{ $ongoing }} -->
        @if($ongoing['status'] != 2)
        <a href="/complete/{{$course['id']}}" class="btn btn-large btn-primary" style="float:right;">Complete</a>
        @endif
        <!-- comments -->
        <div style="padding:40px 3px;">
            <p>{{ $student->firstname.' '.$student->lastname }}</p>
            <div style="position: relative;height:100px;">
                <form action="/comment" method="POST">
                @csrf
                    <input type="hidden" name="course_id" value="{{$course['id']}}"/>
                    <textarea name="comment" placeholder="Comment Here" required></textarea>
                    <input type="submit" name="submit" value="Add Comment" style="position: absolute;bottom:0px;right:25px;"/>
                </form>
            </div>
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
    </div>
</div>
@endsection