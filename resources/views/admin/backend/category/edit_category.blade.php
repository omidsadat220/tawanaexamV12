@extends('admin.admin_dashboard')
@section('admin')


<div class="container-fluid pt-4 px-4">
            <div class="row vh-auto bg-secondary rounded align-items-center justify-content-center mx-0">
              <div class="col-12 text-center">
                <!-- Categories List Page -->

                <!-- Add New Category Page -->
                <div class="form-container container-form" id="add-category-page" style="display: block;">
                  <a href="{{route('all.category')}}" class="back-link d-block text-start" id="backBtn">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="cursor: pointer">
                      <path d="M15 6L9 12L15 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                    Back to Categorie
                  </a>

                  <h2 class="text-white">Add New Category</h2>
                  <form id="categoryForm" action="{{route('update.category', $category->id)}}"  method="POST">


                    @csrf

                    <input type="hidden" name="cat_id" id="cat_id" value="{{ $category->id }}">
                    
                    <div class="row">
                      <div class="col-12 d-flex align-items-center justify-content-between mb-3">
                        <label for="categoryName" class="text-start">Uni Name </label>
                        <input class="catinput" type="text" id="categoryName" name="uni_name" value="{{$category->uni_name}}"  placeholder="Enter category name...">
                      </div>

                         <div class="col-12 d-flex align-items-center justify-content-between mb-3">
                        <label for="categoryName" class="text-start">Code</label>
                        <input class="catinput" type="text" id="categoryName" name="code" value="{{$category->code}}"  placeholder="Enter category name...">
                      </div>

                         <div class="col-4 d-flex align-items-center  justify-content-end  mb-3">
                        <label for="categoryName" class="text-start">Active</label>
                        <input class="catinput ms-2" type="checkbox" id="categoryName" placeholder="Enter category name...">
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