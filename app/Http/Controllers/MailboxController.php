<?php

namespace App\Http\Controllers;

class MailboxController extends Controller
{
    public function index()
    {
        return view('mailbox.index');
    }

    public function show(int $messageId)
    {
        return view('mailbox.show', compact('messageId'));
    }
}
