@extends('admin.layout.master')
@section('title', 'Tạo bài viết')
@section('body')
<form method="post" action="{{route('admin.cms.update', ['id' => $cms->CmsID])}}" enctype="multipart/form-data">
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
                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="Title_en">Tiêu đề</label>
                            <div class="col">
                                <input id="Title_vi" name="Title_vi" type="text" placeholder="Tiêu đề" class="form-control input-md" required1="" value="{{$cms->Title_vi}}">
                            </div>
                        </div>
                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="Title_en">Tiêu đề (tiếng Anh)</label>
                            <div class="col">
                                <input id="Title_en" name="Title_en" type="text" placeholder="Tiêu đề (tiếng Anh)" class="form-control input-md" required1="" value="{{$cms->Title_en}}">
                            </div>
                        </div>
                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="SimpleContent_vi">Mô tả ngắn</label>
                            <div class="col">
                                <input id="SimpleContent_vi" name="SimpleContent_vi" type="text" placeholder="Mô tả" class="form-control input-md" required1="" value="{{$cms->SimpleContent_vi}}">
                            </div>
                        </div>
                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="SimpleContent_en">Mô tả ngắn (tiếng Anh)</label>
                            <div class="col">
                                <input id="SimpleContent_en" name="SimpleContent_en" type="text" placeholder="Mô tả" class="form-control input-md" required1="" value="{{$cms->SimpleContent_en}}">
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
            
                            <textarea class="form-control" id="Content_vi" name="Content_vi">{{htmlspecialchars_decode($cms->Content_vi)}}</textarea>
                        </div>
                        <script>
                            CKEDITOR.replace('Content_vi', {
                                filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}"
                                , filebrowserUploadMethod: 'form'
                            })

                        </script>
                    </div>
                    <!-- Textarea -->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="Content_en">Nội dung (tiếng Anh)</label>
                        <div class="col">
                            <textarea class="form-control" id="Content_en" name="Content_en">{{htmlspecialchars_decode($cms->Content_en)}}</textarea>
                        </div>
                        <script>
                            CKEDITOR.replace('Content_en', {
                                filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}"
                                , filebrowserUploadMethod: 'form'
                            })

                        </script>
                    </div>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tuỳ chọn đăng tải</h6>
                </div>
                <div class="card-body">
                    <!-- Textarea -->
                    <!-- Multiple Checkboxes -->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="Place">Đăng lên</label>
                        <div class="col-12">
                            @foreach ($departments as $key => $department)
                            <div class="checkbox">
                                <label for="Place-{{$department->DepartmentID}}">
                                    <input type="checkbox" name="Place[]" id="Place-{{$department->DepartmentID}}" value="{{$department->DepartmentID}}" @foreach($cms->Place as $key => $value)
                                    @if($department->DepartmentID == $value)
                                    checked
                                    @endif
                                    @endforeach
                                    > {{$department->Name}}
                                </label>
                            </div>

                            @endforeach
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="Place">Ghim bài viết</label>
                        <div class="col-12">
                            <div class="checkbox">
                                @if($cms->Pin)
                                <input type="radio" name="Pin" id="" value="1" checked="checked"> Pin
                                <input type="radio" name="Pin" id="" value="0"> Pin
                                @else
                                <input type="radio" name="Pin" id="" value="1"> Ghim
                                <input type="radio" name="Pin" id="" value="0"  checked="checked"> Bỏ ghim
                                @endif
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="Place">Banner</label>
                        <div class="col-12">
                            <div class="checkbox">
                                @if($cms->Pin)
                                <input type="radio" name="Banner" id="" value="1" checked="checked"> Đặt
                                <input type="radio" name="Banner" id="" value="0"> Không
                                @else
                                <input type="radio" name="Banner" id="" value="1"> Đặt
                                <input type="radio" name="Banner" id="" value="0"  checked="checked"> Không
                                @endif
                                </label>
                            </div>
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
                        <div class="custom-file-container" data-upload-id="myUniqueUploadId">
                            <label>Upload File
                                <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">&times;</a>
                            </label>
                            <label class="custom-file-container__custom-file">
                                <input type="file" class="custom-file-container__custom-file__custom-file-input" accept="image" aria-label="Choose File" name="Avatar" />
                                <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                <span class="custom-file-container__custom-file__custom-file-control"></span>
                            </label>
                            <div class="custom-file-container__image-preview"></div>
                        </div>
                        <fieldset>
                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="MetaTitle">Meta Tiitle</label>
                                <div class="col-md-12">
                                    <input id="MetaTitle" name="MetaTitle" type="text" placeholder="Meta Title" class="form-control input-md" required1="" value="{{$cms->MetaTitle}}">
                                </div>
                            </div>
                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="MetaKeyword">Meta Keyword</label>
                                <div class="col-md-12">
                                    <input id="MetaKeyword" name="MetaKeyword" type="text" placeholder="Meta Keyword" class="form-control input-md" required1="" value="{{$cms->MetaKeyword}}">
                                </div>
                            </div>

                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="MetaDescription">Meta Description</label>
                                <div class="col-md-12">
                                    <input id="MetaDescription" name="MetaDescription" type="text" placeholder="Meta Description" class="form-control input-md" required1="" value="{{$cms->MetaDescription}}">

                                </div>
                            </div>
                            <!-- Hashtag-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="MetaKeyword">Tags</label>
                                <div class="col-md-12">
                                    <input id="Tags" name="Tags" type="text" placeholder="Ví dụ: ozawa,mikami" class="form-control input-md" required1="" value="{{$cms->Tags}}">
                                    <small>Tag viết liền không dấu, phân tách bởi dấu phảy (,)</small>
                                </div>
                            </div>
                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="Slug_vi">Slug tiếng Việt</label>
                                <div class="col-md-12">
                                    <input id="Slug_vi" name="Slug_vi" type="text" placeholder="Slug" class="form-control input-md" required1="" value="{{$cms->Slug_vi}}">

                                </div>
                            </div>

                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="Slug_en">Slug tiếng Anh</label>
                                <div class="col-md-12">
                                    <input id="Slug_en" name="Slug_en" type="text" placeholder="Slug" class="form-control input-md" required1="" value="{{$cms->Slug_en}}">
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
@section('custom_css')
<link rel="stylesheet" type="text/css" href="https://unpkg.com/file-upload-with-preview@4.1.0/dist/file-upload-with-preview.min.css" />
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
@endsection
@section('custom_script')
<script src="https://unpkg.com/file-upload-with-preview@4.1.0/dist/file-upload-with-preview.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
<script>
    var upload = new FileUploadWithPreview("myUniqueUploadId");
    upload.cachedFileArray;

</script>
<script src="{{asset('assets/vku/js/slug.js')}}"></script>
<script>
    $(document).ready(function() {
        $('#Title_vi').on('input', function() {
            console.log($('#Title_vi').val());
            $('#Slug_vi').val(ChangeToSlug($('#Title_vi').val()));
        });
    });

</script>
<script>
    $(document).ready(function() {
        $('#Title_en').on('input', function() {
            console.log($('#Title_en').val());
            $('#Slug_en').val(ChangeToSlug($('#Title_en').val()));
        });
    });

</script>
@endsection
