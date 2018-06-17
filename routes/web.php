<?php
Route::get('/', function () { return redirect('/admin/home'); });

// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\LoginController@login')->name('auth.login');
$this->post('logout', 'Auth\LoginController@logout')->name('auth.logout');

// Change Password Routes...
$this->get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
$this->patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('auth.password.reset');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('auth.password.reset');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset')->name('auth.password.reset');

// Registration Routes..
$this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('auth.register');
$this->post('register', 'Auth\RegisterController@register')->name('auth.register');

// Social Login Routes..
Route::get('login/{driver}', 'Auth\LoginController@redirectToSocial')->name('auth.login.social');
Route::get('{driver}/callback', 'Auth\LoginController@handleSocialCallback')->name('auth.login.social_callback');

Route::group(['middleware' => ['auth', 'approved'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/home', 'HomeController@index');
    
    Route::resource('permissions', 'Admin\PermissionsController');
    Route::post('permissions_mass_destroy', ['uses' => 'Admin\PermissionsController@massDestroy', 'as' => 'permissions.mass_destroy']);
    Route::resource('roles', 'Admin\RolesController');
    Route::post('roles_mass_destroy', ['uses' => 'Admin\RolesController@massDestroy', 'as' => 'roles.mass_destroy']);
    Route::resource('users', 'Admin\UsersController');
    Route::post('users_mass_destroy', ['uses' => 'Admin\UsersController@massDestroy', 'as' => 'users.mass_destroy']);
    Route::resource('teams', 'Admin\TeamsController');
    Route::post('teams_mass_destroy', ['uses' => 'Admin\TeamsController@massDestroy', 'as' => 'teams.mass_destroy']);
    Route::resource('nominateds', 'Admin\NominatedsController');
    Route::post('nominateds_mass_destroy', ['uses' => 'Admin\NominatedsController@massDestroy', 'as' => 'nominateds.mass_destroy']);
    Route::post('nominateds_restore/{id}', ['uses' => 'Admin\NominatedsController@restore', 'as' => 'nominateds.restore']);
    Route::delete('nominateds_perma_del/{id}', ['uses' => 'Admin\NominatedsController@perma_del', 'as' => 'nominateds.perma_del']);
    Route::resource('vivodeships', 'Admin\VivodeshipsController');
    Route::post('vivodeships_mass_destroy', ['uses' => 'Admin\VivodeshipsController@massDestroy', 'as' => 'vivodeships.mass_destroy']);
    Route::post('vivodeships_restore/{id}', ['uses' => 'Admin\VivodeshipsController@restore', 'as' => 'vivodeships.restore']);
    Route::delete('vivodeships_perma_del/{id}', ['uses' => 'Admin\VivodeshipsController@perma_del', 'as' => 'vivodeships.perma_del']);
    Route::resource('trades', 'Admin\TradesController');
    Route::post('trades_mass_destroy', ['uses' => 'Admin\TradesController@massDestroy', 'as' => 'trades.mass_destroy']);
    Route::post('trades_restore/{id}', ['uses' => 'Admin\TradesController@restore', 'as' => 'trades.restore']);
    Route::delete('trades_perma_del/{id}', ['uses' => 'Admin\TradesController@perma_del', 'as' => 'trades.perma_del']);
    Route::resource('companies', 'Admin\CompaniesController');
    Route::post('companies_mass_destroy', ['uses' => 'Admin\CompaniesController@massDestroy', 'as' => 'companies.mass_destroy']);
    Route::post('companies_restore/{id}', ['uses' => 'Admin\CompaniesController@restore', 'as' => 'companies.restore']);
    Route::delete('companies_perma_del/{id}', ['uses' => 'Admin\CompaniesController@perma_del', 'as' => 'companies.perma_del']);
    Route::resource('tasks', 'Admin\TasksController');
    Route::post('tasks_mass_destroy', ['uses' => 'Admin\TasksController@massDestroy', 'as' => 'tasks.mass_destroy']);
    Route::resource('task_statuses', 'Admin\TaskStatusesController');
    Route::post('task_statuses_mass_destroy', ['uses' => 'Admin\TaskStatusesController@massDestroy', 'as' => 'task_statuses.mass_destroy']);
    Route::resource('task_tags', 'Admin\TaskTagsController');
    Route::post('task_tags_mass_destroy', ['uses' => 'Admin\TaskTagsController@massDestroy', 'as' => 'task_tags.mass_destroy']);
    Route::resource('task_calendars', 'Admin\TaskCalendarsController');
    Route::resource('adverts', 'Admin\AdvertsController');
    Route::post('adverts_mass_destroy', ['uses' => 'Admin\AdvertsController@massDestroy', 'as' => 'adverts.mass_destroy']);
    Route::post('adverts_restore/{id}', ['uses' => 'Admin\AdvertsController@restore', 'as' => 'adverts.restore']);
    Route::delete('adverts_perma_del/{id}', ['uses' => 'Admin\AdvertsController@perma_del', 'as' => 'adverts.perma_del']);
    Route::resource('catadverts', 'Admin\CatadvertsController');
    Route::post('catadverts_mass_destroy', ['uses' => 'Admin\CatadvertsController@massDestroy', 'as' => 'catadverts.mass_destroy']);
    Route::post('catadverts_restore/{id}', ['uses' => 'Admin\CatadvertsController@restore', 'as' => 'catadverts.restore']);
    Route::delete('catadverts_perma_del/{id}', ['uses' => 'Admin\CatadvertsController@perma_del', 'as' => 'catadverts.perma_del']);
    Route::resource('programs', 'Admin\ProgramsController');
    Route::post('programs_mass_destroy', ['uses' => 'Admin\ProgramsController@massDestroy', 'as' => 'programs.mass_destroy']);
    Route::post('programs_restore/{id}', ['uses' => 'Admin\ProgramsController@restore', 'as' => 'programs.restore']);
    Route::delete('programs_perma_del/{id}', ['uses' => 'Admin\ProgramsController@perma_del', 'as' => 'programs.perma_del']);
    Route::resource('projects', 'Admin\ProjectsController');
    Route::post('projects_mass_destroy', ['uses' => 'Admin\ProjectsController@massDestroy', 'as' => 'projects.mass_destroy']);
    Route::post('projects_restore/{id}', ['uses' => 'Admin\ProjectsController@restore', 'as' => 'projects.restore']);
    Route::delete('projects_perma_del/{id}', ['uses' => 'Admin\ProjectsController@perma_del', 'as' => 'projects.perma_del']);
    Route::resource('catawards', 'Admin\CatawardsController');
    Route::post('catawards_mass_destroy', ['uses' => 'Admin\CatawardsController@massDestroy', 'as' => 'catawards.mass_destroy']);
    Route::post('catawards_restore/{id}', ['uses' => 'Admin\CatawardsController@restore', 'as' => 'catawards.restore']);
    Route::delete('catawards_perma_del/{id}', ['uses' => 'Admin\CatawardsController@perma_del', 'as' => 'catawards.perma_del']);
    Route::resource('awards', 'Admin\AwardsController');
    Route::post('awards_mass_destroy', ['uses' => 'Admin\AwardsController@massDestroy', 'as' => 'awards.mass_destroy']);
    Route::post('awards_restore/{id}', ['uses' => 'Admin\AwardsController@restore', 'as' => 'awards.restore']);
    Route::delete('awards_perma_del/{id}', ['uses' => 'Admin\AwardsController@perma_del', 'as' => 'awards.perma_del']);
    Route::resource('catnotes', 'Admin\CatnotesController');
    Route::post('catnotes_mass_destroy', ['uses' => 'Admin\CatnotesController@massDestroy', 'as' => 'catnotes.mass_destroy']);
    Route::post('catnotes_restore/{id}', ['uses' => 'Admin\CatnotesController@restore', 'as' => 'catnotes.restore']);
    Route::delete('catnotes_perma_del/{id}', ['uses' => 'Admin\CatnotesController@perma_del', 'as' => 'catnotes.perma_del']);
    Route::get('internal_notifications/read', 'Admin\InternalNotificationsController@read');
    Route::resource('internal_notifications', 'Admin\InternalNotificationsController');
    Route::post('internal_notifications_mass_destroy', ['uses' => 'Admin\InternalNotificationsController@massDestroy', 'as' => 'internal_notifications.mass_destroy']);
    Route::resource('notes', 'Admin\NotesController');
    Route::post('notes_mass_destroy', ['uses' => 'Admin\NotesController@massDestroy', 'as' => 'notes.mass_destroy']);
    Route::post('notes_restore/{id}', ['uses' => 'Admin\NotesController@restore', 'as' => 'notes.restore']);
    Route::delete('notes_perma_del/{id}', ['uses' => 'Admin\NotesController@perma_del', 'as' => 'notes.perma_del']);
    Route::resource('organizations', 'Admin\OrganizationsController');
    Route::post('organizations_mass_destroy', ['uses' => 'Admin\OrganizationsController@massDestroy', 'as' => 'organizations.mass_destroy']);
    Route::post('organizations_restore/{id}', ['uses' => 'Admin\OrganizationsController@restore', 'as' => 'organizations.restore']);
    Route::delete('organizations_perma_del/{id}', ['uses' => 'Admin\OrganizationsController@perma_del', 'as' => 'organizations.perma_del']);
    Route::resource('years', 'Admin\YearsController');
    Route::post('years_mass_destroy', ['uses' => 'Admin\YearsController@massDestroy', 'as' => 'years.mass_destroy']);
    Route::post('years_restore/{id}', ['uses' => 'Admin\YearsController@restore', 'as' => 'years.restore']);
    Route::delete('years_perma_del/{id}', ['uses' => 'Admin\YearsController@perma_del', 'as' => 'years.perma_del']);
    Route::post('/spatie/media/upload', 'Admin\SpatieMediaController@create')->name('media.upload');
    Route::post('/spatie/media/remove', 'Admin\SpatieMediaController@destroy')->name('media.remove');

    Route::model('messenger', 'App\MessengerTopic');
    Route::get('messenger/inbox', 'Admin\MessengerController@inbox')->name('messenger.inbox');
    Route::get('messenger/outbox', 'Admin\MessengerController@outbox')->name('messenger.outbox');
    Route::resource('messenger', 'Admin\MessengerController');

    Route::post('csv_parse', 'Admin\CsvImportController@parse')->name('csv_parse');
    Route::post('csv_process', 'Admin\CsvImportController@process')->name('csv_process');

    Route::get('search', 'MegaSearchController@search')->name('mega-search');
});
