@extends('admin.admin')
@section('content')
    <div style="margin: 20px 0px;">
        @include('flash::message')
    </div>
    <div class="content-header row align-items-center m-0">

        <div class="col-sm-8 header-title p-0">
            <div class="media">

                <div class="media-body">
                    {{-- <button class="btn btn-success md-trigger mb-2 mr-1" data-modal="modal-15">3D Rotate In Left</button> --}}
                    <h1 class="font-weight-bold">List of User Type</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-4 text-right  p-0">
            <button type="button" class="btn btn-success mb-2 mr-1" data-toggle="modal" data-target="#addModal">
                <i class="typcn typcn-plus mr-2"></i>ADD</button>
        </div>
    </div>

    <div class="body-content">

        <div class="card mb-4">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="fs-17 font-weight-600 mb-0">User Type</h6>
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
                                            <th>Bn Name</th>
                                            {{-- <th>User Type Id</th> --}}
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $index = 1;
                                        @endphp
                                        @foreach ($data as $item)
                                            <tr>
                                                <td>{{ $index }}</td>
                                                <td>{{ $item->enName }}</td>
                                                <td>{{ $item->bnName }}</td>
                                                {{-- <td>{{ $item->id }}</td> --}}
                                                <td>

                                                    <a type="button" class="btn btn-success-soft btn-sm mr-1"
                                                        data-toggle="modal" data-target="#editModal{{ $item->id }}"
                                                        title="Edit"><i class="far fa-edit"></i></a>
                                                    <a href="{{ route('deleteUserType', $item->id) }}"
                                                        class="btn btn-danger-soft btn-sm deleteItem" title="Delete"><i
                                                            class="far fa-trash-alt"></i></a>
                                                </td>
                                            </tr>
                                            {{-- Edit modal --}}
                                            <div class="modal fade bd-example-modal-lg show"
                                                id="editModal{{ $item->id }}" tabindex="-1" role="dialog"
                                                aria-labelledby="exampleModalLabel3" aria-modal="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <form action="{{ route('updateUserType') }}" method="post">
                                                            @csrf
                                                            <div class="modal-header">
                                                                <h5 class="modal-title font-weight-600"
                                                                    id="exampleModalLabel3">
                                                                    Edit User
                                                                    Type</h5>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">×</span>
                                                                </button>
                                                            </div>
                                                            <input type="hidden" name="id" value="{{ $item->id }}">
                                                            <div class="modal-body">
                                                                <div class="card-body">
                                                                    <div class="form-group">
                                                                        <label for=""
                                                                            class="font-weight-600">Name</label>
                                                                        <input type="text" name="enName"
                                                                            class="form-control"
                                                                            placeholder="Enter User Type Name" required
                                                                            value="{{ $item->enName }}">
                                                                        @if ($errors->has('enName'))
                                                                            <div class="invalid-feedback">
                                                                                {{ 'This field is required' }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for=""
                                                                            class="font-weight-600">Bangla Name</label>
                                                                        <input type="text" id="input-area-four" name="bnName"
                                                                            class="form-control"
                                                                            placeholder="Enter User Type Name"
                                                                            value="{{ $item->bnName }}">

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-danger"
                                                                    data-dismiss="modal">Close</button>
                                                                <button type="submit"
                                                                    class="btn btn-success">UPDATE</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
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

    {{-- create modal --}}
    <div class="modal fade bd-example-modal-lg show" id="addModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel3" aria-modal="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{ route('storeUserType') }}" method="post">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title font-weight-600" id="exampleModalLabel3">ADD User Type</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="" class="font-weight-600">English Name</label>
                                <input type="text" name="enName" class="form-control" placeholder="Enter User Type Name"
                                    required value="{{ old('enName') }}">
                                @if ($errors->has('enName'))
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="" class="font-weight-600">Bangla Name</label>
                                <input type="text" name="bnName" id="input-department-bangla" class="form-control" placeholder="Enter User Type Name">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">ADD</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @push('js')
        <script>
            $(document).ready(function() {
                $(document).on('click', '.deleteItem', function(event){
                    const url = $(this).attr('href');
                    event.preventDefault();
                    swal({
                            title: `Are you sure you want to delete this Item?`,
                            icon: "warning",
                            buttons: true,
                            dangerMode: true,
                        })
                        .then((willDelete) => {
                            if (willDelete) {
                                window.location.href = url;
                            }
                        });
                });
            });
        </script>
    @endpush
@endsection
