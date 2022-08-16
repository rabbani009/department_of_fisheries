@extends('admin.admin')
@section('content')
    <div style="margin: 20px 0px;">
        @include('flash::message')
    </div>
    <div class="content-header row align-items-center m-0">

        <div class="col-sm-8 header-title p-0">
            <div class="media">

                <div class="media-body">

                    <h1 class="font-weight-bold">List of User</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-4 text-right  p-0">
            <a href="{{ route('createUserAccountInformation') }}" class="btn btn-success mb-2 mr-1">
                <i class="typcn typcn-plus mr-2"></i>ADD NEW USER</a>
        </div>
    </div>


    <div class="body-content">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-row">
                    <table class="table table-master display table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Division (বিভাগ)</th>
                                <th>District (জেলা)</th>
                                <th>Upazila (উপজেলা)</th>
                                <th>User Role (ইউজারের ভূমিকা)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <select class="form-control" id="divisionId" name="divisionId">
                                        <option value="">--Select--</option>
                                        @foreach ($divisionList as $divisionList)
                                            <option value="{{ $divisionList->divisionId }}">
                                                {{ $divisionList->divisionEng }}
                                                ({{ $divisionList->divisionBng }})
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control" name="districtId" id="districtId">
                                        <option value="">--Select--</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control" name="upazilaId" id="upazilaId">
                                        <option value="">--Select--</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control" name="userRoleId" id="userRoleId">
                                        <option value="">--Select--</option>
                                        @foreach ($userList as $userList)
                                            <option value="{{ $userList->id }}">
                                                {{ $userList->enName }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <button type="button" id="reportBtn" class="btn btn-success">Submit</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="form-row" id="areaTextShow">
                    <h6 class="fs-17 font-weight"></h6>
                </div>
            </div>
            <div class="col-xs-2 col-sm-2 col-md-2">
                <img src="#" style="height: 100px;" alt="">
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="fs-17 font-weight-600 mb-0">User</h6>
                    </div>
                </div>
            </div>
            <div class="card-body" id="userData">
                <div class="table-responsive">
                    <div class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12">
                                <table
                                    class="table display table-bordered table-striped table-hover multi-tables dataTable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Designation</th>
                                            <th>Department</th>
                                            <th>User Role</th>
                                            <th>Division</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $index = 1;
                                        @endphp
                                        @foreach ($data as $item)
                                            <tr>
                                                <td>{{ $index }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->email }}</td>
                                                <td>{{ $item->phone }}</td>
                                                <td>{{ $item->get_user_designation->enName ?? '' }}</td>
                                                <td>{{ $item->get_user_department->enName ?? '' }}</td>
                                                <td>{{ $item->get_user_type->enName ?? '' }}</td>
                                                <td>{{ $item->get_user_division->divisionEng ?? '' }}</td>
                                                <td>

                                                    <a href="{{ route('editUser', $item->id) }}"
                                                        class="btn btn-success-soft btn-sm mr-1" title="Edit"><i
                                                            class="far fa-edit"></i></a>
                                                    <a href="{{ route('deleteUser', $item->id) }}"
                                                        class="btn btn-danger-soft btn-sm deleteItem" title="Delete"><i
                                                            class="far fa-trash-alt"></i></a>
                                                </td>
                                            </tr>
                                            @php
                                                $index++;
                                            @endphp
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @push('js')
        <script>
            $(document).ready(function() {
                $(document).on('click', '.deleteItem', function(event) {
                    const url = $(this).attr('href');
                    event.preventDefault();
                    swal({
                            title: `Are you sure you want to delete this Item?`,
                            icon: "warning",
                            buttons: true,
                            dangerMode: true,
                        })
                        .then((willDelete) => {
                            if (willDelete) {
                                window.location.href = url;
                            }
                        });
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                $('#divisionId').on('change', function() {
                    $('#districtId').val('');
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
        <script type="text/javascript">
            $(document).ready(function() {
                //    $('#divisionId,#districtId,#upazilaId').on('change', function() {
                //        // e.preventDefault();
                $('#reportBtn').on('click', function(e) {
                    e.preventDefault();
                    var divisionId = $('#divisionId').val();
                    var districtId = $('#districtId').val();
                    var upazilaId = $('#upazilaId').val();
                    var userRoleId = $('#userRoleId').val();
                    if (userRoleId == null || userRoleId == '') {
                        swal({
                                title: `Please Select User Role`,
                                showCancelButton: false
                            })
                            .then((willDelete) => {
                                if (willDelete) {
                                    window.location.href = url;
                                }
                            });
                    }
                    $.ajax({
                        url: "{{ route('getUserData') }}",
                        method: 'GET',
                        data: {
                            divisionId: divisionId,
                            districtId: districtId,
                            upazilaId: upazilaId,
                            userRoleId: userRoleId
                        },
                        beforeSend: function() {
                            $('#loader').show();
                        },
                        success: function(response) {
                            $('#loader').hide();
                            // console.log(response);
                            $('#userData').html(response);
                            // data();
                        },
                        error: function(response) {
                            console.log('failure');
                        }

                    });
                });
            });
        </script>
    @endpush
@endsection
