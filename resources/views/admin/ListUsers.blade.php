@extends('admin_layout.template')
@section('main-content')
    <div class="Users_Data px-4 py-2">

        <div class="first_section">
            <div class="bg-white">
                <div class="row align-items-center">
                    <div class="page_title d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="page-title p-3 mt-2">Registered Users</h5>
                        </div>
                        <div>
                            <button type="button" id="add_user" class="btn btn-dark-blue rounded ">Add New User</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="user_datatable">
            <div class="container-fluid">
                <div class="row justify-content-center">

                    <div id="white-box  table-responsive" class="user-datatable-outer">
                        <table id="yajra-datatable" class="table table-light ">
                            <thead>
                                <tr>
                                    <th>S.N</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Designation</th>
                                    <th>Last Company</th>
                                    <th>Experience</th>
                                    <th>Technology Name</th>
                                </tr>
                            </thead>
                            <tbody>


                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
        <div id="new_user_registration">
            <div class="container-fluid">
                <div class="row">
                        <div class="card user-information-outer" id="white_box">
                            <header >
                                <div class="form_header mb-4 p-4 ">
                                    <h4 class="text-white">Users Information</h4>
                                </div>
                            </header>
                            <div class="card-body">

                                <form id="addUserForm" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row d-flex justify-content-around">
                                        <div for="username" class="form-group my-3 col">
                                            <label class="col-md-6 p-0">Name</label>
                                            <div class="col-md-12 border-bottom p-0">
                                                <input type="text" class="form-control p-2 border-0 mt-3" name="username"
                                                    id="username" value="" required>
                                                <span class="text-danger error-text name_error"></span>
                                            </div>
                                        </div>
                                        <div class="form-group my-3 col">
                                            <label for="useremail" class="col-md-6 p-0">Email</label>
                                            <div class="col-md-12 border-bottom p-0">
                                                <input type="email" class="form-control p-2 border-0 mt-3" name="c"
                                                    id="useremail" value="">
                                                <span class="text-danger error-text email_error"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group my-3 col">
                                            <label for="userRole" class=" col-md-12 p-0">Role</label>
                                            <select id="userRole" class="form-select p-2 border-0 mt-3">
                                                <option value="user" selected>User</option>
                                                <option value="admin">Admin</option>
                                                <option value="editor">Editor</option>
                                            </select>
                                        </div>
                                        <div class="form-group my-3 col ">
                                            <label for="userTech" class="form-label col-md-12 p-0">Technologies</label>
                                            <select id="userTech" class="form-control p-2 border-0 selectpicker" multiple data-live-search="true">
                                                @foreach ($technologies as $technology)
                                                    <option value="{{ $technology->id}}">
                                                        {{ $technology->technology_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="form-group my-3 col">
                                            <label for="userExperience" class="col-md-12 p-0">Experience</label>
                                            <div class="col-md-12 border-bottom p-0">
                                                <input type="text" class="form-control p-2 border-0 mt-3"
                                                    name="userExperience" id="userExperience" value="">
                                            </div>
                                        </div>
                                        <div class="form-group my-3 col">
                                            <label for="userLastCompany" class="col-md-12 p-0">Last Company</label>
                                            <div class="col-md-12 border-bottom p-0">
                                                <input type="text" class="form-control p-2 border-0 mt-3"
                                                    name="userLastCompany" id="userLastCompany" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group my-3 col">
                                            <label for="userDesignation" class="col-md-12 p-0">Designation</label>
                                            <div class="col-md-12 border-bottom p-0">
                                                <input type="text" class="form-control p-2 border-0 mt-3"
                                                    name="userDesignation" id="userDesignation" value="">
                                            </div>
                                        </div>
                                        <div class="form-group my-3 col">
                                            <label for="useraddress" class="col-md-12 p-0">Address</label>
                                            <div class="col-md-12 border-bottom p-0">
                                                <input type="text" class="form-control p-2 border-0 mt-3"
                                                    name="useraddress" id="useraddress" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group my-3 col">
                                            <label for="userpassword" class="col-md-12 p-0">Password</label>
                                            <div class="col-md-12 border-bottom p-0">
                                                <input type="password" class="form-control p-2 border-0 mt-3"
                                                    name="userpassword" id="userpassword" value="">
                                                <span class="text-danger error-text password_error"></span>
                                            </div>
                                        </div>
                                        <div class="form-group my-3 col">
                                            <label for="userConfirmPassword" class="col-md-12 p-0">Confirm
                                                Password</label>
                                            <div class="col-md-12 border-bottom p-0">
                                                <input type="password" class="form-control p-2 border-0 mt-3"
                                                    name="userConfirmPassword" id="userConfirmPassword" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group my-3">
                                        <div class="col-sm-12">
                                            <button type="submit" class="btn btn-dark-blue mt-3" name="add_user"
                                                id="add_user">Add User</button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>

                </div>
            </div>
        </div>

    </div>
    <div>
        <br>
        <br>
    </div>
@endsection
