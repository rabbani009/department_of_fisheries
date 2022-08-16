@extends('admin.admin')
@section('content')
    <div style="margin: 20px 0px;">
        @include('flash::message')
    </div>
    <div class="content-header row align-items-center m-0">

        <div class="col-sm-8 header-title p-0">
            <div class="media">

                <div class="media-body">
                    {{-- <button class="btn btn-success md-trigger mb-2 mr-1" data-modal="modal-15">3D Rotate In Left</button> --}}
                    <h1 class="font-weight-bold">Add Fishers</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-4 text-right  p-0">
            <a href="{{ route('getAllFishersInfo') }}" class="btn btn-success mb-2 mr-1">
                <i class="typcn typcn-arrow-back mr-2"></i>Back</a>
        </div>
    </div>

    <div class="body-content">
        <div class="stepwizard">
            <div class="stepwizard-row setup-panel">
                <div class="stepwizard-step col-xs-3">
                    <a href="#step-1" type="button" class="btn btn-success btn-circle">1</a>
                    <p><small>Basic Information (মৌলিক তথ্য)</small></p>
                </div>
                <div class="stepwizard-step col-xs-3">
                    <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
                    <p><small>Basic Information (মৌলিক তথ্য)</small></p>
                </div>
                <div class="stepwizard-step col-xs-3">
                    <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
                    <p><small>Address (ঠিকানা)</small></p>
                </div>
                <div class="stepwizard-step col-xs-3">
                    <a href="#step-4" type="button" class="btn btn-default btn-circle" disabled="disabled">4</a>
                    <p><small>Fishing Information (মাছ ধরার তথ্য)</small></p>
                </div>
            </div>
        </div>
        <form action="{{ route('storeUserAccountInformation') }}" method="post">
            @csrf
            <div class="card mb-4" id="stepOne">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="fs-17 font-weight-600 mb-0 text-edit">Basic Information</h6>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 p-l-30 p-r-30 left-side">

                            <div class="form-group">
                                <label class="font-weight-600">Email</label>
                                <input type="email" class="form-control" name="email" placeholder="Enter Your Email"
                                    value="{{old('email') }}">
                                @if ($errors->has('email'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('email') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 p-l-30 p-r-30">

                            <div class="form-group">
                                <label class="font-weight-600">Password</label>
                                <input type="password" class="form-control" name="password" placeholder="Password"
                                    value="{{ old('password') }}">
                                @if ($errors->has('password'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('password') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="font-weight-600">Confirmed Password</label>
                                <input type="password" class="form-control" name="passwordConfirmation"
                                    placeholder="Password confirmed" value="{{ old('password') }}">
                                @if ($errors->has('passwordConfirmation'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('passwordConfirmation') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-success mr-1" id="stepOneSubmit">Submit and Next</button>
                    {{-- <button type="button" class="btn btn-danger">Cancel</button> --}}
                </div>
            </div>
        </form>
    </div>
    @push('js')
    @endpush
@endsection
