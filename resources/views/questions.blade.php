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

#one_ans_div, #mul_ans_div, #theory_div {
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

#customers {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 60%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
  text-align:center;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #4CAF50;
  color: white;
}
</style>
@if (session('flash_message'))
    <div class="card-body">
        <div class="alert alert-success">
            {{ session('flash_message') }}
        </div>
    </div>
@endif
<!-- <a class="btn btn-secondary startbut" id="course_button">Create New Assignment</a> -->

                    <!-- Question div -->
<div>

        <div style="padding:10px;">
            <div style="border-style: ridge;padding:10px;border-radius: 25px;margin:10px 10px 5px;">
                <p><b>Question Type</b></p>
                <input type="radio" id="one_ans" class="quetype" name="question_type" value="0" required>
                <label for="Subject">Select One Answer</label> &nbsp; &nbsp;
                <input type="radio" id="mul_ans" class="quetype" name="question_type" value="1" required>
                <label for="Subject">Select Multiple Answers</label> &nbsp; &nbsp;
                <input type="radio" id="theory" class="quetype" name="question_type" value="2" required>
                <label for="female">Theory</label><br/>

                    <div id="one_ans_div">
                    <form action="/assignment/store" method="POST">
                        @csrf
                        <input type="hidden" name="assignment_id" value="{{ $assignment_id }}"/>
                        <input type="hidden" name="section_id" value="{{ $section_id }}"/>
                        <input type="hidden" name="question_type" value="0"/>
                        <label>Question</label>
                        <textarea name="question_for_one" placeholer="Enter question here"></textarea>
                        <label>Options</label>
                        <table id="customers">
                            <tr>
                                <th>First Option</th>
                                <th>Select Correct Answer</th>
                            </tr>
                            <tr>
                                <td><input type="text" name="option_one_for_one" placeholder="Option One"/></td>
                                <td><input type="radio" id="" name="option_value" value="1" required></td>
                            </tr>
                            <tr>
                                <td><input type="text" name="option_two_for_one" placeholder="Option Two"/></td>
                                <td><input type="radio" id="" name="option_value" value="2" required></td>
                            </tr>
                            <tr>
                                <td><input type="text" name="option_three_for_one" placeholder="Option Three"/></td>
                                <td><input type="radio" id="" name="option_value" value="3" required></td>
                            </tr>
                            <tr>
                                <td><input type="text" name="option_four_for_one" placeholder="Option Four"/></td>
                                <td><input type="radio" id="" name="option_value" value="4" required></td>
                            </tr>
                            <tr>
                                <td><input type="text" name="option_five_for_one" placeholder="Option Five"/></td>
                                <td><input type="radio" id="" name="option_value" value="5" required></td>
                            </tr>
                        </table>
                        <label>Select Action To Perform After Question Is Created</lable>
                        <select name="post_action_for_one">
                            <option value="1">Create A New Question</option>
                            <option value="2">Create A New Section</option>
                            <option value="3">Preview And Complete</option>
                        </select>
                        <input type="submit" name="submit" value="Add Question"/>
                    </form>
                    </div>

                    <div id="mul_ans_div">
                    <form action="/assignment/store" method="POST">
                        @csrf
                        <input type="hidden" name="assignment_id" value="{{ $assignment_id }}"/>
                        <input type="hidden" name="section_id" value="{{ $section_id }}"/>
                        <input type="hidden" name="question_type" value="1"/>
                        <label>Question</label>
                        <textarea name="question_for_two" placeholer="Enter question here"></textarea>
                        <label>Options</label>
                        <table id="customers">
                            <tr>
                                <th>First Option</th>
                                <th>Select Correct Answer</th>
                            </tr>
                            <tr>
                                <td><input type="text" name="option-one" placeholder="Option One"/></td>
                                <td><input type="checkbox" id="result" name="result[]" value="1"></td>
                            </tr>
                            <tr>
                                <td><input type="text" name="option-two" placeholder="Option Two"/></td>
                                <td><input type="checkbox" id="result" name="result[]" value="2"></td>
                            </tr>
                            <tr>
                                <td><input type="text" name="option-three" placeholder="Option Three"/></td>
                                <td><input type="checkbox" id="result" name="result[]" value="3"></td>
                            </tr>
                            <tr>
                                <td><input type="text" name="option-four" placeholder="Option Four"/></td>
                                <td><input type="checkbox" id="result" name="result[]" value="4"></td>
                            </tr>
                            <tr>
                                <td><input type="text" name="option-five" placeholder="Option Five"/></td>
                                <td><input type="checkbox" id="result" name="result[]" value="5"></td>
                            </tr>
                        </table>
                        <label>Select Action To Perform After Question Is Created</lable>
                        <select name="post_action_for_two">
                            <option value="1">Create A New Question</option>
                            <option value="2">Create A New Section</option>
                            <option value="3">Preview And Complete</option>
                        </select>
                        <input type="submit" name="submit" value="Add Question"/>
                    </form>
                    </div>

                    <div id="theory_div">
                    <form action="/assignment/store" method="POST">
                        @csrf
                        <input type="hidden" name="assignment_id" value="{{ $assignment_id }}"/>
                        <input type="hidden" name="section_id" value="{{ $section_id }}"/>
                        <input type="hidden" name="question_type" value="2"/>
                        <label>Question</label>
                        <textarea name="question_for_three" placeholer="Enter question here"></textarea>
                        <label>Select Action To Perform After Question Is Created</lable>
                        <select name="post_action_for_three">
                            <option value="1">Create A New Question</option>
                            <option value="2">Create A New Section</option>
                            <option value="3">Preview And Complete</option>
                        </select>
                        <input type="submit" name="submit" value="Add Question"/>
                    </form>
                    </div>
            </div>
        </div>
</div>


<!-- <h1 class="my-4">Assignments List</h1> -->


<script>
    // switch forms according to question type selected 
    $('input[type=radio][name=question_type]').change(function() {
        if (this.value == '0') {
            $('#one_ans_div').css("display", "block");
            $('#mul_ans_div').css("display", "none");
            $('#theory_div').css("display", "none");
        }else if (this.value == '1') {
            $('#mul_ans_div').css("display", "block");
            $('#one_ans_div').css("display", "none");
            $('#theory_div').css("display", "none");
        }else if (this.value == '2') {
            $('#theory_div').css("display", "block");
            $('#mul_ans_div').css("display", "none");
            $('#one_ans_div').css("display", "none");
        }
    });
</script>
@endsection