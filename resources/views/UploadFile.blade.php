@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Upload File To S3') }}</div>

                <div class="card-body">

                    @if ($errors->has('error'))
                        <span class="alert alert-danger invalid-feedback" role="alert" style="display: block;">
                            <strong>{{ $errors->first('error') }}</strong>
                        </span>
                    @endif

                    <form method="POST" enctype="multipart/form-data" action="{{ route('uploadFile') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="access_key" class="col-sm-4 col-form-label text-md-right">{{ __('AWS Access Key') }}</label>

                            <div class="col-md-6">
                                <input id="access_key" type="text" class="form-control{{ $errors->has('access_key') ? ' is-invalid' : '' }}" name="access_key" value="{{ old('access_key') }}" required autofocus>

                                @if ($errors->has('access_key'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('access_key') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="secret_key" class="col-md-4 col-form-label text-md-right">{{ __('AWS Secret Key ') }}</label>

                            <div class="col-md-6">
                                <input id="secret_key" value="{{ old('secret_key') }}" type="text" class="form-control{{ $errors->has('secret_key') ? ' is-invalid' : '' }}" name="secret_key" required>

                                @if ($errors->has('secret_key'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('secret_key') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="bucket" class="col-md-4 col-form-label text-md-right">{{ __('Bucket Name ') }}</label>

                            <div class="col-md-6">
                                <input id="bucket" type="text" value="{{ old('bucket') }}" class="form-control{{ $errors->has('bucket') ? ' is-invalid' : '' }}" name="bucket" required>

                                @if ($errors->has('bucket'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('bucket') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                         <div class="form-group row">
                            <label for="folder" class="col-md-4 col-form-label text-md-right">{{ __('Folder Name ') }}</label>

                            <div class="col-md-6">
                                <input id="folder" type="text" value="{{ old('folder') }}" class="form-control{{ $errors->has('folder') ? ' is-invalid' : '' }}" name="folder" placeholder="Optional" >

                                @if ($errors->has('folder'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('folder') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="region" class="col-md-4 col-form-label text-md-right">{{ __('Region') }}</label>

                            <div class="col-md-6">
                                <input id="region" type="text" value="{{ old('region') }}"  class="form-control{{ $errors->has('region') ? ' is-invalid' : '' }}" name="region" required>

                                @if ($errors->has('region'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('region') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="media" class="col-md-4 col-form-label text-md-right">{{ __('File') }}</label>

                            <div class="col-md-6">
                                <input id="media" type="file" class="form-control{{ $errors->has('media') ? ' is-invalid' : '' }}" name="media" required>

                                @if ($errors->has('media'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('media') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Upload') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if (!empty($url))
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card" style="text-align: center;padding: 20px;">
                   <a target="_blank" href="{{ $url }}">
                        @if($preview)
                            <img width="100%" style="padding: 20px 30px 10px;" src="{{ $url }}">
                        @else
                        {{ $url }}
                        @endif
                    </a>  
                </div>
            </div>
        </div>
    @endif

</div>
@endsection
