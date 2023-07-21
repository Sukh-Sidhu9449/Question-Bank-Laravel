@extends('admin_layout.template')
@section('main-content')
    <input type="text" name="store_block_id" id="store_block_id" hidden>
    <div id="show_blocks" class="p-4">
        <div class="first_section">
            <div class="bg-white">
                <div class="row align-items-center">
                    <div class="page_title">
                        <div>
                            <h5 class="page-title p-3 mt-2">Quiz</h5>

                        </div>
                        <div class="d-flex">
                            <div>
                                <a href="{{ url('/viewBlocksRestore') }}" class="btn btn-xs btn-outline-danger pull-right "
                                    style="margin-top:25%; margin-left:-25%;  "><i
                                        class="fa-solid fa-trash pe-2"></i>Trash</a>
                            </div>
                            <div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="block_data" class="container-fluid">
            <div class="first_section">
                <div class="bg-white">
                    <table id="indexblocks" class="table table-hover">
                        <thead class="">
                            <th>S.N.</th>
                            <th>Quiz Blocks</th>
                            <th>Type</th>
                            <th>Number of Questions</th>
                            <th>Action</th>
                        </thead>
                        <tbody>

                        </tbody>
                        <tfoot>
                        </tfoot>
                    </table>

                </div>
            </div>
        </div>

        {{-- <div class="page_loader">
            <button class="pageloader_button" id="pageloader_quiz_button">Load more...</button>
            <img src="{{ asset('img/pageloader.gif') }}" alt="Show/Hide Image"
                class="page_loader_image"id="quiz_page_loader_image" height="80px" width="300px" />
        </div> --}}
    </div>
    <div id="show_block_data" class="p-4">
        <div class="first_section">
            <div class="bg-white">
                <div class="row align-items-center">
                    <div class="page_title">
                        <div>
                            <h5 class="page-title p-3 mt-2">Block Detail</h5>
                        </div>
                        <div class="d-flex">
                            <div>
                                <select id="block_data_limit" class="form-select mt-3 mx-4 w-75 dropdown_pagination">
                                    <option value="10" selected>10</option>
                                    <option value="20">20</option>
                                    <option value="30">30</option>
                                    <option value="40">40</option>
                                </select>
                            </div>
                            <div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="block_questions">
            <div class="first_section">
                <div class="bg-white">
                    <table id="block_table" class="table table-hover">
                        <thead class="">
                            <th>S.N.</th>
                            <th>Block Questions</th>
                        </thead>
                        <tbody>

                        </tbody>
                        <tfoot>

                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal fade" id="userChoiceModal" tabindex="-1" aria-labelledby="userChoiceModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="userChoiceModalLabel">Choose User</h5>
                        {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                    </div>
                    <div class="modal-body text-center">
                        <button id="assign_users_btn" class="btn btn-dark-blue m-2" data-bs-dismiss="modal">Register Users</button>
                        <button data-bs-toggle="modal" class="btn btn-dark-blue m-2" data-bs-target="#guestUserChoiceModal" data-bs-dismiss="modal">Guest Users</button>
                    </div>

                </div>
            </div>
        </div>
        <div class="modal fade" id="guestUserChoiceModal" tabindex="-1" aria-labelledby="guestUserChoiceModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="guestUserChoiceModalLabel">Enter User Emails</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                            <div class="formContainer">   
                                <div id="contact-us" class="form">
                                    <div id="emailsList" class="mx-2">
                                        <ul></ul>
                                    </div>
                                    <div id="contactForm">
                                        <div>
                                            <p data-error="email" class="errors"></p>
                                        </div>
                                        <div class="text-center">
                                            <span id="group-email-error" class="text-danger"></span>
                                        </div>
                                        <div class="d-flex justify-content-around align-items-center">
                                            <label class="w-25 mx-2">Email</label>
                                            <input class="px-2 py-1 w-75 rounded border border-secondary" value="" placeholder="Press Enter, Comma(,) or Spacebar to add email" type="text"
                                                id="email"/>
                                        </div>
                                        <div class="my-2 text-center">
                                            <button id="submitMultipleUsers" class="btn btn-dark-blue m-2 ">Submit</button>
                                        </div>
                                    </div>
                                    <p id="emailJson"></p>
                                </div>
                            </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="page_loader">
            <button class="pageloader_button" id="pageloader_show_block_button">Load more...</button>
            <img src="{{ asset('img/pageloader.gif') }}" alt="Show/Hide Image"
                class="page_loader_image"id="show_block_loader_image" height="80px" width="300px" />
        </div>
    </div>
    <div id="load_users_list" class="p-4">

        <div class="users_content">
            <div class="first_section">
                <div class="bg-white">
                    <div class="row align-items-center">
                        <div class="page_title">
                            <div>
                                <h5 class="page-title p-3 mt-2">Users</h5>
                            </div>
                            <div class="d-flex">
                                <div>
                                    <select id="users_list_limit" class="form-select mt-3 mx-4 w-75 dropdown_pagination">
                                        <option value="10" selected>10</option>
                                        <option value="20">20</option>
                                        <option value="30">30</option>
                                        <option value="40">40</option>
                                    </select>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="spinner-grow" role="status">
                <span class="sr-only">Loading...</span>
            </div> --}}
            <div id="dynamic_users_detail" class="container-fluid">
                <div class="first_section">
                    <div class="bg-white">
                        <table id="users_detail_table" class="table table-hover">
                            <thead class="table-dark">
                                <th>#</th>
                                <th>S.N.</th>
                                <th>User Name</th>
                                <th>Email</th>
                                <th>Status</th>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <div class="page_loader">
                <button class="pageloader_button" id="pageloader_users_button">Load more...</button>
                <img src="{{ asset('img/pageloader.gif') }}" alt="Show/Hide Image"
                    class="page_loader_image"id="users_page_loader_image" height="80px" width="300px" />
            </div>

        </div>
    </div>
    <br>
    <br>
@endsection
