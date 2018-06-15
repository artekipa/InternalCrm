<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class AwardTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCreateAward()
    {
        $admin = \App\User::find(1);
        $award = factory('App\Award')->make();

        $relations = [
            factory('App\Cataward')->create(), 
            factory('App\Cataward')->create(), 
        ];

        $this->browse(function (Browser $browser) use ($admin, $award, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.awards.index'))
                ->clickLink('Add new')
                ->type("name", $award->name)
                ->select('select[name="cataward_id[]"]', $relations[0]->id)
                ->select('select[name="cataward_id[]"]', $relations[1]->id)
                ->press('Save')
                ->assertRouteIs('admin.awards.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $award->name)
                ->assertSeeIn("tr:last-child td[field-key='cataward_id'] span:first-child", $relations[0]->name)
                ->assertSeeIn("tr:last-child td[field-key='cataward_id'] span:last-child", $relations[1]->name);
        });
    }

    public function testEditAward()
    {
        $admin = \App\User::find(1);
        $award = factory('App\Award')->create();
        $award2 = factory('App\Award')->make();

        $relations = [
            factory('App\Cataward')->create(), 
            factory('App\Cataward')->create(), 
        ];

        $this->browse(function (Browser $browser) use ($admin, $award, $award2, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.awards.index'))
                ->click('tr[data-entry-id="' . $award->id . '"] .btn-info')
                ->type("name", $award2->name)
                ->select('select[name="cataward_id[]"]', $relations[0]->id)
                ->select('select[name="cataward_id[]"]', $relations[1]->id)
                ->press('Update')
                ->assertRouteIs('admin.awards.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $award2->name)
                ->assertSeeIn("tr:last-child td[field-key='cataward_id'] span:first-child", $relations[0]->name)
                ->assertSeeIn("tr:last-child td[field-key='cataward_id'] span:last-child", $relations[1]->name);
        });
    }

    public function testShowAward()
    {
        $admin = \App\User::find(1);
        $award = factory('App\Award')->create();

        $relations = [
            factory('App\Cataward')->create(), 
            factory('App\Cataward')->create(), 
        ];

        $award->cataward_id()->attach([$relations[0]->id, $relations[1]->id]);

        $this->browse(function (Browser $browser) use ($admin, $award, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.awards.index'))
                ->click('tr[data-entry-id="' . $award->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='name']", $award->name)
                ->assertSeeIn("tr:last-child td[field-key='cataward_id'] span:first-child", $relations[0]->name)
                ->assertSeeIn("tr:last-child td[field-key='cataward_id'] span:last-child", $relations[1]->name)
                ->assertSeeIn("td[field-key='created_by']", $award->created_by->name)
                ->assertSeeIn("td[field-key='created_by_team']", $award->created_by_team->name);
        });
    }

}
