@extends('back.layouts.master')
@section('title',"$article->title makalesini güncelle")
@section('content')
      <!-- DataTales Example -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold float-left text-primary"> @yield('title') </h6>
        </div>
        <div class="card-body">
          @if($errors->any())
          <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
          </div>
          @endif
        <form method="POST" action="{{route("admin.makaleler.update",$article->id)}}" enctype="multipart/form-data">
          @method('PUT')
          @csrf
            <div class="form-group">
              <label for="">Makale Başlığı</label>
              <input type="text" name="title" class="form-control" required value="{{$article->title}}" />
            </div>
            <div class="form-group"> 
              <label for="">Makale Kategori</label>
              <select name="category" class="form-control">
                <option value="">Seçim yapın</option>
                @foreach ($categories as $category)
                  <option @if($article->category_id == $category->id) selected @endif value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="">Makale Fotoğrafı</label><br/>
              <img src="{{asset($article->image)}}" class="img-thumbnail rounded" width="300"/>
            <input type="file" name="image" class="form-control" />
            </div>
            <div class="form-group">
              <label for="">Makale İçeriği</label>
            <textarea id="editor" name="content" class="form-control" rows="4">{!!$article->content!!}</textarea> 
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary btn-block">Makaleyi Güncelle</button>
            </div>
          </form>
        </div>
      </div> 
@endsection

@section('css')
  {{-- Summernote - Text Editor --}}
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection

@section('js')
  {{-- Summernote - Text Editor --}}
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#editor').summernote({
        'height':300
      });
    });
  </script>
@endsection
  