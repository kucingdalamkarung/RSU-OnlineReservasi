@extends("layouts.admin_app")

@section("title")
Hello, {{ Auth::user()->username }}
@endsection

@section("content")
<div class="container">
    <img src="{{ url('image/rsmb.png') }}" alt="rsmb" style="width: 100%;">
</div>
@endsection
