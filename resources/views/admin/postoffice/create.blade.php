@extends('admin.admin')
@section('content')
    <div style="margin: 20px 0px;">
        @include('flash::message')
    </div>
<div class="row justify-content-center">
<div class="col-sm-6 col-md-6 col-xl-8">

    <div class="body-content">
        <div class="card mb-4">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="fs-17 font-weight-600 mb-0">Add PostOffice</h6>
                    </div>
                    <div class="col-sm-4 text-right p-0">
                        <a href="{{route('postOfficeList')}}" class="btn btn-success mb-2 mr-1">
                            <i class="typcn typcn-arrow-back-outline mr-2"></i>Back</a>
                    </div>
                </div>
            </div>
            <form action="{{ route('storePostOffice') }}" method="post">
                @csrf
            <div class="card-body">
              
                <div class="form-group">
                    <label for="exampleFormControlSelect1" class="font-weight-600">Division (বিভাগ)</label>
                    <select class="form-control" name="divisionId" id="divisionId"  required>
                        <option value="">Select Division </option>
                        @foreach ($divisionList as $divisionList)
                            @if (old('divisionId') == $divisionList->divisionId)
                                <option value="{{ $divisionList->divisionId }}" selected>
                                    {{ $divisionList->divisionEng }}
                                    ({{ $divisionList->divisionBng }})
                                </option>
                            @else
                                <option value="{{ $divisionList->divisionId }}">
                                    {{ $divisionList->divisionEng }}
                                    ({{ $divisionList->divisionBng }})
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
                    <label for="exampleFormControlSelect1" class="font-weight-600">District (জেলা)</label>
                    <select class="form-control" name="districtId" id="districtId" required>

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

                    </select>
                    @if ($errors->has('upazilaId'))
                        <div class="invalid-feedback">
                            {{ 'This field is required' }}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" class="font-weight-600">PostOffice Name (English)</label>
                    <input type="text" name="postOfficeEnglish" class="form-control" placeholder="Enter District Name" required
                        value="{{ old('postOfficeEnglish') }}" required>
                    @if ($errors->has('postOfficeEnglish'))
                        <div class="invalid-feedback">
                            {{ 'This field is required' }}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label class="font-weight-600">PostOffice Name (Bangla)</label>
                    <input type="text" name="postOfficeBangla" id="input-division-bangla" class="form-control"
                        placeholder="Enter District Name" value="{{ old('postOfficeBangla') }}" required>
                    @if ($errors->has('postOfficeBangla'))
                        <div class="invalid-feedback">
                            {{ 'This field is required' }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-success mr-1">Submit</button>
            </div>
            </form>
        </div>
    </div>
</div>
</div>
    @push('js')
    <script>
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
        });
    </script>
        <script>
            $(document).ready(function() {
                $(document).on('click', '.deleteItem', function(event) {
                    const url = $(this).attr('href');
                    event.preventDefault();
                    swal({
                            title: `Are you sure you want to delete this Item?`,
                            icon: "warning",
                            buttons: true,
                            dangerMode: true,
                        })
                        .then((willDelete) => {
                            if (willDelete) {
                                window.location.href = url;
                            }
                        });
                });
            });
        </script>
    @endpush
@endsection
