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
                            <th>Female (মহিলা)</th>
                            <th>Male (পুরুষ)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $index = 1;
                            $femaleData = 0;
                            $maleData = 0;
                            $municipalityFemaleData = 0;
                            $municipalitymaleData = 0;
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
                                ->where('municipalityId',0)
                                ->where('unionId', $item->unionId)
                                ->where('gender','Female') as $genderData)
                                        @if ($genderData->gender == 'Female')
                                            <td>{{ $genderData->total }}</td>
                                            @php
                                                $femaleData += $genderData->total;
                                            @endphp
                                        @endif

                                    @empty
                                        <td class="text-primary">0</td>
                                    @endforelse
                                    @forelse (collect($data)
                                ->where('divisionId',$item->divisionId)
                                ->where('districtId', $item->districtId)
                                ->where('upazilaId', $item->upazilaId)
                                ->where('municipalityId',0)
                                ->where('unionId', $item->unionId)
                                ->where('gender','Male') as $genderData)
                                        @if ($genderData->gender == 'Male')
                                            <td>{{ $genderData->total }}</td>
                                            @php
                                                $maleData += $genderData->total;
                                            @endphp
                                        @endif

                                    @empty
                                        <td class="text-primary">0</td>
                                    @endforelse
                                @endif
                                @if ($item->municipalityId > 0)
                                    @forelse (collect($data)
                                ->where('divisionId',$item->divisionId)
                                ->where('districtId', $item->districtId)
                                ->where('upazilaId', $item->upazilaId)
                                ->where('municipalityId',$item->municipalityId)
                                ->where('gender','Female') as $genderData)
                                        @if ($genderData->gender == 'Female')
                                            @php
                                                $municipalityFemaleData += $genderData->total;
                                                $femaleData += $genderData->total;
                                            @endphp
                                        @endif
                                    @empty
                                        @php
                                            $municipalityFemaleData = 0;
                                        @endphp
                                    @endforelse
                                    @forelse (collect($data)
                                ->where('divisionId',$item->divisionId)
                                ->where('districtId', $item->districtId)
                                ->where('upazilaId', $item->upazilaId)
                                ->where('municipalityId',$item->municipalityId)
                                ->where('gender','Male') as $genderData)
                                        @if ($genderData->gender == 'Male')
                                            @php
                                                $municipalitymaleData += $genderData->total;
                                                $maleData += $genderData->total;
                                            @endphp
                                        @endif
                                    @empty
                                        @php
                                            $municipalitymaleData = 0;
                                        @endphp
                                    @endforelse
                                @endif
                                @if ($item->municipalityId > 0)
                                    <td>{{ $municipalityFemaleData }}</td>

                                    <td>{{ $municipalitymaleData }}</td>
                                @endif

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
