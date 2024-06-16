<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessTable1Upload;
use App\Jobs\ProcessTable2Upload;
use App\Jobs\ProcessTable3Upload;
use App\Jobs\ProcessTable4Upload;
use Illuminate\Http\Request;

class CsvUploadController extends Controller
{
    public function index()
    {
        return view('csv_upload');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'csv_file_1' => 'required|file|mimes:csv,txt',
            'csv_file_2' => 'required|file|mimes:csv,txt',
            'csv_file_3' => 'required|file|mimes:csv,txt',
            'csv_file_4' => 'required|file|mimes:csv,txt',
        ]);

        $this->processUpload($request->file('csv_file_1'), ProcessTable1Upload::class);
        $this->processUpload($request->file('csv_file_2'), ProcessTable2Upload::class);
        $this->processUpload($request->file('csv_file_3'), ProcessTable3Upload::class);
        $this->processUpload($request->file('csv_file_4'), ProcessTable4Upload::class);

        return back()->with('success', 'Files uploaded successfully.');
    }

    private function processUpload($file, $jobClass)
    {
        $path = $file->getRealPath();
        $data = array_map('str_getcsv', file($path));
        $header = array_shift($data);

        $formattedData = [];
        foreach ($data as $row) {
            $formattedData[] = array_combine($header, $row);
        }

        dispatch(new $jobClass($formattedData));
    }
}
