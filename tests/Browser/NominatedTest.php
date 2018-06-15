<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class NominatedTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCreateNominated()
    {
        $admin = \App\User::find(1);
        $nominated = factory('App\Nominated')->make();

        $relations = [
            factory('App\Program')->create(), 
            factory('App\Program')->create(), 
            factory('App\Project')->create(), 
            factory('App\Project')->create(), 
            factory('App\Award')->create(), 
            factory('App\Award')->create(), 
            factory('App\User')->create(), 
            factory('App\User')->create(), 
            factory('App\Organization')->create(), 
            factory('App\Organization')->create(), 
        ];

        $this->browse(function (Browser $browser) use ($admin, $nominated, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.nominateds.index'))
                ->clickLink('Add new')
                ->select("company_id", $nominated->company_id)
                ->select('select[name="programs_id[]"]', $relations[0]->id)
                ->select('select[name="programs_id[]"]', $relations[1]->id)
                ->select('select[name="project_id[]"]', $relations[2]->id)
                ->select('select[name="project_id[]"]', $relations[3]->id)
                ->select("cataward_id", $nominated->cataward_id)
                ->select('select[name="award_id[]"]', $relations[4]->id)
                ->select('select[name="award_id[]"]', $relations[5]->id)
                ->select("year_id", $nominated->year_id)
                ->select('select[name="user_id[]"]', $relations[6]->id)
                ->select('select[name="user_id[]"]', $relations[7]->id)
                ->type("materialdates", $nominated->materialdates)
                ->type("docsdate", $nominated->docsdate)
                ->type("matrialtype", $nominated->matrialtype)
                ->type("materialloc", $nominated->materialloc)
                ->type("sitenumber", $nominated->sitenumber)
                ->type("contactperson", $nominated->contactperson)
                ->type("cpemail", $nominated->cpemail)
                ->type("cpphone", $nominated->cpphone)
                ->type("presentation_name", $nominated->presentation_name)
                ->type("presentation_site_no", $nominated->presentation_site_no)
                ->check("member")
                ->select('select[name="organizations_id[]"]', $relations[8]->id)
                ->select('select[name="organizations_id[]"]', $relations[9]->id)
                ->type("comments", $nominated->comments)
                ->type("eventpersonno", $nominated->eventpersonno)
                ->type("event_person", $nominated->event_person)
                ->press('Save')
                ->assertRouteIs('admin.nominateds.index')
                ->assertSeeIn("tr:last-child td[field-key='company']", $nominated->company->name)
                ->assertSeeIn("tr:last-child td[field-key='programs_id'] span:first-child", $relations[0]->name)
                ->assertSeeIn("tr:last-child td[field-key='programs_id'] span:last-child", $relations[1]->name)
                ->assertSeeIn("tr:last-child td[field-key='project_id'] span:first-child", $relations[2]->name)
                ->assertSeeIn("tr:last-child td[field-key='project_id'] span:last-child", $relations[3]->name)
                ->assertSeeIn("tr:last-child td[field-key='cataward']", $nominated->cataward->name)
                ->assertSeeIn("tr:last-child td[field-key='award_id'] span:first-child", $relations[4]->name)
                ->assertSeeIn("tr:last-child td[field-key='award_id'] span:last-child", $relations[5]->name)
                ->assertSeeIn("tr:last-child td[field-key='year']", $nominated->year->name)
                ->assertSeeIn("tr:last-child td[field-key='user_id'] span:first-child", $relations[6]->name)
                ->assertSeeIn("tr:last-child td[field-key='user_id'] span:last-child", $relations[7]->name)
                ->assertSeeIn("tr:last-child td[field-key='materialdates']", $nominated->materialdates)
                ->assertSeeIn("tr:last-child td[field-key='docsdate']", $nominated->docsdate)
                ->assertSeeIn("tr:last-child td[field-key='matrialtype']", $nominated->matrialtype)
                ->assertSeeIn("tr:last-child td[field-key='materialloc']", $nominated->materialloc)
                ->assertSeeIn("tr:last-child td[field-key='sitenumber']", $nominated->sitenumber)
                ->assertSeeIn("tr:last-child td[field-key='contactperson']", $nominated->contactperson)
                ->assertSeeIn("tr:last-child td[field-key='cpemail']", $nominated->cpemail)
                ->assertSeeIn("tr:last-child td[field-key='cpphone']", $nominated->cpphone)
                ->assertSeeIn("tr:last-child td[field-key='presentation_name']", $nominated->presentation_name)
                ->assertSeeIn("tr:last-child td[field-key='presentation_site_no']", $nominated->presentation_site_no)
                ->assertChecked("member")
                ->assertSeeIn("tr:last-child td[field-key='organizations_id'] span:first-child", $relations[8]->name)
                ->assertSeeIn("tr:last-child td[field-key='organizations_id'] span:last-child", $relations[9]->name)
                ->assertSeeIn("tr:last-child td[field-key='comments']", $nominated->comments)
                ->assertSeeIn("tr:last-child td[field-key='eventpersonno']", $nominated->eventpersonno)
                ->assertSeeIn("tr:last-child td[field-key='event_person']", $nominated->event_person);
        });
    }

    public function testEditNominated()
    {
        $admin = \App\User::find(1);
        $nominated = factory('App\Nominated')->create();
        $nominated2 = factory('App\Nominated')->make();

        $relations = [
            factory('App\Program')->create(), 
            factory('App\Program')->create(), 
            factory('App\Project')->create(), 
            factory('App\Project')->create(), 
            factory('App\Award')->create(), 
            factory('App\Award')->create(), 
            factory('App\User')->create(), 
            factory('App\User')->create(), 
            factory('App\Organization')->create(), 
            factory('App\Organization')->create(), 
        ];

        $this->browse(function (Browser $browser) use ($admin, $nominated, $nominated2, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.nominateds.index'))
                ->click('tr[data-entry-id="' . $nominated->id . '"] .btn-info')
                ->select("company_id", $nominated2->company_id)
                ->select('select[name="programs_id[]"]', $relations[0]->id)
                ->select('select[name="programs_id[]"]', $relations[1]->id)
                ->select('select[name="project_id[]"]', $relations[2]->id)
                ->select('select[name="project_id[]"]', $relations[3]->id)
                ->select("cataward_id", $nominated2->cataward_id)
                ->select('select[name="award_id[]"]', $relations[4]->id)
                ->select('select[name="award_id[]"]', $relations[5]->id)
                ->select("year_id", $nominated2->year_id)
                ->select('select[name="user_id[]"]', $relations[6]->id)
                ->select('select[name="user_id[]"]', $relations[7]->id)
                ->type("materialdates", $nominated2->materialdates)
                ->type("docsdate", $nominated2->docsdate)
                ->type("matrialtype", $nominated2->matrialtype)
                ->type("materialloc", $nominated2->materialloc)
                ->type("sitenumber", $nominated2->sitenumber)
                ->type("contactperson", $nominated2->contactperson)
                ->type("cpemail", $nominated2->cpemail)
                ->type("cpphone", $nominated2->cpphone)
                ->type("presentation_name", $nominated2->presentation_name)
                ->type("presentation_site_no", $nominated2->presentation_site_no)
                ->check("member")
                ->select('select[name="organizations_id[]"]', $relations[8]->id)
                ->select('select[name="organizations_id[]"]', $relations[9]->id)
                ->type("comments", $nominated2->comments)
                ->type("eventpersonno", $nominated2->eventpersonno)
                ->type("event_person", $nominated2->event_person)
                ->press('Update')
                ->assertRouteIs('admin.nominateds.index')
                ->assertSeeIn("tr:last-child td[field-key='company']", $nominated2->company->name)
                ->assertSeeIn("tr:last-child td[field-key='programs_id'] span:first-child", $relations[0]->name)
                ->assertSeeIn("tr:last-child td[field-key='programs_id'] span:last-child", $relations[1]->name)
                ->assertSeeIn("tr:last-child td[field-key='project_id'] span:first-child", $relations[2]->name)
                ->assertSeeIn("tr:last-child td[field-key='project_id'] span:last-child", $relations[3]->name)
                ->assertSeeIn("tr:last-child td[field-key='cataward']", $nominated2->cataward->name)
                ->assertSeeIn("tr:last-child td[field-key='award_id'] span:first-child", $relations[4]->name)
                ->assertSeeIn("tr:last-child td[field-key='award_id'] span:last-child", $relations[5]->name)
                ->assertSeeIn("tr:last-child td[field-key='year']", $nominated2->year->name)
                ->assertSeeIn("tr:last-child td[field-key='user_id'] span:first-child", $relations[6]->name)
                ->assertSeeIn("tr:last-child td[field-key='user_id'] span:last-child", $relations[7]->name)
                ->assertSeeIn("tr:last-child td[field-key='materialdates']", $nominated2->materialdates)
                ->assertSeeIn("tr:last-child td[field-key='docsdate']", $nominated2->docsdate)
                ->assertSeeIn("tr:last-child td[field-key='matrialtype']", $nominated2->matrialtype)
                ->assertSeeIn("tr:last-child td[field-key='materialloc']", $nominated2->materialloc)
                ->assertSeeIn("tr:last-child td[field-key='sitenumber']", $nominated2->sitenumber)
                ->assertSeeIn("tr:last-child td[field-key='contactperson']", $nominated2->contactperson)
                ->assertSeeIn("tr:last-child td[field-key='cpemail']", $nominated2->cpemail)
                ->assertSeeIn("tr:last-child td[field-key='cpphone']", $nominated2->cpphone)
                ->assertSeeIn("tr:last-child td[field-key='presentation_name']", $nominated2->presentation_name)
                ->assertSeeIn("tr:last-child td[field-key='presentation_site_no']", $nominated2->presentation_site_no)
                ->assertChecked("member")
                ->assertSeeIn("tr:last-child td[field-key='organizations_id'] span:first-child", $relations[8]->name)
                ->assertSeeIn("tr:last-child td[field-key='organizations_id'] span:last-child", $relations[9]->name)
                ->assertSeeIn("tr:last-child td[field-key='comments']", $nominated2->comments)
                ->assertSeeIn("tr:last-child td[field-key='eventpersonno']", $nominated2->eventpersonno)
                ->assertSeeIn("tr:last-child td[field-key='event_person']", $nominated2->event_person);
        });
    }

    public function testShowNominated()
    {
        $admin = \App\User::find(1);
        $nominated = factory('App\Nominated')->create();

        $relations = [
            factory('App\Program')->create(), 
            factory('App\Program')->create(), 
            factory('App\Project')->create(), 
            factory('App\Project')->create(), 
            factory('App\Award')->create(), 
            factory('App\Award')->create(), 
            factory('App\User')->create(), 
            factory('App\User')->create(), 
            factory('App\Organization')->create(), 
            factory('App\Organization')->create(), 
        ];

        $nominated->programs_id()->attach([$relations[0]->id, $relations[1]->id]);
        $nominated->project_id()->attach([$relations[2]->id, $relations[3]->id]);
        $nominated->award_id()->attach([$relations[4]->id, $relations[5]->id]);
        $nominated->user_id()->attach([$relations[6]->id, $relations[7]->id]);
        $nominated->organizations_id()->attach([$relations[8]->id, $relations[9]->id]);

        $this->browse(function (Browser $browser) use ($admin, $nominated, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.nominateds.index'))
                ->click('tr[data-entry-id="' . $nominated->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='company']", $nominated->company->name)
                ->assertSeeIn("tr:last-child td[field-key='programs_id'] span:first-child", $relations[0]->name)
                ->assertSeeIn("tr:last-child td[field-key='programs_id'] span:last-child", $relations[1]->name)
                ->assertSeeIn("tr:last-child td[field-key='project_id'] span:first-child", $relations[2]->name)
                ->assertSeeIn("tr:last-child td[field-key='project_id'] span:last-child", $relations[3]->name)
                ->assertSeeIn("td[field-key='cataward']", $nominated->cataward->name)
                ->assertSeeIn("tr:last-child td[field-key='award_id'] span:first-child", $relations[4]->name)
                ->assertSeeIn("tr:last-child td[field-key='award_id'] span:last-child", $relations[5]->name)
                ->assertSeeIn("td[field-key='year']", $nominated->year->name)
                ->assertSeeIn("tr:last-child td[field-key='user_id'] span:first-child", $relations[6]->name)
                ->assertSeeIn("tr:last-child td[field-key='user_id'] span:last-child", $relations[7]->name)
                ->assertSeeIn("td[field-key='materialdates']", $nominated->materialdates)
                ->assertSeeIn("td[field-key='docsdate']", $nominated->docsdate)
                ->assertSeeIn("td[field-key='matrialtype']", $nominated->matrialtype)
                ->assertSeeIn("td[field-key='materialloc']", $nominated->materialloc)
                ->assertSeeIn("td[field-key='sitenumber']", $nominated->sitenumber)
                ->assertSeeIn("td[field-key='contactperson']", $nominated->contactperson)
                ->assertSeeIn("td[field-key='cpemail']", $nominated->cpemail)
                ->assertSeeIn("td[field-key='cpphone']", $nominated->cpphone)
                ->assertSeeIn("td[field-key='presentation_name']", $nominated->presentation_name)
                ->assertSeeIn("td[field-key='presentation_site_no']", $nominated->presentation_site_no)
                ->assertNotChecked("member")
                ->assertSeeIn("tr:last-child td[field-key='organizations_id'] span:first-child", $relations[8]->name)
                ->assertSeeIn("tr:last-child td[field-key='organizations_id'] span:last-child", $relations[9]->name)
                ->assertSeeIn("td[field-key='comments']", $nominated->comments)
                ->assertSeeIn("td[field-key='eventpersonno']", $nominated->eventpersonno)
                ->assertSeeIn("td[field-key='event_person']", $nominated->event_person);
        });
    }

}
