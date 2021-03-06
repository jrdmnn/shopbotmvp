<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ItemTest extends TestCase
{
    use DatabaseMigrations;

    protected $item;

    public function setUp()
    {
        parent::setUp();

        $this->item = factory('App\Models\Item')->create();
    }

    /** @test */
    function an_item_has_a_category()
    {
        $this->assertInstanceOf('App\Models\Category', $this->item->category);
    }

    /** @test */
    function an_item_belongs_to_a_listing()
    {
        $this->assertInstanceOf('App\Models\Listing', $this->item->listing);
    }
}
