@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


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

                    <h2 class="text-white mb-4">Add New Category</h2>
                    <form id="categoryForm" action="{{ route('store.exam') }}" method="POST">
    @csrf

    <div class="row mb-3">

        <!-- Category selector -->
    <div class="col-md-6 d-flex align-items-start mb-3">
    <label for="class_category_id" class="form-label">Category Name</label>
    <select name="class_category_id" id="class_category_id" class="form-control form-select ms-3" required>
        <option value="">Select Category</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->class_category }}</option>
        @endforeach
    </select>
</div>

<!-- Subjects input -->
<div class="col-md-6 d-flex align-items-start mb-3">
    <label for="subject_id" class="form-label ms-3 mt-3">Subject Name</label>
    <select name="class_subject_id" id="subject_id" class="form-control form-select ms-3" required>
        <option value="">Select Subject</option>
        @foreach ($ClassSubjects as $classSubject)
            @php
                $subjects = is_array($classSubject->subject_name) ? $classSubject->subject_name : json_decode($classSubject->subject_name, true);
            @endphp

            @if($subjects)
                @foreach($subjects as $subject)
                    <option value="{{ $classSubject->id }}" data-category="{{ $classSubject->class_category_id }}">
                        {{ $subject }}
                    </option>
                @endforeach
            @else
                <option value="{{ $classSubject->id }}" data-category="{{ $classSubject->class_category_id }}">
                    {{ $classSubject->subject_name }}
                </option>
            @endif
        @endforeach
    </select>
</div>

 <div class="col-md-6 d-flex align-items-start">
            <label for="class_category_id" class="form-label ms-3 mt-3">Exam Name</label>
            <input type="text" name="exam_name" class="form_control">
           
        </div>

         <div class="col-md-6 d-flex align-items-center mb-3">
   <label class="col-form-label">Time (Am | PM)</label>
                        <input class="form-control" id="time" name="time" type="Time">
</div>


    </div>

    <div class="d-flex justify-content-end">
        <button type="submit" class="btn btn-success">Save Category</button>
    </div>
</form>

<!-- JS for dynamic add/remove -->

<!-- JS to filter subjects dynamically -->
<script>
    const categorySelect = document.getElementById('class_category_id');
    const subjectSelect = document.getElementById('subject_id');
    const allOptions = Array.from(subjectSelect.options);

    categorySelect.addEventListener('change', function() {
        const selectedCategoryId = this.value;

        // Clear current options except the first placeholder
        subjectSelect.innerHTML = '<option value="">Select Subject</option>';

        allOptions.forEach(option => {
            if(option.dataset.category === selectedCategoryId) {
                subjectSelect.appendChild(option.cloneNode(true));
            }
        });
    });
</script>
@endsection
