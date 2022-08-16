<style>
    @media print {
        body * {
            visibility: hidden;
        }

        @page {
            margin: 0;
            margin-left: 10px;
            size: 4.5in 6in;
        }

        #non-printable {
            display: none;
        }

        #section-to-print,
        #section-to-print * {
            visibility: visible;
        }

        #section-to-print {
            position: absolute;
            left: 0;
            top: 0;
        }
    }
</style>
<div class="col-12 text-right" style="margin:20px;">
    <button class="btn btn-danger" onclick="window.print();">  <i class="typcn typcn-printer mr-2"></i>Print</button>
</div>
<div id="section-to-print">
    @include('admin.subject-wise-report.report-header')
    <div class="table-responsive">
        <div class="dataTables_wrapper dt-bootstrap4">
            <div class="row">
                <div class="col-sm-12">
                    <table
                        class="table table-selct display table-bordered table-striped table-hover column-searching ordering">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Division (বিভাগ)</th>
                                <th>Female (মহিলা)</th>
                                <th>Male (পুরুষ)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $index = 1;
                                $femaleData = 0;
                                $maleData = 0;
                                // print_r($data);
                            @endphp
                            @foreach ($divisions as $item)
                                <tr>
                                    <td>{{ $index }}</td>
                                    <td>{{ $item->divisionEng }}</td>
                                    @foreach (collect($data)->where('divisionId', $item->divisionId) as $genderData)
                                        @if ($genderData->gender == 'Female')
                                            <td>{{ $genderData->total }}</td>
                                            @php
                                                $femaleData += $genderData->total;
                                            @endphp
                                        @endif
                                        @if ($genderData->gender == 'Male')
                                            <td>{{ $genderData->total }}</td>
                                            @php
                                                $maleData += $genderData->total;
                                            @endphp
                                        @endif
                                    @endforeach
                                </tr>
                                @php
                                    $index++;
                                @endphp
                            @endforeach
                            <tr>
                                <th colspan="2" class="text-center">Total</th>
                                <th>{{ $femaleData }}</th>
                                <th>{{ $maleData }}</th>
                            </tr>
                        </tbody>


                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
