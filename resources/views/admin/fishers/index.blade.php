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
            <a type="button" href="{{ route('createFishers') }}" class="btn btn-success mb-2 mr-1">
                <i class="typcn typcn-plus mr-2"></i>ADD</a>
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
                                    class="table table-selct display table-bordered table-striped table-hover column-searching ordering">
                                    <thead>
                                        <form action="{{ route('getFishersReport') }}" method="GET">
                                            <tr>
                                                <th rowspan="1" colspan="1">
                                                    <select class="form-control" name="division" id="divisionId">
                                                        <option value="">Select Division</option>
                                                        @foreach ($divisions as $divisionList)
                                                            <option value="{{ $divisionList->id }}">
                                                                {{ $divisionList->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </th>
                                                <th rowspan="1" colspan="1">
                                                    <select class="form-control" name="district" id="districtId">
                                                    </select>
                                                </th>
                                                <th rowspan="1" colspan="1">
                                                    <select class="form-control" name="upazila" id="upazilaId">
                                                    </select>
                                                </th>
                                                <th rowspan="1" colspan="1">
                                                    <select class="form-control" name="area" id="areaId">
                                                    </select>
                                                </th>
                                                <th rowspan="1" colspan="1">
                                                    <button type="button" class="btn btn-sm btn-success"
                                                        id="fishersReport">Submit</button>
                                                </th>
                                            </tr>
                                        </form>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Father's name</th>
                                            <th>Mother's name</th>
                                            <th>Phone</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="showReport">
                                        @php
                                            $index = 1;
                                        @endphp
                                        @foreach ($data as $item)
                                            <tr>
                                                <td>{{ $index }}</td>
                                                <td><a href="{{ route('viewFishers', $item->id) }}">
                                                        {{ $item->fisherName }}</a></td>

                                                <td>{{ $item->fatherName ?? '' }}</td>
                                                <td>{{ $item->motherName ?? '' }}</td>
                                                <td>{{ $item->phone }}</td>
                                                <td>
                                                    <div class="badge badge-success">{{ $item->status }}</div>
                                                </td>
                                                <td>
                                                    <a href="{{ route('viewFishers', $item->id) }}"
                                                        class="btn btn-info-soft btn-sm mr-1" title="View"><i
                                                            class="far fa-eye"></i></a>
                                                    <a href="{{ route('editFishers', $item->id) }}"
                                                        class="btn btn-success-soft btn-sm mr-1" title="Edit"><i
                                                            class="far fa-edit"></i></a>
                                                    <a href="{{ route('deleteFishersList', $item->id) }}"
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
                        <div class="row">
                            <div class="col-sm-12 col-md-5">
                                <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">

                                    Showing {{ $data->firstItem() }} to {{ $data->lastItem() }}
                                    of total {{ $data->total() }} entries
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-7">
                                {!! $data->links('admin.partials.custom') !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('js')
        <script>
            $(document).ready(function() {
                $('#fishersReport').on('click', function() {
                    var divisionId = $('#divisionId').val();
                    console.log(divisionId == '');
                    var districtId = $('#districtId').val();
                    var upazilaId = $('#upazilaId').val();
                    var areaId = $('#areaId').val();

                    function fetch_data() {
                        if ((divisionId) && (districtId) && (upazilaId) && (areaId)) {

                            $.ajax({
                                url: "{{ route('getFishersReport') }}",
                                method: 'GET',
                                data: {
                                    divisionId: divisionId,
                                    districtId: districtId,
                                    upazilaId: upazilaId,
                                    areaId: areaId,
                                },
                                //    dataType:'json',
                                success: function(data) {
                                    // console.log(data==null);
                                    if (data) {

                                        $('#showReport').html(data);
                                    } else {
                                        $('#showReport').html(
                                            "<h3>No Data Found</h3>"
                                            );

                                    }
                                }
                            })
                        } else {
                            // fetch_data();
                            $('#showReport').html(
                                "<h3>Select Division, District, Upazila and Area</h3>"
                                );
                           
                        }
                    }
                    fetch_data();

                });
            });
        </script>
        <script>
            $(document).ready(function() {
                $('#divisionId').on('change', function() {
                    // alert('ojdei');
                    $('#districtId').val('');
                    $('#upazilaId').val('');
                    $('#areaId').val('');
                    let value = $(this).children("option:selected").val();

                    $.get('{{ url('/') }}/get-district-list/' + value, function(response) {

                        $('#districtId').html(response);

                        // console.log("ok");
                        // console.log(response);
                    })


                });
                $('#districtId').on('change', function() {
                    $('#upazilaId').val('');
                    $('#areaId').val('');
                    let value = $(this).children("option:selected").val();

                    $.get('{{ url('/') }}/get-upazila-list/' + value, function(response) {

                        $('#upazilaId').html(response);
                        $('#areaId').html();
                        // console.log("ok");
                        // console.log(response);
                    })


                });
                $('#upazilaId').on('change', function() {
                    $('#areaId').val('');
                    let value = $(this).children("option:selected").val();

                    $.get('{{ url('/') }}/get-area-list/' + value, function(response) {

                        $('#areaId').html(response);
                        // console.log("ok");
                        // console.log(response);
                    })


                });
            });
        </script>

        <script>
            $(document).ready(function() {
                $('.deleteItem').click(function(event) {
                    console.log("oso");
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
