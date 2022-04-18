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
                                
                                <th>Tên sản phẩm</th>
                                <th>Size</th>
                                <th>Giá</th>
                                <th>Số lượng</th>
                                <th>Tổng</th>
                                
                                                               
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($detail_order as $key => $pro)
                            @php
                             $total =0;
                            $price = str_replace(',', '', $pro->product_price);
                            $subtotal = (int) $price * $pro->product_sale_quantity;
                            $total += $subtotal;
                         @endphp
                                <tr>
                                    
                                    <td>
                                        <a class="text-dark" href="">{{ $pro->product_name }}</a>
                                    </td>
                                    
                                    <td>{{$pro->product_size}}</td>  
                                    <td>{{$pro->product_price}}đ</td>  
                                    <td>{{$pro->product_sale_quantity}}</td>
                                    
                                    <td>{{ number_format($subtotal) }}đ</td>
                                    

                                    
                                </tr>
                            @endforeach
                            
                        </tbody>
                        
                    </table>
                    <h2 style="color:black">Tổng tiền :{{ number_format($total) }}đ</h2>
                </div>
            </div>
        </div>
    </div>
   
</div>
    <?php
    $message = Session::get('message');
                    if($message){
                    echo "<script type='text/javascript'>alert('$message');</script>";
                    Session::put('message',null);
                    }
    ?>
@endsection
