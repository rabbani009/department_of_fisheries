@extends('admin.admin')
@section('content')
    <div style="margin: 20px 0px;">
        @include('flash::message')
    </div>
    <div class="content-header row align-items-center m-0">

        <div class="col-sm-8 header-title p-0">
            <div class="media">

                <div class="media-body">

                    <h1 class="font-weight-bold">List of User</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-4 text-right  p-0">
            <a href="{{ route('createUserAccountInformation') }}" class="btn btn-success mb-2 mr-1">
                <i class="typcn typcn-plus mr-2"></i>ADD NEW USER</a>
        </div>
    </div>

    <div class="body-content">

        <div class="card mb-4">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="fs-17 font-weight-600 mb-0">User</h6>
                    </div>
                </div>
            </div>
            <div class="card-body">
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
                                            {{-- <th>Email</th>
                                            <th>Phone</th>
                                            <th>Designation</th>
                                            <th>Department</th>
                                            <th>User Role</th>
                                            <th>Action</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $index = 1;
                                        @endphp
                                        @foreach ($data as $item)
                                            <tr>
                                                <td>{{ $index }}</td>
                                                <td>{{ $item->id }}</td>
                                                {{-- <td>{{ $item->email }}</td>
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
                                                </td> --}}
                                            </tr>
                                            @php
                                                $index++;
                                            @endphp
                                        @endforeach

                                    </tbody>


                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
