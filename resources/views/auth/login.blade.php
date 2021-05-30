<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="{{ asset('styles/bootstrap 5/css/bootstrap.min.css') }}">
    {{--    <link rel="stylesheet" href="/styles/bootstrap%205/css/bootstrap.min.css">--}}
</head>
<body>
<div class="container">
    <div class="row" style="margin-top:45px">
        <div class="col-md-4  offset-4">
            <h4>User login</h4>
            <hr>
            <form action="{{ route('auth.check') }}" method="post">
                @csrf

                <div class="results">
                    @if(Session::get('fail'))
                        <div class="alert alert-danger">
                            {{ Session::get('fail') }}
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" name="email" placeholder="Enter email" value="{{ old('email') }}">
                    <span class="text-danger">@error('email') {{ $message }} @enderror</span>
                </div>
                <div class="form-group">
                    <label for="Password">Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Enter Password">
                    <span class="text-danger">@error('password') {{ $message }} @enderror</span>
                </div>
                <div class="form-group d-grid" style="margin-top:10px">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
                <br>
                <a href="register">Create an new Account now!</a>
            </form>
        </div>
    </div>
</div>
</body>
</html>
