<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>

    <link rel="icon" type="image/png" href="{{ asset('img/Logo-min.png') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/password.css') }}">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center align-items-center" style="height: 100vh;">
            <div class="col-6">
                <div class="card box-regis">
                    <h4 class="text-center font-weight-bold">Reset Password</h4>
                    <p class="text-center">Ubah password untuk keamanan akun</p>
                    @if ($message)
                    <div class="alert alert-success">
                        {{ $message }}
                    </div>
                    @endif
                    <form class="contact-form row" method="POST" action="{{ route('updatePassword', ['id' => $customer->id]) }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label">Current Password</label>
                            <input type="password" class="form-control" id="current_password" name="current_password" placeholder="Enter your current password">
                            <!-- @if (session('current_password_error'))
                                <div class="alert alert-danger">{{ $message }}</div>
                            @endif -->
                        </div>
                        <div class="mb-3">
                            <label class="form-label">New Password</label>
                            <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Enter your new password">
                            <!-- @if (session('new_password'))
                                <div class="alert alert-danger">{{ $message }}</div>
                            @endif -->
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Confirm New Password</label>
                            <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" placeholder="Confirm your new password">
                            <!-- @if (session('new_password_confirmation'))
                                <div class="alert alert-danger">{{ $message }}</div>
                            @endif -->
                        </div>
                        <div class="mb-3 d-flex justify-content-center">
                            <button class="btn btn-regis" type="submit">Reset Password</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-6 text-center">
                <img src="{{ asset('img/Logo-expand.png') }}" alt="Atma Kitchen Logo" width="400">
                <h3>Change Your Password</h3>
                <h4>Update your password to ensure security</h4>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>

@section('extra-js')
<script>
    $(document).ready(function() {
        @if(Session::has('success'))
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: '{{ Session::get("success") }}',
        });
        @endif

        @if(Session::has('current_password_error'))
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: '{{ Session::get("current_password_error") }}',
        });
        @endif
    });
</script>
@endsection