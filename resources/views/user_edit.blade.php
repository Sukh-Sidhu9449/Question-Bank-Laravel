@extends('newuser-layout.template')
@section('newuser-main-content')
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @elseif (session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    @endif
    <section class="py-5 ">
        <div class="container">
            <div class="form-wrapper w-75 mx-auto  py-3 px-sm-4  px-2 rounded-2 ">
                <div class="p-2 mb-4">
                    @foreach($users as $std)
                    @if($std->image != null)
                    <img class=" img mx-auto d-block rounded-circle" src="{{ $std->image }}" width="150px" height="150px" alt="profile">
                    @else
                    <img class=" img-fluid mx-auto d-block rounded-circle" src="{{ asset('img/dummy-profile-pic.jpg') }}" alt="profile">
                    @endif
                    @endforeach
                </div>
                <form class="row g-3" class="form1" action="{{ url('/user_edit') }}" enctype="multipart/form-data" method="POST" id="userEditForm">
                    @csrf
                    @foreach ($users as $std)
                    <div class="col-md-6">
                        <label for="inputname" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $std->name }}">
                    </div>
                    <div class="col-md-6">
                        <label for="inputemail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $std->email }}" readonly>
                    </div>
                    <div class="col-12">
                        <label for="phone-number" class="form-label">Phone number</label>
                        <input type="number" class="form-control" id="phone-number" name="phone_number" value="{{ $std->phone_number }}" placeholder="Enter your phone number">
                    </div>
                    <div class="col-12">
                        <label for="Gender"> Gender</label>
                        <div class="mb-3 ps-5 d-flex flex-sm-row flex-column">
                            <div class="form-check form-check-inline me-5">
                                <input class="form-check-input" type="radio" name="gender" id="gender"
                                    value="M" {{ $std->gender == 'M' ? 'checked' : '' }}>
                                <label class="form-check-label" for="inlineRadio1">Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="gender"
                                    value="F" {{ $std->gender == 'F' ? 'checked' : '' }}>
                                <label class="form-check-label" for="inlineRadio2">Female</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="address" class="form-label">Address</label>
                        <input type="adddress" class="form-control" id="address" name="address" placeholder="enter address" value="{{ $std->address }}">
                    </div>
                    <div class="col-md-6">
                        <label for="userTechnology" class="form-label">Technology</label>
                        <select id="userTechnology" name="userTechnology[]" class="form-select" >
                            @foreach ($technologies as $technology)
                                <option class="" value="{{ $technology['technology_id']}}">
                                    {{ $technology['technology_name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="company" class="form-label">Company</label>
                        <input type="text" class="form-control" id="last_company" name="last_company" placeholder="Enter Your Company" value="{{ $std->last_company }}">
                    </div>
                    <div class="col-md-6">
                        <label for="designation" class="form-label">Designation</label>
                        <input type="text" class="form-control" id="designation" name="designation" placeholder="Enter yYour Designation" value="{{ $std->designation }}">
                    </div>
                    <div class="col-md-6">
                        <label for="experience" class="form-label">Experience</label>
                        <input type="text" class="form-control" id="experience" name="experience" placeholder="Enter Your Experience(in Yrs)" value="{{ $std->experience  }}">
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Upload Profile Image</label>
                        <input class="form-control pb-4" type="file" id="image" name="image">
                    </div>
                    <div class="d-sm-flex flex justify-content-center align-items-center">
                        
                        <div class="ms-sm-4 my-2 text-center">
                            <button type="submit" class="btn btn-submit text-white px-5" id="submit_id"> Submit</button>
                        </div>
                    </div>
                    @endforeach
                </form>
                {{-- <div class="updatepasswordBtn text-center my-2">
                    <!-- Button trigger modal -->
                    <button class="btn btn-primary text-light" data-bs-toggle="modal"
                        data-bs-target="#staticBackdrop">Update Password
                    </button>
                </div> --}}
            </div>
        </div>
    </section>
    {{-- UPDATE PASSWORD MODAL --}}

    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Update Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('update-password') }}" id="formid" method="POST">
                        @csrf
                        {{-- @method('POST') --}}
                        <div class="card-body">

                            <div class="mb-3">
                                <label for="oldPasswordInput" class="form-label">Old Password</label>
                                <input type="password" name="old_password" class="form-control" id="oldPasswordInput"
                                    placeholder="Old Password">
                                @error('new_password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="newPasswordInput" class="form-label">New Password</label>
                                <input type="password" name="new_password" class="form-control" id="newPasswordInput"
                                    placeholder="New Password">
                                @error('new_password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="confirmNewPasswordInput" class="form-label">Confirm Password</label>
                                <input type="password" name="new_password_confirmation" class="form-control"
                                    id="confirmNewPasswordInput" placeholder="Confirm New Password">
                                @error('new_password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- <form class="form1" action="{{ url('/user_edit') }}" enctype="multipart/form-data" method="POST" id="userEditForm">
        @csrf
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <div class="mb-3">
                        <h2>Update Records</h2>
                        @foreach ($users as $std)
                            <div class="d-flex" style="margin-top: 0px;">
                                <svg style="margin-right:20px;margin-left:50px;margin-top:0px;"
                                    xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                                    class="bi bi-person-fill" viewBox="0 0 16 16">
                                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                                </svg>
                                <input type="text" class="form-control first" id="name" aria-describedby="nameHelp"
                                    placeholder="Name" name="name" value="{{ $std->name }}">
                            </div>
                    </div>
                    <div class="mb-3 d-flex">
                        <svg style="margin-right:-40px;margin-left:50px;margin-top:10px;"xmlns="http://www.w3.org/2000/svg"
                            width="25" height="25" fill="currentColor" class="bi bi-envelope-fill"
                            viewBox="0 0 16 16">
                            <path
                                d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555ZM0 4.697v7.104l5.803-3.558L0 4.697ZM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757Zm3.425-.586L16 11.801V4.697l-5.803 3.546Z" />
                        </svg>
                        <input type="email" class="form-control second" id="email" placeholder="Email" name="email"
                            value="{{ $std->email }}" readonly>
                    </div>
                    <div class="mb-3 d-flex">
                        <svg style="margin-right:-40px;margin-left:50px;margin-top:10px;" xmlns="http://www.w3.org/2000/svg"
                            width="25" height="25" fill="currentColor" class="bi bi-lock-fill" viewBox="0 0 16 16">
                            <path
                                d="M3 2a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V2zm6 11a1 1 0 1 0-2 0 1 1 0 0 0 2 0z" />
                        </svg>
                        <input type="text" class="form-control second" id="phone_number" placeholder="Mobile Number"
                            name="phone_number" value="{{ $std->phone_number }}">
                    </div>
                    <div class="mb-3 d-flex">
                        <svg style="margin-right:-40px;margin-left:50px;margin-top:10px;"xmlns="http://www.w3.org/2000/svg"
                            width="25" height="25" fill="currentColor" class="bi bi-gender-female"
                            viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M8 1a4 4 0 1 0 0 8 4 4 0 0 0 0-8zM3 5a5 5 0 1 1 5.5 4.975V12h2a.5.5 0 0 1 0 1h-2v2.5a.5.5 0 0 1-1 0V13h-2a.5.5 0 0 1 0-1h2V9.975A5 5 0 0 1 3 5z" />
                        </svg>
                        <div class="form-check">
                            <input style="margin-left: 25px;" class="form-check-input" type="radio" name="gender"
                                id="gender" value="M" {{ $std->gender == 'M' ? 'checked' : '' }}>
                            <label class="form-check-label" for="flexRadioDefault1">
                                Male
                            </label>
                        </div>
                        <div class="form-check">
                            <input style="margin-left: 10px;" class="form-check-input" type="radio" name="gender"
                                id="gender" value="F" {{ $std->gender == 'F' ? 'checked' : '' }}>
                            <label class="form-check-label" for="flexRadioDefault1">
                                Female
                            </label>
                        </div>
                    </div>
                    <div class="mb-3 d-flex">
                        <svg style="margin-right:-40px;margin-left:50px;margin-top:10px;" xmlns="http://www.w3.org/2000/svg"
                            width="25" height="25" fill="currentColor" class="bi bi-lock-fill" viewBox="0 0 16 16">
                            <path
                                d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z" />
                        </svg>
                        <input type="text" class="form-control second" id="address" placeholder="Address"
                            name="address" id="address" value="{{ $std->address }}">
                    </div>
                    <div class="mb-3 d-flex">
                        <svg style="margin-right:-40px;margin-left:50px;margin-top:10px; width: 30px" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-laptop" viewBox="0 0 16 16">
                            <path d="M13.5 3a.5.5 0 0 1 .5.5V11H2V3.5a.5.5 0 0 1 .5-.5h11zm-11-1A1.5 1.5 0 0 0 1 3.5V12h14V3.5A1.5 1.5 0 0 0 13.5 2h-11zM0 12.5h16a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 12.5z"/>
                          </svg>
                        <select name="userTechnology[]" id="userTechnology" placeholder="Enter your technologies" class="p-2 mx-2 border-0 selectpicker" multiple data-live-search="true">
                            @foreach ($technologies as $technology)
                                <option class="veer" value="{{ $technology['technology_id']}}">
                                    {{ $technology['technology_name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3 d-flex">
                        <svg style="margin-right:-40px;margin-left:50px;margin-top:10px;"
                            xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                            class="bi bi-lock-fill" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M14.763.075A.5.5 0 0 1 15 .5v15a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5V14h-1v1.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V10a.5.5 0 0 1 .342-.474L6 7.64V4.5a.5.5 0 0 1 .276-.447l8-4a.5.5 0 0 1 .487.022zM6 8.694 1 10.25V15h5V8.694zM7 15h2v-1.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5V15h2V1.309l-7 3.5V15z" />
                            <path
                                d="M2 11h1v1H2v-1zm2 0h1v1H4v-1zm-2 2h1v1H2v-1zm2 0h1v1H4v-1zm4-4h1v1H8V9zm2 0h1v1h-1V9zm-2 2h1v1H8v-1zm2 0h1v1h-1v-1zm2-2h1v1h-1V9zm0 2h1v1h-1v-1zM8 7h1v1H8V7zm2 0h1v1h-1V7zm2 0h1v1h-1V7zM8 5h1v1H8V5zm2 0h1v1h-1V5zm2 0h1v1h-1V5zm0-2h1v1h-1V3z" />
                        </svg>
                        <input type="text" class="form-control second" id="last_company"
                            placeholder="Last Company" name="last_company" value="{{ $std->last_company }}">
                    </div>
                    <div class="mb-3 d-flex">
                        <svg style="margin-right:-40px;margin-left:50px;margin-top:10px;"
                            xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                            class="bi bi-lock-fill" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M14.763.075A.5.5 0 0 1 15 .5v15a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5V14h-1v1.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V10a.5.5 0 0 1 .342-.474L6 7.64V4.5a.5.5 0 0 1 .276-.447l8-4a.5.5 0 0 1 .487.022zM6 8.694 1 10.25V15h5V8.694zM7 15h2v-1.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5V15h2V1.309l-7 3.5V15z" />
                            <path
                                d="M2 11h1v1H2v-1zm2 0h1v1H4v-1zm-2 2h1v1H2v-1zm2 0h1v1H4v-1zm4-4h1v1H8V9zm2 0h1v1h-1V9zm-2 2h1v1H8v-1zm2 0h1v1h-1v-1zm2-2h1v1h-1V9zm0 2h1v1h-1v-1zM8 7h1v1H8V7zm2 0h1v1h-1V7zm2 0h1v1h-1V7zM8 5h1v1H8V5zm2 0h1v1h-1V5zm2 0h1v1h-1V5zm0-2h1v1h-1V3z" />
                        </svg>
                        <input type="text" class="form-control second" id="designation"
                            placeholder="Designation" name="designation" value="{{ $std->designation }}" >
                    </div>
                    <div class="mb-3 d-flex">
                        <svg style="margin-right:-40px;margin-left:50px;margin-top:10px;"
                            xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                            class="bi bi-lock-fill" viewBox="0 0 16 16">
                            <path
                                d="M2.5 0A2.5 2.5 0 0 0 0 2.5v11A2.5 2.5 0 0 0 2.5 16h11a2.5 2.5 0 0 0 2.5-2.5v-11A2.5 2.5 0 0 0 13.5 0h-11Zm4.326 10.88H10.5V12h-5V4.002h5v1.12H6.826V7.4h3.457v1.073H6.826v2.408Z" />
                        </svg>
                        <input type="text" class="form-control second" id="experience" placeholder="Experience"
                            name="experience" value="{{ $std->experience }}">
                    </div>
                    <div class="mb-3 d-flex">
                        <svg style="margin-right:-40px;margin-left:50px;margin-top:10px;"
                            xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                            class="bi bi-image-fill" viewBox="0 0 16 16">
                            <path
                                d="M.002 3a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-12a2 2 0 0 1-2-2V3zm1 9v1a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V9.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12zm5-6.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0z" />
                        </svg>
                        <input type="file" name="image" class="form-control second" id="image"
                            value="{{$std->image}}">
                    </div>


                    <button style="color: white;" type="submit" value="submit" id="submit_id"
                        class="btn btn-info butn">Submit</button>
                </div>

                <div class="col-6" profile>
                    <div class="col-lg-4 col-xlg-3 col-md-12">
                        <div class="profile_box">
                            <div class="overlay-box">
                                <div class="user-content" id="preview_image">
                                    <img src="{{$std->image}}"
                                     class="preview-image" style="width: 250px;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form> --}}
    {{-- @endforeach --}}
@endsection
