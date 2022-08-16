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
                            <th>Number of fishermen (জেলে সংখ্যা)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $index = 1;
                            $countData = 0;
                            $countMunicipalityData = 0;
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
                                    @forelse (collect($data)
                                ->where('divisionId',$item->divisionId)
                                ->where('districtId', $item->districtId)
                                ->where('upazilaId', $item->upazilaId)
                                // ->where('municipalityId', $item->municipalityId)
                                ->where('municipalityId', 0)
                                ->where('unionId', $item->unionId) as $getData)
                                        <td>{{ $getData->total }}</td>
                                        @php
                                            $countData += $getData->total;
                                        @endphp
                                    @empty
                                        <td>{{ 0 }}</td>
                                    @endforelse
                                @endif
                                @if ($item->municipalityId > 0)
                                    @forelse (collect($data)
                                ->where('divisionId',$item->divisionId)
                                ->where('districtId', $item->districtId)
                                ->where('upazilaId', $item->upazilaId)
                                ->where('municipalityId', $item->municipalityId) as $getData)
                                        @php
                                            $countMunicipalityData += $getData->total;
                                            $countData += $getData->total;
                                        @endphp
                                    @empty
                                        @php
                                            $countMunicipalityData = 0;
                                        @endphp
                                    @endforelse
                                @endif
                                @if ($item->municipalityId > 0)
                                    <td>{{ $countMunicipalityData }}</td>
                                @endif
                            </tr>
                            @php
                                $index++;
                            @endphp
                        @endforeach
                        <tr>
                            <th colspan="2" class="text-center">Total</th>
                            <th>{{ $countData }}</th>
                        </tr>
                    </tbody>


                </table>
            </div>
        </div>
    </div>
</div>
