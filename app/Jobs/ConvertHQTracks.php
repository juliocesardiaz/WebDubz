<?php

namespace App\Jobs;

use Log;
use App\Track;
use App\Jobs\Job;
use Illuminate\Contracts\Bus\SelfHandling;
use Symfony\Component\Process\Process;

class ConvertHQTracks extends Job implements SelfHandling
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
        $command = '/usr/local/bin/ffmpeg -i  '. public_path() . $this->track->path_hq . ' -vn -ar 44100 -ac 2 -ab 128k -f mp3 ' . public_path() . $this->track->path_lq;
        $convert = new Process($command);
        $convert->run();
        $this->track->converted = 1;
        $this->track->save();
    }
}
