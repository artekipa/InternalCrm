<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class CatawardTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCreateCataward()
    {
        $admin = \App\User::find(1);
        $cataward = factory('App\Cataward')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $cataward) {
            $browser->loginAs($admin)
                ->visit(route('admin.catawards.index'))
                ->clickLink('Add new')
                ->type("name", $cataward->name)
                ->press('Save')
                ->assertRouteIs('admin.catawards.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $cataward->name);
        });
    }

    public function testEditCataward()
    {
        $admin = \App\User::find(1);
        $cataward = factory('App\Cataward')->create();
        $cataward2 = factory('App\Cataward')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $cataward, $cataward2) {
            $browser->loginAs($admin)
                ->visit(route('admin.catawards.index'))
                ->click('tr[data-entry-id="' . $cataward->id . '"] .btn-info')
                ->type("name", $cataward2->name)
                ->press('Update')
                ->assertRouteIs('admin.catawards.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $cataward2->name);
        });
    }

    public function testShowCataward()
    {
        $admin = \App\User::find(1);
        $cataward = factory('App\Cataward')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $cataward) {
            $browser->loginAs($admin)
                ->visit(route('admin.catawards.index'))
                ->click('tr[data-entry-id="' . $cataward->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='name']", $cataward->name);
        });
    }

}
