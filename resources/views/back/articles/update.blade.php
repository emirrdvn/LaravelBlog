@extends('back.layouts.master')
@section('title',$article->title.' Makalesini Güncelle')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Makale Oluştur</h6>
    </div>
    <div class="card-body">
        @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form action="{{route('admin.makaleler.update',$article->id)}}" method="post" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="">Makale Başlığı</label>
                <input type="text" name="title" value="{{$article->title}}" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="">Makale Kategori</label>
                <select name="category"  class="form-control" required>
                    @foreach($categories as $category)
                    <option @if($article->category==$category->id) selected @endif value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                    
                </select>
            </div>
            <div class="form-group">
                <label for="">Makale Resmi</label><br>
                <img src="{{asset($article->image)}}" width="200" alt="" class="rounded img-thumbnail">
                <input type="file" name="image"  class="form-control" required>
            </div>
            <div class="form-group">
                <label for="">Makale İçeriği</label>
                <textarea name="content" id="editor"   rows="4" class="form-control">{!!$article->content!!}</textarea>
                
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">Güncelle</button>
            </div>
        </form>
    </div>
</div>
@endsection
@section('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.css" rel="stylesheet">
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.js"></script>
<script>
    $('#editor').summernote({
        placeholder: 'Makale İçeriği',
        tabsize: 2,
        height: 100
    });
</script>
@endsection