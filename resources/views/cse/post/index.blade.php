@extends('cse.layout.master')
@section('body')
<div class="page-parallax" style="background-image:url({{asset($post->Avatar)}});">
    <div class="parallax-content">
        <h1>{{$post->Title_vi}}</h1>
        <ul class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li><a href="#">Pictures</a></li>
            <li><a href="#">Summer 15</a></li>
            <li>Italy</li>
        </ul>
    </div>
</div>
<div class="container" style="margin-top: 80px;">
    <div class="row">
        <div class="col-md-8" style="padding: 20px">
            <div class="row">
                <div class="col-auto">
                    <div class="postmeta">
                        <div class="postdate">{{date('d',strtotime($post->PostTime))}}</div>
                        <div class="postmonth">{{date('M-Y',strtotime($post->PostTime))}}</div>
                    </div>
                </div>
                <div class="col">
                    <div class="post-content">
                        <h4 class="post-title">{{$post->Title_vi}}</h4>
                        <div class="post-description">
                            @php
                                echo($post->Content_vi);
                            @endphp
                        </div>

                    </div>
                </div>
            </div>
        <div class="row">
            <div class="col-12">
                <ul class="tags-wrapper">
                    @foreach($tags as $key => $tag)
                        <li class="tags-item"><a href="{{route('cseTagsView', ['tag' => $tag->Name])}}">{{$tag->Name}}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
        </div>
        <div class="col-md-4" style="padding: 20px; background-color: #fbfbfb;">
            <h4 class="widget-title" style="font-size: 18px; font-weight: 600;"> BÀI VIẾT LIÊN QUAN</h4>
            <p>________</p>
            <ul class="list-post">
                @foreach ($relatives as $relative)
                    <li>
                    <a href="{{route('csePostView', ['slug' => $relative->Slug_vi])}}">{{$relative->Title_vi}}</a>
                    <br>
                    <small>{{date('d-m-y',strtotime($post->PostTime))}}</small>
                </li>
                @endforeach
            </ul>

        </div>

    </div>
</div>

@endsection
