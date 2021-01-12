<div class="container-fluid">
    <div id="row">
        <div class="col-12">
            <!--Carousel Wrapper-->
            <div id="carousel-example-2" class="carousel slide carousel-fade" data-ride="carousel">
                <!--Indicators-->
                <ol class="carousel-indicators">
                    @foreach($banners as $key => $banner)
                    <li data-target="#carousel-example-2" data-slide-to="{{$key}}" class="active"></li>
                    @endforeach
                </ol>
                <!--/.Indicators-->
                <!--Slides-->
                <div class="carousel-inner" role="listbox">
                    @foreach($banners as $key => $banner)
                    <div class="carousel-item @if($key == 0) active @endif">
                        <div class="view">
                            <img class="d-block w-100" src="{{asset($banner->Avatar)}}" alt="">
                            <div class="mask rgba-black-light"></div>
                        </div>
                        <div class="carousel-caption">
                            <a href="{{route('postView', ['slug' => $banner->Slug_vi])}}" style="font-size: 30px;
    font-weight: 500;
    color: white;
    text-shadow: 2px 2px 10px #606f7b;">
                                {{$banner->Title_vi}}
                            </a>
                            <p>{{$banner->SimpleContent_vi}}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
                <!--/.Slides-->
                <!--Controls-->
                <a class="carousel-control-prev" href="#carousel-example-2" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carousel-example-2" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
                <!--/.Controls-->
            </div>
            <!--/.Carousel Wrapper-->

        </div>
    </div>
</div>
