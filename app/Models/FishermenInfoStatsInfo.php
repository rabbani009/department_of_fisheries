<?php

namespace App\Models;

use App\Models\CrisisPeriod\CrisisPeriod;
use App\Models\PlaceOfFishing\PlaceOfFishing;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FishermenInfoStatsInfo extends Model
{
    use HasFactory;

    public function birth_district_data(){
        return $this->belongsTo(District::class,'placeOfBirth','districtId');
    }
    public function religion_data(){
        return $this->belongsTo(Religion::class,'religion');
    }
    public function marital_status_data(){
        return $this->belongsTo(MaritalStatus::class,'maritalStatus');
    }
    public function education_data(){
        return $this->belongsTo(Education::class,'education');
    }
    public function fishermen_present_division()
    {
        return $this->belongsTo(Division::class,'presentDivisionId','divisionId');
    }
    public function fishermen_present_district()
    {
        return $this->belongsTo(District::class,'presentDistrictId','districtId');
    }
    public function fishermen_time_of_fishings()
    {
        return $this->belongsTo(TimeOfFishing::class,'timeOfFishing');
    }
    public function fishermen_types_of_fishing()
    {
        return $this->belongsTo(HowToFishing::class,'howToFishing');
    }
    public function fishermen_group_member()
    {
        return $this->belongsTo(GroupMember::class,'groupMember');
    }
    public function fishermen_owner_of_net()
    {
        return $this->belongsTo(OwnerOfNet::class,'ownerOfNet');
    }
    public function fishermen_type_of_vessels()
    {
        return $this->belongsTo(TypeOfVessels::class,'typeOfVessels');
    }
    public function fishermen_owner_of_vessels()
    {
        return $this->belongsTo(OwnerOfVessels::class,'ownerOfVessels');
    }
    public function fishermen_type_of_employment_vessels()
    {
        return $this->belongsTo(TypeOfEmploymentStatusInVessels::class,'typeOfEmploymentInVessels');
    }
    public function fishermen_yearly_loan()
    {
        return $this->belongsTo(YearlyLoan::class,'yearlyLoan');
    }
    public function fishermen_yearly_saving()
    {
        return $this->belongsTo(YearlySaving::class,'yearlySaving');
    }
    public function fishermen_danger_period_of_living()
    {
        return $this->belongsTo(DeficiencyPeriod::class,'dangerPeriodOfLiving');
    }

    public function storeFishermenFishingInformation($data,$fisherInfoCardId,$getPersonalInfoSessionData,$getFamilyInfoSessionData,$getAddressSessionData){
        
        $personalInfoSessionData=(object)$getPersonalInfoSessionData;
        $familyInfoSessionData=(object)$getFamilyInfoSessionData;
        $addressSessionData=(object)$getAddressSessionData;
        // return $addressSessionData->presentDivisionId;
        $add = new static();
        $add->dofId = $fisherInfoCardId;
        // personal information
        $add->placeOfBirth = $personalInfoSessionData->stats_placeOfBirth;
        $add->religion = $personalInfoSessionData->stats_religion;
        $add->education = $personalInfoSessionData->stats_education;
        $add->identificationMark = $personalInfoSessionData->stats_identificationMark;
        $add->mobile = $personalInfoSessionData->stats_mobile;
        // family information
        $add->maritalStatus = $familyInfoSessionData->stats_maritalStatus;
        $add->totalFamilyMember = $familyInfoSessionData->stats_totalFamilyMember;
        $add->numberOfSpouse = $familyInfoSessionData->stats_numberOfSpouse;
        $add->numberOfMother = $familyInfoSessionData->stats_numberOfMother;
        $add->numberOfFather = $familyInfoSessionData->stats_numberOfFather;
        $add->numberOfDaughter = $familyInfoSessionData->stats_numberOfDaughter;
        $add->numberOfSon = $familyInfoSessionData->stats_numberOfSon;
        $add->numberOfOtherMember = $familyInfoSessionData->stats_numberOfOtherMember;
        // address
        $add->presentDivisionId = $addressSessionData->presentDivisionId;
        $add->presentDistrictId = $addressSessionData->presentDistrictId;
        $add->presentUpazilaId = $addressSessionData->presentUpazilaId;
        $add->presentMunicipalityId = $addressSessionData->presentMunicipalityId;
        $add->presentAddressMunicipality = $addressSessionData->presentMunicipalityId;
        $add->presentAddressWard = $addressSessionData->presentWardId;
        $add->presentUnionId = $addressSessionData->presentUnionId;
        $add->presentAddressUnion = $addressSessionData->presentUnionId;
        $add->presentAddressVillage = $addressSessionData->presentVillageId;
        $add->presentPostoffice = $addressSessionData->presentPostOfficeId;
        // fishing information
        $add->timeOfFishing = $data->timeOfFishing;
        $add->placeOfFishing = implode(',', $data->placeOfFishing);
        $add->typeOfFish = implode(',', $data->typeOfFish);
        $add->toolsType = implode(',', $data->toolsType);
        $add->howToFishing = $data->howToFishing;
        if ($data->howToFishing >1) {
            $add->groupMember = $data->groupMember;
        } else {
            $add->groupMember = 0;
        }
        
       
        $add->ownerOfNet = $data->ownerOfNet;
        $add->lengthOfNet = $data->lengthOfNet;
        $add->widthOfNet = $data->widthOfNet;
        $add->priceOfNet = $data->priceOfNet;
        $add->sourceOfPurchaseOfNet = $data->sourceOfPurchaseOfNet;
        $add->typeOfVessels = $data->typeOfVessels;
        $add->ownerOfVessels = $data->ownerOfVessels;
        $add->lengthOfVessels = $data->lengthOfVessels;
        $add->widthOfVessels = $data->widthOfVessels;
        $add->heightOfVessels = $data->heightOfVessels;
        $add->priceOfVessels = $data->priceOfVessels;
        $add->regiNoOfVessels = $data->regiNoOfVessels;
        $add->typeOfEmploymentInVessels = $data->typeOfEmploymentInVessels;
        $add->salePlaceOfFish = implode(',', $data->salePlaceOfFish);
        $add->yearlyLoan = $data->yearlyLoan;
        $add->yearlySaving = $data->yearlySaving;
        $add->dangerPeriodOfLiving = $data->dangerPeriodOfLiving;
        $add->mainProfession = $data->mainProfession;
        $add->subProfession = $data->subProfession;
        $add->annualIncome = $data->annualIncome;
        $add->incomeMainProfession = $data->incomeMainProfession;
        $add->incomeSubProfession = $data->incomeSubProfession;
        // return $data;
        if ($add->save()) {
            return $add;
        }
        return false;
    }

    public function viewFisherStatsInfo($dofId){
       return static::where('dofId',$dofId)->first();
    }

    public function updateFishermenStats($id,$data){
    //    return $data->presentWardId;
        $add = static::where('dofId',$id)->first();
        $add->dofId = $add->dofId;
        // personal information
        $add->placeOfBirth = $data->placeOfBirth;
        $add->religion = $data->religion;
        $add->education = $data->education;
        $add->identificationMark = $data->identificationMark;
        $add->mobile = $data->mobile;
        // family information
        $add->maritalStatus = $data->maritalStatus;
        $add->totalFamilyMember = $data->totalFamilyMember;
        $add->numberOfSpouse = $data->numberOfSpouse;
        $add->numberOfMother = $data->numberOfMother;
        $add->numberOfFather = $data->numberOfFather;
        $add->numberOfDaughter = $data->numberOfDaughter;
        $add->numberOfSon = $data->numberOfSon;
        $add->numberOfOtherMember = $data->numberOfOtherMember;
        // address
        $add->presentDivisionId = $data->presentDivisionId;
        $add->presentDistrictId = $data->presentDistrictId;
        $add->presentUpazilaId = $data->presentUpazilaId;
        $add->presentPostoffice = $data->presentPostOfficeId;
        if (isset($data->presentMunicipalityId)) {
            if ($data->presentMunicipalityId > 0) {
                if (strlen($data->presentMunicipalityId) > 1) {
                    $add->presentMunicipalityId = $data->presentMunicipalityId;
                } else {
                    $add->presentMunicipalityId = '0' . $data->presentMunicipalityId;
                }
            } elseif ($data->presentMunicipalityId == null) {
                $add->presentMunicipalityId = '00';
            } else {
                $add->presentMunicipalityId = '00';
            }
        } else {
            $add->presentMunicipalityId = '00';
        }
        if (isset($data->presentMunicipalityId)) {
            if ($data->presentMunicipalityId > 0) {
                if (strlen($data->presentMunicipalityId) > 1) {
                    $add->presentAddressMunicipality = $data->presentMunicipalityId;
                } else {
                    $add->presentAddressMunicipality = '0' . $data->presentMunicipalityId;
                }
            } elseif ($data->presentMunicipalityId == null) {
                $add->presentAddressMunicipality = '00';
            } else {
                $add->presentAddressMunicipality = '00';
            }
        } else {
            $add->presentAddressMunicipality = '00';
        }
        if (isset($data->presentWardId)) {
            if ($data->presentWardId > 0) {
                if (strlen($data->presentWardId) > 1) {
                    $add->presentAddressWard = $data->presentWardId;
                } else {
                    $add->presentAddressWard = '0' . $data->presentWardId;
                }
            } elseif ($data->presentWardId == null) {
                $add->presentAddressWard = '00';
            } else {
                $add->presentAddressWard = '00';
            }
        } else {
            $add->presentAddressWard = '00';
        }
        if (isset($data->presentUnionId)) {
            if ($data->presentUnionId > 0) {
                if (strlen($data->presentUnionId) > 1) {
                    $add->presentAddressUnion = $data->presentUnionId;
                } else {
                    $add->presentAddressUnion = '0' . $data->presentUnionId;
                }
            } elseif ($data->presentUnionId == null) {
                $add->presentAddressUnion = '00';
            } else {
                $add->presentAddressUnion = '00';
            }
        } else {
            $add->presentAddressUnion = '00';
        }
        if (isset($data->presentUnionId)) {
            if ($data->presentUnionId > 0) {
                if (strlen($data->presentUnionId) > 1) {
                    $add->presentUnionId = $data->presentUnionId;
                } else {
                    $add->presentUnionId = '0' . $data->presentUnionId;
                }
            } elseif ($data->presentUnionId == null) {
                $add->presentUnionId = '00';
            } else {
                $add->presentUnionId = '00';
            }
        } else {
            $add->presentUnionId = '00';
        }
        if (isset($data->presentVillageId)) {
            if ($data->presentVillageId > 0) {
                if (strlen($data->presentVillageId) > 1) {
                    $add->presentAddressVillage = $data->presentVillageId;
                } else {
                    $add->presentAddressVillage = '0' . $data->presentVillageId;
                }
            } elseif ($data->presentVillageId == null) {
                $add->presentAddressVillage = '00';
            } else {
                $add->presentAddressVillage = '00';
            }
        } else {
            $add->presentAddressVillage = '00';
        }
        // $add->presentDivisionId = $data->presentDivisionId;
        // $add->presentDistrictId = $data->presentDistrictId;
        // $add->presentUpazilaId = $data->presentUpazilaId;
        // $add->presentMunicipalityId = $data->presentMunicipalityId;
        // $add->presentAddressMunicipality = $data->presentMunicipalityId;
        // $add->presentAddressWard = $data->presentWardId;
        // $add->presentUnionId = $data->presentUnionId;
        // $add->presentAddressUnion = $data->presentUnionId;
        // $add->presentAddressVillage = $data->presentVillageId;
        // $add->presentPostoffice = $data->presentPostOfficeId;
        // fishing information
        $add->timeOfFishing = $data->timeOfFishing;
        $add->placeOfFishing = implode(',', $data->placeOfFishing);
        $add->typeOfFish = implode(',', $data->typeOfFish);
        $add->toolsType = implode(',', $data->toolsType);
        $add->howToFishing = $data->howToFishing;
        if ($data->howToFishing >1) {
            $add->groupMember = $data->groupMember;
        } else {
            $add->groupMember = 0;
        }
        $add->ownerOfNet = $data->ownerOfNet;
        $add->lengthOfNet = $data->lengthOfNet;
        $add->widthOfNet = $data->widthOfNet;
        $add->priceOfNet = $data->priceOfNet;
        $add->sourceOfPurchaseOfNet = $data->sourceOfPurchaseOfNet;
        $add->typeOfVessels = $data->typeOfVessels;
        $add->ownerOfVessels = $data->ownerOfVessels;
        $add->lengthOfVessels = $data->lengthOfVessels;
        $add->widthOfVessels = $data->widthOfVessels;
        $add->heightOfVessels = $data->heightOfVessels;
        $add->priceOfVessels = $data->priceOfVessels;
        $add->regiNoOfVessels = $data->regiNoOfVessels;
        $add->typeOfEmploymentInVessels = $data->typeOfEmploymentInVessels;
        $add->salePlaceOfFish = implode(',', $data->salePlaceOfFish);
        $add->yearlyLoan = $data->yearlyLoan;
        $add->yearlySaving = $data->yearlySaving;
        $add->dangerPeriodOfLiving = $data->dangerPeriodOfLiving;
        $add->mainProfession = $data->mainProfession;
        $add->subProfession = $data->subProfession;
        $add->annualIncome = $data->annualIncome;
        $add->incomeMainProfession = $data->incomeMainProfession;
        $add->incomeSubProfession = $data->incomeSubProfession;
        if ($add->save()) {
            return $add;
        }
        return false;
    }

    // public function getSubjectWiseReport(){
    //     return static::where()
    // }
}
