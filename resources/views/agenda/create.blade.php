@extends('layout')

@section('content')
<h1>New Agenda</h1>
<form method="POST" action="{{ Route('agenda.store') }}">
    @csrf
    <div class="form-group">
        <label>Subject</label>
        <input type="text" class="form-control" name="subject" required value="{{ old('subject') }}" />
        @error('subject')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-row">
        <div class="col">
            <div class="form-group">
                <label>Start Date</label>
                <input type="datetime-local" class="form-control" name="start_date" id="eventStart" required
                    value="{{ old('start_date') }}" />
            </div>
            @error('start_date')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="col">
            <div class="form-group">
                <label>End Date</label>
                <input type="datetime-local" class="form-control" name="end_date" required
                    value="{{ old('end_date') }}" />
            </div>
            @error('end_date')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="form-row">
        <div class="col">
            <div class="form-group">
                <label>Event Color</label>
                <select name="event_color" class="form-control">
                    @foreach ($categories as $key => $category)
                    <option value="{{ $category->getDisplayName() }}">{{ $category->getDisplayName() }}</option>
                    @endforeach
                </select>
            </div>
            @error('event_color')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="col">
            <div class="form-group">
                <label>Location</label>
                <input type="address" class="form-control" name="location" required value="{{ old('location') }}" />
            </div>
            @error('location')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="form-group">
        <label>Body</label>
        <textarea type="text" class="form-control" name="body" rows="3">{{ old('body') }}</textarea>
    </div>
    <input type="submit" class="btn btn-primary mr-2 float-left" value="Create" />
    <a class="btn btn-secondary float-right" href="{{ Route('dashboard') }}">
        Back
    </a>
</form>
@endsection
