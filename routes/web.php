<?php

use App\Http\Controllers\AccessRoute\AccessRouteController;
use App\Http\Controllers\Area\AreaController;
use App\Http\Controllers\Department\DepartmentController;
use App\Http\Controllers\Designation\DesignationController;
use App\Http\Controllers\FishermenInfo\FishermenInfoController;
use App\Http\Controllers\FishermenInfoCardPrint\FishermenInfoCardPrintController;
use App\Http\Controllers\FishermenInfoStatsInfo\FishermenInfoStatsInfoController;
use App\Http\Controllers\Fishers\FishersController;
use App\Http\Controllers\IdCard\IdCardController;
use App\Http\Controllers\Report\MasterReportController;
use App\Http\Controllers\RouteList\RouteListController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\UserType\UserTypeController;
use App\Http\Controllers\Report\SubjectReportController;
use App\Http\Controllers\StatisticalReport\StatisticalReportController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\FisherMan;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();
Route::get('/', function () {
    return view('frontend.index');
});
Route::get('/login', function () {
    return view('frontend.index');
})->name('login');


    // Route::group(['middleware' => ['role:admin']], function () {
    //     Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');   
    // });
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Route::get('/test1', [App\Http\Controllers\HomeController::class, 'test1'])->name('test1');
// user type

Route::get('/test2', [App\Http\Controllers\HomeController::class, 'test2'])->middleware('role:user')->name('test2');

Route::get('/user-type-list', [UserTypeController::class, 'userTypeList'])->name('userTypeList');
Route::post('/store-user-type', [UserTypeController::class, 'storeUserType'])->name('storeUserType');
Route::post('/update-user-type', [UserTypeController::class, 'updateUserType'])->name('updateUserType');
Route::get('delete-user-type/{id}',[UserTypeController::class,'deleteUserType'])->name('deleteUserType');
// fisher
Route::get('/fishers-list',[FishersController::class,'fishersList'])->name('fishersList');
Route::get('/create-fishers',[FishersController::class,'createFishers'])->name('createFishers');
Route::post('/store-fishers',[FishersController::class,'storeFishers'])->name('storeFishers');
Route::get('/view-fishers/{id}',[FishersController::class,'viewFishers'])->name('viewFishers');
Route::get('/edit-fishers/{id}',[FishersController::class,'editFishers'])->name('editFishers');
Route::post('/update-fishers',[FishersController::class,'updateFishers'])->name('updateFishers');
Route::get('/delete-fishers-list/{id}',[FishersController::class,'deleteFishersList'])->name('deleteFishersList');
Route::get('/get-fishers-age',[FishersController::class,'getFishersAge'])->name('getFishersAge');


Route::get('/get-fishers-basic-information',[FishersController::class,'getFishersBasicInformation'])->name('getFishersBasicInformation');
Route::post('/store-fishers-basic-information',[FishersController::class,'storeFishersBasicInformation'])->name('storeFishersBasicInformation');
Route::post('/store-fishers-address',[FishersController::class,'storeFishersAddress'])->name('storeFishersAddress');

Route::get('/users-role', [App\Http\Controllers\HomeController::class, 'usersRole'])->name('usersRole');

Route::get('/get-district-list',[UserController::class,'getDistrictList'])->name('getDistrictList');
Route::get('/get-upazila-list',[UserController::class,'getUpazilaList'])->name('getUpazilaList');
Route::get('/get-upazila-list-for-add',[UserController::class,'getUpazilaListForAdd'])->name('getUpazilaListForAdd');
Route::get('/get-municipality-and-union-list',[UserController::class,'getMunicipalityAndUnionList'])->name('getMunicipalityAndUnionList');
Route::get('/get-municipality-list-for-add',[UserController::class,'getMunicipalityListForAdd'])->name('getMunicipalityListForAdd');
Route::get('/get-union-list-for-add',[UserController::class,'getUnionListForAdd'])->name('getUnionListForAdd');
Route::get('/get-post-office-list-for-add',[UserController::class,'getPostOfficeListForAdd'])->name('getPostOfficeListForAdd');
Route::get('/get-ward-list',[UserController::class,'getWardList'])->name('getWardList');
Route::get('/get-ward-list-for-add',[UserController::class,'getWardListForAdd'])->name('getWardListForAdd');
Route::get('/get-village-list',[UserController::class,'getVillageList'])->name('getVillageList');
Route::get('/get-village-list-for-add',[UserController::class,'getVillageListForAdd'])->name('getVillageListForAdd');

Route::get('/get-present-district-list',[UserController::class,'getPresentDistrictList'])->name('getPresentDistrictList');
Route::get('/get-present-upazila-list',[UserController::class,'getPresentUpazilaList'])->name('getPresentUpazilaList');
Route::get('/get-present-municipality-and-union-list',[UserController::class,'getPresentMunicipalityAndUnionList'])->name('getPresentMunicipalityAndUnionList');
Route::get('/get-present-ward-list',[UserController::class,'getPresentWardList'])->name('getPresentWardList');
Route::get('/get-present-village-list',[UserController::class,'getPresentVillageList'])->name('getPresentVillageList');
Route::get('/get-user-data',[UserController::class,'getUserData'])->name('getUserData');

//Reports

Route::get('/get-fisher-master-report-pdf',[MasterReportController::class, 'getFishersMasterReportPdf'])->name('getFishersMasterReportPdf');
Route::get('/get-fishers-id-card-from-master-report',[MasterReportController::class, 'getFishersIdCardfromMasterReport'])->name('getFishersIdCardfromMasterReport');

Route::get('/get-fishers-report',[FishersController::class,'getFishersReport'])->name('getFishersReport');
Route::get('/get-district-wise-fishers', [FishersController::class, 'getDistrictWiseFishers'])->name('getDistrictWiseFishers');
Route::get('/getFishersInfo', [FishersController::class, 'getFishersInfo'])->name('getFishersInfo');
Route::get('/get-fisher-info-by-date', [FishermenInfoCardPrintController::class, 'getFishersInfobyDate'])->name('getFishersInfobyDate');

Route::get('/get-fisher-report-by-date', [FishermenInfoCardPrintController::class, 'getFishersReportbyDate'])->name('getFishersReportbyDate');
Route::get('/get-fisher-report-by-date-pdf', [FishermenInfoCardPrintController::class, 'getFisherReportbyDatePdf'])->name('getFisherReportbyDatePdf');
Route::get('/get-fisher-report-by-date-excel', [FishermenInfoCardPrintController::class, 'getFisherReportbyDateExcel'])->name('getFisherReportbyDateExcel');
Route::get('/get-fishers-info-by-topic',[FishermenInfoStatsInfoController::class, 'getFishersInfobyTopic'])->name('getFishersInfobyTopic');
Route::get('/get-report-by-topic', [FishermenInfoStatsInfoController::class, 'getReportbyTopic'])->name('getReportbyTopic');
// Route::get('/get-fisher-master-report', [FishermenInfoStatsInfoController::class, 'getFisherMasterReport'])->name('getFisherMasterReport');
Route::get('/view-details/{id}', [FishermenInfoCardPrintController::class, 'viewDetailsofFisher'])->name('viewDetailsofFisher');

Route::get('/get-fisherinfo-by-division-and-district', [FishermenInfoController::class,'getFiserInfobyDivisionandDistrict'])->name('getFiserInfobyDivisionandDistrict');
Route::get('/get-fisher-report-by-district-and-division', [FishermenInfoController::class,'getFisherReportbyDistrictandDivision'])->name('getFisherReportbyDistrictandDivision');
Route::get('/get-ajax-report-by-division-and-district',[FishermenInfoController::class,'getAjaxReportbyDivisionandDistrict'])->name('getAjaxReportbyDivisionandDistrict');
// Route::get('get-master-report-data',[FishermenInfoCardPrintController::class, 'getMasterReportData'])->name('getMasterReportData');
// Route::get('/get-master-report-data',[FishermenInfoCardPrintController::class, 'getMasterReportData'])->name('getMasterReportData');
Route::get('/get-fisher-id-card-by-birth-date-pdf',[FishermenInfoCardPrintController::class,'getFisherIdCardbyBirthDatePdf'])->name('getFisherIdCardbyBirthDatePdf');
Route::get('/duplicate-fishers-data', [FishermenInfoCardPrintController::class, 'duplicateFishersData'])->name('duplicateFishersData');
Route::get('/get-fisher-duplicate-data-pdf',[FishermenInfoCardPrintController::class, 'getFishersDuplicateDataPdf'])->name('getFishersDuplicateDataPdf');
Route::get('/get-nid-duplicate-data',[FishermenInfoCardPrintController::class, 'duplicateNidData'])->name('duplicateNidData');
Route::get('/get-nid-duplicate-data-pdf',[FishermenInfoCardPrintController::class, 'duplicateNidDataPdfPrint'])->name('duplicateNidDataPdfPrint');

// Department
Route::get('/department-list', [DepartmentController::class, 'departmentList'])->name('departmentList');
Route::post('/store-department', [DepartmentController::class, 'storeDepartment'])->name('storeDepartment');
Route::get('/edit-department/{id}', [DepartmentController::class, 'editDepartment'])->name('editDepartment');
Route::post('/update-department', [DepartmentController::class, 'updateDepartment'])->name('updateDepartment');
Route::get('delete-department/{id}',[DepartmentController::class,'deleteDepartment'])->name('deleteDepartment');
// Route::get('generate-pdf', [FishersController::class, 'generatePdf']);
// fishermen info cardprint
Route::get('/fishermen-info-list',[FishermenInfoCardPrintController::class,'getAllFishersInfo'])->name('getAllFishersInfo');
Route::get('/unapproved-fishermen-list',[FishermenInfoCardPrintController::class,'unapprovedFishermenList'])->name('unapprovedFishermenList');

Route::get('/create-fishermen-info-card-print',[FishermenInfoCardPrintController::class,'createFishermenInfoCardPrint'])->name('createFishermenInfoCardPrint');
Route::post('/store-fishermen-info-card-print',[FishermenInfoCardPrintController::class,'storeFishermenInfoCardPrint'])->name('storeFishermenInfoCardPrint');
Route::get('/view-fishermen-info-card-print/{id}',[FishermenInfoCardPrintController::class,'viewFishermenInfoCardPrint'])->name('viewFishermenInfoCardPrint');
Route::get('/edit-fishermen-info-card-print/{id}',[FishermenInfoCardPrintController::class,'editFishermenInfoCardPrint'])->name('editFishermenInfoCardPrint');
Route::post('/update-fishermen-info-card-print',[FishermenInfoCardPrintController::class,'updateFishermenInfoCardPrint'])->name('updateFishermenInfoCardPrint');
Route::get('/delete-fishermen-info-card-print-list/{id}',[FishermenInfoCardPrintController::class,'deleteFishermenInfoCardPrintList'])->name('deleteFishermenInfoCardPrintList');
Route::get('/get-fishermen-info-card-print-age',[FishermenInfoCardPrintController::class,'getFishermenInfoCardPrintAge'])->name('getFishermenInfoCardPrintAge');
// Designation
Route::get('/designation-list', [DesignationController::class, 'designationList'])->name('designationList');
Route::post('/store-designation', [DesignationController::class, 'storeDesignation'])->name('storeDesignation');
Route::get('/edit-designation/{id}', [DesignationController::class, 'editDesignation'])->name('editDesignation');
Route::post('/update-designation', [DesignationController::class, 'updateDesignation'])->name('updateDesignation');
Route::get('delete-designation/{id}',[DesignationController::class,'deleteDesignation'])->name('deleteDesignation');
// Designation
Route::get('/user-list', [UserController::class, 'userList'])->name('userList');
Route::get('/create-user-account-information', [UserController::class, 'createUserAccountInformation'])->name('createUserAccountInformation');
Route::post('/store-user-account-information', [UserController::class, 'storeUserAccountInformation'])->name('storeUserAccountInformation');

Route::get('/create-user-basic-information', [UserController::class, 'createUserBasicInformation'])->name('createUserBasicInformation');
Route::post('/store-user-basic-information', [UserController::class, 'storeUserBasicInformation'])->name('storeUserBasicInformation');  

Route::get('/edit-user/{id}', [UserController::class, 'editUser'])->name('editUser');
Route::post('/update-user', [UserController::class, 'updateUser'])->name('updateUser');
Route::get('/edit-single-user/{id}', [UserController::class, 'editSingleUser'])->name('editSingleUser');
Route::post('/update-single-user', [UserController::class, 'updateSingleUser'])->name('updateSingleUser');
Route::get('delete-user/{id}',[UserController::class,'deleteUser'])->name('deleteUser');

//test
Route::get('/test-data-yajra', [FishermenInfoCardPrintController::class,'testDatayajra'])->name('users.index');

// create fisher information
Route::get('/create-fishermen-personal-information',[FishermenInfoController::class,'createFishermenPersonalInformation'])->name('createFishermenPersonalInformation');
Route::post('/store-fishermen-personal-information',[FishermenInfoController::class,'storeFishermenPersonalInformation'])->name('storeFishermenPersonalInformation');

Route::get('/create-fishermen-family-information',[FishermenInfoController::class,'createFishermenFamilyInformation'])->name('createFishermenFamilyInformation');
Route::post('/store-fishermen-family-information',[FishermenInfoController::class,'storeFishermenFamilyInformation'])->name('storeFishermenFamilyInformation');

Route::get('/create-fishermen-address-information',[FishermenInfoController::class,'createFishermenAddressInformation'])->name('createFishermenAddressInformation');
Route::post('/store-fishermen-address-information',[FishermenInfoController::class,'storeFishermenAddressInformation'])->name('storeFishermenAddressInformation');

Route::get('/create-fishermen-fishing-information',[FishermenInfoController::class,'createFishermenFishingInformation'])->name('createFishermenFishingInformation');
Route::post('/store-fishermen-fishing-information',[FishermenInfoController::class,'storeFishermenFishingInformation'])->name('storeFishermenFishingInformation');

Route::get('/create-fishermen-basic-information',[FishermenInfoController::class,'createFishermenBasicInformation'])->name('createFishermenBasicInformation');
Route::post('/store-fishermen-basic-information',[FishermenInfoController::class,'storeFishermenBasicInformation'])->name('storeFishermenBasicInformation');

// fishers information
Route::get('/view-fisher-info/{id}',[FishermenInfoController::class,'viewFisherInfo'])->name('viewFisherInfo');
Route::get('/view-fisher-id-card/{id}',[FishermenInfoController::class,'viewFisherIdCard'])->name('viewFisherIdCard');
Route::get('/edit-fisher-info/{id}',[FishermenInfoController::class,'editFisherInfo'])->name('editFisherInfo');
Route::post('/update-fisher-info',[FishermenInfoController::class,'updateFisherInfo'])->name('updateFisherInfo');
Route::get('/mpdf-generate', [FishermenInfoCardPrintController::class,'mpdfGenerate']);
// route list
Route::get('/route-list', [RouteListController::class, 'routeList'])->name('routeList');
Route::post('/store-route', [RouteListController::class, 'storeRoute'])->name('storeRoute');
Route::post('/update-route', [RouteListController::class, 'updateRoute'])->name('updateRoute');
Route::get('delete-route/{id}',[RouteListController::class,'deleteRoute'])->name('deleteRoute');

Route::get('/access-route-list', [AccessRouteController::class, 'accessRoute'])->name('accessRoute');
Route::get('/create-route-access/{id}', [AccessRouteController::class, 'createRouteAccess'])->name('createRouteAccess');
Route::post('/store-route-access', [AccessRouteController::class, 'storeRouteAccess'])->name('storeRouteAccess');
Route::get('/edit-route-access/{id}', [AccessRouteController::class, 'editRouteAccess'])->name('editRouteAccess');
Route::post('/update-route-access', [AccessRouteController::class, 'updateRouteAccess'])->name('updateRouteAccess');
Route::get('delete-route-access/{id}',[AccessRouteController::class,'deleteRouteAccess'])->name('deleteRouteAccess');

// for subject wise report
Route::get('/subject-wise-report', [SubjectReportController::class, 'subjectWiseReport'])->name('subjectWiseReport');
Route::get('/get-subject-wise-report', [SubjectReportController::class, 'getSubjectWiseReport'])->name('getSubjectWiseReport');
Route::get('/get-subject-wise-report-two', [SubjectReportController::class, 'getSubjectWiseReportTwo'])->name('getSubjectWiseReportTwo');
// Id Card
Route::get('/id-card-list',[IdCardController::class,'idCardList'])->name('idCardList');
// for master report
Route::get('/get-fisher-master-report', [MasterReportController::class, 'getFisherMasterReport'])->name('getFisherMasterReport');
Route::post('/get-master-report-data',[MasterReportController::class, 'getMasterReportData'])->name('getMasterReportData');
Route::get('/get-master-report-data-list',[MasterReportController::class, 'getMasterReportDataList'])->name('getMasterReportDataList');
Route::get('/get-master-report-all-data-list',[MasterReportController::class, 'getMasterReportAllDataList'])->name('getMasterReportAllDataList');
Route::post('/get-master-report-data-by-parameter',[MasterReportController::class, 'getMasterReportDatabyParameter'])->name('getMasterReportDatabyParameter');

// division
Route::get('/division-list', [AreaController::class, 'divisionList'])->name('divisionList');
Route::post('/create-division', [AreaController::class, 'createDivision'])->name('createDivision');
Route::post('/update-division', [AreaController::class, 'updateDivision'])->name('updateDivision');
Route::get('/delete-division/{id}', [AreaController::class, 'deleteDivision'])->name('deleteDivision'); 
// district
Route::get('/district-list', [AreaController::class, 'districtList'])->name('districtList');
Route::post('/create-district', [AreaController::class, 'createDistrict'])->name('createDistrict');
Route::post('/update-district', [AreaController::class, 'updateDistrict'])->name('updateDistrict');
Route::get('/delete-district/{id}', [AreaController::class, 'deleteDistrict'])->name('deleteDistrict'); 
// upazila
Route::get('/upazila-list', [AreaController::class, 'upazilaList'])->name('upazilaList');
Route::get('/create-upazila', [AreaController::class, 'createUpazila'])->name('createUpazila');
Route::post('/store-upazila', [AreaController::class, 'storeUpazila'])->name('storeUpazila');
Route::get('/edit-upazila/{id}', [AreaController::class, 'editUpazila'])->name('editUpazila');
Route::post('/update-upazila', [AreaController::class, 'updateUpazila'])->name('updateUpazila');
Route::get('/delete-upazila/{id}', [AreaController::class, 'deleteUpazila'])->name('deleteUpazila'); 
// Municipality
Route::get('/municipality-list', [AreaController::class, 'municipalityList'])->name('municipalityList');
Route::get('/create-municipality', [AreaController::class, 'createMunicipality'])->name('createMunicipality');
Route::post('/store-municipality', [AreaController::class, 'storeMunicipality'])->name('storeMunicipality');
Route::get('/edit-municipality/{id}', [AreaController::class, 'editMunicipality'])->name('editMunicipality');
Route::post('/update-municipality', [AreaController::class, 'updateMunicipality'])->name('updateMunicipality');
Route::get('/delete-municipality/{id}', [AreaController::class, 'deleteMunicipality'])->name('deleteMunicipality'); 
// Ward
Route::get('/ward-list', [AreaController::class, 'wardList'])->name('wardList');
Route::get('/create-ward', [AreaController::class, 'createWard'])->name('createWard');
Route::post('/store-ward', [AreaController::class, 'storeWard'])->name('storeWard');
Route::get('/edit-ward/{id}', [AreaController::class, 'editWard'])->name('editWard');
Route::post('/update-ward', [AreaController::class, 'updateWard'])->name('updateWard');
Route::get('/delete-ward/{id}', [AreaController::class, 'deleteWard'])->name('deleteWard'); 
// Union
Route::get('/union-list', [AreaController::class, 'unionList'])->name('unionList');
Route::get('/create-union', [AreaController::class, 'createUnion'])->name('createUnion');
Route::post('/store-union', [AreaController::class, 'storeUnion'])->name('storeUnion');
Route::get('/edit-union/{id}', [AreaController::class, 'editUnion'])->name('editUnion');
Route::post('/update-union', [AreaController::class, 'updateUnion'])->name('updateUnion');
Route::get('/delete-union/{id}', [AreaController::class, 'deleteUnion'])->name('deleteUnion'); 
// Village
Route::get('/village-list', [AreaController::class, 'villageList'])->name('villageList');
Route::get('/create-village', [AreaController::class, 'createVillage'])->name('createVillage');
Route::post('/store-village', [AreaController::class, 'storeVillage'])->name('storeVillage');
Route::get('/edit-village/{id}', [AreaController::class, 'editVillage'])->name('editVillage');
Route::post('/update-village', [AreaController::class, 'updateVillage'])->name('updateVillage');
Route::get('/delete-village/{id}', [AreaController::class, 'deleteVillage'])->name('deleteVillage'); 
// postOffice
Route::get('/post-office-list', [AreaController::class, 'postOfficeList'])->name('postOfficeList');
Route::get('/create-post-office', [AreaController::class, 'createPostOffice'])->name('createPostOffice');
Route::post('/store-post-office', [AreaController::class, 'storePostOffice'])->name('storePostOffice');
Route::get('/edit-post-office/{id}', [AreaController::class, 'editPostOffice'])->name('editPostOffice');
Route::post('/update-post-office', [AreaController::class, 'updatePostOffice'])->name('updatePostOffice');
Route::get('/delete-post-office/{id}', [AreaController::class, 'deletePostOffice'])->name('deletePostOffice');

// Statistical Report
Route::get('/statistical-report', [StatisticalReportController::class, 'statisticalReport'])->name('statisticalReport');
// fisherman approved
Route::post('/approved-by-upazila-committee', [FishermenInfoCardPrintController::class, 'approvedByUpazilaCommittee'])->name('approvedByUpazilaCommittee');