@extends('layouts.app')

@section('content')
    <div class="col-md-8 col-sm-12">
        <div class="card">
            <div class="card-body">
                Index
            </div>
        </div>
    </div>
@endsection

@section('sidebar')
    @parent
    <div class="col-4 d-none d-md-block">
        <div class="card">
            <div class="card-body">
                Sidebar
            </div>
        </div>
    </div>
@endsection
