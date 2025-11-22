<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderPlacedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $orderDetails;
    public $customer;

    public function __construct($order, $orderDetails, $customer)
    {
        $this->order = $order;
        $this->orderDetails = $orderDetails;
        $this->customer = $customer;
    }

    public function build()
    {
        return $this->subject('Your Order Creation')
                    ->markdown('emails.order');
    }
}
