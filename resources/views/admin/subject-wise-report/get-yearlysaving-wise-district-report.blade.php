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
                            @foreach ($yearlySaving as $getItem)
                                <th>{{ $getItem->yearlySavingEng }} <br>({{ $getItem->yearlySavingBng }})</th>
                                @php
                                    ${'yearlySavingData' . $getItem->id} = 0;
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
                                @foreach ($yearlySaving as $getItem)
                                    @forelse (collect($data)
                                    ->where('presentDivisionId',$item->divisionId)
                                    ->where('presentDistrictId', $item->districtId)
                                    ->where('presentUpazilaId', $item->upazilaId)
                                    ->where('yearlySaving', $getItem->id) as $getData)
                                        @if ($getData->yearlySaving == $getItem->id)
                                            <td>{{ $getData->total }}</td>
                                            @php
                                                ${'yearlySavingData' . $getItem->id} += $getData->total;
                                            @endphp
                                        @endif
                                        @empty
                                        <td class="text-primary">0</td>
                                    @endforelse
                                @endforeach
                            </tr>
                            @php
                                $index++;
                            @endphp
                        @endforeach
                        <tr>
                            <th colspan="2" class="text-center">Total</th>
                            @foreach ($yearlySaving as $getItem)
                                @php
                                    $getValue = ${'yearlySavingData' . $getItem->id};
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
