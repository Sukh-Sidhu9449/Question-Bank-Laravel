@extends('admin_layout.template')
@section('main-content')
    <div class="container-fluid">
        <div class="py-2 px-3 ">

            <div class="admin-main-heading mb-3">
                <h4 class="py-3 mt-2">Dashboard</h4>
            </div>
            <div class="row gy-2 gy-lg-0">
                <div class="col-lg-3 col-sm-6">
                    <div class="p-3   admin-card">
                        <h5 class="">Total Users</h5>
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                           
                                <i class="fa-solid fa-users text-black"></i>
                            </div>
                            <div>
                                <h4 id="users_count">10</h4>
                            </div>
                        </div>
                        <div class="mt-2">
                            <a class="btn text-decoration-none py-1 px-2 " href="{{ url('/admin/users') }}"> More Info.</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="p-3  admin-card">
                        <h5 class="">Technologies</h5>
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <i class="fa-solid fa-book text-black"></i>
                            </div>
                            <div>
                                <h4 id="technologies_count">10</h4>
                            </div>
                        </div>
                        <div class="mt-2">
                            <a class="btn text-decoration-none py-1 px-2 " href="{{ url('/admin/technologies') }}"> More Info.</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="p-3  admin-card">
                        <h5 class="">Frameworks</h5>
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <i class="fa-solid fa-chart-simple text-black"></i>
                            </div>
                            <div>
                                <h4 id="frameworks_count">20</h4>
                            </div>
                        </div>
                        <div class="mt-2">
                            <a class="btn text-decoration-none py-1 px-2 " href="{{ url('/admin/technologies') }}"> More Info.</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="p-3  admin-card">
                        <h5 class=""> Total Q&A</h5>
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <i class="fa-solid fa-chart-simple text-black"></i>
                            </div>
                            <div>
                                <h4 id="questions_count">20</h4>
                            </div>
                        </div>
                        <div class="mt-2">
                            <a class="btn text-decoration-none py-1 px-2 " href="{{ url('/admin/technologies') }}"> More Info.</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

    </div>
@endsection
