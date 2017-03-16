<?php

namespace App\Console\Commands;

use DB;
use File;
use Illuminate\Console\Command;
use App\Zabor\Mysql\Archive;
use App\Zabor\Repositories\Contracts\ItemInterface;
use App\Zabor\Items\ItemManipulator;
use Carbon\Carbon;

class ArchiveItems extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'items:archive';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected $itemRepo;

    protected $item_manipulator;

    /**
     * ArchiveItems constructor.
     *
     * @param ItemInterface $itemRepo
     * @param ItemManipulator $itemManipulator
     */
    public function __construct(
        ItemInterface $itemRepo,
        ItemManipulator $itemManipulator
    ) {
        parent::__construct();
        $this->itemRepo = $itemRepo;
        $this->item_manipulator = $itemManipulator;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $items = $this->itemRepo->getOldItems();

        foreach ($items as $item) {
            if(!$item->images->isEmpty()){
                $image_path = public_path($item->images->first()->image_url);
            }
            DB::beginTransaction();
                Archive::create([
                    'entity_id' => $item->pk_i_id,
                    'type'      => 'item',
                    'content'   => $item->toJson()
                ]);

                $this->item_manipulator->delete($item);
            if(isset($image_path) and File::exists($image_path)){
                DB::rollBack();
            }else{
                DB::commit();
            }
        }

        $this->info('Ads deleted');
    }
}
