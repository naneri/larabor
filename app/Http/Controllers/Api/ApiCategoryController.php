<?php

namespace App\Http\Controllers\Api;

use Log;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Zabor\Metas\Contracts\MetaInterface;

class ApiCategoryController extends Controller
{

    protected $meta;

    public function __construct(MetaInterface $meta)
    {
        $this->meta = $meta;
    }

    /**
     * @param $category_id
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getCategoryMetaHtml($category_id, Request $request)
    {
        $metas = $this->meta->getCategoryMeta($category_id);

        $meta_data = $request->get('meta');

        return view('item._meta', compact('metas', 'meta_data'));
    }
}
