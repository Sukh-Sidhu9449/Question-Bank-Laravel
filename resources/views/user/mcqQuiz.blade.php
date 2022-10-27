@extends('user_layout.template')
@section('main-content')
    <div class="container-fluid p-0">
        <div class="container-fluid p-4 quiz_question">Test Your MCQ</div>
        <div id="gettingMcqTimer" class=""></div>

        <div class="container mt-5">
            <div class="mcqQuesSection">
                @csrf
                @foreach ($quizQuestionData as $key => $mcq)
                    <input type="hidden" id="mcqStartTime" value="{{ $mcq['startedAt'] }}">
                    <input type="hidden" id="mcqTimer" value="{{ $mcq['timer'] }}">
                    <input type="hidden" id="mcqQuizId" value="{{ $mcq['quizId'] }}">
                    <input type="hidden" id="mcqBlockId" value="{{ $mcq['blockId'] }}">
                    <input type="hidden" id="mcqBlockQuestionIid" value="{{ $mcq['blockQuestionIid'] }}">

                    <div class="mcqQues">
                        <h4>Q{{ $key + 1 }}. {{ $mcq['question'] }}</h4>
                    </div>
                    @php
                        $q = 1 + $key;
                    @endphp

                    <div class="mcqAns form-group mt-3">
                        @foreach ($mcq['answer'] as $mcqAnswer)
                            <div class="mcqEachAns">
                                <input class="form-group-input" type="radio" name="answerRadio{{$q}}"
                                    id="answerRadio{{$q}}{{$loop->iteration}}">
                                <label class="form-group-label mx-2"
                                    for="answerRadio{{$q}}{{$loop->iteration}}">{{ $mcqAnswer->mcq_answers }}</label>
                            </div>
                        @endforeach
                        <input type="hidden" id="correctAnswer" value="{{ $mcq['correctAnswer'] }}">
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
