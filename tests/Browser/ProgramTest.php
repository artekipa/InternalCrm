<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class ProgramTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCreateProgram()
    {
        $admin = \App\User::find(1);
        $program = factory('App\Program')->make();

        $relations = [
            factory('App\Project')->create(), 
            factory('App\Project')->create(), 
            factory('App\Award')->create(), 
            factory('App\Award')->create(), 
        ];

        $this->browse(function (Browser $browser) use ($admin, $program, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.programs.index'))
                ->clickLink('Add new')
                ->type("name", $program->name)
                ->select('select[name="project_id[]"]', $relations[0]->id)
                ->select('select[name="project_id[]"]', $relations[1]->id)
                ->select('select[name="award_id[]"]', $relations[2]->id)
                ->select('select[name="award_id[]"]', $relations[3]->id)
                ->press('Save')
                ->assertRouteIs('admin.programs.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $program->name)
                ->assertSeeIn("tr:last-child td[field-key='project_id'] span:first-child", $relations[0]->name)
                ->assertSeeIn("tr:last-child td[field-key='project_id'] span:last-child", $relations[1]->name)
                ->assertSeeIn("tr:last-child td[field-key='award_id'] span:first-child", $relations[2]->name)
                ->assertSeeIn("tr:last-child td[field-key='award_id'] span:last-child", $relations[3]->name);
        });
    }

    public function testEditProgram()
    {
        $admin = \App\User::find(1);
        $program = factory('App\Program')->create();
        $program2 = factory('App\Program')->make();

        $relations = [
            factory('App\Project')->create(), 
            factory('App\Project')->create(), 
            factory('App\Award')->create(), 
            factory('App\Award')->create(), 
        ];

        $this->browse(function (Browser $browser) use ($admin, $program, $program2, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.programs.index'))
                ->click('tr[data-entry-id="' . $program->id . '"] .btn-info')
                ->type("name", $program2->name)
                ->select('select[name="project_id[]"]', $relations[0]->id)
                ->select('select[name="project_id[]"]', $relations[1]->id)
                ->select('select[name="award_id[]"]', $relations[2]->id)
                ->select('select[name="award_id[]"]', $relations[3]->id)
                ->press('Update')
                ->assertRouteIs('admin.programs.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $program2->name)
                ->assertSeeIn("tr:last-child td[field-key='project_id'] span:first-child", $relations[0]->name)
                ->assertSeeIn("tr:last-child td[field-key='project_id'] span:last-child", $relations[1]->name)
                ->assertSeeIn("tr:last-child td[field-key='award_id'] span:first-child", $relations[2]->name)
                ->assertSeeIn("tr:last-child td[field-key='award_id'] span:last-child", $relations[3]->name);
        });
    }

    public function testShowProgram()
    {
        $admin = \App\User::find(1);
        $program = factory('App\Program')->create();

        $relations = [
            factory('App\Project')->create(), 
            factory('App\Project')->create(), 
            factory('App\Award')->create(), 
            factory('App\Award')->create(), 
        ];

        $program->project_id()->attach([$relations[0]->id, $relations[1]->id]);
        $program->award_id()->attach([$relations[2]->id, $relations[3]->id]);

        $this->browse(function (Browser $browser) use ($admin, $program, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.programs.index'))
                ->click('tr[data-entry-id="' . $program->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='name']", $program->name)
                ->assertSeeIn("tr:last-child td[field-key='project_id'] span:first-child", $relations[0]->name)
                ->assertSeeIn("tr:last-child td[field-key='project_id'] span:last-child", $relations[1]->name)
                ->assertSeeIn("tr:last-child td[field-key='award_id'] span:first-child", $relations[2]->name)
                ->assertSeeIn("tr:last-child td[field-key='award_id'] span:last-child", $relations[3]->name);
        });
    }

}
