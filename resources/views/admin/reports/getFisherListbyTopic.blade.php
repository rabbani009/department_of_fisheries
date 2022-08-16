@extends('admin.admin')
@section('content')
    <div class="body-content">
        <div class="card mb-4">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="fs-17 font-weight-600 mb-0">Fisher List by Topic</h6>
                    </div>
                    <div class="text-right">
                        <div class="actions">
                            <a href="layouts_fixed.html#" class="action-item">
                                <i class="ti-reload"></i>
                            </a>
                            <div class="dropdown action-item" data-toggle="dropdown">
                                <a href="layouts_fixed.html#" class="action-item">
                                    <i class="ti-more-alt"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="layouts_fixed.html#" class="dropdown-item">Refresh</a>
                                    <a href="layouts_fixed.html#" class="dropdown-item">Manage Widgets</a>
                                    <a href="layouts_fixed.html#" class="dropdown-item">Settings</a>
                                </div>
                            </div>
                        </div>
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
                        <option value="number_wise">Number Wise(সংখ্যা ভিত্তিক)</option>
                        <option value="gender_wise">Gender Wise(লিঙ্গ ভিত্তিক)</option>
                        <option value="religion_wise">Religion Wise(ধর্ম ভিত্তিক)</option>
                        <option value="education_wise">Education Wise(শিক্ষাগত যোগ্যতা)</option>
                        <option value="marital_status_wise">Marital Status Wise(বৈবাহিক অবস্থা)</option>
                        <option value="fishing_time_wise">Fishing Time Wise(মৎস্য আহরণকাল)</option>
                        <option value="fish_type_wise">Fish type Wise(আহরিত মাছের ধরন)</option>
                        <option value="place_of_fishing">Place of Fishing Wise(মৎস্য আহরণের স্থান)</option>
                        <option value="sale_place_wise">Sale Place Wise(মৎস্য আহরণের স্থান)</option>
                        <option value="yearly_loan_wise">Yearly Loan Wise(বার্ষিক ঋণ)</option>
                        <option value="yearly_savings_wise">Yearly Saving Wise(বার্ষিক সঞ্চয়)</option>
                        <option value="crysis_period_wise">Crysis Period Wise(জীবিকার আপদকাল)</option>
                        <option value="owner_of_vessels">Owner of Vessels(নৌযানের মালিকানা ভিত্তিক)</option>
                    </select>
                    &nbsp;&nbsp;
                    <button type="button" id="reportBtn" class="btn btn-success" style="margin-block: 10px;">Submit</button>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript">
        $('#reportBtn').on('click', function(e) {
            e.preventDefault();
            var divisionId = $('#divisionId').val();
            var districtId = $('#districtId').val();
            var upazilaId = $('#upazilaId').val();
            var topic = $('#topic').val();
            alert(topic);

            // if(topic==null||topic=='')
            // {
            //     alert('Please select topic first')
            //     return
            // }

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
                    // $('#tableContent').html(response);
                    $('#loader').hide();
                    console.log(response);
                    $('#showReport').html(response);
                },
                error: function(response) {
                    console.log('failure');
                }

            });

        });
    </script>
@endsection
