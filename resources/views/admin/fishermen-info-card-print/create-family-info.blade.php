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
                    <a href="#step-2" type="button" class="btn btn-success btn-circle">2</a>
                    <p class="text-style"><small>Family Information (পারিবারিক তথ্য)</small></p>
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
        <form id="family-info-form" action="{{ route('storeFishermenFamilyInformation') }}" method="post">
            @csrf
            <div class="card mb-4" id="stepOne">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="fs-17 font-weight-600 mb-0 text-edit">Family Information (পারিবারিক তথ্য)</h6>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 p-l-30 p-r-30 left-side">
                            <div class="form-group">
                                <label class="font-weight-600">Mother's Name (মাতার নাম)<span class="required-css">*</span></label>
                                <input type="text" class="form-control" name="mothersName"
                                    value="{{ $fishermenFamilyInfoCard->mothersName ?? old('mothersName') }}"
                                    placeholder="Mother's Name" required>
                                @if ($errors->has('mothersName'))
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="font-weight-600">Father's Name (পিতার নাম)<span class="required-css">*</span></label>
                                <input type="text" class="form-control" name="fathersName"
                                    value="{{ $fishermenFamilyInfoCard->mothersName ?? old('fathersName') }}"
                                    placeholder="Father's Name" required>
                                @if ($errors->has('fathersName'))
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1" class="font-weight-600">Marital Status (বৈবাহিক
                                    অবস্থা)<span class="required-css">*</span></label>
                                <select class="form-control" name="maritalStatus" required>
                                    <option value="">Select</option>
                                    @foreach ($maritalStatusList as $marital)
                                        @if ($familyInfoSessionData['stats_maritalStatus'] == $marital->id ?? old('maritalStatus') == $marital->id)
                                            <option value="{{ $marital->id }}" selected>
                                                {{ $marital->maritalStatusEng }} ({{ $marital->maritalStatusBng }})
                                            </option>
                                        @else
                                            <option value="{{ $marital->id }}">
                                                {{ $marital->maritalStatusEng }} ({{ $marital->maritalStatusBng }})
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('religion')
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-600">Spouse Name (স্বামী/স্ত্রীর নাম)</label>
                                <input type="text" class="form-control" name="spouseName"
                                    value="{{ $fishermenFamilyInfoCard->spouseName ?? old('spouseName') }}"
                                    placeholder="Spouse Name">
                                @if ($errors->has('spouseName'))
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @endif
                            </div>

                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 p-l-30 p-r-30">
                            <div class="alert2 alert-danger" id="family-member-alert">
                                Summation of Mother's number, Father's number, Number of spouse, Number of daughters, Number of sons and Others <span class="alert-link">must be less than Total family members </span>
                            </div>
                            <div class="form-group familymember-has-error">
                                <label class="font-weight-600">Total family members (পরিবারের মোট সদস্য
                                    সংখ্যা)<span class="required-css">*</span></label>
                                <input type="text"
                                    onkeypress="return /\d/.test(String.fromCharCode(((event||window.event).which||(event||window.event).which)));"
                                    class="form-control" max="30" name="totalFamilyMember" id="totalFamilyMember"
                                    value="{{ $familyInfoSessionData['stats_totalFamilyMember'] ?? old('totalFamilyMember') }}"
                                    placeholder="Total family members" required>
                                @if ($errors->has('totalFamilyMember'))
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-6 mb-4">
                                        <label for="validationCustom01" class="font-weight-600">Mother's number (মায়ের
                                            সংখ্যা)</label>
                                        <input type="text"
                                            onkeypress="return /\d/.test(String.fromCharCode(((event||window.event).which||(event||window.event).which)));"
                                            min="0" class="form-control" name="numberOfMother" id="numberOfMother"
                                            value="{{ $familyInfoSessionData['stats_numberOfMother'] ?? old('numberOfMother') }}"
                                            placeholder="Number">
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label for="validationCustom01" class="font-weight-600">Father's number (পিতার
                                            সংখ্যা)</label>
                                        <input type="text"
                                            onkeypress="return /\d/.test(String.fromCharCode(((event||window.event).which||(event||window.event).which)));"
                                            min="0" class="form-control" name="numberOfFather" id="numberOfFather"
                                            value="{{ $familyInfoSessionData['stats_numberOfFather'] ?? old('numberOfFather') }}"
                                            placeholder="Number">
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label for="validationCustom01" class="font-weight-600">Number of spouse
                                            (স্বামী/স্ত্রী সংখ্যা)</label>
                                        <input type="text"
                                            onkeypress="return /\d/.test(String.fromCharCode(((event||window.event).which||(event||window.event).which)));"
                                            min="0" class="form-control" name="numberOfSpouse" id="numberOfSpouse"
                                            value="{{ $familyInfoSessionData['stats_numberOfSpouse'] ?? old('numberOfSpouse') }}"
                                            placeholder="Number">
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label for="validationCustom01" class="font-weight-600">Number of daughters (কন্যা
                                            সংখ্যা)</label>
                                        <input type="text"
                                            onkeypress="return /\d/.test(String.fromCharCode(((event||window.event).which||(event||window.event).which)));"
                                            min="0" class="form-control" name="numberOfDaughter" id="numberOfDaughter"
                                            value="{{ $familyInfoSessionData['stats_numberOfDaughter'] ?? old('numberOfDaughter') }}"
                                            placeholder="Number">
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label for="validationCustom01" class="font-weight-600">Number of sons (পুত্র
                                            সংখ্যা)</label>
                                        <input type="text"
                                            onkeypress="return /\d/.test(String.fromCharCode(((event||window.event).which||(event||window.event).which)));"
                                            min="0" class="form-control" name="numberOfSon" id="numberOfSon"
                                            value="{{ $familyInfoSessionData['stats_numberOfSon'] ?? old('numberOfSon') }}"
                                            placeholder="Number">
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label for="validationCustom01" class="font-weight-600">Others (অন্যান্য)</label>
                                        <input type="text"
                                            onkeypress="return /\d/.test(String.fromCharCode(((event||window.event).which||(event||window.event).which)));"
                                            min="0" class="form-control" name="numberOfOtherMember" id="numberOfOtherMember"
                                            value="{{ $familyInfoSessionData['stats_numberOfOtherMember'] ?? old('numberOfOtherMember') }}"
                                            placeholder="Number">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6 p-l-30 p-r-30 text-left">
                            <a type="button" href="{{ route('createFishermenPersonalInformation') }}"
                                class="btn btn-danger"><i class="typcn typcn-arrow-left-thick mr-2"></i> Back</a>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 p-l-30 p-r-30 text-right">
                            <button type="submit" id="submit-button" class="btn btn-success mr-1">Submit and Next <i
                                    class="typcn typcn-arrow-right-thick ml-2"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    @push('js')
        <script>
            $(document).ready(function() {
                // for less Than 
                $.validator.addMethod("lessThan", function(value, element, param) {
                    var target = $(param);

                    if (this.settings.onfocusout && target.not(".validate-lessThan-blur").length) {
                        target.addClass("validate-lessThan-blur").on("blur.validate-lessThan",
                            function() {
                                $(element).valid();
                            });
                    }

                    var referenceValue = target.val();
                    if ($.isNumeric(value) && $.isNumeric(referenceValue)) {
                        value = parseFloat(value);
                        referenceValue = parseFloat(referenceValue);
                        return value < referenceValue;
                    }

                    return value < target.val();
                }, "Please enter a value less than to total family members");
                // for letter
                $.validator.addMethod("lettersonly", function(value, element) {
                    return this.optional(element) || /^[a-zA-z\s]+$/i.test(value);
                }, "Please enter only alphabet");
                $("#family-info-form").validate({

                    rules: {
                        mothersName: {
                            required: true,
                            // lettersonly: true,
                            minlength: 2
                        },
                        fathersName: {
                            required: true,
                            // lettersonly: true,
                            minlength: 2
                        },
                        spouseName: {
                            // lettersonly: true,
                            minlength: 2
                        },
                        totalFamilyMember: {
                            required: true,
                            number: true,
                            max: 30
                        },
                        numberOfMother: {
                            number: true,
                            lessThan: "#totalFamilyMember"
                        },
                        numberOfFather: {
                            number: true,
                            lessThan: "#totalFamilyMember"
                        },
                        numberOfSpouse: {
                            number: true,
                            lessThan: "#totalFamilyMember"
                        },
                        numberOfDaughter: {
                            number: true,
                            lessThan: "#totalFamilyMember"
                        },
                        numberOfSon: {
                            number: true,
                            lessThan: "#totalFamilyMember"
                        },
                        numberOfOtherMember: {
                            number: true,
                            lessThan: "#totalFamilyMember"
                        }
                    }
                });
            });
        </script>
        <script>
            $('#family-member-alert').hide();
            $(document).ready(function() {
                $('#totalFamilyMember,#numberOfMother,#numberOfFather,#numberOfSpouse,#numberOfDaughter,#numberOfSon,#numberOfOtherMember')
                    .on('input', function() {
                        var totalFamilyMember = $('#totalFamilyMember').val();
                        var numberOfMother = $('#numberOfMother').val() || 0;
                        var numberOfFather = $('#numberOfFather').val() || 0;
                        var numberOfSpouse = $('#numberOfSpouse').val() || 0;
                        var numberOfDaughter = $('#numberOfDaughter').val() || 0;
                        var numberOfSon = $('#numberOfSon').val() || 0;
                        var numberOfOtherMember = $('#numberOfOtherMember').val() || 0;
                        var sum = parseInt(numberOfMother) + parseInt(numberOfFather) + parseInt(numberOfSpouse) +
                            parseInt(numberOfDaughter) + parseInt(numberOfSon) + parseInt(numberOfOtherMember);
                        // var getTotal = parseInt(totalFamilyMember) - parseInt(sum);
                        // console.log(totalFamilyMember);
                        // console.log(sum);
                        if (sum > totalFamilyMember) {
                            $("#submit-button").hide();
                            $("#family-member-alert").show();

                        }
                        if (sum < totalFamilyMember) {
                            $("#submit-button").show();
                            $("#family-member-alert").hide();

                        }
                    });
            });
        </script>
    @endpush
@endsection
