@extends('admin.admin_dashboard')
@section('admin')
    <div class="container-fluid pt-4 px-4">
        <div class="row vh-auto bg-secondary rounded align-items-center justify-content-center mx-0">
            <div class="col-12 text-center">
                <!-- Categories List Page -->

                <!-- Add New Category Page -->
                <div class="form-container container-form" id="add-category-page" style="display: block;">
                    <a href="{{ route('all.answer') }}" class="back-link d-block text-start" id="backBtn">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg" style="cursor: pointer">
                            <path d="M15 6L9 12L15 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"></path>
                        </svg>
                        Back to Categorie
                    </a>

                    <h2 class="text-white">Add New Category</h2>
                    <form id="categoryForm" action="{{ route('update.answer',$answer->id) }}" method="POST">


                        @csrf

                        <input type="hidden" name="ans_id" id="ans_id" value="{{ $answer->id }}">

                        <div class="row">
                            <div class="col-12 d-flex align-items-center justify-content-between mb-3">
                                <label for="category_id" class="text-start">Category Name</label>
                                <select name="category_id" id="category_id" class="form-control form-select">
                                    <option value="">Select Category</option>
                                    @foreach ($category as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $answer->category_id == $item->id ? 'selected' : '' }}>
                                            {{ $item->uni_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-12 d-flex align-items-center justify-content-between mb-3">
                            <label for="categoryName" class="text-start">question_one</label>
                            <input class="catinput" type="text" id="question_one" name="question_one"
                                value="{{ $answer->question_one }}">
                        </div>

                        <div class="col-12 d-flex align-items-center justify-content-between mb-3">
                            <label for="categoryName" class="text-start">question_two</label>
                            <input class="catinput" type="text" id="question_two" name="question_two"
                                value="{{ $answer->question_two }}">
                        </div>

                        <div class="col-12 d-flex align-items-center justify-content-between mb-3">
                            <label for="categoryName" class="text-start">question_three</label>
                            <input class="catinput" type="text" id="question_three" name="question_three"
                                value="{{ $answer->question_three }}">
                        </div>

                        <div class="col-12 d-flex align-items-center justify-content-between mb-3">
                            <label for="categoryName" class="text-start">question_four</label>
                            <input class="catinput" type="text" id="question_four" name="question_four"
                                value="{{ $answer->question_four }}">
                        </div>

                        <div class="col-12 d-flex align-items-center justify-content-between mb-3">
                            <label for="categoryName" class="text-start">correct_answer</label>
                            <input class="catinput" type="text" id="correct_answer" name="correct_answer"
                                value="{{ $answer->correct_answer }}">
                        </div>



                        <div class="col-12 d-flex align-items-end w-100 justify-content-end">
                            <a href="#" class="mb-3" id="addNewBtn">
                                <button style="--clr: #39ff14" type="submit" class="button-styleee">
                                    <span>Save Answer</span><i></i>
                                </button>
                            </a>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>
@endsection
