@extends('admin_layout')
@section('admin_content')
    <div class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-default">
                    <div class="card-header card-header-border-bottom"">
                        <h2>Thêm loại sản phẩm</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{URL::to('/save-category')}}" method="POST" >
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Tên loại sản phẩm</label>
                                <input type="text" required name="category_name" class="form-control" id="exampleFormControlInput1"
                                    placeholder="Nhập tên ">
                                {{-- <span class="mt-2 d-block">We'll never share your email with anyone else.</span> --}}
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Mô tả loại sản phẩm</label>
                                <textarea class="form-control" required style="resize: none" name="category_desc" id="exampleFormControlTextarea1" rows="3"
                                    placeholder="Nhập mô tả"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlSelect12">Hiển thị</label>
                                <select class="form-control" id="exampleFormControlSelect12" name="category_status">
                                    <option value="1">Hiển thị</option>
                                    <option value="0">Ẩn</option>
                                    

                                </select>
                            </div>

                            {{-- <div class="form-group">
                        <label for="exampleFormControlFile1">thêm File</label>
                        <input type="file" class="form-control-file" name="category_file" id="exampleFormControlFile1">
                    </div> --}}
                            <div class="form-footer pt-4 pt-5 mt-4 border-top">
                                <button type="submit"  class="btn btn-primary btn-default">Thêm loại sản phẩm</button>
                                <button type="reset" class="btn btn-secondary btn-default">Hủy</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
  
@endsection
