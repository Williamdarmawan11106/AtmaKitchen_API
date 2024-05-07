<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>

    <link rel="icon" type="image/png" href="{{ asset('img/Logo-min.png') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/password.css') }}">

    <style>
        .btn-pass {
            border: 1px solid #563b1d;
        }

        .btn-pass:hover {
            border: 1px solid #563b1d;
        }
    </style>

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
                            <div class="input-group">
                                <input type="password" class="form-control" id="current_password" name="current_password" placeholder="Enter your current password">
                                <button class="btn btn-pass" type="button" id="current">
                                    <i class="fa-regular fa-eye"></i>
                                </button>
                            </div>
                            <!-- @if (session('current_password_error'))
                                <div class="text-danger">{{ $message }}</div>
                            @endif -->
                        </div>
                        <div class="mb-3">
                            <label class="form-label">New Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Enter your new password">
                                <button class="btn btn-pass" type="button" id="new">
                                    <i class="fa-regular fa-eye"></i>
                                </button>
                            </div>
                            <!-- @if (session('new_password'))
                                <div class="text-danger">{{ $message }}</div>
                            @endif -->
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Confirm New Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" placeholder="Confirm your new password">
                                <button class="btn btn-pass" type="button" id="confirm">
                                    <i class="fa-regular fa-eye"></i>
                                </button>
                            </div>
                            <!-- @if (session('new_password_confirmation'))
                                <div class="text-danger">{{ $message }}</div>
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

    <script>
        const togglePassword = document.querySelector('#current');
        const password = document.querySelector('#current_password');

        togglePassword.addEventListener('click', function(e) {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.innerHTML = type === 'password' ? '<i class="fa-regular fa-eye"></i>' : '<i class="fa-regular fa-eye-slash"></i>';
        });

        const togglePassword2 = document.querySelector('#new');
        const password2 = document.querySelector('#new_password');

        togglePassword2.addEventListener('click', function(e) {
            const type = password2.getAttribute('type') === 'password' ? 'text' : 'password';
            password2.setAttribute('type', type);
            this.innerHTML = type === 'password' ? '<i class="fa-regular fa-eye"></i>' : '<i class="fa-regular fa-eye-slash"></i>';
        });

        const togglePassword3 = document.querySelector('#confirm');
        const password3 = document.querySelector('#new_password_confirmation');

        togglePassword3.addEventListener('click', function(e) {
            const type = password3.getAttribute('type') === 'password' ? 'text' : 'password';
            password3.setAttribute('type', type);
            this.innerHTML = type === 'password' ? '<i class="fa-regular fa-eye"></i>' : '<i class="fa-regular fa-eye-slash"></i>';
        });

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
</body>
</html>