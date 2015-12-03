<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TrackController extends Controller
{
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
          
          $track = $request->file('track');
          
          if ($track->isValid()) {
              //save file and create track model
          }
      }
}
