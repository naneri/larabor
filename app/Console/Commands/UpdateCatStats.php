<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Zabor\Mysql\Category;
use App\Zabor\Repositories\CategoryEloquentRepository as CatRepo;
use App\Zabor\Mysql\Category_stats;
use App\Zabor\Mysql\Item;
use Carbon\Carbon;

class UpdateCatStats extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cat:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        // ToDo refactor all this stuff
        foreach(app(CatRepo::class)->getRootCategories()->lists('pk_i_id') as $id){
            $ids = app(CatRepo::class)->getIdWithChildrenIds($id);

            $item_count = Item::whereIn('fk_i_category_id', $ids)
                ->where('dt_expiration', '>=', Carbon::now())
                ->where('b_enabled', 1)
                ->where('b_active', 1)
                ->count();

            Category_stats::where('fk_i_category_id', $id)->update(['i_num_items' => $item_count]);
        }
        $this->comment('categories updated');
    }
}
