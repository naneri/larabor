<?php

namespace App\Http\Controllers;

use JavaScript;
use Auth;
use Log;
use Session;
use File;
use App;
use Response;
use Validator;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Zabor\Mysql\Currency;
use App\Zabor\Repositories\Contracts\ItemInterface;
use App\Zabor\Repositories\Contracts\CategoryInterface;
use App\Zabor\Repositories\Contracts\MetaInterface;
use App\Zabor\Validators\ItemValidator;
use App\Zabor\Images\ImageCreator;
use App\Zabor\Items\ItemCreator;
use App\Zabor\Items\ItemOwnerIdentifier;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ItemController extends Controller
{

    public function __construct(
        ItemInterface $item, 
        CategoryInterface $category,
        Currency $currency,
        MetaInterface $meta,
        ItemValidator $validator,
        ImageCreator $image,
        ItemCreator $item_creator,
        ItemOwnerIdentifier $ownerIdentifier)
    {
        $this->item      = $item;
        $this->category  = $category;
        $this->currency  = $currency;
        $this->validator = $validator;
        $this->meta      = $meta;
        $this->image     = $image;
        $this->item_creator = $item_creator;
        $this->ownerIdentifier = $ownerIdentifier;
    }

    /**
     * [getAdd description]
     * 
     * @return [type] [description]
     */
    public function getAdd(Request $request)
    {

        $currencies = $this->currency->all();

        $categories = $this->category->allWithDescription();

        if(!empty($request->old())){

            $cat_list = $request->old('category');

            $image_key = $request->old('image_key');

            $cat_id = end($cat_list);

            $metas = $this->meta->getCategoryMeta($cat_id);

            $meta_data = $request->old('meta');
            
            JavaScript::put('cat_list', $cat_list);

            $images = Session::get('item_images.' . $image_key);

            JavaScript::put('dz_images', $images);

            view()->share(compact('metas', 'meta_data', 'images'));

        }else{

            $image_key = str_random(10);

            Session::put('item_images.' . $image_key, []);
        }

        JavaScript::put('categories', $categories);
        
        return view('item.add', compact(
            'currencies', 
            'categories',
            'image_key'
        ));
    }

    /**
     * [storeImage description]
     * 
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function storeImage(Request $request)
    {
        $key = $request->header('imageKey');

        $rules = [
            'file'  => 'required|image|max:2048|mimes:jpeg,png'
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return Response::json([                
                  'error' => true,                
                  'message' => 'Some problems while saving',
                  'code' => 400            
                    ], 400);        
        }

        $file = $request->file('file');

        $ext = $file->getClientOriginalExtension();

        $name = str_random(10) . '.'. $ext;

        $image = [
            'name' => $name,
            'path' => url("uploads/temp/{$name}")
        ];

        $file->move('uploads/temp', $name);

        Session::push('item_images.'. $key, $image);

        return Response::json([
            'name'      => $name,
            'message'   => 'uploaded',
            'code'      => 200
            ], 200);

    }

    /**
     * [removeImage description]
     * 
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function removeImage(Request $request)
    {

        $name = $request->input('name');

        $key = $request->header('imageKey');

        try{
            $id = array_search(['name' => $name], Session::get('item_images.'. $key));

            $array = array_except(Session::get('item_images.'. $key), [$id]);

            Session::put('item_images.'. $key, $array);
        }catch(Exception $e){

            return Response::json([
            'message'   => 'troubles',
            'code'      => 400
            ], 400);
        }

        return Response::json([
            'message'   => 'deleted succesfully',
            'code'      => 200
            ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = null;

        $category_id = $this->getCategory($request->input('category'));

        $item_data = $request->except('_token', 'category');

        $item_data['category_id'] = $category_id;

        if(Auth::check()){
            $item_data['seller-email'] = Auth::user()->s_email;
            $user = Auth::user();
        }

        $validator = $this->validator->validate($item_data);

        if($validator->fails()){
            return redirect('item/add')
                        ->withErrors($validator)
                        ->withInput();
        }

        $days = $this->category->getById($item_data['category_id'])->i_expiration_days;

        if($item_id = $this->item_creator->store($item_data, $user, $days, Auth::user()))
        {

            $key = $request->input('image_key');

            $this->image->storeAndSaveMultiple(Session::get('item_images.'. $key), $item_id);

        }

        return redirect('/');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $code = null)
    {

        $item = $this->item->getById($id);

        $is_owner = $this->ownerIdentifier->checkOwnership(
                $item->fk_i_user_id, 
                $item->s_secret, 
                Auth::user(), 
                $code
            );

        return view('item.show', compact('item', 'is_owner', 'code'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request, $code = null)
    {
        $item = $this->item->getById($id, $code = null);

        $cat_list = $this->category->getWithAncestorsArray($item->fk_i_category_id);

        JavaScript::put('cat_list', $cat_list);

        $is_owner = $this->ownerIdentifier->checkOwnership(
                $item->fk_i_user_id, 
                $item->s_secret, 
                Auth::user(), 
                $code
            );

        if(!$is_owner){
            throw new NotFoundHttpException('wrong page');
        }

        $currencies = $this->currency->all();

        $categories = $this->category->allWithDescription();

        if(!empty($request->old())){

            $image_key = $request->old('image_key');

        }else{

            $image_key = str_random(10);

            Session::put('item_images.' . $image_key, []);
        }

        JavaScript::put('categories', $categories);
        
        return view('item.add', compact(
            'currencies', 
            'categories',
            'image_key'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * [getCategory description]
     * @param  [type] $category_list [description]
     * @return [type]                [description]
     */
    protected function getCategory($category_list)
    {
        $output = '';

        foreach($category_list as $key => $category_id){
            if($key != 0 && is_numeric($category_id)){
                $output = $category_id;
            }
        }

        return $output;
    }
}
