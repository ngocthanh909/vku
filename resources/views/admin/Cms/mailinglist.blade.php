@extends('admin.layout.master')
@section('title', 'Danh sách đăng kí nhận email')
@section('body')
<h2>Danh sách đăng kí nhận tin</h2>
<table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Email</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($mailList as $index => $mailUser)
        <tr>
            <th scope="row">{{$index+1}}</th>
            <td>{{$mailUser->email}}</td>
        </tr>
        @endforeach
    </tbody>
</table>



@endsection
