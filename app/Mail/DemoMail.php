<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Attachment;


// This class is a custom Mailable class used to define the structure of an email in Laravel.
class DemoMail extends Mailable
{
    // These traits allow the email to be queued and properly serialized when stored for queuing.
    use Queueable, SerializesModels;

    // Public variable to store data passed to the mail class (like subject, view name, PDF, etc.)
    public $mailData;

    /**
     * Constructor function that gets executed when the class is instantiated.
     * It accepts an array `$mailData` which holds email-related info like subject, view, and attachments.
     */
    public function __construct($mailData)
    {
        // Storing passed data into a public property so it can be used throughout the class.
        $this->mailData = $mailData;
    }

    /**
     * This method defines the envelope (i.e., subject, from, reply-to, etc.)
     * It's a new Laravel 9+ feature. Commented out here, so it's not actively used.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            // 'subject' defines the email subject, usually passed from $mailData.
            // subject: $this->mailData['subject'],
        );
    }

    /**
     * Defines the content of the email — like which view to render and data to pass into it.
     * Also a newer feature from Laravel 9+. Not being used here since `build()` is used instead.
     */
    public function content(): Content
    {
        return new Content(
            // View file that should be rendered as the email content.
            // view: 'qa.mrm.agenda.email.agenda',

            // Data passed to that view
            // with: $this->mailData
        );
    }

    /**
     * This is for attaching files using Laravel's newer mail structure (not used here).
     * Instead, the attachment is handled in the `build()` method.
     */
    public function attachments(): array
    {
        return [
            // This shows how you'd attach a PDF dynamically created in memory.
            // Attachment::fromData(fn() => $this->mailData['pdf']->output(), 'Agenda.pdf')
            // ->withMime('application/pdf'),
        ];
    }

    /**
     * This method is used in Laravel < 9 or when you're not using the envelope/content structure.
     * It builds and returns the complete email, including subject, view, and attachments.
     */
    public function build()
    {
        return $this->view($this->mailData['view']) // Load the Blade view for email content
            ->subject($this->mailData['subject'])  // Set email subject
            ->attachData(                          // Attach a file in memory
                $this->mailData['pdf']->output(),  // PDF binary data generated dynamically
                $this->mailData['fileName'],       // Filename of the attached PDF
                ['mime' => 'application/pdf']      // Define MIME type
            );
    }
}
