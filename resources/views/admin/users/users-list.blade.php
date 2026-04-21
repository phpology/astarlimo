@extends('layouts.adminlayout')

@section('content')

    <div class="nk-content p-0">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm mt-2">
                        <div class="row">
                            <div class="col-md-10">
                                <h3 class="nk-block-title page-title">Users</h3>
                            </div>
                            <div class="nk-block-head-content text-right col-md-2">
                                 <a href="{{ ADMIN_USERS_ADD }}" class="btn btn-primary">Add Users</a>
                            </div>
                        </div>
                    </div>

                    <!-- .nk-block-head -->
                    <div class="nk-block">
                        @include('layouts.error')
                        <div class="card card-bordered">
                            <div class="card-inner p-0">
                                <div class="table-responsive">
                                    <table id="tablesorter" class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th class="filter-select filter-onlyAvail">Role</th>
                                            <th class="filter-select filter-onlyAvail">Status</th>
                                            <th class="filter-false">&nbsp;</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php $x=1; @endphp
                                        @foreach($usersarray as $curuser)
                                            <tr>
                                                <td>{{$curuser->name}}</td>
                                                <td>{{$curuser->email}}</td>
                                                <td class="text-center">{{$curuser->role}}</td>
                                                <td class="text-center">{{ status_name($curuser->status) }}</td>
                                                <td class="text-center">

                                                    <a href="{{ ADMIN_USERS_EDIT.$curuser->id }}" class="btn btn-sm btn-primary"><em class="icon ni ni-pen"></em></a> <a href="{{ ADMIN_USERS_DELETE.$curuser->id }}"  class="btn btn-sm btn-primary"><em class="icon ni ni-trash"></em></a> <a href="{{ ADMIN_USERS_IMPERSONATE.$curuser->id }}" class="btn btn-sm btn-primary" title="Impersonate"><em class="icon ni ni-user-add"></em></a>

                                                </td>
                                            </tr>
                                            @php $x++; @endphp
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!--card card-bordered-->
                    </div>


                </div>
            </div>
        </div>
    </div>

<!-- content @e -->

@endsection
