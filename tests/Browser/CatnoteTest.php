<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class CatnoteTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCreateCatnote()
    {
        $admin = \App\User::find(1);
        $catnote = factory('App\Catnote')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $catnote) {
            $browser->loginAs($admin)
                ->visit(route('admin.catnotes.index'))
                ->clickLink('Add new')
                ->type("name", $catnote->name)
                ->press('Save')
                ->assertRouteIs('admin.catnotes.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $catnote->name);
        });
    }

    public function testEditCatnote()
    {
        $admin = \App\User::find(1);
        $catnote = factory('App\Catnote')->create();
        $catnote2 = factory('App\Catnote')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $catnote, $catnote2) {
            $browser->loginAs($admin)
                ->visit(route('admin.catnotes.index'))
                ->click('tr[data-entry-id="' . $catnote->id . '"] .btn-info')
                ->type("name", $catnote2->name)
                ->press('Update')
                ->assertRouteIs('admin.catnotes.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $catnote2->name);
        });
    }

    public function testShowCatnote()
    {
        $admin = \App\User::find(1);
        $catnote = factory('App\Catnote')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $catnote) {
            $browser->loginAs($admin)
                ->visit(route('admin.catnotes.index'))
                ->click('tr[data-entry-id="' . $catnote->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='name']", $catnote->name)
                ->assertSeeIn("td[field-key='created_by']", $catnote->created_by->name)
                ->assertSeeIn("td[field-key='created_by_team']", $catnote->created_by_team->name);
        });
    }

}
