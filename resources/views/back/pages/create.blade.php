@extends('back.layouts.master')
@section('title','Sayfa Oluştur')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Sayfa Oluştur</h6>
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
        <form action="{{route('admin.page.create.post')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="">Sayfa Başlığı</label>
                <input type="text" name="title"  class="form-control" required>
            </div>
            
            <div class="form-group">
                <label for="">Sayfa Resmi</label>
                <input type="file" name="image"  class="form-control" required>
            </div>
            <div class="form-group">
                <label for="">Sayfa İçeriği</label>
                <textarea name="content" id="editor"  rows="4" class="form-control"></textarea>
                
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">Oluştur</button>
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
        placeholder: 'Sayfa İçeriği',
        tabsize: 2,
        height: 100
    });
</script>
@endsection