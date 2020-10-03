@extends('front.layouts.master')
@section('title',$article->title)
@section('subHeader',$article->getCategory->name)
@section('bg',$article->image)

@show
@section('content')

<div class="col-md-9 mx-auto">
 {{$article->content}}
 <br>
 <br>
 <span class="text-danger">Okunma Sayısı: <b>{{$article->hit}}</b></span>
</div>
@include('front.widgets.categoryWidget')
@endsection