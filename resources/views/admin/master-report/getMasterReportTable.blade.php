<div class="card mb-4">
    <div class="card-body">
        <div class="peragraph_ex">
            <input type="hidden" id="divisionId" style="display:none;" value="<?php echo $divisionId; ?>">
            <input type="hidden" id="districtId" style="display:none;" value="<?php echo $districtId; ?>">
            <input type="hidden" id="upazilaId" style="display:none;" value="<?php echo $upazilaId; ?>">

            <!-- <input type="" -->
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>রিপোর্টের বিষয়</th>
                        <th>মোট তথ্য</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $text }}</td>
                        <td><a id="getData" style="color: #1c9ccf;cursor:pointer;  border-bottom: #1c9ccf 1px solid;">{{ $count }}</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $("#getData").click(function() {
            var divisionId = $("#divisionId").val();
            var districtId = $("#districtId").val();
            var upazilaId = $("#upazilaId").val();

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

            window.open("/get-master-report-all-data-list?divisionId=" + divisionId + "&districtId=" +
                districtId + "&upazilaId=" + upazilaId + "&genderId=" + genderId + "&religionId=" +
                religionId + "&educationId=" + educationId + "&maritalStatusId=" + maritalStatusId +
                "&yearlySavingId=" + yearlySavingId + "&yearlyLoanId=" + yearlyLoanId +
                "&deficiencyPeriodId=" + deficiencyPeriodId + "&fishingTimeId=" + fishingTimeId +
                "&fishingTypeId=" + fishingTypeId+
                "&typesOfFishId=" + typesOfFishId+
                "&fishingEquipmentId=" + fishingEquipmentId+
                "&ownershipNetId=" + ownershipNetId+
                "&typeOfVesselsId=" + typeOfVesselsId+
                "&ownerOfVesselsId=" + ownerOfVesselsId+
                "&fishSalePlaceId=" + fishSalePlaceId+
                "&ageStarDate=" + ageStarDate+
                "&ageEndDate=" + ageEndDate+
                "&annualIncomeStartId=" + annualIncomeStartId+
                "&annualIncomeEndId=" + annualIncomeEndId+
                "&priceOfVesselStartId=" + priceOfVesselStartId+
                "&priceOfVesselEndId=" + priceOfVesselEndId+
                "&placeOfFishingId=" + placeOfFishingId);

        });

    });
</script>
