@extends('admin.layout.master')
@section('title', 'Tạo bài viết')
@section('body')
<form method="post" action="{{route('admin.cmscategory.store')}}">
    @csrf
    <div class="row mb-3">
        <div class="col-md-8"></div>
        <div class="col-md-4"><button type="submit" class="btn btn-success float-right">Lưu</button></div>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <!-- Default Card Example -->
            <!-- Basic Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Thông tin chung</h6>
                </div>
                <div class="card-body">
                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="MetaTitle">Tên danh mục (Tiếng Việt)</label>
                        <div class="col-md-12">
                            <input id="Name_vi" name="Name_vi" type="text" placeholder="Tên danh mục (tiếng Việt)" class="form-control input-md" required1="" value="{{$singleCategory->Name_vi}}">
                        </div>
                    </div>
                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="Slug_vi">Slug tiếng Việt</label>
                        <div class="col-md-12">
                            <input id="Slug_vi" name="Slug_vi" type="text" placeholder="Slug" class="form-control input-md" required1="" value="{{$singleCategory->Slug_vi}}">
                        </div>
                    </div>
                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="MetaTitle">Tên danh mục (tiếng Anh)</label>
                        <div class="col-md-12">
                            <input id="Name_en" name="Name_en" type="text" placeholder="Tên danh mục (tiếng Anh)" class="form-control input-md" required1="" value="{{$singleCategory->Name_en}}">
                        </div>
                    </div>
                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="Slug_en">Slug tiếng Anh</label>
                        <div class="col-md-12">
                            <input id="Slug_en" name="Slug_en" type="text" placeholder="Slug" class="form-control input-md" required1="" value="{{$singleCategory->Slug_en}}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <!-- Collapsable Card Example -->
            <!-- Dropdown Card Example -->
            <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#cmsCategory" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                    <h6 class="m-0 font-weight-bold text-primary">Danh mục cha</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="cmsCategory">
                    <div class="card-body">
                        <ul style="list-style: none">
                            <li><input type="radio" name="CategoryID" value="0" class="mr-2" >Danh mục cha</li>
                            <ul style="list-style: none">
                                @foreach ($categories as $category)
                                @include('admin.CmsCategory.rescusiveListUpdate', ['category' => $category])
                                @endforeach
                            </ul>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
@section('custom_css')
<link rel="stylesheet" type="text/css" href="https://unpkg.com/file-upload-with-preview@4.1.0/dist/file-upload-with-preview.min.css" />
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
@endsection
@section('custom_script')
<script src="https://unpkg.com/file-upload-with-preview@4.1.0/dist/file-upload-with-preview.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
<script src="{{asset('assets/vku/js/slug.js')}}"></script>
<script>
    $(document).ready(function() {
        $('#Name_vi').on('input', function() {
            console.log($('#Name_vi').val());
            $('#Slug_vi').val(ChangeToSlug($('#Name_vi').val()));
        });
    });

</script>
<script>
    $(document).ready(function() {
        $('#Name_en').on('input', function() {
            console.log($('#Name_en').val());
            $('#Slug_en').val(ChangeToSlug($('#Name_en').val()));
        });
    });

</script>
@endsection
