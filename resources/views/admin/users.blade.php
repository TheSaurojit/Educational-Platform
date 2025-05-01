@extends('admin.layouts.app')

@section('body-section')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Users</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->


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
                                <th>Actions</th>

                
                            </tr>
                        </thead>


                        <tbody>

                            @foreach ($users as $user )
                                

                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->profile ? "Yes" : "No" }}</td>
                                <td>{{ $user->created_at->format('d M, Y ') }}</td>
                                <td>{{ $user->email_verified_at?->format('d M, Y') ?? "Not Verified"   }}</td>
                                <td>
                                    <x-post-button url="{{ route('admin.delete-user',['user'=> $user->id ]) }}" label="Delete"
                                        class="btn btn-danger waves-effect waves-light" ></x-post-button>
                                </td>
        
                            </tr>
              
                            @endforeach

  
                        </tbody>
                    </table>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
@endsection


@section('script-section')
@endsection
