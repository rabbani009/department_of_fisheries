<nav class="sidebar sidebar-bunker" id="non-printable">
    <div class="sidebar-header" style="padding: 24px 20px 0px 20px !important;text-align: center;">
        <!--<a href="index.html" class="logo"><span>bd</span>task</a>-->
        <a href="{{ route('home') }}" class="logo"><img src="{{ asset('admin') }}/assets/dist/img/logo.png"
                alt="" style="height: 50px !important;">
            <p style="color: #fff;
            font-size: 11px;
            letter-spacing: .6px;
            text-transform: uppercase;
            padding-top: 1px;">Department of Fisheries (DOF) </p>
        </a>
    </div>
    <!--/.sidebar header-->
    <div class="profile-element profile-element-2 d-flex align-items-center flex-shrink-0">
        <div class="avatar online">
            <img src="{{ asset('admin') }}/assets/dist/img/avatar-1.jpg" class="img-fluid rounded-circle" alt="">

        </div>
        <div class="profile-text">
            <h6 class="m-0">{{ Auth::user()->name }}</h6>
            <span><a href="{{ route('home') }}" style="color: #fff;">{{ Auth::user()->email }}</a></span>
        </div>
    </div>

    @php
        $routeAccessData = DB::table('user_types')
            ->where('id', Auth::user()->userTypeId)
            ->select('id', 'routeAccess')
            ->first();
        $routeList = DB::table('route_lists')
            ->orderBy('id', 'ASC')
            ->get();
        // return print_r($routeList[0]->routeName);
        $routeAccessId = explode(',', $routeAccessData->routeAccess ?? '');
    @endphp

    <div class="sidebar-body">
        <nav class="sidebar-nav">
            <ul class="metismenu">
                <li class="nav-label nav-label-2">Main Menu</li>
                <li class="{{ Route::is('home') ? 'mm-active' : '' }}"><a href="{{ route('home') }}">
                        <i class="typcn typcn-home-outline mr-2"></i>Dashboard</a></li>
                @if (in_array(1, $routeAccessId) || in_array(3, $routeAccessId) || in_array(4, $routeAccessId) || in_array(2, $routeAccessId) || in_array(5, $routeAccessId) || in_array(6, $routeAccessId))
                    <li class="nav-label nav-label-2">User Management</li>
                @endif
                @if (in_array(1, $routeAccessId))
                    <li
                        class="{{ Route::is('userList', 'createUserAccountInformation', 'createUserBasicInformation') ? 'mm-active' : '' }}">
                        <a href="{{ route('userList') }}">
                            <i class="typcn typcn-group-outline mr-2"></i>
                            {{ $routeList[0]->routeName }}
                        </a>
                    </li>
                @endif
                @if (in_array(3, $routeAccessId))
                    <li class="{{ Route::is('departmentList') ? 'mm-active' : '' }}">
                        <a href="{{ route('departmentList') }}">
                            <i class="typcn typcn-book mr-2"></i>
                            {{ $routeList[2]->routeName }}
                        </a>
                    </li>
                @endif
                @if (in_array(4, $routeAccessId))
                    <li class="{{ Route::is('designationList') ? 'mm-active' : '' }}">
                        <a href="{{ route('designationList') }}">
                            <i class="typcn typcn-briefcase mr-2"></i>
                            {{ $routeList[3]->routeName }}
                        </a>
                    </li>
                @endif
                @if (in_array(2, $routeAccessId))
                    <li class="{{ Route::is('userTypeList') ? 'mm-active' : '' }}">
                        <a href="{{ route('userTypeList') }}">
                            <i class="typcn typcn-user mr-2"></i>
                            {{ $routeList[1]->routeName }}
                        </a>
                    </li>
                @endif
                @if (in_array(5, $routeAccessId))
                    <li class="{{ Route::is('routeList') ? 'mm-active' : '' }}">
                        <a href="{{ route('routeList') }}">
                            <i class="typcn typcn-th-menu mr-2"></i>
                            {{ $routeList[4]->routeName }}
                        </a>
                    </li>
                @endif
                @if (in_array(6, $routeAccessId))
                    <li class="{{ Route::is('accessRoute') ? 'mm-active' : '' }}">
                        <a href="{{ route('accessRoute') }}">
                            <i class="typcn typcn-cog-outline mr-2"></i>
                            {{ $routeList[5]->routeName }}
                        </a>
                    </li>
                @endif
                @if (in_array(7, $routeAccessId) || in_array(8, $routeAccessId))
                    <li class="nav-label nav-label-2">Fishermen's information</li>
                @endif
                @if (in_array(7, $routeAccessId))
                    <li class="{{ Route::is('getAllFishersInfo') ? 'mm-active' : '' }}">
                        <a href="{{ route('getAllFishersInfo') }}">
                            <i class="typcn typcn-group mr-2"></i>
                            {{ $routeList[6]->routeName }}
                        </a>
                    </li>
                    @endif
                    <li class="{{ Route::is('unapprovedFishermenList') ? 'mm-active' : '' }}">
                        <a href="{{ route('unapprovedFishermenList') }}">
                            <i class="typcn typcn-group mr-2"></i>
                            Unapproved Fishermen List
                        </a>
                    </li>
                    {{-- <li class="{{ Route::is('idCardList') ? 'mm-active' : '' }}">
                        <a href="{{ route('idCardList') }}">
                            <i class="typcn typcn-business-card mr-2"></i>
                        Id Card List
                        </a>
                    </li> --}}
                    <li class="{{ Route::is('duplicateFishersData') ? 'mm-active' : '' }}">
                        <a href="{{ route('duplicateFishersData') }}">
                            <i class="typcn typcn-business-card mr-2"></i>
                            Duplicate FID List
                        </a>
                    </li>
                    <li class="{{ Route::is('duplicateNidData') ? 'mm-active' : '' }}">
                        <a href="{{ route('duplicateNidData') }}">
                            <i class="typcn typcn-business-card mr-2"></i>
                            Duplicate NID List
                        </a>
                    </li>
                @if (in_array(8, $routeAccessId))
                    <li
                        class="{{ Route::is('createFishermenPersonalInformation', 'createFishermenFamilyInformation') ? 'mm-active' : '' }}">
                        <a href="{{ route('createFishermenPersonalInformation') }}">
                            <i class="typcn typcn-user-add-outline mr-2"></i>
                            Add New Fisher <br>
                            Information
                        </a>
                    </li>
                @endif
                <li class="nav-label nav-label-2">Reports</li>
                @if (in_array(9, $routeAccessId))
                    <li class="{{ Route::is('subjectWiseReport') ? 'mm-active' : '' }}">
                        <a href="{{ route('subjectWiseReport') }}">
                            <i class="typcn typcn-clipboard mr-2"></i>
                            Subject Wise Report</a>
                    </li>
                    <li class="{{ Route::is('getFisherMasterReport') ? 'mm-active' : '' }}">
                        <a href="{{ route('getFisherMasterReport') }}">
                            <i class="typcn typcn-clipboard mr-2"></i>
                            Master Report
                        </a>
                    </li>
                    <li class="{{ Route::is('statisticalReport') ? 'mm-active' : '' }}">
                        <a href="{{ route('statisticalReport') }}">
                            <i class="typcn typcn-clipboard mr-2"></i>
                            Statistical Report
                        </a>
                    </li>
                    <!-- <li class="{{ Route::is('getDistrictWiseFishers') ? 'mm-active' : '' }}">
                            <a href="{{ route('getDistrictWiseFishers') }}">District Wise Fishers</a>
                        </li> -->
                    <!-- <li class="{{ Route::is('getFishersInfo') ? 'mm-active' : '' }}">
                            <a href="{{ route('getFishersInfo') }}">Fisher Report</a>
                        </li> -->
                    <li class="{{ Route::is('getFishersInfobyDate') ? 'mm-active' : '' }}">
                        <a href="{{ route('getFishersInfobyDate') }}">
                            <i class="typcn typcn-clipboard mr-2"></i>
                            Fisher Report by <br>Birth Date
                        </a>
                    </li>
                    {{-- <li class="{{ Route::is('getFishersInfobyTopic') ? 'mm-active' : '' }}">
                            <a href="{{ route('getFishersInfobyTopic') }}">Fisher Report by Topic</a>
                        </li>
                        <li class="{{ Route::is('getFisherMasterReport') ? 'mm-active' : '' }}">
                            <a href="{{ route('getFisherMasterReport') }}">Master Report</a>
                        </li> --}}
                    {{-- <li class="{{ Route::is('getFiserInfobyDivisionandDistrict') ? 'mm-active' : '' }}">
                        <a href="{{ route('getFiserInfobyDivisionandDistrict') }}">
                            <i class="typcn typcn-clipboard mr-2"></i>
                            Report by District <br>and
                            Division</a>
                    </li> --}}
                @endif
                <li class="nav-label nav-label-2">Area Control</li>
                    <li class="{{ Route::is('divisionList') ? 'mm-active' : '' }}">
                        <a href="{{ route('divisionList') }}">
                            <i class="typcn typcn-location-outline mr-2"></i>
                            Division</a>
                    </li>
                    <li class="{{ Route::is('districtList') ? 'mm-active' : '' }}">
                        <a href="{{ route('districtList') }}">
                            <i class="typcn typcn-location-outline mr-2"></i>
                            District</a>
                    </li>
                    <li class="{{ Route::is('upazilaList') ? 'mm-active' : '' }}">
                        <a href="{{ route('upazilaList') }}">
                            <i class="typcn typcn-location-outline mr-2"></i>
                            Upazila</a>
                    </li>
                    <li class="{{ Route::is('municipalityList') ? 'mm-active' : '' }}">
                        <a href="{{ route('municipalityList') }}">
                            <i class="typcn typcn-location-outline mr-2"></i>
                           Municipality</a>
                    </li>
                    <li class="{{ Route::is('wardList') ? 'mm-active' : '' }}">
                        <a href="{{ route('wardList') }}">
                            <i class="typcn typcn-location-outline mr-2"></i>
                           Ward</a>
                    </li>
                    <li class="{{ Route::is('unionList') ? 'mm-active' : '' }}">
                        <a href="{{ route('unionList') }}">
                            <i class="typcn typcn-location-outline mr-2"></i>
                           Union</a>
                    </li>
                    <li class="{{ Route::is('villageList') ? 'mm-active' : '' }}">
                        <a href="{{ route('villageList') }}">
                            <i class="typcn typcn-location-outline mr-2"></i>
                           Village</a>
                    </li>
                    <li class="{{ Route::is('postOfficeList') ? 'mm-active' : '' }}">
                        <a href="{{ route('postOfficeList') }}">
                            <i class="typcn typcn-location-outline mr-2"></i>
                            Postoffice</a>
                    </li>
               
            </ul>
        </nav>
    </div><!-- sidebar-body -->
</nav>
