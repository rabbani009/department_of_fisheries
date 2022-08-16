<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\FishermenInfoStatsInfo;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Image;
use Carbon\Carbon;
use PHPUnit\TextUI\XmlConfiguration\CodeCoverage\Report\Php;

class FishermenInfoCardPrint extends Model
{
    use HasFactory;
    protected $table = 'fishermen_info_card_prints';

    protected $fillable = [
        'formId',
        'fId',
        'postOfficeId',
        'fishermanNameBng',
        'fishermanNameEng',
        'nationalIdNo',
        'gender',
        'mothersName',
        'fathersName',
        'spouseName',
        'dateOfBirth',
        'divisionId',
        'districtId',
        'upazillaId',
        'municipalityId',
        'unionId',
        'wardId',
        'villageId',
        'photoPath',
        'nidPhotoPath',
        'form1PhotoPath',
        'form2PhotoPath',
        'statusId',
        'barcode',
        'issueDate',
        'phase',
    ];

    // public function fishermen_stats_info()
    // {
    //     return $this->belongsTo(FishermenInfoStatsInfo::class, 'id', 'dofId');
    // }
    public function fishermen_division()
    {
        return $this->belongsTo(Division::class, 'divisionId', 'divisionId');
    }
    public function fishermen_district()
    {
        return $this->belongsTo(District::class, 'districtId', 'districtId');
    }
    public function fishermen_post_office()
    {
        return $this->belongsTo(PostOffice::class, 'postOfficeId', 'postId');
    }
    public function getFishermenInfoCardPrintList()
    {
        return static::select('id', 'formId', 'fId', 'fishermanNameEng', 'fishermanNameBng', 'fathersName', 'mothersName', 'dateOfBirth')
            ->orderBy('id', 'ASC')
            ->simplepaginate(100);
        // ->get();
    }

    public function scopeSearch($query, $search)
    {
        return $query
            ->where('fishermanNameEng', 'like', '%' . $search . '%')
            ->orWhere('nationalIdNo', 'like', '%' . $search . '%')
            ->orWhere('fId', 'like', '%' . $search . '%');
    }

    public function scopeGetfisherdatabydate($query, $startDate, $endDate)
    {
        return $query->whereDate('created_at', '>=', $startDate)->whereDate('created_at', '<=', $endDate);
    }

    public static function getfisherdata($startDate, $endDate)
    {
        $data = static::whereDate('created_at', '>=', $startDate)
            ->whereDate('created_at', '<=', $endDate)
            ->get();
        return $data;
    }

    public static function getFisherforExcelList($startDate, $endDate, $printLimit)
    {
        // 'formId', 'nationalIdNo','postOfficeId','fishermanNameBng'
        $list = [];
        if ($printLimit == 0) {
            // $data = static::join('post_offices','post_offices.postId','=','fishermen_info_card_prints.postOfficeId')
            // ->join('divisions','divisions.divisionId','=','fishermen_info_card_prints.divisionId')
            // ->join('districts','districts.districtId','=','fishermen_info_card_prints.districtId')
            // ->whereDate('dateOfBirth', '>=', $startDate)
            // ->whereDate('dateOfBirth', '<=', $endDate)
            // ->get(['formId','nationalIdNo','post_offices.postOfficeEnglish','post_offices.postOfficeBangla','fishermanNameBng','gender','fathersName','mothersName','spouseName', 'dateOfBirth','divisions.divisionBng','divisions.divisionEng','districts.districtBng','districts.districtEng']);

            $data = static::join('post_offices', 'post_offices.postId', '=', 'fishermen_info_card_prints.postOfficeId')
                ->join('divisions', 'divisions.divisionId', '=', 'fishermen_info_card_prints.divisionId')
                ->join('districts', 'districts.districtId', '=', 'fishermen_info_card_prints.districtId')
                ->whereDate('dateOfBirth', '>=', $startDate)
                ->whereDate('dateOfBirth', '<=', $endDate)
                ->chunk(100, function ($fishers) {
                    foreach ($fishers as $fisher) {
                        $list[] = [
                            'formId' => $fisher->formId,
                            'nationalIdNo' => $fisher->nationalIdNo,
                            'post_offices.postOfficeEnglish' => $fisher->nationalIdNo,
                        ];
                    }
                });
            //  ->get(['formId','nationalIdNo','post_offices.postOfficeEnglish','post_offices.postOfficeBangla','fishermanNameBng','gender','fathersName','mothersName','spouseName', 'dateOfBirth','divisions.divisionBng','divisions.divisionEng','districts.districtBng','districts.districtEng']);
            return $data;

            // return $data;
        } elseif ($printLimit != 0) {
            // $data = static::with('fishermen_post_office.postOfficeEnglish')->select('formId', 'nationalIdNo','postOfficeId','fishermanNameBng')->whereDate('dateOfBirth', '>=', $startDate)
            //     ->whereDate('dateOfBirth', '<=', $endDate)->take($printLimit)->get()->toArray();
            $data = static::join('post_offices', 'post_offices.postId', '=', 'fishermen_info_card_prints.postOfficeId')
                ->join('divisions', 'divisions.divisionId', '=', 'fishermen_info_card_prints.divisionId')
                ->join('districts', 'districts.districtId', '=', 'fishermen_info_card_prints.districtId')
                ->whereDate('dateOfBirth', '>=', $startDate)
                ->whereDate('dateOfBirth', '<=', $endDate)
                ->take($printLimit)
                // ->chunk(100, function($fishers) {
                //     foreach($fishers as $fisher)
                //     {
                //         $list[] = array(
                //             'formId' => $fisher->formId,
                //             'nationalIdNo' => $fisher->nationalIdNo,
                //             'post_offices.postOfficeEnglish' => $fisher->nationalIdNo,

                //         );
                //     }
                // })
                ->get([
                    'formId',
                    'nationalIdNo',
                    'post_offices.postOfficeEnglish',
                    'post_offices.postOfficeBangla',
                    'fishermanNameBng',
                    'gender',
                    'fathersName',
                    'mothersName',
                    'spouseName',
                    'dateOfBirth',
                    'divisions.divisionBng',
                    'divisions.divisionEng',
                    'districts.districtBng',
                    'districts.districtEng',
                ]);
            return $data;
        }
    }

    public function storeFishermenPersonalInformation($data, $image)
    {
        $day = $data->dateOfBirthDay;
        $month = $data->dateOfBirthMonth;
        $year = $data->dateOfBirthYear;
        // stats
        $stats_mobile = $data->mobile;
        $stats_religion = $data->religion;
        if (strlen($data->placeOfBirth) > 1) {
            $stats_placeOfBirth = $data->placeOfBirth;
        } else {
            $stats_placeOfBirth = '0' . $data->placeOfBirth;
        }

        $stats_education = $data->education;
        $stats_identificationMark = $data->identificationMark;
        $add = new static();
        $add->formId = $data->formId;
        $add->fishermanNameBng = $data->fishermanNameBng;
        $add->fishermanNameEng = $data->fishermanNameEng;
        $add->nationalIdNo = $data->nationalIdNo;
        $add->gender = $data->gender;
        $add->photoPath = $image;
        $add->dateOfBirth = $year . "-" . $month . "-" . $day;

        return [
            'storeFishermenPersonalInformation' => $add,
            'stats_mobile' => $stats_mobile,
            'stats_religion' => $stats_religion,
            'stats_placeOfBirth' => $stats_placeOfBirth,
            'stats_education' => $stats_education,
            'stats_identificationMark' => $stats_identificationMark,
        ];
    }
    public function storeFishermenFamilyInformation($data)
    {
        // return $data->maritalStatus;
        // stats
        $stats_maritalStatus = $data->maritalStatus;
        $stats_totalFamilyMember = $data->totalFamilyMember;
        $stats_numberOfSpouse = $data->numberOfSpouse;
        $stats_numberOfMother = $data->numberOfMother;
        $stats_numberOfFather = $data->numberOfFather;
        $stats_numberOfDaughter = $data->numberOfDaughter;
        $stats_numberOfSon = $data->numberOfSon;
        $stats_numberOfOtherMember = $data->numberOfOtherMember;
        // $maritalStatus=Session::put('maritalStatus',$data->maritalStatus);
        $add = new static();
        $add->mothersName = $data->mothersName;
        $add->fathersName = $data->fathersName;
        $add->spouseName = $data->spouseName;
        return [
            'storeFishermenFamilyInformation' => $add,
            'stats_maritalStatus' => $stats_maritalStatus,
            'stats_totalFamilyMember' => $stats_totalFamilyMember,
            'stats_numberOfSpouse' => $stats_numberOfSpouse,
            'stats_numberOfMother' => $stats_numberOfMother,
            'stats_numberOfFather' => $stats_numberOfFather,
            'stats_numberOfDaughter' => $stats_numberOfDaughter,
            'stats_numberOfSon' => $stats_numberOfSon,
            'stats_numberOfOtherMember' => $stats_numberOfOtherMember,
        ];
    }
    public function storeFishermenAddressInformation($data)
    {
        $stats_presentDivisionId = $data->presentDivisionId;
        $stats_presentDistrictId = $data->presentDistrictId;
        $stats_presentUpazilaId = $data->presentUpazilaId;
        $stats_presentPostOfficeId = $data->presentPostOfficeId;
        if (isset($data->presentMunicipalityId)) {
            if ($data->presentMunicipalityId > 0) {
                if (strlen($data->presentMunicipalityId) > 1) {
                    $stats_presentMunicipalityId = $data->presentMunicipalityId;
                } else {
                    $stats_presentMunicipalityId = '0' . $data->presentMunicipalityId;
                }
            } elseif ($data->presentMunicipalityId == null) {
                $stats_presentMunicipalityId = '00';
            } else {
                $stats_presentMunicipalityId = '00';
            }
        } else {
            $stats_presentMunicipalityId = '00';
        }
        if (isset($data->presentWardId)) {
            if ($data->presentWardId > 0) {
                if (strlen($data->presentWardId) > 1) {
                    $stats_presentWardId = $data->presentWardId;
                } else {
                    $stats_presentWardId = '0' . $data->presentWardId;
                }
            } elseif ($data->presentWardId == null) {
                $stats_presentWardId = '00';
            } else {
                $stats_presentWardId = '00';
            }
        } else {
            $stats_presentWardId = '00';
        }
        if (isset($data->presentUnionId)) {
            if ($data->presentUnionId > 0) {
                if (strlen($data->presentUnionId) > 1) {
                    $stats_presentUnionId = $data->presentUnionId;
                } else {
                    $stats_presentUnionId = '0' . $data->presentUnionId;
                }
            } elseif ($data->presentUnionId == null) {
                $stats_presentUnionId = '00';
            } else {
                $stats_presentUnionId = '00';
            }
        } else {
            $stats_presentUnionId = '00';
        }
        if (isset($data->presentVillageId)) {
            if ($data->presentVillageId > 0) {
                if (strlen($data->presentVillageId) > 1) {
                    $stats_presentVillageId = $data->presentVillageId;
                } else {
                    $stats_presentVillageId = '0' . $data->presentVillageId;
                }
            } elseif ($data->presentVillageId == null) {
                $stats_presentVillageId = '00';
            } else {
                $stats_presentVillageId = '00';
            }
        } else {
            $stats_presentVillageId = '00';
        }

        $add = new static();
        // address
        if (strlen($data->divisionId) > 1) {
            $add->divisionId = $data->divisionId;
        } else {
            $add->divisionId = '0' . $data->divisionId;
        }
        if (strlen($data->districtId) > 1) {
            $add->districtId = $data->districtId;
        } else {
            $add->districtId = '0' . $data->districtId;
        }
        if (strlen($data->upazilaId) > 1) {
            $add->upazilaId = $data->upazilaId;
        } else {
            $add->upazilaId = '0' . $data->upazilaId;
        }

        if (isset($data->municipalityId)) {
            if ($data->municipalityId > 0) {
                if (strlen($data->municipalityId) > 1) {
                    $add->municipalityId = $data->municipalityId;
                } else {
                    $add->municipalityId = '0' . $data->municipalityId;
                }
            } elseif ($data->municipalityId == null) {
                $add->municipalityId = '00';
            } else {
                $add->municipalityId = '00';
            }
        } else {
            $add->municipalityId = '00';
        }
        if (isset($data->wardId)) {
            if ($data->wardId > 0) {
                if (strlen($data->wardId) > 1) {
                    $add->wardId = $data->wardId;
                } else {
                    $add->wardId = '0' . $data->wardId;
                }
            } elseif ($data->wardId == null) {
                $add->wardId = '00';
            } else {
                $add->wardId = '00';
            }
        } else {
            $add->wardId = '00';
        }
        if (isset($data->unionId)) {
            if ($data->unionId > 0) {
                if (strlen($data->unionId) > 1) {
                    $add->unionId = $data->unionId;
                } else {
                    $add->unionId = '0' . $data->unionId;
                }
            } elseif ($data->unionId == null) {
                $add->unionId = '00';
            } else {
                $add->unionId = '00';
            }
        } else {
            $add->unionId = '00';
        }
        if (isset($data->villageId)) {
            if ($data->villageId > 0) {
                if (strlen($data->villageId) > 1) {
                    $add->villageId = $data->villageId;
                } else {
                    $add->villageId = '0' . $data->villageId;
                }
            } elseif ($data->villageId == null) {
                $add->villageId = '00';
            } else {
                $add->villageId = '00';
            }
        } else {
            $add->villageId = '00';
        }
        $add->postOfficeId = $data->postOfficeId;
        return [
            'storeFishermenAddressInformation' => $add,
            'stats_presentDivisionId' => $stats_presentDivisionId,
            'stats_presentDistrictId' => $stats_presentDistrictId,
            'stats_presentUpazilaId' => $stats_presentUpazilaId,
            'stats_presentMunicipalityId' => $stats_presentMunicipalityId,
            'stats_presentWardId' => $stats_presentWardId,
            'stats_presentUnionId' => $stats_presentUnionId,
            'stats_presentVillageId' => $stats_presentVillageId,
            'stats_presentPostOfficeId' => $stats_presentPostOfficeId,
        ];
    }
    public function storeFishermenAllCardInformation($userId, $fishermenAddressInfoCard, $fishermenPersonalInfoCard, $fishermenFamilyInfoCard)
    {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } elseif (isset($_SERVER['HTTP_X_FORWARDED'])) {
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        } elseif (isset($_SERVER['HTTP_FORWARDED_FOR'])) {
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        } elseif (isset($_SERVER['HTTP_FORWARDED'])) {
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        } elseif (isset($_SERVER['REMOTE_ADDR'])) {
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        } else {
            $ipaddress = 'UNKNOWN';
        }
        $number = mt_rand(100000, 999999);

        $add = new static();
        // personal information
        $add->formId = $fishermenPersonalInfoCard->formId;
        $add->fishermanNameBng = $fishermenPersonalInfoCard->fishermanNameBng;
        $add->fishermanNameEng = $fishermenPersonalInfoCard->fishermanNameEng;
        $add->nationalIdNo = $fishermenPersonalInfoCard->nationalIdNo;
        $add->gender = $fishermenPersonalInfoCard->gender;
        $add->dateOfBirth = $fishermenPersonalInfoCard->dateOfBirth;
        $add->photoPath = $fishermenPersonalInfoCard->photoPath;
        // family information
        $add->mothersName = $fishermenFamilyInfoCard->mothersName;
        $add->fathersName = $fishermenFamilyInfoCard->fathersName;
        $add->spouseName = $fishermenFamilyInfoCard->spouseName;
        // address information
        $add->divisionId = $fishermenAddressInfoCard->divisionId;
        $add->districtId = $fishermenAddressInfoCard->districtId;
        $add->upazilaId = $fishermenAddressInfoCard->upazilaId;
        $add->municipalityId = $fishermenAddressInfoCard->municipalityId;
        $add->unionId = $fishermenAddressInfoCard->unionId;
        $add->wardId = $fishermenAddressInfoCard->wardId;
        $add->villageId = $fishermenAddressInfoCard->villageId;
        $add->postOfficeId = $fishermenAddressInfoCard->postOfficeId;

        $add->fId = $add->divisionId . $add->districtId . $add->upazilaId . $add->municipalityId . $add->unionId . $number;
        $add->createdByUserId = $userId;
        $add->createdByLoginIp = $ipaddress;
        if ($add->save()) {
            return [
                'storeFishermenAllCardInformation' => $add,
            ];
        }
    }

    public function viewFishermenInfo($id)
    {
        return static::find($id);
        return $id;
    }

    public function updateFishermenCard($userId, $data, $image)
    {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } elseif (isset($_SERVER['HTTP_X_FORWARDED'])) {
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        } elseif (isset($_SERVER['HTTP_FORWARDED_FOR'])) {
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        } elseif (isset($_SERVER['HTTP_FORWARDED'])) {
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        } elseif (isset($_SERVER['REMOTE_ADDR'])) {
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        } else {
            $ipaddress = 'UNKNOWN';
        }

        $day = $data->dateOfBirthDay;
        $month = $data->dateOfBirthMonth;
        $year = $data->dateOfBirthYear;

        $add = static::find($data->id);
        $add->formId = $data->formId;
        $add->fId = $add->fId;
        $add->postOfficeId = $data->postOfficeId;
        $add->fishermanNameBng = $data->fishermanNameBng;
        $add->fishermanNameEng = $data->fishermanNameEng;
        $add->nationalIdNo = $data->nationalIdNo;
        $add->gender = $data->gender;
        $add->photoPath = $image;
        $add->dateOfBirth = $year . "-" . $month . "-" . $day;
        // family information
        $add->mothersName = $data->mothersName;
        $add->fathersName = $data->fathersName;
        $add->spouseName = $data->spouseName;
        // address information
        // $add->divisionId = $data->divisionId;
        // $add->districtId = $data->districtId;
        // $add->upazilaId = $data->upazilaId;
        // $add->municipalityId = $data->municipalityId;
        // $add->unionId = $data->unionId;
        // $add->wardId = $data->wardId;
        // $add->villageId = $data->villageId;
        if (strlen($data->divisionId) > 1) {
            $add->divisionId = $data->divisionId;
        } else {
            $add->divisionId = '0' . $data->divisionId;
        }
        if (strlen($data->districtId) > 1) {
            $add->districtId = $data->districtId;
        } else {
            $add->districtId = '0' . $data->districtId;
        }
        if (strlen($data->upazilaId) > 1) {
            $add->upazilaId = $data->upazilaId;
        } else {
            $add->upazilaId = '0' . $data->upazilaId;
        }

        if (isset($data->municipalityId)) {
            if ($data->municipalityId > 0) {
                if (strlen($data->municipalityId) > 1) {
                    $add->municipalityId = $data->municipalityId;
                } else {
                    $add->municipalityId = '0' . $data->municipalityId;
                }
            } elseif ($data->municipalityId == null) {
                $add->municipalityId = '00';
            } else {
                $add->municipalityId = '00';
            }
        } else {
            $add->municipalityId = '00';
        }
        if (isset($data->wardId)) {
            if ($data->wardId > 0) {
                if (strlen($data->wardId) > 1) {
                    $add->wardId = $data->wardId;
                } else {
                    $add->wardId = '0' . $data->wardId;
                }
            } elseif ($data->wardId == null) {
                $add->wardId = '00';
            } else {
                $add->wardId = '00';
            }
        } else {
            $add->wardId = '00';
        }
        if (isset($data->unionId)) {
            if ($data->unionId > 0) {
                if (strlen($data->unionId) > 1) {
                    $add->unionId = $data->unionId;
                } else {
                    $add->unionId = '0' . $data->unionId;
                }
            } elseif ($data->unionId == null) {
                $add->unionId = '00';
            } else {
                $add->unionId = '00';
            }
        } else {
            $add->unionId = '00';
        }
        if (isset($data->villageId)) {
            if ($data->villageId > 0) {
                if (strlen($data->villageId) > 1) {
                    $add->villageId = $data->villageId;
                } else {
                    $add->villageId = '0' . $data->villageId;
                }
            } elseif ($data->villageId == null) {
                $add->villageId = '00';
            } else {
                $add->villageId = '00';
            }
        } else {
            $add->villageId = '00';
        }
        $add->createdByUserId = $add->createdByUserId;
        $add->createdByLoginIp = $add->createdByLoginIp;
        $add->updatedByUserId = $userId;
        $add->updatedByLoginIp = $ipaddress;
        if ($add->save()) {
            return $add;
        }
        return false;
    }

    //report
    public function subjectBasedReport($data)
    {
        // return $data;
        if ($data == 'gender_wise') {
            return static::select('divisionId', 'gender', DB::raw('count(*) as total'))
                ->select('divisionId', 'gender', DB::raw('count(*) as total'))
                ->groupBy('divisionId', 'gender')
                ->get();
        }
        if ($data == 'number_wise') {
            return static::select('divisionId', DB::raw('count(*) as total'))
                ->select('divisionId', DB::raw('count(*) as total'))
                ->groupBy('divisionId')
                ->get();
        }
    }

    public function countFisherManbyArea($allVar)
    {
        // return $allVar;
        // return $allVar['genderId'];
        if (strlen($allVar['divisionId']) > 1) {
            $newDivisionId = $allVar['divisionId'];
        } else {
            $newDivisionId = '0' . $allVar['divisionId'];
        }
        if (strlen($allVar['districtId']) > 1) {
            $newDistrictId = $allVar['districtId'];
        } else {
            $newDistrictId = '0' . $allVar['districtId'];
        }
        if (strlen($allVar['upazilaId']) > 1) {
            $newUpazilaId = $allVar['upazilaId'];
        } else {
            $newUpazilaId = '0' . $allVar['upazilaId'];
        }
        $getGender = $allVar['genderId'];
        $getReligion = $allVar['religionId'];
        $getEducation = $allVar['educationId'];
        $getmaritalStatus = $allVar['maritalStatusId'];
        $getyearlySaving = $allVar['yearlySavingId'];
        $getyearlyLoan = $allVar['yearlyLoanId'];
        $getdeficiencyPeriod = $allVar['deficiencyPeriodId'];
        $getfishingTime = $allVar['fishingTimeId'];
        $getAgeStarDate = $allVar['ageStarDate'];
        $getAgeEndDate = $allVar['ageEndDate'];
        $getannualIncomeStart = $allVar['annualIncomeStartId'];
        $getannualIncomeEnd = $allVar['annualIncomeEndId'];
        $getplaceOfFishing = $allVar['placeOfFishingId'];
        // return count($getplaceOfFishing);
        $gettypesOfFish = $allVar['typesOfFishId'];
        $getfishingEquipment = $allVar['fishingEquipmentId'];
        $getfishingType = $allVar['fishingTypeId'];
        $getownershipNet = $allVar['ownershipNetId'];
        $gettypeOfVessels = $allVar['typeOfVesselsId'];
        $getownerOfVessels = $allVar['ownerOfVesselsId'];
        $getfishSalePlace = $allVar['fishSalePlaceId'];
        $getpriceOfVesselStart = $allVar['priceOfVesselStartId'];
        $getpriceOfVesselEnd = $allVar['priceOfVesselEndId'];

        if (empty($allVar['ageEndDate']) && empty($allVar['ageStarDate']) && empty($allVar['genderId']) && empty($allVar['divisionId']) && empty($allVar['districtId']) && empty($allVar['upazilaId'])) {
            $count =  FishermenInfoStatsInfo::select('*')
                ->when(isset($allVar['religionId']), function ($query) use ($getReligion) {
                    $query->whereIn('religion', $getReligion);
                })
                ->when(isset($allVar['educationId']), function ($query) use ($getEducation) {
                    $query->whereIn('education', $getEducation);
                })
                ->when(isset($allVar['maritalStatusId']), function ($query) use ($getmaritalStatus) {
                    $query->whereIn('maritalStatus', $getmaritalStatus);
                })
                ->when(isset($allVar['yearlySavingId']), function ($query) use ($getyearlySaving) {
                    $query->whereIn('yearlySaving', $getyearlySaving);
                })
                ->when(isset($allVar['yearlyLoanId']), function ($query) use ($getyearlyLoan) {
                    $query->whereIn('yearlyLoan', $getyearlyLoan);
                })
                ->when(isset($allVar['deficiencyPeriodId']), function ($query) use ($getdeficiencyPeriod) {
                    $query->whereIn('dangerPeriodOfLiving', $getdeficiencyPeriod);
                })
                ->when(isset($allVar['annualIncomeStartId'], $allVar['annualIncomeEndId']), function ($query) use ($getannualIncomeStart, $getannualIncomeEnd) {
                    $query->where('annualIncome', '>=', $getannualIncomeStart)->where('annualIncome', '<=', $getannualIncomeEnd);
                })
                ->when(isset($allVar['fishingTimeId']), function ($query) use ($getfishingTime) {
                    $query->whereIn('timeOfFishing', $getfishingTime);
                })
                ->when(isset($allVar['placeOfFishingId']), function ($query) use ($getplaceOfFishing) {
                    $query->where(function ($q) use ($getplaceOfFishing) {
                        foreach ($getplaceOfFishing as $data) {
                            $q->orWhere('placeOfFishing', 'like', '%' . $data . '%');
                        }
                    });
                })
                ->when(isset($allVar['typesOfFishId']), function ($query) use ($gettypesOfFish) {
                    $query->where(function ($q) use ($gettypesOfFish) {
                        foreach ($gettypesOfFish as $data) {
                            $q->orWhere('typeOfFish', 'like', '%' . $data . '%');
                        }
                    });
                })
                ->when(isset($allVar['fishingEquipmentId']), function ($query) use ($getfishingEquipment) {
                    $query->where(function ($q) use ($getfishingEquipment) {
                        foreach ($getfishingEquipment as $data) {
                            $q->orWhere('toolsType', 'like', '%' . $data . '%');
                        }
                    });
                })
                ->when(isset($allVar['fishingTypeId']), function ($query) use ($getfishingType) {
                    $query->where(function ($q) use ($getfishingType) {
                        foreach ($getfishingType as $data) {
                            $q->orWhere('howToFishing', 'like', '%' . $data . '%');
                        }
                    });
                })
                ->when(isset($allVar['ownershipNetId']), function ($query) use ($getownershipNet) {
                    $query->where(function ($q) use ($getownershipNet) {
                        foreach ($getownershipNet as $data) {
                            $q->orWhere('ownerOfNet', 'like', '%' . $data . '%');
                        }
                    });
                })
                ->when(isset($allVar['typeOfVesselsId']), function ($query) use ($gettypeOfVessels) {
                    $query->where(function ($q) use ($gettypeOfVessels) {
                        foreach ($gettypeOfVessels as $data) {
                            $q->orWhere('typeOfVessels', 'like', '%' . $data . '%');
                        }
                    });
                })
                ->when(isset($allVar['ownerOfVesselsId']), function ($query) use ($getownerOfVessels) {
                    $query->where(function ($q) use ($getownerOfVessels) {
                        foreach ($getownerOfVessels as $data) {
                            $q->orWhere('ownerOfVessels', 'like', '%' . $data . '%');
                        }
                    });
                })
                ->when(isset($allVar['fishSalePlaceId']), function ($query) use ($getfishSalePlace) {
                    $query->where(function ($q) use ($getfishSalePlace) {
                        foreach ($getfishSalePlace as $data) {
                            $q->orWhere('salePlaceOfFish', 'like', '%' . $data . '%');
                        }
                    });
                })
                ->when(isset($allVar['priceOfVesselStartId'], $allVar['priceOfVesselEndId']), function ($query) use ($getpriceOfVesselStart, $getpriceOfVesselEnd) {
                    $query->where('priceOfVessels', '>=', $getpriceOfVesselStart)->where('priceOfVessels', '<=', $getpriceOfVesselEnd);
                })
                ->count();
        } else {
            $count = static::select('*')
                ->when(isset($allVar['divisionId']), function ($query) use ($newDivisionId) {
                    $query->where('divisionId', $newDivisionId);
                })
                ->when(isset($allVar['districtId']), function ($query) use ($newDistrictId) {
                    $query->where('districtId', $newDistrictId);
                })
                ->when(isset($allVar['upazilaId']), function ($query) use ($newUpazilaId) {
                    $query->where('upazilaId', $newUpazilaId);
                })
                ->when(isset($allVar['genderId']), function ($query) use ($getGender) {
                    $query->whereIn('gender', $getGender);
                })
                ->when(isset($allVar['ageStarDate'], $allVar['ageEndDate']), function ($query) use ($getAgeStarDate, $getAgeEndDate) {
                    $query->whereDate('dateOfBirth', '<=', $getAgeStarDate)->whereDate('dateOfBirth', '>=', $getAgeEndDate);
                })
                ->join('fishermen_info_stats_infos', 'fishermen_info_card_prints.id', '=', 'fishermen_info_stats_infos.dofId')
                ->when(isset($allVar['religionId']), function ($query) use ($getReligion) {
                    $query->whereIn('religion', $getReligion);
                })
                ->when(isset($allVar['educationId']), function ($query) use ($getEducation) {
                    $query->whereIn('education', $getEducation);
                })
                ->when(isset($allVar['maritalStatusId']), function ($query) use ($getmaritalStatus) {
                    $query->whereIn('maritalStatus', $getmaritalStatus);
                })
                ->when(isset($allVar['yearlySavingId']), function ($query) use ($getyearlySaving) {
                    $query->whereIn('yearlySaving', $getyearlySaving);
                })
                ->when(isset($allVar['yearlyLoanId']), function ($query) use ($getyearlyLoan) {
                    $query->whereIn('yearlyLoan', $getyearlyLoan);
                })
                ->when(isset($allVar['deficiencyPeriodId']), function ($query) use ($getdeficiencyPeriod) {
                    $query->whereIn('dangerPeriodOfLiving', $getdeficiencyPeriod);
                })
                ->when(isset($allVar['annualIncomeStartId'], $allVar['annualIncomeEndId']), function ($query) use ($getannualIncomeStart, $getannualIncomeEnd) {
                    $query->where('annualIncome', '>=', $getannualIncomeStart)->where('annualIncome', '<=', $getannualIncomeEnd);
                })
                ->when(isset($allVar['fishingTimeId']), function ($query) use ($getfishingTime) {
                    $query->whereIn('timeOfFishing', $getfishingTime);
                })
                ->when(isset($allVar['placeOfFishingId']), function ($query) use ($getplaceOfFishing) {
                    $query->where(function ($q) use ($getplaceOfFishing) {
                        foreach ($getplaceOfFishing as $data) {
                            $q->orWhere('placeOfFishing', 'like', '%' . $data . '%');
                        }
                    });
                })
                ->when(isset($allVar['typesOfFishId']), function ($query) use ($gettypesOfFish) {
                    $query->where(function ($q) use ($gettypesOfFish) {
                        foreach ($gettypesOfFish as $data) {
                            $q->orWhere('typeOfFish', 'like', '%' . $data . '%');
                        }
                    });
                })
                ->when(isset($allVar['fishingEquipmentId']), function ($query) use ($getfishingEquipment) {
                    $query->where(function ($q) use ($getfishingEquipment) {
                        foreach ($getfishingEquipment as $data) {
                            $q->orWhere('toolsType', 'like', '%' . $data . '%');
                        }
                    });
                })
                ->when(isset($allVar['fishingTypeId']), function ($query) use ($getfishingType) {
                    $query->where(function ($q) use ($getfishingType) {
                        foreach ($getfishingType as $data) {
                            $q->orWhere('howToFishing', 'like', '%' . $data . '%');
                        }
                    });
                })
                ->when(isset($allVar['ownershipNetId']), function ($query) use ($getownershipNet) {
                    $query->where(function ($q) use ($getownershipNet) {
                        foreach ($getownershipNet as $data) {
                            $q->orWhere('ownerOfNet', 'like', '%' . $data . '%');
                        }
                    });
                })
                ->when(isset($allVar['typeOfVesselsId']), function ($query) use ($gettypeOfVessels) {
                    $query->where(function ($q) use ($gettypeOfVessels) {
                        foreach ($gettypeOfVessels as $data) {
                            $q->orWhere('typeOfVessels', 'like', '%' . $data . '%');
                        }
                    });
                })
                ->when(isset($allVar['ownerOfVesselsId']), function ($query) use ($getownerOfVessels) {
                    $query->where(function ($q) use ($getownerOfVessels) {
                        foreach ($getownerOfVessels as $data) {
                            $q->orWhere('ownerOfVessels', 'like', '%' . $data . '%');
                        }
                    });
                })
                ->when(isset($allVar['fishSalePlaceId']), function ($query) use ($getfishSalePlace) {
                    $query->where(function ($q) use ($getfishSalePlace) {
                        foreach ($getfishSalePlace as $data) {
                            $q->orWhere('salePlaceOfFish', 'like', '%' . $data . '%');
                        }
                    });
                })
                ->when(isset($allVar['priceOfVesselStartId'], $allVar['priceOfVesselEndId']), function ($query) use ($getpriceOfVesselStart, $getpriceOfVesselEnd) {
                    $query->where('priceOfVessels', '>=', $getpriceOfVesselStart)->where('priceOfVessels', '<=', $getpriceOfVesselEnd);
                })
                ->count();
        }

        return $count;
    }

    public function fisherListbyArea($divisionId, $districtId, $upazilaId)
    {
        if (strlen($divisionId) > 1) {
            $newDivisionId = $divisionId;
        } else {
            $newDivisionId = '0' . $divisionId;
        }
        if (strlen($districtId) > 1) {
            $newDistrictId = $districtId;
        } else {
            $newDistrictId = '0' . $districtId;
        }
        if (strlen($upazilaId) > 1) {
            $newUpazilaId = $upazilaId;
        } else {
            $newUpazilaId = '0' . $upazilaId;
        }
        // $data = static::where('divisionId',10)->get();
        // return $data;
        if ($divisionId != "" && $districtId == "" && $upazilaId == "") {
            $data = static::where('divisionId', $newDivisionId)->get();
            return $data;
        }
        if ($divisionId != "" && $districtId != "" && $upazilaId == "") {
            $data = static::where('divisionId', $newDivisionId)
                ->where('districtId', $newDistrictId)
                ->get();
            return $data;
        }
        if ($divisionId != "" && $districtId != "" && $upazilaId != "") {
            $data = static::where('divisionId', $newDivisionId)
                ->where('districtId', $newDistrictId)
                ->where('upazilaId', $newUpazilaId)
                ->get();
            return $data;
        }
    }
}
