@extends('home.master')

@section('content')
    <div class="col-sm-9 padding-right">
        <div class="features_items"><!--features_items-->
            <h2 class="title text-center">Features Items</h2>
            @foreach($products as $product)
            <div class="col-sm-4">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            <img src="images/home/product1.jpg" alt="" />
                            <h2>{{ $product->price }}</h2>
                            <p>{{ $product->title }}</p>
                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                        </div>
                        <div class="product-overlay">
                            <div class="overlay-content">
                                <h2>{{ $product->price }}</h2>

                                <a href="{{ route('products.single' ,$product->id) }}" class=""><p>Easy Polo Black Edition</p></a>
                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fc-agenda-view"></i>Add to cart</a>
                            </div>
                        </div>
                    </div>
                    <div class="choose">
                        <ul class="nav nav-pills nav-justified">
                            <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                            <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            @endforeach

        </div><!--features_items-->
        <div class="m-5">
            {{ $products->links() }}

        </div>

    </div>
@endsection
