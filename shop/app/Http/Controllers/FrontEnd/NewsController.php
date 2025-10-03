<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
use App\Http\Services\About\AboutAdminService;
use App\Http\Services\Menu\MenuService;

class NewsController extends Controller
{
    public function index(AboutAdminService $aboutAdminService, MenuService $menuService)
    {
        $menus = $menuService->getParent();
        $abouts = $aboutAdminService->get();
        $news = News::where('status', 1)
            ->orderByDesc('created_at')
            ->paginate(6);

        return view("frontend.new.index", [
            'title' => 'Tin tức',
            'menus' => $menus,
            'abouts' => $abouts,
            'news' => $news
        ]);
    }

    public function show($id, $slug, AboutAdminService $aboutAdminService, MenuService $menuService)
    {
        $menus = $menuService->getParent();
        $abouts = $aboutAdminService->get();
        $news = News::where('id', $id)->where('status', 1)->firstOrFail();

        return view("frontend.new.show", [
            'title' => 'Tin tức',
            'menus' => $menus,
            'abouts' => $abouts,
            'news' => $news
        ]);
    }
}
