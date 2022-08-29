@extends('admin_layout.template')
@section('main-content')
    <div class="Users_Data">
        <!--Add User Modal -->
        <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addUserModalLabel">Add New User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="addUserForm" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="username" class="form-label">User Name</label>
                                <input type="text" class="form-control" id="username" name="username" required >
                                <span class="text-danger error-text name_error"></span>
                            </div>
                            <div class="form-group">
                                <label for="useremail" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="useremail" name="useremail" required>
                                <span class="text-danger error-text email_error"></span>
                            </div>

                            <div class="form-group">
                                <label for="userpassword" class="form-label">Password</label>
                                <input type="password" class="form-control" id="userpassword" name="userpassword" required>
                                <span class="text-danger error-text password_error"></span>
                            </div>
                            <div class="form-group">
                                <label for="userConfirmPassword" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="userConfirmPassword" name="userConfirmPassword" required>
                            </div>
                            <div class="form-group">
                                <label for="userTech" class="form-label">Technologies</label>
                                <select id="userTech" class="form-select" size="3" multiple>
                                    <option selected>Select Your Technologies</option>
                                    @foreach ($technologies as $technology)
                                    <option value="{{$technology->technology_name}}">{{$technology->technology_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="userRole" class="form-label">Role</label>
                                <select id="userRole" class="form-select">
                                    <option value="user" selected>User</option>
                                    <option value="admin">Admin</option>
                                    <option value="editor">Editor</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="userDesignation" class="form-label">Designation</label>
                                <input type="text" class="form-control" id="userDesignation" name="userDesignation">
                            </div>
                            <div class="form-group">
                                <label for="userCurrentCompany" class="form-label">Current Company</label>
                                <input type="text" class="form-control" id="userCurrentCompany" name="userCurrentCompany">
                            </div>
                            <div class="form-group">
                                <label for="userLastCompany" class="form-label">Last Company</label>
                                <input type="text" class="form-control" id="userLastCompany" name="userLastCompany">
                            </div>
                            <div class="form-group">
                                <label for="userExperience" class="form-label">Experience</label>
                                <input type="text" class="form-control" id="userExperience" name="userExperience">
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn_close" data-bs-dismiss="modal">Close</button>
                                <button type="submit" id="add_new_user" class="btn btn_add">Add User</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="first_section">
            <div class="bg-white">
                <div class="row align-items-center">
                    <div class="page_title">
                        <div>
                            <h5 class="page-title p-3 mt-2">Registered Users</h5>
                        </div>
                        <div>
                            <button type="button" id="add_user" class="btn btn-success mt-3 mx-5" data-bs-toggle="modal"
                                data-bs-target="#addUserModal">Add New User</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row justify-content-center">

                <div id="white-box table-responsive">
                    <table class="table bg-white table-hover table-striped table-bordered yajra-datatable py-3">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Technologies</th>
                                <th>Designation</th>
                                <th>Company</th>
                                <th>Experience</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>

            </div>
        </div>


    </div>
    <div>
        <br>
        <br>
    </div>
@endsection
