<?php

namespace App\Http\View\Composers;

use App\Models\Page;
use Illuminate\View\View;
use Illuminate\Support\Facades\Route;

class PageInfoComposer
{

/**
 * Bind data to the view.
 *
 * @param  \Illuminate\View\View  $view
 * @return void
 */
    public function compose(View $view)
    {
        $pages = Page::all()->keyBy('name');
        $route = Route::currentRouteName();
        $page_info = config('custom.page_info');

        $page_meta_tags = null;

        if (isset($page_info[$route])) {
            $route = $page_info[$route];
        }
        if (isset($pages[$route])) {
            $page_meta_tags = $pages[$route];
        }

        $view->with('page_meta_tags', $page_meta_tags);
    }
}
