<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\New\CreateNewsRequest;
use App\Http\Services\UploadService;
use App\Models\News;
use Illuminate\Support\Facades\Session;

class NewsAdminController extends Controller
{
    public function create()
    {
        return view('admin.new.add', [
            'title' => 'Thêm tin tức',
        ]);
    }

    public function store(CreateNewsRequest $request)
    {
        try {
            $fileUploaded = app(UploadService::class)->store($request, "thumb");
            $thumbPath = null;

            if (!$fileUploaded["error"] && !empty($fileUploaded["url"])) {
                $thumbPath = $fileUploaded["url"];
            }

            News::create([
                'title'   => $request->input('title'),
                'content' => $request->input('content'),
                'thumb'   => $thumbPath,
                'status'  => $request->input('status'),
            ]);

            Session::flash('success', 'Thêm tin tức thành công');
            return redirect()->back();
        } catch (\Exception $err) {
            Session::flash('error', 'Thêm tin tức lỗi: ' . $err->getMessage());
            return redirect()->back()->withInput();
        }
    }
    public function index()
    {
        $newsList = News::orderBy('created_at', 'desc')->paginate(10);

        return view('admin.new.list', [
            'title' => 'Danh sách tin tức',
            'newsList' => $newsList,
        ]);
    }

    public function edit($id)
    {
        $news = News::findOrFail($id);

        return view('admin.new.edit', [
            'title' => 'Chỉnh sửa tin tức',
            'news' => $news,
        ]);
    }

    public function update(CreateNewsRequest $request, $id)
    {
        try {
            $news = News::findOrFail($id);

            // Nếu có ảnh mới thì upload
            $fileUploaded = app(\App\Http\Services\UploadService::class)->store($request, "thumb", "news");
            if (!$fileUploaded["error"] && !empty($fileUploaded["url"])) {
                $news->thumb = $fileUploaded["url"];
            }

            // Cập nhật dữ liệu
            $news->title   = $request->title;
            $news->content = $request->content;
            $news->status  = $request->status;
            $news->save();

            Session::flash('success', 'Cập nhật tin tức thành công');
            return redirect()->route('admin.new.list');
        } catch (\Exception $err) {
            Session::flash('error', 'Cập nhật lỗi: ' . $err->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $news = News::findOrFail($id);
            $news->delete();

            return response()->json([
                'error' => false,
                'message' => 'Xóa tin tức thành công'
            ]);
        } catch (\Exception $err) {
            return response()->json([
                'error' => true,
                'message' => 'Xóa thất bại: ' . $err->getMessage()
            ]);
        }
    }
}
