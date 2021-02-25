@extends('home.master')


@section('content')

    <div class="col-sm-9 padding-right">
        <div class="product-details"><!--product-details-->
            <div class="col-sm-5">
                <div class="view-product">
                    <img src="/images/product-details/1.jpg" alt="">
                    <h3>ZOOM</h3>
                </div>
                <div id="similar-product" class="carousel slide" data-ride="carousel">

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        <div class="item">
                            <a href=""><img src="/images/product-details/similar1.jpg" alt=""></a>
                            <a href=""><img src="/images/product-details/similar2.jpg" alt=""></a>
                            <a href=""><img src="images/product-details/similar3.jpg" alt=""></a>
                        </div>
                        <div class="item active">
                            <a href=""><img src="/images/product-details/similar1.jpg" alt=""></a>
                            <a href=""><img src="/images/product-details/similar2.jpg" alt=""></a>
                            <a href=""><img src="/images/product-details/similar3.jpg" alt=""></a>
                        </div>
                        <div class="item">
                            <a href=""><img src="/images/product-details/similar1.jpg" alt=""></a>
                            <a href=""><img src="/images/product-details/similar2.jpg" alt=""></a>
                            <a href=""><img src="/images/product-details/similar3.jpg" alt=""></a>
                        </div>

                    </div>

                    <!-- Controls -->
                    <a class="left item-control" href="#similar-product" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a class="right item-control" href="#similar-product" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>

            </div>
            <div class="col-sm-7">
                <div class="product-information"><!--/product-information-->
                    <img src="images/product-details/new.jpg" class="newarrival" alt="">
                    <h2>{{ $product->title }}</h2>
                    <p>Web ID: {{ $product->id }}</p>
                    <img src="/images/product-details/rating.png" alt="">
                    <span>
									<span>US {{ number_format($product->price) }}</span>
									<label>Quantity:</label>
									<input type="text" value="{{ $product->inventory }}">
									<button type="button" class="btn btn-fefault cart">
										<i class="fa fa-shopping-cart"></i>
										Add to cart
									</button>
								</span>
                    <p><b>Availability:</b> In Stock</p>
                    <p><b>Condition:</b> New</p>
                    <p><b>Brand:</b> E-SHOPPER</p>
                    <p>{{ $product->description }}</p>

                    <a href=""><img src="/images/product-details/share.png" class="share img-responsive" alt=""></a>
                </div><!--/product-information-->
            </div>
        </div><!--/product-details-->

        <div class="response-area">
            <h2>3 RESPONSES</h2>
            <ul class="media-list">
        @include('home.products.comment' , ['comments' => $product->comments()->where('parent_id' ,0)->where('approved',1)->get()])
            </ul>
        </div>
        <div id="Comment">

            <form action="{{ route('send.comment') }}" method="post">
                @csrf
                <input type="hidden" name="commentable_id" value="{{ $product->id }}">
                <input type="hidden" name="commentable_type" value="{{ get_class($product) }}">

                <input type="hidden" name="parent_id" value="{{ request('parent') ?? '0' }}">

                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Comment</label>
                    <div class="col-sm-10">
                        <textarea type="text" name="comment" class="form-control" id="inputComment"
                                  placeholder="Comment"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success mb-2">send</button>

                </div>


            </form>
        </div>

    </div>
@endsection
