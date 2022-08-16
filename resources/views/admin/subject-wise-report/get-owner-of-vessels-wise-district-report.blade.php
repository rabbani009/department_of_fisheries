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
                            @foreach ($ownerOfVessels as $getItem)
                                <th>{{ $getItem->ownerOfVesselsEng }}<br>({{ $getItem->ownerOfVesselsBng }})</th>
                                @php
                                    ${'ownderOfVesselsData' . $getItem->id} = 0;
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
                                    @foreach ($ownerOfVessels as $getItem)
                                    @forelse (collect($data)
                                    ->where('presentDivisionId',$item->divisionId)
                                    ->where('presentDistrictId', $item->districtId)
                                    ->where('presentUpazilaId', $item->upazilaId)
                                      ->where('ownerOfVessels', $getItem->id) as $getData)
                                        @if ($getData->ownerOfVessels == $getItem->id)
                                            <td>{{ $getData->total }}</td>
                                            @php
                                                ${'ownderOfVesselsData' . $getItem->id} += $getData->total;
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
                            @foreach ($ownerOfVessels as $getItem)
                                @php
                                    $getValue = ${'ownderOfVesselsData' . $getItem->id};
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
