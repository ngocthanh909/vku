@extends('user.layout.master')
@section('title', 'Duyệt tin')
@section('body')
<div class="row mb-3">
    <div class="col-12">
        <div class="default-block">
            <ul class="map">
                <li class="map-item icon"><i class="fas fa-home"></i>Trang chủ</li>
                <li class="map-item">Tags</li>
            </ul>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="default-block">
            <div class="title title-left-red  mb-3">
                Tags: {{$posts[0]->Name}}
            </div>
            <ul class="post_list">
            @foreach ($posts as $post)
                <li class="row post_list_item">
                    <div class="col-md-2">
                        <div class="post_list__time">{{$post->PostTime}}</div>
                    </div>
                    <div class="col-md-3"><img src="{{asset($post->Avatar)}}" class="img-fluid" /></div>
                    <div class="col-md-7">
                        <div class="post_list__title"><a href="{{route('postView', $post->Slug_vi)}}">{{$post->Title_vi}}</a></div>
                        <div class="post_list__description">{{$post->SimpleContent_vi}}</div>
                    </div>
                </li>
            @endforeach
            </ul>
            </ul>
            <div class="row">
                {{-- <div class="col-12 mx-auto">{{$posts->links()}}</div> --}}
            </div>
        </div>

    </div>
    {{-- <div class="col-md-3">
        <div class="default-block">
            <div class="title title-left-yellow  mb-3">
                Tin tin nổi bật
            </div>
            <ul class="newevent-container">
                @foreach($headnews as $key => $headnew)
                <li class="otherev-item">
                    <div class="otherev-img">
                        <img src="{{$headnew->Avatar}}" />
                    </div>
                    <div class="otherev-link"><a href="{{route('postView', ['slug' => $headnew->Slug_vi])}}">{{$headnew->Title_vi}}</a></div>
                </li>
                @endforeach
            </ul>
        </div>
    </div> --}}
</div>
@endsection
@section('custom_css')
<style type="text/css">
    .pagination {
        justify-content: center;
    }

</style>
@endsection
