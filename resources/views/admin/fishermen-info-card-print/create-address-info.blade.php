@extends('admin.admin')
@section('content')
    <div style="margin: 20px 0px;">
        @include('flash::message')
    </div>
    <div class="content-header row align-items-center m-0">

        <div class="col-sm-8 header-title p-0">
            <div class="media">

                <div class="media-body">
                    <h1 class="font-weight-bold">Add Fishers</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-4 text-right  p-0">
            <a href="{{ url()->previous() }}" class="btn btn-success mb-2 mr-1">
                <i class="typcn typcn-arrow-back mr-2"></i>Back</a>
        </div>
    </div>

    <div class="body-content">
        <div class="stepwizard">
            <div class="stepwizard-row setup-panel">
                <div class="stepwizard-step col-xs-3">
                    <a href="{{ route('createFishermenPersonalInformation') }}" type="button"
                        class="btn btn-default btn-circle" disabled="disabled">1</a>
                    <p><small>Personal Information (ব্যক্তিগত তথ্য)</small></p>
                </div>
                <div class="stepwizard-step col-xs-3">
                    <a href="{{ route('createFishermenFamilyInformation') }}" type="button"
                        class="btn btn-default btn-circle" disabled="disabled">2</a>
                    <p><small>Family Information (পারিবারিক তথ্য)</small></p>
                </div>
                <div class="stepwizard-step col-xs-3">
                    <a href="#step-3" type="button" class="btn btn-success btn-circle">3</a>
                    <p class="text-style"><small>Address (ঠিকানা)</small></p>
                </div>
                <div class="stepwizard-step col-xs-3">
                    <a href="#step-4" type="button" class="btn btn-default btn-circle" disabled="disabled">4</a>
                    <p><small>Fishing Information (মাছ ধরার তথ্য)</small></p>
                </div>
            </div>
        </div>
        <form id="family-address-form" action="{{ route('storeFishermenAddressInformation') }}" method="post">
            @csrf
            <div class="card mb-4" id="stepOne">
                <div class="card-header">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="fs-17 font-weight-600 mb-0 text-edit">Permanent Address (স্থায়ী ঠিকানা)</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="fs-17 font-weight-600 mb-0 text-edit">Present Address (বর্তমান ঠিকানা)</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 p-l-30 p-r-30 left-side">
                            <div class="form-group">
                                <label for="exampleFormControlSelect1" class="font-weight-600">Division (বিভাগ)<span
                                        class="required-css">*</span></label>
                                <select class="form-control" name="divisionId" id="divisionId" required>
                                    <option value="">Select Division </option>
                                    @foreach ($divisionList as $divisionList)
                                        @if (old('divisionId') == $divisionList->divisionId)
                                            <option value="{{ $divisionList->divisionId }}" selected>
                                                {{ $divisionList->divisionEng }}
                                                ({{ $divisionList->divisionBng }})
                                            </option>
                                        @else
                                            <option value="{{ $divisionList->divisionId }}">
                                                {{ $divisionList->divisionEng }}
                                                ({{ $divisionList->divisionBng }})
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                                @if ($errors->has('divisionId'))
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="font-weight-600">District (জেলা)<span class="required-css">*</span></label>
                                <select class="form-control" name="districtId" id="districtId" required>

                                </select>
                                @if ($errors->has('districtId'))
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="font-weight-600">Upazila (উপজেলা)<span class="required-css">*</span></label>
                                <select class="form-control" name="upazilaId" id="upazilaId" required>

                                </select>
                                @if ($errors->has('upazilaId'))
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group" id="municipalitySectionId">
                                <label class="font-weight-600">Municipality (পৌরসভা ) (If any) </label>
                                <select class="form-control" name="municipalityId" id="municipalityId">

                                </select>
                                @if ($errors->has('municipalityId'))
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group" id="wardSectionId">
                                <label class="font-weight-600"> Ward (ওয়ার্ড)</label>
                                <select class="form-control" name="wardId" id="wardId">

                                </select>
                                @if ($errors->has('wardId'))
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group" id="unionSectionId">
                                <label class="font-weight-600"> Union (ইউনিয়ন) (If any) </label>
                                <select class="form-control" name="unionId" id="unionId">

                                </select>
                                @if ($errors->has('unionId'))
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @endif
                            </div>

                            <div class="form-group" id="villageSectionId">
                                <label class="font-weight-600">Village (গ্রাম)</label>
                                <select class="form-control" name="villageId" id="villageId">
                                </select>
                                @if ($errors->has('villageId'))
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group" id="postOfficeSectionId">
                                <label class="font-weight-600">Post Office (ডাক ঘর)<span
                                        class="required-css">*</span></label>
                                <select class="form-control" name="postOfficeId" id="postOfficeId" required>
                                </select>
                                @if ($errors->has('postOfficeId'))
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 p-l-30 p-r-30">
                            <div class="form-group">
                                <label for="exampleFormControlSelect1" class="font-weight-600">Division (বিভাগ)<span
                                        class="required-css">*</span></label>
                                <select class="form-control" name="presentDivisionId" id="presentDivisionId" required>
                                    <option value="">Select Division </option>
                                    @foreach ($permanentdivisionList as $divisionListPresent)
                                        @if (old('presentDivisionId') == $divisionListPresent->divisionId)
                                            <option value="{{ $divisionListPresent->divisionId }}" selected>
                                                {{ $divisionListPresent->divisionEng }}
                                                ({{ $divisionListPresent->divisionBng }})
                                            </option>
                                        @else
                                            <option value="{{ $divisionListPresent->divisionId }}">
                                                {{ $divisionListPresent->divisionEng }}
                                                ({{ $divisionListPresent->divisionBng }})
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                                @if ($errors->has('presentDivisionId'))
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="font-weight-600">District (জেলা)<span class="required-css">*</span></label>
                                <select class="form-control" name="presentDistrictId" id="presentDistrictId" required>

                                </select>
                                @if ($errors->has('presentDistrictId'))
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="font-weight-600">Upazila (উপজেলা)<span class="required-css">*</span></label>
                                <select class="form-control" name="presentUpazilaId" id="presentUpazilaId" required>

                                </select>
                                @if ($errors->has('presentUpazilaId'))
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group" id="presentMunicipalitySectionId">
                                <label class="font-weight-600">Municipality (পৌরসভা ) (If any) </label>
                                <select class="form-control" name="presentMunicipalityId" id="presentMunicipalityId">

                                </select>
                                @if ($errors->has('presentMunicipalityId'))
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group" id="presentWardSectionId">
                                <label class="font-weight-600"> Ward (ওয়ার্ড)</label>
                                <select class="form-control" name="presentWardId" id="presentWardId">

                                </select>
                                @if ($errors->has('presentWardId'))
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group" id="presentUnionSectionId">
                                <label class="font-weight-600"> Union (ইউনিয়ন) (If any) </label>
                                <select class="form-control" name="presentUnionId" id="presentUnionId">

                                </select>
                                @if ($errors->has('presentUnionId'))
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @endif
                            </div>

                            <div class="form-group" id="presentVillageSectionId">
                                <label class="font-weight-600">Village (গ্রাম)</label>
                                <select class="form-control" name="presentVillageId" id="presentVillageId">
                                </select>
                                @if ($errors->has('presentVillageId'))
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group" id="presentPostOfficeSectionId">
                                <label class="font-weight-600">Post Office (ডাক ঘর)<span
                                        class="required-css">*</span></label>
                                <select class="form-control" name="presentPostOfficeId" id="presentPostOfficeId"
                                    required>
                                </select>
                                @if ($errors->has('presentPostOfficeId'))
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6 p-l-30 p-r-30 text-left">
                            <a type="button" href="{{ route('createFishermenFamilyInformation') }}"
                                class="btn btn-danger"><i class="typcn typcn-arrow-left-thick mr-2"></i> Back</a>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 p-l-30 p-r-30 text-right">
                            <button type="submit" class="btn btn-success mr-1">Submit and Next <i
                                    class="typcn typcn-arrow-right-thick ml-2"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    @push('js')
        <script>
            $('#wardSectionId').hide();
            $('#villageSectionId').hide();
            $(document).ready(function() {
                // for district data
                $('#divisionId').on('change', function() {
                    let divisionId = $(this).children("option:selected").val();
                    $.ajax({
                        url: "{{ route('getDistrictList') }}",
                        method: 'GET',
                        data: {
                            divisionId: divisionId,
                        },
                        success: function(response) {
                            $('#districtId').html(response);
                        },

                    });
                });

                // for upazila data
                $('#districtId').on('change', function() {
                    var divisionId = $('#divisionId').val();
                    let districtId = $(this).children("option:selected").val();
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
                });

                // for municipality , union postoffice data
                $('#upazilaId').on('click', function() {
                    var divisionId = $('#divisionId').val();
                    var districtId = $('#districtId').val();
                    let upazilaId = $(this).children("option:selected").val();
                    $.ajax({
                        url: "{{ route('getMunicipalityAndUnionList') }}",
                        method: 'GET',
                        data: {
                            divisionId: divisionId,
                            districtId: districtId,
                            upazilaId: upazilaId,
                        },
                        success: function(response) {
                            // console.log(response);
                            $('#municipalityId').html(response.municipalityData);
                            $('#unionId').html(response.unionData);
                            $('#postOfficeId').html(response.postOfficeData);
                        },

                    });
                });

                // for ward data
                $('#municipalityId').on('change', function() {
                    $('#unionSectionId').hide();
                    $('#villageSectionId').hide();
                    $('#wardSectionId').show();
                    var divisionId = $('#divisionId').val();
                    var districtId = $('#districtId').val();
                    let upazilaId = $("#upazilaId").val();
                    let municipalityId = $(this).children("option:selected").val();
                    $.ajax({
                        url: "{{ route('getWardList') }}",
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
                });

                // for village data
                $('#unionId').on('change', function() {
                    $('#villageSectionId').show();
                    $('#municipalitySectionId').hide();
                    $('#wardSectionId').hide();
                    var divisionId = $('#divisionId').val();
                    var districtId = $('#districtId').val();
                    let upazilaId = $("#upazilaId").val();
                    let unionId = $(this).children("option:selected").val();
                    $.ajax({
                        url: "{{ route('getVillageList') }}",
                        method: 'GET',
                        data: {
                            divisionId: divisionId,
                            districtId: districtId,
                            upazilaId: upazilaId,
                            unionId: unionId,
                        },
                        success: function(response) {
                            $('#villageId').html(response);
                        },

                    });

                });
            });
        </script>
        <script>
            $('#presentWardSectionId').hide();
            $('#presentVillageSectionId').hide();
            $(document).ready(function() {
                // for district data
                $('#presentDivisionId').on('change', function() {
                    let presentDivisionId = $(this).children("option:selected").val();
                    $.ajax({
                        url: "{{ route('getPresentDistrictList') }}",
                        method: 'GET',
                        data: {
                            presentDivisionId: presentDivisionId,
                        },
                        success: function(response) {
                            $('#presentDistrictId').html(response);
                        },

                    });
                });

                // for upazila data
                $('#presentDistrictId').on('change', function() {
                    $('#presentVillageSectionId').hide();
                    var presentDivisionId = $('#presentDivisionId').val();
                    let presentDistrictId = $(this).children("option:selected").val();
                    $.ajax({
                        url: "{{ route('getPresentUpazilaList') }}",
                        method: 'GET',
                        data: {
                            presentDivisionId: presentDivisionId,
                            presentDistrictId: presentDistrictId,
                        },
                        success: function(response) {
                            $('#presentUpazilaId').html(response);
                        },

                    });
                });

                // for municipality , union postoffice data
                $('#presentUpazilaId').on('click', function() {
                    $('#presentUnionSectionId').show();
                    $('#presentMunicipalitySectionId').show();
                    $('#presentVillageSectionId').hide();
                    $('#presentWardSectionId').hide();

                    var presentDivisionId = $('#presentDivisionId').val();
                    var presentDistrictId = $('#presentDistrictId').val();
                    let presentUpazilaId = $(this).children("option:selected").val();
                    $.ajax({
                        url: "{{ route('getPresentMunicipalityAndUnionList') }}",
                        method: 'GET',
                        data: {
                            presentDivisionId: presentDivisionId,
                            presentDistrictId: presentDistrictId,
                            presentUpazilaId: presentUpazilaId,
                        },
                        success: function(response) {
                            $('#presentMunicipalityId').html(response.municipalityData);
                            $('#presentUnionId').html(response.unionData);
                            $('#presentPostOfficeId').html(response.postOfficeData);
                        },

                    });
                });

                // for ward data
                $('#presentMunicipalityId').on('change', function() {
                    $('#presentWardSectionId').show();
                    $('#presentUnionSectionId').hide();
                    $('#presentVillageSectionId').hide();
                    var presentDivisionId = $('#presentDivisionId').val();
                    var presentDistrictId = $('#presentDistrictId').val();
                    let presentUpazilaId = $('#presentUpazilaId').val();
                    let presentMunicipalityId = $(this).children("option:selected").val();
                    $.ajax({
                        url: "{{ route('getPresentWardList') }}",
                        method: 'GET',
                        data: {
                            presentDivisionId: presentDivisionId,
                            presentDistrictId: presentDistrictId,
                            presentUpazilaId: presentUpazilaId,
                            presentMunicipalityId: presentMunicipalityId,
                        },
                        success: function(response) {
                            $('#presentWardId').html(response);
                        },

                    });
                });

                // for village data
                $('#presentUnionId').on('change', function() {
                    $('#presentVillageSectionId').show();
                    $('#presentMunicipalitySectionId').hide();
                    $('#presentWardSectionId').hide();
                    var presentDivisionId = $('#presentDivisionId').val();
                    var presentDistrictId = $('#presentDistrictId').val();
                    let presentUpazilaId = $('#presentUpazilaId').val();
                    let presentUnionId = $(this).children("option:selected").val();
                    $.ajax({
                        url: "{{ route('getPresentVillageList') }}",
                        method: 'GET',
                        data: {
                            presentDivisionId: presentDivisionId,
                            presentDistrictId: presentDistrictId,
                            presentUpazilaId: presentUpazilaId,
                            presentUnionId: presentUnionId,
                        },
                        success: function(response) {
                            $('#presentVillageId').html(response);
                        },

                    });

                });
            });
        </script>
        <script>
            $(document).ready(function() {
                $.validator.addMethod("lettersonly", function(value, element) {
                    return this.optional(element) || /^[a-zA-z\s]+$/i.test(value);
                }, "Please enter only alphabet");
                $("#family-address-form").validate({

                    rules: {
                        divisionId: {
                            required: true
                        },
                        districtId: {
                            required: true
                        },
                        upazilaId: {
                            required: true
                        },
                        postOfficeId: {
                            required: true
                        },
                        presentDivisionId: {
                            required: true
                        },
                        presentDistrictId: {
                            required: true
                        },
                        presentUpazilaId: {
                            required: true
                        },
                        presentPostOfficeId: {
                            required: true
                        }
                    }
                });
            });
        </script>
    @endpush
@endsection
