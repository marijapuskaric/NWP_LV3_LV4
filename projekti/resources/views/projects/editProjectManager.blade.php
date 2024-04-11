@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    Create New Project
                </div>
                <div class="card-body">
                    <form action="{{ route('project.updateManager', $project->id) }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" value="{{ $project->name }}">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <input type="text" class="form-control" name="description" value="{{ $project->description }}"></input>
                        </div>
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="text" class="form-control" name="price" value="{{ $project->price }}">
                        </div>
                        <div class="form-group">
                            <label for="finished_jobs">Finished Jobs</label>
                            <input type="text" class="form-control" name="finished_jobs" value="{{ $project->finished_jobs }}">
                        </div>
                        <div class="form-group">
                            <label for="start_date">Start Date</label>
                            <input type="date" class="form-control" name="start_date" value="{{ $project->start_date }}">
                        </div>
                        <div class="form-group">
                            <label for="end_date">End Date</label>
                            <input type="date" class="form-control" name="end_date" value="{{ $project->end_date }}">
                        </div>
                        <div class="form-group mt-4">
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @if(session('success'))
        <div class="alert alert-success m-5">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger m-5">
            {{ session('error') }}
        </div>
    @endif
</div>
@endsection
