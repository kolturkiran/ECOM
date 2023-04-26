@extends('master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <img class="detail-img" src="{{$product['gallery']}}" alt="">               
            </div>
            <div class="col-sm-6">
            <a href="/">Go Back</a>
                <h2>{{$product['name']}}</h2>
                <h3>Price   :   {{$product['price']}}</h3>
                <h4>Details   :   {{$product['description']}}</h4>
                <h4>Category   :   {{$product['category']}}</h4>
                <br><br>
                <form action="/add_to_cart" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{$product['id']}}">
                    <button class="btn btn-primary">Add to Cart</button>
                </form>
                <br>
                <form action="/buynow" method="POST">
                    @csrf
                <input type="hidden" name="product_id" value="{{$product['id']}}">                
                <button class="btn btn-success">Buy Now</button>
                </form>
            </div>
        </div>

          <!-- Wrapper for slides -->
        <div class="carousel-inner">
            @foreach ($products as $item)
                <div class="item {{ $item['id']==1?'active':''}}">
                    <a href="detail/{{$item['id']}}">
                        <img class="slider-img"src="{{$item['gallery']}}">
                        <div class="carousel-caption slider-text">
                            <h3>{{$item['name']}}</h3>
                            <p>{{$item['description']}}</p>
                        </div>
                    </a>
                </div>
            @endforeach                       
        </div>
          
    </div>
@endsection