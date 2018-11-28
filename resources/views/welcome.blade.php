@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 ">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#mail_queue">Mail Queue</a></li>
                        <li><a data-toggle="tab" href="#custom">Custom S</a></li>
                        <li><a data-toggle="tab" href="#command">Command</a></li>
                        <li><a data-toggle="tab" href="#dispatch">Dispatch</a></li>
                    </ul>

                    <div class="tab-content">
                        <div id="mail_queue" class="tab-pane fade in active">
                            <h3 class="text-center">Mail with queue</h3>
                            <form action="{{route('mail_queue')}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control" name="email" value="{{ env('MAIL_TO') }}" required autofocus>

                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Send') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div id="custom" class="tab-pane fade">
                            <h3 class="text-center">Custom Solution</h3>
                            <form action="{{route('mail_queue')}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control" name="email" value="{{ env('MAIL_TO') }}" required autofocus>

                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Send') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div id="command" class="tab-pane fade">
                            <h3 class="text-center">Send With Command</h3>
                            <p class="text-center">You can also run the following command from command line to send the email to user:</p>
                            <p class="text-center">php artisan email:send {{ env('MAIL_TO') }}</p>
                            <form action="{{route('mail_command')}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control" name="email" value="{{ env('MAIL_TO') }}" required autofocus>
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Send') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div id="dispatch" class="tab-pane fade">
                            <h3>Menu 2</h3>
                            <p>Some content in menu 2.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection