<?php

namespace App\Console\Commands;

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

    /**
     * Create a new command instance.
     *
     * @return void
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
     *
     * @return mixed
     */
    public function handle()
    {
        // only executing in the morning when site load time is not high
        if (Carbon::now()->hour > 0 && Carbon::now()->hour < 7) {
            $items = $this->itemRepo->getOldItems();

            foreach ($items as $item) {
                Archive::create([
                    'entity_id' => $item->pk_i_id,
                    'type'      => 'item',
                    'content'   => $item->toJson()
                    ]);

                $this->item_manipulator->delete($item);
            }

            $this->info('Ads deleted');
        } else {
            $this->info('Wrong time');
        }
    }
}
