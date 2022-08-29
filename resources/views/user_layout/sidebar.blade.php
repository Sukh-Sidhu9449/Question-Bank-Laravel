<!-- logo and search bar field area----------------- -->
<div class="container-fluid ">
    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-4">
                    <img src="{{ asset('user_img/img/logo2.jpg') }}" class="img">
                </div>
                <div class="col-8"></div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-9 COL">
                    <form class="d-flex" role="search">
                        <input class="form-control w-100" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-success" type="submit">Search</button>
                    </form>
                </div>

                <div class="col-md-3 ">
                    <div class="dropdown">
                        <button class=" dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ asset('user_img/img/user.jpg') }}" class="img2"></button>
                        <ul class="dropdown-menu shadow">
                            <li><a class="dropdown-item" href="#"><b>View Profile</b></a></li>
                            <li><a class="dropdown-item" href="#">Edit Profile</a></li>
                            <li><a class="dropdown-item" href="#">Log Out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
<!--------------------- menu bar section--------------------------- -->
<div class="container-fluid p-0 justify-content-center ">

    <nav class="navbar navbar-expand-sm  navbar-dark  justify-content-center">
        <ul class="navbar-nav justify-content-center">
            @foreach ($leftmenu as $items)
                <li class="nav-item ">
                    <a class="nav-link" data-id="{{$items->id}}" href="#">{{ $items->technology_name }}</a>
                </li>
            @endforeach
        </ul>
    </nav>
</div>
