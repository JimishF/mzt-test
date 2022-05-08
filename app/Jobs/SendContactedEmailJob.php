<?php

namespace App\Jobs;

use App\Mail\CandidateContactedMail;
use App\Models\Candidate;
use App\Models\Company;
use http\Message\Body;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Exception;

class SendContactedEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $company;
    protected $candidate;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Candidate $candidate, Company $company)
    {
        $this->candidate = $candidate;
        $this->company = $company;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $mail = new CandidateContactedMail($this->company);
        try {
            Mail::to($this->candidate->email)->send($mail);
        } catch (Exception $e) {
            throw  new Exception('Failed to send email to candidate');
        }
    }
}
