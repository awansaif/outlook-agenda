<?php

namespace App\Http\Controllers;

use App\TokenStore\TokenCache;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Microsoft\Graph\Graph;
use Microsoft\Graph\Model;

class AgendaController extends Controller
{
    public function create()
    {
        $tokenCache = new TokenCache();
        $accessToken = $tokenCache->getAccessToken();

        $authorization = new Graph();

        $authorization->setAccessToken($accessToken);

        $categories = $authorization->createRequest('GET', '/me/outlook/masterCategories')
            ->setReturnType(Model\Event::class)
            ->execute();

        return view('agenda.create', [
            'categories' => $categories
        ]);
    }


    public function store(Request $request): RedirectResponse
    {
        // Validate required fields
        $request->validate([
            'subject' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'event_color' => 'required',
            'location' => 'required',
            'body' => 'nullable|string'
        ]);

        // get token
        $tokenCache = new TokenCache();
        $accessToken = $tokenCache->getAccessToken();

        // authorized api
        $authorization = new Graph();
        $authorization->setAccessToken($accessToken);

        // Build the event
        $newEvent = [
            'subject' => $request->subject,
            'categories' =>  [$request->event_color],
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
            ],
            'location' => [
                'displayName' => $request->location
            ]

        ];

        // POST /me/events
        $authorization->createRequest('POST', '/me/events')
            ->attachBody($newEvent)
            ->setReturnType(Model\Event::class)
            ->execute();

        session()->flash('message', 'New agenda added successfully.');
        return redirect()->route('dashboard');
    }
}
