@extends('admin_layout.template')
@section('main-content')
    <div class="container-fluid">
        <div class="admin-main-heading  d-flex justify-content-between align-items-center pt-3  ">
            <div class="d-flex justify-content-start align-items-center ">
                <div class="rounded-circle d-inline-block me-2 icon-wrapper d-flex justify-content-center align-items-center back-btn-group-interviews">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i>
                   
                </div>
                <h4 class= "py-2 mt-2 ">Group Interview Statistics</h4>
            </div>
            <div>
                <a href="#" class="btn py-2 px-3 btn-dark-blue " data-bs-toggle="modal" data-bs-target="#addGuestUserChoiceModal" data-bs-dismiss="modal"> Add new</a>
            </div>
        </div>
        <div class="mx-5 px-2 pt-4">
            <div class="">
                <div class=" text-center">
                    <div>
                        <h4>{{ $groupData['blockName'] }}</h4>
                    </div>
                    <div class="d-flex justify-content-between align-items-center py-2">
                        <div>
                            <p>Total Candidates:{{ $groupData['totalCandidates'] }}</p>
                            <p>Pass Candidates:{{ $groupData['passCandidates'] }}</p>
                        </div>
                        <div>
                            <p>Created By:{{ $groupData['createdBy'] }}</p>
                            <p>Assigned By:{{ $groupData['assignedBy'] }}</p>
                        </div>
                    </div>
                    <div>
                        <div class="row gy-3">
                            @foreach ($groupData['groupUsers'] as $user)
                                <div class="col-lg-4 col-sm-6">
                                    <div id="white_box" class="text-start">
                                        <h6 class="">{{ $user->email }}</h6>
                                        <div>
                                            <span class="small">Name : {{ $user->name ? $user->name : 'NA' }}</span>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <span class="small">Interview Status :
                                                    {{ $user->interviewStatus ? $user->interviewStatus : 'Pending' }}</span>
                                                    
                                                <span class="small">Interview Result :
                                                    {{ $user->interviewResult ? $user->interviewResult : 'Pendiing' }}</span>
                                            </div>
                                            <div>
                                                @if ($user->interviewStatus == 'Expired')
                                                    <button id="resendEmailBtn" data-id="{{$groupData['groupInterviewId']}}" data-index="{{$loop->index}}" class="btn btn-dark-blue">Resend</button>
                                                @else
                                                    <button class="btn btn-secondary text-white">Resend</button>
                                                @endif
                                            </div>                                
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addGuestUserChoiceModal" tabindex="-1" aria-labelledby="addGuestUserChoiceModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addGuestUserChoiceModalLabel">Enter User Emails</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                            <div class="formContainer">   
                                <div id="contact-us" class="form">
                                    <div id="addEmailsList" class="mx-2">
                                        <ul></ul>
                                    </div>
                                    <div id="contactForm">
                                        <div>
                                            <p data-error="email" class="errors"></p>
                                        </div>
                                        <div class="text-center">
                                            <span id="email-error" class="text-danger"></span>
                                        </div>
                                        <div class="d-flex justify-content-around align-items-center">
                                            <label class="w-25 mx-2">Email</label>
                                            <input class="px-2 py-1 w-75 rounded border border-secondary" value="" title="Press Enter to add Email" placeholder="Press Enter, Comma(,) or Spacebar to add email" type="text" id="addEmail"/>
                                        </div>
                                        <div class="my-2 text-center">
                                            <button id="addSubmitMultipleUsers" data-id="{{$groupData['groupInterviewId']}}" class="btn btn-dark-blue m-2 ">Submit</button>
                                        </div>
                                    </div>
                                    <p id="addEmailJson"></p>
                                </div>
                            </div>
                    </div>

                </div>
            </div>
        </div>
@endsection
