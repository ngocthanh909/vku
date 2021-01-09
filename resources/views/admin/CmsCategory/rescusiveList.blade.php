<li>{{$category->Name_vi}}</li>
{{-- <li><input type="radio" name="CategoryID" value="{{$category->CategoryID}}" class="mr-2">{{$category->Name_vi}}</li> --}}
@isset($category->child)
<ol style="list-style: lower-latin">
    @foreach($category->child as $category)
    @include('admin.CmsCategory.rescusiveList', ['category' => $category])
    @endforeach
</ol>
@endisset
