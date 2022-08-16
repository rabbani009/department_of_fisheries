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
                        @foreach ($district as $item)
                            <tr>
                                <td>{{ $index }}</td>
                                <td>{{ $item->districtEng }} ({{ $item->districtBng }})</td>
                                @forelse (collect($data)->where('districtId', $item->districtId)->where('gender','Female') as $genderData)
                                    @if ($genderData->gender == 'Female')
                                        <td>{{ $genderData->total }}</td>
                                        @php
                                            $femaleData += $genderData->total;
                                        @endphp
                                    @endif
                                    {{-- @if ($genderData->gender == 'Male')
                                        <td>{{ $genderData->total }}</td>
                                        @php
                                            $maleData += $genderData->total;
                                        @endphp
                                    @endif --}}
                                    @empty
                                    <td class="text-primary">0</td>
                                @endforelse
                                @forelse (collect($data)->where('districtId', $item->districtId)->where('gender','Male') as $genderData)
                                    {{-- @if ($genderData->gender == 'Female')
                                        <td>{{ $genderData->total }}</td>
                                        @php
                                            $femaleData += $genderData->total;
                                        @endphp
                                    @endif --}}
                                    @if ($genderData->gender == 'Male')
                                        <td>{{ $genderData->total }}</td>
                                        @php
                                            $maleData += $genderData->total;
                                        @endphp
                                    @endif
                                    @empty
                                    <td class="text-primary">0</td>
                                @endforelse
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
