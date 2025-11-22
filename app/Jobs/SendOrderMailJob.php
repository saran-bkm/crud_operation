<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderPlacedMail;

class SendOrderMailJob implements ShouldQueue
{

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $order;
    public $orderDetails;
    public $customer;

    public function __construct($order, $orderDetails, $customer)
    {
        $this->order = $order;
        $this->orderDetails = $orderDetails;
        $this->customer = $customer;
    }

    public function handle()
    {
        Mail::to($this->customer->email)
            ->send(new OrderPlacedMail($this->order, $this->orderDetails, $this->customer));
    }
}
