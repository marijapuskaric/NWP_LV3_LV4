@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="mb-5">
        <h2 class="mb-4">Projects you own</h2>
        <hr/>
        <a class="btn btn-primary mb-4" href="{{ url('/createproject') }}">Create New Project</a>
        @foreach ($userProjectsManager as $project)
            <div class="card mb-3">
                <div class="card-header">
                    Project: {{ $project->name }}
                </div>
                <div class="card-body">
                    <h4 class="card-title">{{ $project->name }}</h4>
                    <h6 class="card-subtitle mb-2 text-muted">Start Date: {{ $project->start_date }} | End Date: {{ $project->end_date }}</h6>
                    <p class="card-text">{{ $project->description }}</p>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Price: {{ $project->price }}</li>
                        <li class="list-group-item">Finished Jobs: {{ $project->finished_jobs }}</li>
                    </ul>
                    <div class="mt-3">
                        <a href="{{ url('/editprojectmanager/'.$project->id) }}" class="btn btn btn-secondary">Edit</a>
                        <a href="{{ url('/adduser/'.$project->id) }}" class="btn btn-success">Add team members</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="mb-5">
        <h2 class="mb-4">Projects you're working on</h2>
        <hr/>
        @foreach ($userProjectsMember as $project)
            <div class="card mb-3">
                <div class="card-header">
                    Project: {{ $project->name }}
                </div>
                <div class="card-body">
                    <h4 class="card-title">{{ $project->name }}</h4>
                    <h6 class="card-subtitle mb-2 text-muted">Start Date: {{ $project->start_date }} | End Date: {{ $project->end_date }}</h6>
                    <p class="card-text">{{ $project->description }}</p>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Price: {{ $project->price }}</li>
                        <li class="list-group-item">Finished Jobs: {{ $project->finished_jobs }}</li>
                    </ul>
                    <div class="mt-3">
                        <a href="{{ url('/editprojectuser/'.$project->id) }}" class="btn btn btn-secondary">Edit</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
