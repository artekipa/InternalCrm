<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class AdvertTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCreateAdvert()
    {
        $admin = \App\User::find(1);
        $advert = factory('App\Advert')->make();

        $relations = [
            factory('App\Catadvert')->create(), 
            factory('App\Catadvert')->create(), 
            factory('App\Team')->create(), 
            factory('App\Team')->create(), 
        ];

        $this->browse(function (Browser $browser) use ($admin, $advert, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.adverts.index'))
                ->clickLink('Add new')
                ->type("title", $advert->title)
                ->select('select[name="catadver_id[]"]', $relations[0]->id)
                ->select('select[name="catadver_id[]"]', $relations[1]->id)
                ->type("desc", $advert->desc)
                ->select('select[name="team_id[]"]', $relations[2]->id)
                ->select('select[name="team_id[]"]', $relations[3]->id)
                ->press('Save')
                ->assertRouteIs('admin.adverts.index')
                ->assertSeeIn("tr:last-child td[field-key='title']", $advert->title)
                ->assertSeeIn("tr:last-child td[field-key='catadver_id'] span:first-child", $relations[0]->name)
                ->assertSeeIn("tr:last-child td[field-key='catadver_id'] span:last-child", $relations[1]->name)
                ->assertSeeIn("tr:last-child td[field-key='desc']", $advert->desc)
                ->assertSeeIn("tr:last-child td[field-key='team_id'] span:first-child", $relations[2]->name)
                ->assertSeeIn("tr:last-child td[field-key='team_id'] span:last-child", $relations[3]->name);
        });
    }

    public function testEditAdvert()
    {
        $admin = \App\User::find(1);
        $advert = factory('App\Advert')->create();
        $advert2 = factory('App\Advert')->make();

        $relations = [
            factory('App\Catadvert')->create(), 
            factory('App\Catadvert')->create(), 
            factory('App\Team')->create(), 
            factory('App\Team')->create(), 
        ];

        $this->browse(function (Browser $browser) use ($admin, $advert, $advert2, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.adverts.index'))
                ->click('tr[data-entry-id="' . $advert->id . '"] .btn-info')
                ->type("title", $advert2->title)
                ->select('select[name="catadver_id[]"]', $relations[0]->id)
                ->select('select[name="catadver_id[]"]', $relations[1]->id)
                ->type("desc", $advert2->desc)
                ->select('select[name="team_id[]"]', $relations[2]->id)
                ->select('select[name="team_id[]"]', $relations[3]->id)
                ->press('Update')
                ->assertRouteIs('admin.adverts.index')
                ->assertSeeIn("tr:last-child td[field-key='title']", $advert2->title)
                ->assertSeeIn("tr:last-child td[field-key='catadver_id'] span:first-child", $relations[0]->name)
                ->assertSeeIn("tr:last-child td[field-key='catadver_id'] span:last-child", $relations[1]->name)
                ->assertSeeIn("tr:last-child td[field-key='desc']", $advert2->desc)
                ->assertSeeIn("tr:last-child td[field-key='team_id'] span:first-child", $relations[2]->name)
                ->assertSeeIn("tr:last-child td[field-key='team_id'] span:last-child", $relations[3]->name);
        });
    }

    public function testShowAdvert()
    {
        $admin = \App\User::find(1);
        $advert = factory('App\Advert')->create();

        $relations = [
            factory('App\Catadvert')->create(), 
            factory('App\Catadvert')->create(), 
            factory('App\Team')->create(), 
            factory('App\Team')->create(), 
        ];

        $advert->catadver_id()->attach([$relations[0]->id, $relations[1]->id]);
        $advert->team_id()->attach([$relations[2]->id, $relations[3]->id]);

        $this->browse(function (Browser $browser) use ($admin, $advert, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.adverts.index'))
                ->click('tr[data-entry-id="' . $advert->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='title']", $advert->title)
                ->assertSeeIn("tr:last-child td[field-key='catadver_id'] span:first-child", $relations[0]->name)
                ->assertSeeIn("tr:last-child td[field-key='catadver_id'] span:last-child", $relations[1]->name)
                ->assertSeeIn("td[field-key='desc']", $advert->desc)
                ->assertSeeIn("tr:last-child td[field-key='team_id'] span:first-child", $relations[2]->name)
                ->assertSeeIn("tr:last-child td[field-key='team_id'] span:last-child", $relations[3]->name);
        });
    }

}
