
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
                            <th>Number of fishermen (জেলে সংখ্যা)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $index = 1;
                        $countData = 0;
                        @endphp
                               @foreach ($upazila as $item)
                            <tr>
                                <td>{{ $index }}</td>
                                <td>{{ $item->upazilaEng }} ({{ $item->upazilaBng }})</td>
                                @foreach (collect($data)->where('divisionId', $item->divisionId)->where('districtId', $item->districtId)->where('upazilaId', $item->upazilaId) as $getData)
                                    <td>{{ $getData->total }}</td>
                                    @php
                                        $countData += $getData->total;
                                    @endphp
                                @endforeach
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
