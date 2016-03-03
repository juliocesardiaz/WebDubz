<?php

namespace App\Http\Middleware;

use Closure;
use Log;
use DB;
use App\Track;
use App\Jobs\DeleteTracks;
class CheckDownload
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $id = $request->segment(4);
        $track = DB::table('tracks')->where('id', '=', $id)->get()[0];
      //   Log::error($track);
        if($track->max_downloads > $track->current_downloads) {
            return $next($request);  
        } else {
            $job = (new DeleteTracks($track));
            $this->dispatch($job);
            
        }
    }
}
