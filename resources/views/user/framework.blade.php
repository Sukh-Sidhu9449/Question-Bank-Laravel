@extends('newuser-layout.template')
@section('newuser-main-content')

<input type="text" id="frame_id_1" value="" hidden>
<input type="text" id="experiance_id_2" value="" hidden>
    <div class="container-fluid framework_div">
        <div class="single-card  mx-auto d-block text-center py-4 px-3 my-sm-5 my-3 rounded-2">
            {{-- {{$framework}} --}}
            @foreach ($framework as $item)
                <div class="card-wrapper ">
                    <h2>{{ $item->framework_name }}</h2>
                    <div class="para-wrapper my-4 py-2">
                        <p>{{ $item->framework_description }}</p>
                    </div>
                    <a href="#" data-id="{{ $item->id }}"
                        class="rounded-pill btn btn-blue px-4 py-2 text-decoration-none text-white framework-ques-link">LearnMore..</a>
                </div>
            @endforeach
        </div>
    </div>
    <div class="tech_display" id="tech_question_display_1">
        <div class="container-fluid p-3">
            <div>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="back_btn_1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="30" fill="currentColor"
                            class="mb-1 bi bi-arrow-left-circle-fill" viewBox="0 0 16 16" id="icon-back_1">
                            <path
                                d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z" />
                        </svg>
                    </div>
                    <div class="experieance_table">
                        <select class="form-select" id="experience_id_1">
                            <option value="0" selected>All</option>
                            <option value="1">Beginner</option>
                            <option value="2">Intermediate</option>
                            <option value="3">Advanced</option>
                        </select>
                    </div>
                </div>
            </div>


            <div class="question_display " id="question">
                <div class="row justify-content-center p-5" id="ques_1">

                </div>

            </div>
            <div class="page_loader text-center">
                <button class="pageloader_button load-more-btn text-white py-2 px-3" id="pageloader_button_1">Load more...</button>
                <img src="{{ asset('img/pageloader.gif') }}" alt="Show/Hide Image"
                    class="page_loader_image"id="page_loader_image_1" height="80px" width="300px" />
            </div>
        </div>
    </div>
@endsection
