@extends('layout')
@section('content')
<!-- Header -->
<header id="header" class="header">
        <img id="banner" src="{{('public/frontend/images/banner 1.png')}}" alt="">
</header>
<!-- end of header -->
<!-- end of header -->
<div id="features" class="cards-1">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="h2-heading"><a href="{{URL::to('/new-product')}}">SẢN PHẨM MỚI</a></h4>
                </div>
            </div>
            <div class="wrapper">
                <div class="row">
                    @foreach ($product as $item=>$pro)
                    <div class="col">
                        <a href="{{URL::to('/details-product/'.$pro->product_id)}}"><img src="public/uploads/products/{{$pro->product_image}}"></a>
                    </div>
                    @endforeach
                    
                 
                </div>
            </div>
        </div>
    </div>
    <div class="mxgraph" style="max-width:100%;border:1px solid transparent;" data-mxgraph="{&quot;highlight&quot;:&quot;#0000ff&quot;,&quot;nav&quot;:true,&quot;resize&quot;:true,&quot;xml&quot;:&quot;&lt;mxfile host=\&quot;app.diagrams.net\&quot; modified=\&quot;2022-03-31T06:16:27.745Z\&quot; agent=\&quot;5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36\&quot; etag=\&quot;50wSGQ3glthBjmNq2fnp\&quot; version=\&quot;17.3.0\&quot; type=\&quot;device\&quot;&gt;&lt;diagram id=\&quot;JTunnI6bgVr9qRr64PNh\&quot; name=\&quot;Page-1\&quot;&gt;jZLdToQwEIWfhstNgBJcL10WNSbGRMx63dBZ2qRQLEVgn95ihz83m3jTdL6ZtjPn1CNJ2T9pWvNXxUB6oc96jxy9MNzHe7uOYHAgimIHCi2YQ8ECMnEBhD7SVjBoNoVGKWlEvYW5qirIzYZRrVW3LTsruX21pgVcgSyn8pp+CmY4jhXeLfwZRMGnl4P43mVKOhXjJA2nTHUrRFKPJFop43Zln4ActZt0ceceb2TnxjRU5j8H3i998vJ2+uDt1+6hNUc/PQW7EO35prLFibFbM0wS2Gus2jY4dFwYyGqaj5nO+m0ZN6W0UWC3tKmdBWfRg331gHeDNtDf7DqYtbB/CFQJRg+2BA+QCOUb/sTdyg1EfGXExCj6X8w3LxLZDao0hYsbv7nVlybpDw==&lt;/diagram&gt;&lt;/mxfile&gt;&quot;,&quot;toolbar&quot;:&quot;pages zoom layers lightbox&quot;,&quot;page&quot;:0}"></div>


    <div id="features" class="cards-1">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="h2-heading">3H STORE</h4>
                </div>
            </div>
            <div class="wrapper">
                <div class="row">
                    <div class="grid md-mg-left-10">
                        <div class="grid__item large--one-whole medium--one-whole small--one-whole md-pd-left10">
                            <div class="home-video-img">
                                <div class="video-wrapper">
                                    <iframe width="100%" height="350" src="https://www.youtube.com/embed/qkM2o_1xl4o?rel=0&amp;autoplay=1" frameborder="0" allow="accelerometer; encrypted-media; gyroscope; picture-in-picture">
                                    </iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="features" class="cards-1">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="h2-heading">LOOKBOOK</h4>
                </div>
            </div>
            <div class="wrapper">
                <div class="row">
                    <div class="col">
                        <a href=""><img src="public/frontend/images/look1.webp"></a>
                        <div class="htesti-title">REAL MEN - 3H STORE</div>
                    </div>
                    <div class="col">
                        <a href=""><img src="public/frontend/images/look2.webp"></a>
                        <div class="htesti-title">DREAM OF VENICE</div>
                    </div>
                    <div class="col">
                        <a href=""><img src="public/frontend/images/look3.webp"></a>
                        <div class="htesti-title">코리아 스프링 썸머 컬렉션 - Mr Right</div>
                    </div>
                    <div class="col">
                        <a href=""><img src="public/frontend/images/look4.webp"></a>
                        <div class="htesti-title">LOST IN PARIS</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

 
@endsection