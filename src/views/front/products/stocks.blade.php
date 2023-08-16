@extends('product_crud::layouts.app')

@section('content')
    <div class="breadcrumb">
        <div class="breadcrumb-item">
            <a href="{{route('product.index')}}">Products</a>
            <a href="{{route('cart.view')}}">Cart</a>
            <a href="{{route('cart.clear')}}">Cart Clear</a>
        </div>
    </div>
    <h5 class="card-title">{{$product->name}}</h5>
    <div class="row justify-content-around ">
        @forelse($product->productStock as $productStock)
            <div class="col-3 card ml-1" style="">
                <img src="{{ $productStock->image? asset('public/products/').$productStock->image
                                      :asset('public/default.jpeg')}}"
                     class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{$productStock->size}}</h5>
                    <div class="col-1" style="color: {{$productStock->color}}"></div>
                    <p class="card-text">{{$productStock->price}}</p>
                    <form method="POST" action="{{route('cart.add')}}">
                        @csrf
                        <input type="hidden" name="productStockId" value="{{$productStock->id}}">
                        <button type="submit" class="btn btn-primary">Add To Cart</button>
                    </form>
                </div>
            </div>

        @empty
            <div></div>
        @endforelse
    </div>

@endsection
