@extends('admin.admin')
@section('content')
<input type="hidden" id="divisionId" value="<?php if(isset($divisionId)) echo $divisionId; else echo '';?>" >
<input type="hidden" id="districtId" value="<?php if(isset($districtId)) echo $districtId; else echo '';?>" >
<input type="hidden" id="upazilaId" value="<?php if(isset($upazilaId)) echo $upazilaId; else echo '';?>" >

<div class="body-content">
    <div class="card mb-4">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="fs-17 font-weight-600 mb-0">Fisher List by Date</h6><br>

                <form class="form-inline">
                    @csrf   
                    <div class="form-check mb-2 mr-sm-2">
                    <label for="staticEmail" class="col-sm-4 col-form-label font-weight-600">Start Limit</label>
                        <input class="form-control" type="text" id="startLimit" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"/>
                    </div>

                    <div class="form-check mb-2 mr-sm-2">
                    <label for="staticEmail" class="col-sm-4 col-form-label font-weight-600">End Limit</label>
                        <input class="form-control" type="text" id="endLimit" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"/>
                    </div>
                    <button type="button" class="btn btn-danger mb-2" id="masterReportPdf" >Print Pdf</button>&nbsp&nbsp&nbsp 
                    <button type="button" class="btn btn-info mb-2" id="masterReportIdCardPrint" >Print ID Card</button>&nbsp&nbsp&nbsp 
                </form>

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

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
<script type="text/javascript">
    $(document).ready(function() {
        var divisionId =$('#divisionId').val();
        var districtId=$('#districtId').val();
        var upazilaId=$('#upazilaId').val();

        const genderId = @json($genderId);
        const religionId = @json($religionId);
        const educationId = @json($educationId);
        const maritalStatusId = @json($maritalStatusId);
        const yearlySavingId = @json($yearlySavingId);
        const yearlyLoanId = @json($yearlyLoanId);
        const deficiencyPeriodId = @json($deficiencyPeriodId);
        const fishingTimeId = @json($fishingTimeId);
        const fishingTypeId = @json($fishingTypeId);
        const placeOfFishingId = @json($placeOfFishingId);
        const typesOfFishId = @json($typesOfFishId);
        const fishingEquipmentId = @json($fishingEquipmentId);
        const ownershipNetId = @json($ownershipNetId);
        const typeOfVesselsId = @json($typeOfVesselsId);
        const ownerOfVesselsId = @json($ownerOfVesselsId);
        const fishSalePlaceId = @json($fishSalePlaceId);
        const ageStarDate = @json($ageStarDate);
        const ageEndDate = @json($ageEndDate);
        const annualIncomeStartId = @json($annualIncomeStartId);
        const annualIncomeEndId = @json($annualIncomeEndId);
        const priceOfVesselStartId = @json($priceOfVesselStartId);
        const priceOfVesselEndId = @json($priceOfVesselEndId);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var table = $('.data-table').DataTable({
        processing: true,
        serverSide: false,
        ajax: {
                url: "/get-master-report-data-by-parameter",
                type: 'POST',
                data: {
                    divisionId: divisionId,
                    districtId: districtId,
                    upazilaId:upazilaId,
                    genderId: genderId,
                    religionId: religionId,
                    educationId: educationId,
                    maritalStatusId: maritalStatusId,
                    yearlySavingId: yearlySavingId,
                    yearlyLoanId: yearlyLoanId,
                    deficiencyPeriodId: deficiencyPeriodId,
                    fishingTimeId: fishingTimeId,
                    placeOfFishingId: placeOfFishingId,
                    typesOfFishId: typesOfFishId,
                    fishingEquipmentId: fishingEquipmentId,
                    ownershipNetId: ownershipNetId,
                    typeOfVesselsId: typeOfVesselsId,
                    ownerOfVesselsId: ownerOfVesselsId,
                    fishSalePlaceId: fishSalePlaceId,
                    ageStarDate: ageStarDate,
                    ageEndDate: ageEndDate,
                    annualIncomeStartId: annualIncomeStartId,
                    annualIncomeEndId: annualIncomeEndId,
                    priceOfVesselStartId: priceOfVesselStartId,
                    priceOfVesselEndId: priceOfVesselEndId,
                    fishingTypeId: fishingTypeId
                }
			},
        columns: [
            { data: 'id', defaultContent: '', searchable: false, render: function (data, type, row, meta) {
               return meta.row + meta.settings._iDisplayStart + 1; 
            }},
            {data: 'formId', name: 'formId'},
            {data: 'fishermanNameEng', name: 'fishermanNameEng'},
            {data: 'gender', name: 'gender'},
            {data: 'dateOfBirth', name: 'dateOfBirth'},
            {data: 'IdCard', name: 'IdCard'},
            {data: 'action', name: 'action', orderable: false, searchable: false},  
        ]
    });
    
    })
</script>
<script type="text/javascript">
$(document).ready(function(){
  $('#masterReportPdf').click(function(e){
    e.preventDefault();
    var startLimit = $('#startLimit').val();
    var endLimit = $('#endLimit').val();
    if(startLimit==null||startLimit=='')
    {
        startLimit=0;
        swal("Sorry!!","Please type start limit for pdf print",{
            button: "OK",
        })
        return
    }

    if(endLimit==null||endLimit=='')
    {
        endLimit=0;
        swal("Sorry!!","Please type end limit for pdf print",{
            button: "OK",
        })
        return
    }
    var startLimit = parseInt(startLimit);
    var endLimit =  parseInt(endLimit);
    
    if(startLimit>endLimit)
    {
        swal("Sorry!!","End Limit Must be greater than or equal start Limit.",{
            button: "OK",
        })
        return
    }

    if(endLimit>5000)
    {
        swal("Sorry!!","End Limit Must be less than or equal to 5000.",{
            button: "OK",
        })
        return
    }

    var divisionId =$('#divisionId').val();
    var districtId=$('#districtId').val();
    var upazilaId=$('#upazilaId').val();

    const genderId = @json($genderId);
    const religionId = @json($religionId);
    const educationId = @json($educationId);
    const maritalStatusId = @json($maritalStatusId);
    const yearlySavingId = @json($yearlySavingId);
    const yearlyLoanId = @json($yearlyLoanId);
    const deficiencyPeriodId = @json($deficiencyPeriodId);
    const fishingTimeId = @json($fishingTimeId);
    const fishingTypeId = @json($fishingTypeId);
    const placeOfFishingId = @json($placeOfFishingId);
    const typesOfFishId = @json($typesOfFishId);
    const fishingEquipmentId = @json($fishingEquipmentId);
    const ownershipNetId = @json($ownershipNetId);
    const typeOfVesselsId = @json($typeOfVesselsId);
    const ownerOfVesselsId = @json($ownerOfVesselsId);
    const fishSalePlaceId = @json($fishSalePlaceId);
    const ageStarDate = @json($ageStarDate);
    const ageEndDate = @json($ageEndDate);
    const annualIncomeStartId = @json($annualIncomeStartId);
    const annualIncomeEndId = @json($annualIncomeEndId);
    const priceOfVesselStartId = @json($priceOfVesselStartId);
    const priceOfVesselEndId = @json($priceOfVesselEndId);

    $.ajax({
        type: 'GET',
        url: '/get-fisher-master-report-pdf',
        data: {
                divisionId: divisionId,
                districtId: districtId,
                upazilaId:upazilaId,
                genderId: genderId,
                religionId: religionId,
                educationId: educationId,
                maritalStatusId: maritalStatusId,
                yearlySavingId: yearlySavingId,
                yearlyLoanId: yearlyLoanId,
                deficiencyPeriodId: deficiencyPeriodId,
                fishingTimeId: fishingTimeId,
                placeOfFishingId: placeOfFishingId,
                typesOfFishId: typesOfFishId,
                fishingEquipmentId: fishingEquipmentId,
                ownershipNetId: ownershipNetId,
                typeOfVesselsId: typeOfVesselsId,
                ownerOfVesselsId: ownerOfVesselsId,
                fishSalePlaceId: fishSalePlaceId,
                ageStarDate: ageStarDate,
                ageEndDate: ageEndDate,
                annualIncomeStartId: annualIncomeStartId,
                annualIncomeEndId: annualIncomeEndId,
                priceOfVesselStartId: priceOfVesselStartId,
                priceOfVesselEndId: priceOfVesselEndId,
                fishingTypeId: fishingTypeId,
                startLimit: startLimit,
                endLimit: endLimit
            },
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
  $('#masterReportIdCardPrint').click(function(e){
    e.preventDefault();
    var startLimit = $('#startLimit').val();
    var endLimit = $('#endLimit').val();
    
    if(startLimit==null||startLimit=='')
    {
        startLimit=0;
        swal("Sorry!!","Please type start limit for Id card print",{
            button: "OK",
        })
        return
    }

    if(endLimit==null||endLimit=='')
    {
        endLimit=0;
        swal("Sorry!!","Please type end limit for ID card print",{
            button: "OK",
        })
        return
    }
    var startLimit = parseInt(startLimit);
    var endLimit =  parseInt(endLimit);
    
    if(startLimit>endLimit)
    {
        swal("Sorry!!","End Limit Must be greater than or equal start Limit.",{
            button: "OK",
        })
        return
    }

    if(endLimit>5000)
    {
        swal("Sorry!!","End Limit Must be less than or equal to 5000.",{
            button: "OK",
        })
        return
    }

    var divisionId =$('#divisionId').val();
    var districtId=$('#districtId').val();
    var upazilaId=$('#upazilaId').val();

    const genderId = @json($genderId);
    const religionId = @json($religionId);
    const educationId = @json($educationId);
    const maritalStatusId = @json($maritalStatusId);
    const yearlySavingId = @json($yearlySavingId);
    const yearlyLoanId = @json($yearlyLoanId);
    const deficiencyPeriodId = @json($deficiencyPeriodId);
    const fishingTimeId = @json($fishingTimeId);
    const fishingTypeId = @json($fishingTypeId);
    const placeOfFishingId = @json($placeOfFishingId);
    const typesOfFishId = @json($typesOfFishId);
    const fishingEquipmentId = @json($fishingEquipmentId);
    const ownershipNetId = @json($ownershipNetId);
    const typeOfVesselsId = @json($typeOfVesselsId);
    const ownerOfVesselsId = @json($ownerOfVesselsId);
    const fishSalePlaceId = @json($fishSalePlaceId);
    const ageStarDate = @json($ageStarDate);
    const ageEndDate = @json($ageEndDate);
    const annualIncomeStartId = @json($annualIncomeStartId);
    const annualIncomeEndId = @json($annualIncomeEndId);
    const priceOfVesselStartId = @json($priceOfVesselStartId);
    const priceOfVesselEndId = @json($priceOfVesselEndId);

    $.ajax({
        type: 'GET',
        url: '/get-fishers-id-card-from-master-report',
        data: {
                divisionId: divisionId,
                districtId: districtId,
                upazilaId:upazilaId,
                genderId: genderId,
                religionId: religionId,
                educationId: educationId,
                maritalStatusId: maritalStatusId,
                yearlySavingId: yearlySavingId,
                yearlyLoanId: yearlyLoanId,
                deficiencyPeriodId: deficiencyPeriodId,
                fishingTimeId: fishingTimeId,
                placeOfFishingId: placeOfFishingId,
                typesOfFishId: typesOfFishId,
                fishingEquipmentId: fishingEquipmentId,
                ownershipNetId: ownershipNetId,
                typeOfVesselsId: typeOfVesselsId,
                ownerOfVesselsId: ownerOfVesselsId,
                fishSalePlaceId: fishSalePlaceId,
                ageStarDate: ageStarDate,
                ageEndDate: ageEndDate,
                annualIncomeStartId: annualIncomeStartId,
                annualIncomeEndId: annualIncomeEndId,
                priceOfVesselStartId: priceOfVesselStartId,
                priceOfVesselEndId: priceOfVesselEndId,
                fishingTypeId: fishingTypeId,
                startLimit: startLimit,
                endLimit: endLimit
            },
        xhrFields: {
            responseType: 'blob'
        },
        success: function(response){
            var blob = new Blob([response]);
            var link = document.createElement('a');
            link.href = window.URL.createObjectURL(blob);
            link.download = "Fisher-Id-Card-List.pdf";
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
