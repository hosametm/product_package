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
