@extends('admin.admin')
@section('content')
<!-- test line -->
<div class="body-content">
    <div class="card mb-4">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="fs-17 font-weight-600 mb-0">Fisher List by Topic</h6>
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
            <form>
                <div>
                    <h6 class="fs-17 font-weight-600 mb-0" style="text-align: center;">Area Information</h6><br>
                </div>
                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <label for="validationDefault03">Division</label>
                        <select class="form-control" id="divisionId" name="divisionId">
                            <option value="">------Select Division------</option>
                            @foreach ($divisions as $divisionList)
                            <option value="{{ $divisionList->divisionId }}">{{ $divisionList->divisionEng }}
                                                    ({{ $divisionList->divisionBng }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="validationDefault04">District</label>
                        <select class="form-control" name="districtId" id="districtId">
                            <option value="">------Select District------</option>
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="validationDefault05">Upazila</label>
                        <select class="form-control" name="upazilaId" id="upazilaId">
                            <option value="">------Select Upazila------</option>
                        </select>
                    </div>
                </div>
                <div>
                    <h6 class="fs-17 font-weight-600 mb-0" style="text-align: center;">Personal Information</h6><br>
                </div>
                <div class="form-row">
                    <div class="col-md-3 mb-3">
                        <label for="validationDefault03">Gender</label>
                        <select class="form-control" name="" id="">
                            <option value="">---Select gender---</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="validationDefault04">Religion</label>
                        <select class="form-control" name="" id="">
                            <option value="">---Select religion---</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="validationDefault05">Educational Qualification</label>
                        <select class="form-control" name="" id="">
                            <option value="">---Select Qualification---</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="validationDefault05">Marital Status</label>
                        <select class="form-control" name="" id="">
                            <option value="">---Select Status---</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="validationDefault05">From Age</label>
                        <input type="text" class="form-control" id="validationDefault01" placeholder="First name" value="Mark" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="validationDefault05">To Age</label>
                        <input type="text" class="form-control" id="validationDefault01" placeholder="First name" value="Mark" required>
                    </div>
                </div>
               
                <div>
                    <h6 class="fs-17 font-weight-600 mb-0" style="text-align: center;">Economic Information</h6><br>
                </div>
                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <label for="validationDefault05">Annual Saving</label>
                        <select class="form-control" name="" id="">
                            <option value="">---Select Status---</option>
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="validationDefault05">Annual Debt</label>
                        <select class="form-control" name="" id="">
                            <option value="">---Select Status---</option>
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="validationDefault05">Crisis of livelihood</label>
                        <select class="form-control" name="" id="">
                            <option value="">---Select Status---</option>
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="validationDefault05">Annual Income(From)</label>
                        <select class="form-control" name="" id="">
                            <option value="">---Select Status---</option>
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="validationDefault05">Annual Income(To)</label>
                        <select class="form-control" name="" id="">
                            <option value="">---Select Status---</option>
                        </select>
                    </div>
                </div>
                <div>
                    <h6 class="fs-17 font-weight-600 mb-0" style="text-align: center;">Professional Information</h6><br>
                </div>
                <div class="form-row">
                    <div class="col-md-3 mb-3">
                        <label for="validationDefault03">Fishing time</label>
                        <select class="form-control" name="" id="">
                            <option value="">---Select Status---</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="validationDefault04">Fishing grounds</label>
                        <select class="form-control" name="" id="">
                            <option value="">---Select Status---</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="validationDefault05">Types of fish caught</label>
                        <select class="form-control" name="" id="">
                            <option value="">---Select Status---</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="validationDefault05">Types of fishing equipment</label>
                        <select class="form-control" name="" id="">
                            <option value="">---Select Status---</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="validationDefault05">Net ownership(জালের মালিকানা)</label>
                        <select class="form-control" name="" id="">
                            <option value="">---Select Status---</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="validationDefault05">Types of vessels</label>
                        <select class="form-control" name="" id="">
                            <option value="">---Select Status---</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="validationDefault05">Ownership of the vessel</label>
                        <select class="form-control" name="" id="">
                            <option value="">---Select Status---</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="validationDefault05">Fish Market</label>
                        <select class="form-control" name="" id="">
                            <option value="">---Select Status---</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="validationDefault05">Vessel Price(From)</label>
                        <select class="form-control" name="" id="">
                            <option value="">---Select Status---</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="validationDefault05">Vessel Price(To)</label>
                        <select class="form-control" name="" id="">
                            <option value="">---Select Status---</option>
                        </select>
                    </div>
                </div>

                <button class="btn btn-success" type="submit">Submit form</button>
            </form>
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