@extends('layouts.app')

@section('content')
<div class="container" id="container">
  <div class="form-container sign-up-container">
    <form action="{{ route('user.register') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <h1>Create Account</h1>
      <div class="social-container">
      </div>
      <input type="email" placeholder="Email" name="email" required autocomplete="off"/>
      <input type="file" name="file" id="file"  required accept="application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint,
text/plain, application/pdf" />
      <button type="submit">Sign Up</button>
      <a href="#" id="signIn" class="ghost">Sudah punya akun ? Login</button>
    </form>
  </div>
  <div class="form-container sign-in-container">
    <form action="{{ route('login') }}" method="POST">
      @csrf
      <h1>Sign in</h1>
      <div class="social-container">
      </div>
      @error('email')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
      <input type="email" placeholder="Email" autocomplete="off" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus />
      @error('password')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
      <input type="password" placeholder="Password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="current-password" />
      <a href="#"> </a>
      <button type="submit">Sign In</button>
      <a href="#" id="signUp" class="ghost">Belum punya akun ? Registrasi</button>
    </form>
  </div>
  <div class="overlay-container">
    <div class="overlay">
      <div class="overlay-panel overlay-left">
        <img style="height: inherit; width:130%;" src="{{asset('assets/img/beranda.jpg')}}" alt="">
      </div>
      <div class="overlay-panel overlay-right">
        <img style="height: inherit; width:130%;" src="{{asset('assets/img/beranda.jpg')}}" alt="">
      </div>
    </div>
  </div>
</div>
@endsection