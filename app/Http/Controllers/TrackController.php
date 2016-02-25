<?php

namespace App\Http\Controllers;

use DB;
use App\Track;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Jobs\ConvertHQTracks;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Process\Process;

class TrackController extends Controller
{
    /**
     *
     */
      protected $tracks;
    
    /**
     *
     */
     public function welcome()
     {
           return view('welcome');
     }
    /**
     *
     */
     public function uploadPage()
     {
           return view('upload');
     } 
     
     /**
      *
      */
     public function index(Request $request)
     {
           $tracks = DB::table('tracks')->where('converted', '=', 1)->get();
           
           return view('tracks', [
                 'tracks' => $tracks,
           ]);
     }
    
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
            $temp_filename = str_replace(" ", "", strtolower($request->input('artist')) . "_" .strtolower($request->input('title')));
            $file_name = $temp_filename . "_hq." . $request->file('track')->getClientOriginalExtension();
            $hq_path = '/tracks/hq/';
            $lq_path = '/tracks/lq/' . $temp_filename . "_lq." . 'mp3';
            $request->file('track')->move(public_path().$hq_path, $file_name);
            $hq_path .= $file_name;              
          }
          
          $track = new Track;
          $track->title = $request->input('title');
          $track->artist = $request->input('artist');
          $track->path_lq = $lq_path;
          $track->path_hq = $hq_path;
          $track->max_downloads = $request->input('max_downloads');
          $track->current_downloads = 0;
          $track->converted = 0;
          $track->save();
          $job = (new ConvertHQTracks($track));
          $this->dispatch($job);
          
          return redirect('/dubz');
          
      }
      
      /**
      *
      */
      public function download(Request $request, Track $track)
      {
            return response()->download(public_path().$track->path_hq);
      }
}
