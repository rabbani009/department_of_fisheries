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
            <a type="button" href="{{ route('createFishermenPersonalInformation') }}" class="btn btn-success mb-2 mr-1">
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
                    <table class="table display table-bordered table-striped table-hover basic">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Form Id</th>
                                <th>Data Id</th>
                                <th>Fishers Id</th>
                                <th>Name</th>
                                <th>Bngla Name</th>
                                <th>Father's name</th>
                                <th>Mother's name</th>
                                <th>Date of birth</th>
                                <th>Id Card</th>
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
                                    <td>{{ $item->formId }}</td>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->fId }}</td>
                                    <td><a href="{{ route('viewFisherInfo', $item->id) }}">
                                            {{ $item->fishermanNameEng }}</a></td>
                                    <td><a href="{{ route('viewFisherInfo', $item->id) }}">
                                            {{ $item->fishermanNameBng }}</a></td>

                                    <td>{{ $item->fathersName ?? '' }}</td>
                                    <td>{{ $item->mothersName ?? '' }}</td>
                                    <td>{{ $item->dateOfBirth ?? '' }}</td>
                                    {{-- <td>
                                        <div class="badge badge-success">{{ $item->status }}</div>
                                    </td> --}}
                                    <td>
                                        <a href="{{ route('viewFisherInfo', $item->id) }}"
                                            class="btn btn-info-soft btn-sm mr-1" title="View"><i
                                                class="far fa-eye"></i></a>
                                        <a href="{{ route('editFisherInfo', $item->id) }}"
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
        </div>
    </div>
    {{-- <script type="text/javascript">
        $(function () {
          var table = $('.data-table').DataTable({
              processing: true,
              serverSide: true,
      
              ajax: "{{ route('getAllFishersInfo') }}",
              columns: [
                  {data: 'id', name: 'id'},
                  {data: 'formId', name: 'formId'},
                  {data: 'fishermanNameEng', name: 'fishermanNameEng'},
                  {data: 'action', name: 'action', orderable: false, searchable: false},
              ]
          });
        });
      </script> --}}
@endsection
