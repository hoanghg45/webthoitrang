@extends('admin_layout')
@section('admin_content')
    <div class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-default">
                    <div class="card-header card-header-border-bottom"">
                                            <h2>Thêm sản phẩm</h2>
                                        </div>
                                        <div class="     card-body">
                        <form action="{{ URL::to('/save-product') }}" enctype="multipart/form-data" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Tên loại sản phẩm</label>
                                <input type="text" name="product_name" required class="form-control" id="exampleFormControlInput1"
                                    placeholder="Nhập tên ">
                                {{-- <span class="mt-2 d-block">We'll never share your email with anyone else.</span> --}}
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect12">Size</label>
                                <select name="product_size" class="form-control" id="exampleFormControlSelect12">
                                    <option value="S">S</option>
                                    <option value="M">M</option>
                                    <option value="L">L</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Mô tả sản phẩm</label>
                                <textarea class="form-control" required style="resize: none" name="product_desc" id="exampleFormControlTextarea1" rows="5"
                                    placeholder="Nhập mô tả"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect12">Loại sản phẩm</label>


                                <select class="form-control " name="category_id" id="exampleFormControlSelect12">
                                    @foreach ($category as $cate)
                                        <option value="<?php echo $cate->category_id; ?>">
                                            <?php echo $cate->category_name; ?>
                                        </option>
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
                                <span class="mt-2 d-block">Hình ảnh sẽ được hiển thị ở dưới đây</span>
                                <div class="image-area mt-4">
                                    <img id="imageResult" src="#" alt="" width="500"
                                        class="img-fluid rounded shadow-sm mx-auto d-block">
                                </div>


                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect12">Trạng thái</label>
                                <select class="form-control" id="exampleFormControlSelect12" name="product_status">
                                    <option value="1">Kinh doanh</option>
                                    <option value="0">Ngừng kinh doanh</option>


                                </select>
                            </div>
                            <div class="form-group" style="margin-top: 20px">
                                <label for="exampleFormControlSelect12">Giá</label>
                                <div class="input-group">
                                    <input name="product_price" required type="text"  class="form-control number-separator " id="exampleFormControlSelect12 min="0">
                                       
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
                                <button type="submit" class="btn btn-primary btn-default">Thêm sản phẩm</button>
                                <button type="reset" class="btn btn-secondary btn-default">Hủy</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
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
    <SCRipt>
    $(document).ready(function () {
        $(document).on('input', '.number-separator', function (e) {
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
      </SCRipt>
@endsection
