<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('public/css/bootstrap.min.css')}}">
</head>
<body>
<div class="breadcrumb">
    <div class="breadcrumb-item">
        <a href="{{route('product.index')}}">Products</a>
        <a>{{$product->name}}</a>
    </div>
</div>
<div class="container">

    <div class="card" style="width: 18rem;">
        <img src="{{ $product->image? asset('public/products/').$product->image
                                      :asset('public/default.jpeg')}}"
             class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title">{{$product->name}}</h5>
            <p class="card-text">{{$product->description}}</p>
            <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
    </div>
</div>

</body>
</html>
