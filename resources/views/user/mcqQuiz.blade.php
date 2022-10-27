@extends('user_layout.template')
@section('main-content')
    <div class="container-fluid p-0">
        <div class="container-fluid p-4 quiz_question">Test Your MCQ</div>
        <div id="gettingMcqTimer" class=""></div>

        <div class="container mt-5">
            <div class="mcqQuesSection">
                <form  action="" method="post">
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
                                <input class="form-group-input answerRadio" type="radio" name="answerRadio{{$q}}"
                                    id="answerRadio{{$q}}{{$loop->iteration}}">
                                <label class="form-group-label mx-2 mcqlabel" for="answerRadio{{$q}}{{$loop->iteration}}">{{ $mcqAnswer->mcq_answers }}</label>
                            </div>
                        @endforeach
                        <input type="hidden" name="correctAnswer" id="correctAnswer" value="{{ $mcq['correctAnswer'] }}">
                        <button class="btn btn-primary mt-2 mb-5 mcq_insert" hidden>Insert</button>

                        {{-- <button class="btn btn-primary mt-2 mb-5 mcq_edit">Edit</button> --}}
                    </div>
                    @endforeach
                    <input type="hidden" name="totalMcqQuestions" id="totalMcqQuestions" value="{{$q}}">
                </form>
                <button class="btn btn-primary mt-2 mb-5" id="mcq_submit">Submit Quiz</button>
            </div>
        </div>
    </div>
@endsection
