<style>
    @media print {
        body * {
            visibility: hidden;
        }

        @page {
            margin: 0;
            margin-left: 10px;
            /* size: A4; */
            size: 6.2in 8.8in;
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
<button class="btn btn-info cmd" onclick="window.print();">generate PDF</button>
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
                                @foreach ($fishSalePlacesList as $item)
                                    <th>{{ $item->salePlaceEng }}<br>({{ $item->salePlaceBng }})</th>
                                    @php
                                        ${'get' . $item->id} = 0;
                                        ${'getCategory' . $item->id} = 0;
                                        ${'prevData' . $item->id} = 0;
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
                                    @foreach ($fishSalePlacesList as $getItem)
                                        @foreach (collect($data)->where('presentDivisionId', $item->divisionId) as $getData)
                                            @php
                                                $dataFishCategoryList = explode(',', $getData->salePlaceOfFish);
                                            @endphp
                                            @if (in_array($getItem->id, $dataFishCategoryList))
                                                @php
                                                    ${'getCategory' . $getItem->id} += $getData->total;
                                                    ${'get' . $getItem->id} = ${'getCategory' . $getItem->id};
                                                    
                                                @endphp
                                            @endif
                                        @endforeach
                                    @endforeach
                                    @foreach ($fishSalePlacesList as $getItem)
                                        @php
                                            $getTotal = ${'get' . $getItem->id} - ${'prevData' . $getItem->id};
                                        @endphp
                                        <td>{{ $getTotal }}</td>
                                        @php
                                            ${'prevData' . $getItem->id} = $getTotal + ${'prevData' . $getItem->id};
                                        @endphp
                                    @endforeach
                                </tr>
                                @php
                                    $index++;
                                @endphp
                            @endforeach
                            <tr>
                                <th colspan="2" class="text-center">Total</th>
                                @foreach ($fishSalePlacesList as $getItem)
                                    @php
                                        $getValue = ${'getCategory' . $getItem->id};
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
