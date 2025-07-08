<?php

namespace App\Services;

use App\Mail\NotifMail;
use App\Models\Partnership;
use App\Models\User;

class PartnershipService
{

    protected $partnership;
    protected $user;

    public function __construct(Partnership $partnership, User $userService)
    {
        $this->partnership = $partnership;
        $this->userService = $userService;
    }


    public function storePartnership($data)
    {
//        validate the data
        $validatedData = $data->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:2048', // Adjust file validation as needed
        ]);

//        store file with new name
        if ($data->file('file')) {
            $validatedData['file'] = $data->file('file')->storeAs(
                'partnership_files',
                time() . '_' . $data->file('file')->getClientOriginalName(),
                'public'
            );
        }
        $validatedData['user_id'] = auth()->user()->id; // Store the authenticated user's ID

        // Store the partnership data
        $partnership = $this->partnership->create($validatedData);


        // Send email notification
        $this->sendMailNotification($partnership);
        \Log::info('Send Notification Email', [
            'email' => $partnership->email,
            'name' => $partnership->name,
            'user_id' => $partnership->user_id,
            'phone' => $partnership->phone]);

        return $partnership;
    }

    public function sendMailNotification($partnership)
    {
        $user = $this->userService->find($partnership->user_id);
        if ($user) {
            \Mail::to($partnership->email)->send(new NotifMail($partnership));
        }
    }



}
