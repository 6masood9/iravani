<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile</title>
    <link rel="stylesheet" href="{{ asset('styles/bootstrap 5/css/bootstrap.min.css') }}">
</head>
<body>
<div class="container">
    <div class="row" style="margin-top: 45px">
        <div class="col-md-6 offset-md-3">
            <h4>Profile</h4>
            <hr>
            <table class="table table-hover">
                <thead>
                <th>Name</th>
                <th>Email</th>
                <th></th>
                <th></th>
                </thead>
                <tbody>
                <tr>
                    <td>{{ $user = Auth::user()->name}}</td>
                    <td>{{ $user = Auth::user()->email}}</td>
                    <td><a href="logout">Logout</a></td>
                </tr>
                <tr>
                    <td colspan="3">
                        <form action="@if(isset($posts)){{ route('posts') }}@else{{ route('update') }}@endif" method="post">
                            @csrf

                            <div class="mb-3">
                                @if(isset($edit))
                                    <input type="hidden" name="id" value="{{ $edit->id }}">
                                @endif
                                <input type="text" class="form-control" name="title" placeholder="comment"
                                       aria-describedby="button-addon2" value="@if(isset($edit)){{ $edit->title }} @endif">
                                <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Button
                                </button>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">textarea</label>
                                <textarea class="form-control"  name="content" id="exampleFormControlTextarea1"
                                          rows="3">@if(isset($edit)){{ $edit->content }} @endif</textarea>
                            </div>
                        </form>
                    </td>
                </tr>
                @if(isset($posts))
                @foreach($posts as $post)
                    <tr>
                        <td> {{ $post->title}}</td>
                        <td> {{ $post->content}}</td>
                        <td><a href="posts/DeleteP/{{ $post->id}}">delete</a></td>
                        <td><a href="posts/Edit/{{ $post->id}}">edit</a></td>
                    </tr>
                @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
