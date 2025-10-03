@extends('admin.main')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $title }}</h3>
            <div class="card-tools">
                <a href="{{ route('admin.new.create') }}" class="btn btn-primary">+ Thêm tin tức</a>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Ảnh</th>
                        <th>Tiêu đề</th>
                        <th>Trạng thái</th>
                        <th>Ngày tạo</th>
                        <th style="width: 100px;">&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($newsList as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>
                                <img src="{{ $item->thumb }}" alt="thumb"
                                    style="width:60px; height:40px; object-fit:cover;">
                            </td>
                            <td>{{ $item->title }}</td>
                            <td>
                                @if ($item->status == 1)
                                    <span class="badge badge-success">Hiển thị</span>
                                @else
                                    <span class="badge badge-secondary">Ẩn</span>
                                @endif
                            </td>
                            <td>{{ $item->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <a href="{{ route('admin.new.edit', $item->id) }}" class="btn btn-sm btn-warning">Sửa</a>
                                <a href="#" class="btn btn-sm btn-danger"
                                    onclick="removeRow({{ $item->id }}, '{{ route('admin.new.delete', $item->id) }}')">
                                    Xóa
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>

    <div class="mt-3">
        {{ $newsList->links() }}
    </div>
    <script>
        function removeRow(id, url) {
            if (confirm('Bạn có chắc muốn xóa tin tức này không?')) {
                $.ajax({
                    type: 'DELETE',
                    datatype: 'JSON',
                    data: {
                        id: id,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    url: url,
                    success: function(result) {
                        if (result.error === false) {
                            alert(result.message);
                            location.reload();
                        } else {
                            alert(result.message);
                        }
                    }
                });
            }
        }
    </script>
@endsection
