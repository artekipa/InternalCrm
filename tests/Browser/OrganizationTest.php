<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class OrganizationTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCreateOrganization()
    {
        $admin = \App\User::find(1);
        $organization = factory('App\Organization')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $organization) {
            $browser->loginAs($admin)
                ->visit(route('admin.organizations.index'))
                ->clickLink('Add new')
                ->type("name", $organization->name)
                ->type("desc", $organization->desc)
                ->press('Save')
                ->assertRouteIs('admin.organizations.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $organization->name)
                ->assertSeeIn("tr:last-child td[field-key='desc']", $organization->desc);
        });
    }

    public function testEditOrganization()
    {
        $admin = \App\User::find(1);
        $organization = factory('App\Organization')->create();
        $organization2 = factory('App\Organization')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $organization, $organization2) {
            $browser->loginAs($admin)
                ->visit(route('admin.organizations.index'))
                ->click('tr[data-entry-id="' . $organization->id . '"] .btn-info')
                ->type("name", $organization2->name)
                ->type("desc", $organization2->desc)
                ->press('Update')
                ->assertRouteIs('admin.organizations.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $organization2->name)
                ->assertSeeIn("tr:last-child td[field-key='desc']", $organization2->desc);
        });
    }

    public function testShowOrganization()
    {
        $admin = \App\User::find(1);
        $organization = factory('App\Organization')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $organization) {
            $browser->loginAs($admin)
                ->visit(route('admin.organizations.index'))
                ->click('tr[data-entry-id="' . $organization->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='name']", $organization->name)
                ->assertSeeIn("td[field-key='desc']", $organization->desc);
        });
    }

}
