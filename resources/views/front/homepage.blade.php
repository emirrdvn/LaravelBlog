@extends('front.layouts.master')
@section('title','Anasayfa')

@section('content')
    <!-- Main Content-->
    <div class="col-md-10 col-lg-8 col-xl-7">                    
    @include('front.widgets.articleList')
    </div>   
    @include('front.widgets.categoryWidget')
@endsection