@extends('admin.admin')
@section('content')
    <div style="margin: 20px 0px;">
        @include('flash::message')
    </div>
    <div class="content-header row align-items-center m-0">

        <div class="col-sm-8 header-title p-0">
            <div class="media">

                <div class="media-body">
                    {{-- <button class="btn btn-success md-trigger mb-2 mr-1" data-modal="modal-15">3D Rotate In Left</button> --}}
                    <h1 class="font-weight-bold">Add Fishers</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-4 text-right  p-0">
            <a href="{{ route('getAllFishersInfo') }}" class="btn btn-success mb-2 mr-1">
                <i class="typcn typcn-arrow-back mr-2"></i>Back</a>
        </div>
    </div>

    <div class="body-content">
        @livewireStyles
        @livewire('multi-step-form')
        @livewireScripts
    </div>
    @push('js')
        {{-- <script>
            $(document).ready(function() {
                $('#divisionId').on('change', function() {
                    // alert('ojdei');
                    $('#districtId').val('');
                    $('#upazilaId').val('');
                    $('#areaId').val('');
                    let value = $(this).children("option:selected").val();

                    $.get('{{ url('/') }}/get-district-list/' + value, function(response) {

                        $('#districtId').html(response);

                        // console.log("ok");
                        // console.log(response);
                    })


                });
                $('#districtId').on('change', function() {
                    $('#upazilaId').val('');
                    $('#areaId').val('');
                    let value = $(this).children("option:selected").val();

                    $.get('{{ url('/') }}/get-upazila-list/' + value, function(response) {

                        $('#upazilaId').html(response);
                        $('#areaId').html();
                        // console.log("ok");
                        // console.log(response);
                    })


                });
                $('#upazilaId').on('change', function() {
                    $('#areaId').val('');
                    let value = $(this).children("option:selected").val();

                    $.get('{{ url('/') }}/get-area-list/' + value, function(response) {

                        $('#areaId').html(response);
                        // console.log("ok");
                        // console.log(response);
                    })


                });
            });
        </script> --}}
    @endpush
@endsection
