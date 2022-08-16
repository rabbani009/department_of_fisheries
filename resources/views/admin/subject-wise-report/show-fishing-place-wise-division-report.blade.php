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
                            <th>District (জেলা)</th>
                            @foreach ($placeOfFishingList as $item)
                                <th>{{ $item->placeEng }}<br>({{ $item->placeBng }})</th>
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
                        @foreach ($district as $item)
                            <tr>
                                <td>{{ $index }}</td>
                                <td>{{ $item->districtEng }} ({{ $item->districtBng }})</td>
                                @foreach ($placeOfFishingList as $getItem)
                                    @foreach (collect($data)->where('presentDistrictId', $item->districtId) as $getData)
                                        @php
                                            $dataFishCategoryList = explode(',', $getData->placeOfFishing);
                                        @endphp
                                        @if (in_array($getItem->id, $dataFishCategoryList))
                                            @php
                                                ${'getCategory' . $getItem->id} += $getData->total;
                                                ${'get' . $getItem->id} = ${'getCategory' . $getItem->id};
                                                
                                            @endphp
                                        @endif
                                    @endforeach
                                @endforeach
                                @foreach ($placeOfFishingList as $getItem)
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
                            @foreach ($placeOfFishingList as $getItem)
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
