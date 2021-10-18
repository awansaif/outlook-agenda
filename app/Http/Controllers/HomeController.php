<?php

namespace App\Http\Controllers;

use Microsoft\Graph\Graph;
use Microsoft\Graph\Model;

class HomeController extends Controller
{
    public function dashboard()
    {

        // get token
        $accessToken = session()->get('accessToken');

        // authorized api
        $authorization = new Graph();
        $authorized = $authorization->setAccessToken($accessToken);

        // param for query to fecth calendar data
        $queryParams = array(
            'startDateTime' => '2019-10-01T01:00:00',
            'endDateTime' => '2021-12-01T01:00:00',
            // Only request the properties used by the app
            '$select' => 'subject,organizer,start,end',
            // Sort them by` start time
            '$orderby' => 'start/dateTime',
        );

        // query
        $getEventsUrl = '/me/calendarView?' . http_build_query($queryParams);


        // get data
        $events = $authorized->createRequest('GET', $getEventsUrl)
            ->addHeaders(array(
                'Prefer' => 'outlook.timezone="' . session()->get('userTimeZone') . '"'
            ))
            ->setReturnType(Model\Event::class)
            ->execute();

        // $viewData['events'] = $events;
        return view('home', [
            'events' => $events
        ]);
    }
}
