@extends('user.layout.master')
@section('title', $post->Title_vi)
@section('description', $post->MetaDescription)
@section('keywords', $post->MetaKeyword)
@section('previewImage', $post->Avatar)
@section('body')
<div class="row mb-3">
    <div class="col-12">
        <div class="default-block">
            <ul class="map">
                <li class="map-item icon"><i class="fas fa-home"></i>Trang chủ</li>
                <li class="map-item">{{$post->Name_vi}}</li>
            </ul>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-9 pr-0">
        <div class="default-block">
            <div class="post-title title-left-red mb-3 p-3">
                {{$post->Title_vi}}
            </div>
            <div class="post-time">
                <i class="fas fa-calendar-week"></i> Ngày đăng: {{date('M-d-Y',strtotime($post->PostTime))}} <i class="fas fa-compass ml-3"></i> Danh mục: {{$post->Name_vi}}
            </div>
            <div class="post-time">
                <div class="fb-share-button" data-href="{{url()->current()}}" data-layout="button_count" data-size="small"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fvkudemo.tk%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Chia sẻ</a></div>
            </div>
            <div class="content">
                @php
                $abc = $post->Content_vi;
                echo(html_entity_decode($abc));
                @endphp
            </div>
            <div class="hashtag-wrapper">
                <ul class="hashtag-list">
                    @foreach($tags as $key => $tag)
                    <li class="hashtag-item"><a href="{{route('tagsView', ['tag' => $tag->Name])}}">{{$tag->Name}}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="row"><div class="col"><div class="fb-comments" data-href="{{url()->current()}}" data-width="auto" data-numposts="5"></div></div></div>
        </div>
    </div>
    <div class="col-md-3">
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
    </div>
</div>
@endsection
@section('custom_js')
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v9.0&appId=947748449088802&autoLogAppEvents=1" nonce="TOcaw6J4"></script>
@endsection
