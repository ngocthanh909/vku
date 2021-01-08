@extends('user.layout.master')
@section('title', 'Trang chủ')
@section('body')
<div class="row">
    <div class="col-12">
        @include('user.Index.carousel')
    </div>
</div>
<div class="row">
    {{-- Tin tức sự kiện --}}
    <div class="col-md-5">
        <div class="default-block">
            <div class="title title-left-red mb-3">
                tin tức - sự kiện nổi bật
            </div>
            <ul class="newevent-container">
                @foreach($headnews as $key => $headnew)
                <li class="newevent-item">
                    <div class="newevent-picture-wrapper">
                        <div class="newevent-picture">
                            <img src="{{$headnew->Avatar}}"/>
                            <span class="time-badge">{{date('M-d-Y',strtotime($headnew->PostTime))}}</span>
                        </div>
                    </div>
                    <div class="newevent-article">
                        <div class="title-wrapper"><a class="title" href="#">{{$headnew->Title_vi}}</a></div>
                        <div class="description">{{$headnew->SimpleContent_vi}}</div>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
        <div class="default-block mt-3 mb-3">
            <div class="title title-left-red  mb-3">
                tin tức - sự kiện khác
            </div>
            <ul class="newevent-container">
                @foreach($othernews as $key => $othernew)
                <li class="otherev-item">
                    <div class="otherev-img">
                        <img src="{{$othernew->Avatar}}" />
                    </div>
                    <div class="otherev-link"><a href="#">{{$othernew->Title_vi}}</a></div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="col-md-4">
        <div class="default-block mb-3">
            <div class="title title-left-yellow  mb-3">
                thông báo
            </div>
            <ul class="newevent-container">
                @foreach($annous as $key => $annou)
                    <li class="annou-item">
                    <div class="annou-time">
                        <div class="dm">{{date('m-d',strtotime($annou->PostTime))}}</div>
                        <div class="y">{{date('Y',strtotime($annou->PostTime))}}</div>
                    </div>
                    <div class="annou-link"><a href="#">{{$annou->Title_vi}}</a></div>
                </li>
                @endforeach
            </ul>
        </div>

        <div class="default-block mt-3 mb-3">
            <div class="title title-left-yellow mb-3">
                social media
            </div>
            <div class="social-media">
                <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fvku.udn.vn&tabs=timeline&width=500&height=700&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId=947748449088802" width="500" height="700" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
            </div>
        </div>

    </div>
    <div class="col-md-3">
        <div class="default-block">
            <div class="title title-left-blue">
                đối tác
            </div>
            <div class="sponsor-wrapper">
                <ul id="demo">
                    <li>
                        <div class="sponsor-item">
                            <div class="sponsor-single">
                                <img src="http://vku.udn.vn/uploads/doitac/donga.jpg">
                            </div>
                            <div class="sponsor-single">
                                <img src="http://vku.udn.vn/uploads/doitac/donga.jpg">
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="sponsor-item">
                            <div class="sponsor-single">
                                <img src="http://vku.udn.vn/uploads/doitac/donga.jpg">
                            </div>
                            <div class="sponsor-single">
                                <img src="http://vku.udn.vn/uploads/doitac/donga.jpg">
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="sponsor-item">
                            <div class="sponsor-single">
                                <img src="http://vku.udn.vn/uploads/doitac/donga.jpg">
                            </div>
                            <div class="sponsor-single">
                                <img src="http://vku.udn.vn/uploads/doitac/donga.jpg">
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>

</div>
@endsection
@section('custom_js')
<script src="assets/vku/js/jquery.marquee.js"></script>
<script>
    $(function() {
        $('#demo').marquee({

            // enable the plugin
            enable: true, //plug-in is enabled

            // scroll direction
            // 'vertical' or 'horizontal'
            direction: 'vertical',

            // children items
            itemSelecter: 'li',

            // animation delay
            delay: 3000,

            // animation speed
            speed: 1,

            // animation timing
            timing: 1,

            // mouse hover to stop the scroller
            mouse: true

        });

    });

</script>
@endsection
@section('custom_css')
<style type="text/css">

</style>
@endsection
