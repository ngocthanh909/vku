@extends('admin.layout.master')
@section('title', 'Gửi mail thông báo')
@section('body')
    <a href="{{ route('list_email') }}"><button class="btn btn-primary">Xem danh sách những người đăng kí nhận mail</button></a>
 
    @if(!empty($successNotify))
    <div class="alert alert-primary" role="alert">
        {!!$successNotify!!}
    </div>
    @endif
    @if(!empty($errorNotify))
    <div class="alert alert-danger" role="alert">
        {!!$errorNotify!!}
    </div>
    @endif

    <div class="container">
        <form action="{{ route('post_email') }}" method="post">
            @csrf
            <div class="form-group" style="margin-top : 20px">
                <div class="col">
                    <label for="emailtitle">Tiêu đề email: </label>
                    <input name="emailtitle" id="email-title" class="form-control">
                    <label for="emailcontent">Nội dung email: </label>
                    <textarea class="form-control" id="emailcontent" name="emailcontent"></textarea>
                    <script>
                        CKEDITOR.replace( 'emailcontent', {
                           filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
                           filebrowserUploadMethod: 'form'
                       })
                   </script>
                </div>
            </div>
            <button class="btn btn-danger" type="submit">Gửi</button>
        </form>




     
     
        </div>
    </div>


@endsection
