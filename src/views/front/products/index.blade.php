@extends('product_crud::layouts.app')

@section('content')
    <div class="breadcrumb">
        <div class="breadcrumb-item">
            <a href="{{route('product.index')}}">Products</a>
            <a href="{{route('cart.view')}}">Cart</a>
            <a href="{{route('cart.clear')}}">Cart Clear</a>
        </div>
    </div>
    <div class="row justify-content-around ">

        @forelse($products as $product)
            <div class="col-3 card ml-1" style="">
                <img src="{{ $product->image? asset('public/products/').$product->image
                                      :asset('public/default.jpeg')}}"
                     class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{$product->name}}</h5>
                    <p class="card-text">{{$product->description}}</p>
                    <form method="POST" action="{{route('cart.add')}}">
                        @csrf
                        <input type="hidden" name="productId" value="{{$product->id}}">
                        <button type="submit" class="btn btn-primary">Add To Cart</button>
                    </form>

                </div>
            </div>

        @empty
            <div></div>
        @endforelse
    </div>

@endsection
