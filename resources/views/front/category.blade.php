@extends('front.layouts.master')
@section('title',$category->name." Kategorisi | Toplamda ".count($articles)." yazı var.")    
@section('content')

      <div class="col-lg-9 col-md-10 mx-auto">
        @include('front.widgets.articleList')
      </div>
    
   @include('front.widgets.categoryWidget')
@endsection