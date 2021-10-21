@extends('layout')

@section('content')
<h1 class="mt-5 float-left">MY AGENDA</h1>
<a href="{{ Route('agenda.create') }}" class="mt-5 btn btn-success float-right">Add Agenda</a>
<table class="table table-bordered table-striped table-hover">
    <thead>
        <tr>
            <th>#</th>
            <th scope="col">Organizer</th>
            <th scope="col">Subject</th>
            <th scope="col">Start</th>
            <th scope="col">End</th>
        </tr>
    </thead>
    <tbody>
        @isset($events)
        @foreach($events as $key => $event)
        <tr>
           <td> {{ $key + 1 }}</td>
            <td>{{ $event->getOrganizer()->getEmailAddress()->getName() }}</td>
            <td>{{ $event->getSubject() }}</td>
            <td>{{ \Carbon\Carbon::parse($event->getStart()->getDateTime())->format('n/j/y g:i A') }}</td>
            <td>{{ \Carbon\Carbon::parse($event->getEnd()->getDateTime())->format('n/j/y g:i A') }}</td>
        </tr>
        @endforeach
        @endif
    </tbody>
</table>
@endsection
