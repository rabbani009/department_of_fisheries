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
                    <h1 class="font-weight-bold">Update Fisher Registration Data</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-4 text-right  p-0">
            <a href="{{ route('fishersList') }}" class="btn btn-success mb-2 mr-1">
                <i class="typcn typcn-arrow-back mr-2"></i>Back</a>
        </div>
    </div>

    <div class="body-content">
        <form action="{{ route('updateFishers') }}" method="post">
            @csrf
            <input type="hidden" name="id" value="{{ $data->id }}">
            <div class="card mb-4">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="fs-17 font-weight-600 mb-0 text-edit">Basic Identification (মৌলিক শনাক্তকরণ)</h6>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 p-l-30 p-r-30 left-side">
                            <div class="form-group">
                                <label class="font-weight-600">Mobile No (মোবাইল নাম্বার)</label>
                                <input type="number" class="form-control" name="phone" value="{{ $data->phone }}"
                                    placeholder="Enter Phone No">
                                @if ($errors->has('phone'))
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 p-l-30 p-r-30">
                            <div class="form-group">
                                <label class="font-weight-600">National Identity Card (NID) (জাতীয় পরিচয়পত্র নং)</label>
                                <input type="number" class="form-control" name="nid"
                                    placeholder="Enter Your National ID No" value="{{ $data->nid }}">
                                @if ($errors->has('nid'))
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
                            <h6 class="fs-17 font-weight-600 mb-0 text-edit">Basic Information (মৌলিক তথ্য)</h6>
                        </div>
                    </div>
                </div>


                <div class="card-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 p-l-30 p-r-30 left-side">
                            <div class="form-group">
                                <label class="font-weight-600">Name (নাম</label>
                                <input type="text" class="form-control" name="fisherName"
                                    value="{{ $data->fisherName ?? '' }}" placeholder="Enter Fisher Name">
                                @if ($errors->has('fisherName'))
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="font-weight-600">Father's Name (পিতার নাম)</label>
                                <input type="text" class="form-control" name="fatherName"
                                    value="{{ $data->fatherName ?? '' }}" placeholder="Enter Father's Name">
                                @if ($errors->has('fatherName'))
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="font-weight-600">Mother's Name (মাতার নাম)</label>
                                <input type="text" class="form-control" name="motherName"
                                    value="{{ $data->motherName ?? '' }}" placeholder="Enter Mother's Name">
                                @if ($errors->has('motherName'))
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
                                            <select name="dateOfBirthDay" class="form-control" id="dateOfBirthDayId">
                                                @if (!empty($data->dateOfBirthDay))
                                                    
                                                <option value="{{ $data->dateOfBirthDay }}">
                                                    {{ $data->dateOfBirthDay }}
                                                </option>
                                                @endif
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
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="font-weight-600">Month (মাস)</label>
                                            <select name="dateOfBirthMonth" class="form-control" id="dateOfBirthMonthId">
                                                @if (!empty($data->dateOfBirthMonth)) 
                                                <option value="{{ $data->dateOfBirthMonth }}">
                                                    {{ $data->dateOfBirthMonth }}</option>
                                                @endif
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
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            @php
                                                $getYear = now()->year;
                                            @endphp
                                            <label class="font-weight-600">Year (বছর)</label>
                                            <select name="dateOfBirthYear" class="form-control" id="dateOfBirthYearId">
                                                @if (!empty($data->dateOfBirthYear))
                                                <option value="{{ $data->dateOfBirthYear }}">
                                                    {{ $data->dateOfBirthYear }}
                                                </option>
                                                @endif
                                                @for ($year = 1940; $year <= $getYear; $year++)
                                                    <option value="{{ $year }}">{{ $year }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>


                                </fieldset>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-600">Age (বয়স)</label>
                                <input type="text" id="ageShow" class="form-control" name="age" value="{{ $data->age ?? '' }}" readonly>
                             
                                @if ($errors->has('motherName'))
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1" class="font-weight-600">Religion</label>
                                <select class="form-control" name="religion">
                           
                                    <option value="{{ $data->religion ?? '' }}">{{ $data->religion ?? '' }}</option>   
                                 
                                    <option value="islam">Islam (ইসলাম)</option>
                                    <option value="christian">Christian (খ্রিষ্টান)</option>
                                    <option value="hindu">Hindu (হিন্দু)</option>
                                    <option value="buddhist">Buddhist (বৌদ্ধ)</option>
                                    <option value="traditional">Traditional (সনাতন)</option>
                                    <option value="others">Others (অন্যান্য)</option>
                                </select>
                                @if ($errors->has('religion'))
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="font-weight-600">Educational Qualification</label>
                                <select class="form-control" name="educationalQualification">
                                    @if (!empty($data->educational_qualifications->id))
                                        <option value="{{ $data->educational_qualifications->id }}">
                                            {{ $data->educational_qualifications->educationalQualification }}</option>
                                    @else
                                        <option value="">Null</option>
                                    @endif
                                    @foreach ($educationalQualifications as $edu)
                                        <option value="{{ $edu->id }}">{{ $edu->educationalQualification }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('educationalQualification'))
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @endif
                            </div>


                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 p-l-30 p-r-30">
                            <div class="form-group">
                                <label class="font-weight-600 mr-3">Marital Status (বৈবাহিক অবস্থা)</label><br>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="maritalStatus1" name="maritalStatus"
                                        class="custom-control-input" value="Married"
                                        {{ $data->maritalStatus == 'Married' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="maritalStatus1">Married (বিবাহিত)</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="maritalStatus2" name="maritalStatus"
                                        class="custom-control-input" value="Unmarried"
                                        {{ $data->maritalStatus == 'Unmarried' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="maritalStatus2">Unmarried
                                        (অবিবাহিত)</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="maritalStatus3" name="maritalStatus"
                                        class="custom-control-input" value="Divorced"
                                        {{ $data->maritalStatus == 'Divorced' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="maritalStatus3">Divorced
                                        (তালাকপ্রাপ্ত)</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="maritalStatus4" name="maritalStatus"
                                        class="custom-control-input" value="Widow"
                                        {{ $data->maritalStatus == 'Widow' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="maritalStatus4">Widow (বিধবা)</label>
                                </div>
                                @if ($errors->has('maritalStatus'))
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="font-weight-600">Spouse Name (স্বামী বা স্ত্রী নাম)</label>
                                <input type="text" class="form-control" name="spouseName"
                                    value="{{ $data->spouseName }}" placeholder="Enter Spouse Name">
                                @if ($errors->has('spouseName'))
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="font-weight-600">Number Of Family Members (পরিবারের সদস্য সংখ্যা)</label>
                                <input type="number" class="form-control" name="familyMember"
                                    value="{{ $data->familyMember }}" placeholder="Enter Number of family members">
                                @if ($errors->has('familyMember'))
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="font-weight-600">Number Of Child (সন্তানের সংখ্যা)</label>
                                <input type="number" class="form-control" name="numberOfChild"
                                    value="{{ $data->numberOfChild }}" placeholder="Enter Number of Child">
                                @if ($errors->has('numberOfChild'))
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="font-weight-600 mr-3">Gender (লিঙ্গ)</label> <br>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="customRadioInline1" name="gender" class="custom-control-input"
                                        value="Male" {{ $data->gender == 'Male' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="customRadioInline1">Male</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="customRadioInline2" name="gender" class="custom-control-input"
                                        value="Female" {{ $data->gender == 'Female' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="customRadioInline2">Female</label>
                                </div>
                                @if ($errors->has('gender'))
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="font-weight-600 mr-3">Physically Handicapped (শারীরিক প্রতিবন্ধী)</label>
                                <br>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="physicallyHandicapped1" name="physicallyHandicapped"
                                        class="custom-control-input" value="Yes"
                                        {{ $data->physicallyHandicapped == 'Yes' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="physicallyHandicapped1">Yes</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="physicallyHandicapped2" name="physicallyHandicapped"
                                        class="custom-control-input" value="No"
                                        {{ $data->physicallyHandicapped == 'No' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="physicallyHandicapped2">No</label>
                                </div>
                                @if ($errors->has('physicallyHandicapped'))
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="font-weight-600 mr-3">Nationality (জাতীয়তা)</label> <br>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="nationality1" name="nationality" class="custom-control-input"
                                        value="Bangladeshi">
                                    <label class="custom-control-label" for="nationality1">Bangladeshi (বাংলাদেশী
                                        জন্মসূত্রে)</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1" class="font-weight-600">Birth Place
                                    (জন্মস্থান)</label>
                                <select class="form-control" name="birthPlace">
                                    <option value="{{$data->birthPlace ?? ''}}">{{$data->birthPlace_data->name ?? ''}}</option>
                                    @foreach ($alldistrictData as $districtname)
                                        <option value="{{ $districtname->id }}">{{ $districtname->name }}
                                            ({{ $districtname->bn_name }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="fs-17 font-weight-600 mb-0 text-edit">Address (ঠিকানা)</h6>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 p-l-30 p-r-30 left-side">
                            <div class="form-group">
                                <label for="exampleFormControlSelect1" class="font-weight-600">Division</label>
                                <select class="form-control" name="division" id="divisionId">
                                    <option value="{{ $data->division ?? '' }}">{{ $data->division_data->name ?? '' }}</option>
                                    @foreach ($divisions as $divisionList)
                                        <option value="{{ $divisionList->id }}">{{ $divisionList->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('division'))
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlSelect1" class="font-weight-600">District</label>
                                <select class="form-control" name="district" id="districtId">
                                    <option value="{{ $data->district ?? '' }}">{{ $data->district_data->name ?? '' }}</option>
                                </select>
                                @if ($errors->has('district'))
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1" class="font-weight-600">Upazila</label>
                                <select class="form-control" name="upazila" id="upazilaId">
                                    <option value="{{ $data->upazila ?? '' }}">{{ $data->upazila_data->name ?? '' }}</option>
                                </select>
                                @if ($errors->has('upazila'))
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1" class="font-weight-600">Area</label>
                                <select class="form-control" name="area" id="areaId">
                                    <option value="{{ $data->area ?? '' }}">{{ $data->area_data->name ?? '' }}</option>
                                </select>
                                @if ($errors->has('area'))
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 p-l-30 p-r-30">
                            <div class="form-group">
                                <label class="font-weight-600">Village/House No./Road No./Other Alternative</label>
                                <input type="text" class="form-control" name="address" value="{{ $data->address ?? '' }}">
                                @if ($errors->has('address'))
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="font-weight-600">Post Office</label>
                                <input type="text" class="form-control" name="postOffice" placeholder="Enter Post Office"
                                    value="{{ $data->postOffice ?? '' }}">
                                @if ($errors->has('postOffice'))
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="font-weight-600">Permanent Address (স্থায়ী ঠিকানা)</label>
                                <input type="text" class="form-control" wire:model="permanentAddress"
                                    placeholder="Enter Post Office" value="{{ $data->permanentAddress ?? '' }}">
                                @if ($errors->has('permanentAddress'))
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="font-weight-600">Present Address (বর্তমান ঠিকানা)</label>
                                <input type="text" class="form-control" wire:model="presentAddress"
                                    placeholder="Enter Post Office" value="{{ $data->presentAddress ?? ''}}">
                                @if ($errors->has('presentAddress'))
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
                            <h6 class="fs-17 font-weight-600 mb-0 text-edit">Fishing Information (মাছ ধরার তথ্য)</h6>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 p-l-30 p-r-30 left-side">
                            <div class="form-group">
                                <label class="font-weight-600">Fishing Area</label>
                                <input type="text" class="form-control" name="fishingArea"
                                    placeholder="Enter Fishing Area" value="{{ $data->fishingArea ?? ''}}">
                                @if ($errors->has('fishingArea'))
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="font-weight-600">Fishing Time (মৎস্য আহরণকাল)</label>
                                <select class="form-control" name="fishingTime">
                                    @if (!empty($data->fishing_time->id))
                                        <option value="{{ $data->fishing_time->id }}">
                                            {{ $data->fishing_time->fishingTime }}</option>
                                    @else
                                        <option value="">Null</option>
                                    @endif
                                    @foreach ($fishingTime as $fishing)
                                        <option value="{{ $fishing->id }}">{{ $fishing->fishingTime }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('fishingTime'))
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="font-weight-600">Types Of Fishing (আহরিত মাছের ধরন)</label>
                                <input type="text" class="form-control" name="typesOfFishing"
                                    value="{{ $data->typesOfFishing ?? '' }}">
                                @if ($errors->has('typesOfFishing'))
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="font-weight-600">Place Of Fishing (মাছ ধরার স্থান)</label>
                                <select class="form-control" name="placeOfFishing">
                                    @if (!empty($data->place_of_fishing->id))
                                        <option value="{{ $data->place_of_fishing->id }}">
                                            {{ $data->place_of_fishing->placeOfFishing }}</option>
                                    @else
                                        <option value="">Null</option>
                                    @endif
                                    @foreach ($placeOfFishing as $placeFishing)
                                        <option value="{{ $placeFishing->id }}">{{ $placeFishing->placeOfFishing }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('fishSalePlace'))
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 p-l-30 p-r-30">
                            <div class="form-group">
                                <label class="font-weight-600">Fish Sale Place (মাছ বিক্রির স্থান)</label>
                                <select class="form-control" name="fishSalePlace">
                                    @if (!empty($data->fish_sale_place->id))
                                        <option value="{{ $data->fish_sale_place->id }}">
                                            {{ $data->fish_sale_place->fishSalePlace }}</option>
                                    @else
                                        <option value="">Null</option>
                                    @endif
                                    @foreach ($fishSalePlace as $fishSale)
                                        <option value="{{ $fishSale->id }}">{{ $fishSale->fishSalePlace }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('fishSalePlace'))
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="font-weight-600">Yearly Loan (বার্ষিক ঋণ)</label>

                                <select class="form-control" name="yearlyLoan">
                                    @if (!empty($data->yearly_loan->id))
                                        <option value="{{ $data->yearly_loan->id }}">
                                            {{ $data->yearly_loan->yearlyLoanAmount }}</option>
                                    @else
                                        <option value="">Null</option>
                                    @endif
                                    @foreach ($yearlyLoans as $yearlyL)
                                        <option value="{{ $yearlyL->id }}">{{ $yearlyL->yearlyLoanAmount }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('yearlyLoan'))
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="font-weight-600">Yearly Savings (বার্ষিক সঞ্চয়)</label>
                                <select class="form-control" name="yearlySavings">
                                    @if (!empty($data->yearly_savings->id))
                                        <option value="{{ $data->yearly_savings->id }}">
                                            {{ $data->yearly_savings->yearlySavingsAmount }}</option>
                                    @else
                                        <option value="">Null</option>
                                    @endif
                                    @foreach ($yearlySavings as $yearlyS)
                                        <option value="{{ $yearlyS->id }}">{{ $yearlyS->yearlySavingsAmount }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('yearlySavings'))
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="font-weight-600">Crisis Period (জীবিকার আপদকাল)</label>
                                <select class="form-control" name="crisisPeriod">
                                    @if (!empty($data->crisis_period->id))
                                        <option value="{{ $data->crisis_period->id }}">
                                            {{ $data->crisis_period->crisisPeriod }}</option>
                                    @else
                                        <option value="">Null</option>
                                    @endif
                                    @foreach ($crisisPeriods as $crisisP)
                                        <option value="{{ $crisisP->id }}">{{ $crisisP->crisisPeriod }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('crisisPeriod'))
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="font-weight-600">Ship Ownership (জাহাজের মালিকানা)</label>
                                <select class="form-control" name="ownerOfVessels">
                                    @if (!empty($data->owner_of_vessels->id))
                                        <option value="{{ $data->owner_of_vessels->id }}">
                                            {{ $data->owner_of_vessels->ownerOfVessels }}</option>
                                    @else
                                        <option value="">Null</option>
                                    @endif
                                    @foreach ($ownerOfVessels as $ownerOfV)
                                        <option value="{{ $ownerOfV->id }}">{{ $ownerOfV->ownerOfVessels }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('ownerOfVessels'))
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @endif
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
                $('#dateOfBirthDayId,#dateOfBirthMonthId,#dateOfBirthYearId').on('change', function() {
                    var birthDay = $('#dateOfBirthDayId').val();
                    var birthMonth = $('#dateOfBirthMonthId').val();
                    var birthYear = $('#dateOfBirthYearId').val();
                    // alert(birthDay);
                    $.ajax({
                            url:"{{ route('getFishersAge') }}",
                            type: 'GET',
                            data: {
                                birthDay: birthDay,
                                birthMonth: birthMonth,
                                birthYear: birthYear,
                            },
                            success: function(data) {
                                // $('#ageShow').html(data);
                                // var propertyName = 'background-color';
                                // var color = '#f8f8f8';
                                $('input[name=age]').val(data.age);
                                console.log(data);
                                // $('input[name=discountPercentage]').val(Math.round(data
                                //     .percent));
                                // $('input[name=totalDiscount]').val(data.dicountTotal);
                                // $('#discountPercentage').html(data).css(propertyName, color);

                            }
                        });
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                $('#divisionId').on('change', function() {
                    // alert('ojdei');
                    $('#districtId').val('');
                    $('#upazilaId').val('');
                    $('#areaId').val('');
                    let value = $(this).children("option:selected").val();

                    $.get('{{ url('/') }}/get-district-list/' + value, function(response) {

                        $('#districtId').html(response);

                        // console.log("ok");
                        // console.log(response);
                    })


                });
                $('#districtId').on('change', function() {
                    $('#upazilaId').val('');
                    $('#areaId').val('');
                    let value = $(this).children("option:selected").val();

                    $.get('{{ url('/') }}/get-upazila-list/' + value, function(response) {

                        $('#upazilaId').html(response);
                        $('#areaId').html();
                        // console.log("ok");
                        // console.log(response);
                    })


                });
                $('#upazilaId').on('change', function() {
                    $('#areaId').val('');
                    let value = $(this).children("option:selected").val();

                    $.get('{{ url('/') }}/get-area-list/' + value, function(response) {

                        $('#areaId').html(response);
                        // console.log("ok");
                        // console.log(response);
                    })


                });
            });
        </script>
    @endpush
@endsection
