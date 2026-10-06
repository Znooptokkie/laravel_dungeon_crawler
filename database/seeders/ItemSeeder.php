<?php

namespace Database\Seeders;

use App\Models\Armor;
use App\Models\Food;
use App\Models\Inventory;
use App\Models\InventoryItem;
use App\Models\Item;
use App\Models\Player;
use App\Models\Potion;
use App\Models\Weapon;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $food = $this->food();
        $potions = $this->potions();
        $weapons = $this->weapons();
        $armor = $this->armor();

        $this->createInventory($food, $weapons);
    }

    private function createItem(string $type, string $modelClass, array $attributes): Item
    {
        $item = Item::create([
            "type" => $type,
        ]);

        $modelClass::create($attributes + [
            "item_id" => $item->item_id,
        ]);

        return $item;
    }

    public function food(): array
    {
        $rows = [
            // name,              health, magic, stamina
            ["Stale Crust",            1,     0,      1,    ""],
            ["Moldy Cheese",           2,     0,      2,    ""],
            ["Dried Fish",             3,     0,      4,    ""],
            ["Bread",                  5,     0,      5,    "/items/bread.svg"],
            ["Apple",                  6,     0,      6,    ""],
            ["Cooked Egg",             8,     0,      8,    ""],
            ["Roasted Chicken Leg",   12,     0,     10,    ""],
            ["Hearty Stew",           16,     2,     14,    ""],
            ["Roast Boar",            22,     0,     18,    ""],
            ["Traveler's Feast",      30,     5,     25,    ""],
        ];

        $items = [];

        foreach ($rows as [$name, $health, $magic, $stamina, $icon])
        {
            $items[$name] = $this->createItem("food", Food::class, [
                "name"          => $name,
                "health_added"  => $health,
                "magic_added"   => $magic,
                "stamina_added" => $stamina,
                "icon_url"      => $icon,
            ]);
        }

        return $items;
    }

    public function potions(): array
    {
        $rows = [
            // name,                    health, magic, stamina
            ["Murky Water",                  1,     0,      0],
            ["Weak Health Potion",           8,     0,      0],
            ["Weak Mana Potion",             0,     8,      0],
            ["Weak Stamina Potion",          0,     0,      8],
            ["Health Potion",               20,     0,      0],
            ["Mana Potion",                  0,    20,      0],
            ["Stamina Potion",               0,     0,     20],
            ["Elixir of Vigor",             15,     0,     15],
            ["Greater Health Potion",       40,     0,      0],
            ["Adventurer's Elixir",         25,    25,     25],
        ];

        $items = [];

        foreach ($rows as [$name, $health, $magic, $stamina])
        {
            $items[$name] = $this->createItem("potion", Potion::class, [
                "name"          => $name,
                "health_restored"  => $health,
                "magic_restored"   => $magic,
                "stamina_restored" => $stamina,
            ]);
        }

        return $items;
    }

    public function weapons(): array
    {
        $rows = [
            // name,               damage, health, magic, stamina
            ["Wooden Stick",            2,      0,     0,       0,  ""],
            ["Rusty Dagger",            4,      0,     0,       0,  ""],
            ["Stone Club",              6,      0,     0,      -1,  ""],
            ["Bronze Dagger",           7,      0,     0,       1,  ""],
            ["Bronze Sword",            9,      0,     0,       0,  "/items/bronze-sword.svg"],
            ["Iron Axe",               12,      0,     0,      -2,  ""],
            ["Iron Sword",             14,      0,     0,       0,  ""],
            ["Steel Mace",             17,      0,     0,      -2,  ""],
            ["Steel Sword",            20,      0,     0,       2,  ""],
            ["Knight's Longsword",     25,      3,     0,       3,  ""],
        ];

        $items = [];

        foreach ($rows as [$name, $damage, $health, $magic, $stamina, $icon])
        {
            $items[$name] = $this->createItem("weapon", Weapon::class, [
                "name"          => $name,
                "damage"        => $damage,
                "health_added"  => $health,
                "magic_added"   => $magic,
                "stamina_added" => $stamina,
                "icon_url"      => $icon,
            ]);
        }

        return $items;
    }

    public function armor(): array
    {
        $rows = [
            // name,                defense, health, magic, stamina
            ["Tattered Rags",            1,      0,     0,       0],
            ["Cloth Tunic",              2,      0,     1,       0],
            ["Padded Vest",              4,      0,     0,       1],
            ["Leather Jerkin",           6,      2,     0,       1],
            ["Studded Leather",          8,      3,     0,       0],
            ["Chainmail Shirt",         11,      5,     0,      -1],
            ["Bronze Cuirass",          13,      5,     0,      -2],
            ["Iron Breastplate",        16,      8,     0,      -2],
            ["Steel Plate Armor",       20,     10,     0,      -3],
            ["Knight's Full Plate",     25,     15,     0,      -3],
        ];

        $items = [];

        foreach ($rows as [$name, $defense, $health, $magic, $stamina])
        {
            $items[$name] = $this->createItem("armor", Armor::class, [
                "name"          => $name,
                "armor_added"   => $defense,
                "health_added"  => $health,
                "magic_added"   => $magic,
                "stamina_added" => $stamina,
            ]);
        }

        return $items;
    }

    private function createInventory(array $food, array $weapons): void
    {
        $player = Player::find(session("player_id"));

        if ($player == null)
        {
            $player = Player::first();
        }

        $inventory = Inventory::create([
            "player_id" => $player->player_id,
        ]);

        InventoryItem::create([
            "slot"         => 1,
            "quantity"     => 2,
            "inventory_id" => $inventory->inventory_id,
            "item_id"      => $food["Bread"]->item_id,
        ]);

        InventoryItem::create([
            "slot"         => 2,
            "quantity"     => 1,
            "inventory_id" => $inventory->inventory_id,
            "item_id"      => $weapons["Bronze Sword"]->item_id,
        ]);
    }
}
