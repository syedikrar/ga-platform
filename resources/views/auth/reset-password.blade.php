<x-guest-layout>
    <title>Reset Password</title>
    <div style="background: url({{ asset('images/dashboard/login-bg.png') }})no-repeat;" class="login-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 offset-lg-8 col-md-6 offset-md-3">
                    <div class="login-form">
                        <div class="login-form-logo">
                            <img src="{{ asset('images/dashboard/login-form-logo.png') }}" alt="">
                        </div>
                        <div class="tab-area">
                            <div class="tab-section">
                                <ul class="nav nav-tabs mt-n3">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#tabItem1">Reset password</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                   <div class="tab-pane active" id="tabItem1">
                                    <p class="text-center">Reset your password.</p>
                                    @if (session('status'))
                                    <div class="text-success text-center">
                                        {{ session('status') }}
                                    </div>
                                    @endif
                                    <x-jet-validation-errors />
                                    <div class="login-form-wrap">
                                        <form action="{{ route('password.update') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="token" value="{{ $request->route('token') }}">
                                            <div class="login-form-field">
                                                <input type="text" placeholder="Email" name='email' value="{{old('email', $request->email)}}" required autofocus>
                                                <img src="{{ asset('images/dashboard/login-user.png')}}" alt="">
                                            </div>
                                            <div class="login-form-field">
                                                <input type="password" placeholder="Password" name='password'  required autocomplete="new-password">
                                                <img src="{{ asset('images/dashboard/login-password.png')}}" alt="">
                                            </div>
                                            <div class="login-form-field">
                                                <input type="password" placeholder="Confirm Password" name="password_confirmation"  required autocomplete="new-password">
                                                <img src="{{ asset('images/dashboard/login-password.png')}}" alt="">
                                            </div>
                                            <div class="login-form-field">
                                                <button type="submit">Reset Password<i class="zmdi zmdi-arrow-right"></i> </button>
                                            </div>
                                            <div class="login-form-field">
                                                 <a href="{{ route('login') }}">Return to login</a>
                                            </div>
                                        </form>
                                       </div>
                                   </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>