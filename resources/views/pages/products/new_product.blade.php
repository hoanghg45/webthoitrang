@extends('layout')
@section('content')
<header id="header" class="header">
    
</header>
<section id="breadcrumb-wrapper" class="">
    <div class="breadcrumb-overlay">

    </div>
        <div class="breadcrumb-content text-center">
        <div class="breadcrumb-big">

            <div class="title-banner-cart">
                3H STORE - Thương hiệu quần áo may sẵn hàng đầu Việt Nam
            </div>
        </div>
    </div>
</section>

<div class="text-center" style="font-size: 25px; margin-top: 20px; font-weight:900  ">SẢN PHẨM MỚI </div>

<div id="features" class="cards-1">
    <div class="container">
        <div class="wrapper">
            
            <div class="row">
                @if (!$product)
                    {{ 'ERROR!!' }}
                @else
                @foreach ($product as $item=>$pro)
                  
                <div class="col-4">
                    <a href="{{URL::to('/details-product/'.$pro->product_id)}}"><img src="public/uploads/products/{{$pro->product_image}}"></a>
                    <p class="product-title">{{ $pro->product_name }}</p>
                    <p class="product-price">{{ $pro->product_price }}₫</p>
                </div>
                @endforeach
                
                @endif
            </div>
           
            
        </div>
    </div>
</div>
<div style="margin:30px 0 60px">{!! $product->links() !!}</div>



@endsection