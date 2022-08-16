@extends('admin.admin')
@section('content')
<!-- test line added -->
<div class="container">
    <h1 style="text-align: center;">Fisher List</h1>
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>formId</th>
                <th>fishermanNameEng</th>
                <th width="100px">Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>   
<script type="text/javascript">
  $(function () {
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,

        ajax: "{{ route('users.index') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'formId', name: 'formId'},
            {data: 'fishermanNameEng', name: 'fishermanNameEng'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
  });
</script>
@endsection