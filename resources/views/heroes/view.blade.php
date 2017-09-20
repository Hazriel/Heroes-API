@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="nbd-section">
                <div class="nbd-section-header">
                    <h1>Your Heroes</h1>
                </div>
                <div class="nbd-section-body">
                    <p><a href="{{ route('heroes.createForm') }}"><button type="button" class="btn btn-success"><span class="glyphicon glyphicon-plus-sign"></span> Create a Hero</button></a></p>
                    <p>Token : {{ Auth::user()->game_token }}</p>
                    <p>Your heroes will be printed here.</p>
                </div>
            </div>
        </div>
    </div>
@endsection