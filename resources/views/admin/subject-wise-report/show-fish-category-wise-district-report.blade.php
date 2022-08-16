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
                            <th>Upazila (উপজেলা)</th>
                            @foreach ($fishCategoryList as $item)
                                <th>{{ $item->categoryEng }}<br>({{ $item->categoryBng }})</th>
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
                        @foreach ($upazila as $item)
                            <tr>
                                <td>{{ $index }}</td>
                                <td>{{ $item->upazilaEng }} ({{ $item->upazilaBng }})</td>
                                @foreach ($fishCategoryList as $getItem)
                                    @foreach (collect($data)
                                    ->where('presentDivisionId', $item->divisionId)
                                    ->where('presentDistrictId', $item->districtId)
                                    ->where('presentUpazilaId', $item->upazilaId) as $getData)
                                        @php
                                            $dataFishCategoryList = explode(',', $getData->typeOfFish);
                                        @endphp
                                        @if (in_array($getItem->id, $dataFishCategoryList))
                                            @php
                                                ${'getCategory' . $getItem->id} += $getData->total;
                                                ${'get' . $getItem->id} = ${'getCategory' . $getItem->id};
                                                
                                            @endphp
                                        @endif
                                    @endforeach
                                @endforeach
                                @foreach ($fishCategoryList as $getItem)
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
                            @foreach ($fishCategoryList as $getItem)
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
