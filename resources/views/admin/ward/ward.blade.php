<div class="card-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h6 class="fs-17 font-weight-600 mb-0">Ward (ওয়ার্ড)</h6>
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
                <th>Ward English</th>
                <th>Ward Bangla</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody> 
            @php
                $index = 1;
            @endphp
            @forelse ($wardData as $item)
                <tr>
                    <td>{{ $index }}</td>
                    <td>{{ $item->unionEng }}</td>
                    <td>{{ $item->unionBng }}</td>
                    <td>
                        <a href="{{route('editWard',$item->id)}}" class="btn btn-success-soft btn-sm mr-1" title="Edit"><i
                                class="far fa-edit"></i></a>
                        <a href="{{ route('deleteWard', $item->id) }}"
                            class="btn btn-danger-soft btn-sm deleteItem" title="Delete"><i
                                class="far fa-trash-alt"></i></a>
                    </td>
                </tr>
                @php
                    $index++;
                @endphp
            @empty
            <tr>
                <td colspan="4" class="text-danger text-center">No Ward Found !!!</td>
            </tr>
            @endforelse

        </tbody>


    </table>
</div>
</div>