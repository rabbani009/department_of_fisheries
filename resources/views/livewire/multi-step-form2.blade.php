<div>

    <form wire:submit.prevent="storeFishersData">
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        @if ($currentStep == 1)
            <div class="stepwizard">
                <div class="stepwizard-row setup-panel">
                    <div class="stepwizard-step col-xs-3">
                        <a href="#step-1" type="button" class="btn btn-success btn-circle">1</a>
                        <p><small>Basic Identification (মৌলিক শনাক্তকরণ)</small></p>
                    </div>
                    <div class="stepwizard-step col-xs-3">
                        <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
                        <p><small>Basic Information (মৌলিক তথ্য)</small></p>
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
        @endif
        @if ($currentStep == 2)
            <div class="stepwizard">
                <div class="stepwizard-row setup-panel">
                    <div class="stepwizard-step col-xs-3">
                        <a href="#step-1" type="button" class="btn btn-default btn-circle" disabled="disabled">1</a>
                        <p><small>Basic Identification (মৌলিক শনাক্তকরণ)</small></p>
                    </div>
                    <div class="stepwizard-step col-xs-3">
                        <a href="#step-2" type="button" class="btn btn-success btn-circle">2</a>
                        <p><small>Basic Information (মৌলিক তথ্য)</small></p>
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
        @endif
        @if ($currentStep == 3)
            <div class="stepwizard">
                <div class="stepwizard-row setup-panel">
                    <div class="stepwizard-step col-xs-3">
                        <a href="#step-1" type="button" class="btn btn-default btn-circle" disabled="disabled">1</a>
                        <p><small>Basic Identification (মৌলিক শনাক্তকরণ)</small></p>
                    </div>
                    <div class="stepwizard-step col-xs-3">
                        <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
                        <p><small>Basic Information (মৌলিক তথ্য)</small></p>
                    </div>
                    <div class="stepwizard-step col-xs-3">
                        <a href="#step-3" type="button" class="btn btn-success btn-circle">3</a>
                        <p><small>Address (ঠিকানা)</small></p>
                    </div>
                    <div class="stepwizard-step col-xs-3">
                        <a href="#step-4" type="button" class="btn btn-default btn-circle" disabled="disabled">4</a>
                        <p><small>Fishing Information (মাছ ধরার তথ্য)</small></p>
                    </div>
                </div>
            </div>
        @endif
        @if ($currentStep == 4)
            <div class="stepwizard">
                <div class="stepwizard-row setup-panel">
                    <div class="stepwizard-step col-xs-3">
                        <a href="#step-1" type="button" class="btn btn-default btn-circle" disabled="disabled">1</a>
                        <p><small>Basic Identification (মৌলিক শনাক্তকরণ)</small></p>
                    </div>
                    <div class="stepwizard-step col-xs-3">
                        <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
                        <p><small>Basic Information (মৌলিক তথ্য)</small></p>
                    </div>
                    <div class="stepwizard-step col-xs-3">
                        <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
                        <p><small>Address (ঠিকানা)</small></p>
                    </div>
                    <div class="stepwizard-step col-xs-3">
                        <a href="#step-4" type="button" class="btn btn-success btn-circle">4</a>
                        <p><small>Fishing Information (মাছ ধরার তথ্য)</small></p>
                    </div>
                </div>
            </div>
        @endif
        <div class="card mb-4">
            @if ($currentStep == 1)
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="fs-17 font-weight-600 mb-0">Basic Identification (মৌলিক শনাক্তকরণ)</h6>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 p-l-30 p-r-30 left-side">
                            <div class="form-group">
                                <label class="font-weight-600">Mobile No (মোবাইল নাম্বার)</label>
                                <input type="number" class="form-control" wire:model="phone"
                                    value="{{ old('phone') }}" placeholder="Enter Mobile No">
                                @error('phone')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-6 p-l-30 p-r-30">
                            <div class="form-group">
                                <label class="font-weight-600">National Identity Card (NID) (জাতীয় পরিচয়পত্র
                                    নং)</label>
                                <input type="number" class="form-control" wire:model="nid"
                                    placeholder="Enter Your National ID No" value="{{ old('nid') }}">
                                @error('nid')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @if ($currentStep == 2)
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="fs-17 font-weight-600 mb-0">Basic Information (মৌলিক তথ্য)</h6>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 p-l-30 p-r-30 left-side">
                            <div class="form-group">
                                <label class="font-weight-600">Name (নাম)</label>
                                <input type="text" class="form-control" wire:model="fisherName"
                                    value="{{ old('fisherName') }}" placeholder="Enter Fisher Name">
                                @error('fisherName')
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-600">Father's Name (পিতার নাম)</label>
                                <input type="text" class="form-control" wire:model="fatherName"
                                    value="{{ old('fatherName') }}" placeholder="Enter Father's Name">
                                @error('fatherName')
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-600">Mother's Name (মাতার নাম)</label>
                                <input type="text" class="form-control" wire:model="motherName"
                                    value="{{ old('motherName') }}" placeholder="Enter Mother's Name">
                                @error('motherName')
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">

                                <fieldset class="fieldset-border">
                                    <legend class="legend-border">Date of Birth* (জন্ম তারিখ)</legend>

                                    <div class="form-row">
                                        <div class="col-md-4 mb-3">

                                            <label class="font-weight-600">Day (দিন)</label>
                                            <select id="dateOfBirthDay" wire:model="dateOfBirthDay"
                                                class="form-control">
                                                <option value="">Select</option>
                                                <option value="01">1</option>
                                                <option value="02">2</option>
                                                <option value="03">3</option>
                                                <option value="04">4</option>
                                                <option value="05">5</option>
                                                <option value="06">6</option>
                                                <option value="07">7</option>
                                                <option value="08">8</option>
                                                <option value="09">9</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                                <option value="12">12</option>
                                                <option value="13">13</option>
                                                <option value="14">14</option>
                                                <option value="15">15</option>
                                                <option value="16">16</option>
                                                <option value="17">17</option>
                                                <option value="18">18</option>
                                                <option value="19">19</option>
                                                <option value="20">20</option>
                                                <option value="21">21</option>
                                                <option value="22">22</option>
                                                <option value="23">23</option>
                                                <option value="24">24</option>
                                                <option value="25">25</option>
                                                <option value="26">26</option>
                                                <option value="27">27</option>
                                                <option value="28">28</option>
                                                <option value="29">29</option>
                                                <option value="30">30</option>
                                                <option value="31">31</option>
                                            </select>
                                            @error('dateOfBirthDay')
                                                <div class="invalid-feedback">
                                                    {{ 'This field is required' }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="font-weight-600">Month (মাস)</label>
                                            <select wire:model="dateOfBirthMonth" class="form-control">
                                                <option value="">Select</option>
                                                <option value="01">January</option>
                                                <option value="02">February</option>
                                                <option value="03">March</option>
                                                <option value="04">April</option>
                                                <option value="05">May</option>
                                                <option value="06">June</option>
                                                <option value="07">July</option>
                                                <option value="08">August</option>
                                                <option value="09">September</option>
                                                <option value="10">October</option>
                                                <option value="11">November</option>
                                                <option value="12">December</option>
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
                                            <select wire:model="dateOfBirthYear" class="form-control">
                                                <option value="">Select</option>
                                                @for ($year = 1940; $year <= $getYear; $year++)
                                                    <option value="{{ $year }}">{{ $year }}</option>
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
                            <input type="hidden" class="form-control" wire:model="dob"
                            value="{{ $dob }}">
                         
                            <div class="form-group">
                                <label class="font-weight-600">Age (বয়স)</label>
                                <input type="text" class="form-control" wire:model="age"
                                    value="{{ $age }}" readonly>
                                @error('age')
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1" class="font-weight-600">Religion (ধর্ম)</label>
                                <select class="form-control" wire:model="religion">
                                    <option value="">Select Religion</option>
                                    <option value="islam">Islam (ইসলাম)</option>
                                    <option value="christian">Christian (খ্রিষ্টান)</option>
                                    <option value="hindu">Hindu (হিন্দু)</option>
                                    <option value="buddhist">Buddhist (বৌদ্ধ)</option>
                                    <option value="traditional">Traditional (সনাতন)</option>
                                    <option value="others">Others (অন্যান্য)</option>
                                </select>
                                @error('religion')
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-600">Educational Qualification (শিক্ষাগত যোগ্যতা)</label>
                                <select class="form-control" wire:model="educationalQualification">
                                    <option value="">Select One</option>
                                    @foreach ($educationalQualifications as $edu)
                                        <option value="{{ $edu->id }}">{{ $edu->educationalQualification }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('educationalQualification')
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @enderror
                            </div>

                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-6 p-l-30 p-r-30">
                            <div class="form-group">
                                <label class="font-weight-600 mr-3">Marital Status (বৈবাহিক অবস্থা)</label> <br>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="maritalStatus1" wire:model="maritalStatus"
                                        class="custom-control-input" value="Married">
                                    <label class="custom-control-label" for="maritalStatus1">Married (বিবাহিত)</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="maritalStatus2" wire:model="maritalStatus"
                                        class="custom-control-input" value="Unmarried">
                                    <label class="custom-control-label" for="maritalStatus2">Unmarried
                                        (অবিবাহিত)</label>
                                </div>
                                {{-- <br> --}}
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="maritalStatus3" wire:model="maritalStatus"
                                        class="custom-control-input" value="Divorced">
                                    <label class="custom-control-label" for="maritalStatus3">Divorced
                                        (তালাকপ্রাপ্ত)</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="maritalStatus4" wire:model="maritalStatus"
                                        class="custom-control-input" value="Widow">
                                    <label class="custom-control-label" for="maritalStatus4">Widow (বিধবা)</label>
                                </div>
                                @error('maritalStatus')
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-600">Spouse Name (স্বামী বা স্ত্রী নাম)</label>
                                <input type="text" class="form-control" wire:model="spouseName"
                                    value="{{ old('spouseName') }}" placeholder="Enter Spouse Name">
                                @error('spouseName')
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-600">Number Of Family Members (পরিবারের সদস্য সংখ্যা)</label>
                                <input type="number" class="form-control" wire:model="familyMember"
                                    value="{{ old('familyMember') }}" placeholder="Enter Number of family members">
                                @error('familyMember')
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-600">Number Of Child (সন্তানের সংখ্যা)</label>
                                <input type="number" class="form-control" wire:model="numberOfChild"
                                    value="{{ old('numberOfChild') }}" placeholder="Enter Number of Child">
                                @error('numberOfChild')
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-600 mr-3">Gender (লিঙ্গ)</label> <br>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="customRadioInline1" wire:model="gender"
                                        class="custom-control-input" value="Male">
                                    <label class="custom-control-label" for="customRadioInline1">Male (পুরুষ)</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="customRadioInline2" wire:model="gender"
                                        class="custom-control-input" value="Female">
                                    <label class="custom-control-label" for="customRadioInline2">Female (মহিলা)</label>
                                </div>
                                @error('gender')
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-600 mr-3">Physically Handicapped (শারীরিক প্রতিবন্ধী)</label>
                                <br>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="physicallyHandicapped1" wire:model="physicallyHandicapped"
                                        class="custom-control-input" value="Yes">
                                    <label class="custom-control-label" for="physicallyHandicapped1">Yes
                                        (হ্যাঁ)</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="physicallyHandicapped2" wire:model="physicallyHandicapped"
                                        class="custom-control-input" value="No">
                                    <label class="custom-control-label" for="physicallyHandicapped2">No (না)</label>
                                </div>
                                @error('physicallyHandicapped')
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label class="font-weight-600 mr-3">Nationality (জাতীয়তা)</label> <br>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="nationality1" wire:model="nationality"
                                        class="custom-control-input" value="Bangladeshi">
                                    <label class="custom-control-label" for="nationality1">Bangladeshi (বাংলাদেশী
                                        জন্মসূত্রে)</label>
                                </div>
                                {{-- <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="nationality2" wire:model="nationality"
                                        class="custom-control-input" value="0">
                                    <label class="custom-control-label" for="nationality2">Female</label>
                                </div> --}}
                                {{-- @error('nationality')
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @enderror --}}
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1" class="font-weight-600">Birth Place
                                    (জন্মস্থান)</label>
                                <select class="form-control" wire:model="birthPlace">
                                    <option value="">Select Birth Place</option>
                                    @foreach ($districtData as $districtname)
                                        <option value="{{ $districtname->id }}">{{ $districtname->name }}
                                            ({{ $districtname->bn_name }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('birthPlace')
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

            @endif

            @if ($currentStep == 3)
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="fs-17 font-weight-600 mb-0">Address (ঠিকানা)</h6>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 p-l-30 p-r-30 left-side">


                            <div class="form-group">
                                <label for="exampleFormControlSelect1" class="font-weight-600">Division (বিভাগ)</label>
                                <select class="form-control" wire:model="division">
                                    <option value="">Select Division</option>

                                    @foreach ($getdivisions as $divisionList)
                                        <option value="{{ $divisionList->id }}">{{ $divisionList->name }}</option>
                                    @endforeach
                                </select>
                                @error('division')
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1" class="font-weight-600">District (জেলা)</label>
                                <select class="form-control" wire:model="district" id="districtId">
                                    <option value="">Select district</option>
                                    @if (!is_null($division))

                                        @foreach ($getdistricts as $getdistrictsList)
                                            <option value="{{ $getdistrictsList->id }}">
                                                {{ $getdistrictsList->name }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('district')
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1" class="font-weight-600">Upazila (উপজেলা)</label>
                                <select class="form-control" wire:model="upazila" id="upazilaId">
                                    <option value="">Select Upazila</option>
                                    @if (!is_null($district))

                                        @foreach ($getupazila as $getupazilaList)
                                            <option value="{{ $getupazilaList->id }}">{{ $getupazilaList->name }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('upazila')
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1" class="font-weight-600">Area (এলাকা)</label>
                                <select class="form-control" wire:model="area" id="areaId">
                                    <option value="">Select Area</option>
                                    @if (!is_null($upazila))

                                        @foreach ($getarea as $getareaList)
                                            <option value="{{ $getareaList->id }}">{{ $getareaList->name }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('area')
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @enderror
                            </div>

                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 p-l-30 p-r-30">

                            <div class="form-group">
                                <label class="font-weight-600">Village/House No./Road No./Other Alternative
                                    (গ্রাম/বাড়ি
                                    নম্বর/রাস্তা নম্বর/অন্যান্য বিকল্প)</label>
                                <input type="text" class="form-control" wire:model="address"
                                    value="{{ old('address') }}">
                                @error('address')
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-600">Post Office (ডাক ঘর)</label>
                                <input type="text" class="form-control" wire:model="postOffice"
                                    placeholder="Enter Post Office" value="{{ old('postOffice') }}">
                                @error('postOffice')
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-600">Permanent Address (স্থায়ী ঠিকানা)</label>
                                <input type="text" class="form-control" wire:model="permanentAddress"
                                    placeholder="Enter Post Office" value="{{ old('permanentAddress') }}">
                                @error('permanentAddress')
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-600">Present Address (বর্তমান ঠিকানা)</label>
                                <input type="text" class="form-control" wire:model="presentAddress"
                                    placeholder="Enter Post Office" value="{{ old('presentAddress') }}">
                                @error('presentAddress')
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            {{-- @php
                echo '<pre>';
                print_r($fishingTimeData);
                echo '</pre>';
            @endphp --}}
            @if ($currentStep == 4)
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="fs-17 font-weight-600 mb-0">Fishing Information (মাছ ধরার তথ্য)</h6>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 p-l-30 p-r-30 left-side">
                            <div class="form-group">
                                <label class="font-weight-600">Fishing Area (মাছ ধরার এলাকা)</label>
                                <input type="text" class="form-control" wire:model="fishingArea"
                                    placeholder="Enter Fishing Area" value="{{ old('fishingArea') }}">
                                @error('fishingArea')
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-600">Fishing Time (মৎস্য আহরণকাল)</label>
                                <select class="form-control" wire:model="fishingTime">
                                    <option value="">Select One</option>
                                    @foreach ($fishingTimeData as $fishing)
                                        <option value="{{ $fishing->id }}">{{ $fishing->fishingTime }}</option>
                                    @endforeach
                                </select>
                                @error('fishingTime')
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-600">Types Of Fishing (আহরিত মাছের ধরন)</label>
                                <input type="text" class="form-control" wire:model="typesOfFishing">
                                @error('typesOfFishing')
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-600">Place Of Fishing (মাছ ধরার স্থান)</label>
                                <select class="form-control" wire:model="placeOfFishing">
                                    <option value="">Select One</option>
                                    @foreach ($placeOfFishingData as $placeFishing)
                                        <option value="{{ $placeFishing->id }}">
                                            {{ $placeFishing->placeOfFishing }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('fishSalePlace')
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 p-l-30 p-r-30">
                            <div class="form-group">
                                <label class="font-weight-600">Fish Sale Place (মাছ বিক্রির স্থান)</label>
                                <select class="form-control" wire:model="fishSalePlace">
                                    <option value="">Select One</option>
                                    @foreach ($fishSalePlaceData as $fishSale)
                                        <option value="{{ $fishSale->id }}">{{ $fishSale->fishSalePlace }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('fishSalePlace')
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-600">Yearly Loan (বার্ষিক ঋণ)</label>

                                <select class="form-control" wire:model="yearlyLoan">
                                    <option value="">Select One</option>
                                    @foreach ($yearlyLoansData as $yearlyL)
                                        <option value="{{ $yearlyL->id }}">{{ $yearlyL->yearlyLoanAmount }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('yearlyLoan')
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-600">Yearly Savings (বার্ষিক সঞ্চয়)</label>
                                <select class="form-control" wire:model="yearlySavings">
                                    <option value="">Select One</option>
                                    @foreach ($yearlySavingsData as $yearlyS)
                                        <option value="{{ $yearlyS->id }}">{{ $yearlyS->yearlySavingsAmount }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('yearlySavings')
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-600">Crisis Period (জীবিকার আপদকাল)</label>
                                <select class="form-control" wire:model="crisisPeriod">
                                    <option value="">Select One</option>
                                    @foreach ($crisisPeriodsData as $crisisP)
                                        <option value="{{ $crisisP->id }}">{{ $crisisP->crisisPeriod }}</option>
                                    @endforeach
                                </select>
                                @error('crisisPeriod')
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-600">Ship Ownership (জাহাজের মালিকানা)</label>
                                <select class="form-control" wire:model="ownerOfVessels">
                                    <option value="">Select One</option>
                                    @foreach ($ownerOfVesselsData as $ownerOfV)
                                        <option value="{{ $ownerOfV->id }}">{{ $ownerOfV->ownerOfVessels }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('ownerOfVessels')
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="card-footer text-right">
                @if ($currentStep == 2 || $currentStep == 3 || $currentStep == 4)
                    <button type="button" class="btn btn-warning mr-1" wire:click="decreaseStep()">Back</button>
                @endif
                @if ($currentStep == 1 || $currentStep == 2 || $currentStep == 3)
                    <button type="button" class="btn btn-success" wire:click="increaseStep()">Next</button>
                @endif
                @if ($currentStep == 4)
                    <button type="submit" class="btn btn-info mr-1">Submit</button>
                @endif
            </div>

        </div>

    </form>
</div>
