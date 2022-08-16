<div>
@livewireStyles
@livewireScripts
<div class="card-body">
        <div class="row">
            <div class="col-2">
            <label for="exampleFormControlSelect1" class="font-weight-600">Per Page</label>
            <select wire:model="paginate" class="form-control" id="paginate" name="paginate" style="width: 35%;">
                <option>-Select-</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
            </select>
            </div>
            
            <div class="col-3">
            <label for="exampleFormControlSelect1" class="font-weight-600">Search</label>
                <input type="search" wire:model="search" id="searchTerm" class="form-control" placeholder="Mobile No, NID, Name...">
            </div>
            <div class="col-2">
                <label for="exampleFormControlSelect1" class="font-weight-600">Start Date</label>
                <input class="form-control" wire:model="startDate" type="date" name="startDate" value="" />
            </div>
            <div class="col-2">
                <label for="exampleFormControlSelect1" class="font-weight-600">End Date</label>
                <input class="form-control" wire:model="endDate" type="date" name="endDate" value="" />
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-3">
            <button type="button" wire:click="getPDF" class="btn btn-labeled btn-danger mb-2 mr-1">
                <span class="btn-label"><i class="fas fa-file-pdf"></i></span>Print PDF
            </button>
            
            <button type="button" wire:click="getExcel" class="btn btn-labeled btn-success mb-2 mr-1">
                <span class="btn-label"><i class="fas fa-file-excel"></i></span>Print Excel
            </button>
            </div>
        </div>
        <br>
   
        <div class="table-responsive">
            <table class="table display table-bordered table-striped table-hover base-style">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Date of Birth</th>
                        <th>Gender</th>
                        <th>NID</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead> 
                <tbody>
                    @foreach($getAllFishers as $key=>$value)
                    <tr>
                        <td>{{ $value->fishermanNameBng}}</td>
                        <td>{{ date("d-m-Y", strtotime($value->dateOfBirth)) }}</td>
                        <td>{{ $value->gender}}</td>
                        <td>{{ $value->nationalIdNo }}</td>
                        <td>{{ $value->statusId }}</td>
                        <td>
                            <button class="btn btn-info btn-circle mb-2 mr-1" type="button">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-danger btn-circle mb-2 mr-1" type="button">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                            <button class="btn btn-success btn-circle mb-2 mr-1" type="button">
                                <i class="fas fa-download"></i>
                            </button>
                            <button class="btn btn-purple btn-circle mb-2 mr-1" type="button" data-toggle="modal" data-target=".bd-example-modal-xl">
                                <i class="fas fa-eye"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $getAllFishers->links() }}
    </div>
</div>
