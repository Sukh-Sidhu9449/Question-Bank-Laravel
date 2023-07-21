@extends('admin_layout.template')
@section('main-content')
    <input type="text" name="quiz_technology_id" id="quiz_technology_id" hidden>
    <input type="text" name="quiz_technology_name" id="quiz_technology_name" hidden>
    <input type="text" name="quiz_framework_id" id="quiz_framework_id" hidden>
    <input type="text" name="quiz_framework_name" id="quiz_framework_name" hidden>
    <input type="text" name="mandateTechId" id="mandateTechId" hidden>
    <input type="text" name="opTechId" id="opTechId" hidden>
    
    <div id='load_technologies_quiz'>

        <div class="tech_content p-3" id="add_tech_content">
            <div class="first_section">
                <div class="bg-white">
                    <div class="row align-items-center">
                        <div class="page_title">
                            <div>

                                <h6 class="page-title p-3 mt-2">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item active" aria-current="page">Technologies</li>
                                        </ol>
                                    </nav>
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row gy-3">
                    @foreach ($technologies as $technology)
                        <div class="col-lg-3 col-md-4 col-6">
                            <div id="white_box" class="click-tech-div" data-id="{{ $technology->id }}">
                                <div id="clickable_quiz">
                                    <h5 class=" text-center mb-0">{{ $technology->technology_name }}</h5>
                                </div>
                                {{-- <div id="icons_gap">
                                    <input type="checkbox" data-id="{{ $technology->id }}" class="technology_check">
                                </div> --}}
                            </div>
                        </div>
                    @endforeach

                </div>
                <div>
                    <button id="techGoBtn" class="btn btn-dark-blue my-3 px-4 py-2">Next </button>
                </div>
            </div>
        </div>

    </div>


    <div id='load_frameworks_quiz'>

        <div class="framework_content p-3 ">
            <div class="first_section">
                <div class="bg-white">
                    <div class="row gy-3">
                        <div class="page_title">
                            <div>
                                <h6 class="page-title p-3 mt-2">
                                    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a class="bread_home"
                                                    href="#">Technologies</a></li>
                                            <li class="breadcrumb-item active bread_tech" aria-current="page">Frameworks
                                            </li>
                                        </ol>
                                    </nav>
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="spinner-grow" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            <div id="dynamic_frameworks_quiz" class="container-fluid">


            </div>
             {{-- Modal choosing Mandatory and Optional skill --}}
             <div class="modal fade" id="techCategoryModal" tabindex="-1" aria-labelledby="techCategoryModalLabel"
             aria-hidden="true">
             <div class="modal-dialog">
                 <div class="modal-content"style=" width: 150%;">
                     <div class="modal-header">
                         <h5 class="modal-title" id="techCategoryModalLabel">Mandatory / Optional Technologies</h5>
                         {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                     </div>
                     <div class="modal-body">
                         <div class="bg-white">
                             <table id="techCategoryTable" class="table table-responsive text-center">
                                <thead class="table-secondary">
                                    <th>S.No</th>
                                    <th>Technology Name</th>
                                    <th>Mandatory</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>PHP</td>
                                        <td><input type="checkbox" class="" ></td>
                                    </tr>
                                </tbody>
                             </table>
                             <div class="text-center">
                                <button id="techCategoryBtn" class="btn btn-dark-blue">Submit</button>
                             </div>
                         </div>
                     </div>

                 </div>
             </div>
         </div>

        </div>

    </div>

    <div id="load_question_quiz">

        <div class="ques_ans_content p-3">
            <div class="first_section">
                <div class="bg-white">
                    <div class="row align-items-center">
                        <div class="page_title">
                            <div>
                                <h6 class="page-title p-3 mt-2">
                                    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a class="bread_home"
                                                    href="#">Technologies</a></li>
                                            <li class="breadcrumb-item"><a class="bread_technology"
                                                    href="#">Frameworks</a></li>
                                            <li class="breadcrumb-item active bread_frame" aria-current="page">Questions
                                            </li>
                                        </ol>
                                    </nav>
                                </h6>
                            </div>
                            <div class="d-flex">
                                <div class="random_btn">
                                    <button id="randomBtn" class="btn btn-dark-blue aaa" data-bs-toggle="modal"
                                        data-bs-target="#randomQuesModal">Random</button>
                                </div>
                                <div>

                                </div>
                                <div>
                                    <select id="quiz_page_limit" class="form-select mt-3 mx-3 w-75 dropdown_pagination">
                                        <option value="10" selected>10</option>
                                        <option value="20">20</option>
                                        <option value="30">30</option>
                                        <option value="40">40</option>
                                    </select>
                                </div>
                                <div>
                                    <select id="quiz_experience"
                                        class="form-select mt-3 mx-3 w-75 dropdown_quiz_experience">
                                        <option value="0" selected>All</option>
                                        <option value="1">Beginner</option>
                                        <option value="2">Intermediate</option>
                                        <option value="3">Advanced</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="spinner-grow" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            <div id="dynamic_question_quiz" class="container-fluid">
                <div class="first_section">
                    <div class="bg-white">
                        <table id="test_table" class="table table-hover">
                            <thead class="table-dark">
                                <th><input type="checkbox" id="select-all-ques"></th>
                                <th>S.N.</th>
                                <th>Quiz Questions</th>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3">
                                        <form id="testDescriptionForm" method="POST">
                                            <label for="test_description"><strong>Description</strong></label>
                                            <input type="text" name="test_description" id="test_description"
                                                class="test_description">
                                            <div class="text-danger errorspan"></div>
                                            <br>

                                            <label for="test_timer"><strong>Timer</strong></label>
                                            <input type="text" name="test_timer" id="test_timer" class="test_timer"
                                                placeholder="In Minutes">
                                            <div class="text-danger errorspan"></div>
                                            <button type="submit" class="btn btn-dark-blue mb-2 make_test">Create Quiz</button>
                                        </form>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                </div>
                <div class="addQuesForQues">
                    <button type="button" class="btn btn-info mb-3 aaaa">Add Questions for Quiz</button>
                </div>
                <div class="noDataFound">

                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="randomQuesModal" tabindex="-1" aria-labelledby="randomQuesModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="randomQuesModalLabel">Choose Random Number</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class=" totalqueslabel">
                                <label class="form-label" for="totalQues">Total Questions</label>
                            </div>
                            <div>
                                <input id="totalQues" name="totalQues" type="text" class="form-control" readonly>
                            </div>
                            <div class="noofquestion">
                                <label class="form-label" for="noOfQues">No. of Questions</label>
                            </div>
                            <div>
                                <input id="noOfQues" name="noOfQues"type="number" class="form-control" required>
                            </div>
                            <div>
                                <span id="randomQuesError" class="text-danger"></span>
                            </div>


                        </div>
                        <div class="modal-footer">
                            <button type="button" id="genterateRandom" class="btn btn-dark-blue">Generate
                                Questions</button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Modal Display Question --}}

            <div class="modal fade" id="modal2" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content"style=" width: 150%;">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Random Questions</h5>
                            {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                        </div>
                        <div class="modal-body">
                            <div class="bg-white">
                                <table id="randomTestTable" class="table table-hover">
                                    <thead class="table-dark">
                                        <th><input type="checkbox" id="select-all-random"></th>
                                        <th>S.N.</th>
                                        <th>Quiz Questions</th>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="3">
                                                <form id="testRandomDescriptionForm" method="POST">
                                                    <label for="test_description"><strong>Description</strong></label>
                                                    <input type="text" name="testRandomDescription"
                                                        id="testRandomDescription" class="test_description">
                                                    <div id="errorspan" class="text-danger"></div>
                                                    <br>

                                                    <label for="randomTestTimer"><strong>Timer</strong></label>
                                                    <input type="text" name="randomTestTimer" id="randomTestTimer"
                                                        class="test_timer" placeholder="In Minutes">
                                                    <div class="text-danger errorspan"></div>
                                                    <button type="submit" class="btn btn-dark-blue m-2 makeRandomQuesTest">Create Quiz</button>
                                                </form>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

           
            
            <div class="page_loader">
                <button class="pageloader_button" id="pageloader_quiz_button">Load more...</button>
                <img src="{{ asset('img/pageloader.gif') }}" alt="Show/Hide Image"
                    class="page_loader_image"id="quiz_page_loader_image" height="80px" width="300px" />
            </div>



        </div>
    </div>
    <div>
        <br>
        <br>
    </div>
@endsection
