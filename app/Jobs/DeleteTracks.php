<?php

namespace App\Jobs;

use Storage;
use App\Track;
use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;

class DeleteTracks extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Track $track)
    {
        $this->track = $track;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
      //   $files = [public_path() . $this->track->path_hq, public_path() . $this->track->path_lq];
      //   Storage::delete($files);
      //   $this->track->delete();
    }
}
