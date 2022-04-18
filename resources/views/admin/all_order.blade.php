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
                                <th>OrderID</th>
                                <th> Name</th>
                                <th >Phone</th>
                                <th >Address</th>
                                <th >OrderCost</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach ($order as $item=>$order)
                              
                          
                            <tr>
                                <td>{{$order->order_id}}</td>
                                <td>
                                    <a class="text-dark" href="">{{$order->user_name}}</a>
                                </td>
                                <td class="d-none d-md-table-cell">{{$order->user_phone}}</td>
                                <td class="d-none d-md-table-cell">{{$order->address}}</td>
                                <td class="d-none d-md-table-cell">{{ number_format($order->order_total) }}đ</td>
                                <td>
                                  <?php
                                  if ($order->order_status){
                              ?>

                              <a href="{{URL::to('/unactive-order/'.$order->order_id)}}">
                                  <span class="badge  badge-success">Đã xác nhận</span>
                              </a>
                              <?php
                                  }else{
                              ?>
                              <a href="{{URL::to('/active-order/'.$order->order_id)}}">
                                  <span class="badge  badge-danger">Chưa xác nhận</span>
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
                                                <a href="#">View</a>
                                            </li>
                                            <li class="dropdown-item">
                                                <a href="#">Remove</a>
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
    {{ $order->links() }}
</div>
    <?php
    $message = Session::get('message');
                    if($message){
                    echo "<script type='text/javascript'>alert('$message');</script>";
                    Session::put('message',null);
                    }
    ?>
@endsection
