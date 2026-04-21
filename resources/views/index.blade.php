@extends('auth.layout')

@section('content')

    <!-- content @s -->

    <body class="nk-body npc-crypto ui-clean pg-auth">

    <!-- app body @s -->
    <div class="nk-app-root">
        <div class="nk-main ">
            <div class="nk-wrap nk-wrap-nosidebar">
                <div class="nk-content ">
                    <div class="nk-block nk-block-middle nk-auth-body  wide-xs">
                        <div class="card">
                            <div class="card-inner card-inner-lg">
                                <div class="brand-logo pb-4 text-center">
                                    <a href="#" class="logo-link">
                                        {{--  <img class="logo-light logo-img logo-img-lg" src="{{ PUBLICFOLDER }}images/yw-logo.png" srcset="{{ PUBLICFOLDER }}images/yw-logo.png" alt="Your World Logo">--}}

                                        <img class="logo-dark logo-img logo-img-lg" src="{{ ALLOCATE_LOGO_LOGIN }}" srcset="{{ ALLOCATE_LOGO_LOGIN }}" alt="Your World Logo">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </body><!-- app body @e -->

    <!-- content @e -->

@endsection
