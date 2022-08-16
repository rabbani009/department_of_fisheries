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
                            <th>Female</th>
                            <th>Male</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $index = 1;
                        $femaleData=0;
                        $maleData=0;
                        @endphp
                        @foreach ($divisions as $item)
                            <tr>
                                <td>{{ $index }}</td>
                                <td>{{ $item->divisionEng }}</td>
                                @foreach ($data->where('divisionId', $item->divisionId) as $genderData)
                         
                                @if ($genderData->gender == "Female")
                                <td>{{ $genderData->total }}</td>
                                    @php
                                        $femaleData+=$genderData->total;
                                    @endphp
                                @endif
                                @if ($genderData->gender == "Male")
                                <td>{{ $genderData->total }}</td>
                                @php
                                $maleData+=$genderData->total;
                            @endphp
                                @endif
                            @endforeach
                            </tr>
                            @php
                                $index++;
                            @endphp
                        @endforeach
                        <tr>
                            <th colspan="2">Total</th>
                            <th>{{$femaleData}}</th>
                            <th>{{$maleData}}</th>
                        </tr>
                    </tbody>


                </table>
            </div>
        </div>
    </div>
</div>