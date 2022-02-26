<?php

namespace App\Http\Controllers;

use App\Http\Requests\VendorRequest;
use App\Models\City;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $q = null;

        if ($request->has('q')) $q = $request->query('q');

        $vendors = Vendor::SearchVendors($q)
            ->paginate(10);

        return view('vendors.index')->with([
            'vendors' => $vendors
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities =  City::all()->sortBy("name");

        return view('vendors.create')->with([
            'cities' => $cities,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VendorRequest $request, Vendor $vendor)
    {
        $request->validated();

        $vendor->fill($request->all());
        $vendor->status = 1;
        $vendor->dtcr = now();
        $vendor->crby = Auth::user()->id;
        $vendor->dtlm = now();
        $vendor->lmby = Auth::user()->id;
        $vendor->save();
        return redirect()
            ->route('vendors.index')
            ->withSuccess("New Vendor with id {$vendor->id} was created");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function show(Vendor $vendor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function edit(Vendor $vendor)
    {
        $cities =  City::all()->sortBy("name");

        return view('vendors.edit')->with([
            'cities' => $cities,
            'vendor' => $vendor,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function update(VendorRequest $request, Vendor $vendor)
    {
        $request->validated();
        $vendor->fill($request->all());
        $vendor->dtlm = now();
        $vendor->lmby = Auth::user()->id;
        $vendor->save();

        return redirect()
            ->route('vendors.index')
            ->withSuccess("The Vendor with id {$vendor->id} was updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vendor $vendor)
    {
        //
    }
}
