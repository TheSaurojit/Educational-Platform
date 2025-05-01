@extends('admin.layouts.app')

@section('body-section')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Password Settings</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 col-lg-4">
            <div class="p-2">
                <form class="form-horizontal" action="" method="POST">
                    @csrf
                    <!-- Current Password -->
                    <div class="mb-3">
                        <label class="form-label">Current Password</label>
                        <div class="input-group auth-pass-inputgroup">
                            <input type="password" class="form-control" placeholder="Enter Current password"
                                aria-label="Password" aria-describedby="password-addon-1" name="current_password"
                                id="current-password">
                            <button class="btn btn-light" type="button" id="password-addon-1"><i
                                    class="mdi mdi-eye-outline"></i></button>
                        </div>
                    </div>

                    <!-- New Password -->
                    <div class="mb-3">
                        <label class="form-label">New Password</label>
                        <div class="input-group auth-pass-inputgroup">
                            <input type="password" class="form-control" placeholder="Enter New password"
                                aria-label="Password" aria-describedby="password-addon-2" name="new_password"
                                id="new-password">
                            <button class="btn btn-light" type="button" id="password-addon-2"><i
                                    class="mdi mdi-eye-outline"></i></button>
                        </div>
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-3">
                        <label class="form-label">Confirm New Password</label>
                        <div class="input-group auth-pass-inputgroup">
                            <input type="password" class="form-control" placeholder="Enter Confirm password"
                                aria-label="Password" aria-describedby="password-addon-3" name="new_password_confirmation"
                                id="confirm-password">
                            <button class="btn btn-light" type="button" id="password-addon-3"><i
                                    class="mdi mdi-eye-outline"></i></button>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-3 d-grid">
                        <button class="btn btn-primary waves-effect waves-light" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@section('script-section')
    <!-- JavaScript -->
    <script>
        // Toggle password visibility function
        function togglePasswordVisibility(buttonId, inputId) {
            const button = document.getElementById(buttonId);
            const input = document.getElementById(inputId);

            button.addEventListener('click', function() {
                if (input.type === 'password') {
                    input.type = 'text';
                } else {
                    input.type = 'password';
                }
            });
        }

        // Attach events for all fields
        togglePasswordVisibility('password-addon-1', 'current-password');
        togglePasswordVisibility('password-addon-2', 'new-password');
        togglePasswordVisibility('password-addon-3', 'confirm-password');
    </script>
@endsection
