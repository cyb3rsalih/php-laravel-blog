@extends('front.layouts.master')
@section('title',"İletişim")
@section('bg',"http://isturkey.com/wp-content/uploads/2018/10/contact-us.jpg")

@show
@section('content')

    
<div class="col-lg-8 col-md-10 mx-auto">
  @if(session('success'))
  <div class="alert alert-success">
    {{session('success')}}
  </div>
  @endif


  <div class="col-lg-8 col-md-10 mx-auto">
    @if($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach($errors->all() as $error)
          <li>{{$error}}</li>
        @endforeach
      </ul>
    </div>
    @endif
    <p>Bizimle İletişime Geçmek İster Misiniz?</p>
    <!-- Contact Form - Enter your email address on line 19 of the mail/contact_me.php file to make this form work. -->
    <!-- WARNING: Some web hosts do not allow emails to be sent through forms to common mail hosts like Gmail or Yahoo. It's recommended that you use a private domain email address! -->
    <!-- To use the contact form, your site must be on a live web host with PHP! The form will not work locally! -->
<form method="POST" action="{{route('contact.post')}}">
   @csrf
      <div class="control-group">
        <div class="form-group controls">
          <label>Ad Soyad</label>
        <input type="text" class="form-control" value="{{old('name')}}" placeholder="Name" name="name" required >
        </div>
      </div>
      <div class="control-group">
        <div class="form-group controls">
          <label>Email Addresi</label>
          <input type="email" class="form-control" value="{{old('email')}}" placeholder="Email Address" name="email" required >
        </div>
      </div>

      <div class="control-group">
        <div class="form-group controls">
          <label>Konu</label>
            <select name="topic" class="name-control">
                <option @if(old('topic')=== "Bilgi") selected @endif value="Bilgi">Bilgi</option>
                <option @if(old('topic')=== "Destek") selected @endif value="Destek">Destek</option>
                <option @if(old('topic')=== "Genel  ") selected @endif value="Genel">Genel</option>
            </select>
        </div>
      </div>
      <div class="control-group">
        <div class="form-group controls">
          <label>Mesajınız</label>
          <textarea rows="5" class="form-control" placeholder="Message" name="message" required>{{old('message')}}</textarea>
        </div>
      </div>
      <br>
      <div id="success"></div>
      <button type="submit" class="btn btn-primary" id="sendMessageButton">Gönder</button>
    </form>
  </div>




@endsection

