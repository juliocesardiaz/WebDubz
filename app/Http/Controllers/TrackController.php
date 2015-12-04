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
          $this->validate($request, [
              'title' => 'required|max:255',
              'artist' => 'required|max:255',
              'track' => 'required',
          ]);
              
          if ($request->file('track')->isValid()) {
            $file_name = $request->input('artist') . "_" .$request->input('title') . "_hq." . $request->file('track')->getClientOriginalExtension();
            $hq_path = public_path().'/tracks/hq/';
            $lq_path = public_path().'/tracks/lq/' . $request->input('artist') . "_" .$request->input('title') . "_lq." . 'mp3';
            $request->file('track')->move($hq_path, $file_name);
            $hq_path .= $file_name;
            $convert = new Process('ffmpeg -i '. $hq_path . ' -vn -ar 44100 -ac 2 -ab 128k -f mp3 ' . $lq_path);
            $convert->run();
              
          }
          
          $track = new Track;
          $track->title = $request->input('title');
          $track->artist = $request->input('artist');
          $track->path_lq = $lq_path;
          $track->path_hq = $hq_path;
          $track->max_downloads = $request->input('max_downloads');
          $track->current_downloads = 0;
          $track->save();
          
          return redirect('/');
      }
}
