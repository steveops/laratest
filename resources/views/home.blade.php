@extends('layouts.master')

@section('content')
    <div class="row">
        <br>
        <br>
        <div class="col-sm-3">
            @include('repos.list')
        </div>
        <div class="col-sm-9 text-center">
            <h4>
                Click on a repository to view open issues
            </h4>
        </div>
    </div>
@endsection
