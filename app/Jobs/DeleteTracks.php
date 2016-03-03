<?php

namespace App\Jobs;

use App\Track;
use App\Jobs\Job;
use Illuminate\Contracts\Bus\SelfHandling;
use Symfony\Component\Process\Process;

class DeleteTracks extends Job implements SelfHandling
{

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
        $command = "rm -rf " . public_path() . $this->track->path_hq . " " . public_path() . $this->track->path_lq;
        $delete = new Process($command);
        $delete->run();
        $this->track->delete();
    }
}
