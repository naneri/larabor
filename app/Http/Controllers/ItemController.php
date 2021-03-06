<?php

namespace App\Http\Controllers;

use App\Zabor\Items\ExpirationException;
use App\Http\Requests\ItemManageRequest;
use JavaScript;
use Auth;
use Session;
use Mail;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;
use URL;

use App\Zabor\Mysql\Currency;
use App\Zabor\Items\Contracts\ItemInterface;
use App\Zabor\Categories\Contracts\CategoryInterface;
use App\Zabor\Metas\Contracts\MetaInterface;
use App\Zabor\User\UserEloquentRepository;
use App\Zabor\Items\ItemValidator;
use App\Zabor\Images\ImageCreator;
use App\Zabor\Images\ImageViewSharer;
use App\Zabor\Items\ItemManipulator;
use App\Zabor\Items\ItemOwnerIdentifier;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ItemController extends Controller
{

    protected $item;
    protected $category;
    protected $currency;
    protected $validator;
    protected $meta;
    protected $image;
    protected $item_creator;
    protected $ownerIdentifier;
    protected $user;

    public function __construct(
        ItemInterface $item,
        CategoryInterface $category,
        Currency $currency,
        MetaInterface $meta,
        ItemValidator $validator,
        ImageCreator $image,
        ImageViewSharer $imageSharer,
        ItemManipulator $item_creator,
        ItemOwnerIdentifier $ownerIdentifier,
        UserEloquentRepository $user
    ) {
    
        $this->item      = $item;
        $this->category  = $category;
        $this->currency  = $currency;
        $this->validator = $validator;
        $this->meta      = $meta;
        $this->image     = $image;
        $this->imageSharer      = $imageSharer;
        $this->item_creator     = $item_creator;
        $this->ownerIdentifier  = $ownerIdentifier;
        $this->user      = $user;
    }

    /**
     * @param Request $request
     * @return $this
     */
    public function getAdd(Request $request)
    {
        $currencies = $this->currency->all();

        $categories = $this->category->allWithDescription();

        if (!empty($request->old())) {
            $this->getCategoryAndMetaInfo($request->old());
        }

        $this->imageSharer->shareItemAddImages($request);

        JavaScript::put('categories', $categories);
        
        $item = null;

        return view('item.add', compact(
            'item',
            'currencies',
            'categories'
        ))->with('route', 'add');
    }

    /**
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $user = null;

        $item_data = $request->except('_token', 'category');

        $item_data['category'] = $this->getCategory($request->input('category'));
        $item_data['price']    = trim($item_data['price']);

        // cleaning the input
        $item_data['title']             = clean($item_data['title']);
        $item_data['description']       = clean($item_data['description']);

        if (Auth::check()) {
            $item_data['seller-email'] = Auth::user()->s_email;
            $user = Auth::user();
        }

        $validator = $this->validator->validate($item_data, Auth::check());

        if ($validator->fails()) {
            return redirect('item/add')
                        ->withErrors($validator)
                        ->withInput();
        }

        $days = $this->category->getById($item_data['category'])->i_expiration_days;

        if ($item = $this->item_creator->store($item_data, $user, $days)) {
            $key = $request->input('image_key');

            $this->image->storeAndSaveMultiple(Session::get('item_images.'. $key), $item->pk_i_id);
        }

        if (empty($item->fk_i_user_id)) {
             $message = ['success' => 'Ваше объявление будет опубликовано в течении 12 часов после проверки модератором.'];
        } else {
            $message = [
                'success' => 'ваше объявление успешно опубликовано.'
                ];
        }
        return redirect('/')->with('message', $message);
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @param null $code
     * @return \Illuminate\Http\Response
     */
    public function show($id, $code = null)
    {
        try{
            $item = $this->item->getById($id);
        }catch (ExpirationException $e){
            return response()->view('404', [], 410);
        }

        if ($item->b_enabled == 0) {
            throw new NotFoundHttpException("Item is not enabled");
        }

        $related_items = $this->item->find_related($item);

        $agent = new Agent();

        $is_owner = $this->ownerIdentifier->checkOwnership(
            $item->fk_i_user_id,
            $item->s_secret,
            Auth::user(),
            $code
        );

        if (!$agent->isRobot() && !$is_owner) {
            $this->item_creator->increase_count($id);
        }

        if (!Session::has('item-origin')) {
            Session::put('item-origin', URL::previous());
        }

        return view('item.show', compact(
            'item',
            'code',
            'related_items',
            'is_owner'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ItemManageRequest $request
     * @param  int $id
     * @param null $code
     * @return \Illuminate\Http\Response
     */
    public function edit(ItemManageRequest $request, $id, $code = null)
    {
        Session::put('edit_url', $request->url());

        $item = $this->item->getById($id);

        $cat_list = $this->category->getWithAncestorsArray($item->fk_i_category_id);

        JavaScript::put('cat_list', $cat_list);

        $currencies = $this->currency->all();

        $categories = $this->category->allWithDescription();

        $this->imageSharer->shareItemAddImages($request, $item->images->toArray());

        if (!empty($request->old())) {
            $this->getCategoryAndMetaInfo($request->old());

            $item = null;
        } else {
            $metas = $this->meta->getCategoryMeta($item->fk_i_category_id);

            $meta_data = $item->metas->keyBy('fk_i_field_id')->map(function ($item, $key) {
                return $item->s_value;
            })->toArray();

            view()->share(compact('metas', 'meta_data'));
        }

        JavaScript::put('categories', $categories);
        
        return view('item.add', compact(
            'item',
            'id',
            'currencies',
            'categories',
            'code'
        ))->with('route', 'edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ItemManageRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ItemManageRequest $request, $id)
    {
        $user = null;

        $item_data = $request->except('_token', 'category');

        $item_data['category'] = $this->getCategory($request->input('category'));
        $item_data['price']    = trim($item_data['price']);

        // cleaning the input
        $item_data['title']             = clean($item_data['title']);
        $item_data['description']       = clean($item_data['description']);

        if (Auth::check()) {
            $user = Auth::user();
        }

        $validator = $this->validator->validate($item_data, Auth::check());

        if ($validator->fails()) {
            return redirect(Session::get('edit_url'))
                        ->withErrors($validator)
                        ->withInput();
        }

        if ($item_id = $this->item_creator->edit($item_data, $user, $id)) {
            $key = $request->input('image_key');

            $this->image->storeAndSaveMultiple(Session::get('item_images.'. $key), $item_id);
        }

        return redirect(route('item.show', $item_id));
    }

    /**
     * @param ItemManageRequest $request
     * @param $id
     * @param null $code
     * @return \Illuminate\Http\RedirectResponse
     */
    public function prolong(ItemManageRequest $request, $id, $code = null)
    {
        $item = $this->item->getById($id);

        if ($item->recentlyProlonged()) {
            return redirect()->back()->with('message', [
                'error'   => 'Подождите 1 день для возможности продления'
                ]);
        }

        $days = $this->category->getById($item->fk_i_category_id)->i_expiration_days;

        $this->item_creator->prolong($item, $days);

        return redirect()->back()->with('message', [
                'success'   => 'Объявление продлено'
                ]);
    }

    /**
     * @param ItemManageRequest $request
     * @param $id
     * @param null $code
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ItemManageRequest $request, $id, $code = null)
    {
        $item = $this->item->getById($id);

        if (!$this->item_creator->delete($item)) {
            return redirect()->back()->with('message', [
                'error' => 'Проблемы при удалении объявления'
                ]);
        }

        if ($request->input('redirect') == 'origin') {
            return redirect('/')->with('message', [
                'success' => 'Объявление удалено успешно'
                ]);
        }

        return redirect()->back()->with('message', [
            'success' => 'Объявление удалено успешно'
            ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function contact(Request $request)
    {
        $this->validate($request, [
            'item_id'   => 'required',
            'text'      => 'required',
            'phone'     => 'required'
            ]);

        $item_id = $request->input('item_id');
        $text    = $request->input('text');
        $phone   = $request->input('phone');
        $item    = $this->item->getById($item_id);

        if (!$item->is_actual()) {
            return redirect()->back()->with('message', [
                'error' => 'объявление не актуально'
                ]);
        }

        $email = $item->s_contact_email;

        if (!empty($item->fk_i_user_id)) {
            $user = $this->user->getUserInfo($item->fk_i_user_id);

            $email = $user->s_email;
        }

        Mail::send('emails.item.contact', compact('item', 'email', 'text', 'phone', 'user'), function ($m) use ($email) {
            $m->from('noreply@zabor.kg', 'Служба поддержки Zabor.kg');
            $m->to($email)->subject('Сообщение по вашему объявлению!');
        });

        return redirect()->back()->with('message', [
            'success'   => 'Ваше сообщение отправлено владельцу'
            ]);
    }

    /**
     * @param $category_list
     * @return int|string
     */
    protected function getCategory($category_list)
    {
        $output = '';

        foreach ($category_list as $key => $category_id) {
            if ($key != 0 && is_numeric($category_id)) {
                $output = $category_id;
            }
        }

        return $output;
    }

    /**
     * @param $old
     */
    protected function getCategoryAndMetaInfo($old)
    {
        if ($old['category'][0] != 0) {
            $cat_list = $old['category'];

            $cat_id = end($cat_list);

            $metas = $this->meta->getCategoryMeta($cat_id);

            $meta_data = $old['meta'];
            
            JavaScript::put('cat_list', $cat_list);

            view()->share(compact('metas', 'meta_data'));
        }
    }
}
