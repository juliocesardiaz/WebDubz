<?php

namespace App\Http\Controllers;

use App\Track;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Process\Process;

class TrackController extends Controller
{
    /**
      *
      */
      protected $tracks;
    
    // TODO: Finish file upload function 
    /**
      *
      */
      public function store(Request $request)
      {
        //   $this->validate($request, [
        //       'title' => 'required|max:255',
        //       'artist' => 'required|max:255',
        //       'track' => 'required',
        //   ]);
              
          if ($request->file('track')->isValid()) {
              $file_name = $request->input('artist') . "_" .$request->input('title') . "_hq." . $request->file('track')->getClientOriginalExtension();
            $hq_path = public_path().'/tracks/hq';
            $request->file('track')->move($hq_path, $file_name);
            $convert = new Process('touch ' . $file_name);
            $convert->run();
              
          }
        //   return redirect('/');
      }
}
