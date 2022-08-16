@extends('admin.admin')
@section('content')
<div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-600" id="exampleModalLabel2">Extra large modal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="mb-0">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its
                    layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to
                    using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web
                    page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web
                    sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on
                    purpose (injected humour and the like).</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success">Save changes</button>
            </div>
        </div>
    </div>
</div>

<div class="body-content">
<div class="card mb-4">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h6 class="fs-17 font-weight-600 mb-0">Base style</h6>
            </div>
            <div class="text-right">
                <div class="actions">
                    <a href="tables_data_styling.html#" class="action-item"><i class="ti-reload"></i></a>
                    <div class="dropdown action-item" data-toggle="dropdown">
                        <a href="tables_data_styling.html#" class="action-item"><i class="ti-more-alt"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="tables_data_styling.html#" class="dropdown-item">Refresh</a>
                            <a href="tables_data_styling.html#" class="dropdown-item">Manage Widgets</a>
                            <a href="tables_data_styling.html#" class="dropdown-item">Settings</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <livewire:fisher-man/>
    </div>
</div>
@endsection