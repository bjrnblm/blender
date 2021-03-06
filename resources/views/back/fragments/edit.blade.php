@extends('back.layout.master')

@section('pageTitle', 'Wijzig vaste tekst')

@section('breadcrumbs', Breadcrumbs::render('fragmentDetail', $fragment))

@section('content')
<section>
    <div class="grid">
        <h1 class=":text-ellipsis">{{ $fragment->name }}</h1>

        @if( app()->getLocale() == 'nl')
        <div class="alerts">
            {!! HTML::info($fragment->description, '-small -inline'); !!}
        </div>
        @endif

        {!! Form::open(['method'=>'PATCH', 'action'=>['Back\FragmentController@update', $fragment->id] , 'class' =>'-stacked']) !!}
        @include('back.fragments._partials.form')
        {!! Form::close() !!}
    </div>
</section>
@stop
