<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class ProjectTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCreateProject()
    {
        $admin = \App\User::find(1);
        $project = factory('App\Project')->make();

        $relations = [
            factory('App\Award')->create(), 
            factory('App\Award')->create(), 
        ];

        $this->browse(function (Browser $browser) use ($admin, $project, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.projects.index'))
                ->clickLink('Add new')
                ->type("name", $project->name)
                ->select('select[name="awards_id[]"]', $relations[0]->id)
                ->select('select[name="awards_id[]"]', $relations[1]->id)
                ->press('Save')
                ->assertRouteIs('admin.projects.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $project->name)
                ->assertSeeIn("tr:last-child td[field-key='awards_id'] span:first-child", $relations[0]->name)
                ->assertSeeIn("tr:last-child td[field-key='awards_id'] span:last-child", $relations[1]->name);
        });
    }

    public function testEditProject()
    {
        $admin = \App\User::find(1);
        $project = factory('App\Project')->create();
        $project2 = factory('App\Project')->make();

        $relations = [
            factory('App\Award')->create(), 
            factory('App\Award')->create(), 
        ];

        $this->browse(function (Browser $browser) use ($admin, $project, $project2, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.projects.index'))
                ->click('tr[data-entry-id="' . $project->id . '"] .btn-info')
                ->type("name", $project2->name)
                ->select('select[name="awards_id[]"]', $relations[0]->id)
                ->select('select[name="awards_id[]"]', $relations[1]->id)
                ->press('Update')
                ->assertRouteIs('admin.projects.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $project2->name)
                ->assertSeeIn("tr:last-child td[field-key='awards_id'] span:first-child", $relations[0]->name)
                ->assertSeeIn("tr:last-child td[field-key='awards_id'] span:last-child", $relations[1]->name);
        });
    }

    public function testShowProject()
    {
        $admin = \App\User::find(1);
        $project = factory('App\Project')->create();

        $relations = [
            factory('App\Award')->create(), 
            factory('App\Award')->create(), 
        ];

        $project->awards_id()->attach([$relations[0]->id, $relations[1]->id]);

        $this->browse(function (Browser $browser) use ($admin, $project, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.projects.index'))
                ->click('tr[data-entry-id="' . $project->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='name']", $project->name)
                ->assertSeeIn("tr:last-child td[field-key='awards_id'] span:first-child", $relations[0]->name)
                ->assertSeeIn("tr:last-child td[field-key='awards_id'] span:last-child", $relations[1]->name);
        });
    }

}
