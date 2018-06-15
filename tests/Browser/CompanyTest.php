<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class CompanyTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCreateCompany()
    {
        $admin = \App\User::find(1);
        $company = factory('App\Company')->make();

        $relations = [
            factory('App\Vivodeship')->create(), 
            factory('App\Vivodeship')->create(), 
            factory('App\Trade')->create(), 
            factory('App\Trade')->create(), 
            factory('App\Year')->create(), 
            factory('App\Year')->create(), 
        ];

        $this->browse(function (Browser $browser) use ($admin, $company, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.companies.index'))
                ->clickLink('Add new')
                ->type("name", $company->name)
                ->type("persontitle", $company->persontitle)
                ->type("personname", $company->personname)
                ->type("zipcode", $company->zipcode)
                ->type("city", $company->city)
                ->select('select[name="vivode_id[]"]', $relations[0]->id)
                ->select('select[name="vivode_id[]"]', $relations[1]->id)
                ->type("phone", $company->phone)
                ->type("email", $company->email)
                ->type("website", $company->website)
                ->select('select[name="trades_id[]"]', $relations[2]->id)
                ->select('select[name="trades_id[]"]', $relations[3]->id)
                ->type("comments", $company->comments)
                ->type("nomination", $company->nomination)
                ->select('select[name="nomiyear_id[]"]', $relations[4]->id)
                ->select('select[name="nomiyear_id[]"]', $relations[5]->id)
                ->type("senddate", $company->senddate)
                ->select("user_id", $company->user_id)
                ->press('Save')
                ->assertRouteIs('admin.companies.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $company->name)
                ->assertSeeIn("tr:last-child td[field-key='persontitle']", $company->persontitle)
                ->assertSeeIn("tr:last-child td[field-key='personname']", $company->personname)
                ->assertSeeIn("tr:last-child td[field-key='zipcode']", $company->zipcode)
                ->assertSeeIn("tr:last-child td[field-key='city']", $company->city)
                ->assertSeeIn("tr:last-child td[field-key='vivode_id'] span:first-child", $relations[0]->name)
                ->assertSeeIn("tr:last-child td[field-key='vivode_id'] span:last-child", $relations[1]->name)
                ->assertSeeIn("tr:last-child td[field-key='phone']", $company->phone)
                ->assertSeeIn("tr:last-child td[field-key='email']", $company->email)
                ->assertSeeIn("tr:last-child td[field-key='website']", $company->website)
                ->assertSeeIn("tr:last-child td[field-key='trades_id'] span:first-child", $relations[2]->name)
                ->assertSeeIn("tr:last-child td[field-key='trades_id'] span:last-child", $relations[3]->name)
                ->assertSeeIn("tr:last-child td[field-key='comments']", $company->comments)
                ->assertSeeIn("tr:last-child td[field-key='nomination']", $company->nomination)
                ->assertSeeIn("tr:last-child td[field-key='nomiyear_id'] span:first-child", $relations[4]->name)
                ->assertSeeIn("tr:last-child td[field-key='nomiyear_id'] span:last-child", $relations[5]->name)
                ->assertSeeIn("tr:last-child td[field-key='senddate']", $company->senddate)
                ->assertSeeIn("tr:last-child td[field-key='user']", $company->user->name);
        });
    }

    public function testEditCompany()
    {
        $admin = \App\User::find(1);
        $company = factory('App\Company')->create();
        $company2 = factory('App\Company')->make();

        $relations = [
            factory('App\Vivodeship')->create(), 
            factory('App\Vivodeship')->create(), 
            factory('App\Trade')->create(), 
            factory('App\Trade')->create(), 
            factory('App\Year')->create(), 
            factory('App\Year')->create(), 
        ];

        $this->browse(function (Browser $browser) use ($admin, $company, $company2, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.companies.index'))
                ->click('tr[data-entry-id="' . $company->id . '"] .btn-info')
                ->type("name", $company2->name)
                ->type("persontitle", $company2->persontitle)
                ->type("personname", $company2->personname)
                ->type("zipcode", $company2->zipcode)
                ->type("city", $company2->city)
                ->select('select[name="vivode_id[]"]', $relations[0]->id)
                ->select('select[name="vivode_id[]"]', $relations[1]->id)
                ->type("phone", $company2->phone)
                ->type("email", $company2->email)
                ->type("website", $company2->website)
                ->select('select[name="trades_id[]"]', $relations[2]->id)
                ->select('select[name="trades_id[]"]', $relations[3]->id)
                ->type("comments", $company2->comments)
                ->type("nomination", $company2->nomination)
                ->select('select[name="nomiyear_id[]"]', $relations[4]->id)
                ->select('select[name="nomiyear_id[]"]', $relations[5]->id)
                ->type("senddate", $company2->senddate)
                ->select("user_id", $company2->user_id)
                ->press('Update')
                ->assertRouteIs('admin.companies.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $company2->name)
                ->assertSeeIn("tr:last-child td[field-key='persontitle']", $company2->persontitle)
                ->assertSeeIn("tr:last-child td[field-key='personname']", $company2->personname)
                ->assertSeeIn("tr:last-child td[field-key='zipcode']", $company2->zipcode)
                ->assertSeeIn("tr:last-child td[field-key='city']", $company2->city)
                ->assertSeeIn("tr:last-child td[field-key='vivode_id'] span:first-child", $relations[0]->name)
                ->assertSeeIn("tr:last-child td[field-key='vivode_id'] span:last-child", $relations[1]->name)
                ->assertSeeIn("tr:last-child td[field-key='phone']", $company2->phone)
                ->assertSeeIn("tr:last-child td[field-key='email']", $company2->email)
                ->assertSeeIn("tr:last-child td[field-key='website']", $company2->website)
                ->assertSeeIn("tr:last-child td[field-key='trades_id'] span:first-child", $relations[2]->name)
                ->assertSeeIn("tr:last-child td[field-key='trades_id'] span:last-child", $relations[3]->name)
                ->assertSeeIn("tr:last-child td[field-key='comments']", $company2->comments)
                ->assertSeeIn("tr:last-child td[field-key='nomination']", $company2->nomination)
                ->assertSeeIn("tr:last-child td[field-key='nomiyear_id'] span:first-child", $relations[4]->name)
                ->assertSeeIn("tr:last-child td[field-key='nomiyear_id'] span:last-child", $relations[5]->name)
                ->assertSeeIn("tr:last-child td[field-key='senddate']", $company2->senddate)
                ->assertSeeIn("tr:last-child td[field-key='user']", $company2->user->name);
        });
    }

    public function testShowCompany()
    {
        $admin = \App\User::find(1);
        $company = factory('App\Company')->create();

        $relations = [
            factory('App\Vivodeship')->create(), 
            factory('App\Vivodeship')->create(), 
            factory('App\Trade')->create(), 
            factory('App\Trade')->create(), 
            factory('App\Year')->create(), 
            factory('App\Year')->create(), 
        ];

        $company->vivode_id()->attach([$relations[0]->id, $relations[1]->id]);
        $company->trades_id()->attach([$relations[2]->id, $relations[3]->id]);
        $company->nomiyear_id()->attach([$relations[4]->id, $relations[5]->id]);

        $this->browse(function (Browser $browser) use ($admin, $company, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.companies.index'))
                ->click('tr[data-entry-id="' . $company->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='name']", $company->name)
                ->assertSeeIn("td[field-key='persontitle']", $company->persontitle)
                ->assertSeeIn("td[field-key='personname']", $company->personname)
                ->assertSeeIn("td[field-key='zipcode']", $company->zipcode)
                ->assertSeeIn("td[field-key='city']", $company->city)
                ->assertSeeIn("tr:last-child td[field-key='vivode_id'] span:first-child", $relations[0]->name)
                ->assertSeeIn("tr:last-child td[field-key='vivode_id'] span:last-child", $relations[1]->name)
                ->assertSeeIn("td[field-key='phone']", $company->phone)
                ->assertSeeIn("td[field-key='email']", $company->email)
                ->assertSeeIn("td[field-key='website']", $company->website)
                ->assertSeeIn("tr:last-child td[field-key='trades_id'] span:first-child", $relations[2]->name)
                ->assertSeeIn("tr:last-child td[field-key='trades_id'] span:last-child", $relations[3]->name)
                ->assertSeeIn("td[field-key='comments']", $company->comments)
                ->assertSeeIn("td[field-key='nomination']", $company->nomination)
                ->assertSeeIn("tr:last-child td[field-key='nomiyear_id'] span:first-child", $relations[4]->name)
                ->assertSeeIn("tr:last-child td[field-key='nomiyear_id'] span:last-child", $relations[5]->name)
                ->assertSeeIn("td[field-key='senddate']", $company->senddate)
                ->assertSeeIn("td[field-key='user']", $company->user->name);
        });
    }

}
