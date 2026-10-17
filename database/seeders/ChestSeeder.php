<?php

namespace Database\Seeders;

use App\Models\Chest;
use App\Models\ChestItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Services\ConsumablesLootService;
use App\Services\GearLootService;

class ChestSeeder extends Seeder
{
    public function __construct(
        private ConsumablesLootService $consumableLootService,
        private GearLootService $gearLootService
    )
    {}
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->chest();
        $this->addChestLoot();
        // $this->testChest();
    }

    public function chest()
    {
        Chest::create([
            "lockpicking_level_req" => 1
        ]);

        Chest::create([
            "lockpicking_level_req" => 1
        ]);
    }

    public function addChestLoot()
    {
        $getChests = Chest::get();

        foreach ($getChests as $chest)
        {
            $food = $this->consumableLootService->getConsumable("food");
            $potion = $this->consumableLootService->getConsumable("potion");
            $gear = $this->gearLootService->getGear();

            $allItems = [
                $food,
                $potion,
                $gear
            ];

            foreach ($allItems as $item)
            {

                ChestItem::create([
                    "quantity" => $item["quantity"],
                    "chest_id" => $chest->chest_id,
                    "item_id"  => $item["item"]->item_id
                ]);
            }
        }
    }

    public function testChest()
    {
        ChestItem::create([
            "quantity"  => 2,
            "chest_id"  => 1,
            "item_id"   => 26
        ]);
    }
}
