<?php

declare(strict_types=1);

# namespace Tests;

require __DIR__ . '\..\vendor\autoload.php';

use GildedRose\GildedRose;
use GildedRose\Item;
use PHPUnit\Framework\TestCase;

class GildedRoseTest extends TestCase
{
    public function testFoo(): void
    {
        $items = [new Item('foo', 0, 0)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame('foo', $items[0]->name);
    }

    public function test_simple_product_one(): void
    {
        $items = [new Item('qwerty', 0, 0)];
        $hotel = new GildedRose($items);
        $hotel->updateQuality();
        $this->assertEquals(0, $items[0]->quality);
        $this->assertEquals(-1, $items[0]->sell_in);
    }

    public function test_simple_product_two(): void
    {
        $items = [new Item('qwerty', 10, 10)];
        $hotel = new GildedRose($items);
        $hotel->updateQuality();
        $this->assertEquals(9, $items[0]->quality);
        $this->assertEquals(9, $items[0]->sell_in);
    }

    public function test_aged_bri(): void
    {
        $items = [new Item('Aged Brie', 5, 50)];
        $hotel = new GildedRose($items);
        for ($i = 0; $i < 5; $i++)
            $hotel->updateQuality();
        $this->assertEquals(50, $items[0]->quality);
        $this->assertEquals(0, $items[0]->sell_in);
    }

    public function test_sulfuras(): void
    {
        $items = [new Item('Sulfuras, Hand of Ragnaros', 5, -8)];
        $hotel = new GildedRose($items);
        for ($i = 0; $i < 10; $i++)
            $hotel->updateQuality();
        $this->assertEquals(80, $items[0]->quality);
        $this->assertEquals(-5, $items[0]->sell_in);
    }

    public function test_backstage_one(): void
    {
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 5, 50)];
        $hotel = new GildedRose($items);
        for ($i = 0; $i < 10; $i++)
            $hotel->updateQuality();
        $this->assertEquals(0, $items[0]->quality);
        $this->assertEquals(-5, $items[0]->sell_in);
    }

    public function test_backstage_two(): void
    {
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 30, 10)];
        $hotel = new GildedRose($items);
        for ($i = 0; $i < 10; $i++)
            $hotel->updateQuality();
        $this->assertEquals(20, $items[0]->quality);
        $this->assertEquals(20, $items[0]->sell_in);
    }

    public function test_backstage_three(): void
    {
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 12, 10)];
        $hotel = new GildedRose($items);
        for ($i = 0; $i < 10; $i++)
            $hotel->updateQuality();
        $this->assertEquals(31, $items[0]->quality);
    }

    public function test_conjured(): void
    {
        $items = [new Item('Conjured Mana Cake', 5, 31)];
        $hotel = new GildedRose($items);
        for ($i = 0; $i < 10; $i++)
            $hotel->updateQuality();
        $this->assertEquals(3, $items[0]->quality);
    }
}
?>
