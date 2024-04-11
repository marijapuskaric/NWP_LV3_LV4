@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add Team Members to Project: <b>{{ $project->name }}</b></div>
                <div class="card-body">
                    <form action="{{ route('project.addUserProject', $project->id) }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="users">Select Team Members:</label>
                            <div class="checkbox-list">
                                @foreach ($users as $user)
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="user{{ $user->id }}" name="users[]" value="{{ $user->id }}">
                                        <label class="form-check-label" for="user{{ $user->id }}">{{ $user->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="form-group mt-4 text-center">
                            <button type="submit" class="btn btn-primary">Add Team Members</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @if(session('success'))
        <div class="alert alert-success mt-4">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger mt-4">{{ session('error') }}</div>
    @endif
</div>
@endsection
