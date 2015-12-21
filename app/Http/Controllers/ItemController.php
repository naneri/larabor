<?php

namespace App\Http\Controllers;

use JavaScript;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Zabor\Mysql\Currency;
use App\Zabor\Repositories\Contracts\ItemInterface;
use App\Zabor\Repositories\Contracts\CategoryInterface;
use App\Zabor\Validators\ItemValidator;

class ItemController extends Controller
{

    public function __construct(
        ItemInterface $item, 
        CategoryInterface $category,
        Currency $currency,
        ItemValidator $validator)
    {
        $this->item      = $item;
        $this->category  = $category;
        $this->currency  = $currency;
        $this->validator = $validator;
    }

    /**
     * [getAdd description]
     * 
     * @return [type] [description]
     */
    public function getAdd()
    {
        $currencies = $this->currency->all();

        $categories = $this->category->allWithDescription();

        JavaScript::put('categories', $categories);

        return view('item.add', compact('currencies', 'categories'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
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

        $item = $this->item->store($item_data, $user, $days);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = $this->item->getById($id);
       
        return view('item.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
