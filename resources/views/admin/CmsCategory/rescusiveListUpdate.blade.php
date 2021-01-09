@isset($singleCategory)
@if($category->CategoryID == $singleCategory->ParentID)
<li><input type="radio" name="CategoryID" value="{{$category->CategoryID}}" class="mr-2" checked>{{$category->Name_vi}}</li>
@else
<li><input type="radio" name="CategoryID" value="{{$category->CategoryID}}" class="mr-2">{{$category->Name_vi}}</li>
@endif
@endisset
{{-- <li><input type="radio" name="CategoryID" value="{{$category->CategoryID}}" class="mr-2">{{$category->Name_vi}}</li> --}}
@isset($category->child)
<ul style="list-style: none">
    @foreach($category->child as $category)
    @include('admin.CmsCategory.rescusiveListUpdate', ['category' => $category])
    @endforeach
</ul>
@endisset
