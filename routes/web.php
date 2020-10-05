<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::view('/', 'homepage');
Route::view('/about' , 'about');
Route::view('/contact' ,'contact');
// Route::view('/build', 'build');
// Route::view('/choice', 'choice');
Route::get('/lounge', 'LoungeController@index');
Route::get('/properties','PropertiesController@index');
Route::get('/Ideas', 'ideasController@show');
Route::get('/professionals', 'ProfessionalsController@index');

Route::resource('/categories','CategoryController');
// Route::get('/categories','CategoriesController@index');
// Route::get('/categories/create','CategoriesController@create');
// Route::get('/categories/{category}','CategoriesController@show');
// Route::post('/categories','CategoriesController@store');
// Route::get('/categories/{category}/edit','CategoriesController@edit');
// Route::patch('/categories/{category}','CategoriesController@update');
// Route::delete('/categories/{category}','CategoriesController@destroy');

Route::get('/company','companyAdminAreaController@show');

Route::resource('companies','CompaniesController');
// Route::get('/companies','CompaniesController@index');
// Route::get('/companies/{company}','CompaniesController@show');
// Route::get('/companies/create','CompaniesController@create');
// Route::post('/companies','CompaniesController@store');
// Route::get('/companies/{company}/edit','CompaniesController@edit');
// Route::patch('/companies/{company}','CompaniesController@update');
// Route::delete('/companies/{company}','CompaniesController@destroy');


//images
Route::resource('images','ImageController')->only(['update','destroy']);


Route::get('/register/companies','Auth\CompanyRegisterController@showRegistrationForm');
Route::post('/register/companies','Auth\CompanyRegisterController@register');
Route::get('/login/companies','Auth\CompanyLoginController@showLoginForm')->name('companyLogin');
Route::post('/login/companies','Auth\CompanyLoginController@login');
Route::post('/logout/companies','Auth\CompanyLoginController@logout');

//admin
Route::get('/admins','AdminsController@show');
Route::get('/login/admins' , 'Auth\AdminLoginController@showLoginForm')->name('adminLogin');
Route::post('/login/admins','Auth\AdminLoginController@login');


// Route::view('/register/admins','adminRegister');
Route::post('/register/admins','Auth\AdminRegisterController@register');
Route::post('/logout/admins','Auth\AdminLoginController@logout');
Route::patch('/admins/{admin}','AdminsController@update');
Route::delete('/admins/{admin}','AdminsController@destroy');

//Favourites
Route::post('/favourites/rentals/{rental}','rentalFavouritesController@store');
Route::delete('/favourites/rentals/{rental}','rentalFavouritesController@destroy');

Route::post('/favourites/hostels/{hostel}','hostelFavouritesController@store');
Route::delete('/favourites/hostels/{hostel}','hostelFavouritesController@destroy');

Route::post('/favourites/communities/{community}','communityFavouritesController@store');
Route::delete('/favourites/communities/{community}','communityFavouritesController@destroy');

Route::post('/favourites/standalones/{standalone}','standaloneFavouritesController@store');
Route::delete('/favourites/standalones/{standalone}','standaloneFavouritesController@destroy');

Route::post('/favourites/workspaces/{workspace}','workspaceFavouritesController@store');
Route::delete('/favourites/workspaces/{workspace}','workspaceFavouritesController@destroy');

//Users
Route::patch('/users/{user}','UsersController@update');
Route::delete('/users/{user}','UsersController@destroy');

//Agents
Route::get('/agents','AgentController@show');

Route::get('/register/agents','Auth\AgentRegisterController@showRegistrationForm');
Route::post('/register/agents','Auth\AgentRegisterController@register');
Route::get('/login/agents','Auth\AgentLoginController@showLoginForm')->name('agentLogin');
Route::post('/login/agents','Auth\AgentLoginController@login');
Route::post('/logout/agents','Auth\AgentLoginController@logout');

//owners
// Route::resource('owners','OwnerController')->only(['index,show','update']);
Route::get('/owners','OwnerController@index');
Route::get('/owners/{owner}','OwnerController@show');
Route::patch('/owners/{owner}','OwnerController@update');
Route::delete('/owners/{owner}','OwnerController@destroy');


Route::get('/register/owners','Auth\OwnerRegisterController@showRegistrationForm');
Route::post('/register/owners','Auth\OwnerRegisterController@register');
Route::get('/login/owners','Auth\OwnerLoginController@showLoginForm')->name('ownerLogin');
Route::post('/login/owners','Auth\OwnerLoginController@login');
Route::post('/logout/owners','Auth\OwnerLoginController@logout');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');


Route::resource('rentals','RentalController');
Route::resource('hostels','HostelController');
Route::resource('communities','CommunityController');
Route::resource('standalones','StandaloneController');
Route::resource('workspaces','WorkspaceController');
Route::resource('tags','TagController');
Route::resource('posts','PostController')->only(['store','destroy']);

//Addition to communities
Route::get('/communities/{community}/units','CommunityUnitsController@index');
Route::post('/communities/{community}/rentals/{rental}','CommunityRentalController@store');
Route::post('/communities/{community}/hostels/{hostel}','CommunityHostelController@store');
Route::post('/communities/{community}/standalones/{standalone}','CommunityStandaloneController@store');
Route::post('/communities/{community}/workspaces/{workspace}','CommunityWorkspaceController@store');
Route::delete('/community/{community}/rentals/{rental}','CommunityRentalController@destroy');
Route::delete('/community/{community}/hostels/{hostel}','CommunityHostelController@destroy');
Route::delete('/community/{community}/standalones/{standalone}','CommunityStandaloneController@destroy');
Route::delete('/community/{community}/workspaces/{workspace}','CommunityWorkspaceController@destroy');
//Diaries
Route::get('/diary','DiaryEntriesController@show');
Route::post('/diary/{post}','DiaryEntriesController@store');
Route::delete('/diary/{post}','DiaryEntriesController@destroy');

//Bookings
Route::get('/book_rental/{rental}','RentalBookingsController@index');
Route::post('/book_rental/{rental}','RentalBookingsController@store');
Route::delete('/book_rental/{rental}','RentalBookingsController@destroy');

Route::get('/book_hostel/{hostel}','HostelBookingsController@index');
Route::post('/book_hostel/{hostel}','HostelBookingsController@store');
Route::delete('/book_hostel/{hostel}','HostelBookingsController@destroy');

Route::get('/book_workspace/{workspace}','WorkspaceBookingsController@index');
Route::post('/book_workspace/{workspace}','WorkspaceBookingsController@store');
Route::delete('/book_workspace/{workspace}','WorkspaceBookingsController@destroy');

Route::resource('visits','VisitController');
Route::get('/visits/rentals/{rental}','RentalVisitsController@index');
Route::post('/visits/rentals/{rental}','RentalVisitsController@store');
Route::delete('/visits/rentals/{rental}','RentalVisitsController@delete');

//Partials
Route::get('/community_list',function () {
  $list = App\Community::where('communityable_id',auth('owner')->id())->get();
  return response()->json($list);
})->middleware('auth:owner');
