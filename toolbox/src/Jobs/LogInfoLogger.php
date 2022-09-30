<?php

namespace Carrollbradford\Toolbox\Jobs;

use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Bus\Queueable;
use Storage;
use Illuminate\Support\Str;

class LogInfoLogger implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
    * @var mixed
    */
    public $msg;

    /**
    * @var string
    */
    public $doc;

    /**
     * Create a new job instance.
     *
     * @param mixed $msg
     * @param mixed $doc
     * @return void
     */
    public function __construct($msg, $doc)
    {
        $this->msg = $msg;
        $this->doc = $doc;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $msg = $this->msg;
        $doc = $this->doc;
        $date = \Carbon::now()->toDateString();

        Storage::disk('log')->prepend("/$date/$doc.txt", $msg);

        $msg = '---->' . $doc . (Str::limit($msg, 500)) . "\r\n\r\n";
        Storage::disk('log')->prepend("$date.'__APP--Hourly--Log.txt", $msg);
    }
}
