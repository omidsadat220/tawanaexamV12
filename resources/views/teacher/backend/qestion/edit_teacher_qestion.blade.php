@extends('teacher.teacher_dashboard')
@section('teacher')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


    <div class="container-fluid pt-4 px-4">
        <div class="row vh-auto bg-secondary rounded align-items-center justify-content-center mx-0">
            <div class="col-12 text-center">
                <!-- Categories List Page -->

                <!-- Add New Category Page -->
                <div class="form-container container-form" id="add-category-page" style="display: block;">
                    <a href="{{ route('all.qestion') }}" class="back-link d-block text-start" id="backBtn">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg" style="cursor: pointer">
                            <path d="M15 6L9 12L15 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"></path>
                        </svg>
                        Back to qestion
                    </a>

                    <h2 class="text-white">Edit New qestion</h2>
                    <form id="qestionForm" action="{{ route('update.teacher.qestion') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $editData->id }}">

                        <div class="row">
                            <div class="col-12">
                                <label class="col-sm-4 col-form-label">Subject</label>
                                <div class="col-sm-10">
                                    <select name="subject_id" class="form-select" id="subject-dropdown">
                                        <option value="">Select Subject</option>
                                        @foreach ($subjects as $subject)
                                            <option value="{{ $subject->id }}"
                                                {{ old('subject_id', $editData->subject_id) == $subject->id ? 'selected' : '' }}>
                                                {{ $subject->subject_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 mb-3 d-flex align-items-center justify-content-between">
                                <label for="question">What is Question</label>
                                <input class="catinput" type="text" id="question" name="question"
                                    value="{{ $editData->question }}">
                            </div>

                            @foreach (['option1', 'option2', 'option3', 'option4'] as $option)
                                <div class="col-12 mb-3 d-flex align-items-center justify-content-between">
                                    <label for="{{ $option }}">{{ ucfirst($option) }}</label>
                                    <input class="catinput" type="text" id="{{ $option }}"
                                        name="{{ $option }}" value="{{ $editData->$option }}">
                                </div>
                            @endforeach

                            <div class="col-12 mb-3 d-flex align-items-center justify-content-between">
                                <label for="correct_answer">Correct Answer</label>
                                <input class="catinput" type="text" id="correct_answer" name="correct_answer"
                                    value="{{ $editData->correct_answer }}">
                            </div>

                            <div class="col-md-6">
                                <label for="image" class="form-label">Question Image</label>
                                <input type="file" class="form-control" name="image" id="image">
                            </div>

                            <div class="col-md-6">
                                <img id="showImage" style="width:100px;"
                                    src="{{ $editData->image ? asset($editData->image) : asset('upload/no_image.jpg') }}"
                                    class="rounded-circle avatar-xl img-thumbnail float-start" alt="image profile">
                            </div>

                            <div class="col-12 d-flex align-items-end w-100 justify-content-end">
                                <button style="--clr: #39ff14" type="submit" class="button-styleee mb-3">
                                    <span>Save Question</span><i></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            })
        })
    </script>
@endsection
