<div class="card-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h6 class="fs-17 font-weight-600 mb-0">Municipality (পৌরসভা)</h6>
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
                <th>Municipality English</th>
                <th>Municipality Bangla</th>
                {{-- <th>District</th>
                <th>Name English</th>
                <th>Name Bangla</th> --}}
                <th>Action</th>
            </tr>
        </thead>
        <tbody> 
            @php
                $index = 1;
            @endphp
            @forelse ($municipalityData as $item)
                <tr>
                    <td>{{ $index }}</td>
                    <td>{{ $item->municipalityEnglish }}</td>
                    <td>{{ $item->municipalityBangla }}</td>
                    {{-- <td>{{ $item->get_district->districtEng }}</td>
                    <td>{{ $item->upazilaEng }}</td>
                    <td>{{ $item->upazilaBng }}</td> --}}
                    <td>
                        <a href="{{route('editMunicipality',$item->id)}}" class="btn btn-success-soft btn-sm mr-1" title="Edit"><i
                                class="far fa-edit"></i></a>
                        <a href="{{ route('deleteMunicipality', $item->id) }}"
                            class="btn btn-danger-soft btn-sm deleteItem" title="Delete"><i
                                class="far fa-trash-alt"></i></a>
                    </td>
                </tr>
                @php
                    $index++;
                @endphp
            @empty
            <tr>
                <td colspan="4" class="text-danger text-center">No Municipality Found !!!</td>
            </tr>
            @endforelse

        </tbody>


    </table>
</div>
</div>