@extends('cse.layout.master')
@section('body')
<div class="page-parallax" style="background-image:url(http://overseas.mofa.go.kr/upload/se2/3f48f159-1c76-469e-b44c-877ee8a9d98c.jpg);">
    <div class="parallax-content">
        <h1>Tags: {{$posts[0]->Name}}</h1>
        <ul class="breadcrumb">
            <li><a href="{{route('cseIndex')}}">Trang chủ</a></li>
            <li><a href="{{url()->current()}}">Tags</a></li>
            <li>{{$posts[0]->Name}}</li>

        </ul>
    </div>
</div>
<div class="container" style="margin-top: 80px;">
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
                        <div class="post_list__title"><a href="{{route('csePostView', $post->Slug_vi)}}">{{$post->Title_vi}}</a></div>
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
</div>
@endsection
