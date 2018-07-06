<?php

namespace App\Mail;

use App\Http\Controllers\MainData;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class newOrder extends Mailable
{
    use Queueable, SerializesModels;
    use MainData;
    const TITLE_CODE = 1;
    protected $data;

    /**
     * Create a new message instance.
     *
     * @param $data
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('notification.email')->with($this->data);
    }

    protected function getTitleCode()
    {
        self::TITLE_CODE;
    }
}
