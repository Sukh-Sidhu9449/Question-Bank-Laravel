@extends('admin_layout.template')
@section('main-content')
    <input type="text" name="store_technology_id" id="store_technology_id" hidden>
    <input type="text" name="store_technology_name" id="store_technology_name" hidden>
    <input type="text" name="store_framework_id" id="store_framework_id" hidden>
    <input type="text" name="store_framework_name" id="store_framework_name" hidden>
    <input type="text" name="store_experience_id" id="store_experience_id" hidden>
    <input type="text" name="store_experience_name" id="store_experience_name" hidden>

    <div id='load_technologies_data'>
        <!--Add Technology Modal -->
        <div class="modal fade" id="addTechnologyModal" tabindex="-1" aria-labelledby="addTechnologyModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addTechnologyModalLabel">Add Technology</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="addTechnologyForm" action="{{ url('admin/technologies') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="technology_name">Technology</label>
                                <input type="text" class="form-control" name="technology_name" id="technology_name"
                                    placeholder="Technology Name">
                            </div>

                            <div class="form-group">
                                <label for="technology_description">Technology Description</label>
                                <textarea class="form-control" name="technology_description" id="technology_description" rows="3"></textarea>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" id="add_technology" class="btn btn-primary">Add Technology</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--Edit Technology Modal -->
        <div class="modal fade" id="editTechnologyModal" tabindex="-1" aria-labelledby="editTechnologyModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editTechnologyModalLabel">Edit Technology</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editTechnologyForm" action="{{ url('admin/technologies/update') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="edit_technology_name">Technology</label>
                                <input type="text" class="form-control" name="edit_technology_name"
                                    id="edit_technology_name" placeholder="Technology Name">
                            </div>

                            <div class="form-group">
                                <label for="edit_technology_description">Technology Description</label>
                                <textarea class="form-control" name="edit_technology_description" id="edit_technology_description" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="technology_id"></label>
                                <input type="text" class="form-control" name="technology_id" id="technology_id" hidden>
                            </div>


                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" id="update_technology" class="btn btn-primary">Update
                                    Technology</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="tech_content" id="add_tech_content">
            <div class="first_section">
                <div class="bg-white">
                    <div class="row align-items-center">
                        <div class="page_title">
                            <div>
                                <h5 class="page-title p-3 mt-2">Technologies</h5>
                            </div>
                            <div>
                                {{-- <a href="{{url('admin/technologies/add')}}"> --}}
                                <button type="button" id="add_tech" class="btn btn-success mt-3 mx-5"
                                    data-bs-toggle="modal" data-bs-target="#addTechnologyModal">Add Technologies</button>
                                {{-- </a> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row justify-content-left">
                    @foreach ($technologies as $technology)
                        <div class="col-lg-4 col-md-12">
                            <div id="white_box">
                                <div id="clickable" data-id="{{ $technology->id }}">
                                    <h4>{{ $technology->technology_name }}</h4>
                                </div>
                                <div id="icons_gap">
                                    <a id="delete_technology" data-id="{{ $technology->id }}">
                                        <i class="fa-solid fa-trash-can text-danger"></i>&nbsp;&nbsp;
                                    </a>
                                    <a id="edit_technology" data-id="{{ $technology->id }}" data-bs-toggle="modal"
                                        data-bs-target="#editTechnologyModal">
                                        <i class="fa-solid fa-pencil"></i>
                                    </a>
                                </div>

                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
    <div id="load_frameworks_data">
        <!--Add Framework Modal -->
        <div class="modal fade" id="addFrameworkModal" tabindex="-1" aria-labelledby="addFrameworkModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addFrameworkModalLabel">Add Framework</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="addFrameworkForm" action="{{ url('admin/frameworks') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="text" class="form-control" name="frame_technology_id"
                                    id="frame_technology_id" hidden>
                            </div>
                            <div class="form-group">
                                <label for="frame_technology_name">Technology</label>
                                <input type="text" class="form-control" name="frame_technology_name"
                                    id="frame_technology_name" disabled>
                            </div>
                            <div class="form-group">
                                <label for="framework_name">Framework</label>
                                <input type="text" class="form-control" name="framework_name" id="framework_name"
                                    placeholder="Framework Name">
                            </div>

                            <div class="form-group">
                                <label for="framework_description">Framework Description</label>
                                <textarea class="form-control" name="framework_description" id="framework_description" rows="3"></textarea>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" id="add_framework" class="btn btn-primary">Add Framework</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--Edit Framework Modal -->
        <div class="modal fade" id="editFrameworkModal" tabindex="-1" aria-labelledby="editFrameworkModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editFrameworkModalLabel">Edit Framework</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editFrameworkForm" action="{{ url('/admin/frameworks/edit') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="text" class="form-control" name="editframe_technology_id"
                                    id="editframe_technology_id" hidden>
                            </div>
                            <div class="form-group">
                                <label for="edit_framework_name">Framework</label>
                                <input type="text" class="form-control" name="edit_framework_name"
                                    id="edit_framework_name" placeholder="Framework Name">
                            </div>

                            <div class="form-group">
                                <label for="edit_framework_description">Framework Description</label>
                                <textarea class="form-control" name="edit_framework_description" id="edit_framework_description" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="framework_id" id="framework_id" hidden>
                            </div>


                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" id="update_framework" class="btn btn-primary">Update
                                    Framework</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="framework_content">
            <div class="first_section">
                <div class="bg-white">
                    <div class="row align-items-center">
                        <div class="page_title">
                            <div>
                                <h5 class="page-title p-3 mt-2"><span><i class="fa-regular fa-circle-left"
                                            id="back_btn"></i></span> Frameworks</h5>
                            </div>
                            <div>
                                <button type="button" id="show_Framework_Modal" data-bs-toggle="modal" data-bs-target="#addFrameworkModal"
                                    class="btn btn-success mt-3 mx-5">Add Frameworks</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div id="dynamic_frameworks" class="container-fluid">

            </div>
        </div>
    </div>
    <div id="load_experience_data" >
        <!--Add Experience Modal -->
        <div class="modal fade" id="addExperienceModal" tabindex="-1" aria-labelledby="addExperienceModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addExperienceModalLabel">Add Experience</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="addExperienceForm" action="{{ url('admin/experiences') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="experience_name">Experience</label>
                                <input type="text" class="form-control" name="experience_name" id="experience_name"
                                    placeholder="Experience Name">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" id="add_experience" class="btn btn-primary">Add Experience</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--Edit Experience Modal -->
        <div class="modal fade" id="editExperienceModal" tabindex="-1" aria-labelledby="editExperienceModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editExperienceModalLabel">Edit Experience</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editExperienceForm" action="{{ url('/admin/experiences/edit') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="edit_experience_name">Experience</label>
                                <input type="text" class="form-control" name="edit_experience_name"
                                    id="edit_experience_name" placeholder="Experience Name">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="experience_id" id="experience_id" hidden>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" id="update_experience" class="btn btn-primary">Update
                                    Experience</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="experience_content">
            <div class="first_section">
                <div class="bg-white">
                    <div class="row align-items-center">
                        <div class="page_title">
                            <div>
                                <h5 class="page-title p-3 mt-2"><span><i class="fa-regular fa-circle-left" id="back_btn"></i></span> Experiences</h5>
                            </div>
                            <div>
                                <button type="button" id="show_Experience_Modal" data-bs-toggle="modal" data-bs-target="#addExperienceModal"
                                    class="btn btn-success mt-3 mx-5">Add Experience</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div id="dynamic_experience" class="container-fluid">

            </div>
        </div>
    </div>
    <div id="load_question_data" >
        <!--Add Question Modal -->
        <div class="modal fade" id="addQuestionModal" tabindex="-1" aria-labelledby="addQuestionModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addQuestionModalLabel">Add Question</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="addQuestionForm" action="{{ url('admin/questions') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="ques_technology_name">Technology</label>
                                <input type="text" class="form-control" name="ques_technology_name" id="ques_technology_name"
                                disabled >
                            </div>
                            <div class="form-group">
                                <label for="ques_framework_name">Framework</label>
                                <input type="text" class="form-control" name="ques_framework_name" id="ques_framework_name"
                                disabled >
                            </div>
                            <div class="form-group">
                                <label for="ques_experience_name">Experience</label>
                                <input type="text" class="form-control" name="ques_experience_name" id="ques_experience_name"
                                  disabled >
                            </div>
                            <div class="form-group">
                                <label for="question">Question</label>
                                <input type="text" class="form-control" name="question" id="question"
                                    placeholder="Question">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="ques_experience_id" id="ques_experience_id" hidden>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="ques_framework_id" id="ques_framework_id" hidden>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="ques_technology_id" id="ques_technology_id" hidden>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" id="add_question" class="btn btn-primary">Add Question</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--Add Answer Modal -->
        <div class="modal fade" id="addAnswerModal" tabindex="-1" aria-labelledby="addAnswerModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addAnswerModalLabel">Add Question</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="addAnswerForm" action="{{ url('admin/answers') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="question">Question</label>
                                <input type="text" class="form-control" name="store_question" id="store_question" disabled>
                            </div>
                            <div class="form-group">
                                <label for="answer">Answer</label>
                                <textarea class="form-control" name="answer" id="answer" rows="4"></textarea>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="store_question_id" id="store_question_id" hidden>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" id="add_question" class="btn btn-primary">Add Answer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--Edit Question Modal -->
        <div class="modal fade" id="editQuestionModal" tabindex="-1" aria-labelledby="editQuestionModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editQuestionModalLabel">Edit Question</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editQuestionForm" action="{{ url('/admin/questions/edit') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="edit_question">Question</label>
                                <input type="text" class="form-control" name="edit_question"
                                    id="edit_question" >
                            </div>
                            <div class="form-group">
                                <label for="edit_answer">Answer</label>
                                <textarea class="form-control" name="edit_answer" id="edit_answer" rows="4"></textarea>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="edit_question_id" id="edit_question_id" hidden>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" id="update_question" class="btn btn-primary">Update
                                    </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="ques_ans_content">
            <div class="first_section">
                <div class="bg-white">
                    <div class="row align-items-center">
                        <div class="page_title">
                            <div>
                                <h5 class="page-title p-3 mt-2"><span><i class="fa-regular fa-circle-left" id="back_btnn"></i></span> Q&A</h5>
                            </div>
                            <div>
                                <button type="button" id="show_Question_Modal" data-bs-toggle="modal" data-bs-target="#addQuestionModal"class="btn btn-success mt-3 mx-5">Add Questions</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="dynamic_question" class="container-fluid">

            </div>
        </div>
    </div>
@endsection
