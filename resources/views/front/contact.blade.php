@extends('front.layouts.master')
@section('title','İletişim')
@section('bg','https://as1.ftcdn.net/v2/jpg/05/02/57/66/1000_F_502576681_yQE74gzNza1EoE2cTeHRXQ6fGioaWirN.jpg')

@section('content')


        
<div class="col-md-8 ">
    @if(session('success'))
    <div class="alert alert-success">
        {{session('success')}}
    </div>
    @endif
    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <p>Bizimle İletişime Geçin!</p>
    <div class="my-5">
        
        <form method="post" action="{{Route('contact.post')}}">
            @csrf
            <div class="form-group">
                <label for="name">Ad Soyad</label>
                <input class="form-control" name="name" type="text" placeholder="Enter your name..." value="{{old('name')}}" required />
                
                <div class="invalid-feedback" data-sb-feedback="name:required">A name is required.</div>
            </div>
            <div class="form-group">
                <label for="email">Email address</label>
                <input class="form-control" name="email" value="{{old('email')}}" type="email" placeholder="Enter your email..." required/>
                
                <div class="invalid-feedback" data-sb-feedback="email:required">An email is required.</div>
                <div class="invalid-feedback" data-sb-feedback="email:email">Email is not valid.</div>
            </div>
            <div class="form-group">
                
                <label >Konu</label>
                <select class="form-select"  name="topic"  aria-label="Floating label select example" >
                    <option value="Bilgi" @if(old( 'Bilgi' )) selected @endif >Bilgi</option>
                    <option value="Destek" @if(old('Destek' )) selected @endif >Destek</option>
                    <option value="Genel" @if(old( 'Genel' )) selected @endif >Genel</option>
                </select>
                <div class="invalid-feedback" data-sb-feedback="konu:required">Konu Gerekli.</div>
            </div>
            <div class="form-group">
                <label for="message">Message</label>
                <textarea class="form-control" name="message" placeholder="Enter your message here..." style="height: 12rem" >{{old('message')}}</textarea>
                
                <div class="invalid-feedback" data-sb-feedback="message:required">Mesaj Gerekli.</div>
            </div>
            <br />
            <!-- Submit success message-->
            <!---->
            <!-- This is what your users will see when the form-->
            <!-- has successfully submitted-->
            <div class="d-none" id="submitSuccessMessage">
                <div class="text-center mb-3">
                    <div class="fw-bolder">Form submission successful!</div>
                    To activate this form, sign up at
                    <br />
                    <a href="https://startbootstrap.com/solution/contact-forms">https://startbootstrap.com/solution/contact-forms</a>
                </div>
            </div>
            <!-- Submit error message-->
            <!---->
            <!-- This is what your users will see when there is-->
            <!-- an error submitting the form-->
            <div class="d-none" id="submitErrorMessage"><div class="text-center text-danger mb-3">Error sending message!</div></div>
            <!-- Submit Button-->
            <button class="btn btn-primary text-uppercase " id="submitButton" type="submit">Gönder</button>
        </form>
    </div>
</div>
<div class="col-md-4">
    <div class="card card-default">
        <div class="card-body">
            Panel Content
        </div>
        Adres: İstanbul
    </div>
</div>


@endsection