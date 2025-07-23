<?php

namespace App\Http\Controllers\Qa\Mrm;

use App\Mail\DemoMail;
use App\Models\MrmAgenda;
use App\Models\MrmMinutes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function agendamail($id)
    {
        $agenda = MrmAgenda::find($id);
        // $meeting_no = $agenda->meeting_no;

        $recipients = [
            "muhammad.umair@medzntech.com",
            "meeting@medzntech.com",
        ];

        $mailData = [
            'subject' => "Management Review Agenda",
            'view' => "qa.mrm.agenda.email.message",                // email message
            'attachment' => "qa.mrm.agenda.email.attachment",       // email attachment
            'fileName' => "Agenda.pdf",                             // attachment name


            'meeting_no' => $agenda->meeting_no,
            'meeting_date' => $agenda->meeting_date,
            'review_period' => $agenda->review_period,
            'start_time' => $agenda->start_time,
            'end_time' => $agenda->end_time,
            'venue' => $agenda->venue,
            'review_item1' => $agenda->review_item1,
            'review_item2' => $agenda->review_item2,
            'review_item3' => $agenda->review_item3,
            'review_item4' => $agenda->review_item4,
            'review_item5' => $agenda->review_item5,
            'review_item6' => $agenda->review_item6,
            'review_item7' => $agenda->review_item7,
            'review_item8' => $agenda->review_item8,
            'review_item9' => $agenda->review_item9,
            'review_item10' => $agenda->review_item10,
            'review_item11' => $agenda->review_item11,
            'review_item12' => $agenda->review_item12,
            'review_item13' => $agenda->review_item13,
            'review_item14' => $agenda->review_item14,
            'review_item15' => $agenda->review_item15,
            'review_item16' => $agenda->review_item16,
            'review_item17' => $agenda->review_item17,
            'review_item18' => $agenda->review_item18,
            'review_item19' => $agenda->review_item19,
            'review_item20' => $agenda->review_item20,

            'prepared_by' => $agenda->prepared_by,
            'preparator_designation' => $agenda->preparator_designation,
            'preparation_time' => $agenda->preparation_time,

            'approved_by' => $agenda->approved_by,
            'approver_designation' => $agenda->approver_designation,
            'approval_time' => $agenda->approval_time,
        ];

        // Generate PDF from 'qa.mrm.agenda.email.attachment' view
        $pdf = app()->make('dompdf.wrapper');
        $pdf->loadView($mailData['attachment'], ['mailData' => $mailData]);

        // Pass the generated PDF to the mail data
        $mailData['pdf'] = $pdf;

        // Send the email with attachment using DemoMail Mailable to multiple recipients
        foreach ($recipients as $recipient) {
            Mail::to($recipient)->send(new DemoMail($mailData));
        }

        return back()->with('status', 'Agenda has been shared with the attendees.');
    }

    public function minutesmail($id)
    {
        $minutes = MrmMinutes::find($id);
        $meeting_no = $minutes->agenda->meeting_no;

        $recipients = [
            "muhammad.umair@medzntech.com",
            "meeting@medzntech.com",
        ];

        $mailData = [
            'subject' => "Management Review Minutes",
            'view' => "qa.mrm.minutes.email.message",                // email message
            'attachment' => "qa.mrm.minutes.email.attachment",       // email attachment
            'fileName' => "Minutes.pdf",                             // attachment name
            'meeting_no' => $meeting_no,

            'decision1' => $minutes->decision1,
            'action1' => $minutes->action1,
            'responsible1' => $minutes->responsible1,
            'completion_date1' => $minutes->completion_date1,
            'remarks1' => $minutes->remarks1,

            'decision2' => $minutes->decision2,
            'action2' => $minutes->action2,
            'responsible2' => $minutes->responsible2,
            'completion_date2' => $minutes->completion_date2,
            'remarks2' => $minutes->remarks2,

            'decision3' => $minutes->decision3,
            'action3' => $minutes->action3,
            'responsible3' => $minutes->responsible3,
            'completion_date3' => $minutes->completion_date3,
            'remarks3' => $minutes->remarks3,

            'decision4' => $minutes->decision4,
            'action4' => $minutes->action4,
            'responsible4' => $minutes->responsible4,
            'completion_date4' => $minutes->completion_date4,
            'remarks4' => $minutes->remarks4,

            'decision5' => $minutes->decision5,
            'action5' => $minutes->action5,
            'responsible5' => $minutes->responsible5,
            'completion_date5' => $minutes->completion_date5,
            'remarks5' => $minutes->remarks5,

            'decision6' => $minutes->decision6,
            'action6' => $minutes->action6,
            'responsible6' => $minutes->responsible6,
            'completion_date6' => $minutes->completion_date6,
            'remarks6' => $minutes->remarks6,

            'decision7' => $minutes->decision7,
            'action7' => $minutes->action7,
            'responsible7' => $minutes->responsible7,
            'completion_date7' => $minutes->completion_date7,
            'remarks7' => $minutes->remarks7,

            'decision8' => $minutes->decision8,
            'action8' => $minutes->action8,
            'responsible8' => $minutes->responsible8,
            'completion_date8' => $minutes->completion_date8,
            'remarks8' => $minutes->remarks8,

            'decision9' => $minutes->decision9,
            'action9' => $minutes->action9,
            'responsible9' => $minutes->responsible9,
            'completion_date9' => $minutes->completion_date9,
            'remarks9' => $minutes->remarks9,

            'decision10' => $minutes->decision10,
            'action10' => $minutes->action10,
            'responsible10' => $minutes->responsible10,
            'completion_date10' => $minutes->completion_date10,
            'remarks10' => $minutes->remarks10,

            'prepared_by' => $minutes->prepared_by,
            'preparator_designation' => $minutes->preparator_designation,
            'preparation_time' => $minutes->preparation_time,

            'approved_by' => $minutes->approved_by,
            'approver_designation' => $minutes->approver_designation,
            'approval_time' => $minutes->approval_time,
        ];

        // Generate PDF from 'qa.mrm.agenda.email.attachment' view
        $pdf = app()->make('dompdf.wrapper');
        $pdf->loadView($mailData['attachment'], ['mailData' => $mailData]);

        // Pass the generated PDF to the mail data
        $mailData['pdf'] = $pdf;

        // Send the email with attachment using DemoMail Mailable to multiple recipients
        foreach ($recipients as $recipient) {
            Mail::to($recipient)->send(new DemoMail($mailData));
        }

        return back()->with('status', 'Agenda has been shared with the attendees.');
    }
}
