<x-guest-layout>
    <div class="card card-bordered">
        <div class="card-inner card-inner-lg">
            <div class="nk-block-head">
                <div class="nk-block-head-content">
                    <h4 class="nk-block-title">Register</h4>
                    <div class="nk-block-des">
                        <p>Create New Dashlite Account</p>
                    </div>
                </div>
            </div>
            <form  method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group">
                    <label class="form-label" for="name">Name</label>
                    <div class="form-control-wrap">
                        <input type="text" class="form-control form-control-lg" id="name" name="name" placeholder="Enter your name" onclick="$(this).removeAttr('readonly');" onblur="$(this).attr('readonly', true);" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label" for="email">Email</label>
                    <div class="form-control-wrap">
                        <input type="text" class="form-control form-control-lg" id="email" name="email" placeholder="Enter your email address or username" onclick="$(this).removeAttr('readonly');" onblur="$(this).attr('readonly', true);" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label" for="password">Passcode</label>
                    <div class="form-control-wrap">
                        <a href="#" class="form-icon form-icon-right passcode-switch lg" data-target="password" >
                            <em class="passcode-icon icon-show icon ni ni-eye"></em>
                            <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                        </a>
                        <input type="password" class="form-control form-control-lg" id="password"  name="password" placeholder="Enter your passcode" onclick="$(this).removeAttr('readonly');" onblur="$(this).attr('readonly', true);" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label" for="password_confirmation">Passcode</label>
                    <div class="form-control-wrap">
                        <a href="#" class="form-icon form-icon-right passcode-switch lg" data-target="password_confirmation">
                            <em class="passcode-icon icon-show icon ni ni-eye"></em>
                            <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                        </a>
                        <input type="password" class="form-control form-control-lg" id="password_confirmation" name="password_confirmation" placeholder="Enter your passcode" onclick="$(this).removeAttr('readonly');" onblur="$(this).attr('readonly', true);" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <div class="custom-control custom-control-xs custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="checkbox">
                        <label class="custom-control-label" for="checkbox">I agree to Dashlite <a href="#">Privacy Policy</a> &amp; <a href="#"> Terms.</a></label>
                    </div>
                </div>
                <div class="form-group">
                    <button class="btn btn-lg btn-primary btn-block">Register</button>
                </div>
            </form>
            <div class="form-note-s2 text-center pt-4"> Already have an account? <a href="{{ route('login') }}"><strong>Sign in instead</strong></a>
            </div>
        </div>
    </div>
</x-guest-layout>
