@if (count($articles)==0)
    <div class="alert alert-danger">
        <h1>Bu kategoriye ait yazı bulunamadı.</h1>
    </div>
@endif
@foreach ($articles as $article)
    
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
{{$articles->links('pagination::bootstrap-4')}}