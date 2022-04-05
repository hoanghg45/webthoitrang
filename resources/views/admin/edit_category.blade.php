@extends('admin_layout')
@section('admin_content')
    <div class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-default">
                    <div class="card-header card-header-border-bottom">
                        <h2>Cập nhật loại sản phẩm</h2>
                    </div>

                    <div class="card-body">
                        {{-- @foreach($edit_category as $key => $edit_value) --}}
                        <form action="{{URL::to('/update-category/'.$edit_category->category_id)}}" method="POST" >
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Tên loại sản phẩm</label>
                                <input type="text" name="category_name" required value="{{$edit_category->category_name}}" class="form-control" id="exampleFormControlInput1"
                                    placeholder="Nhập tên ">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Mô tả loại sản phẩm</label>
                                <textarea class="form-control" required  style="resize: none" name="category_desc" id="exampleFormControlTextarea1" rows="3"
                                    placeholder="Nhập mô tả">@php
                                        echo $edit_category->category_desc
                                    @endphp</textarea>
                            </div>


                            {{-- <div class="form-group">
                        <label for="exampleFormControlFile1">thêm File</label>
                        <input type="file" class="form-control-file" name="category_file" id="exampleFormControlFile1">
                    </div> --}}
                            <div class="form-footer pt-4 pt-5 mt-4 border-top">
                                <button type="submit"  class="btn btn-primary btn-default">Update</button>
                                
                                <button onclick="history.back()" class="btn btn-secondary btn-default">Hủy</button>
                            </div>
                        </form>
                        {{-- @endforeach --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection
