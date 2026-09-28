@extends('layouts.app')

@section('title', 'Add Task | Personal Task Manager')

@section('content')

<div class="form-card">

    <h2>
        Add New Task
    </h2>

    @if($errors->any())

        @foreach($errors->all() as $error)

            <div class="error">
                {{ $error }}
            </div>

        @endforeach

    @endif


    <form action="{{ route('tasks.store') }}" method="POST">

        @csrf


        <div class="form-group">

            <label for="task_name">
                Task Name
            </label>

            <input
                type="text"
                id="task_name"
                name="task_name"
                value="{{ old('task_name') }}"
                class="form-control"
                placeholder="Enter task name"
                required
            >

        </div>


        <div class="form-group">

            <label for="description">
                Description
            </label>

            <textarea
                id="description"
                name="description"
                class="form-control"
                placeholder="Enter task description"
            >{{ old('description') }}</textarea>

        </div>


        <div class="form-group">

            <label for="status">
                Status
            </label>

            <select
                id="status"
                name="status"
                class="form-control"
                required
            >

                <option value="Pending">
                    Pending
                </option>

                <option value="Completed">
                    Completed
                </option>

            </select>

        </div>


        <div class="form-group">

            <label for="due_date">
                Due Date
            </label>

            <input
                type="date"
                id="due_date"
                name="due_date"
                value="{{ old('due_date') }}"
                class="form-control"
            >

        </div>


        <div class="form-buttons">

            <a
                href="{{ route('tasks.index') }}"
                class="btn btn-secondary"
            >
                Cancel
            </a>

            <div class="form-buttons-right">

                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    Create Task
                </button>

            </div>

        </div>

    </form>

</div>

@endsection