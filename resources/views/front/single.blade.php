@extends('front.layouts.master')
@section('title',$article->title)
@section('bg',$article->image)

@section('content')

        <!-- Main Content-->
        
        
                    <div class="col-md-9 col-xl-7">
                        {!!$article->content!!} <br><br><br><br><br><br><br>
                        <span class="text-danger ">Okunma Sayısı: <b>{{$article->hit}}</b></span>
                    </div>
                
        @include('front.widgets.categoryWidget')

@endsection