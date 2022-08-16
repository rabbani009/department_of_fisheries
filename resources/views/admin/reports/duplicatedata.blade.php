@extends('admin.admin')
@section('content')
<div class="body-content">
    <div class="card mb-4">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="fs-17 font-weight-600 mb-0">Fisher List by Date</h6><br>
                    <button type="button" class="btn btn-danger mb-2" id="printPdf">Print Pdf</button>&nbsp&nbsp&nbsp
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
                            <th>FId</th>
                            <th>NId</th>
                            <th>Name</th>
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
        serverSide: false,
        ajax: {
                url: '/duplicate-fishers-data',
                type: 'GET',
			},
        columns: [
            { data: 'id', defaultContent: '', searchable: false, render: function (data, type, row, meta) {
               return meta.row + meta.settings._iDisplayStart + 1; //auto increment
            }},
            {data: 'fId', name: 'fId'},
            {data: 'nationalIdNo', name: 'nationalIdNo'},
            {data: 'fishermanNameEng', name: 'fishermanNameEng'},
        ]
    });
    })
</script>
<script type="text/javascript">
  $(document).ready(function(){
        $('#printPdf').click(function(){

            $.ajax({
                type: 'GET',
                url: '/get-fisher-duplicate-data-pdf',
                xhrFields: {
                    responseType: 'blob'
                },
                success: function(response){
                    var blob = new Blob([response]);
                    var link = document.createElement('a');
                    link.href = window.URL.createObjectURL(blob);
                    link.download = "Duplicate-Fishers-FID-Data.pdf";
                    link.click();
                },
                error: function(blob){
                console.log(blob);
                }
            });

        });
    });
</script>
@endsection