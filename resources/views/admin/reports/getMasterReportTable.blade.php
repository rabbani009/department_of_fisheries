<div class="card mb-4">
    <div class="card-body">
        <div class="peragraph_ex">
            <input type="hidden" style="display:none;" id="divisionId" value="<?php echo $divisionId;?>"> 
            <input type="hidden" style="display:none;" id="districtId"value="<?php echo $districtId;?>"> 
            <input type="hidden" style="display:none;" id="upazilaId" value="<?php echo $upazilaId;?>"> 
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>রিপোর্টের বিষয়</th>
                        <th>মোট তথ্য</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$text}}</td>
                        <td><a href="#" id="getData">{{$count}}</a></td>
                    </tr>
                </tbody>
            </table>
            <!-- Yajra datatable -->
            <div class="card-body">
                <div class="container">
                    <table class="table table-bordered data-table">
                        <thead>
                            <tr>
                                <th>Form Id</th>
                                <th>Fisherman Name</th>
                                <th>Gender</th>
                                <th id="dob">DOB</th>                         
                                <th>ID Card</th>                           
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
</div>

    <script>
    $(document).ready(function() {
            $("#getData").click(function() {                
            var divisionId = $("#divisionId").val();
            var districtId = $("#districtId").val();
            var upazilaId = $("#upazilaId").val();
            
            
            });
        });
    </script>





            