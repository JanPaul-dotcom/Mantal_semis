@extends('layouts.app')

@section('title', 'Edit Task | Personal Task Manager')

@section('content')

<div class="form-card">

    <h2>Edit Task</h2>

    @if($errors->any())

        @foreach($errors->all() as $error)

            <div class="error">
                {{ $error }}
            </div>

        @endforeach

    @endif

    <form
        action="{{ route('tasks.update', $task) }}"
        method="POST"
    >

        @csrf
        @method('PUT')

        <div class="form-group">

            <label for="task_name">
                Task Name
            </label>

            <input
                type="text"
                id="task_name"
                name="task_name"
                value="{{ old('task_name', $task->task_name) }}"
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
            >{{ old('description', $task->description) }}</textarea>

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

                <option
                    value="Pending"
                    {{ old('status', $task->status) == 'Pending' ? 'selected' : '' }}
                >
                    Pending
                </option>

                <option
                    value="Completed"
                    {{ old('status', $task->status) == 'Completed' ? 'selected' : '' }}
                >
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
                value="{{ old('due_date', $task->due_date?->format('Y-m-d')) }}"
                class="form-control"
            >

        </div>

        <div class="form-buttons">

            <button
                type="button"
                class="btn btn-delete"
                onclick="confirmDelete()"
            >
                Delete
            </button>

            <div class="form-buttons-right">

                <a
                    href="{{ route('tasks.index') }}"
                    class="btn btn-secondary"
                >
                    Cancel
                </a>

                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    Save Changes
                </button>

            </div>

        </div>

    </form>


    {{-- Hidden delete form --}}
    <form
        id="delete-task-form"
        action="{{ route('tasks.destroy', $task) }}"
        method="POST"
        style="display: none;"
    >

        @csrf
        @method('DELETE')

    </form>

</div>


<script>
    function confirmDelete() {

        const confirmed = confirm(
            'Are you sure you want to delete this task?'
        );

        if (confirmed) {
            document.getElementById('delete-task-form').submit();
        }

    }
</script>

@endsection