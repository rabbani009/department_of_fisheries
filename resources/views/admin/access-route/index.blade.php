@extends('admin.admin')
@section('content')
    <div style="margin: 20px 0px;">
        @include('flash::message')
    </div>
    <div class="content-header row align-items-center m-0">

        <div class="col-sm-8 header-title p-0">
            <div class="media">

                <div class="media-body">
                    <h1 class="font-weight-bold">List of User Type</h1>
                </div>
            </div>
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
                    <table class="table display table-bordered table-striped table-hover multi-tables dataTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>System User Name</th>
                                <th>Bn Name</th>
                                {{-- <th>Route Access</th> --}}
                                <th>Menu Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $index = 1;
                            @endphp
                            @foreach ($data as $item)
                                {{-- {{strlen($item->routeAccess)}} --}}
                                @php
                                    $routeAccessData = explode(',', $item->routeAccess ?? '');
                                @endphp
                                <tr>
                                    <td>{{ $index }}</td>
                                    <td>{{ $item->enName }}</td>
                                    <td>{{ $item->bnName }}</td>
                                    {{-- <td>{{ $item->routeAccess }}</td> --}}

                                    <td>
                                        @foreach ($routeList as $routeItem)
                                            @if (in_array($routeItem->id, $routeAccessData))
                                                <span class="route-access-name-design">{{ $routeItem->routeName }}</span>
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>

                                        <a href="{{ route('createRouteAccess', $item->id) }}"
                                            class="btn btn-success-soft btn-sm mr-1" title="Add">Add & Edit Menu Access</a>
                                        {{-- <a href="{{route('editRouteAccess', $item->id)}}" class="btn btn-info-soft btn-sm mr-1" title="Edit">Edit Route Access</a> --}}
                                        <a href="{{ route('deleteRouteAccess', $item->id) }}"
                                            class="btn btn-danger-soft btn-sm deleteItem" title="Delete">Delete</a>
                                    </td>
                                </tr>
                                {{-- Edit modal --}}
                                <div class="modal fade bd-example-modal-lg show" id="editModal{{ $item->id }}"
                                    tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel3" aria-modal="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <form action="{{ route('updateUserType') }}" method="post">
                                                @csrf
                                                <div class="modal-header">
                                                    <h5 class="modal-title font-weight-600" id="exampleModalLabel3">Edit
                                                        User
                                                        Type</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <input type="hidden" name="id" value="{{ $item->id }}">
                                                <div class="modal-body">
                                                    <div class="card-body">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1"
                                                                class="font-weight-600">Name</label>
                                                            <input type="text" name="name" class="form-control"
                                                                placeholder="Enter User Type Name" required
                                                                value="{{ $item->name }}">
                                                            @if ($errors->has('name'))
                                                                <div class="invalid-feedback">
                                                                    {{ 'This field is required' }}
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1" class="font-weight-600">Bangla
                                                                Name</label>
                                                            <input type="text" name="bnName" class="form-control"
                                                                placeholder="Enter User Type Name" required
                                                                value="{{ $item->bnName }}">

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-success">UPDATE</button>
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
                                <label for="exampleInputEmail1" class="font-weight-600">Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Enter User Type Name"
                                    required value="{{ old('name') }}">
                                @if ($errors->has('name'))
                                    <div class="invalid-feedback">
                                        {{ 'This field is required' }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="font-weight-600">Bangla Name</label>
                                <input type="text" name="bnName" class="form-control" placeholder="Enter User Type Name"
                                    required>
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
                $('.deleteItem').click(function(event) {
                    console.log("oso");
                    const url = $(this).attr('href');
                    event.preventDefault();
                    swal({
                            title: `Are you sure you want to delete all route access?`,
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
