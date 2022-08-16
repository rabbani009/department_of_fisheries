<style>
    @media print {
        body * {
            visibility: hidden;
        }

        @page {
            margin: 0;
            margin-left: 10px;
            size: 7in 6in;
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
    <button class="btn btn-danger" onclick="window.print();"> <i class="typcn typcn-printer mr-2"></i>Print</button>
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
                                @foreach ($education as $getItem)
                                    <th>{{ $getItem->educationalQualificationEng }}<br>({{ $getItem->educationalQualificationBng }})
                                    </th>
                                    @php
                                        ${'educationData' . $getItem->id} = 0;
                                    @endphp
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $index = 1;
                            @endphp
                            @foreach ($divisions as $item)
                                <tr>
                                    <td>{{ $index }}</td>
                                    <td>{{ $item->divisionEng }}</td>
                                    @foreach (collect($data)->where('presentDivisionId', $item->divisionId) as $getData)
                                        @foreach ($education->where('id', $getData->education) as $getItem)
                                            @if ($getData->education == $getItem->id)
                                                <td>{{ $getData->total }}</td>
                                                @php
                                                    ${'educationData' . $getItem->id} += $getData->total;
                                                @endphp
                                            @endif
                                        @endforeach
                                    @endforeach
                                </tr>
                                @php
                                    $index++;
                                @endphp
                            @endforeach
                            <tr>
                                <th colspan="2" class="text-center">Total</th>
                                @foreach ($education as $getItem)
                                    @php
                                        $getValue = ${'educationData' . $getItem->id};
                                    @endphp
                                    <th>{{ $getValue }}</th>
                                @endforeach
                            </tr>
                        </tbody>


                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
