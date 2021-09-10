<!DOCTYPE html>
<html>
<head>
    <title>Import Export Excel to database Example</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
</head>
<body>
   
<div class="container">
    <div class="card bg-light mt-3">
        <div class="card-body">
            @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{session('success')}}
            </div>
            @endif
            <form action="{{ route('importcategoryrel') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" class="form-control">
                <br>
                <button class="btn btn-success">Import CategoryRelation Data</button>
                <a class="btn btn-warning" href="{{ route('exportcategoryrel') }}">Export CategoryRelation Data</a>
            </form>
        </div>
    </div>
</div>
   
</body>
</html> 