@extends('admin.admin')
@section('content')
    <div style="margin: 20px 0px;">
        @include('flash::message')
    </div>
    <div class="body-content">
        <div class="row">
            <div class="col-lg-12 col-md-12 col settings-tab">
                <div class="card">
                    <div class="card-body">
                        <div class="nav master-report-tab" id="tabs">
                            <a class="nav-link" id="tabs_Personal">Area Information <br>(এলাকার তথ্য)</a>&nbsp
                            <a class="nav-link" id="tabs_Family">Personal Information <br>(ব্যাক্তিগত তথ্য)</a>&nbsp
                            <a class="nav-link" id="tabs_Permanent_Address">Financial Information <br>(অর্থনৈতিক
                                তথ্য)</a>&nbsp
                            <a class="nav-link" id="tabs_Present_Address">Professional Information <br>(পেশাগত তথ্য)</a>
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
                                <div class="col-xs-10 col-sm-10 col-md-10">
                                    <div class="form-row">
                                        <div class="col-md-4 mb-3">
                                            <label for="validationDefault03">Division (বিভাগ)</label>
                                            <select class="form-control" id="divisionId" name="divisionId">
                                                <option value="">--Select--</option>
                                                @foreach ($divisions as $divisionList)
                                                    <option value="{{ $divisionList->divisionId }}">
                                                        {{ $divisionList->divisionEng }}
                                                        ({{ $divisionList->divisionBng }})
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="validationDefault04">District (জেলা)</label>
                                            <select class="form-control" name="districtId" id="districtId">
                                                <option value="">--Select--</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="validationDefault05">Upazila (উপজেলা)</label>
                                            <select class="form-control" name="upazilaId" id="upazilaId">
                                                <option value="">--Select--</option>
                                            </select>
                                        </div>
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
                        {{-- <div class="card-footer" style="text-align : center;">
                            <button class="btn btn-primary btn-lg submitBtn" id="">Submit</button>
                        </div> --}}

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
                                        <div class="col-md-3 mb-3">
                                            <label for="validationDefault03">Gender <br>(লিঙ্গ)</label>
                                            <select class="form-control" name="" id="genderId">
                                                <option value="">--Select--</option>
                                                <option value="Male">Male (পুরুষ)</option>
                                                <option value="Female">Female (মহিলা)</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="validationDefault04">Religion <br>(ধর্ম)</label>
                                            <select class="form-control" id="religionId">
                                                <option value="">--Select--</option>
                                                @foreach ($religionList as $religion)
                                                    <option value="{{ $religion->id }}">{{ $religion->religionEnglish }}
                                                        ({{ $religion->religionBangla }})
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="validationDefault05">Educational Qualifications <br> (শিক্ষাগত
                                                যোগ্যতা)</label>
                                            <select class="form-control" name="" id="educationId">
                                                <option value="">--Select--</option>
                                                @foreach ($educationList as $education)
                                                    <option value="{{ $education->id }}">
                                                        {{ $education->educationalQualificationEng }}
                                                        ({{ $education->educationalQualificationBng }})
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="validationDefault05">Marital Status <br>(বৈবাহিক অবস্থা)</label>
                                            <select class="form-control" name="" id="maritalStatusId">
                                                <option value="">--Select--</option>
                                                @foreach ($maritalStatusList as $maritalStatus)
                                                    <option value="{{ $maritalStatus->id }}">
                                                        {{ $maritalStatus->maritalStatusEng }}
                                                        ({{ $maritalStatus->maritalStatusBng }})
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="validationDefault05">From Age</label>
                                            <input type="text" class="form-control" id="validationDefault01"
                                                placeholder="First name" value="Mark" required>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="validationDefault05">To Age</label>
                                            <input type="text" class="form-control" id="validationDefault01"
                                                placeholder="First name" value="Mark" required>
                                        </div>
                                    </div>
                                    <div class="form-row personalInfoTextShow" id="personalInfoTextShow">
                                        <h6 class="fs-17 font-weight"></h6>
                                    </div>

                                </div>
                            </div>
                        </div>
                        {{-- <div class="card-footer" style="text-align : center;">
                            <button class="btn btn-primary btn-lg submitBtn">Submit</button>
                        </div> --}}
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
                                        <div class="col-md-4 mb-3">
                                            <label for="validationDefault05">Annual Income (বার্ষিক আয়)</label>
                                            <select class="form-control" name="" id="yearlySavingId">
                                                <option value="">--Select--</option>
                                                @foreach ($yearlySavingList as $yearlySaving)
                                                    <option value="{{ $yearlySaving->id }}">
                                                        {{ $yearlySaving->yearlySavingEng }}
                                                        ({{ $yearlySaving->yearlySavingBng }})
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="validationDefault05">Annual loan(বার্ষিক ঋণ)</label>
                                            <select class="form-control" name="" id="yearlyLoanId">
                                                <option value="">--Select--</option>
                                                @foreach ($yearlyLoanList as $yearlyLoan)
                                                    <option value="{{ $yearlyLoan->id }}">
                                                        {{ $yearlyLoan->yearlyLoanEng }}
                                                        ({{ $yearlyLoan->yearlyLoanBng }})
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="validationDefault05">Livelihood crisis (জীবিকার আপদকাল)</label>
                                            <select class="form-control" name="" id="deficiencyPeriodId">
                                                <option value="">--Select--</option>
                                                @foreach ($deficiencyPeriodList as $deficiencyPeriod)
                                                    <option value="{{ $deficiencyPeriod->id }}">
                                                        {{ $deficiencyPeriod->deficiencyPeriodEng }}
                                                        ({{ $deficiencyPeriod->deficiencyPeriodBng }})
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="validationDefault05">Annual Income(From)</label>
                                            <select class="form-control" name="" id="">
                                                <option value="">---Select Status---</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="validationDefault05">Annual Income(To)</label>
                                            <select class="form-control" name="" id="">
                                                <option value="">---Select Status---</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row financialInfoTextShow">
                                        <h6 class="fs-17 font-weight"></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="card-footer" style="text-align : center;">
                            <button class="btn btn-primary btn-lg submitBtn">Submit</button>
                        </div> --}}
                    </div>
                </div>
                <div class="tab-container" id="tabs_Present_AddressC">
                    <div class="card mb-4">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="fs-17 font-weight-600 mb-0 text-edit">Professional Information (বর্তমান
                                        ঠিকানা)</h6>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-row">
                                        <div class="col-md-3 mb-3">
                                            <label for="validationDefault03">Fishing Time Based <br> (মৎস্য আহরণকাল ভিত্তিক)</label>
                                            <select class="form-control" name="" id="fishingTimeId">
                                                <option value="">--Select--</option>
                                                @foreach ($timeOfFishingList as $timeOfFishing)
                                                <option value="{{ $timeOfFishing->id }}">
                                                    {{ $timeOfFishing->timeOfFishingEng }}
                                                    ({{ $timeOfFishing->timeOfFishingBng }})
                                                </option>
                                            @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="validationDefault04">Fishing grounds</label>
                                            <select class="form-control" name="" id="">
                                                <option value="">---Select Status---</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="validationDefault05">Types of fish caught</label>
                                            <select class="form-control" name="" id="">
                                                <option value="">---Select Status---</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="validationDefault05">Types of fishing equipment</label>
                                            <select class="form-control" name="" id="">
                                                <option value="">---Select Status---</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="validationDefault05">Net ownership(জালের মালিকানা)</label>
                                            <select class="form-control" name="" id="">
                                                <option value="">---Select Status---</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="validationDefault05">Types of vessels</label>
                                            <select class="form-control" name="" id="">
                                                <option value="">---Select Status---</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="validationDefault05">Ownership of the vessel</label>
                                            <select class="form-control" name="" id="">
                                                <option value="">---Select Status---</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="validationDefault05">Fish Market</label>
                                            <select class="form-control" name="" id="">
                                                <option value="">---Select Status---</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="validationDefault05">Vessel Price(From)</label>
                                            <select class="form-control" name="" id="">
                                                <option value="">---Select Status---</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="validationDefault05">Vessel Price(To)</label>
                                            <select class="form-control" name="" id="">
                                                <option value="">---Select Status---</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row professionalTextShow">
                                        <h6 class="fs-17 font-weight"></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="card-footer" style="text-align : center;">
                            <button class="btn btn-primary btn-lg submitBtn">Submit</button>
                        </div> --}}
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
                    console.log(t);
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
                    var divisionId = $(this).val();
                    if (!divisionId == '') {
                        var divisionText = 'Division (বিভাগ) :' + $('#divisionId option:selected').text();
                    } else {
                        var divisionText = '';
                    }
                    $('#areaTextShow').html(divisionText);
                    $('#districtId').val('');
                    $('#upazilaId').val('');
                    $('#areaId').val('');
                    let value = $(this).children("option:selected").val();
                    $.get('{{ url('/') }}/get-district-list/' + value, function(response) {
                        $('#districtId').html(response);
                    })
                });
                $('#districtId').on('change', function() {
                    var divisionText = $('#divisionId option:selected').text();
                    var districtText = $('#districtId option:selected').text();
                    var districtId = $(this).val();
                    if (!districtId == '') {
                        var textData = ('Division (বিভাগ) :' + divisionText) + ('<br> District (জেলা) : ' +
                            districtText);
                    } else {
                        var textData = 'Division (বিভাগ) :' + divisionText;
                    }

                    $('#areaTextShow').html(textData);
                    $('#upazilaId').val('');
                    $('#areaId').val('');
                    let value = $(this).children("option:selected").val();
                    $.get('{{ url('/') }}/get-upazila-list/' + value, function(response) {
                        $('#upazilaId').html(response);
                        $('#areaId').html();
                    })
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

                $('#genderId,#religionId,#educationId,#maritalStatusId').on('change', function() {
                    var genderId = $('#genderId').val();
                    var religionId = $('#religionId').val();
                    var educationId = $('#educationId').val();
                    var maritalStatusId = $('#maritalStatusId').val();
                    if (!genderId == '') {
                        var genderText = 'Gender (লিঙ্গ) : ' + $('#genderId option:selected').text();
                    } else {
                        var genderText = '';
                    }
                    if (!religionId == '') {
                        var religionText = 'Religion (ধর্ম) : ' + $('#religionId option:selected').text();
                    } else {
                        var religionText = '';
                    }
                    if (!educationId == '') {
                        var educationText = 'Educational Qualification (শিক্ষাগত যোগ্যতা) : ' + $(
                            '#educationId option:selected').text();
                    } else {
                        var educationText = '';
                    }
                    if (!maritalStatusId == '') {
                        var maritalStatusText = 'Marital Status (বৈবাহিক অবস্থা) : ' + $(
                            '#maritalStatusId option:selected').text();
                    } else {
                        var maritalStatusText = '';
                    }
                    $('.personalInfoTextShow').html(genderText + '<br>' + religionText + '<br>' +
                        educationText + '<br>' + maritalStatusText);
                });
                $('#yearlySavingId,#yearlyLoan,#deficiencyPeriodId').on('change', function() {
                    var yearlySavingId = $('#yearlySavingId').val();
                    if (!yearlySavingId == '') {
                        var yearlySavingText = 'Annual Income (বার্ষিক আয়) : ' + $(
                            '#yearlySavingId option:selected').text();
                    } else {
                        var yearlySavingText = '';
                    }
                    var yearlyLoanId = $('#yearlyLoanId').val();
                    if (!yearlyLoanId == '') {
                        var yearlyLoanText = 'Annual loan(বার্ষিক ঋণ) : ' + $('#yearlyLoanId option:selected')
                            .text();
                    } else {
                        var yearlyLoanText = '';
                    }
                    var deficiencyPeriodId = $('#deficiencyPeriodId').val();
                    if (!deficiencyPeriodId == '') {
                        var deficiencyPeriodText = 'Livelihood crisis (জীবিকার আপদকাল) : ' + $(
                            '#deficiencyPeriodId option:selected').text();
                    } else {
                        var deficiencyPeriodText = '';
                    }
                    var fishingTimeId = $('#fishingTimeId').val();
                    if (!fishingTimeId == '') {
                        var fishingTimeText = 'Fishing Time (মৎস্য আহরণকাল) : ' + $(
                            '#fishingTimeId option:selected').text();
                    } else {
                        var fishingTimeText = '';
                    }
                    $('.financialInfoTextShow').html(yearlySavingText + '<br>' + yearlyLoanText + '<br>' +
                        deficiencyPeriodText);
                });
                $('#fishingTimeId').on('change', function() {
                    var fishingTimeId = $('#fishingTimeId').val();
                    if (!fishingTimeId == '') {
                        var fishingTimeText = 'Fishing Time (মৎস্য আহরণকাল) : ' + $(
                            '#fishingTimeId option:selected').text();
                    } else {
                        var fishingTimeText = '';
                    }
                    $('.professionalTextShow').html(fishingTimeText);
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
                    alert(genderId);
                    return
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
                    //for yearly Saving
                    var yearlySavingId = $('#yearlySavingId').val();
                    var yearlySavingText = 'Annual Income (বার্ষিক আয়) : ' + $(
                        '#yearlySavingId option:selected').text();
                    //for yearly loan
                    var yearlyLoanId = $('#yearlyLoanId').val();
                    var yearlyLoanText = 'Annual loan(বার্ষিক ঋণ) : ' + $('#yearlyLoanId option:selected')
                    .text();
                    //for deficiency period
                    var deficiencyPeriodId = $('#deficiencyPeriodId').val();
                    var deficiencyPeriodText = 'Livelihood crisis (জীবিকার আপদকাল) : ' + $(
                        '#deficiencyPeriodId option:selected').text();
                    //for fishing time
                    var fishingTimeId = $('#fishingTimeId').val();
                    var fishingTimeText = 'Fishing Time (মৎস্য আহরণকাল) : ' + $(
                        '#fishingTimeId option:selected').text();

                 //   $('#responseArea').css('visibility', 'visible');
                    $.ajax({
                        url: "{{ route('getMasterReportData') }}",
                        method: 'GET',
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
                            yearlySavingId: yearlySavingId,
                            yearlySavingText: yearlySavingText,
                            yearlyLoanId: yearlyLoanId,
                            yearlyLoanText: yearlyLoanText,
                            deficiencyPeriodId: deficiencyPeriodId,
                            deficiencyPeriodText: deficiencyPeriodText,
                            fishingTimeId: fishingTimeId,
                            fishingTimeText: fishingTimeText,
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
