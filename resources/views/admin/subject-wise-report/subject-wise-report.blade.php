@section('content')
    @extends('admin.admin')
    <div class="body-content">
        <div class="card mb-4">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="fs-17 font-weight-600 mb-0">Fisher List by Topic</h6>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form class="form-inline">
                    <label class="sr-only" for="inlineFormInputName2">Name</label>
                    <select class="form-control" id="divisionId" name="divisionId">
                        <option value="">------Select Division------</option>
                        @foreach ($divisions as $divisionList)
                            <option value="{{ $divisionList->divisionId }}">{{ $divisionList->divisionEng }}
                                ({{ $divisionList->divisionBng }})
                            </option>
                        @endforeach
                    </select>
                    &nbsp;&nbsp;
                    <label class="sr-only" for="inlineFormInputName2">Name</label>
                    <select class="form-control" name="districtId" id="districtId">
                        <option value="">------Select District------</option>

                    </select>
                    @if ($errors->has('divisionId'))
                        <div class="invalid-feedback">
                            {{ 'This field is required' }}
                        </div>
                    @endif
                    &nbsp;&nbsp;
                    <label class="sr-only" for="inlineFormInputName2">Name</label>
                    <select class="form-control" name="upazilaId" id="upazilaId">
                        <option value="">------Select Upazila------</option>
                    </select>
                    &nbsp;&nbsp;
                    <label class="sr-only" for="inlineFormInputName2">Name</label>
                    <select class="form-control" id="topic">
                        <option value="">------Select Topic------</option>
                        <option value="number_wise">Number Based (সংখ্যা ভিত্তিক)</option>
                        <option value="gender_wise">Gender Based (লিঙ্গ ভিত্তিক)</option>
                        <option value="religion_wise">Religion Based (ধর্ম ভিত্তিক)</option>
                        <option value="education_wise">Education Based (শিক্ষাগত যোগ্যতা ভিত্তিক)</option>
                        <option value="marital_status_wise">Marital Status Based (বৈবাহিক অবস্থা ভিত্তিক)</option>
                        <option value="fishing_time_wise">Fishing Time Based (মৎস্য আহরণকাল ভিত্তিক)</option>
                        <option value="fish_type_wise">Fish type Based (আহরিত মাছের ধরন ভিত্তিক)</option>
                        <option value="place_of_fishing">Place of Fishing Based (মৎস্য আহরণের স্থান ভিত্তিক)</option>
                        <option value="sale_place_wise">Fish Sale Place Based (মাছ বিক্রির স্থান ভিত্তিক)</option>
                        <option value="yearly_loan_wise">Yearly Loan Based (বার্ষিক ঋণ ভিত্তিক)</option>
                        <option value="yearly_savings_wise">Yearly Saving Based (বার্ষিক সঞ্চয় ভিত্তিক)</option>
                        <option value="crysis_period_wise">Crysis Period Based (জীবিকার আপদকাল ভিত্তিক)</option>
                        <option value="owner_of_vessels">Owner of Vessels Based (নৌযানের মালিকানা ভিত্তিক)</option>
                    </select>
                    &nbsp;&nbsp;
                    <button type="button" id="reportBtn" class="btn btn-success"
                        style="margin-block: 10px;">Submit</button>
                </form>
                <!-- Image loader -->
                <div id='loader' style='display: none;'>
                    <div class="text-center">
                        <div class="spinner-border" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                </div>
                <div class="card-body" id="showReport">

                </div>

            </div>
        </div>
    </div>
    @push('js')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>
        <script type="text/javascript">
            $('#reportBtn').on('click', function(e) {
                e.preventDefault();
                var divisionId = $('#divisionId').val();
                var districtId = $('#districtId').val();
                var upazilaId = $('#upazilaId').val();
                var topic = $('#topic').val();

                if (topic == null || topic == '') {
                    alert('Please select topic first')
                    return
                }

                $.ajax({
                    url: "{{ route('getSubjectWiseReport') }}",
                    method: 'GET',
                    data: {
                        divisionId: divisionId,
                        districtId: districtId,
                        upazilaId: upazilaId,
                        topic: topic
                    },
                    beforeSend: function() {
                        $('#loader').show();
                    },
                    success: function(response) {
                        $('#loader').hide();
                        // console.log(response);
                        $('#showReport').html(response);
                    },
                    error: function(response) {
                        console.log('failure');
                    }

                });

            });
        </script>
        <script>
            $(document).ready(function() {
                // for district data
                $('#divisionId').on('change', function() {
                    let divisionId = $(this).children("option:selected").val();
                    if (divisionId) {
                        $.ajax({
                            url: "{{ route('getDistrictList') }}",
                            method: 'GET',
                            data: {
                                divisionId: divisionId,
                            },
                            success: function(response) {
                                $('#districtId').html(response);
                                $('#upazilaId').html('');
                            },

                        });
                    } else {
                        $('#districtId').html('');
                        $('#upazilaId').html('');
                    }

                });

                // for upazila data
                $('#districtId').on('change', function() {
                    var divisionId = $('#divisionId').val();
                    let districtId = $(this).children("option:selected").val();
                    if (districtId) {
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
                    } else {
                        $('#upazilaId').html('');
                    }
                });

            });
        </script>
    @endpush
@endsection
