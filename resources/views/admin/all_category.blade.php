@extends('admin_layout')
@section('admin_content')
    <div class="content">
    <div class="row">
        <div class="col-12">
            <!-- Recent Order Table -->
            <div class="card card-table-border-none" id="recent-orders">
                <div class="card-header justify-content-between">
                    <h2>Danh sách loại sản phẩm</h2>
                    
                </div>
                
                <div class="card-body pt-0 pb-5">
                    
                    <table class="table card-table table-responsive table-responsive-large" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên loại sản phẩm</th>
                                <th>Ngày thêm</th>
                                <th style="text-align: center">Hiển thị</th>
                                <th class="text-right"><a href="{{URL::to('/add-category')}}"><span class="mdi mdi-36px mdi-playlist-plus "></span></a></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($all_category as $key => $cate)
                                <tr>
                                    <td>{{ $cate->category_id }}</td>
                                    <td>
                                        <a class="text-dark" href="">{{ $cate->category_name }}</a>
                                    </td>
                                    <td>
                                        <span class="text-dark">{{ $cate->created_at }}</a>
                                    </td>
                                    <td style="text-align: center">
                                        <?php
                                            if ($cate->category_status){
                                        ?>

                                        <a href="{{URL::to('/unactive-category/'.$cate->category_id)}}">
                                            <span class="badge  badge-success">Hiện</span>
                                        </a>
                                        <?php
                                            }else{
                                        ?>
                                        <a href="{{URL::to('/active-category/'.$cate->category_id)}}">
                                            <span class="badge  badge-danger">Ẩn</span>
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
                                                    <a href="{{URL::to('/edit-category/'.$cate->category_id)}}">Sửa</a>
                                                </li>
                                                <li class="dropdown-item">
                                                    <a onclick="return confirm('Bạn có chắc muốn xóa?')" href="{{URL::to('/del-category/'.$cate->category_id)}}">Xóa</a>
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
    {{ $all_category->links() }}
</div>
    @php
    $message = Session::get('message');
                    if($message){
                    echo "<script type='text/javascript'>alert('$message');</script>";
                    Session::put('message',null);
                    }
    @endphp
@endsection
