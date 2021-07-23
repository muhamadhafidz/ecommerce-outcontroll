@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row my-5">
      <div>
        <a href="{{ route('user.home') }}"><h6><i class="fas fa-chevron-left"></i> Halaman Utama</h6></a>
      </div>
    </div>
    <div class="row mt-5">
      <div class="offset-3 col-6">
        <div class="card">
          <div class="card-body">
            <form method="POST" action="{{ route('login') }}">
              <h3>Daftar</h3>
              <div class="form-group mt-3">
                <label for="email">Alamat Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
  
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Kata Sandi</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
  
                                  @error('password')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
              </div>
              <button type="submit" class="btn">Submit</button>
            </form>
          </div>
          <div class="card-footer">
            Tidak punya akun? <a class="text-primary font-weight-bold" href="{{ route('register') }}"><u>Daftar</u> </a>
          </div>
        </div>
        
      </div>
    </div>
  </div>
@endsection
