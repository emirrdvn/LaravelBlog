@extends('back.layouts.master')
@section('title','Tüm Kategoriler')
@section('content')


<div class="row">
    <div class="col-md-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Yeni Kategori Oluştur</h6>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.category.create')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="">Kategori Adı</label>
                            <input type="text" class="form-control" name="category" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Ekle</button>
                    </form>
                </div>
            </div>
    </div>
</div>
<div class="row">
    <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Kategori Adı</th>
                                    <th>Makale Sayısı</th>
                                    <th>Durum</th>
                                    <th>İşlemler</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                @foreach($categories as $category)
                                <tr>
                                    
                                    <td>{{$category->name}}</td>
                                    <td>{{$category->articleCount()}}</td>
                                    <td>
                                        <input class="switch" category-id="{{$category->id}}" type="checkbox" @if($category->status==1) checked @endif data-offstyle="danger" data-onstyle="success" data-toggle="toggle" data-on="Aktif" data-off="Pasif" >
                                    </td>
                                    <td>
                                        
                                    </td>
                                </tr>
                                @endforeach
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    </div>
</div>
@endsection
@section('css')
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection
@section('js')
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script>
    $(function() {
        $('.switch').change(function() {
            id = $(this)[0].getAttribute('category-id');
            statu = $(this).prop('checked');
            $.get("{{route('admin.category.switch')}}", {
                id: id,
                statu: statu
            }, function(data, status) {});
        })
    })
</script>
@endsection