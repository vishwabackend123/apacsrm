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

     public function export_sample_vendor_csv()
    {

        // Define the CSV file headers
        $csvHeader = ['Vendor Code',
                'Name(MD/CEO/President)',
                'Email(MD/CEO/President)',
                'Phone(MD/CEO/President)',
                'LinedIn Connect(MD/CEO/President)',

                'Name(Principle )',
                'Email(Principle)',
                'Phone(Principle)',
                'LinedIn Connect(Principle)',

                'Name(Finance)',
                'Email(Finance)',
                'Phone(Finance)',
                'LinedIn Connect(Finance)',

                'Name(Head Purchase)',
                'Email(Head Purchase)',
                'Phone(Head Purchase)',
                'LinedIn Connect(Head Purchase)',
        ];

        // Create the CSV content
        $filename = 'sample_vendor_details_export.csv';
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
        $data = VendorDetails::select('vendor_code' ,
            'md_name',
            'md_email',
            'md_connect',
            'md_phone' ,
            'principle_name' ,
            'principle_email',
            'principle_phone',
            'principle_connect',
            'finance_name',
            'finance_email',
            'finance_phone',
            'finance_connect',
            'head_name',
            'head_email',
            'head_phone',
            'head_connect')->get()->toArray();;

        // Define the CSV file headers
         $csvHeader = ['Vendor Code',
                'Name(MD/CEO/President)',
                'Email(MD/CEO/President)',
                'Phone(MD/CEO/President)',
                'LinedIn Connect(MD/CEO/President)',

                'Name(Principle )',
                'Email(Principle)',
                'Phone(Principle)',
                'LinedIn Connect(Principle)',

                'Name(Finance)',
                'Email(Finance)',
                'Phone(Finance)',
                'LinedIn Connect(Finance)',

                'Name(Head Purchase)',
                'Email(Head Purchase)',
                'Phone(Head Purchase)',
                'LinedIn Connect(Head Purchase)',
        ];

        // Convert the data to an array
        $csvData = [];
        foreach ($data as $row) {
            $csvData[] = (array) $row;
        }

        // Create the CSV content
        $filename = 'export_vendor_details.csv';
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
        
        return view('admin.vendor_details.import_show');
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
        $header = ['Vendor Code',
                'Name(MD/CEO/President)',
                'Email(MD/CEO/President)',
                'Phone(MD/CEO/President)',
                'LinedIn Connect(MD/CEO/President)',

                'Name(Principle )',
                'Email(Principle)',
                'Phone(Principle)',
                'LinedIn Connect(Principle)',

                'Name(Finance)',
                'Email(Finance)',
                'Phone(Finance)',
                'LinedIn Connect(Finance)',

                'Name(Head Purchase)',
                'Email(Head Purchase)',
                'Phone(Head Purchase)',
                'LinedIn Connect(Head Purchase)',
        ];
        $dataRows = array();

        if (($handle = fopen($path, 'r')) !== false) {
            while (($row = fgetcsv($handle, 1000, ',')) !== false) {
                $dataRows[] = $row;
            }
            fclose($handle);
        } else {
             return redirect()->route('admin.vendor-details.index');
        }
        // Insert data into the database
        foreach ($dataRows as $key=>$row) {
            if ($key===0) {
                continue;
            }
            VendorDetails::updateOrCreate([
                'vendor_code' => $row[0],
            ], [
                'vendor_code'=> $row[0],
                'md_name'=>$row[1],
                'md_email'=>$row[2],
                'md_connect'=>$row[3],
                'md_phone' =>$row[4],
                'principle_name' =>$row[5],
                'principle_email' => $row[6],
                'principle_phone' =>$row[7],
                'principle_connect' =>$row[8],
                'finance_name' =>$row[9],
                'finance_email' =>$row[10],
                'finance_phone' =>$row[11],
                'finance_connect' =>$row[12],
                'head_name' =>$row[13],
                'head_email' =>$row[14],
                'head_phone' =>$row[15],
                'head_connect' =>$row[16]
                // Add other columns as needed
            ]);
        }

        return redirect()->route('admin.vendor-details.index');
    }
}
