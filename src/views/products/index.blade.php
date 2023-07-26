<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('public/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>

        .card {
            margin-top: 20px;
            margin-down: 20px;
        }
    </style>
</head>
<body>
<div class="breadcrumb">
    <div class="breadcrumb-item">
        <a href="{{route('product.index')}}">Products</a>
        <a>Products</a>
    </div>
</div>
<div class="container">
    <table class="table">
        <thead>
        <tr>
            <td colspan="5">
                <div class="justify-content-between d-flex">
                    <h2 class="d-inline">Products</h2>
                    <a href="{{route('product.create')}}" class="btn btn-primary">Add Product</a>
                </div>
            </td>
        </tr>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Stock</th>
            <th scope="col">Published?</th>
            <th scope="col">Actions</th>

        </tr>
        </thead>
        <tbody>
        @foreach($products as $x => $product)
            <tr>
                <th scope="row">{{$product->id}}</th>
                <td>{{$product->name}}</td>
                <td>
                    {{$product->productStock?->sum('quantity')??0}}
                </td>
                <td>{{$product->published==1?"yes":"no"}}</td>
                <td>
                    <a href="{{route('product.edit',$product->id)}}" title="Edit" class="btn btn-sm btn-secondary"><i class="fa fa-pencil"></i>
                    </a>
                    <a href="" title="Delete" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <td colspan="5">
                <div class="pagination justify-content-center">
                    {{$products->links()}}
                </div>
            </td>
        </tr>

        </tfoot>
    </table>
</div>

</body>
</html>
