# -*- coding: utf-8 -*-

class GildedRose(object):

    def __init__(self, items):
        self.items = items

    def update_quality(self):
        def update_default_product(product):
            damage_multipler = 1 if product.sell_in >= 0 else 2
            product.quality -= 1 * damage_multipler
            if product.quality < 0:
                product.quality = 0
            return product

        def update_aged_brie(aged_brie):
            if aged_brie.sell_in > 0:
                aged_brie.quality += 1
            if aged_brie.quality > 50:
                aged_brie.quality = 50
            return aged_brie

        def update_sulfuras(sulfuras):
            sulfuras.quality = 80
            return sulfuras

        def update_backstage_passes(backstage_passes):
            if backstage_passes.sell_in > 10:
                growth = 1
            elif backstage_passes.sell_in > 5:
                growth = 2
            elif backstage_passes.sell_in > 0:
                growth = 3
            else:
                backstage_passes.quality = 0
                return backstage_passes
            backstage_passes.quality += growth
            if backstage_passes.quality > 50:
                backstage_passes.quality = 50
            return backstage_passes

        def update_conjured(conjured):
            damage_multipler = 1 if conjured.sell_in >= 0 else 2
            conjured.quality -= 2 * damage_multipler
            if conjured.quality < 0:
                conjured.quality = 0
            return conjured


        update_methods = {
            'Aged Brie': update_aged_brie,
            'Sulfuras, Hand of Ragnaros': update_sulfuras,
            'Backstage passes to a TAFKAL80ETC concert': update_backstage_passes,
            'Conjured Mana Cake': update_conjured,
            'Default product': update_default_product,
        }
        for item in self.items:
            if item.name in update_methods.keys():
                item = update_methods[item.name](item)
            else:
                item = update_methods['Default product'](item)
            item.sell_in -= 1


class Item:
    def __init__(self, name, sell_in, quality):
        self.name = name
        self.sell_in = sell_in
        self.quality = quality

    def __repr__(self):
        return "%s, %s, %s" % (self.name, self.sell_in, self.quality)
