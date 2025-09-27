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

        .images-preview .img-thumb button {
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
    <form id="productForm" action="" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="menu">Tên Sản Phẩm</label>
                        <input type="text" name="name" value="{{ $product->name }}" class="form-control"
                            placeholder="Nhập tên sản phẩm">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Danh Mục</label>
                        <select class="form-control" name="menu_id">
                            @foreach ($menus as $menu)
                                @php
                                    $parentMenu = \App\Models\Menu::find($menu->parent_id);
                                    $displayName = $parentMenu ? "{$menu->name} ({$parentMenu->name})" : $menu->name;
                                @endphp
                                <option value="{{ $menu->id }}" {{ $product->menu_id == $menu->id ? 'selected' : '' }}>
                                    {{ $displayName }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            {{-- Sizes --}}
            <div class="form-group">
                <label>Sizes</label>
                <div class="size-container d-flex flex-wrap">
                    @foreach ($sizes as $size)
                        <div class="size-item mb-3 mr-4">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="sizes[{{ $size->id }}][active]" value="1"
                                    class="custom-control-input size-checkbox" id="size{{ $size->id }}"
                                    {{ $product->sizes->contains($size->id) ? 'checked' : '' }}>
                                <label class="custom-control-label" for="size{{ $size->id }}">
                                    {{ $size->name }}
                                </label>
                            </div>
                            <div class="mt-2">
                                <input type="number" name="sizes[{{ $size->id }}][quantity]"
                                    class="form-control quantity-input" placeholder="Số lượng" style="width: 200px;"
                                    min="1"
                                    value="{{ $product->sizes->where('id', $size->id)->first()?->pivot->quantity ?? '' }}"
                                    {{ !$product->sizes->contains($size->id) ? 'disabled' : '' }}>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Giá --}}
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Giá Gốc</label>
                        <input type="text" id="price" name="price"
                            value="{{ number_format($product->price, 0, ',', '.') }}" onkeyup="formatNumber(this)"
                            class="form-control">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Giá Giảm</label>
                        <input type="text" id="price_sale" name="price_sale"
                            value="{{ number_format($product->price_sale, 0, ',', '.') }}" onkeyup="formatNumber(this)"
                            class="form-control">
                    </div>
                </div>
            </div>

            {{-- Mô tả --}}
            <div class="form-group">
                <label>Mô Tả </label>
                <textarea name="description" id="description" class="form-control">{{ $product->description }}</textarea>
            </div>

            <div class="form-group">
                <label>Mô Tả Chi Tiết</label>
                <textarea name="content" id="content" class="form-control">{{ $product->content }}</textarea>
            </div>

            {{-- Ảnh chính --}}
            <div class="form-group">
                <label>Ảnh chính (Thumb)</label>
                <input type="file" name="thumb" onchange="previewThumb(this)">
                <br>
                @if ($product->thumb)
                    <img id="preview" src="{{ asset($product->thumb) }}" alt="Thumb">
                @else
                    <img id="preview" src="#" alt="Preview" style="display:none;">
                @endif
            </div>

            {{-- Ảnh phụ --}}
            <div class="form-group">
                <label>Ảnh phụ (Chọn nhiều ảnh)</label>
                <input type="file" id="images" name="images[]" multiple>
                <div id="imagesPreview" class="images-preview">
                    {{-- Hiển thị ảnh phụ cũ --}}
                    @if ($product->images)
                        @foreach ($product->images as $img)
                            <div class="img-thumb">
                                <img src="{{ asset($img->image_path) }}" alt="">
                                <button type="button" class="btn-remove-old"
                                    data-id="{{ $img->id }}">&times;</button>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>

            {{-- Active --}}
            <div class="form-group">
                <label>Kích Hoạt</label>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="1" type="radio" id="active" name="active"
                        {{ $product->active == 1 ? 'checked' : '' }}>
                    <label for="active" class="custom-control-label">Có</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="0" type="radio" id="no_active" name="active"
                        {{ $product->active == 0 ? 'checked' : '' }}>
                    <label for="no_active" class="custom-control-label">Không</label>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Cập nhật sản phẩm</button>
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
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const imagesInput = document.getElementById('images');
            const imagesPreview = document.getElementById('imagesPreview');
            const form = document.getElementById('productForm');
            let imagesFiles = [];

            // Preview ảnh mới
            imagesInput.addEventListener('change', function() {
                imagesFiles = Array.from(this.files);
                renderImagesPreview();
            });

            function renderImagesPreview() {
                // Chỉ render ảnh mới, giữ lại ảnh cũ
                const oldImages = imagesPreview.querySelectorAll('.img-thumb .btn-remove-old');
                imagesPreview.innerHTML = '';
                oldImages.forEach(btn => {
                    imagesPreview.appendChild(btn.closest('.img-thumb'));
                });

                imagesFiles.forEach(function(file, idx) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const div = document.createElement('div');
                        div.className = 'img-thumb';
                        div.innerHTML = `
                            <img src="${e.target.result}" alt="">
                            <button type="button" class="btn-remove" data-index="${idx}">&times;</button>
                        `;
                        imagesPreview.appendChild(div);
                    };
                    reader.readAsDataURL(file);
                });

                const dataTransfer = new DataTransfer();
                imagesFiles.forEach(f => dataTransfer.items.add(f));
                imagesInput.files = dataTransfer.files;
            }

            // Xóa ảnh mới
            imagesPreview.addEventListener('click', function(e) {
                if (e.target.classList.contains('btn-remove')) {
                    const idx = Number(e.target.getAttribute('data-index'));
                    imagesFiles.splice(idx, 1);
                    renderImagesPreview();
                }
            });

            // Xóa ảnh cũ
            // khi click nút X thì thêm hidden input
            document.addEventListener("click", function(e) {
                if (e.target.classList.contains("btn-remove-old")) {
                    const imgId = e.target.getAttribute("data-id");
                    const input = document.createElement("input");
                    input.type = "hidden";
                    input.name = "delete_images[]";
                    input.value = imgId;
                    document.querySelector("form").appendChild(input);
                    e.target.parentElement.remove(); // xoá ảnh hiển thị
                }
            });


            // Sizes logic
            document.querySelectorAll('.size-checkbox').forEach(checkbox => {
                const quantityInput = checkbox.closest('.size-item').querySelector('.quantity-input');
                quantityInput.disabled = !checkbox.checked;
                quantityInput.required = checkbox.checked;

                checkbox.addEventListener('change', function() {
                    if (this.checked) {
                        quantityInput.disabled = false;
                        quantityInput.required = true;
                        if (!quantityInput.value) quantityInput.value = 1;
                    } else {
                        quantityInput.disabled = true;
                        quantityInput.required = false;
                        quantityInput.value = '';
                    }
                });
            });

            // Xóa dấu . trước khi submit
            form.addEventListener('submit', function() {
                const price = document.getElementById('price');
                const priceSale = document.getElementById('price_sale');
                if (price) price.value = price.value.replace(/\./g, '');
                if (priceSale) priceSale.value = priceSale.value.replace(/\./g, '');
            });
        });
    </script>
@endsection
