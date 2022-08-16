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
                    <h1 class="font-weight-bold">Update User Data</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-4 text-right  p-0">
            <a href="{{ route('userList') }}" class="btn btn-success mb-2 mr-1">
                <i class="typcn typcn-arrow-back mr-2"></i>Back</a>
        </div>
    </div>

    <div class="body-content">
        <form id="update-form" action="{{ route('updateUser') }}" method="post">
            @csrf
            <input type="hidden" name="id" value="{{ $item['userData']->id }}">
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
                                <input type="text" class="form-control" name="name"
                                    value="{{ $item['userData']->name ?? '' }}" placeholder="Enter Your Name" required>
                                @if ($errors->has('name'))
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="font-weight-600">Phone No</label>
                                <input type="text" onkeypress="return /\d/.test(String.fromCharCode(((event||window.event).which||(event||window.event).which)));" class="form-control" name="phone" value="{{ $item['userData']->phone ?? '' }}"
                                placeholder="Enter Phone No" maxlength="11" required>
                                @if ($errors->has('phone'))
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1" class="font-weight-600">User Role</label>
                                <select class="form-control" name="userTypeId" required>
                                    <option value="{{ $item['userData']->get_user_type->id ?? '' }}">
                                        {{ $item['userData']->get_user_type->enName ?? '' }}</option>
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
                                <select class="form-control" name="designationId" required>
                                    <option value="{{ $item['userData']->get_user_designation->id ?? '' }}">
                                        {{ $item['userData']->get_user_designation->enName ?? '' }}
                                        ({{ $item['userData']->get_user_designation->bnName ?? '' }})</option>
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
                                <select class="form-control" name="departmentId" required>
                                    <option value="{{ $item['userData']->get_user_department->id ?? '' }}">
                                        {{ $item['userData']->get_user_department->enName ?? '' }}
                                        ({{ $item['userData']->get_user_department->bnName ?? '' }})</option>
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
                                        value="Male" @if ($item['userData']->gender == 'Male') checked @endif  required>
                                    <label class="custom-control-label" for="customRadioInline1">Male</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="customRadioInline2" name="gender" class="custom-control-input"
                                        value="Female" @if ($item['userData']->gender == 'Female') checked @endif>
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
                                <select class="form-control" name="divisionId" id="divisionId" required>
                                    <option value="{{ $item['userData']->get_user_division->divisionId ?? '' }}">
                                        {{ $item['userData']->get_user_division->divisionEng ?? '' }}
                                        ({{ $item['userData']->get_user_division->divisionBng ?? '' }})</option>
                                    @foreach ($divisions as $divisionList)
                                        {{-- @if (old('divisionId') == $divisionList->id)
                                            <option value="{{ $divisionList->id }}" selected>
                                                {{ $divisionList->divisionEng }}
                                                ({{ $divisionList->divisionBng }})
                                            </option>
                                        @else --}}
                                        <option value="{{ $divisionList->divisionId ?? '' }}">
                                            {{ $divisionList->divisionEng }}
                                            ({{ $divisionList->divisionBng }})
                                        </option>
                                        {{-- @endif --}}
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
                                <select class="form-control" name="districtId" id="districtId" required>
                                    {{-- @if ($item['userData']->get_user_division->divisionId == $item['userData']->get_user_district->divisionId) --}}
                                        <option value="{{ $item['userData']->get_user_district->districtId ?? '' }}">
                                            {{ $item['userData']->get_user_district->districtEng ?? '' }}
                                            ({{ $item['userData']->get_user_district->districtBng ?? '' }})</option>
                                        {{-- @else --}}
                                    {{-- @endif --}}
                                </select>
                                @if ($errors->has('districtId'))
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @endif
                            </div>
                     
                            <div class="form-group">
                                <label for="exampleFormControlSelect1" class="font-weight-600">Upazila</label>
                                <select class="form-control" name="upazilaId" id="upazilaId" required>
                                    <option value="{{ $item['userData']->get_user_upazila->upazilaId ?? ''}}">
                                        {{ $item['upazilaData']->upazilaEng ?? '' }}
                                        ({{ $item['upazilaData']->upazilaBng ?? '' }})</option>

                                </select>
                                @if ($errors->has('upazilaId'))
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="font-weight-600">Address</label>
                                <textarea name="address" class="form-control" id="" cols="30" rows="10">{{ $item['userData']->address }}</textarea>

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
                                    value="{{ $item['userData']->email ?? '' }}">
                                @if ($errors->has('email'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('email') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 p-l-30 p-r-30">

                            {{-- <div class="form-group">
                                <label class="font-weight-600">Old Password</label>
                                <input type="password" class="form-control" name="oldPassword" placeholder="Old Password">
                                @if ($errors->has('oldpassword'))
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @endif
                            </div> --}}
                            <div class="form-group">
                                <label class="font-weight-600">New Password</label>
                                <input type="password" class="form-control" name="newPassword" placeholder="New Password">
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
        $(document).ready(function() {
            $.validator.addMethod("lettersonly", function(value, element) {
                return this.optional(element) || /^[a-zA-z\s]+$/i.test(value);
            }, "Please enter only alphabet");
            $("#update-form").validate({

                rules: {
                    name: {
                        // number: true,
                        minlength: 3,
                        maxlength: 100
                    },
                    phone: {
                        number: true,
                        minlength: 11,
                        maxlength: 11
                    }
                }
            });
        });
    </script>
        <script>
            $(document).ready(function() {
                $('#divisionId').on('change', function() {
                    let upazila = $('#upazilaId').val();
                    let divisionId = $(this).children("option:selected").val();
                    if ((divisionId > 0)) {
                        $.ajax({
                            url: "{{ route('getDistrictList') }}",
                            method: 'GET',
                            data: {
                                divisionId: divisionId,
                            },
                            success: function(response) {
                                $('#districtId').html(response);
                                $('#upazilaId').html('');
                            },

                        });
                    } else {
                        $('#upazilaId').html('');
                        $('#districtId').html('');
                    }
                });
                $('#districtId').on('change', function() {
                    var divisionId = $('#divisionId').val();
                    let districtId = $(this).children("option:selected").val();
                    if (districtId > 0) {
                        $.ajax({
                            url: "{{ route('getUpazilaList') }}",
                            method: 'GET',
                            data: {
                                divisionId: divisionId,
                                districtId: districtId,
                            },
                            success: function(response) {
                                $('#upazilaId').html(response);
                            },

                        });
                    } else {
                        $('#upazilaId').html('');
                    }
                });
            });
        </script>
    @endpush
@endsection
