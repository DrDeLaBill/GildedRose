<?php

declare(strict_types=1);

namespace GildedRose;

final class GildedRose
{
    /**
     * @var Item[]
     */
    private $items;

    public function __construct(array $items)
    {
        $this->items = $items;
    }

    public function update_default_product(Item $product): Item
    {
        if ($product->sell_in >= 0)
            $damage_multipler = 1;
        else
            $damage_multipler = 2;
        $product->quality -= 1 * $damage_multipler;
        if ($product->quality < 0)
            $product->quality = 0;
        return $product;
    }

    public function update_aged_brie(Item $aged_brie): Item
    {
            if ($aged_brie->sell_in > 0)
                $aged_brie->quality += 1;
            if ($aged_brie->quality > 50)
                $aged_brie->quality = 50;
            return $aged_brie;
    }

    public function update_sulfuras(Item $sulfuras): Item
    {
        $sulfuras->quality = 80;
        return $sulfuras;
    }

    public function update_backstage_passes(Item $backstage_passes): Item
    {
        if ($backstage_passes->sell_in > 10)
            $growth = 1;
        else if ($backstage_passes->sell_in > 5)
            $growth = 2;
        else if ($backstage_passes->sell_in > 0)
            $growth = 3;
        else
        {
            $backstage_passes->quality = 0;
            return $backstage_passes;
        }
        $backstage_passes->quality += $growth;
        if ($backstage_passes->quality > 50)
            $backstage_passes->quality = 50;
        return $backstage_passes;
    }

    public function update_conjured(Item $conjured): Item
    {
        if ($conjured->sell_in >= 0)
          $damage_multipler = 1;
        else
          $damage_multipler = 2;
        $conjured->quality -= 2 * $damage_multipler;
        if ($conjured->quality < 0)
            $conjured->quality = 0;
        return $conjured;
    }

    public function updateQuality(): void
    {
        $update_methods = [
                'Aged Brie' => 'update_aged_brie',
                'Sulfuras, Hand of Ragnaros' => 'update_sulfuras',
                'Backstage passes to a TAFKAL80ETC concert' => 'update_backstage_passes',
                'Conjured Mana Cake' => 'update_conjured',
                'Default product' => 'update_default_product',
        ];

        foreach ($this->items as $item) {
            if (in_array($item->name, array_keys($update_methods)))
                $function = $update_methods[$item->name];
            else
                $function = $update_methods['Default product'];
            $item = $this->$function($item);
            $item->sell_in -= 1;
        }
    }
}
?>
