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
            <a href="{{ route('fishersList') }}" class="btn btn-success mb-2 mr-1">
                <i class="typcn typcn-arrow-back mr-2"></i>Back</a>
        </div>
    </div>

    <div class="body-content">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10 col-xl-8">
                <div class="card mb-4">
                    <div class="card-body card-body-2">
                        <div class="row">

                            <div class="col-sm-8">
                                <br>
                                <p>
                                    <strong>{{ $data->fisherName }}</strong>
                                </p>
                                <p class="text-muted-2"><strong>Father's Name:</strong> {{ $data->fatherName }} </p>
                                <p class="text-muted-2"><strong>Father's Name:</strong> {{ $data->fatherName }} </p>
                                <p class="text-muted-2"><strong>Phone:</strong> {{ $data->phone }} </p>
                                <p class="text-muted-2"><strong>Date of Birth:</strong>
                                    {{ date('d M Y', strtotime($data->dof)) }} </p>
                                <p class="text-muted-2"><strong>Gender:</strong> {{ $data->gender }} </p>
                                <p class="text-muted-2"><strong>Marital Status:</strong> {{ $data->maritalStatus }} </p>
                                <p class="text-muted-2"><strong>Physically Handicapped:</strong>
                                    {{ $data->physicallyHandicapped }} </p>
                                <p class="text-muted-2"><strong>National Identity Card (NID):</strong> {{ $data->nid }}
                                </p>
                                @if (!empty($data->educational_qualifications->educationalQualification))
                                    <p class="text-muted-2"><strong>Educational Qualification:</strong>
                                        {{ $data->educational_qualifications->educationalQualification }} </p>
                                @else
                                    <p class="text-muted-2"><strong>Educational Qualification:</strong> Null </p>
                                @endif
                                {{-- <p class="text-muted-2"><strong>Educational Qualification:</strong> {{ $data->educationalQualification }} </p> --}}
                                <p class="text-muted-2"><strong>Post Office:</strong> {{ $data->postOffice }} </p>
                                <p class="text-muted-2"><strong>Fishing Area:</strong> {{ $data->fishingArea }} </p>
                                @if (!empty($data->fishing_time->fishingTime))
                                    <p class="text-muted-2"><strong>Fishing Time:</strong>
                                        {{ $data->fishing_time->fishingTime }} </p>
                                @else
                                    <p class="text-muted-2"><strong>Fishing Time:</strong> Null </p>
                                @endif
                                <p class="text-muted-2"><strong>Types Of Fishing:</strong> {{ $data->typesOfFishing }}
                                </p>
                                @if (!empty($data->place_of_fishing->placeOfFishing))
                                    <p class="text-muted-2"><strong>Place Of Fishing:</strong>
                                        {{ $data->place_of_fishing->placeOfFishing }} </p>
                                @else
                                    <p class="text-muted-2"><strong>Place Of Fishing:</strong> Null </p>
                                @endif
                                @if (!empty($data->fish_sale_place->fishSalePlace))
                                    <p class="text-muted-2"><strong>Fish Sale Place:</strong>
                                        {{ $data->fish_sale_place->fishSalePlace }} </p>
                                @else
                                    <p class="text-muted-2"><strong>Fish Sale Place:</strong> Null </p>
                                @endif
                                @if (!empty($data->yearly_loan->yearlyLoanAmount))
                                    <p class="text-muted-2"><strong>Yearly Loan:</strong>
                                        {{ $data->yearly_loan->yearlyLoanAmount }} </p>
                                @else
                                    <p class="text-muted-2"><strong>Yearly Loan:</strong> Null </p>
                                @endif
                                @if (!empty($data->yearly_savings->yearlySavingsAmount))
                                    <p class="text-muted-2"><strong>Yearly Savings:</strong>
                                        {{ $data->yearly_savings->yearlySavingsAmount }} </p>
                                @else
                                    <p class="text-muted-2"><strong>Yearly Savings:</strong> Null </p>
                                @endif
                                @if (!empty($data->crisis_period->crisisPeriod))
                                    <p class="text-muted-2"><strong>Crisis Period:</strong>
                                        {{ $data->crisis_period->crisisPeriod }} </p>
                                @else
                                    <p class="text-muted-2"><strong>Crisis Period:</strong> Null </p>
                                @endif
                                @if (!empty($data->owner_of_vessels->ownerOfVessels))
                                    <p class="text-muted-2"><strong>Ship Ownership:</strong>
                                        {{ $data->owner_of_vessels->ownerOfVessels }} </p>
                                @else
                                    <p class="text-muted-2"><strong>Ship Ownership:</strong> Null </p>
                                @endif
                                {{-- <p class="text-muted-2"><strong>Fishing Time:</strong> {{ $data->fishing_time->fishingTime }} </p> --}}
                                {{-- <p class="text-muted-2"><strong>Fishing Start Time:</strong> {{ date('H:i', strtotime($data->fishingStartTime)) }} </p>
                        <p class="text-muted-2"><strong>Fishing End Time:</strong> {{ date('H:i', strtotime($data->fishingEndTime)) }} </p> --}}
                                <p class="text-muted-2"><strong>Address:</strong>
                                    {{ $data->address }},{{ $areaData->name }},{{ $upazilaData->name }},{{ $districtData->name }},{{ $divisionData->name }}
                                </p>
                            </div>
                            <div class="col-sm-4 col-xl-4">
                                <div class="media d-flex m-1" style="float: right;">
                                    <div class="align-left p-1">
                                        <a href="user_profile.html#" class="profile-image">
                                            <img src="{{ asset('admin') }}/assets/dist/img/avatar-1.jpg"
                                                class="avatar avatar-xl rounded-circle img-border height-100"
                                                alt="Card image">
                                        </a>
                                    </div>
                                    {{-- <div class="media-body text-left ml-3 mt-1">
                                <h3 class="font-large-1 white">{{$data->fisherName}}
                                </h3>
                                <p class="white">Id: 111 </p>
                            </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
