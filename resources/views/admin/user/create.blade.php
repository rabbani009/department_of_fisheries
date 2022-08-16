@extends('admin.admin')
@section('content')
    <div style="margin: 20px 0px;">
        @include('flash::message')
    </div>
    {{-- @if ($errors->has('email'))
    <div class="alert alert-danger" role="alert">
        {{ $errors->first('email') }}
      </div> --}}
    {{-- <div class="invalid-feedback">
        {{ $errors->first('email') }}
    </div> --}}
    {{-- @endif --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <p><strong>Opps Something went wrong</strong></p>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="content-header row align-items-center m-0">

        <div class="col-sm-8 header-title p-0">
            <div class="media">

                <div class="media-body">
                    {{-- <button class="btn btn-success md-trigger mb-2 mr-1" data-modal="modal-15">3D Rotate In Left</button> --}}
                    <h1 class="font-weight-bold">Create User</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-4 text-right  p-0">
            <a href="{{ route('userList') }}" class="btn btn-success mb-2 mr-1">
                <i class="typcn typcn-arrow-back mr-2"></i>Back</a>
        </div>
    </div>

    <div class="body-content">
        <form action="{{ route('storeUser') }}" method="post">
            @csrf
            {{-- <input type="hidden" name="id" value="{{ $data->id }}"> --}}
            <div class="card mb-4">
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
                                <label class="font-weight-600">Name</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}"
                                    placeholder="Enter Your Name">
                                @if ($errors->has('name'))
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="font-weight-600">Phone No</label>
                                <input type="number" class="form-control" name="phone" value="{{ old('phone') }}"
                                    placeholder="Enter Phone No">
                                @if ($errors->has('phone'))
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1" class="font-weight-600">User Role</label>
                                <select class="form-control" name="userTypeId">

                                    <option value="">Select</option>
                                    @foreach ($userTypeData as $key => $userType)
                                        @if (old('userTypeId') == $userType->id)
                                            <option value="{{ $userType->id }}" selected>{{ $userType->enName }}
                                            </option>
                                        @else
                                            <option value="{{ $userType->id }}">{{ $userType->enName }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @if ($errors->has('userTypeId'))
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1" class="font-weight-600">Designation</label>
                                <select class="form-control" name="designationId">

                                    <option value="">Select</option>
                                    @foreach ($designationData as $key => $designation)
                                        @if (old('designationId') == $designation->id)
                                            <option value="{{ $designation->id }}" selected>{{ $designation->enName }}
                                                ({{ $designation->bnName }})
                                            </option>
                                        @else
                                            <option value="{{ $designation->id }}">{{ $designation->enName }}
                                                ({{ $designation->bnName }})</option>
                                        @endif
                                    @endforeach
                                </select>
                                @if ($errors->has('designationId'))
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1" class="font-weight-600">Department</label>
                                <select class="form-control" name="departmentId">

                                    <option value="">Select</option>
                                    @foreach ($departmentData as $key => $department)
                                        @if (old('departmentId') == $department->id)
                                            <option value="{{ $department->id }}" selected>{{ $department->enName }}
                                                ({{ $department->bnName }})
                                            </option>
                                        @else
                                            <option value="{{ $department->id }}">{{ $department->enName }}
                                                ({{ $department->bnName }})</option>
                                        @endif
                                    @endforeach
                                </select>
                                @if ($errors->has('departmentId'))
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @endif
                            </div>
                    

                            <div class="form-group">
                                <label class="font-weight-600 mr-3">Gender</label> <br>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="customRadioInline1" name="gender" class="custom-control-input"
                                        value="Male" @if (old('gender') == 'Male') checked @endif>
                                    <label class="custom-control-label" for="customRadioInline1">Male</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="customRadioInline2" name="gender" class="custom-control-input"
                                        value="Female" @if (old('gender') == 'Female') checked @endif>
                                    <label class="custom-control-label" for="customRadioInline2">Female</label>
                                </div>
                                @if ($errors->has('gender'))
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 p-l-30 p-r-30">


                            <div class="form-group">
                                <label for="exampleFormControlSelect1" class="font-weight-600">Division</label>
                                <select class="form-control" name="divisionId" id="divisionId">
                                    <option value="">Select Division </option>
                                    {{-- <option value="{{ $data->id }}" {{ Request::old()?(Request::old('appointment_branch')==$data->id?'selected="selected"':''):'' }}>{{ $data->name }}</option> --}}
                                    @foreach ($divisions as $divisionList)
                                        {{-- @if (old('divisionId') == $divisionList->divisionId) --}}
                                        <option value="{{ $divisionList->divisionId }}">
                                            {{ $divisionList->divisionEng }}
                                            ({{ $divisionList->divisionBng }})
                                        </option>
                                        {{-- @else
                                            <option value="{{ $divisionList->divisionId }}">{{ $divisionList->divisionEng }}
                                                ({{ $divisionList->divisionBng }})
                                            </option>
                                        @endif --}}
                                    @endforeach
                                </select>
                                @if ($errors->has('divisionId'))
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlSelect1" class="font-weight-600">District</label>
                                <select class="form-control" name="districtId" id="districtId">

                                </select>
                                @if ($errors->has('districtId'))
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1" class="font-weight-600">Upazila</label>
                                <select class="form-control" name="upazilaId" id="upazilaId">

                                </select>
                                @if ($errors->has('upazilaId'))
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="font-weight-600">Address</label>
                                <textarea name="address" class="form-control" id="" cols="30" rows="10"></textarea>

                                @if ($errors->has('address'))
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="fs-17 font-weight-600 mb-0 text-edit">Account Information</h6>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 p-l-30 p-r-30 left-side">

                            <div class="form-group">
                                <label class="font-weight-600">Email</label>
                                <input type="email" class="form-control" name="email" placeholder="Enter Your Email"
                                    value="{{ old('email') }}">
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
                                        {{ 'This field is required' }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="font-weight-600">Confirmed Password</label>
                                <input type="password" class="form-control" name="password"
                                    placeholder="Password confirmed" value="{{ old('password') }}">
                                {{-- @if ($errors->has('password'))
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @endif --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-success mr-1">Submit</button>
                    <button type="button" class="btn btn-danger">Cancel</button>
                </div>
            </div>
        </form>
    </div>
    @push('js')
        <script>
            // $(document).ready(function() {
            //     var OldValue = '{{ old('divisionId') }}';
            //     if (OldValue !== '') {
            //         $('#divisionId').val(OldValue);

            //         // this will load subcategories once you set the category value
            //         $('#divisionId').on('change', function() {
            //         alert('ojdei');

            //         // var divisionId = $(this).val();
            //         $('#districtId').val('');
            //         $('#upazilaId').val('');
            //         $('#areaId').val('');
            //         let value = $(this).children("option:selected").val();

            //         $.get('{{ url('/') }}/get-district-list/' + value, function(response) {

            //             $('#districtId').html(response);

            //             // console.log("ok");
            //             // console.log(response);
            //         })


            //     });
            //     }
            // });
            $(document).ready(function() {
                $('#divisionId').on('change', function() {
                    // alert('ojdei');

                    // var divisionId = $(this).val();
                    $('#districtId').val('');
                    $('#upazilaId').val('');
                    $('#areaId').val('');
                    let value = $(this).children("option:selected").val();

                    $.get('{{ url('/') }}/get-district-list/' + value, function(response) {

                        $('#districtId').html(response);

                        // console.log("ok");
                        // console.log(response);
                    })


                });
                $('#districtId').on('change', function() {
                    var districtId = $(this).val();
                    $('#upazilaId').val('');
                    $('#areaId').val('');
                    let value = $(this).children("option:selected").val();

                    $.get('{{ url('/') }}/get-upazila-list/' + value, function(response) {

                        $('#upazilaId').html(response);
                        $('#areaId').html();
                        // console.log("ok");
                        // console.log(response);
                    })


                });
                $('#upazilaId').on('change', function() {
                    $('#areaId').val('');
                    let value = $(this).children("option:selected").val();

                    $.get('{{ url('/') }}/get-area-list/' + value, function(response) {

                        $('#areaId').html(response);
                        // console.log("ok");
                        // console.log(response);
                    })


                });
            });
        </script>
    @endpush
@endsection
