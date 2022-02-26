<?php

use App\Http\Controllers\AreaController;
use App\Http\Controllers\CaseResponseController;
use App\Http\Controllers\CaseSummaryController;
use App\Http\Controllers\CaseTrackerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ClientGstController;
use App\Http\Controllers\ClientStateController;
use App\Http\Controllers\ClientStateUserController;
use App\Http\Controllers\DocumentLobController;
use App\Http\Controllers\DocumentsController;
use App\Http\Controllers\DropdownController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\FileuploadController;
use App\Http\Controllers\GroupMapController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HubController;
use App\Http\Controllers\HubLocController;
use App\Http\Controllers\LobController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\LookUpController;
use App\Http\Controllers\QuestionsController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RoleWorkFlowController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\SubLobController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskRoleController;
use App\Http\Controllers\TaskUserController;
use App\Http\Controllers\UserClientController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserFilesController;
use App\Http\Controllers\UserGroupController;
use App\Http\Controllers\UserLobController;
use App\Http\Controllers\UserLocController;
use App\Http\Controllers\UserLogController;
use App\Http\Controllers\UserRoleController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\WorkFlowController;
use App\Http\Controllers\ZoneController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
  return view('auth.login');
});



Auth::routes();


Route::middleware('auth')->group(function () {

  Route::get('/home', [HomeController::class, 'index'])->name('home');

  Route::resource('areas', AreaController::class);
  Route::resource('caseresponses', CaseResponseController::class);
  Route::resource('casesummaries', CaseSummaryController::class);
  Route::resource('casetrackers', CaseTrackerController::class);
  Route::resource('categories', CategoryController::class);
  Route::resource('cities', CityController::class);
  Route::resource('clients', ClientController::class);
  Route::resource('clientgsts', ClientGstController::class);
  Route::resource('clientstates', ClientStateController::class);
  Route::resource('clientstateusers', ClientStateUserController::class);
  Route::resource('documentlobs', DocumentLobController::class);
  Route::resource('documents', DocumentsController::class);
  Route::resource('files', FileController::class);
  Route::resource('fileupload', FileuploadController::class);
  Route::resource('groupmaps', GroupMapController::class);
  Route::resource('hubs', HubController::class);
  Route::resource('hublocs', HubLocController::class);
  Route::resource('lobs', LobController::class);
  Route::resource('locations', LocationController::class);
  Route::resource('lookups', LookUpController::class);
  Route::resource('questions', QuestionsController::class);
  Route::resource('roles', RoleController::class);
  Route::resource('roleworkflows', RoleWorkFlowController::class);
  Route::resource('states', StateController::class);
  Route::resource('sublobs', SubLobController::class);
  Route::resource('tasks', TaskController::class);
  Route::resource('taskusers', TaskUserController::class);
  Route::resource('taskroles', TaskRoleController::class);
  Route::resource('users', UserController::class);
  Route::resource('userclients', UserClientController::class);
  Route::resource('userfiles', UserfilesController::class);
  Route::resource('usergroups', UserGroupController::class);
  Route::resource('userlobs', UserLobController::class);
  Route::resource('userlocs', UserLocController::class);
  Route::resource('userlogs', UserLogController::class);
  Route::resource('userroles', UserRoleController::class);
  Route::resource('vendors', VendorController::class);
  Route::resource('workflows', WorkFlowController::class);
  Route::resource('zones', ZoneController::class);

  Route::get('/createcaseclient', [FileController::class, 'createcaseclient'])->name('files.createcaseclient');
  Route::post('/createcase', [FileController::class, 'createcase'])->name('files.createcase');
  Route::post('/storecase', [FileController::class, 'storecase'])->name('files.storecase');
  Route::get('assigntasktofile', [FileController::class, 'assigntasktofile'])->name('assigntasktofile');
  Route::get('delete_assigntasktofile', [FileController::class, 'delete_assigntasktofile'])->name('delete_assigntasktofile');
  
  Route::post('/uploadfile', [FileuploadController::class, 'uploadfile'])->name('fileupload.uploadfile');
  Route::get('fileupload/{id}/show', [FileuploadController::class, 'show'])->name('fileupload.show');
  Route::get('validateBatchfile', [FileuploadController::class, 'validateBatchfile'])->name('validateBatchfile');
  Route::get('importBatchfile', [FileuploadController::class, 'importBatchfile'])->name('importBatchfile');
  //Route::get('/upload', [FileuploadController::class, 'upload'])->name('fileupload.upload');

  Route::get('getsublobs', [DropdownController::class, 'getSubLobs'])->name('getsublobs');
  Route::get('getzones', [DropdownController::class, 'getZones'])->name('getzones');
  Route::get('getstatesfromzones', [DropdownController::class, 'getStatesFromZones'])->name('getstatesfromzones');
  Route::get('getstates', [DropdownController::class, 'getStates'])->name('getstates');
  Route::get('getcities', [DropdownController::class, 'getCities'])->name('getcities');
  Route::get('getlocations', [DropdownController::class, 'getLocations'])->name('getlocations');

  Route::get('cityData', [CityController::class, 'cityData'])->name('cityData');

  Route::get('/questionslob', [QuestionsController::class, 'questionslob'])->name('questionslob');
  Route::get('/questionslob/{id}', [QuestionsController::class, 'questions']);
  Route::get('/questionslobbg/{id}', [QuestionsController::class, 'questionsBg']);
  // Route::get('/questionsgroups/{id}', [QuestionsController::class, 'questionsgroups']);
  Route::get('/questionsgroups', [QuestionsController::class, 'questionsgroups']);

  Route::get('/lookupslob/{id}', [LookUpController::class, 'lookups']);

  Route::post('/caseresponse', [CaseResponseController::class, 'caseresponse'])->name('caseresponses.caseresponse');
  Route::post('/caseresponses/{id}', [CaseResponseController::class, 'verify'])->name('caseresponses.verify');
  Route::get('/editcaseresponses/{id}', [CaseResponseController::class, 'editcaseresponses'])->name('caseresponses.editcaseresponses');
  Route::patch('/updatecaseresponses/{id}', [CaseResponseController::class, 'updatecaseresponses'])->name('caseresponses.updatecaseresponses');

  Route::get('/editcasetrackers/{id}', [CasetrackerController::class, 'editcasetrackers'])->name('casetrackers.editcasetrackers');
  Route::patch('/updatecasetrackers/{id}', [CasetrackerController::class, 'updatecasetrackers'])->name('casetrackers.updatecasetrackers');
  Route::get('/updatecasetrackersreturn/{id}', [CasetrackerController::class, 'updatecasetrackersreturn'])->name('casetrackers.updatecasetrackersreturn');

  Route::get('/assignfile/{id}', [FileController::class, 'assignfile'])->name('files.assignfile');
  Route::post('/updateassignfile', [FileController::class, 'updateassignfile'])->name('files.updateassignfile');
  Route::get('/reassignfile', [FileController::class, 'indexReassign'])->name('files.reassignfile');



  Route::post('/assignorcases', [CasetrackerController::class, 'assignorcases'])->name('assignorcases');

  Route::post('/fileupload/{id}', [CaseResponseController::class, 'fileupload']);


  Route::get('/policyno', [ReportController::class, 'reportpolicyno'])->name('reports.policyno');
  Route::post('/policy', [ReportController::class, 'reportpolicy'])->name('reports.policy');

  Route::get('generate-pdf', [ReportController::class, 'generatePDF'])->name('generate-pdf');
});
