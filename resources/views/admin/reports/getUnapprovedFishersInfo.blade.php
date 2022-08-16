@extends('admin.admin')
@section('content')
<div class="body-content">
    <div class="card mb-4">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="fs-17 font-weight-600 mb-0">Fisher List by Date</h6>
                </div>
                <div class="text-right">
                    <div class="actions">
                        <a href="layouts_fixed.html#" class="action-item">
                            <i class="ti-reload"></i>
                        </a>
                        <div class="dropdown action-item" data-toggle="dropdown">
                            <a href="layouts_fixed.html#" class="action-item">
                                <i class="ti-more-alt"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="layouts_fixed.html#" class="dropdown-item">Refresh</a>
                                <a href="layouts_fixed.html#" class="dropdown-item">Manage Widgets</a>
                                <a href="layouts_fixed.html#" class="dropdown-item">Settings</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="container">
                <table class="table table-bordered data-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Form Id</th>
                            <th>FId</th>
                            <th>National Id No</th>
                            <th>Fisherman Name</th>
                            <th>Gender</th>
                            <th id="dob">DOB</th>                         
                            <th>Button</th>                           
                            {{-- <th>ID Card</th>                            --}}
                            <th width="100px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>   

        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
    $( document ).ready(function() {
        var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
                url: '/unapproved-fishermen-list',
                type: 'GET',
			},
        columns: [
            { data: 'id', defaultContent: '', searchable: false, render: function (data, type, row, meta) {
               return meta.row + meta.settings._iDisplayStart + 1; //auto increment
            }},
            {data: 'formId', name: 'formId'},
            {data: 'fId', name: 'fId'},
            {data: 'nationalIdNo', name: 'nationalIdNo'},
            {data: 'fishermanNameEng', name: 'fishermanNameEng'},
            {data: 'gender', name: 'gender'},
            {data: 'dateOfBirth', name: 'dateOfBirth'},
            {data: 'btnAdd', name: 'btnAdd'},
            // {data: 'IdCard', name: 'IdCard'},
            {data: 'action', name: 'action', orderable: false, searchable: false},  
        ]
    });
    })
</script>
@endsection