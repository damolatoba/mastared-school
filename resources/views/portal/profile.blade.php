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
@if (session('flash_message'))
    <div class="card-body">
        <div class="alert alert-success">
            {{ session('flash_message') }}
        </div>
    </div>
@endif
<div class="module">
    <div class="module-head">
        <h3 style="text-transform: capitalize;">Profile</h3>
    </div>
    <div class="module-body">
        <div class="profile-head media">
            <a href="#" class="media-avatar pull-left">
                <img src="images/user.png">
                <p style="font-size:12px;color:##0000e6;">Change Avatar</p>
            </a>
            <div class="media-body">
                <h4 style="text-transform:capitalize;color:#3366ff;font-size:30px;margin:15px 0;">
                    {{ $personal->firstname.' '.$personal->lastname }}
                </h4>
                <p class="profile-brief"><b>Username: {{ $personal->username }}</b></p>
                <p class="profile-brief"><b>Current Term: {{ $term->term_name }} &nbsp; &nbsp; &nbsp;</b> <b>From:</b> {{ date('l, d M Y',(strtotime($term->start_date))) }} &nbsp; <b>To:</b> {{ date('l, d M Y',(strtotime($term->end_date))) }}</p>
                <p class="profile-brief"><b>Current Class: {{ $class->class_name }}</b></p>
                <p class="profile-brief"><b>Class Level: {{ $class->class_level }}</b></p>
                <p class="profile-brief" style="text-transform:capitalize;"><b>Class Teacher: {{ $teacher->firstname.' '.$teacher->lastname }}</b></p>
                <div class="profile-details muted">
                    <a href="/profile/password" class="btn pull-right" style="background-color:#3366ff;"><i class="icon-lock"></i>Change Password</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection