@extends('layouts.auth')
@section('tab_bar', 'Login ')
@section('content')

<div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
      </div>
      <div class="content-body">
        <section class="flexbox-container">
          <div class="col-12 d-flex align-items-center justify-content-center">
            <div class="col-md-4 col-10 box-shadow-2 p-0">
              <div class="card border-grey border-lighten-3 m-0">
                <div class="card-header border-0">
                  <div class="card-title text-center">
                    <div class="p-1">
                      <img src="../../../app-assets/images/logo/180_1.png" alt="Logo WMS">
                      <h3>Warehouse Management System</h3>
                    </div>
                  </div>
                  <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2">
                    <span>{{ __('Login') }}</span>
                  </h6>
                </div>
                <div class="card-content">
                  <div class="card-body">
                    <form class="form-horizontal form-simple" method="POST" action="{{ route('login') }}" novalidate>
                        @csrf
                      <fieldset class="form-group position-relative has-icon-left mb-0">
                        {{-- <input type="text" class="form-control form-control-lg input-lg" id="user-name" placeholder="Your Username" required> --}}
                        <input id="email" class="form-control form-control-lg input-lg" type="email" placeholder="Your E-mail" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        
                        <div class="form-control-position">
                          <i class="ft-user"></i>
                        </div>
                      </fieldset>
                      <fieldset class="form-group position-relative has-icon-left">
                        {{-- <input type="password" class="form-control form-control-lg input-lg" id="user-password"
                        placeholder="Enter Password" required> --}}
                        <input id="password" class="form-control form-control-lg input-lg" type="password" placeholder="Enter Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                        
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <div class="form-control-position">
                          <i class="la la-key"></i>
                        </div>
                      </fieldset>
                      <div class="form-group row">
                        <div class="col-md-6 col-12 text-center text-md-left">
                          <fieldset>
                            {{-- <input type="checkbox" id="remember-me" class="chk-remember">
                            <label for="remember-me"> Remember Me</label> --}}

                            {{-- <input class="chk-remember" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> --}}

                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                          </fieldset>
                        </div>

                        {{-- <div class="col-md-6 col-12 text-center text-md-right"><a href="recover-password.html" class="card-link">Forgot Password?</a></div> --}}

                        {{-- @if (Route::has('password.request'))
                        <div class="col-md-6 col-12 text-center text-md-right"><a href="{{ route('password.request') }}" class="card-link">Forgot Password?</a></div> --}}

                            {{-- <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a> --}}
                        {{-- @endif --}}

                      </div>
                      {{-- <button type="submit" class="btn btn-info btn-lg btn-block"><i class="ft-unlock"></i> Login</button> --}}
                      
                        <button type="submit" class="btn btn-info btn-lg btn-block"><i class="ft-unlock"></i>
                        {{ __('Login') }}
                        </button>

                    </form>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="">
                    {{-- <p class="float-sm-left text-center m-0"><a href="recover-password.html" class="card-link">Recover password</a></p> --}}

                    {{-- @if (Route::has('password.request'))
                    <p class="float-sm-left text-center m-0"><a href="{{ route('password.request') }}" class="card-link">Recover Password?</a></p> --}}

                        {{-- <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a> --}}
                    {{-- @endif --}}

                    <p class="float-sm-right text-center m-0">New to WMS? <a href="{{ route('register') }}" class="card-link">Sign Up</a></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>
@endsection
