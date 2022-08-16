<div class="table-responsive">
    <div class="dataTables_wrapper dt-bootstrap4">
        <div class="row">
            <div class="col-sm-12">
                <table
                    class="table display table-bordered table-striped table-hover multi-tables dataTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Designation</th>
                            <th>Department</th>
                            <th>User Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $index = 1;
                        @endphp
                         @forelse($data as $item)
                            <tr>
                                <td>{{ $index }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->phone }}</td>
                                <td>{{ $item->get_user_designation->enName ?? '' }}</td>
                                <td>{{ $item->get_user_department->enName ?? '' }}</td>
                                <td>{{ $item->get_user_type->enName ?? '' }}</td>
                                <td>

                                    <a href="{{ route('editUser', $item->id) }}"
                                        class="btn btn-success-soft btn-sm mr-1" title="Edit"><i
                                            class="far fa-edit"></i></a>
                                    <a href="{{ route('deleteUser', $item->id) }}"
                                        class="btn btn-danger-soft btn-sm deleteItem" title="Delete"><i
                                            class="far fa-trash-alt"></i></a>
                                </td>
                            </tr>
                            @php
                                $index++;
                            @endphp
                        @empty
                        <td colspan="8" class="text-center">
                            <p class="text-danger">No Data Found !!!</p>
                        </td>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>