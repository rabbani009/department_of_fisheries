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
                            <th>Union (ইউনিয়ন)</th>
                            @foreach ($deficiencyPeriod as $getItem)
                                <th>{{ $getItem->deficiencyPeriodEng }}<br>({{ $getItem->deficiencyPeriodBng }})
                                </th>
                                @php
                                    ${'deficiencyPeriod' . $getItem->id} = 0;
                                    ${'municipalityData' . $getItem->id} = 0;
                                @endphp
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $index = 1;
                        @endphp
                        @foreach ($union as $item)
                            <tr>
                                <td>{{ $index }}</td>
                                @if ($item->municipalityId == 0)
                                    <td>{{ $item->unionEng }} ({{ $item->unionBng }})</td>
                                @endif
                                @if ($item->municipalityId > 0)
                                    <td>{{ $item->municipalityEnglish }} ({{ $item->municipalityBangla }})</td>
                                @endif
                                @if ($item->municipalityId == 0)
                                    @foreach ($deficiencyPeriod as $getItem)
                                        @forelse (collect($data)
                                        ->where('presentDivisionId',$item->divisionId)
                                        ->where('presentDistrictId', $item->districtId)
                                        ->where('presentUpazilaId', $item->upazilaId)
                                        ->where('presentAddressMunicipality', 0)
                                        ->where('presentAddressUnion', $item->unionId)
                                        ->where('dangerPeriodOfLiving', $getItem->id) as $getData)
                                            @if ($getData->dangerPeriodOfLiving == $getItem->id)
                                                <td>{{ $getData->total }}</td>
                                                @php
                                                    ${'deficiencyPeriod' . $getItem->id} += $getData->total;
                                                @endphp
                                            @endif
                                        @empty
                                            <td class="text-primary">0</td>
                                        @endforelse
                                    @endforeach
                                @endif
                                @if ($item->municipalityId > 0)
                                    @foreach ($deficiencyPeriod as $getItem)
                                        @forelse (collect($data)
                                        ->where('presentDivisionId',$item->divisionId)
                                        ->where('presentDistrictId', $item->districtId)
                                        ->where('presentUpazilaId', $item->upazilaId)
                                        ->where('presentAddressMunicipality',$item->municipalityId)
                                        ->where('dangerPeriodOfLiving', $getItem->id) as $getData)
                                            @if ($getData->dangerPeriodOfLiving == $getItem->id)
                                                @php
                                                    ${'deficiencyPeriod' . $getItem->id} += $getData->total;
                                                    ${'municipalityData' . $getItem->id} += $getData->total;
                                                @endphp
                                            @endif
                                        @empty
                                            @php
                                                ${'municipalityData' . $getItem->id} = 0;
                                            @endphp
                                        @endforelse
                                    @endforeach
                                    @if ($item->municipalityId > 0)
                                        @foreach ($deficiencyPeriod as $getItem1)
                                            @php
                                                $getValue1 = ${'municipalityData' . $getItem1->id};
                                            @endphp
                                            <td>{{ $getValue1 }}</td>
                                        @endforeach
                                    @endif
                                @endif
                            </tr>
                            @php
                                $index++;
                            @endphp
                        @endforeach
                        <tr>
                            <th colspan="2" class="text-center">Total</th>
                            @foreach ($deficiencyPeriod as $getItem)
                                @php
                                    $getValue = ${'deficiencyPeriod' . $getItem->id};
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
