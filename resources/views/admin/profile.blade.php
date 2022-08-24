@extends('admin_layout.template')
@section('main-content')


<div class="first_section">
     <div class="bg-white">
         <div class="row align-items-center">
             <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                 <h5 class="page-title p-3 mt-2">Profile</h5>
             </div>
         </div>
     </div>
 </div>
 <div class="container-fluid">
     <div class="row">
         <div class="col-lg-4 col-xlg-3 col-md-12">
             <div class="profile_box">
                 <div class="overlay-box">
                     <div class="user-content">

                         <img src="{{ asset('img/user.jpg') }}" class="user_profile" alt="img">
                             <!-- <input type="file" name="pic" hidden> -->
                         <h4 class="user_name mt-4"></h4>
                         <h5 class="user_mail"></h5>

                     </div>
                 </div>
             </div>
         </div>
         <div class="col-lg-8 col-xlg-9 col-md-12">
             <div class="card" id="white_box">
                 <div class="card-body">
                     <form class="form-horizontal form-material" action="" method="post">
                         @csrf
                         @method('put')

                         <input id="id" name="id" type="hidden" value="">
                         <div for="name" class="form-group mb-4">
                             <label class="col-md-12 p-0">Name</label>
                             <div class="col-md-12 border-bottom p-0">
                                 <input type="text" class="form-control p-2 border-0 mt-3" name="name" id="name" value="">
                             </div>
                         </div>
                         <div class="form-group mb-4">
                             <label for="email" class="col-md-12 p-0">Email</label>
                             <div class="col-md-12 border-bottom p-0">
                                 <input type="email" class="form-control p-2 border-0 mt-3" name="email" id="email" value="">
                             </div>
                         </div>
                         <div class="form-group mb-4">
                             <label class="col-md-12 p-0">Gender</label>
                             <div class="col-md-12  p-3 d-flex">
                                 <input type="radio" value="M" class="form-check-input p-2 mt-3" name="gender" id="gender">
                                 <label class="form-check-label radio_title" for="flexRadioDefault1">
                                     Male
                                 </label>
                                 <input type="radio" value="F" class="form-check-input p-2 mt-3 " name="gender" id="gender">
                                 <label class="form-check-label radio_title" for="flexRadioDefault1">
                                     Female
                                 </label>
                                 <input type="radio" value="O" class="form-check-input p-2 mt-3 " name="gender" id="gender">
                                 <label class="form-check-label radio_title" for="flexRadioDefault1">
                                     Others
                                 </label>
                             </div>
                         </div>
                         <div class="form-group my-3">
                             <div class="col-sm-12">
                                 <button class="btn btn-success mt-3" name="updateAdmin" id="updateAdmin">Update Profile</button>
                             </div>
                         </div>

                     </form>
                 </div>
             </div>
         </div>
     </div>
 </div>
</div>


@endsection
