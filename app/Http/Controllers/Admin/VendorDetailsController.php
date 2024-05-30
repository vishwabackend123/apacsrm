<?php

namespace App\Http\Controllers\Admin;

use Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreVendorDetailssRequest;
use App\Http\Requests\Admin\UpdateVendorsRequest;
use Illuminate\Http\Request as NRequest;
use Illuminate\Support\Facades\Validator;
use App\Models\VendorDetails;
class VendorDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('vendor_details_create')) {
            return abort(401);
        }
        $vendor_details = VendorDetails::all();

        return view('admin.vendor_details.index', compact('vendor_details'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('vendor_create')) {
            return abort(401);
        }
        
        $created_bies = \App\User::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        return view('admin.vendor_details.create', compact('created_bies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVendorDetailssRequest $request)
    {
        if (! Gate::allows('vendor_create')) {
            return abort(401);
        }
        $folder = VendorDetails::create($request->all());



        return redirect()->route('admin.vendor-details.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
     if (! Gate::allows('vendor_view')) {
            return abort(401);
        }
        
        $created_bies = \App\User::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        $folder = VendorDetails::findOrFail($id);

        return view('admin.vendor_details.show', compact('folder'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('vendor_edit')) {
            return abort(401);
        }
        
        $created_bies = \App\User::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        $vendorEdit = VendorDetails::findOrFail($id);

        return view('admin.vendor_details.edit', compact('vendorEdit', 'created_bies'));
    }

    /**
     * Update Folder in storage.
     *
     * @param  \App\Http\Requests\UpdateVendorsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreVendorDetailssRequest $request, $id)
    {
        if (! Gate::allows('vendor_edit')) {
            return abort(401);
        }
        $folder = VendorDetails::findOrFail($id);
        $folder->update($request->all());
        return redirect()->route('admin.vendor-details.index');
    }

   /**
     * Permanently delete Folder from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('vendor__delete')) {
            return abort(401);
        }
        $folder = VendorDetails::findOrFail($id);
        $folder->delete();

         return redirect()->route('admin.vendor-details.index');
    }
}
