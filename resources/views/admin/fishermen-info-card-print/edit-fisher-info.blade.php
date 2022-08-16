@extends('admin.admin')
@section('content')
    <div style="margin: 20px 0px;">
        @include('flash::message')
    </div>
    <div class="content-header row align-items-center m-0">

        <div class="col-sm-8 header-title p-0">
            <div class="media">

                <div class="media-body">
                    <h1 class="font-weight-bold">Update Fisher Information</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-4 text-right  p-0">
            <a href="{{ url()->previous() }}" class="btn btn-success mb-2 mr-1">
                <i class="typcn typcn-arrow-back mr-2"></i>Back</a>
        </div>
    </div>

    <div class="body-content">
        <div class="row">
            <div class="col-lg-3 col-md-3 col settings-tab">
                <div class="card">
                    <div class="card-body">
                        <div class="nav flex-column" id="tabs">

                            <a class="nav-link" id="tabs_Personal">Personal Information <br>(ব্যক্তিগত তথ্য)</a>
                            <a class="nav-link" id="tabs_Family">Family Information <br>(পারিবারিক তথ্য)</a>
                            <a class="nav-link" id="tabs_Address">Address <br>(ঠিকানা)</a>
                            <a class="nav-link" id="tabs_Fishing">Fishing Information <br>(মাছ ধরার তথ্য)</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-9 col">

                <div class="card tab-container" id="tabs_PersonalC">

                    <form id="edit-info-form" action="{{ route('updateFisherInfo') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $data->id }}">
                        <div class="card mb-4">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="fs-17 font-weight-600 mb-0 text-edit">Personal Information (ব্যক্তিগত
                                            তথ্য)</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-6 p-l-30 p-r-30 left-side">
                                        <div class="form-group">
                                            <label class="font-weight-600">Form No (ফর্ম নম্বার)</label>
                                            <input type="text"
                                                onkeypress="return /\d/.test(String.fromCharCode(((event||window.event).which||(event||window.event).which)));"
                                                class="form-control" name="formId" value="{{ $data->formId ?? '' }}"
                                                placeholder="Form Id" min="0" maxlength="7" required>
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
                                            <label class="font-weight-600">English Name (ইংরেজি নাম)</label>
                                            <input type="text" class="form-control" name="fishermanNameEng"
                                                value="{{ $data->fishermanNameEng ?? '' }}" placeholder="English Name"
                                                required>
                                            @if ($errors->has('fishermanNameEng'))
                                                <div class="invalid-feedback">
                                                    {{ 'This field is required' }}
                                                </div>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label class="font-weight-600">Bangla Name (বাংলা নাম)</label>
                                            <input type="text" id="input-area" class="form-control"
                                                name="fishermanNameBng" value="{{ $data->fishermanNameBng ?? '' }}"
                                                placeholder="Bangla Name" required>
                                            @if ($errors->has('fishermanNameBng'))
                                                <div class="invalid-feedback">
                                                    {{ 'This field is required' }}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-600">Update Picture (ছবি)</label>
                                            <div>
                                                <input type="hidden" name="oldPhoto" value="{{ $data->photoPath }}">
                                                <img src="{{ asset('uploads/' . $data->photoPath) }}" style="height: 50px;"
                                                    alt="">
                                            </div>
                                            <input type="file" class="form-control" name="newPhoto" accept="image/*">
                                            @if ($errors->has('photoPath'))
                                                <div class="invalid-feedback">
                                                    {{ 'This field is required' }}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-600">National Id No (জাতীয় পরিচয়পত্র নং)</label>
                                            <input type="text"
                                                onkeypress="return /\d/.test(String.fromCharCode(((event||window.event).which||(event||window.event).which)));"
                                                class="form-control" name="nationalIdNo"
                                                value="{{ $data->nationalIdNo ?? '' }}" placeholder="National Id No"
                                                maxlength="17" min="0" required>
                                            @if ($errors->has('nationalIdNo'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('nationalIdNo') }}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-600">Mobile number (মোবাইল নম্বর)</label>
                                            <input type="text"
                                                onkeypress="return /\d/.test(String.fromCharCode(((event||window.event).which||(event||window.event).which)));"
                                                class="form-control" name="mobile" value="{{ $dataStats->mobile ?? '' }}"
                                                placeholder="Mobile number" maxlength="11" required>
                                            @if ($errors->has('mobile'))
                                                <div class="invalid-feedback">
                                                    {{ 'This field is required' }}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-600 mr-3">Gender (লিঙ্গ)</label> <br>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="customRadioInline1" name="gender"
                                                    class="custom-control-input" value="Male"
                                                    @if ($data->gender == 'Male') checked @endif required>
                                                <label class="custom-control-label" for="customRadioInline1">Male</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="customRadioInline2" name="gender"
                                                    class="custom-control-input" value="Female"
                                                    @if ($data->gender == 'Female') checked @endif>
                                                <label class="custom-control-label"
                                                    for="customRadioInline2">Female</label>
                                            </div>
                                            <div>
                                                @if ($errors->has('gender'))
                                                    <div class="invalid-feedback">
                                                        {{ 'This field is required' }}
                                                    </div>
                                                @endif

                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6 p-l-30 p-r-30">
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1" class="font-weight-600">Religion
                                                (ধর্ম)</label>
                                            <select class="form-control" name="religion" required>
                                                <option value="">Select Religion</option>
                                                @foreach ($religionList as $religion)
                                                    @if (isset($dataStats->religion))
                                                        @if ($dataStats->religion == $religion->id)
                                                            <option value="{{ $religion->id }}" selected>
                                                                {{ $religion->religionEnglish }}
                                                                ({{ $religion->religionBangla }})
                                                            </option>
                                                        @else
                                                            <option value="{{ $religion->id }}">
                                                                {{ $religion->religionEnglish }}
                                                                ({{ $religion->religionBangla }})
                                                            </option>
                                                        @endif
                                                    @else
                                                        <option value="{{ $religion->id }}">
                                                            {{ $religion->religionEnglish }}
                                                            ({{ $religion->religionBangla }})
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
                                            <label class="font-weight-600">Place Of Birth (জন্মস্থান)</label>
                                            <select class="form-control js-example-basic-single" name="placeOfBirth"
                                                required>
                                                <option value="">Select</option>
                                                @foreach ($districtList as $district)
                                                    @if (isset($dataStats->placeOfBirth))
                                                        @if ($dataStats->placeOfBirth == $district->districtId)
                                                            <option value="{{ $district->districtId }}" selected>
                                                                {{ $district->districtEng }}
                                                                ({{ $district->districtBng }})
                                                            </option>
                                                        @else
                                                            <option value="{{ $district->districtId }}">
                                                                {{ $district->districtEng }}
                                                                ({{ $district->districtBng }})
                                                            </option>
                                                        @endif
                                                    @else
                                                        <option value="{{ $district->districtId }}">
                                                            {{ $district->districtEng }}
                                                            ({{ $district->districtBng }})
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
                                                        <label class="font-weight-600">Day (দিন)</label>
                                                        <select id="dateOfBirthDay" name="dateOfBirthDay"
                                                            class="form-control" required>
                                                            <option value="">Select</option>
                                                            @for ($birthDay = 01; $birthDay <= 31; $birthDay++)
                                                                <option value="{{ $birthDay }}"
                                                                    {{ date('d', strtotime($data->dateOfBirth)) == $birthDay ? 'selected' : '' }}>
                                                                    {{ $birthDay }}</option>
                                                            @endfor
                                                        </select>
                                                        @error('dateOfBirthDay')
                                                            <div class="invalid-feedback">
                                                                {{ 'This field is required' }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-4 mb-3">
                                                        <label class="font-weight-600">Month (মাস)</label>
                                                        <select name="dateOfBirthMonth" class="form-control" required>
                                                            <option value="">Select</option>
                                                            <option value="01"
                                                                {{ date('m', strtotime($data->dateOfBirth)) == '01' ? 'selected' : '' }}>
                                                                January</option>
                                                            <option value="02"
                                                                {{ date('m', strtotime($data->dateOfBirth)) == '02' ? 'selected' : '' }}>
                                                                February</option>
                                                            <option value="03"
                                                                {{ date('m', strtotime($data->dateOfBirth)) == '03' ? 'selected' : '' }}>
                                                                March</option>
                                                            <option value="04"
                                                                {{ date('m', strtotime($data->dateOfBirth)) == '04' ? 'selected' : '' }}>
                                                                April</option>
                                                            <option value="05"
                                                                {{ date('m', strtotime($data->dateOfBirth)) == '05' ? 'selected' : '' }}>
                                                                May</option>
                                                            <option value="06"
                                                                {{ date('m', strtotime($data->dateOfBirth)) == '06' ? 'selected' : '' }}>
                                                                June</option>
                                                            <option value="07"
                                                                {{ date('m', strtotime($data->dateOfBirth)) == '07' ? 'selected' : '' }}>
                                                                July</option>
                                                            <option value="08"
                                                                {{ date('m', strtotime($data->dateOfBirth)) == '08' ? 'selected' : '' }}>
                                                                August</option>
                                                            <option value="09"
                                                                {{ date('m', strtotime($data->dateOfBirth)) == '09' ? 'selected' : '' }}>
                                                                September</option>
                                                            <option value="10"
                                                                {{ date('m', strtotime($data->dateOfBirth)) == '10' ? 'selected' : '' }}>
                                                                October</option>
                                                            <option value="11"
                                                                {{ date('m', strtotime($data->dateOfBirth)) == '11' ? 'selected' : '' }}>
                                                                November</option>
                                                            <option value="12"
                                                                {{ date('m', strtotime($data->dateOfBirth)) == '12' ? 'selected' : '' }}>
                                                                December</option>
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
                                                        <label class="font-weight-600">Year (বছর)</label>
                                                        <select name="dateOfBirthYear" class="form-control" required>
                                                            <option value="">Select</option>
                                                            @for ($year = 1940; $year <= $getYear; $year++)
                                                                <option value="{{ $year }}"
                                                                    {{ date('Y', strtotime($data->dateOfBirth)) == $year ? 'selected' : '' }}>
                                                                    {{ $year }}</option>
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
                                            <label class="font-weight-600">Educational Qualifications (শিক্ষাগত
                                                যোগ্যতা)</label>
                                            <select class="form-control" name="education" required>
                                                <option value="">Select</option>
                                                @foreach ($educationList as $education)
                                                    @if (isset($dataStats->education))
                                                        @if ($dataStats->education == $education->id)
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
                                            <input type="text" class="form-control" id="input-area-two"
                                                name="identificationMark"
                                                value="{{ $dataStats->identificationMark ?? old('identificationMark') }}"
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
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 p-l-30 p-r-30 text-right">
                                        <button type="submit" class="btn btn-success mr-1">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="card tab-container" id="tabs_FamilyC">

                    <div class="card mb-4">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="fs-17 font-weight-600 mb-0 text-edit">Family Information (পারিবারিক তথ্য)
                                    </h6>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-6 p-l-30 p-r-30 left-side">
                                    <div class="form-group">
                                        <label class="font-weight-600">Mother's Name (মাতার নাম)</label>
                                        <input type="text" class="form-control" name="mothersName"
                                            value="{{ $data->mothersName }}" placeholder="Mother's Name" required>
                                        @if ($errors->has('mothersName'))
                                            <div class="invalid-feedback">
                                                {{ 'This field is required' }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-600">Father's Name (পিতার নাম)</label>
                                        <input type="text" class="form-control" name="fathersName"
                                            value="{{ $data->fathersName }}" placeholder="Father's Name" required>
                                        @if ($errors->has('fathersName'))
                                            <div class="invalid-feedback">
                                                {{ 'This field is required' }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1" class="font-weight-600">Marital Status
                                            (বৈবাহিক
                                            অবস্থা)</label>
                                        <select class="form-control" name="maritalStatus" required>
                                            <option value="">Select</option>
                                            @foreach ($maritalStatusList as $marital)
                                                @if (isset($dataStats->maritalStatus))
                                                    @if ($dataStats->maritalStatus == $marital->id)
                                                        <option value="{{ $marital->id }}" selected>
                                                            {{ $marital->maritalStatusEng }}
                                                            ({{ $marital->maritalStatusBng }})
                                                        </option>
                                                    @else
                                                        <option value="{{ $marital->id }}">
                                                            {{ $marital->maritalStatusEng }}
                                                            ({{ $marital->maritalStatusBng }})
                                                        </option>
                                                    @endif
                                                @else
                                                    <option value="{{ $marital->id }}">
                                                        {{ $marital->maritalStatusEng }}
                                                        ({{ $marital->maritalStatusBng }})
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
                                            value="{{ $data->spouseName }}" placeholder="Spouse Name">
                                        @if ($errors->has('spouseName'))
                                            <div class="invalid-feedback">
                                                {{ 'This field is required' }}
                                            </div>
                                        @endif
                                    </div>

                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 p-l-30 p-r-30">
                                    <div class="alert2 alert-danger" id="family-member-alert">
                                        Summation of Mother's number, Father's number, Number of spouse, Number of
                                        daughters, Number
                                        of sons and Others <span class="alert-link">must be less than Total family
                                            members
                                        </span>
                                    </div>
                                    <div class="form-group familymember-has-error">
                                        <label class="font-weight-600">Total family members (পরিবারের মোট সদস্য
                                            সংখ্যা)</label>
                                        <input type="text"
                                            onkeypress="return /\d/.test(String.fromCharCode(((event||window.event).which||(event||window.event).which)));"
                                            class="form-control" name="totalFamilyMember" id="totalFamilyMember"
                                            value="{{ $dataStats->totalFamilyMember ?? '' }}" placeholder="Number"
                                            required>
                                        @if ($errors->has('totalFamilyMember'))
                                            <div class="invalid-feedback">
                                                {{ 'This field is required' }}
                                            </div>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <div class="form-row">

                                            <div class="col-md-6 mb-4">
                                                <label for="validationCustom01" class="font-weight-600">Mother's number
                                                    (মায়ের
                                                    সংখ্যা)</label>
                                                <input type="text"
                                                    onkeypress="return /\d/.test(String.fromCharCode(((event||window.event).which||(event||window.event).which)));"
                                                    min="0" class="form-control" name="numberOfMother"
                                                    id="numberOfMother" value="{{ $dataStats->numberOfMother ?? '' }}"
                                                    placeholder="Number">
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <label for="validationCustom01" class="font-weight-600">Father's number
                                                    (পিতার
                                                    সংখ্যা)</label>
                                                <input type="text"
                                                    onkeypress="return /\d/.test(String.fromCharCode(((event||window.event).which||(event||window.event).which)));"
                                                    min="0" class="form-control" name="numberOfFather"
                                                    id="numberOfFather" value="{{ $dataStats->numberOfFather ?? '' }}"
                                                    placeholder="Number">
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <label for="validationCustom01" class="font-weight-600">Number of
                                                    spouse
                                                    (স্বামী/স্ত্রী সংখ্যা)</label>
                                                <input type="text"
                                                    onkeypress="return /\d/.test(String.fromCharCode(((event||window.event).which||(event||window.event).which)));"
                                                    min="0" class="form-control" name="numberOfSpouse"
                                                    id="numberOfSpouse" value="{{ $dataStats->numberOfSpouse ?? '' }}"
                                                    placeholder="Number">
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <label for="validationCustom01" class="font-weight-600">Number of
                                                    daughters (কন্যা
                                                    সংখ্যা)</label>
                                                <input type="text"
                                                    onkeypress="return /\d/.test(String.fromCharCode(((event||window.event).which||(event||window.event).which)));"
                                                    min="0" class="form-control" name="numberOfDaughter"
                                                    id="numberOfDaughter"
                                                    value="{{ $dataStats->numberOfDaughter ?? '' }}"
                                                    placeholder="Number">
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <label for="validationCustom01" class="font-weight-600">Number of sons
                                                    (পুত্র
                                                    সংখ্যা)</label>
                                                <input type="text"
                                                    onkeypress="return /\d/.test(String.fromCharCode(((event||window.event).which||(event||window.event).which)));"
                                                    min="0" class="form-control" name="numberOfSon"
                                                    id="numberOfSon" value="{{ $dataStats->numberOfSon ?? '' }}"
                                                    placeholder="Number">
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <label for="validationCustom01" class="font-weight-600">Others
                                                    (অন্যান্য)</label>
                                                <input type="text"
                                                    onkeypress="return /\d/.test(String.fromCharCode(((event||window.event).which||(event||window.event).which)));"
                                                    min="0" class="form-control" name="numberOfOtherMember"
                                                    id="numberOfOtherMember"
                                                    value="{{ $dataStats->numberOfOtherMember ?? '' }}"
                                                    placeholder="Number">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 p-l-30 p-r-30 text-right">
                                    <button type="submit" class="btn btn-success mr-1">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card tab-container" id="tabs_AddressC">
                    <div class="card mb-4">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="fs-17 font-weight-600 mb-0 text-edit">Permanent Address (স্থায়ী
                                                ঠিকানা)
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="fs-17 font-weight-600 mb-0 text-edit">Present Address (বর্তমান
                                                ঠিকানা)</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-6 p-l-30 p-r-30 left-side">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1" class="font-weight-600">Division
                                            (বিভাগ)</label>
                                        <select class="form-control" name="divisionId" id="divisionId" required>
                                            <option value="">Select Division </option>
                                            @foreach ($divisionList as $divisionList)
                                                @if ($data->divisionId == $divisionList->divisionId)
                                                    <option value="{{ $divisionList->divisionId }}" selected>
                                                        {{ $divisionList->divisionEng ?? '' }}
                                                        ({{ $divisionList->divisionBng ?? '' }})
                                                    </option>
                                                @else
                                                    <option value="{{ $divisionList->divisionId ?? '' }}">
                                                        {{ $divisionList->divisionEng ?? '' }}
                                                        ({{ $divisionList->divisionBng ?? '' }})
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
                                        <label class="font-weight-600">District (জেলা)</label>
                                        <select class="form-control" name="districtId" id="districtId" required>
                                            @foreach ($getEditDistrictList as $districtListData)
                                                @if ($data->districtId == $districtListData->districtId)
                                                    <option value="{{ $districtListData->districtId }}" selected>
                                                        {{ $districtListData->districtEng ?? '' }}
                                                        ({{ $districtListData->districtBng ?? '' }})
                                                    </option>
                                                @else
                                                    <option value="{{ $districtListData->districtId }}">
                                                        {{ $districtListData->districtEng ?? '' }}
                                                        ({{ $districtListData->districtBng ?? '' }})
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @if ($errors->has('districtId'))
                                            <div class="invalid-feedback">
                                                {{ 'This field is required' }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-600">Upazila (উপজেলা)</label>
                                        <select class="form-control" name="upazilaId" id="upazilaId" required>
                                            @foreach ($getEditUpazilaList as $getEditUpazilaData)
                                                @if ($data->upazilaId == $getEditUpazilaData->upazilaId)
                                                    <option value="{{ $getEditUpazilaData->upazilaId }}" selected>
                                                        {{ $getEditUpazilaData->upazilaEng ?? '' }}
                                                        ({{ $getEditUpazilaData->upazilaBng ?? '' }})
                                                    </option>
                                                @else
                                                    <option value="{{ $getEditUpazilaData->districtId }}">
                                                        {{ $getEditUpazilaData->upazilaEng ?? '' }}
                                                        ({{ $getEditUpazilaData->upazilaBng ?? '' }})
                                                    </option>
                                                @endif
                                            @endforeach
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
                                            @if ($data->municipalityId > 0)
                                                @foreach ($getEditMunicipalityList as $getEditMunicipality)
                                                    @if ($data->municipalityId == $getEditMunicipality->municipalityId)
                                                        <option value="{{ $getEditMunicipality->municipalityId }}"
                                                            selected>
                                                            {{ $getEditMunicipality->municipalityEnglish ?? '' }}
                                                            ({{ $getEditMunicipality->municipalityBangla ?? '' }})
                                                        </option>
                                                    @else
                                                        <option value="{{ $getEditMunicipality->municipalityId }}">
                                                            {{ $getEditMunicipality->municipalityEnglish ?? '' }}
                                                            ({{ $getEditMunicipality->municipalityBangla ?? '' }})
                                                        </option>
                                                    @endif
                                                @endforeach
                                            @endif
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
                                            @if ($data->municipalityId > 0)
                                                @foreach ($getEditWardList as $getEditWard)
                                                    @if ($data->wardId == $getEditWard->unionId)
                                                        <option value="{{ $getEditWard->unionId }}" selected>
                                                            {{ $getEditWard->unionEng ?? '' }}
                                                            ({{ $getEditWard->unionBng ?? '' }})
                                                        </option>
                                                    @else
                                                        <option value="{{ $getEditWard->unionId }}">
                                                            {{ $getEditWard->unionEng ?? '' }}
                                                            ({{ $getEditWard->unionBng ?? '' }})
                                                        </option>
                                                    @endif
                                                @endforeach
                                            @endif
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
                                            @if ($data->unionId > 0)
                                                @foreach ($getEditUnionList as $getEditUnion)
                                                    @if ($data->unionId == $getEditUnion->unionId)
                                                        <option value="{{ $getEditUnion->unionId }}" selected>
                                                            {{ $getEditUnion->unionEng ?? '' }}
                                                            ({{ $getEditUnion->unionBng ?? '' }})
                                                        </option>
                                                    @else
                                                        <option value="{{ $getEditUnion->unionId }}">
                                                            {{ $getEditUnion->unionEng ?? '' }}
                                                            ({{ $getEditUnion->unionBng ?? '' }})
                                                        </option>
                                                    @endif
                                                @endforeach
                                            @endif
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
                                            @if ($data->villageId > 0)
                                                @foreach ($getEditVillageList as $getEditVillage)
                                                    @if ($data->villageId == $getEditVillage->villageId)
                                                        <option value="{{ $getEditVillage->villageId }}" selected>
                                                            {{ $getEditVillage->villageEng ?? '' }}
                                                            ({{ $getEditVillage->villageBng ?? '' }})
                                                        </option>
                                                    @else
                                                        <option value="{{ $getEditVillage->villageId }}">
                                                            {{ $getEditVillage->villageEng ?? '' }}
                                                            ({{ $getEditVillage->villageBng ?? '' }})
                                                        </option>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </select>
                                        @if ($errors->has('villageId'))
                                            <div class="invalid-feedback">
                                                {{ 'This field is required' }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group" id="postOfficeSectionId">
                                        <label class="font-weight-600">Post Office (ডাক ঘর)</label>
                                        <select class="form-control" name="postOfficeId" id="postOfficeId" required>
                                            @foreach ($getEditPostOfficeList as $getEditPostOffice)
                                                @if ($data->postOfficeId == $getEditPostOffice->postId)
                                                    <option value="{{ $getEditPostOffice->postId }}" selected>
                                                        {{ $getEditPostOffice->postOfficeEnglish ?? '' }}
                                                        ({{ $getEditPostOffice->postOfficeBangla ?? '' }})
                                                    </option>
                                                @else
                                                    <option value="{{ $getEditPostOffice->postId }}">
                                                        {{ $getEditPostOffice->postOfficeEnglish ?? '' }}
                                                        ({{ $getEditPostOffice->postOfficeBangla ?? '' }})
                                                    </option>
                                                @endif
                                            @endforeach
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
                                        <label for="exampleFormControlSelect1" class="font-weight-600">Division
                                            (বিভাগ)</label>
                                        <select class="form-control" name="presentDivisionId" id="presentDivisionId"
                                            required>
                                            <option value="">Select Division </option>
                                            @foreach ($permanentdivisionList as $divisionListPresent)
                                                @if ($dataStats->presentDivisionId == $divisionListPresent->divisionId)
                                                    <option value="{{ $divisionListPresent->divisionId }}" selected>
                                                        {{ $divisionListPresent->divisionEng ?? '' }}
                                                        ({{ $divisionListPresent->divisionBng ?? '' }})
                                                    </option>
                                                @else
                                                    <option value="{{ $divisionListPresent->divisionId }}">
                                                        {{ $divisionListPresent->divisionEng ?? '' }}
                                                        ({{ $divisionListPresent->divisionBng ?? '' }})
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
                                        <label class="font-weight-600">District (জেলা)</label>
                                        <select class="form-control" name="presentDistrictId" id="presentDistrictId">
                                            @foreach ($getPresentEditDistrictList as $presentEditDistrict)
                                                @if ($dataStats->presentDistrictId == $presentEditDistrict->districtId)
                                                    <option value="{{ $presentEditDistrict->districtId }}" selected>
                                                        {{ $presentEditDistrict->districtEng ?? '' }}
                                                        ({{ $presentEditDistrict->districtBng ?? '' }})
                                                    </option>
                                                @else
                                                    <option value="{{ $presentEditDistrict->districtId }}">
                                                        {{ $presentEditDistrict->districtEng ?? '' }}
                                                        ({{ $presentEditDistrict->districtBng ?? '' }})
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @if ($errors->has('presentDistrictId'))
                                            <div class="invalid-feedback">
                                                {{ 'This field is required' }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-600">Upazila (উপজেলা)</label>
                                        <select class="form-control" name="presentUpazilaId" id="presentUpazilaId"
                                            required>
                                            @foreach ($getPresentEditUpazilaList as $getPresentEditUpazilaData)
                                                @if ($dataStats->presentUpazilaId == $getPresentEditUpazilaData->upazilaId)
                                                    <option value="{{ $getPresentEditUpazilaData->upazilaId }}" selected>
                                                        {{ $getPresentEditUpazilaData->upazilaEng ?? '' }}
                                                        ({{ $getPresentEditUpazilaData->upazilaBng ?? '' }})
                                                    </option>
                                                @else
                                                    <option value="{{ $getPresentEditUpazilaData->upazilaId }}">
                                                        {{ $getPresentEditUpazilaData->upazilaEng ?? '' }}
                                                        ({{ $getPresentEditUpazilaData->upazilaBng ?? '' }})
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @if ($errors->has('presentUpazilaId'))
                                            <div class="invalid-feedback">
                                                {{ 'This field is required' }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group" id="presentMunicipalitySectionId">
                                        <label class="font-weight-600">Municipality (পৌরসভা ) (If any) </label>
                                        <select class="form-control" name="presentMunicipalityId"
                                            id="presentMunicipalityId">
                                            @if ($dataStats->presentMunicipalityId > 0)
                                                @foreach ($getPresentEditMunicipalityList as $getPresentEditMunicipality)
                                                    @if ($data->presentMunicipalityId == $getPresentEditMunicipality->municipalityId)
                                                        <option value="{{ $getPresentEditMunicipality->municipalityId }}"
                                                            selected>
                                                            {{ $getPresentEditMunicipality->municipalityEnglish ?? '' }}
                                                            ({{ $getPresentEditMunicipality->municipalityBangla ?? '' }})
                                                        </option>
                                                    @else
                                                        <option
                                                            value="{{ $getPresentEditMunicipality->municipalityId }}">
                                                            {{ $getPresentEditMunicipality->municipalityEnglish ?? '' }}
                                                            ({{ $getPresentEditMunicipality->municipalityBangla ?? '' }})
                                                        </option>
                                                    @endif
                                                @endforeach
                                            @endif
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
                                            @if ($dataStats->presentMunicipalityId > 0)
                                                @foreach ($getPresentEditWardList as $getPresentEditWard)
                                                    @if ($dataStats->presentAddressWard == $getPresentEditWard->unionId)
                                                        <option value="{{ $getPresentEditWard->unionId }}" selected>
                                                            {{ $getPresentEditWard->unionEng ?? '' }}
                                                            ({{ $getPresentEditWard->unionBng ?? '' }})
                                                        </option>
                                                    @else
                                                        <option value="{{ $getPresentEditWard->unionId }}">
                                                            {{ $getPresentEditWard->unionEng ?? '' }}
                                                            ({{ $getPresentEditWard->unionBng ?? '' }})
                                                        </option>
                                                    @endif
                                                @endforeach
                                            @endif
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
                                            @if ($dataStats->presentUnionId > 0)
                                                @foreach ($getPresentEditUnionList as $getPresentEditUnion)
                                                    @if ($dataStats->presentUnionId == $getPresentEditUnion->unionId)
                                                        <option value="{{ $getPresentEditUnion->unionId }}" selected>
                                                            {{ $getPresentEditUnion->unionEng ?? '' }}
                                                            ({{ $getPresentEditUnion->unionBng ?? '' }})
                                                        </option>
                                                    @else
                                                        <option value="{{ $getPresentEditUnion->unionId }}">
                                                            {{ $getPresentEditUnion->unionEng ?? '' }}
                                                            ({{ $getPresentEditUnion->unionBng ?? '' }})
                                                        </option>
                                                    @endif
                                                @endforeach
                                            @endif
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
                                            @if ($dataStats->presentAddressVillage > 0)
                                                @foreach ($getPresentEditVillageList as $getPresentEditVillage)
                                                    @if ($dataStats->presentAddressVillage == $getPresentEditVillage->villageId)
                                                        <option value="{{ $getPresentEditVillage->villageId }}" selected>
                                                            {{ $getPresentEditVillage->villageEng ?? '' }}
                                                            ({{ $getPresentEditVillage->villageBng ?? '' }})
                                                        </option>
                                                    @else
                                                        <option value="{{ $getPresentEditVillage->villageId }}">
                                                            {{ $getPresentEditVillage->villageEng ?? '' }}
                                                            ({{ $getPresentEditVillage->villageBng ?? '' }})
                                                        </option>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </select>
                                        @if ($errors->has('presentVillageId'))
                                            <div class="invalid-feedback">
                                                {{ 'This field is required' }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group" id="presentPostOfficeSectionId">
                                        <label class="font-weight-600">Post Office (ডাক ঘর)</label>
                                        <select class="form-control" name="presentPostOfficeId" id="presentPostOfficeId"
                                            required>
                                            @foreach ($getPresentEditPostOfficeList as $getPresentEditPostOffice)
                                                @if ($dataStats->presentPostoffice == $getPresentEditPostOffice->postId)
                                                    <option value="{{ $getPresentEditPostOffice->postId }}" selected>
                                                        {{ $getPresentEditPostOffice->postOfficeEnglish ?? '' }}
                                                        ({{ $getPresentEditPostOffice->postOfficeBangla ?? '' }})
                                                    </option>
                                                @else
                                                    <option value="{{ $getPresentEditPostOffice->postId }}">
                                                        {{ $getPresentEditPostOffice->postOfficeEnglish ?? '' }}
                                                        ({{ $getPresentEditPostOffice->postOfficeBangla ?? '' }})
                                                    </option>
                                                @endif
                                            @endforeach
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
                                <div class="col-xs-12 col-sm-12 col-md-12 p-l-30 p-r-30 text-right">
                                    <button type="submit" class="btn btn-success mr-1">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card tab-container" id="tabs_FishingC">
                    <div class="card mb-4">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="fs-17 font-weight-600 mb-0 text-edit">Fishing Information (মাছ ধরার
                                        তথ্য)</h6>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-6 p-l-30 p-r-30 left-side">
                                    <div class="form-group">
                                        <label class="font-weight-600">Time Of Fishing (মৎস্য আহরণকাল)</label>
                                        <select class="form-control" name="timeOfFishing" required>
                                            <option value="">Select</option>
                                            @foreach ($timeOfFishingList as $timeOfFishingData)
                                                @if (isset($dataStats->timeOfFishing))
                                                    @if ($dataStats->timeOfFishing == $timeOfFishingData->id)
                                                        <option value="{{ $timeOfFishingData->id }}" selected>
                                                            {{ $timeOfFishingData->timeOfFishingEng }}
                                                            ({{ $timeOfFishingData->timeOfFishingBng }})
                                                        </option>
                                                    @else
                                                        <option value="{{ $timeOfFishingData->id }}">
                                                            {{ $timeOfFishingData->timeOfFishingEng }}
                                                            ({{ $timeOfFishingData->timeOfFishingBng }})
                                                        </option>
                                                    @endif
                                                @else
                                                    <option value="{{ $timeOfFishingData->id }}">
                                                        {{ $timeOfFishingData->timeOfFishingEng }}
                                                        ({{ $timeOfFishingData->timeOfFishingBng }})
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @if ($errors->has('timeOfFishing'))
                                            <div class="invalid-feedback">
                                                {{ 'This field is required' }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-600">Place Of Fishing (মৎস্য আহরণস্থল)</label>
                                        <div class="row checkbox-section">
                                            @php
                                                $dataPlaceOfFishing = explode(',', $dataStats->placeOfFishing ?? '');
                                            @endphp
                                            @foreach ($placeOfFishingList as $placeOfFishingData)
                                                <div class="col-sm-12">
                                                    <div class="checkbox checkbox-success">
                                                        <input name="placeOfFishing[]"
                                                            id="{{ $placeOfFishingData->placeEng }}{{ $placeOfFishingData->id }}"
                                                            type="checkbox" value="{{ $placeOfFishingData->id }}"
                                                            {{ in_array($placeOfFishingData->id, $dataPlaceOfFishing) ? 'checked' : '' }}>
                                                        <label
                                                            for="{{ $placeOfFishingData->placeEng }}{{ $placeOfFishingData->id }}">
                                                            {{ $placeOfFishingData->placeEng }}
                                                            ({{ $placeOfFishingData->placeBng }})
                                                        </label>

                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        @if ($errors->has('placeOfFishing'))
                                            <div class="invalid-feedback">
                                                {{ 'This field is required' }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-600">Types of fish (আহরিত মাছের ধরন)</label>
                                        <div class="row checkbox-section">
                                            @php
                                                $dataFishCategoryList = explode(',', $dataStats->typeOfFish ?? '');
                                            @endphp
                                            @foreach ($fishCategoryList as $fishCategoryData)
                                                <div class="col-sm-12">
                                                    <div class="checkbox checkbox-success">
                                                        <input name="typeOfFish[]"
                                                            id="{{ $fishCategoryData->categoryEng }}{{ $fishCategoryData->id }}"
                                                            type="checkbox" value="{{ $fishCategoryData->id }}"
                                                            {{ in_array($fishCategoryData->id, $dataFishCategoryList) ? 'checked' : '' }}>
                                                        <label
                                                            for="{{ $fishCategoryData->categoryEng }}{{ $fishCategoryData->id }}">
                                                            {{ $fishCategoryData->categoryEng }}
                                                            ({{ $fishCategoryData->categoryBng }})
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        @if ($errors->has('typeOfFish'))
                                            <div class="invalid-feedback">
                                                {{ 'This field is required' }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-600">Fishing Equipment (মাছ ধরার সরঞ্জাম)</label>
                                        <div class="row checkbox-section">
                                            @php
                                                $toolsTypeData = explode(',', $dataStats->toolsType ?? '');
                                            @endphp
                                            @foreach ($fishingEquipmentList as $fishingEquipmentData)
                                                <div class="col-sm-12">
                                                    <div class="checkbox checkbox-success">

                                                        <input name="toolsType[]"
                                                            id="{{ $fishingEquipmentData->equipmentEng }}{{ $fishingEquipmentData->id }}"
                                                            type="checkbox" value="{{ $fishingEquipmentData->id }}"
                                                            {{ in_array($fishingEquipmentData->id, $toolsTypeData) ? 'checked' : '' }}>
                                                        <label
                                                            for="{{ $fishingEquipmentData->equipmentEng }}{{ $fishingEquipmentData->id }}">
                                                            {{ $fishingEquipmentData->equipmentEng }}
                                                            ({{ $fishingEquipmentData->equipmentBng }})
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        @if ($errors->has('toolsType'))
                                            <div class="invalid-feedback">
                                                {{ 'This field is required' }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-600">Types of fishing (মৎস্য আহরণের ধরন)</label>
                                        <select class="form-control" name="howToFishing" required id="howToFishing">
                                            <option value="">Select</option>
                                            @foreach ($howToFishingList as $howToFishingData)
                                                @if (isset($dataStats->howToFishing))
                                                    @if ($dataStats->howToFishing == $howToFishingData->id)
                                                        <option value="{{ $howToFishingData->id }}" selected>
                                                            {{ $howToFishingData->howToFishingEng }}
                                                            ({{ $howToFishingData->howToFishingBng }})
                                                        </option>
                                                    @else
                                                        <option value="{{ $howToFishingData->id ?? '' }}">
                                                            {{ $howToFishingData->howToFishingEng }}
                                                            ({{ $howToFishingData->howToFishingBng }})
                                                        </option>
                                                    @endif
                                                @else
                                                    <option value="{{ $howToFishingData->id ?? '' }}">
                                                        {{ $howToFishingData->howToFishingEng }}
                                                        ({{ $howToFishingData->howToFishingBng }})
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @if ($errors->has('howToFishing'))
                                            <div class="invalid-feedback">
                                                {{ 'This field is required' }}
                                            </div>
                                        @endif
                                    </div>

                                    <div class="form-group" id="groupMemberSection">
                                        <label class="font-weight-600">Number of fishermen in the team (দলে জেলে
                                            সংখ্যা)</label>
                                        <select class="form-control" name="groupMember" required>
                                            <option value="">Select</option>
                                            @foreach ($groupMemberList as $groupMemberData)
                                                @if (isset($dataStats->groupMember))
                                                    @if ($dataStats->groupMember == $groupMemberData->id)
                                                        <option value="{{ $groupMemberData->id }}" selected>
                                                            {{ $groupMemberData->groupMemberEng }}
                                                            ({{ $groupMemberData->groupMemberBng }})
                                                        </option>
                                                    @else
                                                        <option value="{{ $groupMemberData->id ?? '' }}">
                                                            {{ $groupMemberData->groupMemberEng }}
                                                            ({{ $groupMemberData->groupMemberBng }})
                                                        </option>
                                                    @endif
                                                @else
                                                    <option value="{{ $groupMemberData->id ?? '' }}">
                                                        {{ $groupMemberData->groupMemberEng }}
                                                        ({{ $groupMemberData->groupMemberBng }})
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @if ($errors->has('groupMember'))
                                            <div class="invalid-feedback">
                                                {{ 'This field is required' }}
                                            </div>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label class="font-weight-600">Fish sale place (মাছ বিক্রির স্থান)</label>
                                        <div class="row checkbox-section">
                                            @php
                                                $salePlaceOfFishData = explode(',', $dataStats->salePlaceOfFish ?? '');
                                            @endphp
                                            @foreach ($fishSalePlacesList as $fishSalePlacesData)
                                                <div class="col-sm-12">
                                                    <div class="checkbox checkbox-success">
                                                        <input name="salePlaceOfFish[]"
                                                            id="{{ $fishSalePlacesData->salePlaceEng }}{{ $fishSalePlacesData->id }}"
                                                            type="checkbox" value="{{ $fishSalePlacesData->id }}"
                                                            {{ in_array($fishSalePlacesData->id, $salePlaceOfFishData) ? 'checked' : '' }}>
                                                        <label
                                                            for="{{ $fishSalePlacesData->salePlaceEng }}{{ $fishSalePlacesData->id }}">
                                                            {{ $fishSalePlacesData->salePlaceEng }}
                                                            ({{ $fishSalePlacesData->salePlaceBng }})
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        @if ($errors->has('salePlaceOfFish'))
                                            <div class="invalid-feedback">
                                                {{ 'This field is required' }}
                                            </div>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label class="font-weight-600">Ownership of the net (জালের মালিকানা)</label>
                                        <select class="form-control" name="ownerOfNet" required>
                                            <option value="">Select</option>
                                            @foreach ($ownerOfNetList as $ownerOfNetData)
                                                @if (isset($dataStats->ownerOfNet))
                                                    @if ($dataStats->ownerOfNet == $ownerOfNetData->id)
                                                        <option value="{{ $ownerOfNetData->id }}" selected>
                                                            {{ $ownerOfNetData->ownerOfNetEng }}
                                                            ({{ $ownerOfNetData->ownerOfNetBng }})
                                                        </option>
                                                    @else
                                                        <option value="{{ $ownerOfNetData->id }}">
                                                            {{ $ownerOfNetData->ownerOfNetEng }}
                                                            ({{ $ownerOfNetData->ownerOfNetBng }})
                                                        </option>
                                                    @endif
                                                @else
                                                    <option value="{{ $ownerOfNetData->id }}">
                                                        {{ $ownerOfNetData->ownerOfNetEng }}
                                                        ({{ $ownerOfNetData->ownerOfNetBng }})
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @if ($errors->has('ownerOfNet'))
                                            <div class="invalid-feedback">
                                                {{ 'This field is required' }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="font-weight-600">Length of the net (জালের
                                                    দৈর্ঘ্য)</label>
                                                <input type="text"
                                                    onkeypress="return /\d/.test(String.fromCharCode(((event||window.event).which||(event||window.event).which)));"
                                                    class="form-control" min=0 name="lengthOfNet"
                                                    value="{{ $dataStats->lengthOfNet ?? '' }}"
                                                    placeholder="Length of the net">
                                                <small class="form-text text-muted">Meters (মিটার)</small>
                                                @if ($errors->has('lengthOfNet'))
                                                    <div class="invalid-feedback">
                                                        {{ 'This field is required' }}
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <label class="font-weight-600">Width of the net (জালের প্রস্থ)</label>
                                                <input type="text"
                                                    onkeypress="return /\d/.test(String.fromCharCode(((event||window.event).which||(event||window.event).which)));"
                                                    class="form-control" min=0 name="widthOfNet"
                                                    value="{{ $dataStats->widthOfNet ?? '' }}"
                                                    placeholder="Width of the net">
                                                <small class="form-text text-muted">Meters (মিটার)</small>
                                                @if ($errors->has('widthOfNet'))
                                                    <div class="invalid-feedback">
                                                        {{ 'This field is required' }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="font-weight-600">Price of net (জালের মূল্য)</label>
                                                <input type="text"
                                                    onkeypress="return /\d/.test(String.fromCharCode(((event||window.event).which||(event||window.event).which)));"
                                                    class="form-control" min=0 name="priceOfNet"
                                                    value="{{ $dataStats->priceOfNet ?? '' }}"
                                                    placeholder="Price of net">
                                                @if ($errors->has('priceOfNet'))
                                                    <div class="invalid-feedback">
                                                        {{ 'This field is required' }}
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <label class="font-weight-600">Source of money (টাকার উৎস)</label>
                                                <input type="text" class="form-control" name="sourceOfPurchaseOfNet"
                                                    id="source-of-money"
                                                    value="{{ $dataStats->sourceOfPurchaseOfNet ?? '' }}"
                                                    placeholder="Source of money">
                                                @if ($errors->has('sourceOfPurchaseOfNet'))
                                                    <div class="invalid-feedback">
                                                        {{ 'This field is required' }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 p-l-30 p-r-30">

                                    <div class="form-group">
                                        <label class="font-weight-600">Type Of Vessels (নৌযানের ধরন)</label>
                                        <select class="form-control" name="typeOfVessels" required>
                                            <option value="">Select</option>
                                            @foreach ($typeOfVesselsList as $typeOfVesselsData)
                                                @if (isset($dataStats->typeOfVessels))
                                                    @if ($dataStats->typeOfVessels == $typeOfVesselsData->id)
                                                        <option value="{{ $typeOfVesselsData->id }}" selected>
                                                            {{ $typeOfVesselsData->typeofVesselsEng }}
                                                            ({{ $typeOfVesselsData->typeofVesselsBng }})
                                                        </option>
                                                    @else
                                                        <option value="{{ $typeOfVesselsData->id }}">
                                                            {{ $typeOfVesselsData->typeofVesselsEng }}
                                                            ({{ $typeOfVesselsData->typeofVesselsBng }})
                                                        </option>
                                                    @endif
                                                @else
                                                    <option value="{{ $typeOfVesselsData->id }}">
                                                        {{ $typeOfVesselsData->typeofVesselsEng }}
                                                        ({{ $typeOfVesselsData->typeofVesselsBng }})
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @if ($errors->has('typeOfVessels'))
                                            <div class="invalid-feedback">
                                                {{ 'This field is required' }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-600">Owner Of Vessels (নৌযানের মালিকানা)</label>
                                        <select class="form-control" name="ownerOfVessels" required>
                                            <option value="">Select</option>
                                            @foreach ($ownerOfVesselsList as $ownerOfVesselsData)
                                                @if (isset($dataStats->ownerOfVessels))
                                                    @if ($dataStats->ownerOfVessels == $ownerOfVesselsData->id)
                                                        <option value="{{ $typeOfVesselsData->id }}" selected>
                                                            {{ $ownerOfVesselsData->ownerOfVesselsEng }}
                                                            ({{ $ownerOfVesselsData->ownerOfVesselsBng }})
                                                        </option>
                                                    @else
                                                        <option value="{{ $ownerOfVesselsData->id }}">
                                                            {{ $ownerOfVesselsData->ownerOfVesselsEng }}
                                                            ({{ $ownerOfVesselsData->ownerOfVesselsBng }})
                                                        </option>
                                                    @endif
                                                @else
                                                    <option value="{{ $ownerOfVesselsData->id }}">
                                                        {{ $ownerOfVesselsData->ownerOfVesselsEng }}
                                                        ({{ $ownerOfVesselsData->ownerOfVesselsBng }})
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @if ($errors->has('ownerOfVessels'))
                                            <div class="invalid-feedback">
                                                {{ 'This field is required' }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="font-weight-600">Length Of Vessels (নৌযানের
                                                    দৈর্ঘ্য)</label>
                                                <input type="text"
                                                    onkeypress="return /\d/.test(String.fromCharCode(((event||window.event).which||(event||window.event).which)));"
                                                    class="form-control" min=0 name="lengthOfVessels"
                                                    value="{{ $dataStats->lengthOfVessels ?? '' }}"
                                                    placeholder="Length of the vessels">
                                                <small class="form-text text-muted">Meters (মিটার)</small>
                                                @if ($errors->has('lengthOfVessels'))
                                                    <div class="invalid-feedback">
                                                        {{ 'This field is required' }}
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="col-md-6">
                                                <label class="font-weight-600">Width Of Vessels (নৌযানের
                                                    প্রস্থ)</label>
                                                <input type="text"
                                                    onkeypress="return /\d/.test(String.fromCharCode(((event||window.event).which||(event||window.event).which)));"
                                                    class="form-control" min=0 name="widthOfVessels"
                                                    value="{{ $dataStats->widthOfVessels ?? '' }}"
                                                    placeholder="Width of the vessels">
                                                <small class="form-text text-muted">Meters (মিটার)</small>
                                                @if ($errors->has('widthOfVessels'))
                                                    <div class="invalid-feedback">
                                                        {{ 'This field is required' }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="font-weight-600">Height Of Vessels (নৌযানের
                                                    উচ্চতা)</label>
                                                <input type="text"
                                                    onkeypress="return /\d/.test(String.fromCharCode(((event||window.event).which||(event||window.event).which)));"
                                                    class="form-control" min=0 name="heightOfVessels"
                                                    value="{{ $dataStats->heightOfVessels ?? '' }}"
                                                    placeholder="Height of the vessels">
                                                <small class="form-text text-muted">Meters (মিটার)</small>
                                                @if ($errors->has('heightOfVessels'))
                                                    <div class="invalid-feedback">
                                                        {{ 'This field is required' }}
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <label class="font-weight-600">Price Of Vessels (নৌযানের
                                                    মূল্য)</label>
                                                <input type="text"
                                                    onkeypress="return /\d/.test(String.fromCharCode(((event||window.event).which||(event||window.event).which)));"
                                                    class="form-control" min=0 name="priceOfVessels"
                                                    value="{{ $dataStats->priceOfVessels ?? '' }}"
                                                    placeholder="Price of the vessels">
                                                @if ($errors->has('priceOfVessels'))
                                                    <div class="invalid-feedback">
                                                        {{ 'This field is required' }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-600">Registration No Of Vessels (নৌযানের
                                            রেজিষ্ট্রেশন
                                            নং)</label>
                                        <input type="text"
                                            onkeypress="return /\d/.test(String.fromCharCode(((event||window.event).which||(event||window.event).which)));"
                                            class="form-control" min=0 name="regiNoOfVessels"
                                            value="{{ $dataStats->regiNoOfVessels ?? '' }}"
                                            placeholder="Registration No Of Vessels">
                                        @if ($errors->has('regiNoOfVessels'))
                                            <div class="invalid-feedback">
                                                {{ 'This field is required' }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-600">Types of employment on the boat (নৌযানে
                                            কর্মসংস্থানের
                                            ধরন)</label>
                                        <select class="form-control" name="typeOfEmploymentInVessels" required>
                                            <option value="">Select</option>
                                            @foreach ($typeOfEmploymentStatusinVesselsList as $typeOfEmploymentStatusinVesselsData)
                                                @if (isset($dataStats->typeOfEmploymentInVessels))
                                                    @if ($dataStats->typeOfEmploymentInVessels == $typeOfEmploymentStatusinVesselsData->id)
                                                        <option value="{{ $typeOfEmploymentStatusinVesselsData->id }}"
                                                            selected>
                                                            {{ $typeOfEmploymentStatusinVesselsData->employmentsInVesselsEng }}
                                                            ({{ $typeOfEmploymentStatusinVesselsData->employmentsInVesselsBng }})
                                                        </option>
                                                    @else
                                                        <option value="{{ $typeOfEmploymentStatusinVesselsData->id }}">
                                                            {{ $typeOfEmploymentStatusinVesselsData->employmentsInVesselsEng }}
                                                            ({{ $typeOfEmploymentStatusinVesselsData->employmentsInVesselsBng }})
                                                        </option>
                                                    @endif
                                                @else
                                                    <option value="{{ $typeOfEmploymentStatusinVesselsData->id }}">
                                                        {{ $typeOfEmploymentStatusinVesselsData->employmentsInVesselsEng }}
                                                        ({{ $typeOfEmploymentStatusinVesselsData->employmentsInVesselsBng }})
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @if ($errors->has('typeOfEmploymentInVessels'))
                                            <div class="invalid-feedback">
                                                {{ 'This field is required' }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-600">Main Profession (প্রধান পেশা)</label>
                                        <input type="text" class="form-control" name="mainProfession"
                                            id="main-profession-input-area"
                                            value="{{ $dataStats->mainProfession ?? '' }}"
                                            placeholder="Main Profession">
                                        @if ($errors->has('mainProfession'))
                                            <div class="invalid-feedback">
                                                {{ 'This field is required' }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-600">Sub Profession (সহযোগী পেশা)</label>
                                        <input type="text" class="form-control" name="subProfession"
                                            id="sub-profession-input-area" value="{{ $dataStats->subProfession ?? '' }}"
                                            placeholder="Sub Profession">
                                        @if ($errors->has('subProfession'))
                                            <div class="invalid-feedback">
                                                {{ 'This field is required' }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-600">Annual Income (বার্ষিক আয়)</label>
                                        <input type="text"
                                            onkeypress="return /\d/.test(String.fromCharCode(((event||window.event).which||(event||window.event).which)));"
                                            class="form-control" name="annualIncome"
                                            value="{{ $dataStats->annualIncome ?? '' }}" placeholder="Annual Income">
                                        @if ($errors->has('annualIncome'))
                                            <div class="invalid-feedback">
                                                {{ 'This field is required' }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-600">Income From Main Profession (প্রধান পেশা থেকে
                                            আয়)</label>
                                        <input type="text"
                                            onkeypress="return /\d/.test(String.fromCharCode(((event||window.event).which||(event||window.event).which)));"
                                            class="form-control" name="incomeMainProfession"
                                            value="{{ $dataStats->incomeMainProfession ?? '' }}"
                                            placeholder="Income From Main Profession">
                                        @if ($errors->has('incomeMainProfession'))
                                            <div class="invalid-feedback">
                                                {{ 'This field is required' }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-600">Income From Sub Profession (সহযোগী পেশা (সমূহ)
                                            থেকে
                                            আয়)</label>
                                        <input type="text"
                                            onkeypress="return /\d/.test(String.fromCharCode(((event||window.event).which||(event||window.event).which)));"
                                            class="form-control" name="incomeSubProfession"
                                            value="{{ $dataStats->incomeSubProfession ?? '' }}"
                                            placeholder="Annual Income">
                                        @if ($errors->has('incomeSubProfession'))
                                            <div class="invalid-feedback">
                                                {{ 'This field is required' }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-600">Annual loan amount (বার্ষিক ঋণের পরিমাণ)</label>
                                        <select class="form-control" name="yearlyLoan">
                                            <option value="">Select</option>
                                            @foreach ($yearlyLoanList as $yearlyLoanData)
                                                @if (isset($dataStats->yearlyLoan))
                                                    @if ($dataStats->yearlyLoan == $yearlyLoanData->id)
                                                        <option value="{{ $yearlyLoanData->id }}" selected>
                                                            {{ $yearlyLoanData->yearlyLoanEng }}
                                                            ({{ $yearlyLoanData->yearlyLoanBng }})
                                                        </option>
                                                    @else
                                                        <option value="{{ $yearlyLoanData->id }}">
                                                            {{ $yearlyLoanData->yearlyLoanEng }}
                                                            ({{ $yearlyLoanData->yearlyLoanBng }})
                                                        </option>
                                                    @endif
                                                @else
                                                    <option value="{{ $yearlyLoanData->id }}">
                                                        {{ $yearlyLoanData->yearlyLoanEng }}
                                                        ({{ $yearlyLoanData->yearlyLoanBng }})
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @if ($errors->has('yearlyLoan'))
                                            <div class="invalid-feedback">
                                                {{ 'This field is required' }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-600">Annual savings amount (বার্ষিক সঞ্চয়ের
                                            পরিমাণ)</label>
                                        <select class="form-control" name="yearlySaving">
                                            <option value="">Select</option>
                                            @foreach ($yearlySavingList as $yearlySavingData)
                                                @if (isset($dataStats->yearlySaving))
                                                    @if ($dataStats->yearlySaving == $yearlySavingData->id)
                                                        <option value="{{ $yearlySavingData->id }}" selected>
                                                            {{ $yearlySavingData->yearlySavingEng }}
                                                            ({{ $yearlySavingData->yearlySavingBng }})
                                                        </option>
                                                    @else
                                                        <option value="{{ $yearlySavingData->id }}">
                                                            {{ $yearlySavingData->yearlySavingEng }}
                                                            ({{ $yearlySavingData->yearlySavingBng }})
                                                        </option>
                                                    @endif
                                                @else
                                                    <option value="{{ $yearlySavingData->id }}">
                                                        {{ $yearlySavingData->yearlySavingEng }}
                                                        ({{ $yearlySavingData->yearlySavingBng }})
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @if ($errors->has('yearlySaving'))
                                            <div class="invalid-feedback">
                                                {{ 'This field is required' }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-600">Livelihood crisis (জীবিকার আপদকাল)</label>
                                        <select class="form-control" name="dangerPeriodOfLiving">
                                            <option value="">Select</option>
                                            @foreach ($deficiencyPeriodList as $deficiencyPeriodData)
                                                @if (isset($dataStats->dangerPeriodOfLiving))
                                                    @if ($dataStats->dangerPeriodOfLiving == $deficiencyPeriodData->id)
                                                        <option value="{{ $deficiencyPeriodData->id }}" selected>
                                                            {{ $deficiencyPeriodData->deficiencyPeriodEng }}
                                                            ({{ $deficiencyPeriodData->deficiencyPeriodBng }})
                                                        </option>
                                                    @else
                                                        <option value="{{ $deficiencyPeriodData->id }}">
                                                            {{ $deficiencyPeriodData->deficiencyPeriodEng }}
                                                            ({{ $deficiencyPeriodData->deficiencyPeriodBng }})
                                                        </option>
                                                    @endif
                                                @else
                                                    <option value="{{ $deficiencyPeriodData->id }}">
                                                        {{ $deficiencyPeriodData->deficiencyPeriodEng }}
                                                        ({{ $deficiencyPeriodData->deficiencyPeriodBng }})
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @if ($errors->has('dangerPeriodOfLiving'))
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
                                {{-- <div class="col-xs-6 col-sm-6 col-md-6 p-l-30 p-r-30 text-left">
                                        <a type="button" href="{{ route('createFishermenFamilyInformation') }}"
                                            class="btn btn-danger"><i class="typcn typcn-arrow-left-thick mr-2"></i> Back</a>
                                    </div> --}}
                                <div class="col-xs-12 col-sm-12 col-md-12 p-l-30 p-r-30 text-right">
                                    <button type="submit" class="btn btn-success mr-1">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    @push('js')
        <script>
            var getId = $('#howToFishing').val();
            // alert(myId);
            if (getId == 1) {
                $('#groupMemberSection').hide();
            } else {
                $('#groupMemberSection').show();
            }
            $(document).ready(function() {
                $('#howToFishing').on('change', function() {
                    $('#groupMemberSection').show();
                    var getId = $('#howToFishing').val();
                    // alert(myId);
                    if (getId == 1) {
                        $('#groupMemberSection').hide();
                    } else {
                        $('#groupMemberSection').show();
                    }
                });
            });
        </script>
        <script>
            // $('#wardSectionId').hide();
            // $('#villageSectionId').hide();
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
            // $('#presentWardSectionId').hide();
            // $('#presentVillageSectionId').hide();
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
                $("#edit-info-form").validate({

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
                        },
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
                        },
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
    @endpush
@endsection
