@extends('admin.layouts.app')

@section('body-section')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Dashboard</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    @php

        $totalUsers = \App\Models\User::all()->count() - 1;

        $activeUsers = \App\Models\User::where('email_verified_at', '!=', null)->count();

    @endphp


    <div class="col-xl-8">
        <div class="row">


            <div class="col-md-4">
                <div class="card mini-stats-wid">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-muted fw-medium">Total Users</p>
                                <h4 class="mb-0">{{ $totalUsers }}</h4>
                            </div>

                            <div class="flex-shrink-0 align-self-center">
                                <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                    <span class="avatar-title">
                                        <i class="bx bx-copy-alt font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mini-stats-wid">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-muted fw-medium">Active Users</p>
                                <h4 class="mb-0">{{ $activeUsers }}</h4>
                            </div>

                            <div class="flex-shrink-0 align-self-center ">
                                <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                    <span class="avatar-title rounded-circle bg-primary">
                                        <i class="bx bx-archive-in font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>




        </div>
    </div>


    {{-- 
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                 
                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Profile Created</th>
                                <th>Registered At </th>
                                <th>Email Verified At</th>

                
                            </tr>
                        </thead>


                        <tbody>

                            @foreach ($users as $user)
                                

                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->profile ? "Yes" : "No" }}</td>
                                <td>{{ $user->created_at->format('d M, Y ') }}</td>
                                <td>{{ $user->email_verified_at?->format('d M, Y') ?? "Not Verified"   }}</td>
        
                            </tr>
              
                            @endforeach

  
                        </tbody>
                    </table>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row --> --}}
@endsection


@section('script-section')
@endsection
