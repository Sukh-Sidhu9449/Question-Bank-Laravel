@extends('user_layout.template')
@section('main-content')

<div class="container-fluid p-0">
    <div class="container-fluid p-4 quiz_question">Test Your MCQ</div>

    <div class="container mt-5">
        <div class="mcqQuesSection">
            <div class="mcqQues">
                <h4>Q1. What is Living Things?</h4>
            </div>
            <div class="mcqAns form-group mt-3">
                <div class="mcqEachAns">
                    <input class="form-group-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                    <label class="form-group-label mx-2" for="flexRadioDefault1">I don't Know.</label>
                </div>
                <div class="mcqEachAns">
                    <input class="form-group-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                    <label class="form-group-label mx-2" for="flexRadioDefault2">How should I Know?</label>
                </div>
                <div class="mcqEachAns">
                    <input class="form-group-input" type="radio" name="flexRadioDefault" id="flexRadioDefault3">
                    <label class="form-group-label mx-2" for="flexRadioDefault3">The Thgings which have life is known as living things.</label>
                </div>
                <div class="mcqEachAns">
                    <input class="form-group-input" type="radio" name="flexRadioDefault" id="flexRadioDefault4">
                    <label class="form-group-label mx-2" for="flexRadioDefault4">I won't tell you.</label>
                </div>
            </div>
        </div>


    </div>
</div>

@endsection
