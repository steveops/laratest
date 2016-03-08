@extends('layouts.master')

@section('content')
    <div class="row">
        <br>
        <br>
        <div class="col-sm-3">
            @include('repos.list')
        </div>
        <div class="col-sm-9">
            @include('repos.issues')
        </div>
    </div>
@endsection
