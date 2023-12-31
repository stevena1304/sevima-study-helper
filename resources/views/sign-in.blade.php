@extends('layout.body2')
@section('title', 'Sign In')
@section('content')

<section id="sign-in" class="sign-in">
<div class="container">
    <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
            <div class="card mb-3">
              <div class="card-body">
                <div class="pt-4 pb-0">
                    <h5 class="text-left small pb-0 fs-6" style="margin-bottom: -35px;">Welcome Back! 👋</h5>
                </div>
                <div class="pt-4 pb-2">
                    {{-- <p class="text-center small">Welcome Back 👋</p> --}}
                    <h5 class="card-title text-left pb-3 fs-4">Sign in to your account</h5>
                </div>
                @if(count($errors)>0)
                  <div class="alert alert-danger">
                    <ul style="list-style-type: disc;">
                      @foreach($errors->all() as $item)
                        <li>
                          {{$item}}
                        </li>
                      @endforeach
                    </ul>
                  </div>
                @endif
                @if(session('salah'))
                  <div class="alert alert-danger">
                    {{session('salah')}}
                  </div>
                @endif
                <form class="row g-3 needs-validation" action="sign-in" method="POST">
                  @csrf
                  <div class="col-12">
                    <h5 for="yourUsername" class="form-label pb-0 fs-6">Your Email</h5>
                    <div class="input-group has-validation">
                      <!-- <span class="input-group-text" id="inputGroupPrepend">@</span> -->
                      <input type="text" name="email" class="form-control" id="yourEmail" required>
                      <div class="invalid-feedback">Please enter your Email.</div>
                    </div>
                  </div>

                  <div class="col-12">
                    <label for="yourPassword" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="yourPassword" required>
                    <div class="invalid-feedback">Please enter your Password!</div>
                  </div>

                  <div class="col-12">
                    <button class="btn btn-primary w-100" style="font-family: Nunito;" type="submit">CONTINUE</button>
                  </div>
                </form>

              </div>
            </div>

            <div class="button-signup">
              Don't have an account ? <a href="/sign-up">Sign Up</a>
            </div>

          </div>
        </div>
      </div>
    </section>
  </div>
</section>
@endsection