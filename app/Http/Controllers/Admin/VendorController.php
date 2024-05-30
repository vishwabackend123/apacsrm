<?php

namespace App\Http\Controllers\Admin;

use App\Models\Vendor;
use Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreVendorsRequest;
use App\Http\Requests\Admin\UpdateVendorsRequest;
use Illuminate\Http\Request as NRequest;
use Illuminate\Support\Facades\Validator;


class VendorController extends Controller
{
   /**
     * Display a listing of Vendor.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('vendor_access')) {
            return abort(401);
        }
        $vendors = Vendor::all();

        return view('admin.vendors.index', compact('vendors'));
    }

    /**
     * Show the form for creating new Folder.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('vendor_create')) {
            return abort(401);
        }
        
        $created_bies = \App\User::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        return view('admin.vendors.create', compact('created_bies'));
    }

    /**
     * Store a newly created Folder in storage.
     *
     * @param  \App\Http\Requests\StoreVendorsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVendorsRequest $request)
    {
        if (! Gate::allows('vendor_create')) {
            return abort(401);
        }
        $folder = Vendor::create($request->all());



        return redirect()->route('admin.vendors.index');
    }


    /**
     * Show the form for editing Folder.
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

        $vendorEdit = Vendor::findOrFail($id);

        return view('admin.vendors.edit', compact('vendorEdit', 'created_bies'));
    }




    /**
     * Display Folder.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('vendor_view')) {
            return abort(401);
        }
        
        $created_bies = \App\User::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');$files = \App\File::where('folder_id', $id)->get();

        $folder = Vendor::findOrFail($id);
        $userFilesCount = File::where('created_by_id', Auth::getUser()->id)->count();

        return view('admin.vendors.show', compact('folder', 'files', 'userFilesCount'));
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
        $folder = Vendor::findOrFail($id);
        $folder->delete();

        return redirect()->route('admin.vendors.index');
    }
    /**
     * Update Folder in storage.
     *
     * @param  \App\Http\Requests\UpdateVendorsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVendorsRequest $request, $id)
    {
        if (! Gate::allows('vendor_edit')) {
            return abort(401);
        }
        $folder = Vendor::findOrFail($id);
        $folder->update($request->all());



        return redirect()->route('admin.vendors.index');
    }
    public function export_sample_vendor_csv()
    {

        // Define the CSV file headers
        $csvHeader = [
            'Vendor Code', 'ABC Analysis', 'Vendor Name', 'Website', 'Country', 'City' // Add your column headers here
        ];

        // Create the CSV content
        $filename = 'sample_vendor_export.csv';
        $handle = fopen($filename, 'w+');
        fputcsv($handle, $csvHeader);

        

        fclose($handle);

        // Set headers to download the file rather than displaying it
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        // Read the file and return the response
        return response()->download($filename, $filename, $headers)->deleteFileAfterSend(true);
    }
    public function export_vendor_csv($value='')
    {
         // Fetch data from the database
        $data = Vendor::select('vendor_code', 'analysis', 'vendor_name', 'vendor_website', 'vendor_country', 'vendor_city')->get()->toArray();;

        // Define the CSV file headers
         $csvHeader = [
            'Vendor Code', 'ABC Analysis', 'Vendor Name', 'Website', 'Country', 'City' // Add your column headers here
        ];

        // Convert the data to an array
        $csvData = [];
        foreach ($data as $row) {
            $csvData[] = (array) $row;
        }

        // Create the CSV content
        $filename = 'export.csv';
        $handle = fopen($filename, 'w+');
        fputcsv($handle, $csvHeader);

        foreach ($csvData as $row) {
            fputcsv($handle, $row);
        }

        fclose($handle);

        // Set headers to download the file rather than displaying it
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        // Read the file and return the response
        return response()->download($filename, $filename, $headers)->deleteFileAfterSend(true);
    }
    public function import_vendor_show()
    {
        
        return view('admin.vendors.import_show');
    }
    public function import_csv(NRequest $request)
    {
        
         $validator = Validator::make($request->all(), [
            'vendor_file' => 'required|file|mimes:csv,txt|max:2048',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        // Handle the CSV file upload
        $file = $request->file('vendor_file');
        $path = $file->getRealPath();

        // Read and process the CSV file
        $header = [
            'Vendor Code', 'ABC Analysis', 'Vendor Name', 'Website', 'Country', 'City' // Add your column headers here
        ];
        $dataRows = array();

        if (($handle = fopen($path, 'r')) !== false) {
            while (($row = fgetcsv($handle, 1000, ',')) !== false) {
                if (!$header) {
                    $header = $row;
                } else {
                    $dataRows[] = array_combine($header, $row);
                }
            }
            fclose($handle);
        } else {
            return redirect()->route('admin.vendors.index');
        }
        // Insert data into the database
        foreach ($dataRows as $key=>$row) {
            if ($key===0) {
                continue;
            }
            Vendor::updateOrCreate([
                'vendor_code' => $row['Vendor Code'],
            ], [
                'vendor_code' => $row['Vendor Code'],
                'analysis' => $row['ABC Analysis'],
                'vendor_name' => $row['Vendor Name'],
                'vendor_website' => $row['Website'],
                'vendor_country' => $row['Country'],
                'vendor_city' => $row['City'],
                // Add other columns as needed
            ]);
        }

        return redirect()->route('admin.vendors.index');
    }
}
