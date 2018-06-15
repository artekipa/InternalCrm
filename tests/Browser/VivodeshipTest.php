<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class VivodeshipTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCreateVivodeship()
    {
        $admin = \App\User::find(1);
        $vivodeship = factory('App\Vivodeship')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $vivodeship) {
            $browser->loginAs($admin)
                ->visit(route('admin.vivodeships.index'))
                ->clickLink('Add new')
                ->type("name", $vivodeship->name)
                ->press('Save')
                ->assertRouteIs('admin.vivodeships.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $vivodeship->name);
        });
    }

    public function testEditVivodeship()
    {
        $admin = \App\User::find(1);
        $vivodeship = factory('App\Vivodeship')->create();
        $vivodeship2 = factory('App\Vivodeship')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $vivodeship, $vivodeship2) {
            $browser->loginAs($admin)
                ->visit(route('admin.vivodeships.index'))
                ->click('tr[data-entry-id="' . $vivodeship->id . '"] .btn-info')
                ->type("name", $vivodeship2->name)
                ->press('Update')
                ->assertRouteIs('admin.vivodeships.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $vivodeship2->name);
        });
    }

    public function testShowVivodeship()
    {
        $admin = \App\User::find(1);
        $vivodeship = factory('App\Vivodeship')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $vivodeship) {
            $browser->loginAs($admin)
                ->visit(route('admin.vivodeships.index'))
                ->click('tr[data-entry-id="' . $vivodeship->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='name']", $vivodeship->name)
                ->assertSeeIn("td[field-key='created_by']", $vivodeship->created_by->name)
                ->assertSeeIn("td[field-key='created_by_team']", $vivodeship->created_by_team->name);
        });
    }

}
