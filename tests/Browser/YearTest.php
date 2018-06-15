<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class YearTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCreateYear()
    {
        $admin = \App\User::find(1);
        $year = factory('App\Year')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $year) {
            $browser->loginAs($admin)
                ->visit(route('admin.years.index'))
                ->clickLink('Add new')
                ->type("name", $year->name)
                ->press('Save')
                ->assertRouteIs('admin.years.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $year->name);
        });
    }

    public function testEditYear()
    {
        $admin = \App\User::find(1);
        $year = factory('App\Year')->create();
        $year2 = factory('App\Year')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $year, $year2) {
            $browser->loginAs($admin)
                ->visit(route('admin.years.index'))
                ->click('tr[data-entry-id="' . $year->id . '"] .btn-info')
                ->type("name", $year2->name)
                ->press('Update')
                ->assertRouteIs('admin.years.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $year2->name);
        });
    }

    public function testShowYear()
    {
        $admin = \App\User::find(1);
        $year = factory('App\Year')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $year) {
            $browser->loginAs($admin)
                ->visit(route('admin.years.index'))
                ->click('tr[data-entry-id="' . $year->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='name']", $year->name);
        });
    }

}
