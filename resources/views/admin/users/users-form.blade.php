@extends('layouts.adminlayout')

@section('content')

    <div class="nk-content p-0">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm mt-2">
                        <div class="row">
                            <div class="col-md-10">
                                <h3 class="nk-block-title page-title">{{ isset($currentuser) ? 'Edit User' : 'Add User' }}</h3>
                            </div>
                            <div class="nk-block-head-content text-right col-md-2">
                                <a href="{{ ADMIN_USERS_LIST }}" class="btn btn-primary">Back to Users</a>
                            </div>
                        </div>
                    </div>
                    <!-- .nk-block-head -->
                    <div class="nk-block">
                        @include('layouts.error')
                        <div class="row">
                            <div class="col-md-9">
                                <div class="card card-bordered">
                                    <div class="card-inner">
                                        {!! $form_elements !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card card-bordered">
                                    <div class="card-header">
                                        <h4>Details</h4>
                                    </div>
                                    <div class="card-inner">
                                        <ul>
                                            <li>Created: {{ isset($currentuser) ? format_date($currentuser->created_at) : '—' }}</li>
                                            <li>Updated: {{ isset($currentuser) ? format_date($currentuser->updated_at) : '—' }}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
