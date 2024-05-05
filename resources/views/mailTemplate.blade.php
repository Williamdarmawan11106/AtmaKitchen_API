<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reset Password</title>
</head>
<body>
    <p>Halo <b>{{ $details['username'] }}</b>!</p>
    <p>Anda akan melakukan Reset Password akun Atma Kitchen anda melalui email ini</p>

    <center>
        <h3>Buka link di bawah untuk melakukan Reset Password anda</h3>
        <b style="color: blue">{{ $details['url'] }}</b>
    </center>

    <p>Terima Kasih telah melakukan Reset Password</p>
</body>
</html>