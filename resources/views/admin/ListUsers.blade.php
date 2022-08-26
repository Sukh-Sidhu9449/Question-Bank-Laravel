@extends('admin_layout.template')
@section('main-content')
    <div class="Users_Data">

        <div class="first_section">
            <div class="bg-white">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h5 class="page-title p-3 mt-2">Users List</h5>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row justify-content-center">

                <div  id="white-box table-responsive">
                    <table class="table bg-white table-hover table-striped table-bordered yajra-datatable py-3">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Gender</th>
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
