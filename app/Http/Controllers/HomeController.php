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
            'startDateTime' => '2019-01-01T01:00:00.0000000',
            'endDateTime' => '2021-12-31T12:00:00.0000000',
            // Only request the properties used by the app
            '$select' => 'subject,organizer,start,end',
            // Sort them by` start time
            '$orderby' => 'start/dateTime',
        );

        // query
        $getEventsUrl = '/me/calendarView?' . http_build_query($queryParams);


        if (session()->get('userTimeZone') != null) {
            $timezone = 'outlook.timezone="' .  session()->get('userTimeZone') . '"';
        } else {
            $timezone = 'outlook.timezone="Pacific Standard Time"';
        }
        // get data
        $events = $authorized->createRequest('GET', $getEventsUrl)
            ->addHeaders(array(
                'Prefer' => $timezone
            ))
            ->setReturnType(Model\Event::class)
            ->execute();

        return view('home', [
            'events' => $events
        ]);
    }
}
