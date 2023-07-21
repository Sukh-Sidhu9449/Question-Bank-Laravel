@extends('admin_layout.template')
@section('main-content')
    <div class="container-fluid">
        <div class="py-2 px-3 ">

            <div class="admin-main-heading mb-3">
                <h4 class="py-3 mt-2">Group Interview Statistics</h4>
            </div>
        </div>
        {{-- <div class="py-2 px-3">
            <div class="accordion" id="accordionExample">
                @foreach ($groupData as $item)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading{{ $item['blockId'] }}">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse{{ $item['blockId'] }}" aria-expanded="false"
                                aria-controls="collapse{{ $item['blockId'] }}">
                                {{$loop->iteration}}.  {{ $item['blockName'] }}
                            </button>
                        </h2>
                        <div id="collapse{{ $item['blockId'] }}" class="accordion-collapse collapse"
                            aria-labelledby="heading{{ $item['blockId'] }}" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div class="d-flex justify-content-between align-items-center my-2">
                                    <div>
                                        <h3>List users</h3>
                                    </div>
                                    <div>
                                        <button class="btn btn-dark-blue">Add New</button>
                                    </div>
                                </div>
                                <table class="table w-100">
                                    <thead class="bg-secondary text-white">
                                        <th>S.No</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Interview Status</th>
                                        <th>Interview Result</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($item['groupUsers'] as $user)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{ $user->name?$user->name:"NA" }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->interviewStatus?$user->interviewStatus:"Pending" }}</td>
                                                <td>{{ $user->interviewResult?$user->interviewResult:"Pendiing" }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div> --}}
        <div class="row gy-3 p-2">
            @foreach ($groupData as $item)
                <div class="col-lg-4 col-sm-6 mx-2">
                    <div class=" admin-card p-3 ">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="fw-bold">{{ $item['blockName'] }}</h5>
                            <a class="btn  text-decoration-none px-2 py-1 h-100 d-flex justify-content-center align-items-center "
                                href="{{ url('/admin/group-interview-stats') }}{{ '/' }}{{ $item['groupInterviewId'] }}">View
                                Details</a>
                        </div>
                        <div class="d-flex justify-content-between align-items-end">
                            <div>
                                <div>
                                    <span class="small"> Total Questions: {{ $item['questionCount'] }}</span>
                                    {{-- <i class="fa-solid fa-users text-black"></i> --}}
                                </div>
                                <div>
                                    <span class="small"> Total Candidates: {{ $item['totalCandidates'] }}</span>
                                </div>
                                <div>
                                    <span class="small"> Pass Candidates: {{ $item['passCandidates'] }}</span>
                                </div>
                            </div>
                            <div>
                                <div class="text-end">
                                    <span style="font-size: 12px">  <p class="mb-0">Assigned By:</p> {{ $item['assignedBy'] }}</span>
                                </div>
                            </div>
                        </div>

                        {{-- <div class="col-lg-4 col-sm-12 d-flex justify-content-end">
                        <button class="view-btn-hide">
                            <a class="btn text-decoration-none p-2 h-100 d-flex justify-content-center align-items-center " href="{{ url('/admin/group-interview-stats') }}{{'/'}}{{ $item['groupInterviewId'] }}">View Details</a>
                        </button>
                        </div> --}}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
