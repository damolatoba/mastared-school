@extends('layouts.index')
@section('content')
    <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <div class="container">
        <form method="POST" action="/course/{{ $course->id }}/update" id="course_create_form" enctype="multipart/form-data">
                @csrf

                <!-- @method('PUT') -->

                <div class="form-em">
                    <p>{{ __('Course Title:') }}</p>
                    <div>
                        <input type="text" name="title" value="{{$course->title}}" required>
                    </div>
                </div>

                <!-- <h2 class="cdates">Course Dates</h2> -->
                <div class="row form-em ">
                    <div class="col-md-4">
                    <label>{{ __('Subject:') }}</label>
                        <div>
                        <select name="subject_id" id="subject_select" required>
                            <option value="">Select Subject</option>
                            @foreach($subjects as $subject)
                            <option value="{{$subject->id}}">{{$subject->subject}}</option>
                            @endforeach
                        </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                    <p>{{ __('Lecture Date:') }} &nbsp; <span class="edit_date">{{ date('d-m-Y',(strtotime($course->start_date)))}} &nbsp; <button type="button" id="changestart" class="btn btn-link change_date">Change Start Date</button></span></p>
                        <div>
                        <input type="date" name="start_date" id="start_date">
                        </div>
                    </div>

                    <div class="col-md-4">
                    @if($course->video != 'null')
                        <p>{{ __('Course Video:') }}<button type="button" id="changevideo" class="btn btn-link change_item">Change Video</button></p>
                        <div>
                        <input type="file" name="video" id="video">
                        <video width="100%" controls>
                            <source src="{{url('')}}/uploads/videos/{{ $course->video }}" type="video/mp4">
                            <source src="{{url('')}}/uploads/videos/{{ $course->video }}" type="video/ogg">
                            Your browser does not support HTML video.
                        </video>
                        </div>  
                    @else
                        <p>{{ __('Course Video:') }}</p>
                        <div>
                        <input type="file" name="video">
                        </div>  
                    @endif
                    </div>
                </div>

                <div class="form-em">
                    <div>
                    <label>{{ __('Description/Instruction:') }}</label>
                    <textarea name="editor1" required>{{$course->description}}</textarea>
                        <script>
                                CKEDITOR.replace( 'editor1' );
                        </script>
                    </div>
                </div>

                <div class="row form-em">
                    <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary" style="width:100%;">
                                {{ __('Edit Lecture') }}
                            </button>
                        </div>
                    <div class="col-md-4"></div>
                </div>
            </form>
    </div>
    <script type="text/javascript">
    $(function() {
        $('#thumbnail').hide();
        $('#video').hide();
        $('#start_date').hide();
        $('#end_date').hide();

        $('#changethumb').click(function() {
            $('#thumbnail').show();
        });

        $('#changevideo').click(function() {
            $('#video').show();
        });

        $('#changestart').click(function() {
            $('#start_date').show();
        });

        $('#changeend').click(function() {
            $('#end_date').show();
        });

        let sub = <?php echo $course->subject_id; ?>;
        $('#subject_select').val(sub);
    });
    </script>
@endsection