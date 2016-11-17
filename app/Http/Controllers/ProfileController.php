<?php namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use Auth;
use Excel;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Zabor\Repositories\Contracts\ItemInterface;
use App\Zabor\User\UserEloquentRepository;
use App\Zabor\User\UserValidator;
use App\Zabor\User\UserManipulator;
use App\Zabor\Mysql\Item;
use Carbon\Carbon;

class ProfileController extends Controller
{

    public function __construct(
        ItemInterface $item,
        UserEloquentRepository $user,
        UserValidator $validator,
        UserManipulator $manipulator
    ) {
    
        $this->item             = $item;
        $this->user             = $user;
        $this->validator        = $validator;
        $this->user_manipulator = $manipulator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = $this->user->getUserInfo(Auth::id());

        return view('profile.main', compact('user'));
    }


    public function getAds()
    {
        $items = $this->item->getUserAds(Auth::id());

        return view('profile.ads', compact('items'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = $this->validator->validate_user_details($request->all());

        if ($validator->fails()) {
            return redirect('profile/main')
                        ->withErrors($validator)
                        ->withInput();
        }

        $this->user_manipulator->update_details(
            Auth::id(),
            $request->all()
        );

        return redirect('profile/main')->with('message', [
                'success' => 'Ваш профиль успешно обновлён'
            ]);
    }

    /**
     * @param ChangePasswordRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePass(ChangePasswordRequest $request)
    {
        $this->user_manipulator->updatePassword($request->user(), $request->get('new-pass'));

        return redirect(url('profile/main'))->with('message', [
            'success'   => 'Пароль успешно изменён'
        ]);
    }

    /**
     * @param $user_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showAds($user_id)
    {
        $user   = $this->user->getUserInfo($user_id);

        $items  = $this->item->getUserActiveAds($user_id);

        return view('profile.show-ads', compact('items', 'user'));
    }

    /**
     * [getAdsExport description]
     * @return [type] [description]
     */
    public function getAdsExport()
    {
        $user = Auth::user();

        return view('profile.ads-export', compact('user'));
    }

    /**
     * [generateExcel description]
     * @return [type] [description]
     */
    public function getGenerateExcel()
    {
        if (!Auth::user()->canExport()) {
            return redirect()->back()->with([
                'message' => [
                    'error' => 'Вы достигли лимита. Вы сможете заново экспортировать объявления завтра'
                ]]);
        }

        $items = collect($this->item->getUserAdsForExport(Auth::id()))->groupBy('category')->toArray();
        
        $path = Auth::user()->getExportPath() ?: "export/excel/" . str_random(10);
        
        $result = Excel::create('price', function ($excel) use ($items) {
                $excel->sheet('Excel sheet', function ($sheet) use ($items) {
                    $sheet->loadView('profile.excel', compact('items'));
                });
        })->store('xlsx', public_path($path));

        if ($result) {
            $this->user->updateAdsExportDate(Auth::id(), $path);

            return redirect()->back()->with([
                'message'   => [
                    'success' => 'Файл сгенерирован'
                ]]);
        }
    }
}
