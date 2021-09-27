<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;
use Laravel\Dusk\Page;

class CreateItem extends Page
{
    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return '/items/create';
    }

    /**
     * Assert that the browser is on the page.
     *
     * @param  Browser  $browser
     * @return void
     */
    public function assert(Browser $browser)
    {
        $browser->assertPathIs($this->url());
    }

    /**
     * Get the element shortcuts for the page.
     *
     * @return array
     */
    public function elements()
    {
        return [
            '@name' => '#name',
            '@item_barcode' => '#item_barcode',
            '@item_purchasing_price' => '#item_purchasing_price',
            '@item_wholesale_price' => '#item_wholesale_price',
            '@item_selling_price' => '#item_selling_price',
            '@item_quantity_on_show' => '#item_quantity_on_show',
            '@item_quantity_in_stock' => '#item_quantity_in_stock',
            '@submitBtn' => '#submitBtn',
        ];
    }
}
