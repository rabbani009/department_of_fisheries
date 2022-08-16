<div class="card-header report-card-header">
    <div class="panel-header text-center mb-3">
        <div class="row no-gutters">
            <div class="col-md-2 text-right" id="non-printable"><img src="{{ asset('admin') }}/assets/dist/img/logo.png"
                    alt="" style="height: 80px !important;"></div>
            <div class="col-md-8">
                <h6>People's Republic Of Bangladesh</h6>
                <h5 style="text-transform: uppercase">Fisherman Registration and Identity Card Project</h5>
                <h6 style="text-transform: uppercase"> Department of Fisheries, Bangladesh</h6>
            </div>
            <div class="col-md-2  text-left" id="non-printable"><img src="{{ asset('/') }}logo/logo2.png"
                    alt="" style="height: 80px !important;"></div>
        </div>
    </div>
    <div class="report-header">
        <div class="row no-gutters">
            <div class="col-xs-12 col-sm-12 col-md-6">
                @if (isset($divisionName))
                    <h6><strong>Division (বিভাগ):</strong> {{ $divisionName->divisionEng }}
                        ({{ $divisionName->divisionBng }})
                    </h6>
                @endif
                @if (isset($districtName))
                    <h6><strong>District (জেলা):</strong> {{ $districtName->districtEng }}
                        ({{ $districtName->districtBng }})
                    </h6>
                @endif
                @if (isset($upazilaName))
                    <h6><strong>Upazila (উপজেলা):</strong> {{ $upazilaName->upazilaEng }}
                        ({{ $upazilaName->upazilaBng }})
                    </h6>
                @endif
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6  text-right">
                @if (isset($subjectTopic))
                    @if ($subjectTopic == 'number_wise')
                        <h6><strong>Subject :</strong> Number Based (সংখ্যা ভিত্তিক)</h6>
                    @endif
                    @if ($subjectTopic == 'gender_wise')
                        <h6><strong>Subject :</strong> Gender Based (লিঙ্গ ভিত্তিক)</h6>
                    @endif
                    @if ($subjectTopic == 'religion_wise')
                        <h6><strong>Subject :</strong> Religion Based (ধর্ম ভিত্তিক)</h6>
                    @endif
                    @if ($subjectTopic == 'education_wise')
                        <h6><strong>Subject :</strong> Education Based (শিক্ষাগত যোগ্যতা ভিত্তিক)</h6>
                    @endif
                    @if ($subjectTopic == 'marital_status_wise')
                        <h6><strong>Subject :</strong> Marital Status Based (বৈবাহিক অবস্থা ভিত্তিক)</h6>
                    @endif
                    @if ($subjectTopic == 'fishing_time_wise')
                        <h6><strong>Subject :</strong> Fishing Time Based (মৎস্য আহরণকাল ভিত্তিক)</h6>
                    @endif
                    @if ($subjectTopic == 'fish_type_wise')
                        <h6><strong>Subject :</strong> Fish type Based (আহরিত মাছের ধরন ভিত্তিক)</h6>
                    @endif
                    @if ($subjectTopic == 'place_of_fishing')
                        <h6><strong>Subject :</strong> Place of Fishing Based (মৎস্য আহরণের স্থান ভিত্তিক)</h6>
                    @endif
                    @if ($subjectTopic == 'sale_place_wise')
                        <h6><strong>Subject :</strong> Sale Place Based (মৎস্য আহরণের স্থান ভিত্তিক)</h6>
                    @endif
                    @if ($subjectTopic == 'yearly_loan_wise')
                        <h6><strong>Subject :</strong> Yearly Loan Based (বার্ষিক ঋণ ভিত্তিক)</h6>
                    @endif
                    @if ($subjectTopic == 'yearly_savings_wise')
                        <h6><strong>Subject :</strong> Yearly Saving Based (বার্ষিক সঞ্চয় ভিত্তিক)</h6>
                    @endif
                    @if ($subjectTopic == 'crysis_period_wise')
                        <h6><strong>Subject :</strong> Crysis Period Based (জীবিকার আপদকাল ভিত্তিক)</h6>
                    @endif
                    @if ($subjectTopic == 'owner_of_vessels')
                        <h6><strong>Subject :</strong> Owner of Vessels Based (নৌযানের মালিকানা ভিত্তিক)</h6>
                    @endif
                @endif

            </div>
        </div>
    </div>
</div>
