@extends('admin.layout.master')
@section('title', 'Trang chủ quản trị viên')
@section('body')

<div class="row">
    <div class="col-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#cmsCategory" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                <h6 class="m-0 font-weight-bold text-primary">Cập nhật tài khoản</h6>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse show" id="cmsCategory">
                <div class="card-body">
                    <form action="{{route('admin.user.update', ['id' => $user->UserID])}}" method="post">
                        @csrf
                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="Title_en">Tên đăng nhập</label>
                            <div class="col">
                                <input id="Username" name="Username" type="text" placeholder="Tên nhập người dùng" class="form-control input-md" required1="" value="{{$user->Username}}" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="Place">Đơn vị</label>
                            <div class="col-12">
                            
                                @foreach ($departments as $key => $department)
                                <div class="checkbox">
                                    <label for="Place-{{$department->DepartmentID}}">
                                        @if($user->DepartmentID == $department->DepartmentID)
                                        <input type="radio" name="DepartmentID" id="Place-{{$department->DepartmentID}}" value="{{$department->DepartmentID}}" checked> {{$department->Name}}
                                        @else
                                        <input type="radio" name="DepartmentID" id="Place-{{$department->DepartmentID}}" value="{{$department->DepartmentID}}"> {{$department->Name}}
                                        @endif

                                    </label>
                                </div>

                                @endforeach
                            </div>
                        </div>
                        <!-- Button -->
                        <div class="form-group">
                            <div class="col-12">
                                <button type="submit" id="singlebutton" name="singlebutton" class="btn btn-primary">Cập nhật tài khoản</button>
                                <a href="{{route('admin.user.reset', ['id' => $user->UserID])}}" id="singlebutton" name="singlebutton" class="btn btn-primary">Reset Password</a>
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
        var link = button.data('delete') // Extract info from data-* attributes
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
