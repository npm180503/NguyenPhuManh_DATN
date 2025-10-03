@extends('admin.main')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Thêm tin tức mới</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.new.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group mb-3">
                    <label for="title">Tiêu đề</label>
                    <input type="text" id="title" name="title"
                        class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}"
                        placeholder="Nhập tiêu đề...">
                    @error('title')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="content">Nội dung</label>
                    <textarea id="content" name="content" rows="6" class="form-control @error('content') is-invalid @enderror"
                        placeholder="Nhập nội dung...">{{ old('content') }}</textarea>
                    @error('content')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="thumb">Chọn hình ảnh</label>
                    <input type="file" id="imageInput" name="thumb" accept="image/*" onchange="previewImage(this);">
                    <img id="preview" src="{{ Session::get('temp_image') ? asset(Session::get('temp_image')) : '#' }}"
                        alt="Preview" style="max-width: 100px; {{ Session::get('temp_image') ? '' : 'display: none;' }}">
                    @if (Session::has('temp_image'))
                        <input type="hidden" name="temp_image" value="{{ Session::get('temp_image') }}">
                    @endif
                    @error('thumb')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <script>
                    function previewImage(input) {
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
                </script>
                <div class="form-group mb-3">
                    <label for="status">Trạng thái</label>
                    <select name="status" id="status" class="form-select">
                        <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Hiển thị</option>
                        <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Ẩn</option>
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label for="published_at">Ngày đăng</label>
                    <input type="date" id="published_at" name="published_at" class="form-control"
                        value="{{ old('published_at', date('Y-m-d')) }}">
                </div>

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">Lưu tin tức</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('content');
    </script>
@endsection
