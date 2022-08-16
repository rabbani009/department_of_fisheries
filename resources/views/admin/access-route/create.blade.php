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
                    <h1 class="font-weight-bold">Set User Access</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-4 text-right  p-0">
            <a href="{{ route('accessRoute') }}" class="btn btn-success mb-2 mr-1">
                <i class="typcn typcn-arrow-back mr-2"></i>Back</a>
        </div>
    </div>

    <div class="body-content">
        <div class="row  justify-content-center">
            <div class="col-md-8">
                <div class="card mb-4">

                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="fs-17 font-weight-600 mb-0">Set User Access</h6>
                            </div>
                        </div>
                    </div>
                    <form action="{{ route('storeRouteAccess') }}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 p-l-30 p-r-30">
                                    <input type="hidden" name="id" value="{{ $data->id }}">
                                    <div class="form-group">
                                        <label class="font-weight-600">User Type</label>
                                        <input type="text" class="form-control"
                                            value="{{ $data->enName }} ({{ $data->bnName }})" readonly>
                                        @if ($errors->has('phone'))
                                            <div class="invalid-feedback">
                                                {{ 'This field is required' }}
                                            </div>
                                        @endif
                                    </div>
                                    @php
                                    $routeAccessData = explode(',', $data->routeAccess ?? '');
                                @endphp
                                    <div class="form-group">
                                        <label class="font-weight-600">Select Access Menu list</label>
                                        <select class="form-control js-example-basic-multiple" name="routeAccess[]"
                                            multiple="multiple">
                                            @foreach ($routeList as $item)
                                                <option value="{{ $item->id }}" {{ in_array($item->id, $routeAccessData) ? 'selected' : '' }}>{{ $item->routeName }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-success mr-1">Submit</button>
                            <button type="button" class="btn btn-danger">Cancel</button>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
@endsection
