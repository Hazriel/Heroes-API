@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="nbd-section">
                <div class="nbd-section-header">
                    <h1>Your Heroes</h1>
                </div>
                <div class="nbd-section-body">
                    <p>
                        <a href="{{ route('heroes.createForm') }}"><button type="button" class="btn btn-success"><span class="glyphicon glyphicon-plus-sign"></span> Create a Hero</button></a>
                        <a href="{{ route('heroes.abilities') }}"><button type="button" class="btn btn-info"><span class="glyphicon glyphicon-refresh"></span> Refresh your Abilities</button></a>
                    </p>
                    <p>Token : {{ Auth::user()->game_token }}</p>
                    <div class="row">
                        <div class="col-sm-8">
                            <ul>
                                @foreach(Auth::user()->heroes as $hero)
                                    <div class="col-lg-10 hero">
                                        <div class="hero-image image-{{ $hero->getTeam() }}">
                                        <span class="image-{{ $hero->getClass() }}"
                                              style="background-image: url({{ asset('/images/herocreator/icon_'.$hero->getTeam().'_classes.png') }});">
                                        </span>
                                        </div>
                                        <div class="hero-content">
                                            <span class="name">{{ $hero->heroName }}</span>
                                            <div class="info">
                                                <div class="info-content col-lg-11">
                                                    <div class="col-lg-4 col-xs-4 hero-team team-{{ $hero->getTeam() }}"><span class="hero-info">{{ $hero->getTeam() }}</span></div>
                                                    <div class="col-lg-4 col-xs-4 hero-class class-{{ $hero->getClass() }}"><span class="hero-info">{{ $hero->getClass() }}</span></div>
                                                    <div class="col-lg-4 col-xs-4 hero-level level-{{ (int) $hero->getStat('level') }}"><span class="hero-info">level</span></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection