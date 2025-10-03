   <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
          <nav class="navbar bg-secondary navbar-dark">
            <a href="index.html" class="navbar-brand mx-4 mb-3">
              <h3 class="text-primary">
                <img src="{{asset('backend/assets/img/logo.png')}}" alt="logo" class="img-fluid logo" />
                <span id="typing"></span>
              </h3>
            </a>

            <div class="d-flex align-items-center ms-4 mb-4">
              <div class="position-relative">
                <img
                  class="rounded-circle"
                  src="{{asset('backend/assets/img/admin2.jpg')}}"
                  alt=""
                  style="width: 40px; height: 40px"
                />

                <div
                  class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"
                ></div>
              </div>

              
               @php
                          $id = Auth::user()->id;
                          $profileData = App\Models\User::find($id);
                      @endphp
              <div class="ms-3">
                <h6 class="mb-0">{{$profileData->name}}</h6>
                ss
                <span>{{$profileData->name}}</span>
              </div>
            </div>
            <div class="navbar-nav w-100">
              <a href="index.html" class="nav-item nav-link"
                ><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a
              >

              <div class="nav-item dropdown">

                <a
                  href="#"
                  class="nav-link dropdown-toggle"
                  data-bs-toggle="dropdown"
                  ><i class="far fa-file-alt me-2"></i>Final Exam</a
                >
                 <div class="dropdown-menu bg-transparent border-0">
                   <a href="{{route('all.category')}}" class="nav-item nav-link"
                  ><i class="fa fa-laptop me-2"></i> All Catagory</a
                >
                 <a href="{{route('all.answer')}}" class="nav-item nav-link"
                  ><i class="fa fa-laptop me-2"></i> All Answer</a
                >
                </div>

               
                

                
                {{-- <a href="Catagory.html" class="nav-item nav-link"
                  ><i class="fa fa-laptop me-2"></i>Teacher</a
                >
                <a href="subCatagory.html" class="nav-item nav-link"
                  ><i class="fa fa-laptop me-2"></i>SubCatagory</a
                >
                <a href="questionanswer.html" class="nav-item nav-link"
                  ><i class="fa fa-laptop me-2"></i>Q/A</a
                >
                <a href="exam.html" class="nav-item nav-link"
                  ><i class="fa fa-laptop me-2"></i>Exam</a
                > --}}
              </div>

             

                  <div class="nav-item dropdown">

                <a
                  href="#"
                  class="nav-link dropdown-toggle"
                  data-bs-toggle="dropdown"
                  ><i class="far fa-file-alt me-2"></i>all department</a
                >
                 <div class="dropdown-menu bg-transparent border-0">
                   <a href="{{route('all.depart')}}" class="nav-item nav-link"
                  ><i class="fa fa-laptop me-2"></i> All Department</a
                >

                  <a href="{{route('all.exam')}}" class="nav-item nav-link"
                  ><i class="fa fa-laptop me-2"></i> All Exam</a
                >
               
                </div>
                </div>

                <div class="nav-item dropdown">

                <a
                  href="#"
                  class="nav-link dropdown-toggle"
                  data-bs-toggle="dropdown"
                  ><i class="far fa-file-alt me-2"></i>all questions</a
                >
                 <div class="dropdown-menu bg-transparent border-0">
                   <a href="{{route('all.qestion')}}" class="nav-item nav-link"
                  ><i class="fa fa-laptop me-2"></i> All question</a
                >

                 
               
                </div>
                </div>

              {{-- <div class="nav-item dropdown">
                <a
                  href="#"
                  class="nav-link dropdown-toggle"
                  data-bs-toggle="dropdown"
                  ><i class="far fa-file-alt me-2"></i>Pages</a
                >
                <div class="dropdown-menu bg-transparent border-0">
                  <a href="teachers.html" class="dropdown-item">Teachers</a>
                            <a href="students.html" class="dropdown-item">Students</a> 
                  <a href="404.html" class="dropdown-item">404 Error</a>
                </div>
              </div> --}}
            </div>
          </nav>
        </div>
        <!-- Sidebar End -->