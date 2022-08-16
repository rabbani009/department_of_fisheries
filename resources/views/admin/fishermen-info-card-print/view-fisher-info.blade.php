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
                    <h1 class="font-weight-bold">Fishers Details</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-4 text-right  p-0">
            <a href="{{ route('getAllFishersInfo') }}" class="btn btn-success mb-2 mr-1">
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
                            <a class="nav-link" id="tabs_Permanent_Address">Permanent Address <br>(স্থায়ী ঠিকানা)</a>
                            <a class="nav-link" id="tabs_Present_Address">Present Address <br>(বর্তমান ঠিকানা)</a>
                            <a class="nav-link" id="tabs_Fishing">Fishing Information <br>(মাছ ধরার তথ্য)</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-9 col">

                <div class="tab-container" id="tabs_PersonalC">
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
                                <div class="col-xs-10 col-sm-10 col-md-10">
                                    <table class="table table-2 table-striped table-nowrap">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div><strong>Form No (ফর্ম নম্বার)</strong></div>
                                                </td>
                                                <td>:</td>
                                                <td>{{ $data->formId ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div><strong>English Name (ইংরেজি নাম)</strong></div>
                                                </td>
                                                <td>:</td>
                                                <td>{{ $data->fishermanNameEng ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div><strong>QR Code</strong></div>
                                                </td>
                                                <td>:</td>
                                                <td>  {!! QrCode::size(80)->generate('Fishers Id: '.$data->fId. "\n" .'Name: '.$data->fishermanNameEng. "\n" .'National Id No: '.$data->nationalIdNo. "\n" .'Date of Birth: '.date('d-M-Y', strtotime($data->dateOfBirth))) !!}</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div><strong>Bangla Name (বাংলা নাম)</strong></div>
                                                </td>
                                                <td>:</td>
                                                <td>{{ $data->fishermanNameBng ?? '' }}</td>
                                            </tr>
                                            {{-- <tr>
                                                <td>
                                                    <div><strong>Image</strong></div>
                                                </td>
                                                <td>:</td>
                                                <td>
                                                    <img src="{{ asset('uploads/'.$data->photoPath) }}" style="height: 50px;" alt=""></td>
                                            </tr> --}}
                                            <tr>
                                                <td>
                                                    <div><strong>National Id No (জাতীয় পরিচয়পত্র নং)</strong></div>
                                                </td>
                                                <td>:</td>
                                                <td>{{ $data->nationalIdNo ?? '' }}</td>
                                            </tr>


                                            <tr>
                                                <td>
                                                    <div><strong>Mobile Number (মোবাইল নম্বর)</strong></div>
                                                </td>
                                                <td>:</td>
                                                <td>{{ $dataStats->mobile ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div><strong>Gender (লিঙ্গ)</strong></div>
                                                </td>
                                                <td>:</td>
                                                <td>{{ $data->gender ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div><strong>Religion (ধর্ম)</strong></div>
                                                </td>
                                                <td>:</td>
                                                <td>{{ $dataStats->religion_data->religionEnglish ?? '' }}
                                                    ({{ $dataStats->religion_data->religionBangla ?? '' }})</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div><strong>Place Of Birth (জন্মস্থান)</strong></div>
                                                </td>
                                                <td>:</td>
                                                <td>{{ $dataStats->birth_district_data->districtEng ?? '' }}
                                                    ({{ $dataStats->birth_district_data->districtBng ?? '' }})</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div><strong>Date of Birth (জন্ম তারিখ)</strong></div>
                                                </td>
                                                <td>:</td>
                                                <td>{{ date('d-M-Y', strtotime($data->dateOfBirth)) }}</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div><strong>Educational Qualifications (শিক্ষাগত যোগ্যতা)</strong>
                                                    </div>
                                                </td>
                                                <td>:</td>
                                                <td>{{ $dataStats->education_data->educationalQualificationEng ?? '' }}
                                                    ({{ $dataStats->education_data->educationalQualificationBng ?? '' }})
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div><strong>Visible Identification Marks (দৃশ্যমান সনাক্তকরণ
                                                            চিহ্ন)</strong></div>
                                                </td>
                                                <td>:</td>
                                                <td>{{ $dataStats->identificationMark ?? 'N/A' }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-xs-2 col-sm-2 col-md-2">
                                    {{-- @if ($data->photoPath)
                                        
                                    <img src="{{ asset('uploads/'.$data->photoPath) }}" style="height: 100px;" alt="">
                                    @else --}}
                                        <img src="{{ asset('logo/user.png') }}" style="height: 100px;" alt="">
                                    {{-- @endif --}}
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
                                    <h6 class="fs-17 font-weight-600 mb-0 text-edit">Family Information (পারিবারিক তথ্য)
                                    </h6>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <table class="table table-2 table-striped table-nowrap">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div><strong>Mother's Name (মাতার নাম)</strong></div>
                                                </td>
                                                <td>:</td>
                                                <td>{{ $data->mothersName ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div><strong>Father's Name (পিতার নাম)</strong></div>
                                                </td>
                                                <td>:</td>
                                                <td>{{ $data->fathersName ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div><strong>Marital Status (বৈবাহিক অবস্থা)</strong></div>
                                                </td>
                                                <td>:</td>
                                                <td>{{ $dataStats->marital_status_data->maritalStatusEng ?? '' }}
                                                    ({{ $dataStats->marital_status_data->maritalStatusBng ?? '' }})</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div><strong>Spouse Name (স্বামী/স্ত্রীর নাম)</strong></div>
                                                </td>
                                                <td>:</td>
                                                <td>{{ $data->spouseName ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div><strong>Total family members (পরিবারের মোট সদস্য সংখ্যা)</strong>
                                                    </div>
                                                </td>
                                                <td>:</td>
                                                <td>{{ $dataStats->totalFamilyMember ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div><strong>Mother's number (মায়ের সংখ্যা)</strong></div>
                                                </td>
                                                <td>:</td>
                                                <td>{{ $dataStats->numberOfMother ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div><strong>Father's number (পিতার সংখ্যা)</strong></div>
                                                </td>
                                                <td>:</td>
                                                <td>{{ $dataStats->numberOfFather ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div><strong>Number of spouse (স্বামী/স্ত্রী সংখ্যা)</strong></div>
                                                </td>
                                                <td>:</td>
                                                <td>{{ $dataStats->numberOfSpouse ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div><strong>Number of daughters (কন্যা সংখ্যা)</strong></div>
                                                </td>
                                                <td>:</td>
                                                <td>{{ $dataStats->numberOfDaughter ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div><strong>Number of sons (পুত্র সংখ্যা)</strong></div>
                                                </td>
                                                <td>:</td>
                                                <td>{{ $dataStats->numberOfSon ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div><strong>Others (অন্যান্য)</strong></div>
                                                </td>
                                                <td>:</td>
                                                <td>{{ $dataStats->numberOfOtherMember ?? '' }}</td>
                                            </tr>

                                        </tbody>
                                    </table>
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
                                    <h6 class="fs-17 font-weight-600 mb-0 text-edit">Permanent Address (স্থায়ী
                                        ঠিকানা)
                                    </h6>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <table class="table table-2 table-striped table-nowrap">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div><strong>Division (বিভাগ)</strong></div>
                                                </td>
                                                <td>:</td>
                                                <td>{{ $data->fishermen_division->divisionEng ?? '' }}
                                                    ({{ $data->fishermen_division->divisionBng ?? '' }})</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div><strong>District (জেলা)</strong></div>
                                                </td>
                                                <td>:</td>
                                                <td>{{ $data->fishermen_district->districtEng ?? '' }}
                                                    ({{ $data->fishermen_district->districtBng ?? '' }})</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div><strong>Upazila (উপজেলা)</strong></div>
                                                </td>
                                                <td>:</td>
                                                <td>{{ $getPermanentUpazilaData->upazilaEng ?? '' }}
                                                    ({{ $getPermanentUpazilaData->upazilaBng ?? '' }})</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div><strong>Municipality (পৌরসভা)</strong></div>
                                                </td>
                                                <td>:</td>
                                                <td>{{ $getPermanentMunicipalityData->municipalityEnglish ?? 'N/A' }}
                                                    ({{ $getPermanentMunicipalityData->municipalityBangla ?? 'N/A' }})
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div><strong>Ward (ওয়ার্ড)</strong></div>
                                                </td>
                                                <td>:</td>
                                                <td>{{ $getPermanentWardData->unionEng ?? 'N/A' }}
                                                    ({{ $getPermanentWardData->unionBng ?? 'N/A' }})</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div><strong>Union (ইউনিয়ন)</strong></div>
                                                </td>
                                                <td>:</td>
                                                <td>{{ $getPermanentUnionData->unionEng ?? 'N/A' }}
                                                    ({{ $getPermanentUnionData->unionBng ?? 'N/A' }})</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div><strong>Village (গ্রাম)</strong></div>
                                                </td>
                                                <td>:</td>
                                                <td>{{ $getPermanentVillageData->villageEng ?? 'N/A' }}
                                                    ({{ $getPermanentVillageData->villageBng ?? 'N/A' }})</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div><strong>Post Office (ডাক ঘর)</strong></div>
                                                </td>
                                                <td>:</td>
                                                <td>{{ $getPermanentPostOfficeData->postOfficeEnglish ?? 'N/A' }}
                                                    ({{ $getPermanentPostOfficeData->postOfficeBangla ?? 'N/A' }})</td>
                                            </tr>
                                        </tbody>
                                    </table>
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
                                    <h6 class="fs-17 font-weight-600 mb-0 text-edit">Present Address (বর্তমান ঠিকানা)</h6>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <table class="table table-2 table-striped table-nowrap">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div><strong>Division (বিভাগ)</strong></div>
                                                </td>
                                                <td>:</td>
                                                <td>{{ $dataStats->fishermen_present_division->divisionEng ?? '' }}
                                                    ({{ $dataStats->fishermen_present_division->divisionBng ?? '' }})
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div><strong>District (জেলা)</strong></div>
                                                </td>
                                                <td>:</td>
                                                <td>{{ $dataStats->fishermen_present_district->districtEng ?? '' }}
                                                    ({{ $dataStats->fishermen_present_district->districtBng ?? '' }})
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div><strong>Upazila (উপজেলা)</strong></div>
                                                </td>
                                                <td>:</td>
                                                <td>{{ $getPresentUpazilaData->upazilaEng ?? '' }}
                                                    ({{ $getPresentUpazilaData->upazilaBng ?? '' }})</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div><strong>Municipality (পৌরসভা)</strong></div>
                                                </td>
                                                <td>:</td>
                                                <td>{{ $getPresentMunicipalityData->municipalityEnglish ?? 'N/A' }}
                                                    ({{ $getPresentMunicipalityData->municipalityBangla ?? 'N/A' }})
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div><strong>Ward (ওয়ার্ড)</strong></div>
                                                </td>
                                                <td>:</td>
                                                <td>{{ $getPresentWardData->unionEng ?? 'N/A' }}
                                                    ({{ $getPresentWardData->unionBng ?? 'N/A' }})</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div><strong>Union (ইউনিয়ন)</strong></div>
                                                </td>
                                                <td>:</td>
                                                <td>{{ $getPresentUnionData->unionEng ?? 'N/A' }}
                                                    ({{ $getPresentUnionData->unionBng ?? 'N/A' }})</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div><strong>Village (গ্রাম)</strong></div>
                                                </td>
                                                <td>:</td>
                                                <td>{{ $getPresentVillageData->villageEng ?? 'N/A' }}
                                                    ({{ $getPresentVillageData->villageBng ?? 'N/A' }})</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div><strong>Post Office (ডাক ঘর)</strong></div>
                                                </td>
                                                <td>:</td>
                                                <td>{{ $getPresentPostOfficeData->postOfficeEnglish ?? 'N/A' }}
                                                    ({{ $getPresentPostOfficeData->postOfficeBangla ?? 'N/A' }})</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-container" id="tabs_FishingC">
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
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-2 display table-striped">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div><strong>Types of fishing (মৎস্য আহরণের ধরন)</strong></div>
                                                    </td>
                                                    <td>:</td>
                                                    <td>{{ $dataStats->fishermen_time_of_fishings->timeOfFishingEng ?? '' }}
                                                        ({{ $dataStats->fishermen_time_of_fishings->timeOfFishingBng ?? '' }})
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div><strong>Place Of Fishing (মৎস্য আহরণস্থল)</strong></div>

                                                    </td>
                                                    <td>:</td>
                                                    <td>
                                                        @php
                                                            $dataPlaceOfFishing = explode(',', $dataStats->placeOfFishing ?? '');
                                                        @endphp
                                                        @foreach ($placeOfFishingList as $placeOfFishingData)
                                                            @if (in_array($placeOfFishingData->id, $dataPlaceOfFishing))
                                                                <span class="route-access-name-design">
                                                                    {{ $placeOfFishingData->placeEng }}
                                                                    ({{ $placeOfFishingData->placeBng }})
                                                                </span>
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div><strong>Types of fish (আহরিত মাছের ধরন)</strong></div>

                                                    </td>
                                                    <td>:</td>
                                                    <td>
                                                        @php
                                                            $dataFishCategoryList = explode(',', $dataStats->typeOfFish ?? '');
                                                        @endphp
                                                        @foreach ($fishCategoryList as $fishCategoryData)
                                                            @if (in_array($fishCategoryData->id, $dataFishCategoryList))
                                                                <span class="route-access-name-design">
                                                                    {{ $fishCategoryData->categoryEng }}
                                                                    ({{ $fishCategoryData->categoryBng }})
                                                                </span>
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div><strong>Fishing Equipment (মাছ ধরার সরঞ্জাম)</strong></div>

                                                    </td>
                                                    <td>:</td>
                                                    <td>
                                                        @php
                                                            $toolsTypeData = explode(',', $dataStats->toolsType ?? '');
                                                        @endphp
                                                        @foreach ($fishingEquipmentList as $fishingEquipmentData)
                                                            @if (in_array($fishingEquipmentData->id, $toolsTypeData))
                                                                <span class="route-access-name-design">
                                                                    {{ $fishingEquipmentData->equipmentEng }}
                                                                    ({{ $fishingEquipmentData->equipmentBng }})
                                                                </span>
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div><strong>Types of fishing (মৎস্য আহরণের ধরন)</strong></div>
                                                    </td>
                                                    <td>:</td>
                                                    <td>{{ $dataStats->fishermen_types_of_fishing->howToFishingEng ?? '' }}
                                                        ({{ $dataStats->fishermen_types_of_fishing->howToFishingBng ?? '' }})
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div><strong>Number of fishermen in the team (দলে জেলে
                                                                সংখ্যা)</strong></div>
                                                    </td>
                                                    <td>:</td>
                                                    <td>{{ $dataStats->fishermen_group_member->groupMemberEng ?? '' }}
                                                        ({{ $dataStats->fishermen_group_member->groupMemberBng ?? '' }})
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div><strong>Fish sale place (মাছ বিক্রির স্থান)</strong></div>

                                                    </td>
                                                    <td>:</td>
                                                    <td>
                                                        @php
                                                            $salePlaceOfFishData = explode(',', $dataStats->salePlaceOfFish ?? '');
                                                        @endphp
                                                        @foreach ($fishSalePlacesList as $fishSalePlacesData)
                                                            @if (in_array($fishSalePlacesData->id, $salePlaceOfFishData))
                                                                <span class="route-access-name-design">
                                                                    {{ $fishSalePlacesData->salePlaceEng }}
                                                                    ({{ $fishSalePlacesData->salePlaceBng }})
                                                                </span>
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div><strong>Ownership of the net (জালের মালিকানা)</strong></div>
                                                    </td>
                                                    <td>:</td>
                                                    <td>{{ $dataStats->fishermen_owner_of_net->ownerOfNetEng ?? '' }}
                                                        ({{ $dataStats->fishermen_owner_of_net->ownerOfNetBng ?? '' }})
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div><strong>Length of the net (জালের দৈর্ঘ্য)</strong></div>
                                                    </td>
                                                    <td>:</td>
                                                    <td>{{ $dataStats->lengthOfNet ?? '' }} Meters (মিটার)
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div><strong>Width of the net (জালের প্রস্থ)</strong></div>
                                                    </td>
                                                    <td>:</td>
                                                    <td>{{ $dataStats->widthOfNet ?? '' }} Meters (মিটার)
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div><strong>Price of net (জালের মূল্য)</strong></div>
                                                    </td>
                                                    <td>:</td>
                                                    <td>{{ $dataStats->priceOfNet ?? '' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div><strong>Source of money (টাকার উৎস)</strong></div>
                                                    </td>
                                                    <td>:</td>
                                                    <td>{{ $dataStats->sourceOfPurchaseOfNet ?? '' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div><strong>Type Of Vessels (নৌযানের ধরন)</strong></div>
                                                    </td>
                                                    <td>:</td>
                                                    <td>{{ $dataStats->fishermen_type_of_vessels->typeofVesselsEng ?? '' }}
                                                        ({{ $dataStats->fishermen_type_of_vessels->typeofVesselsBng ?? '' }})
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div><strong>Owner Of Vessels (নৌযানের মালিকানা)</strong></div>
                                                    </td>
                                                    <td>:</td>
                                                    <td>{{ $dataStats->fishermen_owner_of_vessels->ownerOfVesselsEng ?? '' }}
                                                        ({{ $dataStats->fishermen_owner_of_vessels->ownerOfVesselsBng ?? '' }})
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div><strong>Length Of Vessels (নৌযানের দৈর্ঘ্য)</strong></div>
                                                    </td>
                                                    <td>:</td>
                                                    <td>{{ $dataStats->lengthOfVessels ?? '' }} Meters (মিটার)
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div><strong>Width Of Vessels (নৌযানের প্রস্থ)</strong></div>
                                                    </td>
                                                    <td>:</td>
                                                    <td>{{ $dataStats->widthOfVessels ?? '' }} Meters (মিটার)
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div><strong>Height Of Vessels (নৌযানের উচ্চতা)</strong></div>
                                                    </td>
                                                    <td>:</td>
                                                    <td>{{ $dataStats->heightOfVessels ?? '' }} Meters (মিটার)
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div><strong>Price Of Vessels (নৌযানের মূল্য)</strong></div>
                                                    </td>
                                                    <td>:</td>
                                                    <td>{{ $dataStats->priceOfVessels ?? '' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div><strong>Registration No Of Vessels (নৌযানের
                                                                রেজিষ্ট্রেশন
                                                                নং)</strong></div>
                                                    </td>
                                                    <td>:</td>
                                                    <td>{{ $dataStats->regiNoOfVessels ?? '' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div><strong>Types of employment on the boat (নৌযানে
                                                                কর্মসংস্থানের
                                                                ধরন)</strong></div>
                                                    </td>
                                                    <td>:</td>
                                                    <td>{{ $dataStats->fishermen_type_of_employment_vessels->employmentsInVesselsEng ?? '' }}
                                                        ({{ $dataStats->fishermen_type_of_employment_vessels->employmentsInVesselsBng ?? '' }})
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div><strong>Main Profession (প্রধান পেশা)</strong></div>
                                                    </td>
                                                    <td>:</td>
                                                    <td>{{ $dataStats->mainProfession ?? '' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div><strong>Sub Profession (সহযোগী পেশা)</strong></div>
                                                    </td>
                                                    <td>:</td>
                                                    <td>{{ $dataStats->subProfession ?? '' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div><strong>Annual Income (বার্ষিক আয়)</strong></div>
                                                    </td>
                                                    <td>:</td>
                                                    <td>{{ $dataStats->annualIncome ?? '' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div><strong>Income From Main Profession (প্রধান পেশা থেকে আয়)</strong></div>
                                                    </td>
                                                    <td>:</td>
                                                    <td>{{ $dataStats->incomeMainProfession ?? '' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div><strong>Income From Sub Profession (সহযোগী পেশা (সমূহ) থেকে আয়)</strong></div>
                                                    </td>
                                                    <td>:</td>
                                                    <td>{{ $dataStats->incomeSubProfession ?? '' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div><strong>Annual loan amount (বার্ষিক ঋণের পরিমাণ)</strong></div>
                                                    </td>
                                                    <td>:</td>
                                                    <td>{{ $dataStats->fishermen_yearly_loan->yearlyLoanEng ?? '' }} ({{ $dataStats->fishermen_yearly_loan->yearlyLoanBng ?? '' }})
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div><strong>Annual savings amount (বার্ষিক সঞ্চয়ের পরিমাণ)</strong></div>
                                                    </td>
                                                    <td>:</td>
                                                    <td>{{ $dataStats->fishermen_yearly_saving->yearlySavingEng ?? '' }} ({{ $dataStats->fishermen_yearly_saving->yearlySavingBng ?? '' }})
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div><strong>Livelihood crisis (জীবিকার আপদকাল)</strong></div>
                                                    </td>
                                                    <td>:</td>
                                                    <td>{{ $dataStats->fishermen_danger_period_of_living->deficiencyPeriodEng ?? '' }} ({{ $dataStats->fishermen_danger_period_of_living->deficiencyPeriodBng ?? '' }})
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
    @endpush
@endsection
