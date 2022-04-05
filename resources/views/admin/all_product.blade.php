@extends('admin_layout')
@section('admin_content')
    <div class="content">
    <div class="row">
        <div class="col-12">
            <!-- Recent Order Table -->
            <div class="card card-table-border-none" id="recent-orders">
                <div class="card-header justify-content-between">
                    <h2>Danh sách sản phẩm</h2>
                    
                </div>
                
                <div class="card-body pt-0 pb-5">
                    
                    <table class="table card-table table-responsive table-responsive-large" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên sản phẩm</th>
                                <th>Loại sản phẩm</th>    
                                <th>Size</th>
                                <th>Giá</th>
                                <th>Số lượng</th>
                                <th>Hình ảnh</th>
                                <th style="text-align: center">Trạng thái</th>
                                                               
                                <th class="text-right"><a href="{{URL::to('/add-product')}}"><span class="mdi mdi-36px mdi-playlist-plus "></span></a></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($all_product as $key => $pro)
                                <tr>
                                    <td>{{$pro->product_id }}</td>
                                    <td>
                                        <a class="text-dark" href="">{{ $pro->product_name }}</a>
                                    </td>
                                    <td>
                                       {{ $pro->category_name }}
                                    </td> 
                                    <td>{{$pro->product_size}}</td>  
                                    <td>{{$pro->product_price}}đ</td>  
                                    <td style="text-align: center">{{$pro->product_quantity}}</td>
                                    <td><img src="public/uploads/products/{{$pro->product_image}}" width="100px" height="150px"></td>
                                    
                                    <td style="text-align: center">
                                        <?php
                                            if ($pro->product_status){
                                        ?>

                                        <a href="{{URL::to('/unactive-product/'.$pro->product_id)}}">
                                            <span class="badge  badge-success">Kinh doanh</span>
                                        </a>
                                        <?php
                                            }else{
                                        ?>
                                        <a href="{{URL::to('/active-product/'.$pro->product_id)}}">
                                            <span class="badge  badge-danger">Ngừng kinh doanh</span>
                                        </a>
                                        <?php
                                                }
                                        ?>
                                        


                                    </td>

                                    <td class="text-right">
                                        <div class="dropdown show d-inline-block widget-dropdown">
                                            <a class="dropdown-toggle icon-burger-mini" href="" role="button"
                                                id="dropdown-recent-order1" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false" data-display="static"></a>
                                            <ul class="dropdown-menu dropdown-menu-right"
                                                aria-labelledby="dropdown-recent-order1">
                                                <li class="dropdown-item">
                                                    <a href="{{URL::to('/edit-product/'.$pro->product_id)}}">Sửa</a>
                                                </li>
                                                <li class="dropdown-item">
                                                    <a onclick="return confirm('Bạn có chắc muốn xóa?')" href="{{URL::to('/del-product/'.$pro->product_id)}}">Xóa</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{ $all_product->links() }}
</div>
    <?php
    $message = Session::get('message');
                    if($message){
                    echo "<script type='text/javascript'>alert('$message');</script>";
                    Session::put('message',null);
                    }
    ?>
@endsection
