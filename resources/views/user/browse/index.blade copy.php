@extends('user.layout.master')
@section('title', 'Duyệt tin')
@section('body')
<div class="row mb-3">
    <div class="col-12">
        <div class="default-block">
            <ul class="map">
                <li class="map-item icon"><i class="fas fa-home"></i>Trang chủ</li>
                <li class="map-item">{{$breadcrumb->Name_vi}}</li>
            </ul>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-9 pr-0">
        <div class="default-block">
            <div class="title title-left-red  mb-3">
                Tin mới
            </div>
            <ul class="newevent-container row mb-3">
                @foreach($allNews as $key => $allNew)
                <li class="newevent-item col-md-4" style="flex-direction: column; min-height: 420px; max-height: 600px">
                    <div class="newevent-picture-wrapper" style="width: 100%">
                        <div class="newevent-picture">
                            <img src="{{$allNew->Avatar}}" />
                            <span class="time-badge">{{date('M-d-Y',strtotime($allNew->PostTime))}}</span>
                        </div>
                    </div>
                    <div class="newevent-article" style="width: 100%;">
                        <div class="title-wrapper"><a class="title" href="{{route('postView', ['slug' => $allNew->Slug_vi])}}">{{$allNew->Title_vi}}</a></div>
                        <div class="description short-description">{{$allNew->SimpleContent_vi}}</div>
                    </div>
                </li>
                @endforeach
            </ul>
            <div class="row">
                <div class="col-12 mx-auto">{{$allNews->links()}}</div>
            </div>
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
@section('custom_css')
<style type="text/css">
    .pagination {
        justify-content: center;
    }

    .page-item.active .page-link {
        background-color: #d90905 !important;
        color: white;
    }

    .page-item a {
        color: red;
    }

</style>
@endsection
