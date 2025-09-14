@extends('admin.admin_dashboard')
@section('admin')


<div class="container-fluid pt-4 px-4">
            <div class="row vh-auto bg-secondary rounded align-items-center justify-content-center mx-0">
              <div class="col-12 text-center">
                <!-- Categories List Page -->

                <!-- Add New Category Page -->
                <div class="form-container container-form" id="add-category-page" style="display: block;">
                  <a href="{{route('all.answer')}}" class="back-link d-block text-start" id="backBtn">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="cursor: pointer">
                      <path d="M15 6L9 12L15 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                    Back to Categorie
                  </a>

                  <h2 class="text-white">Add New Category</h2>
                  <form id="categoryForm" action="{{route('store.subject')}}"  method="POST">


                    @csrf
                    
                    <div class="row">
                      <div class="col-12 d-flex align-items-center justify-content-between mb-3">
                        <label for="class_category_id" class="text-start">Category Name</label>
                        <select name="class_category_id" id="class_category_id" class="form-control form-select">
                            <option value="">Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->class_category }}</option>
                            @endforeach
                        </select>
                    </div>

                       <div class="col-12 d-flex align-items-center justify-content-between mb-3">
                        <label for="categoryName" class="text-start">subject_name</label>
                        <input class="catinput" type="text" id="subject_name" name="subject_name" >
                      </div>

                         
                       

                     
                      <div class="col-12 d-flex align-items-end w-100 justify-content-end">
                        <a href="#" class="mb-3" id="addNewBtn">
                          <button style="--clr: #39ff14" type="submit" class="button-styleee">
                            <span>Save Category</span><i></i>
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