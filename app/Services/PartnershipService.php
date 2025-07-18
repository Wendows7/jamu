<?php

namespace App\Services;

use App\Mail\ApprovalMail;
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
            'company_name' => 'required|string|max:255',
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
        $code = (string) \Str::uuid();
        $validatedData['code'] = $code; // Generate a unique code for the partnership
        $validatedData['user_id'] = auth()->user()->id; // Store the authenticated user's ID

        // Store the partnership data
        $partnership = $this->partnership->create($validatedData);

        $mailType = 'notification';

        // Send email notification
        $this->sendMailNotification($partnership, $mailType);
        \Log::info('Send Notification Email', [
            'email' => $partnership->email,
            'name' => $partnership->name,
            'user_id' => $partnership->user_id,
            'phone' => $partnership->phone]);

        return $partnership;
    }

    public function sendMailNotification($partnership, $type)
    {
        $user = $this->userService->find($partnership->user_id);
        if ($user) {
            if ($type == 'notification') {
                \Mail::to(env('EMAIL_ADMIN'))->send(new NotifMail($partnership));
            }
            if ($type == 'approval') {
                \Mail::to($partnership->email)->send(new ApprovalMail($partnership));
            }

        }
    }

    public function getAllData()
    {
        return $this->partnership->latest()->get();
    }

    public function updateStatus($request)
    {
        $validatedData = $request->validate([
            'id' => 'required|exists:partnerships,id',
            'status' => 'required|string|in:approved,rejected,pending',
        ]);

        $partnership = $this->partnership->find($validatedData['id']);
        $partnership->status = $validatedData['status'];
        $partnership->save();

        $mailType = 'approval';

        $this->sendMailNotification($partnership, $mailType);
        \Log::info('Send Notification Email', [
            'email' => $partnership->email,
            'name' => $partnership->name,
            'user_id' => $partnership->user_id,
            'phone' => $partnership->phone]);

        return $partnership;
    }

    public function getDataByUserId($userId)
    {
        return $this->partnership->where('user_id', $userId)->latest()->paginate(10);
    }

    public function uploadReplyFile($request)
    {
        $validatedData = $request->validate([
            'reply_file' => 'required|file|mimes:pdf,doc,docx|max:2048', // Adjust file validation as needed
            'payment_proof' => 'required|file|mimes:jpg,jpeg,png|max:2048', // Adjust file validation as needed
        ]);

        if ($request->file('reply_file')) {
            $validatedData['reply_file'] = $request->file('reply_file')->storeAs(
                'partnership_files',
                time() . '_' . 'reply_file' . '_'. $request->file('reply_file')->getClientOriginalName(),
                'public'
            );
        }

        if ($request->file('payment_proof')) {
            $validatedData['payment_proof'] = $request->file('payment_proof')->storeAs(
                'partnership_files',
                time() . '_' . 'payment_proof'. '_'.$request->file('payment_proof')->getClientOriginalName(),
                'public'
            );
        }

        $partnership = $this->partnership->find($request->id);

        if (!$partnership) {
            throw new \Exception('Partnership not found');
        }
        $partnership->reply_file = $validatedData['reply_file'];
        $partnership->payment_proof = $validatedData['payment_proof'];
        $partnership->save();

        return $partnership;


    }



}
