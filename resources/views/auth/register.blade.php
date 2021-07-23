@extends('user.layouts.default-auth')

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
                {{-- <div class="card-header">{{ __('Register') }}</div> --}}

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <h3>Buat Akun</h3>
                        <div class="form-group mt-3">
                            <label for="name" class="">{{ __('Nama Lengkap') }}</label>

                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email" class="">{{ __('Alamat Email') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password" class="">{{ __('Kata Sandi') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="">{{ __('Ulangi Kata Sandi') }}</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn ">
                                    {{ __('Daftar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
