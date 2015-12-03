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
          $track = $request->file('track');
          if ($track->isValid()) {
              
          }
      }
}
