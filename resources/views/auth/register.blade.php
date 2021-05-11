@extends('layouts.auth')
@section('tab_bar','Create Account')
@section('content')


<div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
      </div>
      <div class="content-body">
        <section class="flexbox-container">
          <div class="col-12 d-flex align-items-center justify-content-center">
            <div class="col-md-4 col-10 box-shadow-2 p-0">
              <div class="card border-grey border-lighten-3 px-2 py-2 m-0">
                <div class="card-header border-0">
                  <div class="card-title text-center">
                    <img src="../../../app-assets/images/logo/180_1.png" alt="Logo WMS">
                    <h2>Warehouse Management System</h2>
                    <h4>WMS</h4>
                  </div>
                  <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2">
                    <span>Create Account</span>
                  </h6>
                </div>
                <div class="card-content">
                  <div class="card-body">
                    <form class="form-horizontal form-simple" method="POST" action="{{ route('register') }}" novalidate>
                        @csrf

                      <fieldset class="form-group position-relative has-icon-left mb-1">
                        
                        <input id="name" type="text" placeholder="Usename" class="form-control form-control-lg input-lg @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        
                        {{-- <input type="text" class="form-control form-control-lg input-lg" id="user-name" placeholder="User Name"> --}}
                        <div class="form-control-position">
                          <i class="ft-user"></i>
                        </div>
                      </fieldset>

                      <fieldset class="form-group position-relative has-icon-left mb-1">
                        
                        <input id="email" type="email" placeholder="Your Email Address" class="form-control form-control-lg input-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        
                        {{-- <input type="email" class="form-control form-control-lg input-lg" id="user-email"
                        placeholder="Your Email Address" required> --}}
                        <div class="form-control-position">
                          <i class="ft-mail"></i>
                        </div>
                      </fieldset>

                      <fieldset class="form-group position-relative has-icon-left">
                        
                        <input id="password" type="password" placeholder="Enter Password" class="form-control form-control-lg input-lg @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        
                        {{-- <input type="password" class="form-control form-control-lg input-lg" id="user-password"
                        placeholder="Enter Password" required> --}}
                        <div class="form-control-position">
                          <i class="la la-key"></i>
                        </div>
                      </fieldset>

                      <fieldset class="form-group position-relative has-icon-left">
                        
                        <input id="password-confirm" type="password" placeholder="Confirm Password" class="form-control form-control-lg input-lg" name="password_confirmation" required autocomplete="new-password">                        
                        {{-- <input type="password" class="form-control form-control-lg input-lg" id="user-password"
                        placeholder="Enter Password" required> --}}
                        <div class="form-control-position">
                          <i class="la la-key"></i>
                        </div>
                      </fieldset>

                      <button type="submit" class="btn btn-info btn-lg btn-block"><i class="ft-unlock"></i> Register</button>
                    </form>
                  </div>
                  <p class="text-center">Already have an account ? <a href="{{ route('login') }}" class="card-link">Login</a></p>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>
@endsection
