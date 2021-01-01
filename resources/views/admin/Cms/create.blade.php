@extends('admin.layout.master')
@section('title', 'Tạo bài viết')
@section('body')
<form method="post" action="{{route('admin.cms.store')}}">
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
                <h6 class="m-0 font-weight-bold text-primary">Tiêu đề</h6>
            </div>
            <div class="card-body">
                <fieldset>
                    <!-- File Button -->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="Avatar">Ảnh đại diện</label>
                        <div class="col">
                            <input id="Avatar" name="Avatar" class="input-file" type="file">
                        </div>
                    </div>
                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="Title_en">Tiêu đề</label>
                        <div class="col">
                            <input id="Title_en" name="Title_vi" type="text" placeholder="Tiêu đề" class="form-control input-md" required="">

                        </div>
                    </div>
                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="Title_en">Tiêu đề (tiếng Anh)</label>
                        <div class="col">
                            <input id="Title_en" name="Title_en" type="text" placeholder="Tiêu đề (tiếng Anh)" class="form-control input-md" required="">
                        </div>
                    </div>
                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="SimpleContent_vi">Mô tả ngắn</label>
                        <div class="col">
                            <input id="SimpleContent_vi" name="SimpleContent_vi" type="text" placeholder="Mô tả" class="form-control input-md" required="">
                        </div>
                    </div>
                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="SimpleContent_en">Mô tả ngắn (tiếng Anh)</label>
                        <div class="col">
                            <input id="SimpleContent_en" name="SimpleContent_en" type="text" placeholder="Mô tả" class="form-control input-md" required="">
                        </div>
                    </div>
                    
                </fieldset>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Nội dung</h6>
            </div>
            <div class="card-body">
                <!-- Textarea -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="Content_vi">Nội dung</label>
                    <div class="col">
                        <textarea class="form-control" id="Content_vi" name="Content_vi">Nội dung</textarea>
                    </div>
                </div>
                <!-- Textarea -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="Content_en">Nội dung (tiếng Anh)</label>
                    <div class="col">
                        <textarea class="form-control" id="Content_en" name="Content_en">Nội dung</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <!-- Collapsable Card Example -->
        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#seo" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                <h6 class="m-0 font-weight-bold text-primary">SEO</h6>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse show" id="seo">
                <div class="card-body">
                    <fieldset>
                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="MetaTitle">Meta Tiitle</label>
                            <div class="col-md-12">
                                <input id="MetaTitle" name="MetaTitle" type="text" placeholder="Meta Title" class="form-control input-md" required="">
                            </div>
                        </div>
                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="MetaKeyword">Meta Keyword</label>
                            <div class="col-md-12">
                                <input id="MetaKeyword" name="MetaKeyword" type="text" placeholder="Meta Keyword" class="form-control input-md" required="">
                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="MetaDescription">Meta Description</label>
                            <div class="col-md-12">
                                <input id="MetaDescription" name="MetaDescription" type="text" placeholder="Meta Description" class="form-control input-md" required="">

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="Slug_vi">Slug tiếng Việt</label>
                            <div class="col-md-12">
                                <input id="Slug_vi" name="Slug_vi" type="text" placeholder="Slug" class="form-control input-md" required="">

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="Slug_en">Slug tiếng Anh</label>
                            <div class="col-md-12">
                                <input id="Slug_en" name="Slug_en" type="text" placeholder="Slug" class="form-control input-md" required="">
                            </div>
                        </div>

                    </fieldset>
                </div>
            </div>
        </div>
        <!-- Dropdown Card Example -->
        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#cmsCategory" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                <h6 class="m-0 font-weight-bold text-primary">Danh mục</h6>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse show" id="cmsCategory">
                <div class="card-body">
                    <ul style="list-style: none">
                        @foreach ($categories as $category)
                        @include('admin.CmsCategory.rescusive', ['category' => $category])
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
</form>
@endsection
