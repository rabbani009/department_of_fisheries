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
                    <h1 class="font-weight-bold">List of User Type</h1>
                </div>
            </div>
        </div>
   
    </div>

    <div class="body-content">

        <div class="card mb-4">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="fs-17 font-weight-600 mb-0">User Type</h6>
                    </div>
                </div>
            </div>
            <form action="{{route('updateRouteAccess')}}" method="post">
                @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-xs-8 col-sm-8 col-md-6 p-l-30 p-r-30">
                        <input type="hidden" name="id" value="{{$data->id}}">
                        <div class="form-group">
                            <label class="font-weight-600">User Type Name</label>
                            <input type="text" class="form-control" value="{{ $data->enName }}"
                            readonly>
                            @if ($errors->has('phone'))
                                <div class="invalid-feedback">
                                    {{ 'This field is required' }}
                                </div>
                            @endif
                        </div>
                  
                        <div class="form-group">
                            <label class="font-weight-600">Menu list</label>
                           
                            <select class="js-example-basic-multiple" name="routeAccess[]" multiple="multiple">
                           @foreach ($routeList as $item)
                               <option value="{{$item->id}}">{{$item->routeName}}</option>
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
@endsection
