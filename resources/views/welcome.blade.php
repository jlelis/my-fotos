<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!-- Jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
            integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</head>
<body>
<div class="container">
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif

    <h1 class="my-4">New Product</h1>


    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        Name:
        <br/>
        <input type="text" name="name" value="{{ old('name') }}" class="form-control"/>
        <br/>
        {{-- <div class="file-field input-field">
            Photo:
            <br />
            <input type="file" name="photos[]" multiple/>
            <div class="file-path-wrapper">
                <input class="file-path validate" type="text">
            </div>
            <br /><br />
        </div> --}}
        <div class="file-field input-field">
            <div class="btn">
                <span>File</span>
                <input type="file" name="photos[]" multiple>
            </div>
            <div class="file-path-wrapper">
                <input class="file-path validate" type="text" placeholder="Upload one or more files">
            </div>
        </div>


        <input type="submit" class="btn btn-primary" value="Save"/>
        <br/><br/>
    </form>


    @forelse ($productPhotos as $photo)
        <div class="row">
            <div class="col s12 m6 l6">
                <div class="card">
                    <div class="card-image">
                        <img src="{{asset('storage/'.$photo->path_images)}}" alt="{{$photo->product->name}}" class="responsive-img circle">
                        <span class="card-title">{{$photo->product->name}}</span>
                        <a class="btn-floating halfway-fab waves-effect waves-light red"><i class="material-icons">add</i></a>
                    </div>
                    <div class="card-content">
                        <p>I am a very simple card. I am good at containing small bits of information. I am convenient because I require little markup to use effectively.</p>
                    </div>
                </div>

            </div>
            @empty
                <p>Fotos Nao Encontrada</p>
            @endforelse
        </div>


</div>


<script>
    M.AutoInit();
</script>
</body>
</html>
