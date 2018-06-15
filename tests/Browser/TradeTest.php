<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class TradeTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCreateTrade()
    {
        $admin = \App\User::find(1);
        $trade = factory('App\Trade')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $trade) {
            $browser->loginAs($admin)
                ->visit(route('admin.trades.index'))
                ->clickLink('Add new')
                ->type("name", $trade->name)
                ->press('Save')
                ->assertRouteIs('admin.trades.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $trade->name);
        });
    }

    public function testEditTrade()
    {
        $admin = \App\User::find(1);
        $trade = factory('App\Trade')->create();
        $trade2 = factory('App\Trade')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $trade, $trade2) {
            $browser->loginAs($admin)
                ->visit(route('admin.trades.index'))
                ->click('tr[data-entry-id="' . $trade->id . '"] .btn-info')
                ->type("name", $trade2->name)
                ->press('Update')
                ->assertRouteIs('admin.trades.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $trade2->name);
        });
    }

    public function testShowTrade()
    {
        $admin = \App\User::find(1);
        $trade = factory('App\Trade')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $trade) {
            $browser->loginAs($admin)
                ->visit(route('admin.trades.index'))
                ->click('tr[data-entry-id="' . $trade->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='name']", $trade->name);
        });
    }

}
