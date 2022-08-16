@extends('admin.admin')
@section('content')
    {{-- <div style="margin: 20px 0px;">
        @include('flash::message')
    </div> --}}
    <div class="body-content form-control-master">
        <div class="row">
            <div class="col-lg-12 col-md-12 col settings-tab">
                <div class="card">
                    <div class="card-body">
                        <div class="nav master-report-tab" id="tabs">
                            <a class="nav-link" id="tabs_Personal" style="cursor:pointer;">Area Information <br>(এলাকার তথ্য)</a>&nbsp
                            <a class="nav-link" id="tabs_Family" style="cursor:pointer;">Personal Information <br>(ব্যাক্তিগত তথ্য)</a>&nbsp
                            <a class="nav-link" id="tabs_Permanent_Address" style="cursor:pointer;">Financial Information <br>(অর্থনৈতিক
                                তথ্য)</a>&nbsp
                            <a class="nav-link" id="tabs_Present_Address" style="cursor:pointer;">Professional Information <br>(পেশাগত তথ্য)</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col">
                <div class="tab-container" id="tabs_PersonalC">
                    <div class="card mb-4">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="fs-17 font-weight-600 mb-0 text-edit">Area Information (এলাকার তথ্য)</h6>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-row">
                                        <table class="table table-master display table-bordered table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Division (বিভাগ)</th>
                                                    <th>District (জেলা)</th>
                                                    <th>Upazila (উপজেলা)</th>
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
                        </div>

                    </div>
                </div>
                <div class="tab-container" id="tabs_FamilyC">
                    <div class="card mb-4">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="fs-17 font-weight-600 mb-0 text-edit">Personal Information (ব্যাক্তিগত তথ্য)
                                    </h6>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-row">
                                        <table class="table table-master display table-bordered table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Gender (লিঙ্গ)</th>
                                                    <th>Religion (ধর্ম)</th>
                                                    <th>Educational Qualifications (শিক্ষাগত যোগ্যতা)</th>
                                                    <th>Marital Status (বৈবাহিক অবস্থা)</th>
                                                    <th>Age (বয়স)</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <select class="form-control js-example-basic-multiple"
                                                            id="genderId" multiple="multiple">
                                                            <option value="Male">Male (পুরুষ)</option>
                                                            <option value="Female">Female (মহিলা)</option>
                                                        </select>
                                                    </td>

                                                    <td>
                                                        <select class="form-control js-example-basic-multiple"
                                                            id="religionId" multiple="multiple">
                                                            @foreach ($religionList as $religion)
                                                                <option value="{{ $religion->id }}">
                                                                    {{ $religion->religionEnglish }}
                                                                    ({{ $religion->religionBangla }})
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select class="form-control js-example-basic-multiple"
                                                            name="" id="educationId" multiple="multiple">
                                                            @foreach ($educationList as $education)
                                                                <option value="{{ $education->id }}">
                                                                    {{ $education->educationalQualificationEng }}
                                                                    ({{ $education->educationalQualificationBng }})
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select class="form-control js-example-basic-multiple"
                                                            name="" id="maritalStatusId" multiple="multiple">
                                                            @foreach ($maritalStatusList as $maritalStatus)
                                                                <option value="{{ $maritalStatus->id }}">
                                                                    {{ $maritalStatus->maritalStatusEng }}
                                                                    ({{ $maritalStatus->maritalStatusBng }})
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <div class="row no-gutters">
                                                            <div class="col-5">
                                                                <input type="text"
                                                                    onkeypress="return /\d/.test(String.fromCharCode(((event||window.event).which||(event||window.event).which)));"
                                                                    class="form-control" id="ageStartId">
                                                            </div>
                                                            <div class="col-2 text-center">
                                                                <span>to</span>
                                                            </div>
                                                            <div class="col-5">
                                                                <input type="text"
                                                                    onkeypress="return /\d/.test(String.fromCharCode(((event||window.event).which||(event||window.event).which)));"
                                                                    class="form-control" id="ageEndId">
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="form-row personalInfoTextShow" id="personalInfoTextShow">
                                        <h6 class="fs-17 font-weight"></h6>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-container" id="tabs_Permanent_AddressC">
                    <div class="card mb-4">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="fs-17 font-weight-600 mb-0 text-edit">Financial Information(অর্থনৈতিক তথ্য)
                                    </h6>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-row">
                                        <table class="table table-master display table-bordered table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Annual Savings (বার্ষিক সঞ্চয়)</th>
                                                    <th>Annual loan(বার্ষিক ঋণ)</th>
                                                    <th>Livelihood crisis (জীবিকার আপদকাল)</th>
                                                    <th>Annual income (বার্ষিক আয়)</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <select class="form-control js-example-basic-multiple"
                                                            name="yearlySavingId[]" id="yearlySavingId"
                                                            multiple="multiple">
                                                            @foreach ($yearlySavingList as $yearlySaving)
                                                                <option value="{{ $yearlySaving->id }}">
                                                                    {{ $yearlySaving->yearlySavingEng }}
                                                                    ({{ $yearlySaving->yearlySavingBng }})
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select class="form-control js-example-basic-multiple"
                                                            name="" id="yearlyLoanId" multiple="multiple">
                                                            @foreach ($yearlyLoanList as $yearlyLoan)
                                                                <option value="{{ $yearlyLoan->id }}">
                                                                    {{ $yearlyLoan->yearlyLoanEng }}
                                                                    ({{ $yearlyLoan->yearlyLoanBng }})
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select class="form-control js-example-basic-multiple"
                                                            name="" id="deficiencyPeriodId" multiple="multiple">
                                                            @foreach ($deficiencyPeriodList as $deficiencyPeriod)
                                                                <option value="{{ $deficiencyPeriod->id }}">
                                                                    {{ $deficiencyPeriod->deficiencyPeriodEng }}
                                                                    ({{ $deficiencyPeriod->deficiencyPeriodBng }})
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <div class="row no-gutters">
                                                            <div class="col-5">
                                                                <input type="text"
                                                                    onkeypress="return /\d/.test(String.fromCharCode(((event||window.event).which||(event||window.event).which)));"
                                                                    class="form-control" id="annualIncomeStartId">
                                                            </div>
                                                            <div class="col-2 text-center">
                                                                <span>to</span>
                                                            </div>
                                                            <div class="col-5">
                                                                <input type="text"
                                                                    onkeypress="return /\d/.test(String.fromCharCode(((event||window.event).which||(event||window.event).which)));"
                                                                    class="form-control" id="annualIncomeEndId">
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="form-row financialInfoTextShow">
                                        <h6 class="fs-17 font-weight"></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-container" id="tabs_Present_AddressC">
                    <div class="card mb-4">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="fs-17 font-weight-600 mb-0 text-edit">Professional Information (পেশাগত তথ্য)
                                    </h6>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <table class="table table-master display table-bordered table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>Fishing Time Based (মৎস্য আহরণকাল ভিত্তিক)</th>
                                                <th>Place Of Fishing (মৎস্য আহরণস্থল)</th>
                                                <th>Fish Category (আহরিত মাছের ধরন)</th>
                                                <th>Fishing Equipment (মাছ ধরার সরঞ্জাম)</th>
                                                <th>Types of fishing (মৎস্য আহরণের ধরন)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <select class="form-control js-example-basic-multiple" name=""
                                                        id="fishingTimeId" multiple="multiple">
                                                        @foreach ($timeOfFishingList as $timeOfFishing)
                                                            <option value="{{ $timeOfFishing->id }}">
                                                                {{ $timeOfFishing->timeOfFishingEng }}
                                                                ({{ $timeOfFishing->timeOfFishingBng }})
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <select class="form-control js-example-basic-multiple" name=""
                                                        id="placeOfFishingId" multiple="multiple">
                                                        @foreach ($placeOfFishingList as $placeOfFishing)
                                                            <option value="{{ $placeOfFishing->id }}">
                                                                {{ $placeOfFishing->placeEng }}
                                                                ({{ $placeOfFishing->placeBng }})
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <select class="form-control js-example-basic-multiple" name=""
                                                        id="typesOfFishId" multiple="multiple">
                                                        @foreach ($fishCategoryList as $fishCategory)
                                                            <option value="{{ $fishCategory->id }}">
                                                                {{ $fishCategory->categoryEng }}
                                                                ({{ $fishCategory->categoryBng }})
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <select class="form-control js-example-basic-multiple"
                                                        id="fishingEquipmentId" multiple="multiple">
                                                        @foreach ($fishingEquipmentList as $fishingEquipment)
                                                            <option value="{{ $fishingEquipment->id }}">
                                                                {{ $fishingEquipment->equipmentEng }}
                                                                ({{ $fishingEquipment->equipmentBng }})
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <select class="form-control js-example-basic-multiple"
                                                        id="fishingTypeId" multiple="multiple">
                                                        @foreach ($howToFishingList as $howToFishingData)
                                                            <option value="{{ $howToFishingData->id }}">
                                                                {{ $howToFishingData->howToFishingEng }}
                                                                ({{ $howToFishingData->howToFishingBng }})
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table class="table table-master display table-bordered table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>Ownership of the net (জালের মালিকানা)</th>
                                                <th>Type Of Vessels (নৌযানের ধরন)</th>
                                                <th>Owner Of Vessels (নৌযানের মালিকানা)</th>
                                                <th>Fish sale place (মাছ বিক্রির স্থান)</th>
                                                <th>Price Of Vessels (নৌযানের মূল্য)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <select class="form-control js-example-basic-multiple" name=""
                                                        id="ownershipNetId" multiple="multiple">
                                                        @foreach ($ownerOfNetList as $ownerOfNet)
                                                            <option value="{{ $ownerOfNet->id }}">
                                                                {{ $ownerOfNet->ownerOfNetEng }}
                                                                ({{ $ownerOfNet->ownerOfNetBng }})
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <select class="form-control js-example-basic-multiple" name=""
                                                        id="typeOfVesselsId" multiple="multiple">
                                                        @foreach ($typeOfVesselsList as $typeOfVessels)
                                                            <option value="{{ $typeOfVessels->id }}">
                                                                {{ $typeOfVessels->typeofVesselsEng }}
                                                                ({{ $typeOfVessels->typeofVesselsBng }})
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <select class="form-control js-example-basic-multiple" name=""
                                                        id="ownerOfVesselsId" multiple="multiple">
                                                        @foreach ($ownerOfVesselsList as $ownerOfVessels)
                                                            <option value="{{ $ownerOfVessels->id }}">
                                                                {{ $ownerOfVessels->ownerOfVesselsEng }}
                                                                ({{ $ownerOfVessels->ownerOfVesselsBng }})
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <select class="form-control js-example-basic-multiple"
                                                        id="fishSalePlaceId" multiple="multiple">
                                                        @foreach ($fishSalePlacesList as $fishSalePlaces)
                                                            <option value="{{ $fishSalePlaces->id }}">
                                                                {{ $fishSalePlaces->salePlaceEng }}
                                                                ({{ $fishSalePlaces->salePlaceBng }})
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <div class="row no-gutters">
                                                        <div class="col-5">
                                                            <input type="text"
                                                                onkeypress="return /\d/.test(String.fromCharCode(((event||window.event).which||(event||window.event).which)));"
                                                                class="form-control" id="priceOfVesselStartId">
                                                        </div>
                                                        <div class="col-2 text-center">
                                                            <span>to</span>
                                                        </div>
                                                        <div class="col-5">
                                                            <input type="text"
                                                                onkeypress="return /\d/.test(String.fromCharCode(((event||window.event).which||(event||window.event).which)));"
                                                                class="form-control" id="priceOfVesselEndId">
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="form-row professionalTextShow">
                                        <h6 class="fs-17 font-weight"></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="margin: 0px 0px 20px 0px; text-align : center;">
                    <button class="btn btn-primary btn-lg submitBtn" id="">Submit</button>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col">
                <div id='loader' style='display: none;'>
                    <div class="text-center">
                        <div class="spinner-border" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col">
                <div id="tableNew"></div>
            </div>
        </div>
    </div>
    @push('js')
        <script>
            $(document).ready(function() {

                $('#tabs a:not(:first)').addClass('inactive');
                $('.tab-container').hide();
                $('.tab-container:first').show();

                $('#tabs a').click(function() {
                    var t = $(this).attr('id');
                    // console.log(t);
                    if ($(this).hasClass('inactive')) {
                        $('#tabs a').addClass('inactive');
                        $(this).removeClass('inactive');

                        $('.tab-container').hide();
                        $('#' + t + 'C').fadeIn('slow');
                    }
                });

            });
        </script>
        <script>
            $(document).ready(function() {
                $('#divisionId').on('change', function() {
                    let divisionId = $(this).children("option:selected").val();
                    if (!divisionId == '') {
                        var divisionText = 'Division (বিভাগ) :' + $('#divisionId option:selected').text();
                    } else {
                        var divisionText = '';
                    }
                    $('#areaTextShow').html(divisionText);
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
                });
                $('#districtId').on('change', function() {
                    var divisionText = $('#divisionId option:selected').text();
                    var districtText = $('#districtId option:selected').text();
                    var divisionId = $('#divisionId').val();
                    let districtId = $(this).children("option:selected").val();
                    if (!districtId == '') {
                        var textData = ('Division (বিভাগ) :' + divisionText) + ('<br> District (জেলা) : ' +
                            districtText);
                    } else {
                        var textData = 'Division (বিভাগ) :' + divisionText;
                    }

                    $('#areaTextShow').html(textData);
                    $.ajax({
                        url: "{{ route('getUpazilaList') }}",
                        method: 'GET',
                        data: {
                            divisionId: divisionId,
                            districtId: districtId,
                        },
                        success: function(response) {
                            $('#upazilaId').html(response);
                            $('#areaId').html('');
                        },

                    });
                });
                $('#upazilaId').on('change', function() {
                    var upazilaId = $(this).val();
                    var divisionText = $('#divisionId option:selected').text();
                    var districtText = $('#districtId option:selected').text();
                    var upazilaText = $('#upazilaId option:selected').text();
                    if (!upazilaId == '') {
                        var textData = ('Division (বিভাগ) :' + divisionText) + ('<br> District (জেলা) : ' +
                            districtText) + ('<br> Upazila (উপজেলা) : ' + upazilaText);
                    } else {
                        var textData = ('Division (বিভাগ) :' + divisionText) + ('<br> District (জেলা) : ' +
                            districtText);
                    }

                    $('#areaTextShow').html(textData);
                    let value = $(this).children("option:selected").val();
                });

                $('#genderId,#religionId,#educationId,#maritalStatusId,#ageStartId,#ageEndId').on('change', function() {
                    var genderId = $('#genderId').val();
                    if ((genderId = 'Male') || (genderId = 'Female')) {
                        var genderText = 'Gender (লিঙ্গ) : ' + $('#genderId option:selected').text() + '<br>';
                    } else {
                        var genderText = '';
                    }
                    var religionId = $('#religionId').val();
                    if (religionId > 0) {
                        var religionText = 'Religion (ধর্ম) : ' + $('#religionId option:selected').text() +
                            '<br>';
                    } else {
                        var religionText = '';
                    }
                    var educationId = $('#educationId').val();
                    if (educationId > 0) {
                        var educationText = 'Educational Qualification (শিক্ষাগত যোগ্যতা) : ' + $(
                            '#educationId option:selected').text() + '<br>';
                    } else {
                        var educationText = '';
                    }
                    var maritalStatusId = $('#maritalStatusId').val();
                    if (maritalStatusId > 0) {
                        var maritalStatusText = 'Marital Status (বৈবাহিক অবস্থা) : ' + $(
                            '#maritalStatusId option:selected').text() + '<br>';
                    } else {
                        var maritalStatusText = '';
                    }
                    var ageStartId = $('#ageStartId').val();
                    if (ageStartId > 0) {
                        var ageStartText = 'Age (বয়স) : ' + $(
                            '#ageStartId').val();
                    } else {
                        var ageStartText = '';
                    }
                    var ageEndId = $('#ageEndId').val();
                    if (ageEndId > 0) {
                        var ageEndText = ' to ' + $(
                            '#ageEndId').val() + '<br>';
                    } else {
                        var ageEndText = '';
                    }
                    $('.personalInfoTextShow').html(genderText + religionText +
                        educationText + maritalStatusText + ageStartText + ageEndText);
                });

                $('#yearlySavingId,#yearlyLoanId,#deficiencyPeriodId,#annualIncomeStartId,#annualIncomeEndId').on(
                    'change',
                    function() {
                        var yearlySavingId = $('#yearlySavingId').val();
                        if (yearlySavingId > 0) {
                            var yearlySavingText = 'Annual Savings(বার্ষিক সঞ্চয়) : ' + $(
                                '#yearlySavingId option:selected').text() + '<br>';
                        } else {
                            var yearlySavingText = '';
                        }
                        var yearlyLoanId = $('#yearlyLoanId').val();
                        if (yearlyLoanId > 0) {
                            var yearlyLoanText = 'Annual loan(বার্ষিক ঋণ) : ' + $('#yearlyLoanId option:selected')
                                .text() + '<br>';
                        } else {
                            var yearlyLoanText = '';
                        }
                        var deficiencyPeriodId = $('#deficiencyPeriodId').val();
                        if (deficiencyPeriodId > 0) {
                            var deficiencyPeriodText = 'Livelihood crisis (জীবিকার আপদকাল) : ' + $(
                                '#deficiencyPeriodId option:selected').text() + '<br>';
                        } else {
                            var deficiencyPeriodText = '';
                        }
                        var fishingTimeId = $('#fishingTimeId').val();
                        if (fishingTimeId > 0) {
                            var fishingTimeText = 'Fishing Time (মৎস্য আহরণকাল) : ' + $(
                                '#fishingTimeId option:selected').text() + '<br>';
                        } else {
                            var fishingTimeText = '';
                        }
                        var annualIncomeStartId = $('#annualIncomeStartId').val();
                        if (annualIncomeStartId > 0) {
                            var annualIncomeStartText = 'Annual Income (বার্ষিক আয়) : ' + $('#annualIncomeStartId')
                                .val();
                        } else {
                            var annualIncomeStartText = '';
                        }
                        var annualIncomeEndId = $('#annualIncomeEndId').val();
                        if (annualIncomeEndId > 0) {
                            var annualIncomeEndText = ' to ' + $('#annualIncomeEndId').val() + '<br>';
                        } else {
                            var annualIncomeEndText = '';
                        }

                        $('.financialInfoTextShow').html(yearlySavingText + yearlyLoanText +
                            deficiencyPeriodText + annualIncomeStartText + annualIncomeEndText);
                    });

                $('#fishingTimeId,#placeOfFishingId,#typesOfFishId,#fishingEquipmentId,#fishingTypeId,#ownershipNetId,#typeOfVesselsId,#ownerOfVesselsId,#fishSalePlaceId, #priceOfVesselStartId,#priceOfVesselEndId')
                    .on('change',
                        function() {
                            //    alert('ok');
                            var fishingTimeId = $('#fishingTimeId').val();
                            if (fishingTimeId > 0) {
                                var fishingTimeText = 'Fishing Time (মৎস্য আহরণকাল) : ' + $(
                                    '#fishingTimeId option:selected').text() + '<br>';
                            } else {
                                var fishingTimeText = '';
                            }
                            var placeOfFishingId = $('#placeOfFishingId').val();
                            if (placeOfFishingId > 0) {
                                var placeOfFishingText = 'Place Of Fishing (মৎস্য আহরণস্থল) : ' + $(
                                    '#placeOfFishingId option:selected').text() + '<br>';
                            } else {
                                var placeOfFishingText = '';
                            }
                            var typesOfFishId = $('#typesOfFishId').val();
                            if (typesOfFishId > 0) {
                                var typesOfFishText = 'Types of fish (আহরিত মাছের ধরন) : ' + $(
                                    '#typesOfFishId option:selected').text() + '<br>';
                            } else {
                                var typesOfFishText = '';
                            }
                            var fishingEquipmentId = $('#fishingEquipmentId').val();
                            if (fishingEquipmentId > 0) {
                                var fishingEquipmentText = 'Fishing Equipment (মাছ ধরার সরঞ্জাম) : ' + $(
                                    '#fishingEquipmentId option:selected').text() + '<br>';
                            } else {
                                var fishingEquipmentText = '';
                            }
                            var fishingTypeId = $('#fishingTypeId').val();
                            if (fishingTypeId > 0) {
                                var fishingTypeText = 'Types of fishing (মৎস্য আহরণের ধরন) : ' + $(
                                    '#fishingTypeId option:selected').text() + '<br>';
                            } else {
                                var fishingTypeText = '';
                            }
                            var ownershipNetId = $('#ownershipNetId').val();
                            if (ownershipNetId > 0) {
                                var ownershipNetText = 'Ownership of net (জালের মালিকানা) : ' + $(
                                    '#ownershipNetId option:selected').text() + '<br>';
                            } else {
                                var ownershipNetText = '';
                            }
                            var typeOfVesselsId = $('#typeOfVesselsId').val();
                            if (typeOfVesselsId > 0) {
                                var typeOfVesselsText = 'Type Of Vessels (নৌযানের ধরন) : ' + $(
                                    '#typeOfVesselsId option:selected').text() + '<br>';
                            } else {
                                var typeOfVesselsText = '';
                            }
                            var ownerOfVesselsId = $('#ownerOfVesselsId').val();
                            if (ownerOfVesselsId > 0) {
                                var ownerOfVesselsText = 'Owner Of Vessels (নৌযানের মালিকানা) : ' + $(
                                    '#ownerOfVesselsId option:selected').text() + '<br>';
                            } else {
                                var ownerOfVesselsText = '';
                            }
                            var fishSalePlaceId = $('#fishSalePlaceId').val();
                            if (fishSalePlaceId > 0) {
                                var fishSalePlaceText = 'Fish sale place (মাছ বিক্রির স্থান) : ' + $(
                                    '#fishSalePlaceId option:selected').text() + '<br>';
                            } else {
                                var fishSalePlaceText = '';
                            }
                            var priceOfVesselStartId = $('#priceOfVesselStartId').val();
                            if (priceOfVesselStartId > 0) {
                                var priceOfVesselStartText = 'Price Of Vessels (নৌযানের মূল্য) : ' + $(
                                    '#priceOfVesselStartId').val();
                            } else {
                                var priceOfVesselStartText = '';
                            }
                            var priceOfVesselEndId = $('#priceOfVesselEndId').val();
                            if (priceOfVesselEndId > 0) {
                                var priceOfVesselEndText = ' to ' + $('#priceOfVesselEndId').val();
                            } else {
                                var priceOfVesselEndText = '';
                            }
                            $('.professionalTextShow').html(fishingTimeText + placeOfFishingText + typesOfFishText +
                                fishingEquipmentText + fishingTypeText + ownershipNetText + typeOfVesselsText +
                                ownerOfVesselsText + fishSalePlaceText + priceOfVesselStartText +
                                priceOfVesselEndText);
                        });

                $('.submitBtn').click(function() {
                    var divisionId = $('#divisionId').val();
                    if (!divisionId == '') {
                        var divisionText = 'Division (বিভাগ) :' + $('#divisionId option:selected').text();
                    } else {
                        var divisionText = '';
                    }
                    var districtId = $('#districtId').val();
                    var districtText = 'District (জেলা) : ' + $('#districtId option:selected').text();

                    var upazilaId = $('#upazilaId').val();
                    var upazilaText = 'Upazila (উপজেলা) : ' + $('#upazilaId option:selected').text();
                    //for gender
                    var genderId = $('#genderId').val();
                    var genderText = 'Gender (লিঙ্গ) : ' + $('#genderId option:selected').text();
                    //for religion
                    var religionId = $('#religionId').val();
                    var religionText = 'Religion (ধর্ম) : ' + $('#religionId option:selected').text();
                    //for education
                    var educationId = $('#educationId').val();
                    var educationText = 'Educational Qualification (শিক্ষাগত যোগ্যতা) : ' + $(
                        '#educationId option:selected').text();
                    //for marital status
                    var maritalStatusId = $('#maritalStatusId').val();
                    var maritalStatusText = 'Marital Status (বৈবাহিক অবস্থা) : ' + $(
                        '#maritalStatusId option:selected').text();
                    //for age start
                    var ageStartId = $('#ageStartId').val();
                    var ageStartText = 'Age (বয়স) : ' + $('#ageStartId').val();
                    var ageEndId = $('#ageEndId').val();
                    var ageEndText = 'to ' + $('#ageEndId').val();
                    //for yearly Saving
                    var yearlySavingId = $('#yearlySavingId').val();
                    var yearlySavingText = 'Annual Savings (বার্ষিক সঞ্চয়) : ' + $(
                        '#yearlySavingId option:selected').text();
                    //for yearly loan
                    var yearlyLoanId = $('#yearlyLoanId').val();
                    var yearlyLoanText = 'Annual loan(বার্ষিক ঋণ) : ' + $('#yearlyLoanId option:selected')
                        .text();
                    //for deficiency period
                    var deficiencyPeriodId = $('#deficiencyPeriodId').val();
                    var deficiencyPeriodText = 'Livelihood crisis (জীবিকার আপদকাল) : ' + $(
                        '#deficiencyPeriodId option:selected').text();
                    //for annual income limit
                    var annualIncomeStartId = $('#annualIncomeStartId').val();
                    var annualIncomeStartText = 'Annual Income (বার্ষিক আয়) :' + $('#annualIncomeStartId')
                        .val();
                    var annualIncomeEndId = $('#annualIncomeEndId').val();
                    var annualIncomeEndText = 'to ' + $('#annualIncomeEndId').val();
                    //for fishing time
                    var fishingTimeId = $('#fishingTimeId').val();
                    var fishingTimeText = 'Fishing Time (মৎস্য আহরণকাল) : ' + $(
                        '#fishingTimeId option:selected').text();
                    //for placeOfFishing
                    var placeOfFishingId = $('#placeOfFishingId').val();
                    var placeOfFishingText = 'Place Of Fishing (মৎস্য আহরণস্থল) : ' + $(
                        '#placeOfFishingId option:selected').text();
                    //for typesOfFish
                    var typesOfFishId = $('#typesOfFishId').val();
                    var typesOfFishText = 'Types of fish (আহরিত মাছের ধরন) : ' + $(
                        '#typesOfFishId option:selected').text();

                    var fishingEquipmentId = $('#fishingEquipmentId').val();
                    var fishingEquipmentText = 'Fishing Equipment (মাছ ধরার সরঞ্জাম) : ' + $(
                        '#fishingEquipmentId option:selected').text();

                    var fishingTypeId = $('#fishingTypeId').val();
                    var fishingTypeText = 'Types of fishing (মৎস্য আহরণের ধরন) : ' + $(
                        '#fishingTypeId option:selected').text();
                    //   $('#responseArea').css('visibility', 'visible');
                    var ownershipNetId = $('#ownershipNetId').val();
                    var ownershipNetText = 'Ownership of net (জালের মালিকানা) : ' + $(
                        '#ownershipNetId option:selected').text();

                    var typeOfVesselsId = $('#typeOfVesselsId').val();
                    var typeOfVesselsText = 'Type Of Vessels (নৌযানের ধরন) : ' + $(
                        '#typeOfVesselsId option:selected').text();

                    var ownerOfVesselsId = $('#ownerOfVesselsId').val();
                    var ownerOfVesselsText = 'Owner Of Vessels (নৌযানের মালিকানা) : ' + $(
                        '#ownerOfVesselsId option:selected').text();

                    var fishSalePlaceId = $('#fishSalePlaceId').val();
                    var fishSalePlaceText = 'Fish sale place (মাছ বিক্রির স্থান) : ' + $(
                        '#fishSalePlaceId option:selected').text();

                    var priceOfVesselStartId = $('#priceOfVesselStartId').val();
                    var priceOfVesselStartText = 'Price Of Vessels (নৌযানের মূল্য) : ' + $(
                        '#priceOfVesselStartId').val();

                    var priceOfVesselEndId = $('#priceOfVesselEndId').val();
                    var priceOfVesselEndText = 'to' + $('#priceOfVesselEndId').val();

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        url: "{{ route('getMasterReportData') }}",
                        method: 'POST',
                        data: {
                            divisionId: divisionId,
                            districtId: districtId,
                            upazilaId: upazilaId,
                            divisionText: divisionText,
                            districtText: districtText,
                            upazilaText: upazilaText,
                            genderId: genderId,
                            genderText: genderText,
                            religionId: religionId,
                            religionText: religionText,
                            educationId: educationId,
                            educationText: educationText,
                            maritalStatusId: maritalStatusId,
                            maritalStatusText: maritalStatusText,
                            ageStartId: ageStartId,
                            ageStartText: ageStartText,
                            ageEndId: ageEndId,
                            ageEndText: ageEndText,
                            yearlySavingId: yearlySavingId,
                            yearlySavingText: yearlySavingText,
                            yearlyLoanId: yearlyLoanId,
                            yearlyLoanText: yearlyLoanText,
                            deficiencyPeriodId: deficiencyPeriodId,
                            deficiencyPeriodText: deficiencyPeriodText,
                            fishingTimeId: fishingTimeId,
                            fishingTimeText: fishingTimeText,
                            annualIncomeStartId: annualIncomeStartId,
                            annualIncomeStartText: annualIncomeStartText,
                            annualIncomeEndId: annualIncomeEndId,
                            annualIncomeEndText: annualIncomeEndText,
                            placeOfFishingId: placeOfFishingId,
                            placeOfFishingText: placeOfFishingText,
                            typesOfFishId: typesOfFishId,
                            typesOfFishText: typesOfFishText,
                            fishingEquipmentId: fishingEquipmentId,
                            fishingEquipmentText: fishingEquipmentText,
                            fishingTypeId: fishingTypeId,
                            fishingTypeText: fishingTypeText,
                            ownershipNetId: ownershipNetId,
                            ownershipNetText: ownershipNetText,
                            typeOfVesselsId: typeOfVesselsId,
                            typeOfVesselsText: typeOfVesselsText,
                            ownerOfVesselsId: ownerOfVesselsId,
                            ownerOfVesselsText: ownerOfVesselsText,
                            fishSalePlaceId: fishSalePlaceId,
                            fishSalePlaceText: fishSalePlaceText,
                            priceOfVesselStartId: priceOfVesselStartId,
                            priceOfVesselStartText: priceOfVesselStartText,
                            priceOfVesselEndId: priceOfVesselEndId,
                            priceOfVesselEndText: priceOfVesselEndText,
                        },
                        beforeSend: function() {
                            $('#loader').show();
                        },
                        success: function(response) {
                            $('#loader').hide();
                            console.log(response);
                            $('#tableNew').html(response);
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
