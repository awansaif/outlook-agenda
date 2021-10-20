<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Microsoft\Graph\Graph;
use Microsoft\Graph\Model;

class AgendaController extends Controller
{
    public function create()
    {
        return view('agenda.create');
    }


    public function store(Request $request): RedirectResponse
    {
        // Validate required fields
        $request->validate([
            'subject' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'body' => 'nullable|string'
        ]);

        // get token
        $accessToken = session()->get('accessToken');

        // authorized api
        $authorization = new Graph();
        $authorized = $authorization->setAccessToken($accessToken);

        // Build the event
        $newEvent = [
            'subject' => $request->subject,
            'start' => [
                'dateTime' => $request->start_date,
                'timeZone' => session()->get('userTimeZone') != null ? session()->get('userTimeZone') : 'Pacific Standard Time'
            ],
            'end' => [
                'dateTime' => $request->end_date,
                'timeZone' => session()->get('userTimeZone') != null ? session()->get('userTimeZone') : 'Pacific Standard Time'

            ],
            'body' => [
                'content' => $request->body,
                'contentType' => 'text'
            ]
        ];

        // POST /me/events
        $authorized->createRequest('POST', '/me/events')
            ->attachBody($newEvent)
            ->setReturnType(Model\Event::class)
            ->execute();

        session()->flash('message', 'New agenda added successfully.');
        return redirect()->route('dashboard');
    }
}
