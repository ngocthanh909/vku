@extends('admin.layout.master')
@section('title', 'Trang chủ quản trị viên')
@section('body')
<div class="row">
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Danh sách tài khoản</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12 col-md-4">
                                <div class="dataTables_length" id="dataTable_length"><label>Show <select name="dataTable_length" aria-controls="dataTable" class="custom-select custom-select-sm form-control form-control-sm">
                                            <option value="10">10</option>
                                            <option value="25">25</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                        </select> entries</label>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4">
                                <div id="dataTable_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="dataTable"></label></div>
                            </div>
                            <div class="col-sm-12 col-md-4">
                                <a href="{{route('admin.cmscategory.create')}}" class="btn btn-success btn-icon-split float-right">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-plus"></i>
                                    </span>
                                    <span class="text">Tạo danh mục</span>
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                                    <thead>
                                        <tr role="row">
                                            <th class="sorting_asc" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 79px;">Tên người dùng</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 119px;">Ngày tạo tài khoản</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 57px;">Đơn vị</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending" style="width: 31px;">Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th class="sorting_asc" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 79px;">Tên người dùng</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 119px;">Ngày tạo tài khoản</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 57px;">Đơn vị</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending" style="width: 31px;">Thao tác</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>

                                        @foreach($users as $key => $user)
                                        <tr role="row" class="odd">
                                            <td class="sorting_1">{{$user->Username}}</td>
                                            <td>{{$user->RegisterTime}}</td>
                                            <td>{{$user->Name}}</td>
                                            <td>
                                                <a href="{{route('admin.user.edit', ['id' => $user->UserID])}}" class="btn btn-primary btn-circle btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="#confirmReset" class="btn btn-warning btn-circle btn-sm" data-toggle="modal" data-reset="{{route('admin.user.reset', ['id' => $user->UserID])}}">
                                                <i class="fas fa-redo-alt"></i></i>
                                                </a>
                                                <a href="#confirmDelete" class="btn btn-danger btn-circle btn-sm" data-toggle="modal" data-delete="{{route('admin.user.delete', ['id' => $user->UserID])}}">
                                                    <i class="fas fa-trash"></i>
                                                </a>


                                            </td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-5">
                                <div class="dataTables_info" id="dataTable_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div>
                            </div>
                            <div class="col-sm-12 col-md-7">
                                <div class="dataTables_paginate paging_simple_numbers" id="dataTable_paginate">
                                    {{$users->links()}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#cmsCategory" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                <h6 class="m-0 font-weight-bold text-primary">Tạo mới tài khoản</h6>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse show" id="cmsCategory">
                <div class="card-body">
                    <form action="{{route('admin.user.store')}}" method="post">
                    @csrf
                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="Title_en">Tên đăng nhập</label>
                            <div class="col">
                                <input id="Username" name="Username" type="text" placeholder="Tên nhập người dùng" class="form-control input-md" required1="">
                                <small>Mật khẩu mặc định là admin@123</small>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="Place">Đơn vị</label>
                            <div class="col-12">
                                @foreach ($departments as $key => $department)
                                <div class="checkbox">
                                    <label for="Place-{{$department->DepartmentID}}">
                                        <input type="radio" name="DepartmentID" id="Place-{{$department->DepartmentID}}" value="{{$department->DepartmentID}}"> {{$department->Name}}
                                    </label>
                                </div>

                                @endforeach
                            </div>
                        </div>
                        <!-- Button -->
                        <div class="form-group">
                            <div class="col-12">
                                <button type="submit" id="singlebutton" name="singlebutton" class="btn btn-primary">Tạo tài khoản mới</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal HTML -->
<!-- Modal HTML -->
<div id="confirmDelete" class="modal fade">
    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-header flex-column">
                <div class="icon-box">
                    <i class="material-icons">&#xE5CD;</i>
                </div>
                <h4 class="modal-title w-100">Mày chắc chưa</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <p>Xoá một cái là đéo recover được đâu con.</p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button id="confirm" class="btn btn-danger" onclick="">Delete</button>
            </div>
        </div>
    </div>
</div>

@endsection
@section('custom_script')
<script type="text/javascript">
    $('#confirmDelete').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var link = button.data('delete')
         // Extract info from data-* attributes
        var b = document.getElementById('confirm');
        b.setAttribute("onclick", "window.location.href='" + link + "'");
    })

</script>
@endsection
@section('custom_css')
<style>
    .modal-confirm {
        color: #636363;
        width: 400px;
    }

    .modal-confirm .modal-content {
        padding: 20px;
        border-radius: 5px;
        border: none;
        text-align: center;
        font-size: 14px;
    }

    .modal-confirm .modal-header {
        border-bottom: none;
        position: relative;
    }

    .modal-confirm h4 {
        text-align: center;
        font-size: 26px;
        margin: 30px 0 -10px;
    }

    .modal-confirm .close {
        position: absolute;
        top: -5px;
        right: -2px;
    }

    .modal-confirm .modal-body {
        color: #999;
    }

    .modal-confirm .modal-footer {
        border: none;
        text-align: center;
        border-radius: 5px;
        font-size: 13px;
        padding: 10px 15px 25px;
    }

    .modal-confirm .modal-footer a {
        color: #999;
    }

    .modal-confirm .icon-box {
        width: 80px;
        height: 80px;
        margin: 0 auto;
        border-radius: 50%;
        z-index: 9;
        text-align: center;
        border: 3px solid #f15e5e;
    }

    .modal-confirm .icon-box i {
        color: #f15e5e;
        font-size: 46px;
        display: inline-block;
        margin-top: 13px;
    }

    .modal-confirm .btn,
    .modal-confirm .btn:active {
        color: #fff;
        border-radius: 4px;
        background: #60c7c1;
        text-decoration: none;
        transition: all 0.4s;
        line-height: normal;
        min-width: 120px;
        border: none;
        min-height: 40px;
        border-radius: 3px;
        margin: 0 5px;
    }

    .modal-confirm .btn-secondary {
        background: #c1c1c1;
    }

    .modal-confirm .btn-secondary:hover,
    .modal-confirm .btn-secondary:focus {
        background: #a8a8a8;
    }

    .modal-confirm .btn-danger {
        background: #f15e5e;
    }

    .modal-confirm .btn-danger:hover,
    .modal-confirm .btn-danger:focus {
        background: #ee3535;
    }

    .trigger-btn {
        display: inline-block;
        margin: 100px auto;
    }

</style>
@endsection
