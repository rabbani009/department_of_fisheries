@extends('admin.admin')
@section('content')
    <div style="margin: 20px 0px;">
        @include('flash::message')
    </div>

    <div class="content-header row align-items-center m-0">

        <div class="col-sm-8 header-title p-0">
            <div class="media">

                <div class="media-body">
                    <h1 class="font-weight-bold">List of Ward</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-4 text-right p-0">
            <a href="{{ route('createWard') }}" class="btn btn-success mb-2 mr-1">
                <i class="typcn typcn-plus mr-2"></i>ADD WARD</a>
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
                                <th>Municipality (পৌরসভা)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <select class="form-control" id="divisionId" name="divisionId">
                                        <option value="">--Select--</option>
                                        @foreach ($divisions as $divisionList)
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
                                    <select class="form-control" name="municipalityId" id="municipalityId">
                                        <option value="">--Select--</option>
                                    </select>
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
        <div class="card mb-4" id="wardId">
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
                    let divisionId = $(this).children("option:selected").val();
                    if (divisionId > 0) {
                        $.ajax({
                            url: "{{ route('getDistrictList') }}",
                            method: 'GET',
                            data: {
                                divisionId: divisionId,
                            },
                            success: function(response) {
                                $('#districtId').html(response);
                                $('#municipalityId').html('');
                                $('#wardId').html('');
                            },

                        });
                    } else {
                        $('#municipalityId').html('');
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
                                $('#municipalityId').html('');
                                $('#wardId').html('');
                            },

                        });
                    } else {
                        $('#upazilaId').html('');
                        $('#municipalityId').html('');
                    }


                });
                // for municipality , union postoffice data
                $('#upazilaId').on('change', function() {
                    var divisionId = $('#divisionId').val();
                    var districtId = $('#districtId').val();
                    let upazilaId = $(this).children("option:selected").val();
                    if (upazilaId > 0) {
                        $.ajax({
                            url: "{{ route('getMunicipalityAndUnionList') }}",
                            method: 'GET',
                            data: {
                                divisionId: divisionId,
                                districtId: districtId,
                                upazilaId: upazilaId,
                            },
                            success: function(response) {
                                $('#municipalityId').html(response.municipalityData);
                                $('#wardId').html('');
                            },

                        });
                    } else {
                        $('#municipalityId').html('');
                    }

                });
                // for ward data
                $('#municipalityId').on('change', function() {
                    var divisionId = $('#divisionId').val();
                    var districtId = $('#districtId').val();
                    let upazilaId = $("#upazilaId").val();
                    let municipalityId = $(this).children("option:selected").val();
                    if (municipalityId > 0) {
                        $.ajax({
                            url: "{{ route('getWardListForAdd') }}",
                            method: 'GET',
                            data: {
                                divisionId: divisionId,
                                districtId: districtId,
                                upazilaId: upazilaId,
                                municipalityId: municipalityId,
                            },
                            success: function(response) {
                                $('#wardId').html(response);
                            },

                        });
                    } else {
                        $('#wardId').html('');
                    }

                });
            });
        </script>
    @endpush
@endsection
