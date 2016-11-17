<?php

namespace App\Http\Controllers\Api;

use Log;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Zabor\Repositories\Contracts\CategoryInterface;
use App\Zabor\Repositories\Contracts\MetaInterface;

class ApiCategoryController extends Controller
{

    public function __construct(MetaInterface $meta)
    {
        $this->meta = $meta;
    }

    /**
     * [getCategoryMetaHtml description]
     *
     * @param  [type] $category_id [description]
     * @return [type]              [description]
     */
    public function getCategoryMetaHtml($category_id, Request $request)
    {

        $metas = $this->meta->getCategoryMeta($category_id);

        $meta_data = $request->get('meta');

        return view('item._meta', compact('metas', 'meta_data'));
    }
}
