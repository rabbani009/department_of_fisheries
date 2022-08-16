@extends('admin.admin')
@section('content')
<div class="body-content">
    <div class="card mb-4">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="fs-17 font-weight-600 mb-0">Fisher List by Division and District</h6>
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
        <form class="form-inline" id="dateForm">
                <label class="sr-only" for="inlineFormInputName2">Name</label>
                <select class="form-control" id="divisionId" name="divisionId">
                    <option value="">------Select Division------</option>
                    @foreach ($divisions as $divisionList)
                    <option value="{{ $divisionList->divisionId }}">{{ $divisionList->divisionEng }}
                                            ({{ $divisionList->divisionBng }})</option>
                    @endforeach
                </select>
                &nbsp;&nbsp;
                <label class="sr-only" for="inlineFormInputName2">Name</label>
                <select class="form-control" name="districtId" id="districtId">
                    <option value="">------Select District------</option>
                    
                </select>
                @if ($errors->has('divisionId'))
                    <div class="invalid-feedback">
                        {{ 'This field is required' }}
                    </div>
                @endif
                &nbsp;&nbsp;
                <div class="form-check mr-sm-2">
                <label for="staticEmail" class="col-sm-3 col-form-label font-weight-600">Print Limit</label>
                    <input class="form-control" type="text" value="" id="printLimit" style="width: 30%;"/>&nbsp&nbsp&nbsp
                    <button type="button" class="btn btn-danger" id="printPdf">Pdf Print</button>&nbsp&nbsp&nbsp
                    <button type="submit" id="reportBtn" class="btn btn-success" style="margin-block: 10px;">Submit</button> 
                    <!-- <button type="button" class="btn btn-success" id="printExcel">Excel Print</button>&nbsp&nbsp&nbsp -->
                </div>               
         
            <!-- <button type="button" id="reportBtn"class="btn btn-success" style="margin-block: 10px;">Submit</button> -->
            </form>
            <div class="container">
                <table class="table table-bordered data-table">
                    <thead>
                        <tr>
                            <!-- <th>No</th> -->
                            <th>Form Id</th>
                            <th>Fisherman Name</th>
                            <th>Gender</th>
                            <th id="dob">DOB</th>                           
                            <th width="100px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>   
            <!-- Image loader -->
            <div id='loader' style='display: none;' >
                <div class="text-center">
                    <div class="spinner-border" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </div>
            <div class="container" style="margin-top: 10px;">
                    <div id="tableContent"></div>
                    <!-- <thead>
                        <tr>
                            <th>No</th>
                            <th>formId</th>
                            <th>fishermanNameEng</th>
                            <th width="100px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody> -->
            </div>   
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
$('#dateForm').on('submit',function(e){
        e.preventDefault();
        var divisionId = $('#divisionId').val();
        var districtId = $('#districtId').val();
        var printLimit =$('#printLimit').val();
        if(divisionId==null||divisionId=='')
        {
        alert('Please select a Division')
        return
        }
        if(printLimit==null||printLimit=='')
        {
        printLimit=0;
        }

        var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
                url: "/get-ajax-report-by-division-and-district",
                type: 'GET',
                data: {
                    divisionId : divisionId,
                    districtId : districtId,
                    printLimit : printLimit,
                    },
				},
        
        columns: [
        //     { data: 'id', defaultContent: '', searchable: false, render: function (data, type, row, meta) {
        //        return meta.row + meta.settings._iDisplayStart + 1; //auto increment
        //   }},
            {data: 'formId', name: 'formId'},
            {data: 'fishermanNameEng', name: 'fishermanNameEng'},
            {data: 'gender', name: 'gender'},
            {data: 'dateOfBirth', name: 'dateOfBirth'},
            {data: 'action', name: 'action', orderable: false, searchable: false},  
        ]
    });

});
</script>

<script type="text/javascript">
  $(document).ready(function(){
        $('#printPdf').click(function(){
            
            var divisionId = $('#divisionId').val();
            var districtId = $('#districtId').val();
            var printLimit =$('#printLimit').val();
            if(divisionId==null||divisionId=='')
            {
                alert('Please select a Division')
                return
            }
           
            if(printLimit==null||printLimit=='')
            {
                printLimit=0;
            }
            $.ajax({
                type: 'GET',
                // url: '/get-fisher-report-by-date-pdf',
                url: '/get-fisher-report-by-district-and-division',
                data: {divisionId: divisionId,districtId: districtId,printLimit: printLimit},
                xhrFields: {
                    responseType: 'blob'
                },
                success: function(response){
                    var blob = new Blob([response]);
                    var link = document.createElement('a');
                    link.href = window.URL.createObjectURL(blob);
                    link.download = "FisherReportbyDate.pdf";
                    link.click();
                },
                error: function(blob){
                console.log(blob);
                }
            });

        });
    });
</script>
<script type="text/javascript">
  $(document).ready(function(){
        $('#printExcel').click(function(){
            var startDate = $('#startDate').val();
            var endDate = $('#endDate').val();
            var printLimit =$('#printLimit').val();
            
            if(startDate==null||startDate=='')
            {
                alert('Please select start date')
                return
            }
            if(endDate==null||endDate=='')
            {
                alert('Please select end date')
                return
            }
            if(printLimit==null||printLimit=='')
            {
                printLimit=0;
            }
            $.ajax({
                type: 'GET',
                url: '/get-fisher-report-by-date-excel',
                data: {startDate: startDate,endDate: endDate,printLimit: printLimit,},
             
                xhrFields: {
                    responseType: 'blob'
                },
                success: function(response){
                    var blob = new Blob([response]);
                    var link = document.createElement('a');
                    link.href = window.URL.createObjectURL(blob);
                    link.download = "FisherReportbyDate.xlsx";
                    link.click();
                },
                error: function(blob){
                console.log(blob);
                }
            });

        });
    });
</script>
<script>
       $(document).ready(function() {
                $('#divisionId').on('change', function() {
                    $('#districtId').val('');
                    $('#upazilaId').val('');
                    $('#areaId').val('');
                    let value = $(this).children("option:selected").val();
                    $.get('{{ url('/') }}/get-district-list/' + value, function(response) {
                        $('#districtId').html(response);
                    })
                });
                $('#districtId').on('change', function() {
                    var districtId = $(this).val();
                    $('#upazilaId').val('');
                    $('#areaId').val('');
                    let value = $(this).children("option:selected").val();
                    $.get('{{ url('/') }}/get-upazila-list/' + value, function(response) {
                        $('#upazilaId').html(response);
                        $('#areaId').html();
                    })
                });
                $('#upazilaId').on('change', function() {
                    $('#areaId').val('');
                    let value = $(this).children("option:selected").val();
                    $.get('{{ url('/') }}/get-area-list/' + value, function(response) {
                        $('#areaId').html(response);
                    })
                });
            });
</script>
@endsection