@extends('guest_layout.template')
@section('main-content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card" style="width:100%; height:auto;">
                    <div class="card-header">{{ __('Register') }}</div>
                    {{-- {{dd($frameworks)}} --}}
                    <div class="card-body">
                        <form method="POST" action="{{url('/guest')}}">
                            @csrf
                            <div class="form-group row">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}"  autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}"  autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label for="framework"
                                        class=" col-form-label text-md-right ">{{ __('Select Your Skill Set') }}</label>
                                </div>
                                <div class="col-md-8 ">
                                    <div class="row @error('framework') is-invalid @enderror">
                                        @foreach ($frameworks as $framework)
                                            <div class="col-md-1">
                                                <input type="checkbox" name="framework[]" value="{{ $framework->id }}">
                                            </div>
                                            <div class="col-md-3">
                                                <label>{{ $framework->framework_name }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                    @error('framework')
                                        <span class="invalid-feedback m-2" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mt-4">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
