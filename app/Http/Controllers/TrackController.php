<?php

namespace App\Http\Controllers;

use DB;
use Log;
use Session;
use App\Track;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Jobs\ConvertHQTracks;
use App\Jobs\DeleteTracks;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class TrackController extends Controller
{
    /**
     *
     */
      protected $tracks;

    /**
     * Welcome page
     *
     * @return welcome.blade.php 
     */
     public function welcome()
     {
           return view('welcome');
     }

     /**
      * Returns a json response with the list of tracks ordered by time added
      *
      * @var \Request
      * @return json
      */
     public function trax(Request $request)
     {
           $tracks = DB::table('tracks')->where('converted', '=', 1)->orderBy('id', 'desc')->get();

           return response()->json(['tracks' => $tracks], 200);
     }

     /**
     * Returns a CSRF token TODO: add a way to use this and make sure user doesn't download a song more than once
     * 
     * @return \Session
     */
     public function getCSRF(Request $request)
     {
           return Session::token();
     }

    /**
     * Takes a POST request and stores the track information in the database and the file into the filesystem
     * it then sends a Job to the Queue, which is to make a low quality version of the file for streaming.
     *
     * @var \Request
     */
      public function store(Request $request)
      {
          $this->validate($request, [
              'title' => 'required|max:255',
              'artist' => 'required|max:255',
              'track' => 'required',
          ]);

          if ($request->file('track')->isValid()) {
            $temp_filename = $this->cleanFileName(strtolower($request->input('artist')) . "_" .strtolower($request->input('title')));
            $file_name = $temp_filename . "_hq." . $request->file('track')->getClientOriginalExtension();
            $hq_path = '/tracks/hq/';
            $lq_path = '/tracks/lq/' . $temp_filename . "_lq." . 'mp3';
            $request->file('track')->move(public_path() . $hq_path, $file_name);
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
      }
      
      /**
      * Checks to see if there are any dowloads let on a specific track. If not it send said track to a Job to be deleted.
      *
      * @var \Request, \Track
      * @return json
      */
      public function checkDownload(Request $request, Track $track)
      {
         $app = app();
         $message_return = $app->make('stdClass');
         if($track->max_downloads > $track->current_downloads) {
            $track->current_downloads += 1;
            $track->save();
            $message_return->message = "success";
            return response()->json(['message_return' => $message_return], 200);
         } else {
            $message_return->message = "failure";
            $job = (new DeleteTracks($track));
            $this->dispatch($job);
            return response()->json(['message_return' => $message_return], 200);
         }
      }

      /**
      * Downloads File 
      *
      * @var \Request, \Track
      * @return json
      */
      public function download(Request $request, Track $track)
      {
            // $track = Track::find($id);
            return response()->download(public_path() . $track->path_hq);
      }
      
      /**
      * Cleans string so it can be safly stored into the files.
      *
      * @var string 
      * @return string
      */
      public function cleanFileName($string) 
      {
         $string = str_replace(' ', '', $string); 
         return preg_replace('/[^A-Za-z0-9\-]/', '', $string);
      }

}
