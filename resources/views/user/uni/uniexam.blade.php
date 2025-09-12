<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Advanced Online Exam System with Images</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    />
    <style>
      @import url("https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap");

      * {
        font-family: "Inter", sans-serif;
      }

      body {
        /* background: linear-gradient(135deg, #2e2e2e 0%, #000000 100%); */
        background-color: rgb(38, 38, 38);
        min-height: 100vh;
        color: #e2e8f0;
      }

      .gradient-border {
        position: relative;
        background: rgb(38, 38, 38);
        border-radius: 16px;
        padding: 1px;
      }

      .gradient-border::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        border-radius: 16px;
        padding: 2px;
        /* background: linear-gradient(135deg, #68f163 0%, #00ff55 100%); */
        background: rgb(38, 38, 38);

        -webkit-mask: linear-gradient(#fff 0 0) content-box,
          linear-gradient(#fff 0 0);
        mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
        -webkit-mask-composite: xor;
        mask-composite: exclude;
      }

      .option-hover:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(99, 241, 106, 0.3);
      }

      .question-number {
        transition: all 0.3s ease;
      }

      .question-number:hover {
        transform: scale(1.1);
        background: linear-gradient(135deg, #63f176 0%, #050505 100%);
      }

      .question-image {
        transition: all 0.3s ease;
        cursor: zoom-in;
      }

      .question-image:hover {
        transform: scale(1.02);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);
      }

      .image-modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.9);
        z-index: 1000;
        justify-content: center;
        align-items: center;
      }

      .modal-content {
        max-width: 90%;
        max-height: 90%;
      }

      @keyframes pulse {
        0% {
          transform: scale(1);
        }
        50% {
          transform: scale(1.05);
        }
        100% {
          transform: scale(1);
        }
      }

      .pulse {
        animation: pulse 2s infinite;
      }

      /* <!-- body animation datted css start --> */

      /* Container for particles */
      .floating-particles {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none; /* Allow clicks through */
        z-index: 0; /* Behind all elements */
        overflow: hidden;
        /* background: linear-gradient(135deg, #0a0a0a 0%, #1a1a1a 100%); */
      }

      /* Each particle */
      .particle {
        position: absolute;
        width: 4px;
        height: 4px;
        background: #00ff88;
        border-radius: 50%;
        opacity: 0;
        animation: float linear infinite;
      }

      /* Float animation */
      @keyframes float {
        0% {
          transform: translateY(100vh) rotate(0deg);
          opacity: 0;
        }
        10% {
          opacity: 1;
        }
        90% {
          opacity: 1;
        }
        100% {
          transform: translateY(-50px) rotate(360deg);
          opacity: 0;
        }
      }
      /* <!-- body animation datted css end --> */
    </style>
  </head>
  <body class="min-h-screen py-8 px-4">
    <!-- Image Modal -->
    <div id="imageModal" class="image-modal">
      <div class="modal-content">
        <img
          id="modalImage"
          src=""
          alt=""
          class="w-full h-full object-contain"
        />
      </div>
      <button
        onclick="closeModal()"
        class="absolute top-4 right-4 text-white text-2xl bg-gray-800 p-2 rounded-full hover:bg-gray-700"
      >
        <i class="fas fa-times"></i>
      </button>
    </div>

    <div class="max-w-7xl mx-auto">
      <!-- Header -->
      <div class="gradient-border mb-8">
        <div class="bg-gray-800 rounded-2xl p-6 relative overflow-hidden">
          <div
            class="absolute top-0 right-0 w-32 h-32 bg-green-600 opacity-10 rounded-full -translate-x-16 -translate-y-16"
          ></div>
          <div
            class="absolute bottom-0 left-0 w-40 h-40 bg-green-600 opacity-10 rounded-full translate-x-20 translate-y-20"
          ></div>

          <div
            class="flex flex-col md:flex-row justify-between items-center relative z-10"
          >

          @php
            $category = App\Models\Category::first();
          @endphp
            <div>
              <h1
                class="text-2xl md:text-3xl font-bold bg-gradient-to-r from-green-400 to-green-700 bg-clip-text text-transparent"
              >
                Tawana Technology Exam Center
              </h1>
              <p class="text-gray-400 mt-2">
                Specialized Web Programming Questions {{$category->uni_name}}
              </p>
            </div>

            <div class="flex items-center space-x-4 mt-4 md:mt-0">
              <div class="flex items-center">
                <div
                  class="w-3 h-3 bg-green-400 rounded-full mr-2 animate-pulse"
                ></div>
                <span class="text-sm text-green-400">Online</span>
              </div>
              <div class="text-gray-400 text-sm">
                <i class="far fa-clock mr-1"></i>
                <span id="timer">45:00</span>
              </div>
            </div>
          </div>
        </div>
      </div>

     

      <div class="flex flex-col lg:flex-row gap-6">
        <!-- Main Content -->
        <div class="lg:w-3/4 order-2 lg:order-1">
          <div class="gradient-border">
            <div
              class="bg-gray-800 rounded-2xl p-6 md:p-8 relative overflow-hidden"
            >
              <!-- Question Progress -->
              <div class="flex justify-between items-center mb-6">
                <span class="text-sm text-gray-400">Question 5 of 20</span>
                <span class="text-sm text-yellow-400">Score: 4 of 5</span>
              </div>

                 @php
                 $answer = \App\Models\uni_answer_q::orderBy('id')->paginate(1);
                 $title = \App\Models\uni_answer_q::all();
              @endphp

              <!-- Question -->
              <div class="gradient-border mb-8">

                <form action="{{'update.exam' , $category->id}}" method="POST">


                @csrf

  

                 <input type="hidden" name="cat_id" id="cat_id" value="{{ $category->id }}">

                               @foreach($answer as $item)
                <div class="bg-gray-900 rounded-xl p-6">
                  <h2 class="text-xl font-semibold text-white mb-4">

                                  @foreach ($answer as $ans)
                                      
                               <input type="text" name="question" value="{{ $ans->question }}" class="form-control">
                                  

                                  @endforeach

                    {{-- {{$item->question}} --}}
                  </h2>

                  <div
                    class="mt-4 p-4 bg-gray-800 rounded-lg border-l-4 border-green-500"
                  >
                    <h3 class="font-medium text-green-300 mb-2">
                      Question Details:
                    </h3>
                    <p class="text-gray-400 text-sm leading-6">
                      This question relates to advanced CSS Grid Layout
                      concepts. Please review all options carefully and refer to
                      the diagram if needed. This question relates to advanced
                      CSS Grid Layout concepts. Please review all options
                      carefully and refer to the diagram if needed. This
                      question relates to advanced CSS Grid Layout concepts.
                      Please review all options carefully and refer to the
                      diagram if needed.
                    </p>
                  </div>
                </div>
              </div>

            

              <!-- Options -->
 

              <div class="space-y-4">

                     <div class="option-hover gradient-border">
                  <label
                    class="flex items-center bg-gray-900 rounded-xl p-4 cursor-pointer transition-all duration-300"
                  >
                    <input type="radio" name="correct_answer" class="hidden" />
                    <div
                      class="w-6 h-6 rounded-full border-2 border-gray-600 flex items-center justify-center mr-3 transition-all duration-300"
                    >
                      <div
                        class="w-3 h-3 rounded-full bg-green-500 opacity-0 transition-opacity duration-300"
                      ></div>
                    </div>
                    <span class="text-gray-300 flex-1"
                      >{{$item->question_one}}</span
                    >
                    <span class="text-xs text-white-500 ml-2">A</span>
                  </label>
                </div>
               
             

                <div class="option-hover gradient-border">
                  <label
                    class="flex items-center bg-gray-900 rounded-xl p-4 cursor-pointer transition-all duration-300"
                  >
                    <input type="radio" name="correct_answer" class="hidden" />
                    <div
                      class="w-6 h-6 rounded-full border-2 border-gray-600 flex items-center justify-center mr-3 transition-all duration-300"
                    >
                      <div
                        class="w-3 h-3 rounded-full bg-purple-500 opacity-0 transition-opacity duration-300"
                      ></div>
                    </div>
                    <span class="text-gray-300 flex-1"
                      >{{$item->question_two}}</span
                    >
                    <span class="text-xs text-gray-500 ml-2">B</span>
                  </label>
                </div>

                <div class="option-hover gradient-border">
                  <label
                    class="flex items-center bg-gray-900 rounded-xl p-4 cursor-pointer transition-all duration-300"
                  >
                    <input type="radio" name="correct_answer" class="hidden" />
                    <div
                      class="w-6 h-6 rounded-full border-2 border-gray-600 flex items-center justify-center mr-3 transition-all duration-300"
                    >
                      <div
                        class="w-3 h-3 rounded-full bg-purple-500 opacity-0 transition-opacity duration-300"
                      ></div>
                    </div>
                    <span class="text-gray-300 flex-1"
                      >{{$item->question_three}}</span
                    >
                    <span class="text-xs text-gray-500 ml-2">C</span>
                  </label>
                </div>

                <div class="option-hover gradient-border">
                  <label
                    class="flex items-center bg-gray-900 rounded-xl p-4 cursor-pointer transition-all duration-300"
                  >
                    <input type="radio" name="correct_answer" class="hidden" />
                    <div
                      class="w-6 h-6 rounded-full border-2 border-gray-600 flex items-center justify-center mr-3 transition-all duration-300"
                    >
                      <div
                        class="w-3 h-3 rounded-full bg-purple-500 opacity-0 transition-opacity duration-300"
                      ></div>
                    </div>
                    <span class="text-gray-300 flex-1"
                      >{{$item->question_four}}</span
                    >
                    <span class="text-xs text-gray-500 ml-2">D</span>
                  </label>
                </div>



              </div>
                 @endforeach


              <!-- Navigation Buttons -->

              <!-- Laravel Pagination -->
<div class="mt-6 flex justify-between">
  {{-- Previous Page --}}
  @if ($answer->onFirstPage())
      <span class="px-4 py-2 bg-gray-700 text-gray-400 rounded">Previous</span>
  @else
      <a href="{{ $answer->previousPageUrl() }}" 
         class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
         Previous
      </a>
  @endif

  {{-- Next Page --}}
  @if ($answer->hasMorePages())
      <a href="{{ $answer->nextPageUrl() }}" 
         class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
         Next
      </a>
  @else
  <button type="submit" class="px-4 py-2 bg-gray-700 text-gray-400 rounded">Next</button>
      {{-- <span class="px-4 py-2 bg-gray-700 text-gray-400 rounded">Next</span> --}}
  @endif
</div>
              {{-- <div
                class="flex justify-between mt-8 pt-6 border-t border-gray-700"
              >
                <button
                  class="px-6 py-3 bg-gray-700 text-gray-300 rounded-lg bg-gradient-to-r from-dark-600 to-green-600 transition-colors duration-300 flex items-center"
                >
                  <i class="fas fa-arrow-left mr-2"></i>
                  Previous Question
                </button>
                <button
                  class="px-6 py-3 bg-gradient-to-r from-green-600 to-dark-600 text-white rounded-lg hover:from-dark-700 hover:to-green-700 transition-all duration-300 flex items-center pulse"
                >
                  Next Question
                  <i class="fas fa-arrow-right ml-2"></i>
                </button>
              </div> --}}
            </div>
          </div>
        </div>

                </form>


        <!-- Sidebar -->
        <div class="lg:w-1/4 order-1 lg:order-2">
          <div class="gradient-border sticky top-6">
            <div class="bg-gray-800 rounded-2xl p-6">
              <h3
                class="text-lg font-semibold text-white mb-4 flex items-center"
              >
                <i class="fas fa-list-ol mr-2 text-purple-400"></i>
                Questions
              </h3>

              <div class="grid grid-cols-5 gap-2">
                <div
                  class="question-number w-8 h-8 bg-green-500 text-white rounded-full flex items-center justify-center text-sm cursor-pointer"
                >
                  1
                </div>
                <div
                  class="question-number w-8 h-8 bg-green-500 text-white rounded-full flex items-center justify-center text-sm cursor-pointer"
                >
                  2
                </div>
                <div
                  class="question-number w-8 h-8 bg-green-500 text-white rounded-full flex items-center justify-center text-sm cursor-pointer"
                >
                  3
                </div>
                <div
                  class="question-number w-8 h-8 bg-green-500 text-white rounded-full flex items-center justify-center text-sm cursor-pointer"
                >
                  4
                </div>
                <div
                  class="question-number w-8 h-8 bg-purple-500 text-white rounded-full flex items-center justify-center text-sm cursor-pointer"
                >
                  <i class="fas fa-image text-xs"></i>
                </div>

                <div
                  class="question-number w-8 h-8 bg-gray-700 text-gray-300 rounded-full flex items-center justify-center text-sm cursor-pointer"
                >
                  6
                </div>
                <div
                  class="question-number w-8 h-8 bg-gray-700 text-gray-300 rounded-full flex items-center justify-center text-sm cursor-pointer"
                >
                  7
                </div>
                <div
                  class="question-number w-8 h-8 bg-gray-700 text-gray-300 rounded-full flex items-center justify-center text-sm cursor-pointer"
                >
                  8
                </div>
                <div
                  class="question-number w-8 h-8 bg-gray-700 text-gray-300 rounded-full flex items-center justify-center text-sm cursor-pointer"
                >
                  <i class="fas fa-image text-xs"></i>
                </div>
                <div
                  class="question-number w-8 h-8 bg-gray-700 text-gray-300 rounded-full flex items-center justify-center text-sm cursor-pointer"
                >
                  10
                </div>

                <div
                  class="question-number w-8 h-8 bg-gray-700 text-gray-300 rounded-full flex items-center justify-center text-sm cursor-pointer"
                >
                  11
                </div>
                <div
                  class="question-number w-8 h-8 bg-gray-700 text-gray-300 rounded-full flex items-center justify-center text-sm cursor-pointer"
                >
                  12
                </div>
                <div
                  class="question-number w-8 h-8 bg-gray-700 text-gray-300 rounded-full flex items-center justify-center text-sm cursor-pointer"
                >
                  13
                </div>
                <div
                  class="question-number w-8 h-8 bg-gray-700 text-gray-300 rounded-full flex items-center justify-center text-sm cursor-pointer"
                >
                  14
                </div>
                <div
                  class="question-number w-8 h-8 bg-gray-700 text-gray-300 rounded-full flex items-center justify-center text-sm cursor-pointer"
                >
                  15
                </div>

                <div
                  class="question-number w-8 h-8 bg-gray-700 text-gray-300 rounded-full flex items-center justify-center text-sm cursor-pointer"
                >
                  16
                </div>
                <div
                  class="question-number w-8 h-8 bg-gray-700 text-gray-300 rounded-full flex items-center justify-center text-sm cursor-pointer"
                >
                  17
                </div>
                <div
                  class="question-number w-8 h-8 bg-gray-700 text-gray-300 rounded-full flex items-center justify-center text-sm cursor-pointer"
                >
                  18
                </div>
                <div
                  class="question-number w-8 h-8 bg-gray-700 text-gray-300 rounded-full flex items-center justify-center text-sm cursor-pointer"
                >
                  <i class="fas fa-image text-xs"></i>
                </div>
                <div
                  class="question-number w-8 h-8 bg-gray-700 text-gray-300 rounded-full flex items-center justify-center text-sm cursor-pointer"
                >
                  20
                </div>
              </div>

              <div class="mt-6 p-4 bg-gray-900 rounded-lg">
                <div class="flex justify-between items-center mb-2">
                  <span class="text-sm text-gray-400">Answered:</span>
                  <span class="text-sm text-green-400">4 questions</span>
                </div>
                <div class="flex justify-between items-center mb-2">
                  <span class="text-sm text-gray-400">With Images:</span>
                  <span class="text-sm text-blue-400">3 questions</span>
                </div>
                <div class="flex justify-between items-center">
                  <span class="text-sm text-gray-400">Remaining:</span>
                  <span class="text-sm text-yellow-400">16 questions</span>
                </div>
              </div>

              <button
                class="w-full mt-6 bg-red-500 hover:bg-red-600 text-white py-3 rounded-lg transition-colors duration-300 flex items-center justify-center"
              >
                <i class="fas fa-paper-plane mr-2"></i>
                Finish Exam
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="floating-particles" id="particles"></div>

    <script>
      // Timer functionality
      function startTimer(duration, display) {
        let timer = duration,
          minutes,
          seconds;
        setInterval(function () {
          minutes = parseInt(timer / 60, 10);
          seconds = parseInt(timer % 60, 10);

          minutes = minutes < 10 ? "0" + minutes : minutes;
          seconds = seconds < 10 ? "0" + seconds : seconds;

          display.textContent = minutes + ":" + seconds;

          if (--timer < 0) {
            timer = duration;
          }
        }, 1000);
      }

      // Image modal functions
      function openModal(src, alt) {
        const modal = document.getElementById("imageModal");
        const modalImage = document.getElementById("modalImage");

        modalImage.src = src;
        modalImage.alt = alt;
        modal.style.display = "flex";
        document.body.style.overflow = "hidden";
      }

      function closeModal() {
        const modal = document.getElementById("imageModal");
        modal.style.display = "none";
        document.body.style.overflow = "auto";
      }

      // Close modal when clicking outside
      document
        .getElementById("imageModal")
        .addEventListener("click", function (e) {
          if (e.target === this) {
            closeModal();
          }
        });

      // Close modal with Escape key
      document.addEventListener("keydown", function (e) {
        if (e.key === "Escape") {
          closeModal();
        }
      });

      window.onload = function () {
        const fortyFiveMinutes = 45 * 60;
        const display = document.querySelector("#timer");
        startTimer(fortyFiveMinutes, display);
      };

      // Option selection
      document.querySelectorAll("label").forEach((label) => {
        label.addEventListener("click", function () {
          // Remove selection from all options
          document.querySelectorAll(".option-hover").forEach((opt) => {
            opt.querySelector("div > div").style.opacity = "0";
            opt.querySelector("label").classList.remove("bg-green-900");
          });

          // Add selection to clicked option
          const innerCircle = this.querySelector("div > div");
          innerCircle.style.opacity = "1";
          this.classList.add("bg-green-900");
        });
      });

      // Question number hover effect
      document.querySelectorAll(".question-number").forEach((number) => {
        number.addEventListener("mouseenter", function () {
          this.style.transform = "scale(1.1)";
        });

        number.addEventListener("mouseleave", function () {
          this.style.transform = "scale(1)";
        });
      });
    </script>

    <!-- body animation datted script start -->
    <script>
      function createParticles(count = 50) {
        const container = document.getElementById("particles");
        container.innerHTML = ""; // Clear existing particles
        for (let i = 0; i < count; i++) {
          const p = document.createElement("div");
          p.className = "particle";
          p.style.left = Math.random() * 100 + "%";
          p.style.animationDelay = Math.random() * 5 + "s";
          p.style.animationDuration = Math.random() * 3 + 3 + "s";
          container.appendChild(p);
        }
      }
      // Run after DOM is ready
      document.addEventListener("DOMContentLoaded", () => {
        createParticles(20); // You can change number of particles
      });
    </script>
    <!-- body animation datted script end -->
  </body>
</html>