@extends('cse.layout.master')
@section('body')
<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="http://vku.udn.vn/slides/2021/thethao.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="http://vku.udn.vn/slides/2021/thethao.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="http://vku.udn.vn/slides/2021/thethao.jpg" class="d-block w-100" alt="...">
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>


<div class="heading text-center">
    <h2>CHÀO MỪNG NĂM MỚI - NĂM 2021</h2>
</div>
<div class="container mb-3" style="margin-top: 120px;">
    <img src="http://www.udn.vn/app/webroot/upload/images/Hinh%201_%20Tuyensinh2020.jpg" style="width: 100%;">
</div>

<div class="jumbotron">
    <div class="container">
        <div class="heading">
            <h2>TIN HỌC VỤ</h2>
        </div>
        <p>___</p>

        <div class="row scrollanimate">
            @foreach ($eduNews as $edunew)
            <div class="col-md-4">
                <div class="postitem">
                    <div class="row">
                        <div class="col-auto">
                            <div class="postmeta">
                                <div class="postdate">{{date('d',strtotime($edunew->PostTime))}}</div>
                                <div class="postmonth">{{date('m-Y',strtotime($edunew->PostTime))}}</div>
                            </div>
                        </div>
                        <div class="col">
                            <img src="{{asset($edunew->Avatar)}}" style="width: 100%;">
                            <div class="post-title">
                                <a href="{{route('csePostView', ['slug' => $edunew->Slug_vi])}}">{{$edunew->Title_vi}}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>


</div>

<div class="jumbotron" style="background: none;">
    <div class="container">
        <div class="heading">
            <h2>Hoạt động sinh viên</h2>
        </div>
        <p>___</p>

        <div class="row scrollanimate">
            @foreach ($stdActivities as $stdActivitie)
            <div class="col-md-4">
                <div class="postitem">
                    <div class="row">
                        <div class="col-auto">
                            <div class="postmeta">
                                <div class="postdate">{{date('d',strtotime($stdActivitie->PostTime))}}</div>
                                <div class="postmonth">{{date('m-Y',strtotime($stdActivitie->PostTime))}}</div>
                            </div>
                        </div>
                        <div class="col">
                            <img src="{{asset($stdActivitie->Avatar)}}" style="width: 100%;">
                            <div class="post-title">
                                <a href="{{route('csePostView', ['slug' => $stdActivitie->Slug_vi])}}">{{$stdActivitie->Title_vi}}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>


</div>
<div class="jumbotron text-center">
    <div class="container">
        <div class="heading">
            <h2>ĐỐI TÁC DOANH NGHIỆP</h2>
        </div>
        <p>Khoa Khoa học và Kỹ thuật Máy tính cám ơn các doanh nghiệp đã đồng hành với các hoạt động của sinh viên
        </p>
        <p>___</p>

    </div>
</div>
@endsection
