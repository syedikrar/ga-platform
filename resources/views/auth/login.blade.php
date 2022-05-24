<x-guest-layout>
    <title>Login</title>
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
                                        <a class="nav-link active" data-toggle="tab" href="#tabItem1">Sign In</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <x-jet-validation-errors />
                                   <div class="tab-pane active" id="tabItem1">
                                       <div class="login-form-wrap">
                                        <form action="{{ route('login') }}" method="POST">
                                            @csrf
                                            <div class="login-form-field">
                                                <input type="text" placeholder="Email" name='email'>
                                                <img src="{{ asset('images/dashboard/login-user.png')}}" alt="">
                                            </div>
                                            <div class="login-form-field">
                                                <input type="password" placeholder="Password" name='password'>
                                                <img src="{{ asset('images/dashboard/login-password.png')}}" alt="">
                                            </div>
                                           
                                            <div class="login-form-field">
                                                <button type="submit">SIGN IN <i class="zmdi zmdi-arrow-right"></i> </button>
                                            </div>
                                            <div class="login-form-field border-top pb-2">
                                                <div class="custom-control custom-control-sm custom-checkbox">
                                                    <input type="checkbox" name="remember" class="custom-control-input" id="checkbox">
                                                    <label class="custom-control-label"  for="checkbox">Remember me</label>
                                                </div>
                                                 <a href="{{ route('password.request') }}" class="forgot-password">Forgot password?</a>
                                            </div>
                                            <div class="login-form-field mt-4">
                                                {!! app('captcha')->display() !!}
                                            </div>
                                        </form>
                                       </div>
                                   </div>
                                        
                                    <div class="tab-pane" id="tabItem2">
                                        <div class="login-form-wrap">
                                            <form action="{{ route('login') }}" method="POST">
                                                @csrf
                                                <div class="login-form-field">
                                                    <input type="text" placeholder="Username" name="email">
                                                    <img src="{{ asset('images/dashboard/login-user.png')}}" alt="">
                                                </div>
                                                <div class="login-form-field">
                                                    <input type="password" placeholder="Password" name="password">
                                                    <img src="{{ asset('images/dashboard/login-password.png')}}" alt="">
                                                </div>
                                                <div class="login-form-field">
                                                    <button type="submit">SIGN IN <i class="zmdi zmdi-arrow-right"></i> </button>
                                                </div>
                                                <div class="login-form-field">
                                                     <a href="{{ route('password.request') }}">Forgot password?</a>
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
