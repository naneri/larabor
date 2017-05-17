<?php

namespace App\Console\Commands;

use App\Zabor\Categories\CategoryEloquentRepository;
use Illuminate\Console\Command;
use App\Zabor\Mysql\CategoryStats;
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
     * @var CategoryEloquentRepository
     */
    private $categoryEloquentRepository;

    /**
     * Create a new command instance.
     *
     * @param CategoryEloquentRepository $categoryEloquentRepository
     */
    public function __construct(CategoryEloquentRepository $categoryEloquentRepository)
    {
        parent::__construct();
        $this->categoryEloquentRepository = $categoryEloquentRepository;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // ToDo refactor all this stuff
        foreach ($this->categoryEloquentRepository->getRootCategories()->lists('pk_i_id') as $id) {
            $ids = $this->categoryEloquentRepository->getIdWithChildrenIds($id);

            $item_count = Item::whereIn('fk_i_category_id', $ids)
                ->where('dt_expiration', '>=', Carbon::now())
                ->where('b_enabled', 1)
                ->where('b_active', 1)
                ->count();

            CategoryStats::where('fk_i_category_id', $id)->update(['i_num_items' => $item_count]);
        }
        $this->comment('categories updated');
    }
}
