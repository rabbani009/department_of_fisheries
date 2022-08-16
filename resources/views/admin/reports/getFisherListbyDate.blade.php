@extends('admin.admin')
@section('content')
<div class="body-content">
    <div class="card mb-4">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="fs-17 font-weight-600 mb-0">Fisher List by Birth Date</h6>
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
                @csrf
                <div class="form-check mb-2 mr-sm-2">
                <label for="staticEmail" class="col-sm-4 col-form-label font-weight-600">Start Date</label>
                    <input class="form-control" type="date" value="" id="startDate" />
                </div>
                <div class="form-check mb-2 mr-sm-2">
                <label for="staticEmail" class="col-sm-4 col-form-label font-weight-600">End Date</label>
                    <input class="form-control" type="date" value="" id="endDate" />
                </div>
                <div class="form-check mb-2 mr-sm-2">
                <label for="staticEmail" class="col-sm-4 col-form-label font-weight-600">Start Limit</label>
                    <input class="form-control" type="text" id="startLimit" placeholder=""/>
                </div>

                <div class="form-check mb-2 mr-sm-2">
                <label for="staticEmail" class="col-sm-4 col-form-label font-weight-600">Print Limit</label>
                    <input class="form-control" type="text" id="endLimit"/>
                </div>
                <button type="submit" class="btn btn-success mb-2" style="margin-left: 20px;">Submit</button>&nbsp&nbsp&nbsp
                <button type="button" class="btn btn-danger mb-2" id="printPdf">Print Pdf</button>&nbsp&nbsp&nbsp
                <button type="button" class="btn btn-success mb-2" id="printExcel">Print Excel</button>&nbsp&nbsp&nbsp
                <button type="button" class="btn btn-primary mb-2" id="printIDCard">Print ID Card</button>
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
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
$('#dateForm').on('submit',function(e){
        e.preventDefault();
        var startDate = $('#startDate').val();
            var endDate = $('#endDate').val();
            var startLimit =$('#startLimit').val();
            var endLimit =$('#endLimit').val();
            var date1 = new Date(startDate);
            var date2 = new Date(endDate);
            var result1 = date1.getTime(); // 1546300800000
            var result2 = date2.getTime(); // 1895097600000
            
            if (result1 > result2) {
                alert("startDate is after endDate")
                return
            }
            if(startLimit==null||startLimit=='')
            {
                startLimit=0;
            }

            if(endLimit==null||endLimit=='')
            {
                endLimit=0;
            }

            if(startLimit>endLimit)
            {
                alert('Print Limit Must be greater than or equal start Limit')
                return
            }

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

        var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        destroy: true,
        order: [1,'asc'],
        ajax: {
                url: "/get-fisher-report-by-date",
                type: 'GET',
                data: {startDate: startDate,endDate: endDate,startLimit: startLimit,endLimit:endLimit},
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
            var startDate = $('#startDate').val();
            var endDate = $('#endDate').val();
            var startLimit =$('#startLimit').val();
            var endLimit =$('#endLimit').val();
            var date1 = new Date(startDate);
            var date2 = new Date(endDate);
            var result1 = date1.getTime(); // 1546300800000
            var result2 = date2.getTime(); // 1895097600000
            
            if (result1 > result2) {
                alert("startDate is after endDate")
                return
            }
            if(startLimit==null||startLimit=='')
            {
                startLimit=0;
            }

            if(endLimit==null||endLimit=='')
            {
                endLimit=0;
            }

            if(startLimit>endLimit)
            {
                alert('Print Limit Must be greater than or equal start Limit')
                return
            }

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
                 
            $.ajax({
                type: 'GET',
                url: '/get-fisher-report-by-date-pdf',
                data: {startDate: startDate,endDate: endDate,startLimit: startLimit,endLimit:endLimit},
                xhrFields: {
                    responseType: 'blob'
                },
                success: function(response){
                    var blob = new Blob([response]);
                    var link = document.createElement('a');
                    link.href = window.URL.createObjectURL(blob);
                    link.download = "Fisher-Report-by-BirthDate.pdf";
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
                    link.download = "FisherReportbyBirthDate.xlsx";
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
        $('#printIDCard').click(function(){

            var startDate = $('#startDate').val();
            var endDate = $('#endDate').val();
            var startLimit =$('#startLimit').val();
            var endLimit =$('#endLimit').val();
            var date1 = new Date(startDate);
            var date2 = new Date(endDate);
            var result1 = date1.getTime(); // 1546300800000
            var result2 = date2.getTime(); // 1895097600000
            
            if (result1 > result2) {
                alert("startDate is after endDate")
                return
            }
            if(startLimit==null||startLimit=='')
            {
                startLimit=0;
            }

            if(endLimit==null||endLimit=='')
            {
                endLimit=0;
            }

            if(startLimit>endLimit)
            {
                alert('Print Limit Must be greater than or equal start Limit')
                return
            }

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
                 
            $.ajax({
                type: 'GET',
                url: '/get-fisher-id-card-by-birth-date-pdf',
                data: {startDate: startDate,endDate: endDate,startLimit: startLimit,endLimit:endLimit},
                xhrFields: {
                    responseType: 'blob'
                },
                success: function(response){
                    var blob = new Blob([response]);
                    var link = document.createElement('a');
                    link.href = window.URL.createObjectURL(blob);
                    link.download = "Fisher-ID-Card-by-BirthDate.pdf";
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