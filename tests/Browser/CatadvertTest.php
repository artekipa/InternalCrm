<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class CatadvertTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCreateCatadvert()
    {
        $admin = \App\User::find(1);
        $catadvert = factory('App\Catadvert')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $catadvert) {
            $browser->loginAs($admin)
                ->visit(route('admin.catadverts.index'))
                ->clickLink('Add new')
                ->type("name", $catadvert->name)
                ->press('Save')
                ->assertRouteIs('admin.catadverts.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $catadvert->name);
        });
    }

    public function testEditCatadvert()
    {
        $admin = \App\User::find(1);
        $catadvert = factory('App\Catadvert')->create();
        $catadvert2 = factory('App\Catadvert')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $catadvert, $catadvert2) {
            $browser->loginAs($admin)
                ->visit(route('admin.catadverts.index'))
                ->click('tr[data-entry-id="' . $catadvert->id . '"] .btn-info')
                ->type("name", $catadvert2->name)
                ->press('Update')
                ->assertRouteIs('admin.catadverts.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $catadvert2->name);
        });
    }

    public function testShowCatadvert()
    {
        $admin = \App\User::find(1);
        $catadvert = factory('App\Catadvert')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $catadvert) {
            $browser->loginAs($admin)
                ->visit(route('admin.catadverts.index'))
                ->click('tr[data-entry-id="' . $catadvert->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='name']", $catadvert->name);
        });
    }

}
