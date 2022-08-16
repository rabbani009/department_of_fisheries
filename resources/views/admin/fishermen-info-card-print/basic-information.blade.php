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
                    <h1 class="font-weight-bold">Add Fisher</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-4 text-right  p-0">
            <a href="{{ route('fishersList') }}" class="btn btn-success mb-2 mr-1">
                <i class="typcn typcn-arrow-back mr-2"></i>Back</a>
        </div>
    </div>

    <div class="body-content">

        <div class="card mb-4">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="fs-17 font-weight-600 mb-0">Basic Information (মৌলিক তথ্য)</h6>
                    </div>
                </div>
            </div>

            <form action="{{ route('storeFishersBasicInformation') }}" method="post">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 p-l-30 p-r-30 left-side">
                            <div class="form-group">
                                <label class="font-weight-600">Name</label>
                                <input type="text" class="form-control" name="fisherName"
                                    value="{{ old('fisherName') }}" placeholder="Enter Fisher Name">
                                @if ($errors->has('fisherName'))
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="font-weight-600">Father's Name</label>
                                <input type="text" class="form-control" name="fatherName"
                                    value="{{ old('fatherName') }}" placeholder="Enter Father's Name">
                                @if ($errors->has('fatherName'))
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="font-weight-600">Mother's Name</label>
                                <input type="text" class="form-control" name="motherName"
                                    value="{{ old('motherName') }}" placeholder="Enter Mother's Name">
                                @if ($errors->has('motherName'))
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label class="font-weight-600 mr-3">Gender</label>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="customRadioInline1" name="gender" class="custom-control-input"
                                        value="Male">
                                    <label class="custom-control-label" for="customRadioInline1">Male</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="customRadioInline2" name="gender" class="custom-control-input"
                                        value="Female">
                                    <label class="custom-control-label" for="customRadioInline2">Female</label>
                                </div>
                                @if ($errors->has('gender'))
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="font-weight-600 mr-3">Physically Handicapped</label>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="physicallyHandicapped1" name="physicallyHandicapped"
                                        class="custom-control-input" value="Yes">
                                    <label class="custom-control-label" for="physicallyHandicapped1">Yes</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="physicallyHandicapped2" name="physicallyHandicapped"
                                        class="custom-control-input" value="No">
                                    <label class="custom-control-label" for="physicallyHandicapped2">No</label>
                                </div>
                                @if ($errors->has('physicallyHandicapped'))
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="font-weight-600 mr-3">Marital Status</label>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="maritalStatus1" name="maritalStatus"
                                        class="custom-control-input" value="Married">
                                    <label class="custom-control-label" for="maritalStatus1">Married</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="maritalStatus2" name="maritalStatus"
                                        class="custom-control-input" value="Unmarried">
                                    <label class="custom-control-label" for="maritalStatus2">Unmarried</label>
                                </div>
                                @if ($errors->has('maritalStatus'))
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-6 p-l-30 p-r-30">
                            <div class="form-group">
                                <label class="font-weight-600">Educational Qualification (শিক্ষাগত যোগ্যতা)</label>
                                <select class="form-control" name="educationalQualification">
                                    <option value="">Select One</option>
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
                            <div class="form-group">
                                <label for="exampleFormControlSelect1" class="font-weight-600">Religion (ধর্ম)</label>
                                <select class="form-control" name="religion">
                                    <option value="">Select Religion</option>
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

                                <fieldset class="fieldset-border">
                                    <legend class="legend-border">Date of Birth* (জন্ম তারিখ)</legend>

                                    <div class="form-row">
                                        <div class="col-md-4 mb-3">

                                            <label class="font-weight-600">Day (দিন)</label>
                                            <select name="dateOfBirthDay" class="form-control">
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
                                            @if ($errors->has('dateOfBirthDay'))
                                                <div class="invalid-feedback">
                                                    {{ 'This field is required' }}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="font-weight-600">Month (মাস)</label>
                                            <select name="dateOfBirthMonth" class="form-control">
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
                                            @if ($errors->has('dateOfBirthMonth'))
                                                <div class="invalid-feedback">
                                                    {{ 'This field is required' }}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            @php
                                                $getYear = now()->year;
                                            @endphp
                                            <label class="font-weight-600">Year (বছর)</label>
                                            <select name="dateOfBirthYear" class="form-control">
                                                <option value="">Select</option>
                                                @for ($year = 1940; $year <= $getYear; $year++)
                                                    <option value="{{ $year }}">{{ $year }}</option>
                                                @endfor
                                            </select>
                                            @if ($errors->has('dateOfBirthYear'))
                                                <div class="invalid-feedback">
                                                    {{ 'This field is required' }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>


                                </fieldset>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-success mr-1">Submit</button>
                    <button type="button" class="btn btn-danger">Cancel</button>
                </div>
            </form>

        </div>
    </div>
    @push('js')
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
