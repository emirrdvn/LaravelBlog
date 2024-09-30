@extends('front.layouts.master')
@section('title',$page->title)
@section('bg',$page->image)

@section('content')

        <!-- Main Content-->
        
        
        <div class="col-md-10 col-lg-8 col-xl-7">
           {!! $page->content !!}
        </div>    
        @include('front.widgets.categoryWidget')

@endsection

       
       
       