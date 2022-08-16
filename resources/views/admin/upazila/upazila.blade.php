<div class="card-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h6 class="fs-17 font-weight-600 mb-0">Upazila (উপজেলা)</h6>
        </div>
    </div>
</div>
<div class="card-body">
    <div class="table-responsive">
        <table
        class="table display table-bordered table-striped table-hover multi-tables dataTable">
            <thead>
                <tr>
                    <th>#</th>
                    {{-- <th>Division</th>
                    <th>District</th> --}}
                    <th>Name English</th>
                    <th>Name Bangla</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $index = 1;
                @endphp
                @foreach ($upazilaList as $item)
                    <tr>
                        <td>{{ $index }}</td>
                        {{-- <td>{{ $item->get_division->divisionEng }}</td>
                        <td>{{ $item->get_district->districtEng }}</td> --}}
                        <td>{{ $item->upazilaEng }}</td>
                        <td>{{ $item->upazilaBng }}</td>
                        <td>
                            <a href="{{route('editUpazila',$item->id)}}" class="btn btn-success-soft btn-sm mr-1" title="Edit"><i
                                    class="far fa-edit"></i></a>
                            <a href="{{ route('deleteUpazila', $item->id) }}"
                                class="btn btn-danger-soft btn-sm deleteItem" title="Delete"><i
                                    class="far fa-trash-alt"></i></a>
                        </td>
                    </tr>
                    @php
                        $index++;
                    @endphp
                @endforeach

            </tbody>


        </table>
    </div>
</div>