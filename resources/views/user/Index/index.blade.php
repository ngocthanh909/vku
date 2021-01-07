@extends('user.layout.master')
@section('title', 'Trang chủ')
@section('body')
<div class="row">
    {{-- Tin tức sự kiện --}}
    <div class="col-md-5">
        <div class="default-block">
            <div class="title title-left-red mb-3">
                tin tức - sự kiện nổi bật
            </div>
            <ul class="newevent-container">
                <li class="newevent-item">
                    <div class="newevent-picture-wrapper">
                        <div class="newevent-picture">
                            <img src="http://vku.udn.vn/uploads/2021/01/03/1609683523_1.jpg" />
                            <span class="time-badge">12/1</span>
                        </div>
                    </div>
                    <div class="newevent-article">
                        <div class="title-wrapper"><a class="title" href="#">VKU: 01 năm thành lập - 10 thành quả nổi bật (03/01/2020-03/01/2021)</a></div>
                        <div class="description">Qua 01 năm hoạt động của Trường Đại học Công nghệ Thông tin và Truyền thông Việt - Hàn, Đại học Đà Nẵng (03/01/2020-03/01/2021), hãy cùng điểm qua 10 thành quả nổi bật của VKU (03/01/2020-03/01/2021)</div>
                    </div>
                </li>
                <li class="newevent-item">
                    <div class="newevent-picture-wrapper">
                        <div class="newevent-picture">
                            <img src="http://vku.udn.vn/uploads/2021/01/03/1609683523_1.jpg" />
                            <span class="time-badge">12/1</span>
                        </div>
                    </div>
                    <div class="newevent-article">
                        <div class="title-wrapper"><a class="title" href="#">VKU: 01 năm thành lập - 10 thành quả nổi bật (03/01/2020-03/01/2021)</a></div>
                        <div class="description">Qua 01 năm hoạt động của Trường Đại học Công nghệ Thông tin và Truyền thông Việt - Hàn, Đại học Đà Nẵng (03/01/2020-03/01/2021), hãy cùng điểm qua 10 thành quả nổi bật của VKU (03/01/2020-03/01/2021)</div>
                    </div>
                </li>
                <li class="newevent-item">
                    <div class="newevent-picture-wrapper">
                        <div class="newevent-picture">
                            <img src="http://vku.udn.vn/uploads/2021/01/03/1609683523_1.jpg" />
                            <span class="time-badge">12/1</span>
                        </div>
                    </div>
                    <div class="newevent-article">
                        <div class="title-wrapper"><a class="title" href="#">VKU: 01 năm thành lập - 10 thành quả nổi bật (03/01/2020-03/01/2021)</a></div>
                        <div class="description">Qua 01 năm hoạt động của Trường Đại học Công nghệ Thông tin và Truyền thông Việt - Hàn, Đại học Đà Nẵng (03/01/2020-03/01/2021), hãy cùng điểm qua 10 thành quả nổi bật của VKU (03/01/2020-03/01/2021)</div>
                    </div>
                </li>
            </ul>
        </div>
        <div class="default-block mt-3 mb-3">
            <div class="title title-left-blue  mb-3">
                tin tức - sự kiện khác
            </div>
            <ul class="newevent-container">
                <li class="otherev-item">
                    <div class="otherev-img">
                        <img src="http://vku.udn.vn/uploads/2021/01/03/1609683523_1.jpg" />
                    </div>
                    <div class="otherev-link"><a href="#">VKU: 01 NĂM THÀNH LẬP - 10 THÀNH QUẢ NỔI BẬT (03/01/2020-03/01/2021)</a></div>
                </li>
                <li class="otherev-item">
                    <div class="otherev-img">
                        <img src="http://vku.udn.vn/uploads/2021/01/03/1609683523_1.jpg" />
                    </div>
                    <div class="otherev-link"><a href="#">VKU: 01 NĂM THÀNH LẬP - 10 THÀNH QUẢ NỔI BẬT (03/01/2020-03/01/2021)</a></div>
                </li>
                <li class="otherev-item">
                    <div class="otherev-img">
                        <img src="http://vku.udn.vn/uploads/2021/01/03/1609683523_1.jpg" />
                    </div>
                    <div class="otherev-link"><a href="#">VKU: 01 NĂM THÀNH LẬP - 10 THÀNH QUẢ NỔI BẬT (03/01/2020-03/01/2021)</a></div>
                </li>
            </ul>
        </div>
    </div>
    <div class="col-md-4">
        <div class="default-block mb-3">
            <div class="title title-left-blue  mb-3">
                thông báo
            </div>
            <ul class="newevent-container">
                <li class="annou-item">
                    <div class="annou-time">
                        <div class="dm">13/12</div>
                        <div class="y">2020</div>
                    </div>
                    <div class="annou-link"><a href="#">VKU: 01 NĂM THÀNH LẬP - 10 THÀNH QUẢ NỔI BẬT (03/01/2020-03/01/2021)</a></div>
                </li>
                <li class="annou-item">
                    <div class="annou-time">
                        <div class="dm">13/12</div>
                        <div class="y">2020</div>
                    </div>
                    <div class="annou-link"><a href="#">VKU: 01 NĂM THÀNH LẬP - 10 THÀNH QUẢ NỔI BẬT (03/01/2020-03/01/2021)</a></div>
                </li>
                <li class="annou-item">
                    <div class="annou-time">
                        <div class="dm">13/12</div>
                        <div class="y">2020</div>
                    </div>
                    <div class="annou-link"><a href="#">VKU: 01 NĂM THÀNH LẬP - 10 THÀNH QUẢ NỔI BẬT (03/01/2020-03/01/2021)</a></div>
                </li>
            </ul>
        </div>

        <div class="default-block mt-3">
            <div class="title title-left-blue mb-3">
                social media
            </div>
            <div class="social-media">
                <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fvku.udn.vn&tabs=timeline&width=500&height=700&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId=947748449088802" width="500" height="700" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
            </div>
        </div>

    </div>
    <div class="col-md-3">
        <div class="default-block">
            <div class="title title-left-yellow">
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
{{$sub}}