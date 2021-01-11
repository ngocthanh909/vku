@extends('cse.layout.master')
@section('body')
<div class="page-parallax" style="background-image:url(http://overseas.mofa.go.kr/upload/se2/3f48f159-1c76-469e-b44c-877ee8a9d98c.jpg);">
    <div class="parallax-content">
        <h1>{{$index->Name_vi}}</h1>
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
            <h4 class="widget-title" style="font-size: 18px; font-weight: 600;"> TIN CHÍNH</h4>
            @foreach ($headnews as $headnew)
            <div class="postitem">
                <div class="row">
                    <div class="col-auto">
                        <div class="postmeta">
                            <div class="postdate">{{date('d',strtotime($headnew->PostTime))}}</div>
                            <div class="postmonth">{{date('M-Y',strtotime($headnew->PostTime))}}</div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="row">

                            <div class="col-4">
                                <img src="{{asset($headnew->Avatar)}}" style="width: 100%;">
                            </div>
                            <div class="col-8">
                                <div class="post-title">
                                    <a href="{{route('csePostView',['slug' => $headnew->Slug_vi])}}">{{$headnew->Title_vi}}</a>
                                </div>
                                <div class="post-category">
                                    <a href="{{route('csePostBrowse', $headnew->SlugCat_vi)}}">Chuyên mục: {{$headnew->Name_vi}}</a>
                                </div>
                                <div class="post-description-browse">
                                    {{$headnew->SimpleContent_vi}}
                                </div>

                            </div>

                        </div>


                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="col-md-4" style="padding: 20px; background-color: #fbfbfb;">
            <h4 class="widget-title" style="font-size: 18px; font-weight: 600;"> TIN TỨC KHÁC</h4>
            <p>________</p>
            <ul class="list-post">
                @foreach ($othernews as $othernew)
                <li>
                    <a href="">{{$othernew->Title_vi}}</a>
                    <br>
                    <small>{{date('d-m-Y',strtotime($othernew->PostTime))}}</small>
                </li>
                @endforeach

            </ul>

        </div>

    </div>
</div>
@endsection
