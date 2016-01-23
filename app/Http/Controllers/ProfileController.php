<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\Zabor\Repositories\Contracts\ItemInterface;
use App\Zabor\User\UserEloquentRepository;
use App\Zabor\User\UserValidator;
use App\Zabor\User\UserManipulator;

class ProfileController extends Controller
{

    public function __construct(ItemInterface $item, 
        UserEloquentRepository $user,
        UserValidator $validator,
        UserManipulator $manipulator
        )
    {
        $this->item = $item;
        $this->user = $user;
        $this->validator = $validator;
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = $this->validator->validate_user_details($request->all());

        if($validator->fails()){
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

    public function updatePass(Request $request)
    {
        $validator = $this->validator->validate_change_pass($request->all());

        if($validator->fails()){
            return redirect('profile/main')
                        ->withErrors($validator)
                        ->withInput();
        }
        
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
}
