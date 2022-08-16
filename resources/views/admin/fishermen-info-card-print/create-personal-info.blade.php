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
                    <h1 class="font-weight-bold">Add Fishers</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-4 text-right  p-0">
            <a href="{{ route('getAllFishersInfo') }}" class="btn btn-success mb-2 mr-1">
                <i class="typcn typcn-arrow-back mr-2"></i>Back</a>
        </div>
    </div>

    <div class="body-content">
        <div class="stepwizard">
            <div class="stepwizard-row setup-panel">
                <div class="stepwizard-step col-xs-3">
                    <a href="#step-1" type="button" class="btn btn-success btn-circle">1</a>
                    <p class="text-style"><small>Personal Information (ব্যক্তিগত তথ্য)</small></p>
                </div>
                <div class="stepwizard-step col-xs-3">
                    <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
                    <p><small>Family Information (পারিবারিক তথ্য)</small></p>
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
        <form id="personal-info-form" action="{{ route('storeFishermenPersonalInformation') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card mb-4">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="fs-17 font-weight-600 mb-0 text-edit">Personal Information (ব্যক্তিগত তথ্য)</h6>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 p-l-30 p-r-30 left-side">
                            <div class="form-group">
                                <label class="font-weight-600">Form No (ফর্ম নম্বর)<span class="required-css">*</span></label>
                                <input type="text" onkeypress="return /\d/.test(String.fromCharCode(((event||window.event).which||(event||window.event).which)));" class="form-control" name="formId"
                                    value="{{ $sessionData->formId ?? old('formId') }}" maxlength="7" placeholder="Form Id">
                                {{-- @if ($errors->has('formId'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('formId') }}
                                    </div>
                                @endif --}}
                                @error('formId')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-600">English Name (ইংরেজি নাম)<span class="required-css">*</span></label>
                                <input type="text" class="form-control" name="fishermanNameEng"
                                    value="{{ $sessionData->fishermanNameEng ?? old('fishermanNameEng') }}"
                                    placeholder="English Name">
                                @if ($errors->has('fishermanNameEng'))
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label class="font-weight-600">Bangla Name (বাংলা নাম)<span class="required-css">*</span></label>
                                <input type="text" id="input-area" class="form-control" name="fishermanNameBng"
                                    value="{{ $sessionData->fishermanNameBng ?? old('fishermanNameBng') }}"
                                    placeholder="Bangla Name">
                                @if ($errors->has('fishermanNameBng'))
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="font-weight-600">Picture (ছবি)<span class="required-css">*</span></label>
                                <input type="file" class="form-control" name="photoPath" accept="image/*">
                                @if ($errors->has('photoPath'))
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="font-weight-600">National Id No (জাতীয় পরিচয়পত্র নং)<span class="required-css">*</span></label>
                                <input type="text" onkeypress="return /\d/.test(String.fromCharCode(((event||window.event).which||(event||window.event).which)));" class="form-control" name="nationalIdNo"
                                    value="{{ $sessionData->nationalIdNo ?? old('nationalIdNo') }}"
                                    placeholder="National Id No" min="0" maxlength="17">
                                @if ($errors->has('nationalIdNo'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('nationalIdNo') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="font-weight-600">Mobile number (মোবাইল নম্বর)<span class="required-css">*</span></label>
                                <input type="text" onkeypress="return /\d/.test(String.fromCharCode(((event||window.event).which||(event||window.event).which)));" class="form-control" min="0" name="mobile"
                                    value="{{ $personalInfoSessionData['stats_mobile'] ?? old('mobile') }}" maxlength="11"
                                    placeholder="Mobile number">
                                @if ($errors->has('mobile'))
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group radio-has-error">
                                <label class="font-weight-600 mr-3">Gender (লিঙ্গ)<span class="required-css">*</span></label> <br>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="customRadioInline1" name="gender" class="custom-control-input"
                                        value="Male" @if ($sessionData->gender ?? ('' == 'Male' ?? old('gender') == 'Male')) checked @endif>
                                    <label class="custom-control-label" for="customRadioInline1">Male</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="customRadioInline2" name="gender" class="custom-control-input"
                                        value="Female" @if ($sessionData->gender ?? ('' == 'Female' ?? old('gender') == 'Female')) checked @endif>
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
                                <label for="exampleFormControlSelect1" class="font-weight-600">Religion (ধর্ম)<span class="required-css">*</span></label>
                                <select class="form-control" name="religion">
                                    <option value="">Select Religion</option>
                                    @foreach ($religionList as $religion)
                                        @if ($personalInfoSessionData['stats_religion'] == $religion->id ?? old('religion') == $religion->id)
                                            <option value="{{ $religion->id }}" selected>
                                                {{ $religion->religionEnglish }} ({{ $religion->religionBangla }})
                                            </option>
                                        @else
                                            <option value="{{ $religion->id }}">
                                                {{ $religion->religionEnglish }} ({{ $religion->religionBangla }})
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
                            <div class="form-group  has-error">
                                <label class="font-weight-600">Place Of Birth (জন্মস্থান)<span class="required-css">*</span></label>
                                <select class="form-control js-example-basic-single select2" name="placeOfBirth">
                                    <option value="">Select</option>
                                    @foreach ($districtList as $district)
                                        @if ($personalInfoSessionData['stats_placeOfBirth'] == $district->districtId ?? old('placeOfBirth') == $district->districtId)
                                            <option value="{{ $district->districtId }}" selected>
                                                {{ $district->districtEng }} ({{ $district->districtBng }})
                                            </option>
                                        @else
                                            <option value="{{ $district->districtId }}">
                                                {{ $district->districtEng }} ({{ $district->districtBng }})
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                                @if ($errors->has('	placeOfBirth'))
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <fieldset class="fieldset-border">
                                    <legend class="legend-border">Date of Birth* (জন্ম তারিখ)</legend>

                                    <div class="form-row">
                                        <div class="col-md-4 mb-3">
                                            <label class="font-weight-600">Day (দিন)<span class="required-css">*</span></label>
                                            <select id="dateOfBirthDay" name="dateOfBirthDay" class="form-control"
                                               >
                                                <option value="">Select</option>
                                                @for ($birthDay = 01; $birthDay <= 31; $birthDay++)
                                                    @if (isset($sessionData->dateOfBirth))
                                                        <option value="{{ $birthDay }}"
                                                            {{ date('d', strtotime($sessionData->dateOfBirth)) == $birthDay ? 'selected' : '' }}>
                                                            {{ $birthDay }}</option>
                                                    @else
                                                        <option value="{{ $birthDay }}"
                                                            {{ old('dateOfBirthDay') == $birthDay ? 'selected' : '' }}>
                                                            {{ $birthDay }}</option>
                                                    @endif
                                                @endfor
                                            </select>
                                            @error('dateOfBirthDay')
                                                <div class="invalid-feedback">
                                                    {{ 'This field is required' }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="font-weight-600">Month (মাস)<span class="required-css">*</span></label>
                                            <select name="dateOfBirthMonth" class="form-control">
                                                <option value="">Select</option>
                                                @if (isset($sessionData->dateOfBirth))
                                                    <option value="01"
                                                        {{ date('m', strtotime($sessionData->dateOfBirth)) == '01' ? 'selected' : '' }}>
                                                        January</option>
                                                    <option value="02"
                                                        {{ date('m', strtotime($sessionData->dateOfBirth)) == '02' ? 'selected' : '' }}>
                                                        February</option>
                                                    <option value="03"
                                                        {{ date('m', strtotime($sessionData->dateOfBirth)) == '03' ? 'selected' : '' }}>
                                                        March</option>
                                                    <option value="04"
                                                        {{ date('m', strtotime($sessionData->dateOfBirth)) == '04' ? 'selected' : '' }}>
                                                        April</option>
                                                    <option value="05"
                                                        {{ date('m', strtotime($sessionData->dateOfBirth)) == '05' ? 'selected' : '' }}>
                                                        May</option>
                                                    <option value="06"
                                                        {{ date('m', strtotime($sessionData->dateOfBirth)) == '06' ? 'selected' : '' }}>
                                                        June</option>
                                                    <option value="07"
                                                        {{ date('m', strtotime($sessionData->dateOfBirth)) == '07' ? 'selected' : '' }}>
                                                        July</option>
                                                    <option value="08"
                                                        {{ date('m', strtotime($sessionData->dateOfBirth)) == '08' ? 'selected' : '' }}>
                                                        August</option>
                                                    <option value="09"
                                                        {{ date('m', strtotime($sessionData->dateOfBirth)) == '09' ? 'selected' : '' }}>
                                                        September</option>
                                                    <option value="10"
                                                        {{ date('m', strtotime($sessionData->dateOfBirth)) == '10' ? 'selected' : '' }}>
                                                        October</option>
                                                    <option value="11"
                                                        {{ date('m', strtotime($sessionData->dateOfBirth)) == '11' ? 'selected' : '' }}>
                                                        November</option>
                                                    <option value="12"
                                                        {{ date('m', strtotime($sessionData->dateOfBirth)) == '12' ? 'selected' : '' }}>
                                                        December</option>
                                                @else
                                                    <option value="01"
                                                        {{ old('dateOfBirthMonth') == '01' ? 'selected' : '' }}>
                                                        January</option>
                                                    <option value="02"
                                                        {{ old('dateOfBirthMonth') == '02' ? 'selected' : '' }}>
                                                        February</option>
                                                    <option value="03"
                                                        {{ old('dateOfBirthMonth') == '03' ? 'selected' : '' }}>
                                                        March</option>
                                                    <option value="04"
                                                        {{ old('dateOfBirthMonth') == '04' ? 'selected' : '' }}>
                                                        April</option>
                                                    <option value="05"
                                                        {{ old('dateOfBirthMonth') == '05' ? 'selected' : '' }}>
                                                        May</option>
                                                    <option value="06"
                                                        {{ old('dateOfBirthMonth') == '06' ? 'selected' : '' }}>
                                                        June</option>
                                                    <option value="07"
                                                        {{ old('dateOfBirthMonth') == '07' ? 'selected' : '' }}>
                                                        July</option>
                                                    <option value="08"
                                                        {{ old('dateOfBirthMonth') == '08' ? 'selected' : '' }}>
                                                        August</option>
                                                    <option value="09"
                                                        {{ old('dateOfBirthMonth') == '09' ? 'selected' : '' }}>
                                                        September</option>
                                                    <option value="10"
                                                        {{ old('dateOfBirthMonth') == '10' ? 'selected' : '' }}>
                                                        October</option>
                                                    <option value="11"
                                                        {{ old('dateOfBirthMonth') == '11' ? 'selected' : '' }}>
                                                        November</option>
                                                    <option value="12"
                                                        {{ old('dateOfBirthMonth') == '12' ? 'selected' : '' }}>
                                                        December</option>
                                                @endif
                                            </select>
                                            @error('dateOfBirthMonth')
                                                <div class="invalid-feedback">
                                                    {{ 'This field is required' }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            @php
                                                $getYear = now()->year;
                                            @endphp
                                            <label class="font-weight-600">Year (বছর)<span class="required-css">*</span></label>
                                            <select name="dateOfBirthYear" class="form-control">
                                                <option value="">Select</option>
                                                @for ($year = 1940; $year <= $getYear; $year++)
                                                    @if (isset($sessionData->dateOfBirth))
                                                        <option value="{{ $year }}"
                                                            {{ date('Y', strtotime($sessionData->dateOfBirth)) == $year ? 'selected' : '' }}>
                                                            {{ $year }}</option>
                                                    @else
                                                        <option value="{{ $year }}"
                                                            {{ old('dateOfBirthYear') == $year ? 'selected' : '' }}>
                                                            {{ $year }}</option>
                                                    @endif
                                                @endfor
                                            </select>
                                            @error('dateOfBirthYear')
                                                <div class="invalid-feedback">
                                                    {{ 'This field is required' }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </fieldset>
                            </div>


                            <div class="form-group">
                                <label class="font-weight-600">Educational Qualifications (শিক্ষাগত যোগ্যতা)<span class="required-css">*</span></label>
                                <select class="form-control" name="education">
                                    <option value="">Select</option>
                                    @foreach ($educationList as $education)
                                        @if ($personalInfoSessionData['stats_education'] == $education->id ?? old('education') == $education->id)
                                            <option value="{{ $education->id }}" selected>
                                                {{ $education->educationalQualificationEng }}
                                                ({{ $education->educationalQualificationBng }})
                                            </option>
                                        @else
                                            <option value="{{ $education->id }}">
                                                {{ $education->educationalQualificationEng }}
                                                ({{ $education->educationalQualificationBng }})
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                                @if ($errors->has('education'))
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="font-weight-600">Visible Identification Marks (দৃশ্যমান সনাক্তকরণ
                                    চিহ্ন)</label>
                                <input type="text" class="form-control" id="input-area-two" name="identificationMark"
                                    value="{{ $personalInfoSessionData['stats_identificationMark'] ?? old('identificationMark') }}"
                                    placeholder="Visible Identification Marks">
                                @if ($errors->has('identificationMark'))
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-success mr-1" id="stepOneSubmit">Submit and Next<i
                            class="typcn typcn-arrow-right-thick ml-2"></i></button>
                    {{-- <button type="button" class="btn btn-danger">Cancel</button> --}}
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
                $("#personal-info-form").validate({

                    rules: {
                        formId: {
                            required: true,
                            number: true,
                            minlength: 6,
                            maxlength: 7
                        },
                        fishermanNameEng: {
                            required: true,
                            lettersonly: true,
                            minlength: 2
                        },
                        nationalIdNo: {
                            required: true,
                            number: true,
                            minlength: 10,
                            maxlength: 17
                        },
                        placeOfBirth: {
                            required: true,
                            minlength: 0
                        },
                        mobile: {
                            number: true,
                            minlength: 11,
                            maxlength: 11
                        }
                    }
                });
            });
        </script>
    @endpush
@endsection
