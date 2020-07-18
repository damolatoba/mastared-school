@extends('layouts.index')
@section('content')
<style>
        /* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  max-width: 40%;
  text-align: center;
}

.alert {
    display:none;
}

.close {
    text-align: right;
}

#select_lecture, #sec_field, #select_subject {
    display:none;
}

select {
    width: 60%;
    padding: 5px 10px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}
}
</style>
@if (session('flash_message'))
    <div class="card-body">
        <div class="alert alert-success">
            {{ session('flash_message') }}
        </div>
    </div>
@endif
<a class="btn btn-secondary startbut" id="course_button">Create New Assignment</a>
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <h3>Create New Assignment</h3>
    <form action="/assignment/create" method="POST">
    @csrf
    <div style="padding:10px;">
        <div style="border-style: ridge;padding:10px;border-radius: 25px;margin:10px 10px 5px;">
            <p><b>Assignment Type</b></p>
            <input type="radio" id="sub" name="ass_type" value="0" required>
            <label for="Subject">Subject</label> &nbsp; &nbsp;
            <input type="radio" id="lec" name="ass_type" value="1">
            <label for="female">Lecture</label><br/>
            <div id="select_lecture">
                <select name="as_lecture" id="lec_select">
                    <option value="">Select Assignment Lecture</option>
                    @foreach($lectures as $lecture)
                        <option value="{{ $lecture->id }}">{{ $lecture->title }}</option>
                    @endforeach
                </select>
            </div>

            <div id="select_subject">
                <select name="as_subjects" id="lec_select">
                    <option value="">Select Assignment Subject</option>
                    @foreach($subjects as $subject)
                        <option value="{{ $subject->id }}">{{ $subject->subject }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <!-- <div style="padding:10px;">
        <div style="border-style: ridge;padding:10px;border-radius: 25px;margin:10px 10px 5px;">
            <p><b>Scoring Type</b></p>
            <input type="radio" id="auth_id" name="mark_type" value="0" required>
            <label for="Subject">Authomatic</label> &nbsp; &nbsp;
            <input type="radio" id="man_id" name="mark_type" value="1">
            <label for="female">Manual</label><br/>
        </div>
    </div> -->

    <div style="padding:10px;">
        <div style="border-style: ridge;padding:10px;border-radius: 25px;margin:10px 10px 5px;">
            <p><b>Do you want your questions devided into sections?</b></p>
            <input type="radio" id="no_sec" name="sec_type" value="0" required>
            <label for="Subject">No</label> &nbsp; &nbsp;
            <input type="radio" id="yes_sec" name="sec_type" value="1">
            <label for="female">Yes</label><br/>
            <div id="sec_field" style="padding:5px;">
                <label>Enter Section Name</label>
                <input type="text" name="section_name" placeholder="Section One Name" />
            </div>
        </div>
    </div>
<!-- 
    <div style="padding:10px;">
        <div style="border-style: ridge;padding:10px;border-radius: 25px;margin:10px 10px 5px;">
            <p><b>Do you want marks to be added to each question?</b></p>
            <input type="radio" id="" name="mark_type" value="0" required>
            <label for="Subject">No</label> &nbsp; &nbsp;
            <input type="radio" id="" name="mark_type" value="1">
            <label for="female">Yes</label><br/>
        </div>
    </div> -->
    <input type="submit" name="submit" value="Create Assignment"/>
    </form>
  </div>

</div>


<h1 class="my-4">Assignments List</h1>


<script>
    $(".startbut").on("click", function(){
            $('#myModal').css("display", "block");
    });

    $(".submit").on("click", function(){
        $('#error_message').css("display", "block");
    });

    $(".close").on("click", function(){
        $('#myModal').css("display", "none");
        $('#error_message').css("display", "none");
    });

    $('input[type=radio][name=ass_type]').change(function() {
        if (this.value == '1') {
            $('#select_lecture').css("display", "block");
            $('#select_subject').css("display", "none");
        }else if (this.value == '0'){
            $('#select_subject').css("display", "block");
            $('#select_lecture').css("display", "none");
        }
    });

    $('input[type=radio][name=sec_type]').change(function() {
        if (this.value == '1') {
            $('#sec_field').css("display", "block");
        }else{
            $('#sec_field').css("display", "none");
        }
    });
</script>
@endsection