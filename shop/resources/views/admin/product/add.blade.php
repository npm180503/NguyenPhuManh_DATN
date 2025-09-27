@extends('admin.main')

@section('head')
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
    <style>
        /* Preview ảnh nhiều */
        .images-preview {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 10px;
        }

        .images-preview .img-thumb {
            position: relative;
            width: 100px;
            height: 100px;
            border: 1px solid #e2e2e2;
            border-radius: 6px;
            overflow: hidden;
        }

        .images-preview .img-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .images-preview .img-thumb .btn-remove {
            position: absolute;
            top: 3px;
            right: 3px;
            background: rgba(0, 0, 0, 0.6);
            color: #fff;
            border: none;
            width: 22px;
            height: 22px;
            border-radius: 50%;
            cursor: pointer;
        }

        /* Preview ảnh chính */
        #preview {
            max-width: 120px;
            max-height: 120px;
            display: block;
            margin-top: 8px;
            border: 1px solid #e2e2e2;
            border-radius: 6px;
        }

        /* Kích thước phần sizes */
        .size-item {
            width: 220px;
        }
    </style>
@endsection

@section('content')
    <form action="" method="POST" enctype="multipart/form-data" id="productForm">
        @csrf
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Tên Sản Phẩm</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control"
                            placeholder="Nhập tên sản phẩm">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Danh Mục</label>
                        <select class="form-control" name="menu_id">
                            @foreach ($menus as $menu)
                                @php
                                    $parentMenu = $menu->parent_id ? \App\Models\Menu::find($menu->parent_id) : null;
                                    $displayName = $parentMenu ? "{$menu->name} ({$parentMenu->name})" : $menu->name;
                                @endphp
                                <option value="{{ $menu->id }}" {{ old('menu_id') == $menu->id ? 'selected' : '' }}>
                                    {{ $displayName }}</option>
                            @endforeach
                        </select>
                        @error('menu_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Sizes</label>
                <div class="size-container d-flex flex-wrap">
                    @foreach ($sizes as $size)
                        <div class="size-item mb-3 mr-4">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="sizes[{{ $size->id }}][size]" value="{{ 1 }}"
                                    class="custom-control-input size-checkbox" id="size{{ $size->id }}"
                                    {{ old('sizes.' . $size->id . '.active') ? 'checked' : '' }}>
                                <label class="custom-control-label"
                                    for="size{{ $size->id }}">{{ $size->name }}</label>
                            </div>
                            <div class="mt-2">
                                <input type="number" name="sizes[{{ $size->id }}][quantity]"
                                    class="form-control quantity-input" placeholder="Số lượng" style="width: 200px;"
                                    min="1" value="{{ old('sizes.' . $size->id . '.quantity') }}"
                                    {{ !old('sizes.' . $size->id . '.active') ? 'disabled' : '' }}>
                            </div>
                        </div>
                    @endforeach
                </div>
                @error('sizes')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="price">Giá Gốc</label>
                        <input type="text" name="price" id="price" onkeyup="formatNumber(this)"
                            value="{{ old('price') }}" class="form-control">
                        @error('price')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="price_sale">Giá Giảm</label>
                        <input type="text" name="price_sale" id="price_sale" onkeyup="formatNumber(this)"
                            value="{{ old('price_sale') }}" class="form-control">
                        @error('price_sale')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Mô Tả</label>
                <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
            </div>

            <div class="form-group">
                <label>Mô Tả Chi Tiết</label>
                <textarea name="content" id="content" class="form-control">{{ old('content') }}</textarea>
            </div>

            <div class="form-group">
                <label for="thumb">Ảnh chính (Thumb)</label>
                <input type="file" id="imageInput" name="thumb" accept="image/*" onchange="previewThumb(this);">

                <img id="preview" src="{{ Session::get('temp_image') ? asset(Session::get('temp_image')) : '#' }}"
                    alt="Preview" style="{{ Session::get('temp_image') ? '' : 'display:none;' }}">

                @if (Session::has('temp_image'))
                    <input type="hidden" name="temp_image" value="{{ Session::get('temp_image') }}">
                @endif

                @error('thumb')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="images">Ảnh phụ (Chọn nhiều ảnh)</label>
                <input type="file" id="images" name="images[]" multiple accept="image/*" class="form-control">
                <div id="imagesPreview" class="images-preview"></div>
                @error('images')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>Kích Hoạt</label>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="1" type="radio" id="active" name="active"
                        {{ old('active', '1') == '1' ? 'checked' : '' }}>
                    <label for="active" class="custom-control-label">Có</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="0" type="radio" id="no_active" name="active"
                        {{ old('active') === '0' ? 'checked' : '' }}>
                    <label for="no_active" class="custom-control-label">Không</label>
                </div>
            </div>

        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Thêm Sản Phẩm</button>
        </div>
    </form>
@endsection

@section('footer')
    <script>
        CKEDITOR.replace('content');
        CKEDITOR.replace('description');

        function formatNumber(input) {
            var value = input.value.replace(/[^0-9]/g, "");
            var formatted = value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            input.value = formatted;
        }

        // Preview ảnh thumb
        function previewThumb(input) {
            var preview = document.getElementById('preview');
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(input.files[0]);
            } else {
                @if (Session::has('temp_image'))
                    preview.src = "{{ asset(Session::get('temp_image')) }}";
                    preview.style.display = 'block';
                @else
                    preview.src = '#';
                    preview.style.display = 'none';
                @endif
            }
        }

        // Xử lý preview nhiều ảnh + cho phép xóa trước khi submit
        document.addEventListener('DOMContentLoaded', function() {
            const imagesInput = document.getElementById('images');
            const imagesPreview = document.getElementById('imagesPreview');
            let imagesFiles = [];

            imagesInput.addEventListener('change', function(e) {
                imagesFiles = Array.from(this.files);
                renderImagesPreview();
            });

            function renderImagesPreview() {
                imagesPreview.innerHTML = '';
                imagesFiles.forEach(function(file, idx) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const div = document.createElement('div');
                        div.className = 'img-thumb';
                        div.innerHTML =
                            `\n                            <img src="${e.target.result}" alt="">\n                            <button type="button" class="btn-remove" data-index="${idx}">&times;</button>\n                        `;
                        imagesPreview.appendChild(div);
                    };
                    reader.readAsDataURL(file);
                });

                // rebuild input.files
                const dataTransfer = new DataTransfer();
                imagesFiles.forEach(f => dataTransfer.items.add(f));
                imagesInput.files = dataTransfer.files;
            }

            // Click để xóa ảnh preview
            imagesPreview.addEventListener('click', function(e) {
                if (e.target.classList.contains('btn-remove')) {
                    const idx = Number(e.target.getAttribute('data-index'));
                    imagesFiles.splice(idx, 1);
                    renderImagesPreview();
                }
            });

            // Sizes checkbox logic
            document.querySelectorAll('.size-checkbox').forEach(checkbox => {
                const quantityInput = checkbox.closest('.size-item').querySelector('.quantity-input');
                if (checkbox.checked) {
                    quantityInput.disabled = false;
                    quantityInput.required = true;
                } else {
                    quantityInput.disabled = true;
                    quantityInput.required = false;
                }

                checkbox.addEventListener('change', function() {
                    const qInput = this.closest('.size-item').querySelector('.quantity-input');
                    if (this.checked) {
                        qInput.disabled = false;
                        qInput.required = true;
                        if (!qInput.value) qInput.value = 1;
                    } else {
                        qInput.disabled = true;
                        qInput.required = false;
                        qInput.value = '';
                    }
                });
            });

            // Trước khi submit, xoá dấu '.' trong các trường tiền
            document.getElementById('productForm').addEventListener('submit', function() {
                const price = document.getElementById('price');
                const priceSale = document.getElementById('price_sale');
                if (price) price.value = price.value.replace(/\./g, '');
                if (priceSale) priceSale.value = priceSale.value.replace(/\./g, '');
            });
        });
    </script>
@endsection
