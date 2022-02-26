<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FileController;
use App\Models\City;
use App\Models\Client;
use App\Models\Hub;
use App\Models\Location;
use App\Models\State;
use App\Models\SubLob;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function dashboard(Request $request)
    {

        $fields = $request->validate([
            'auth_user_id' => 'required|integer',
            'q' => 'string',
        ]);


        $q =  null;

        if ($request->has('q')) $q = $request->query('q');

        $auth_user_id = $fields['auth_user_id']; //Auth::user()->id;

        $role = (new FileController)->roles($auth_user_id);

        $status = (new FileController)->actionStatus($role);

        if (empty($status)) {
            $status = [0, 0];
        }

        if ($role == "Administrator" || $role == "CRM") {
            $files = (new FileController)->indexQueryFilter($q);
        } else if ($role == "Assignor") {
            $status = (new FileController)->actionStatus($role);
            $q = $status[0];
            $files = (new FileController)->indexFilter($q);

            $location = "";
            $users = (new FileController)->fieldusers($location);

            $response = [
                'files' => $files,
                'users' => $users,
                'role' => $role
            ];

            return response()->json($response, 201);
        } else {
            $files = (new FileController)->indexUserFilter($auth_user_id, $status, $q);
        }


        $response = [
            'files' => $files,
            'role' => $role
        ];

        return response()->json($response, 201);
    }


    public function files(Request $request)
    {

        $fields = $request->validate([
            'auth_user_id' => 'required|integer',
            'q' => 'string',
        ]);


        $q =  null;

        if ($request->has('q')) $q = $request->query('q');

        $auth_user_id = $fields['auth_user_id']; //Auth::user()->id;

        $role = (new FileController)->roles($auth_user_id);

        $status = (new FileController)->actionStatus($role);

        if (empty($status)) {
            $status = [0, 0];
        }

        if ($role == "Administrator" || $role == "CRM") {
            $files = (new FileController)->indexQueryFilter($q);
        } else if ($role == "Assignor") {
            $status = (new FileController)->actionStatus($role);
            $q = $status[0];
            $files = (new FileController)->indexFilter($q);

            $location = "";
            $users = (new FileController)->fieldusers($location);

            $response = [
                'files' => $files,
                'users' => $users,
                'role' => $role
            ];

            return response()->json($response, 201);
        } else {
            $files = (new FileController)->indexUserFilter($auth_user_id, $status, $q);
        }


        $response = [
            'files' => $files,
            'role' => $role
        ];

        return response()->json($response, 201);
    }







    public function client(Request $request)
    {

        $fields = $request->validate([
            'clientid' => 'required|integer',
        ]);

        $client = Client::find($fields['clientid']);

        $response = [
            'client' => $client,
        ];

        return response()->json($response, 201);
    }

    public function sublob(Request $request)
    {

        $fields = $request->validate([
            'sublobid' => 'required|integer',
        ]);

        $sublob = SubLob::find($fields['sublobid']);

        $response = [
            'sublob' => $sublob,
        ];

        return response()->json($response, 201);
    }

    public function hub(Request $request)
    {

        $fields = $request->validate([
            'hubid' => 'required|integer',
        ]);

        $hub = Hub::find($fields['hubid']);

        $response = [
            'hubs' => $hub,
        ];

        return response()->json($response, 201);
    }

    public function state(Request $request)
    {

        $fields = $request->validate([
            'stateid' => 'required|integer',
        ]);

        $state = State::find($fields['stateid']);

        $response = [
            'state' => $state,
        ];

        return response()->json($response, 201);
    }

    public function city(Request $request)
    {

        $fields = $request->validate([
            'cityid' => 'required|integer',
        ]);

        $city = City::find($fields['cityid']);

        $response = [
            'city' => $city,
        ];

        return response()->json($response, 201);
    }

    public function location(Request $request)
    {

        $fields = $request->validate([
            'locationid' => 'required|integer',
        ]);

        $location = Location::find($fields['locationid']);

        $response = [
            'location' => $location,
        ];

        return response()->json($response, 201);
    }
}
