@extends('auth.layout')

@section('content')

<body class="nk-body npc-crypto ui-clean pg-auth">

<div class="nk-app-root">
    <div class="nk-main">
        <div class="nk-wrap nk-wrap-nosidebar">
            <div class="nk-content">
                <div class="nk-block nk-block-middle nk-auth-body wide-xs">
                    <div class="card">
                        <div class="card-inner card-inner-lg">

                            <div class="brand-logo pb-4 text-center">
                                <a href="#" class="logo-link">
                                    <img class="logo-dark logo-img logo-img-lg" src="{{ ALLOCATE_LOGO_LOGIN }}" srcset="{{ ALLOCATE_LOGO_LOGIN }}" alt="Logo">
                                </a>
                            </div>

                            <div class="nk-block-head text-center mb-3">
                                <h4 class="nk-block-title">Sign In</h4>
                            </div>

                            @if ($errors->any())
                                <div class="alert alert-danger mb-3">
                                    {{ $errors->first() }}
                                </div>
                            @endif

                            @if (session('flash_message_success'))
                                <div class="alert alert-success mb-3">
                                    {{ session('flash_message_success') }}
                                </div>
                            @endif

                            <form action="{{ route('admin.login.post') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <div class="form-label-group">
                                        <label class="form-label" for="email">Email</label>
                                    </div>
                                    <div class="form-control-wrap">
                                        <input type="email" class="form-control form-control-lg" id="email" name="email" value="{{ old('email') }}" placeholder="Enter your email address" required autofocus>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-label-group">
                                        <label class="form-label" for="password">Password</label>
                                    </div>
                                    <div class="form-control-wrap">
                                        <a href="#" class="form-icon form-icon-right passcode-switch lg" data-target="password">
                                            <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                            <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                        </a>
                                        <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Enter your password" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>

@endsection
