# -*- coding: utf-8 -*-
import unittest

from gilded_rose import Item, GildedRose


class GildedRoseTest(unittest.TestCase):
    def test_foo(self):
        items = [Item("foo", 0, 0)]
        gilded_rose = GildedRose(items)
        gilded_rose.update_quality()
        self.assertEquals("foo", items[0].name)

    def test_simple_product_one(self):
        hotel = GildedRose([Item('qwerty', 0, 0)])
        hotel.update_quality()
        self.assertEquals(0, hotel.items[0].quality)
        self.assertEquals(-1, hotel.items[0].sell_in)

    def test_simple_product_two(self):
        hotel = GildedRose([Item('qwerty', 10, 10)])
        hotel.update_quality()
        self.assertEquals(9, hotel.items[0].quality)
        self.assertEquals(9, hotel.items[0].sell_in)

    def test_aged_bri(self):
        hotel = GildedRose([Item('Aged Brie', 5, 50)])
        for _ in range(5):
            hotel.update_quality()
        self.assertEquals(50, hotel.items[0].quality)
        self.assertEquals(0, hotel.items[0].sell_in)

    def test_sulfuras(self):
        hotel = GildedRose([Item('Sulfuras, Hand of Ragnaros', 5, -8)])
        for _ in range(10):
            hotel.update_quality()
        self.assertEquals(80, hotel.items[0].quality)
        self.assertEquals(-5, hotel.items[0].sell_in)

    def test_backstage_one(self):
        hotel = GildedRose([Item('Backstage passes to a TAFKAL80ETC concert', 5, 50)])
        for _ in range(10):
            hotel.update_quality()
        self.assertEquals(0, hotel.items[0].quality)
        self.assertEquals(-5, hotel.items[0].sell_in)

    def test_backstage_two(self):
        hotel = GildedRose([Item('Backstage passes to a TAFKAL80ETC concert', 30, 10)])
        for _ in range(10):
            hotel.update_quality()
        self.assertEquals(20, hotel.items[0].quality)
        self.assertEquals(20, hotel.items[0].sell_in)

    def test_backstage_three(self):
        hotel = GildedRose([Item('Backstage passes to a TAFKAL80ETC concert', 12, 10)])
        for _ in range(10):
            hotel.update_quality()
        self.assertEquals(31, hotel.items[0].quality)

    def test_conjured(self):
        hotel = GildedRose([Item('Conjured Mana Cake', 5, 31)])
        for _ in range(10):
            hotel.update_quality()
        self.assertEquals(3, hotel.items[0].quality)


if __name__ == '__main__':
    unittest.main()
