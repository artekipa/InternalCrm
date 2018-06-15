<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class NoteTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCreateNote()
    {
        $admin = \App\User::find(1);
        $note = factory('App\Note')->make();

        $relations = [
            factory('App\Catnote')->create(), 
            factory('App\Catnote')->create(), 
        ];

        $this->browse(function (Browser $browser) use ($admin, $note, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.notes.index'))
                ->clickLink('Add new')
                ->type("title", $note->title)
                ->type("desc", $note->desc)
                ->select('select[name="catnotes_id[]"]', $relations[0]->id)
                ->select('select[name="catnotes_id[]"]', $relations[1]->id)
                ->press('Save')
                ->assertRouteIs('admin.notes.index')
                ->assertSeeIn("tr:last-child td[field-key='title']", $note->title)
                ->assertSeeIn("tr:last-child td[field-key='desc']", $note->desc)
                ->assertSeeIn("tr:last-child td[field-key='catnotes_id'] span:first-child", $relations[0]->name)
                ->assertSeeIn("tr:last-child td[field-key='catnotes_id'] span:last-child", $relations[1]->name);
        });
    }

    public function testEditNote()
    {
        $admin = \App\User::find(1);
        $note = factory('App\Note')->create();
        $note2 = factory('App\Note')->make();

        $relations = [
            factory('App\Catnote')->create(), 
            factory('App\Catnote')->create(), 
        ];

        $this->browse(function (Browser $browser) use ($admin, $note, $note2, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.notes.index'))
                ->click('tr[data-entry-id="' . $note->id . '"] .btn-info')
                ->type("title", $note2->title)
                ->type("desc", $note2->desc)
                ->select('select[name="catnotes_id[]"]', $relations[0]->id)
                ->select('select[name="catnotes_id[]"]', $relations[1]->id)
                ->press('Update')
                ->assertRouteIs('admin.notes.index')
                ->assertSeeIn("tr:last-child td[field-key='title']", $note2->title)
                ->assertSeeIn("tr:last-child td[field-key='desc']", $note2->desc)
                ->assertSeeIn("tr:last-child td[field-key='catnotes_id'] span:first-child", $relations[0]->name)
                ->assertSeeIn("tr:last-child td[field-key='catnotes_id'] span:last-child", $relations[1]->name);
        });
    }

    public function testShowNote()
    {
        $admin = \App\User::find(1);
        $note = factory('App\Note')->create();

        $relations = [
            factory('App\Catnote')->create(), 
            factory('App\Catnote')->create(), 
        ];

        $note->catnotes_id()->attach([$relations[0]->id, $relations[1]->id]);

        $this->browse(function (Browser $browser) use ($admin, $note, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.notes.index'))
                ->click('tr[data-entry-id="' . $note->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='title']", $note->title)
                ->assertSeeIn("td[field-key='desc']", $note->desc)
                ->assertSeeIn("tr:last-child td[field-key='catnotes_id'] span:first-child", $relations[0]->name)
                ->assertSeeIn("tr:last-child td[field-key='catnotes_id'] span:last-child", $relations[1]->name)
                ->assertSeeIn("td[field-key='created_by']", $note->created_by->name)
                ->assertSeeIn("td[field-key='created_by_team']", $note->created_by_team->name);
        });
    }

}
