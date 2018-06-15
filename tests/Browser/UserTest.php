<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class UserTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCreateUser()
    {
        $admin = \App\User::find(1);
        $user = factory('App\User')->make();

        $relations = [
            factory('App\Role')->create(), 
            factory('App\Role')->create(), 
        ];

        $this->browse(function (Browser $browser) use ($admin, $user, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.users.index'))
                ->clickLink('Add new')
                ->type("name", $user->name)
                ->type("firstname", $user->firstname)
                ->type("lastname", $user->lastname)
                ->type("phone", $user->phone)
                ->attach("avatar", base_path("tests/_resources/test.jpg"))
                ->type("email", $user->email)
                ->type("password", $user->password)
                ->select('select[name="role[]"]', $relations[0]->id)
                ->select('select[name="role[]"]', $relations[1]->id)
                ->type("codenumber", $user->codenumber)
                ->check("approved")
                ->select("team_id", $user->team_id)
                ->press('Save')
                ->assertRouteIs('admin.users.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $user->name)
                ->assertSeeIn("tr:last-child td[field-key='firstname']", $user->firstname)
                ->assertSeeIn("tr:last-child td[field-key='lastname']", $user->lastname)
                ->assertSeeIn("tr:last-child td[field-key='phone']", $user->phone)
                ->assertVisible("img[src='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/thumb/" . \App\User::first()->avatar . "']")
                ->assertSeeIn("tr:last-child td[field-key='email']", $user->email)
                ->assertSeeIn("tr:last-child td[field-key='role'] span:first-child", $relations[0]->title)
                ->assertSeeIn("tr:last-child td[field-key='role'] span:last-child", $relations[1]->title)
                ->assertSeeIn("tr:last-child td[field-key='codenumber']", $user->codenumber)
                ->assertChecked("approved")
                ->assertSeeIn("tr:last-child td[field-key='team']", $user->team->name);
        });
    }

    public function testEditUser()
    {
        $admin = \App\User::find(1);
        $user = factory('App\User')->create();
        $user2 = factory('App\User')->make();

        $relations = [
            factory('App\Role')->create(), 
            factory('App\Role')->create(), 
        ];

        $this->browse(function (Browser $browser) use ($admin, $user, $user2, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.users.index'))
                ->click('tr[data-entry-id="' . $user->id . '"] .btn-info')
                ->type("name", $user2->name)
                ->type("firstname", $user2->firstname)
                ->type("lastname", $user2->lastname)
                ->type("phone", $user2->phone)
                ->attach("avatar", base_path("tests/_resources/test.jpg"))
                ->type("email", $user2->email)
                ->type("password", $user2->password)
                ->select('select[name="role[]"]', $relations[0]->id)
                ->select('select[name="role[]"]', $relations[1]->id)
                ->type("codenumber", $user2->codenumber)
                ->check("approved")
                ->select("team_id", $user2->team_id)
                ->press('Update')
                ->assertRouteIs('admin.users.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $user2->name)
                ->assertSeeIn("tr:last-child td[field-key='firstname']", $user2->firstname)
                ->assertSeeIn("tr:last-child td[field-key='lastname']", $user2->lastname)
                ->assertSeeIn("tr:last-child td[field-key='phone']", $user2->phone)
                ->assertVisible("img[src='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/thumb/" . \App\User::first()->avatar . "']")
                ->assertSeeIn("tr:last-child td[field-key='email']", $user2->email)
                ->assertSeeIn("tr:last-child td[field-key='role'] span:first-child", $relations[0]->title)
                ->assertSeeIn("tr:last-child td[field-key='role'] span:last-child", $relations[1]->title)
                ->assertSeeIn("tr:last-child td[field-key='codenumber']", $user2->codenumber)
                ->assertChecked("approved")
                ->assertSeeIn("tr:last-child td[field-key='team']", $user2->team->name);
        });
    }

    public function testShowUser()
    {
        $admin = \App\User::find(1);
        $user = factory('App\User')->create();

        $relations = [
            factory('App\Role')->create(), 
            factory('App\Role')->create(), 
        ];

        $user->role()->attach([$relations[0]->id, $relations[1]->id]);

        $this->browse(function (Browser $browser) use ($admin, $user, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.users.index'))
                ->click('tr[data-entry-id="' . $user->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='name']", $user->name)
                ->assertSeeIn("td[field-key='firstname']", $user->firstname)
                ->assertSeeIn("td[field-key='lastname']", $user->lastname)
                ->assertSeeIn("td[field-key='phone']", $user->phone)
                ->assertSeeIn("td[field-key='email']", $user->email)
                ->assertSeeIn("tr:last-child td[field-key='role'] span:first-child", $relations[0]->title)
                ->assertSeeIn("tr:last-child td[field-key='role'] span:last-child", $relations[1]->title)
                ->assertSeeIn("td[field-key='created_by']", $user->created_by->name)
                ->assertSeeIn("td[field-key='codenumber']", $user->codenumber)
                ->assertNotChecked("approved")
                ->assertSeeIn("td[field-key='team']", $user->team->name);
        });
    }

}
