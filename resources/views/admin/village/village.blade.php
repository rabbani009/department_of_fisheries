<div class="card-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h6 class="fs-17 font-weight-600 mb-0">Village (গ্রাম)</h6>
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
                <th>Village English</th>
                <th>Village Bangla</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody> 
            @php
                $index = 1;
            @endphp
            @forelse ($villageList as $item)
                <tr>
                    <td>{{ $index }}</td>
                    <td>{{ $item->villageEng }}</td>
                    <td>{{ $item->villageBng }}</td>
                    <td>
                        <a href="{{route('editVillage',$item->id)}}" class="btn btn-success-soft btn-sm mr-1" title="Edit"><i
                                class="far fa-edit"></i></a>
                        <a href="{{ route('deleteVillage', $item->id) }}"
                            class="btn btn-danger-soft btn-sm deleteItem" title="Delete"><i
                                class="far fa-trash-alt"></i></a>
                    </td>
                </tr>
                @php
                    $index++;
                @endphp
            @empty
            <tr>
                <td colspan="4" class="text-danger text-center">No Village Found !!!</td>
            </tr>
            @endforelse

        </tbody>


    </table>
</div>
</div>