@extends('admin.main')

@section('content')
<form action="{{ route('admin.new.update', $news->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="card-body">
        <div class="form-group">
            <label for="title">Tiêu đề</label>
            <input type="text" name="title" value="{{ old('title', $news->title) }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="content">Nội dung</label>
            <textarea name="content" id="editor" class="form-control" rows="6">{{ old('content', $news->content) }}</textarea>
        </div>

            <div class="form-group">
                <label for="thumb">Chọn hình ảnh</label>
                <div class="mt-2">
                    @if ($news->thumb)
                        <div class="current-image mb-2">
                            <img id="preview" src="{{ asset($news->thumb) }}" alt="Preview"
                                style="max-width: 100px; margin-top: 10px;">
                        </div>
                        <input type="hidden" name="current_thumb" value="{{ $news->thumb }}">
                    @else
                        <img id="preview" src="#" alt="Preview"
                            style="max-width: 200px; margin-top: 10px; display: none;">
                    @endif
                    <div class="mt-2">
                        <label class="btn btn-info">
                            <i class="fas fa-upload"></i> Thay đổi ảnh
                            <input type="file" id="imageInput" name="thumb" accept="image/*" 
                                class="form-control-file" onchange="previewImage(this);" style="display: none;">
                        </label>
                    </div>
                </div>
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
                    @if(Session::has('temp_image'))
                        preview.src = "{{ asset(Session::get('temp_image')) }}";
                        preview.style.display = 'block';
                    @else
                        preview.src = '#';
                        preview.style.display = 'none';
                    @endif
                }
            }
            </script>

        <div class="form-group">
            <label for="status">Trạng thái</label>
            <select name="status" class="form-control">
                <option value="1" {{ $news->status == 1 ? 'selected' : '' }}>Hiển thị</option>
                <option value="0" {{ $news->status == 0 ? 'selected' : '' }}>Ẩn</option>
            </select>
        </div>
    </div>

    <div class="card-footer">
        <button type="submit" class="btn btn-success">Cập nhật</button>
        <a href="{{ route('admin.new.list') }}" class="btn btn-secondary">Quay lại</a>
    </div>
</form>
@endsection

@section('scripts')
<script src="https://cdn.ckeditor.com/4.20.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('editor');
</script>
@endsection
