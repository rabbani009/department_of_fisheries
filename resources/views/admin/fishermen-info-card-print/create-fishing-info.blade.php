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
                    <a href="{{ route('createFishermenAddressInformation') }}" type="button"
                        class="btn btn-default btn-circle" disabled="disabled">3</a>
                    <p><small>Address (ঠিকানা)</small></p>
                </div>
                <div class="stepwizard-step col-xs-3">
                    <a href="#step-4" type="button" class="btn btn-success btn-circle">4</a>
                    <p class="text-style"><small>Fishing Information (মাছ ধরার তথ্য)</small></p>
                </div>
            </div>
        </div>
        <form id="fishing-info-form" action="{{ route('storeFishermenFishingInformation') }}" method="post">
            @csrf
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
                                <label class="font-weight-600">Time Of Fishing (মৎস্য আহরণকাল)<span class="required-css">*</span></label>
                                <select class="form-control" name="timeOfFishing">
                                    <option value="">Select</option>
                                    @foreach ($timeOfFishingList as $timeOfFishingData)
                                        @if (old('timeOfFishing') == $timeOfFishingData->id)
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
                                    @endforeach
                                </select>
                                @if ($errors->has('timeOfFishing'))
                                <div class="invalid-feedback">
                                    {{ 'This field is required' }}
                                    {{-- {{ $errors->first('timeOfFishing' ) }} --}}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="font-weight-600">Place Of Fishing (মৎস্য আহরণস্থল)<span class="required-css">*</span></label>
                                <div class="row checkbox-section">
                                    @foreach ($placeOfFishingList as $placeOfFishingData)
                                        <div class="col-sm-6">
                                            <div class="checkbox checkbox-success">
                                                <input name="placeOfFishing[]"
                                                    id="{{ $placeOfFishingData->placeEng }}{{ $placeOfFishingData->id }}"
                                                    type="checkbox" value="{{ $placeOfFishingData->id }}"  {{ (is_array(old('placeOfFishing')) && in_array($placeOfFishingData->id, old('placeOfFishing'))) ? ' checked' : '' }}>
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
                                <label class="font-weight-600">Types of fish (আহরিত মাছের ধরন)<span class="required-css">*</span></label>
                                <div class="row checkbox-section">
                                    @foreach ($fishCategoryList as $fishCategoryData)
                                        <div class="col-sm-6">
                                            <div class="checkbox checkbox-success">
                                                <input name="typeOfFish[]"
                                                    id="{{ $fishCategoryData->categoryEng }}{{ $fishCategoryData->id }}"
                                                    type="checkbox" value="{{ $fishCategoryData->id }}"  {{ (is_array(old('typeOfFish')) && in_array($fishCategoryData->id, old('typeOfFish'))) ? ' checked' : '' }}>
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
                                <label class="font-weight-600">Fishing Equipment (মাছ ধরার সরঞ্জাম)<span class="required-css">*</span></label>
                                <div class="row checkbox-section">
                                    @foreach ($fishingEquipmentList as $fishingEquipmentData)
                                        <div class="col-sm-6">
                                            <div class="checkbox checkbox-success">
                                                <input name="toolsType[]"
                                                    id="{{ $fishingEquipmentData->equipmentEng }}{{ $fishingEquipmentData->id }}"
                                                    type="checkbox" value="{{ $fishingEquipmentData->id }}" {{ (is_array(old('toolsType')) && in_array($fishingEquipmentData->id, old('toolsType'))) ? ' checked' : '' }}>
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
                                <label class="font-weight-600">Types of fishing (মৎস্য আহরণের ধরন)<span class="required-css">*</span></label>
                                <select class="form-control" name="howToFishing" id="howToFishing">
                                    <option value="">Select</option>
                                    @foreach ($howToFishingList as $howToFishingData)
                                        @if (old('howToFishing') == $howToFishingData->id)
                                            <option value="{{ $howToFishingData->id }}" selected>
                                                {{ $howToFishingData->howToFishingEng }}
                                                ({{ $howToFishingData->howToFishingBng }})
                                            </option>
                                        @else
                                            <option value="{{ $howToFishingData->id }}">
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
                                <label class="font-weight-600">Number of fishermen in the team (দলে জেলে সংখ্যা)</label>
                                <select class="form-control" name="groupMember">
                                    <option value="">Select</option>
                                    @foreach ($groupMemberList as $groupMemberData)
                                        @if (old('groupMember') == $groupMemberData->id)
                                            <option value="{{ $groupMemberData->id }}" selected>
                                                {{ $groupMemberData->groupMemberEng }}
                                                ({{ $groupMemberData->groupMemberBng }})
                                            </option>
                                        @else
                                            <option value="{{ $groupMemberData->id }}">
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
                                <label class="font-weight-600">Fish sale place (মাছ বিক্রির স্থান)<span class="required-css">*</span></label>
                                <div class="row checkbox-section">
                                    @foreach ($fishSalePlacesList as $fishSalePlacesData)
                                        <div class="col-sm-12">
                                            <div class="checkbox checkbox-success">
                                                <input name="salePlaceOfFish[]"
                                                    id="{{ $fishSalePlacesData->salePlaceEng }}{{ $fishSalePlacesData->id }}"
                                                    type="checkbox" value="{{ $fishSalePlacesData->id }}" {{ (is_array(old('salePlaceOfFish')) && in_array($fishSalePlacesData->id, old('salePlaceOfFish'))) ? ' checked' : '' }}>
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
                                <label class="font-weight-600">Ownership of the net (জালের মালিকানা)<span class="required-css">*</span></label>
                                <select class="form-control" name="ownerOfNet">
                                    <option value="">Select</option>
                                    @foreach ($ownerOfNetList as $ownerOfNetData)
                                        @if (old('ownerOfNet') == $ownerOfNetData->id)
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
                                        <label class="font-weight-600">Length of the net (জালের দৈর্ঘ্য)</label>
                                        <input
                                            onkeypress="return /\d/.test(String.fromCharCode(((event||window.event).which||(event||window.event).which)));"
                                            type="text"
                                            onkeypress="return /\d/.test(String.fromCharCode(((event||window.event).which||(event||window.event).which)));"
                                            class="form-control" min=0 name="lengthOfNet"
                                            value="{{ old('lengthOfNet') }}" placeholder="Length of the net">
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
                                            value="{{ old('widthOfNet') }}" placeholder="Width of the net">
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
                                            value="{{ old('priceOfNet') }}" placeholder="Price of net">
                                        @if ($errors->has('priceOfNet'))
                                            <div class="invalid-feedback">
                                                {{ 'This field is required' }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <label class="font-weight-600">Source of money (টাকার উৎস)</label>
                                        <input type="text" class="form-control" id="source-of-money"
                                            name="sourceOfPurchaseOfNet" value="{{ old('sourceOfPurchaseOfNet') }}"
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
                                <label class="font-weight-600">Type Of Vessels (নৌযানের ধরন)<span class="required-css">*</span></label>
                                <select class="form-control" name="typeOfVessels">
                                    <option value="">Select</option>
                                    @foreach ($typeOfVesselsList as $typeOfVesselsData)
                                        @if (old('typeOfVessels') == $typeOfVesselsData->id)
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
                                    @endforeach
                                </select>
                                @if ($errors->has('typeOfVessels'))
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="font-weight-600">Owner Of Vessels (নৌযানের মালিকানা)<span class="required-css">*</span></label>
                                <select class="form-control" name="ownerOfVessels">
                                    <option value="">Select</option>
                                    @foreach ($ownerOfVesselsList as $ownerOfVesselsData)
                                        @if (old('ownerOfVessels') == $ownerOfVesselsData->id)
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
                                        <label class="font-weight-600">Length Of Vessels (নৌযানের দৈর্ঘ্য)</label>
                                        <input type="text"
                                            onkeypress="return /\d/.test(String.fromCharCode(((event||window.event).which||(event||window.event).which)));"
                                            class="form-control" min=0 name="lengthOfVessels"
                                            value="{{ old('lengthOfVessels') }}" placeholder="Length of the vessels">
                                        <small class="form-text text-muted">Meters (মিটার)</small>
                                        @if ($errors->has('lengthOfVessels'))
                                            <div class="invalid-feedback">
                                                {{ 'This field is required' }}
                                            </div>
                                        @endif
                                    </div>

                                    <div class="col-md-6">
                                        <label class="font-weight-600">Width Of Vessels (নৌযানের প্রস্থ)</label>
                                        <input type="text"
                                            onkeypress="return /\d/.test(String.fromCharCode(((event||window.event).which||(event||window.event).which)));"
                                            class="form-control" min=0 name="widthOfVessels"
                                            value="{{ old('widthOfVessels') }}" placeholder="Width of the vessels">
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
                                        <label class="font-weight-600">Height Of Vessels (নৌযানের উচ্চতা)</label>
                                        <input type="text"
                                            onkeypress="return /\d/.test(String.fromCharCode(((event||window.event).which||(event||window.event).which)));"
                                            class="form-control" min=0 name="heightOfVessels"
                                            value="{{ old('heightOfVessels') }}" placeholder="Height of the vessels">
                                        <small class="form-text text-muted">Meters (মিটার)</small>
                                        @if ($errors->has('heightOfVessels'))
                                            <div class="invalid-feedback">
                                                {{ 'This field is required' }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <label class="font-weight-600">Price Of Vessels (নৌযানের মূল্য)</label>
                                        <input type="text"
                                            onkeypress="return /\d/.test(String.fromCharCode(((event||window.event).which||(event||window.event).which)));"
                                            class="form-control" min=0 name="priceOfVessels"
                                            value="{{ old('priceOfVessels') }}" placeholder="Price of the vessels">
                                        @if ($errors->has('priceOfVessels'))
                                            <div class="invalid-feedback">
                                                {{ 'This field is required' }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-600">Registration No Of Vessels (নৌযানের রেজিষ্ট্রেশন
                                    নং)</label>
                                <input type="text"
                                    onkeypress="return /\d/.test(String.fromCharCode(((event||window.event).which||(event||window.event).which)));"
                                    class="form-control" min=0 name="regiNoOfVessels"
                                    value="{{ old('regiNoOfVessels') }}" placeholder="Registration No Of Vessels">
                                @if ($errors->has('regiNoOfVessels'))
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="font-weight-600">Types of employment on the boat (নৌযানে কর্মসংস্থানের
                                    ধরন)<span class="required-css">*</span></label>
                                <select class="form-control" name="typeOfEmploymentInVessels">
                                    <option value="">Select</option>
                                    @foreach ($typeOfEmploymentStatusinVesselsList as $typeOfEmploymentStatusinVesselsData)
                                        @if (old('typeOfEmploymentInVessels') == $typeOfEmploymentStatusinVesselsData->id)
                                            <option value="{{ $typeOfEmploymentStatusinVesselsData->id }}" selected>
                                                {{ $typeOfEmploymentStatusinVesselsData->employmentsInVesselsEng }}
                                                ({{ $typeOfEmploymentStatusinVesselsData->employmentsInVesselsBng }})
                                            </option>
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
                                <input type="text" class="form-control" name="mainProfession" id="main-profession-input-area"
                                    value="{{ old('mainProfession') }}" placeholder="Main Profession">
                                @if ($errors->has('mainProfession'))
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="font-weight-600">Sub Profession (সহযোগী পেশা)</label>
                                <input type="text" class="form-control" name="subProfession" id="sub-profession-input-area"
                                    value="{{ old('subProfession') }}" placeholder="Sub Profession">
                                @if ($errors->has('subProfession'))
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="font-weight-600">Annual Income (বার্ষিক আয়)</label>
                                <input type="text" onkeypress="return /\d/.test(String.fromCharCode(((event||window.event).which||(event||window.event).which)));" class="form-control" name="annualIncome"
                                    value="{{ old('annualIncome') }}" placeholder="Annual Income">
                                @if ($errors->has('annualIncome'))
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="font-weight-600">Income From Main Profession (প্রধান পেশা থেকে আয়)</label>
                                <input type="text" class="form-control" onkeypress="return /\d/.test(String.fromCharCode(((event||window.event).which||(event||window.event).which)));" name="incomeMainProfession"
                                    value="{{ old('incomeMainProfession') }}" placeholder="Income From Main Profession">
                                @if ($errors->has('incomeMainProfession'))
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="font-weight-600">Income From Sub Profession (সহযোগী পেশা (সমূহ) থেকে
                                    আয়)</label>
                                <input type="text" onkeypress="return /\d/.test(String.fromCharCode(((event||window.event).which||(event||window.event).which)));" class="form-control" name="incomeSubProfession"
                                    value="{{ old('incomeSubProfession') }}" placeholder="Annual Income">
                                @if ($errors->has('incomeSubProfession'))
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="font-weight-600">Annual loan amount (বার্ষিক ঋণের পরিমাণ)<span class="required-css">*</span></label>
                                <select class="form-control" name="yearlyLoan">
                                    <option value="">Select</option>
                                    @foreach ($yearlyLoanList as $yearlyLoanData)
                                        @if (old('yearlyLoan') == $yearlyLoanData->id)
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
                                    @endforeach
                                </select>
                                @if ($errors->has('yearlyLoan'))
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="font-weight-600">Annual savings amount (বার্ষিক সঞ্চয়ের পরিমাণ)<span class="required-css">*</span></label>
                                <select class="form-control" name="yearlySaving">
                                    <option value="">Select</option>
                                    @foreach ($yearlySavingList as $yearlySavingData)
                                        @if (old('yearlySaving') == $yearlySavingData->id)
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
                                    @endforeach
                                </select>
                                @if ($errors->has('yearlySaving'))
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="font-weight-600">Livelihood crisis (জীবিকার আপদকাল)<span class="required-css">*</span></label>
                                <select class="form-control" name="dangerPeriodOfLiving">
                                    <option value="">Select</option>
                                    @foreach ($deficiencyPeriodList as $deficiencyPeriodData)
                                        @if (old('dangerPeriodOfLiving') == $deficiencyPeriodData->id)
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
                        <div class="col-xs-6 col-sm-6 col-md-6 p-l-30 p-r-30 text-left">
                            <a type="button" href="{{ route('createFishermenAddressInformation') }}"
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
            $(document).ready(function() {
                $('#howToFishing').on('change', function() {
                    $('#groupMemberSection').show();
                    var getId = $('#howToFishing').val();
                    // alert(myId);
                    if (getId == 1) {
                        $('#groupMemberSection').hide();
                    }
                });
            });
        </script>
        {{-- <script>
            $(document).ready(function() {
                $.validator.addMethod("lettersonly", function(value, element) {
                    return this.optional(element) || /^[a-zA-z\s]+$/i.test(value);
                }, "Please enter only alphabet");
                $("#fishing-info-form").validate({

                    rules: {
                        // 'typeOfFish[]': {
                        //     required: true,
                        //     minlength: 1
                        //     // required: function(elem) {
                        //     //     return $("input.select:checked").length > 0;
                        //     // }

                        // },
                        timeOfFishing: {
                            required: true 
                        }
                    }
                });
            });
        </script> --}}
        {{-- <script>
            function validate(){
    if ($('input[name^=typeOfFish]:checked').length <= 0) {
        alert("Not active");
    }else{
        alert("active");
    }
}
        </script> --}}
    @endpush
@endsection
