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
                                    <p class="text-center">If you forgot your password, well, then we’ll email you instructions to reset your password.</p>
                                    @if (session('status'))
                                    <div class="text-success text-center">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                
                                @if($errors->has('email'))
                                    <div class="text-success text-center">
                                        {{$errors->first('email')}}
                                    </div>
                                @endif
                                    <div class="login-form-wrap">
                                        <form action="{{ route('password.email') }}" method="POST">
                                            @csrf
                                            <div class="login-form-field">
                                                <input type="text" placeholder="Email" name='email'>
                                                <img src="{{ asset('images/dashboard/login-user.png')}}" alt="">
                                            </div>
                                           
                                            <div class="login-form-field">
                                                <button type="submit">Send Reset Link <i class="zmdi zmdi-arrow-right"></i> </button>
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
