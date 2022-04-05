@extends('admin_layout')
@section('admin_content')
    <div class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-default">
                    <div class="card-header card-header-border-bottom">
                        <h2>Sửa sản phẩm</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ URL::to('/update-product/' . $edit_product->product_id) }}"
                            enctype="multipart/form-data" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Tên loại sản phẩm</label>
                                <input type="text" value="{{ $edit_product->product_name }}" name="product_name"
                                    class="form-control" id="exampleFormControlInput1" placeholder="Nhập tên ">
                                {{-- <span class="mt-2 d-block">We'll never share your email with anyone else.</span> --}}
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect12">Size</label>
                                <select name="product_size" class="form-control" id="exampleFormControlSelect12">

                                    @switch($edit_product->product_size)
                                        @case('S')
                                            :
                                            <option selected value="S">S</option>
                                            <option value="M">M</option>
                                            <option value="L">L</option>
                                        @break

                                        @case('M')
                                            :
                                            <option value="S">S</option>
                                            <option selected value="M">M</option>
                                            <option value="L">L</option>
                                        @break

                                        @case('L')
                                            :
                                            <option value="S">S</option>
                                            <option value="M">M</option>
                                            <option selected value="L">L</option>
                                        @break

                                        @default
                                            :
                                        @break
                                    @endswitch
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Mô tả sản phẩm</label>
                                <textarea class="form-control" style="resize: none" name="product_desc" id="exampleFormControlTextarea1" rows="5"
                                    placeholder="Nhập mô tả">{{ $edit_product->product_desc }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect12">Loại sản phẩm</label>


                                <select class="form-control " name="category_id" id="exampleFormControlSelect12">
                                    @foreach ($category as $cate)
                                        @if ($cate->category_id == $edit_product->category_id)
                                            <option selected value="<?php echo $cate->category_id; ?>">
                                                <?php echo $cate->category_name; ?>
                                            </option>
                                        @else
                                            <option value="<?php echo $cate->category_id; ?>">
                                                <?php echo $cate->category_name; ?>
                                            </option>
                                        @endif
                                    @endforeach
                                </select>

                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlFile1">Hình ảnh</label>

                                <div class="input-group mb-3 px-2 py-2 rounded-pill bg-white shadow-sm">
                                    <input name="product_image" id="upload" type="file" accept="image/*"
                                        onchange="readURL(this);" class="form-control border-0">
                                </div>

                                <!-- Uploaded image area-->
                                <span class="mt-2 d-block">Hình ảnh sẽ được hiển thị ở dưới đây </span>
                                <div class="image-area mt-4">

                                    <img id="imageResult"
                                        src="{{ URL::to('/public/uploads/products/' . $edit_product->product_image) }}" alt=""
                                        width="200" height="200" class="img-fluid rounded shadow-sm mx-auto d-block">
                                </div>


                            </div>

                            <div class="form-group" style="margin-top: 20px">
                                <label for="exampleFormControlSelect12">Giá</label>
                                <div class="input-group">
                                    <input name="product_price" value="{{ $edit_product->product_price }}" type="text"
                                        class="form-control number-separator " id="exampleFormControlSelect12 min=" 0">

                                    <div class="input-group-append">
                                        <span class="input-group-text">đ</span>
                                    </div>
                                </div>
                            </div>

                            {{-- <div class="form-group">
                        <label for="exampleFormControlFile1">thêm File</label>
                        <input type="file" class="form-control-file" name="category_file" id="exampleFormControlFile1">
                    </div> --}}
                            <div class="form-footer pt-4 pt-5 mt-4 border-top">
                                <button type="submit" class="btn btn-primary btn-default">Update sản phẩm</button>
                                <button type="reset" onclick="history.back()"
                                    class="btn btn-secondary btn-default">Hủy</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showImg(params) {
            var id = document.getElementById('idImg').value()
            if (id) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#imageResult')
                        .attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        function readURL(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#imageResult')
                        .attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        $(function() {
            $('#upload').on('change', function() {
                readURL(input);
            });
        });

        /*  ==========================================
            SHOW UPLOADED IMAGE NAME
        * ========================================== */
        var input = document.getElementById('upload');
        var infoArea = document.getElementById('upload-label');

        input.addEventListener('change', showFileName);

        function showFileName(event) {
            var input = event.srcElement;
            var fileName = input.files[0].name;
            infoArea.textContent = 'File name: ' + fileName;
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha384-vk5WoKIaW/vJyUAd9n/wmopsmNhiy+L2Z+SBxGYnUkunIxVxAv/UtMOhba/xskxh" crossorigin="anonymous">
    </script>
    <script>
        $(document).ready(function() {
            $(document).on('input', '.number-separator', function(e) {
                if (/^[0-9.,]+$/.test($(this).val())) {
                    $(this).val(
                        parseFloat($(this).val().replace(/,/g, '')).toLocaleString('en')
                    );
                } else {
                    $(this).val(
                        $(this)
                        .val()
                        .substring(0, $(this).val().length - 1)
                    );
                }
            });
        });
    </script>
@endsection
