<?php

use App\Zabor\Mysql\Category_description;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Zabor\Mysql\Category;

class AddIconsToCategories extends Migration
{

    public function __construct()
    {
        $this->cat_icons = [
            'Автомобили'                => 'car',
            'Аренда'                    => 'banknote',
            'Компьютеры и ноутбуки'     => 'laptop',
            'Сотовые телефоны, планшеты и аксессуары'   => 'mobile',
            'Электроника'               => 'camera-retro',
            'Бытовая техника'           => 'barista-coffee-espresso-streamline',
            'Недвижимость'              => 'building-o',
            'Одежда, обувь и аксессуары'=>'t-shirt',
            'Товары и одежда для спорта'=>'bicycle',
            'Красота и здоровье'        =>'medkit',
            'Охота, рыбалка и походные принадлежности'  =>'paw',
            'Книги и печатные издания'  =>'book',
            'Мебель и интерьер'         =>'armchair-chair-streamline',
            'Животные и растения'       =>'pagelines',
            'Бизнес и компании'         =>'briefcase',
            'Оборудование и материалы'  =>'paint-bucket-streamline',
            'Купля/Продажа - прочее'    =>'dot-3',
            'Работа'                    =>'graduation-cap',
            'Услуги'                    =>'tools',
        ];
    }
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $cats = Category::join('category_description', 'category.pk_i_id', '=', 'category_description.fk_i_category_id')
            ->where('category.fk_i_parent_id', null)
            ->get();

        if(!$cats->isEmpty()){
            foreach($this->cat_icons as $cat_name => $icon){
                $cat = $cats->where('s_name', $cat_name)->first();

                if(!is_null($cat)){
                    Category::where('pk_i_id', $cat->pk_i_id)->update(['s_icon' => $icon]);
                }
            }    
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $cats = Category::all();

        foreach($cats as $cat){
            $cat->update(['s_icon' => null]);
        }
    }
}
