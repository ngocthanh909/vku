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