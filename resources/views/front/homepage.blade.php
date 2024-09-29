@extends('front.layouts.master')
@section('title','Anasayfa')

@section('content')

        <!-- Main Content-->
        
                <div class="col-md-10 col-lg-8 col-xl-7">
                    @foreach ($articles as $article)
                        {{$article->title}}
                    
                    <!-- Post preview-->
                    <div class="post-preview">
                        <a href="{{route('single',[$article->getCategory->slug,$article->slug])}}">
                            <h2 class="post-title">{{$article->title}}</h2>
                            <img src="{{$article->image}}" alt="">
                            <h3 class="post-subtitle">{!!\Illuminate\Support\Str::limit($article->content,75)!!}</h3>
                        </a>
                        <p class="post-meta">
                            Kategori :
                            <a href="#!">{{$article->getCategory->name}}</a>
                            
                            <span style="float: right; display:block;">{{$article->created_at->diffForHumans()}}</span>
                        </p>    
                    </div>
                    <!-- Divider-->
                    @if (!$loop->last)
                        <hr class="my-4" />
                    @endif
                    @endforeach
                    
                    
                    <!-- Pager-->
                    <div class="d-flex justify-content-end mb-4"><a class="btn btn-primary text-uppercase" href="#!">Older Posts →</a></div>
                </div>   
                @include('front.widgets.categoryWidget')
@endsection