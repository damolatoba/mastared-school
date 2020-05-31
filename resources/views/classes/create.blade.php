@extends('layouts.index')
@section('content')
    <div class="container">
    <form action="/class/store" method="POST">
        @csrf
        <h3>Create A Class</h3>
        <div class="row">
            <div class="col-md-6">
                <p>Class Name:</p>
                <input type="text" name="class_name" id="classname" placeholder="Class Name" required/>
            </div>
            <div class="col-md-6">
                <p>Class Level:</p>
                <select name="class_level" required>
                    <option value="">Select Class Level</option>
                    <option value="1">Level One</option>
                    <option value="2">Level Two</option>
                    <option value="3">Level Three</option>
                </select>
            </div>
        </div>
        <input type="submit" name="submit" value="Create Class"/>
    </form>
    </div>
@endsection