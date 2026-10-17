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
            ["Stale Crust",            1,     0,      1,    "/items/food/stale_crust.png"],
            ["Moldy Cheese",           2,     0,      2,    "/items/food/moldy_cheese.png"],
            ["Dried Fish",             3,     0,      4,    "/items/food/dried_fish.png"],
            ["Bread",                  5,     0,      5,    "/items/food/bread.png"],
            ["Apple",                  6,     0,      6,    "/items/food/apple.png"],
            ["Cooked Egg",             8,     0,      8,    "/items/food/cooked_egg.png"],
            ["Roasted Chicken Leg",   12,     0,     10,    "/items/food/roasted_chicken_leg.png"],
            ["Hearty Stew",           16,     2,     14,    "/items/food/hearty_stew.png"],
            ["Roast Boar",            22,     0,     18,    "/items/food/roasted_boar.png"],
            ["Traveler's Feast",      30,     5,     25,    "/items/food/travelers_feast.png"],
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
            ["Weak Health Potion",           8,     0,      0, "/items/potions/weak_health_potion.png"],
            ["Weak Mana Potion",             0,     8,      0, "/items/potions/weak_mana_potion.png"],
            ["Weak Stamina Potion",          0,     0,      8, "/items/potions/weak_stamina_potion.png"],
            ["Health Potion",               20,     0,      0, "/items/potions/health_potion.png"],
            ["Mana Potion",                  0,    20,      0, "/items/potions/mana_potion.png"],
            ["Stamina Potion",               0,     0,     20, "/items/potions/stamina_potion.png"],
            ["Elixir of Vigor",             15,     0,     15, "/items/potions/elixir_of_vigor.png"],
            ["Greater Health Potion",       40,     0,      0, "/items/potions/greater_health_potion.png"],
            ["Greater Mana Potion",          0,     40,     0, "/items/potions/greater_mana_potion.png"],
            ["Greater Stamina Potion",       0,     0,     40, "/items/potions/greater_stamina_potion.png"],
            ["Adventurer's Elixir",         25,    25,     25, "/items/potions/adventurers_elixir.png"],
        ];

        $items = [];

        foreach ($rows as [$name, $health, $magic, $stamina, $icon])
        {
            $items[$name] = $this->createItem("potion", Potion::class, [
                "name"          => $name,
                "health_restored"  => $health,
                "magic_restored"   => $magic,
                "stamina_restored" => $stamina,
                "icon_url"         => $icon
            ]);
        }

        return $items;
    }

    public function weapons(): array
    {
        $rows = [
            // name,                rarity,       damage, health, magic, stamina
            ["Wooden Stick",        "common",                2,      0,     0,       0,  "/items/weapons/wooden_stick.png"],
            ["Rusty Dagger",        "common",                4,      0,     0,       0,  "/items/weapons/rusty_dagger.png"],
            ["Stone Club",          "common",                6,      0,     0,      -1,  "/items/weapons/stone_club.png"],
            ["Bronze Dagger",       "common",                7,      0,     0,       1,  "/items/weapons/bronze_dagger.png"],
            ["Bronze Sword",        "common",                9,      0,     0,       0,  "/items/weapons/bronze_sword.png"],
            ["Iron Axe",            "common",               12,      0,     0,      -2,  "/items/weapons/iron_axe.png"],
            ["Iron Sword",          "common",               14,      0,     0,       0,  "/items/weapons/iron_sword.png"],
            ["Steel Mace",          "rare",                 17,      0,     0,      -2,  "/items/weapons/steel_mace.png"],
            ["Steel Sword",         "epic",                 20,      0,     0,       2,  "/items/weapons/steel_sword.png"],
            ["Knight's Longswor",   "legendary",            25,      3,     0,       3,  "/items/weapons/knights_longsword.png"],
        ];

        $items = [];

        foreach ($rows as [$name, $rarity, $damage, $health, $magic, $stamina, $icon])
        {
            $items[$name] = $this->createItem("weapon", Weapon::class, [
                "name"          => $name,
                "rarity"        => $rarity,
                "damage"        => $damage,
                "health_added"  => $health,
                "magic_added"   => $magic,
                "stamina_added" => $stamina,
                "icon_url"      => $icon,
            ]);
        }

        return $items;
    }

    public function pants(): array
    {
        $rows = [
            // name,                   rarity,      defense, armorPart, health, magic, stamina
            ["Tattered Trousers",       "common",         1, "legs",        0,     0,       0,      "/items/armor/legs/tattered_trousers.png"],
            ["Cloth Pants",             "common",         2, "legs",        0,     0,       1,      "/items/armor/legs/cloth_pants.png"],
            ["Leather Leggings",        "common",         4, "legs",        1,     0,       1,      "/items/armor/legs/leather_leggings.png"],
            ["Padded Trousers",         "common",         6, "legs",        2,     0,       1,      "/items/armor/legs/padded_trousers.png"],
            ["Studded Leather Pants",   "common",         8, "legs",        3,     0,       0,      "/items/armor/legs/studded_leather_pants.png"],
            ["Chainmail Leggings",      "common",        11, "legs",        4,     0,      -1,      "/items/armor/legs/chainmail_leggings.png"],
            ["Bronze Greaves",          "common",        13, "legs",        5,     0,      -1,      "/items/armor/legs/bronze_greaves.png"],
            ["Iron Legguards",          "rare",          16, "legs",        7,     0,      -2,      "/items/armor/legs/iron_legguards.png"],
            ["Steel Plate Leggings",    "epic",          20, "legs",        9,     0,      -2,      "/items/armor/legs/steel_plate_leggings.png"],
            ["Legguards of the Knight", "legendary",     25, "legs",       12,     1,      -2,      "/items/armor/legs/legguards_of_the_knight.png"],
        ];

        $items = [];

        foreach ($rows as [$name, $rarity, $defense, $armorPart, $health, $magic, $stamina, $icon])
        {
            $items[$name] = $this->createItem("armor", Armor::class, [
                "name"          => $name,
                "rarity"        => $rarity,
                "armor_added"   => $defense,
                "armor_part"    => $armorPart,
                "health_added"  => $health,
                "magic_added"   => $magic,
                "stamina_added" => $stamina,
                "icon_url"      => $icon
            ]);
        }

        return $items;
    }

    public function helmets(): array
    {
        $rows = [
            // name,                        rarity,      defense,   armorPart, health, magic, stamina
            ["Tattered Hood",               "common",         1,    "helmet",      0,     0,       0,   "/items/armor/helm/tattered_hood.png"],
            ["Cloth Cap",                   "common",         2,    "helmet",      0,     1,       0,   "/items/armor/helm/cloth_cap.png"],
            ["Leather Hood",                "common",         4,    "helmet",      1,     0,       1,   "/items/armor/helm/leather_hood.png"],
            ["Padded Coif",                 "common",         6,    "helmet",      2,     0,       1,   "/items/armor/helm/padded_coif.png"],
            ["Studded Leather Cap",         "common",         8,    "helmet",      3,     0,       0,   "/items/armor/helm/studded_leather_cap.png"],
            ["Chainmail Coif",              "common",        11,    "helmet",      4,     0,      -1,   "/items/armor/helm/chainmail_coif.png"],
            ["Bronze Helmet",               "common",        13,    "helmet",      5,     0,      -1,   "/items/armor/helm/bronze_helmet.png"],
            ["Iron Helmet",                 "rare",          16,    "helmet",      7,     0,      -2,   "/items/armor/helm/iron_helmet.png"],
            ["Steel Greathelm",             "epic",          20,    "helmet",      9,     0,      -2,   "/items/armor/helm/steel_greathelm.png"],
            ["Knight's Greathelm",          "legendary",     25,    "helmet",     12,     2,      -2,   "/items/armor/helm/knight's_greathelm.png"],
        ];

        $items = [];

        foreach ($rows as [$name, $rarity, $defense, $armorPart, $health, $magic, $stamina, $icon])
        {
            $items[$name] = $this->createItem("armor", Armor::class, [
                "name"          => $name,
                "rarity"        => $rarity,
                "armor_added"   => $defense,
                "armor_part"    => $armorPart,
                "health_added"  => $health,
                "magic_added"   => $magic,
                "stamina_added" => $stamina,
                "icon_url"      => $icon
            ]);
        }

        return $items;
    }

    public function armor(): array
    {
        $rows = [
            // name,                 rarity,      defense, armorPart, health, magic, stamina
            ["Tattered Rags",        "common",         1, "body",        0,     0,       0,     "/items/armor/body/tattered_rags.png"],
            ["Cloth Tunic",          "common",         2, "body",        0,     1,       0,     "/items/armor/body/cloth_tunic.png"],
            ["Padded Vest",          "common",         4, "body",        0,     0,       1,     "/items/armor/body/padded_vest.png"],
            ["Leather Jerkin",       "common",         6, "body",        2,     0,       1,     "/items/armor/body/leather_jerkin.png"],
            ["Studded Leather",      "common",         8, "body",        3,     0,       0,     "/items/armor/body/studded_leather.png"],
            ["Chainmail Shirt",      "common",        11, "body",        5,     0,      -1,     "/items/armor/body/chainmail_shirt.png"],
            ["Bronze Cuirass",       "common",        13, "body",        5,     0,      -2,     "/items/armor/body/bronze_cuirass.png"],
            ["Iron Breastplate",     "rare",          16, "body",        8,     0,      -2,     "/items/armor/body/iron_breastplate.png"],
            ["Steel Plate Armor",    "epic",          20, "body",       10,     0,      -3,     "/items/armor/body/steel_plate_armor.png"],
            ["Knight's Full Plate",  "legendary",     25, "body",       15,     0,      -3,     "/items/armor/body/knights_full_plate.png"],
        ];

        $items = [];

        foreach ($rows as [$name, $rarity, $defense, $armorPart, $health, $magic, $stamina, $icon])
        {
            $items[$name] = $this->createItem("armor", Armor::class, [
                "name"          => $name,
                "rarity"        => $rarity,
                "armor_added"   => $defense,
                "armor_part"    => $armorPart,
                "health_added"  => $health,
                "magic_added"   => $magic,
                "stamina_added" => $stamina,
                "icon_url"      => $icon
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
