@extends('layouts.app')

@section('title', 'Dashboard | Personal Task Manager')

@section('content')

<style>

    .dashboard-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }

    .dashboard-title h1 {
        color: #4c1d95;
        font-size: 30px;
        margin-bottom: 7px;
    }

    .dashboard-title p {
        color: #756d83;
        font-size: 14px;
    }

    .stats {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        margin-bottom: 30px;
    }

    .stat-card {
        background: white;
        padding: 22px;
        border-radius: 14px;
        box-shadow: 0 4px 15px rgba(76, 29, 149, 0.08);
        border-left: 5px solid #7c3aed;
    }

    .stat-card.completed-card {
        border-left-color: #16a34a;
    }

    .stat-card h3 {
        color: #756d83;
        font-size: 14px;
        margin-bottom: 8px;
    }

    .stat-number {
        color: #5b21b6;
        font-size: 30px;
        font-weight: bold;
    }

    .completed-card .stat-number {
        color: #15803d;
    }

    .kanban {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 25px;
    }

    .kanban-column {
        border-radius: 15px;
        padding: 20px;
        min-height: 400px;
    }

    .pending-column {
        background: #ede9fe;
    }

    .completed-column {
        background: #e5e7eb;
    }

    .kanban-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 18px;
    }

    .kanban-title {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .kanban-title h2 {
        font-size: 20px;
        color: #3b0764;
    }

    .completed-column .kanban-title h2 {
        color: #1f2937;
    }

    .column-description {
        font-size: 12px;
        color: #756d83;
        margin-top: 3px;
    }

    .task-count {
        background: white;
        color: #5b21b6;
        font-size: 13px;
        font-weight: bold;
        padding: 6px 11px;
        border-radius: 20px;
    }

    .completed-column .task-count {
        color: #374151;
    }

    .task-list {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .task-card {
        background: white;
        border-radius: 12px;
        padding: 18px;
        box-shadow: 0 3px 12px rgba(0, 0, 0, 0.06);
        border: 1px solid #e5e7eb;
        transition: 0.2s;
    }

    .task-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(76, 29, 149, 0.12);
    }

    .task-top {
        display: flex;
        justify-content: space-between;
        gap: 10px;
        align-items: flex-start;
    }

    .task-card h3 {
        color: #3b0764;
        font-size: 17px;
        margin-bottom: 7px;
    }

    .task-description {
        color: #756d83;
        font-size: 13px;
        line-height: 1.5;
        margin-bottom: 12px;
    }

    .status {
        display: inline-block;
        padding: 5px 9px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: bold;
        white-space: nowrap;
    }

    .pending {
        background: #fef3c7;
        color: #92400e;
    }

    .completed {
        background: #dcfce7;
        color: #166534;
    }

    .due-date {
        color: #8b7f96;
        font-size: 12px;
        margin-bottom: 14px;
    }

    .task-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-top: 1px solid #eee9f5;
        padding-top: 13px;
    }

    .action-group {
        display: flex;
        gap: 7px;
    }

    .empty {
        background: rgba(255, 255, 255, 0.6);
        border: 2px dashed #c4b5fd;
        border-radius: 12px;
        padding: 45px 20px;
        text-align: center;
        color: #81778d;
    }

    .completed-column .empty {
        border-color: #cbd5e1;
    }

    .empty-icon {
        font-size: 28px;
        margin-bottom: 10px;
    }

    .empty h3 {
        color: #4b4454;
        font-size: 15px;
        margin-bottom: 5px;
    }

    .empty p {
        font-size: 13px;
    }

    @media (max-width: 800px) {

        .stats {
            grid-template-columns: 1fr;
        }

        .kanban {
            grid-template-columns: 1fr;
        }

        .dashboard-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 15px;
        }

    }

</style>


{{-- Dashboard Header --}}

<div class="dashboard-header">

    <div class="dashboard-title">

        <h1>
            My Tasks
        </h1>

        <p>
            Organize your tasks and keep track of your progress.
        </p>

    </div>

    <a
        href="{{ route('tasks.create') }}"
        class="btn btn-primary"
    >
        + Add Task
    </a>

</div>


{{-- Statistics --}}

<div class="stats">

    <div class="stat-card">

        <h3>
            Total Tasks
        </h3>

        <div class="stat-number">
            {{ $tasks->count() }}
        </div>

    </div>


    <div class="stat-card">

        <h3>
            Pending Tasks
        </h3>

        <div class="stat-number">
            {{ $tasks->where('status', 'Pending')->count() }}
        </div>

    </div>


    <div class="stat-card completed-card">

        <h3>
            Completed Tasks
        </h3>

        <div class="stat-number">
            {{ $tasks->where('status', 'Completed')->count() }}
        </div>

    </div>

</div>


{{-- Kanban Board --}}

<div class="kanban">


    {{-- PENDING COLUMN --}}

    <div class="kanban-column pending-column">

        <div class="kanban-header">

            <div>

                <div class="kanban-title">

                    <h2>
                        Pending
                    </h2>

                </div>

                <p class="column-description">
                    Tasks you still need to complete
                </p>

            </div>

            <span class="task-count">
                {{ $tasks->where('status', 'Pending')->count() }}
            </span>

        </div>


        <div class="task-list">

            @forelse($tasks->where('status', 'Pending') as $task)

                <div class="task-card">

                    <div class="task-top">

                        <div>

                            <h3>
                                {{ $task->task_name }}
                            </h3>

                        </div>

                        <span class="status pending">
                            Pending
                        </span>

                    </div>


                    @if($task->description)

                        <p class="task-description">
                            {{ $task->description }}
                        </p>

                    @else

                        <p class="task-description">
                            No description provided.
                        </p>

                    @endif


                    @if($task->due_date)

                        <div class="due-date">
                            Due: {{ $task->due_date->format('M d, Y') }}
                        </div>

                    @endif


                    <div class="task-actions">

                        <div class="action-group">

                            <a
                                href="{{ route('tasks.edit', $task) }}"
                                class="btn btn-edit"
                            >
                                Edit
                            </a>

                            <form
                                action="{{ route('tasks.destroy', $task) }}"
                                method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this task?');"
                            >

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="btn btn-delete"
                                >
                                    Delete
                                </button>

                            </form>

                        </div>

                    </div>

                </div>

            @empty

                <div class="empty">

                    <div class="empty-icon">
                        ✓
                    </div>

                    <h3>
                        No pending tasks
                    </h3>

                    <p>
                        Add a new task to get started.
                    </p>

                </div>

            @endforelse

        </div>

    </div>


    {{-- COMPLETED COLUMN --}}

    <div class="kanban-column completed-column">

        <div class="kanban-header">

            <div>

                <div class="kanban-title">

                    <h2>
                        Completed
                    </h2>

                </div>

                <p class="column-description">
                    Tasks you have already finished
                </p>

            </div>

            <span class="task-count">
                {{ $tasks->where('status', 'Completed')->count() }}
            </span>

        </div>


        <div class="task-list">

            @forelse($tasks->where('status', 'Completed') as $task)

                <div class="task-card">

                    <div class="task-top">

                        <div>

                            <h3>
                                {{ $task->task_name }}
                            </h3>

                        </div>

                        <span class="status completed">
                            Completed
                        </span>

                    </div>


                    @if($task->description)

                        <p class="task-description">
                            {{ $task->description }}
                        </p>

                    @else

                        <p class="task-description">
                            No description provided.
                        </p>

                    @endif


                    @if($task->due_date)

                        <div class="due-date">
                            Due: {{ $task->due_date->format('M d, Y') }}
                        </div>

                    @endif


                    <div class="task-actions">

                        <div class="action-group">

                            <a
                                href="{{ route('tasks.edit', $task) }}"
                                class="btn btn-edit"
                            >
                                Edit
                            </a>

                            <form
                                action="{{ route('tasks.destroy', $task) }}"
                                method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this task?');"
                            >

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="btn btn-delete"
                                >
                                    Delete
                                </button>

                            </form>

                        </div>

                    </div>

                </div>

            @empty

                <div class="empty">

                    <div class="empty-icon">
                        ✓
                    </div>

                    <h3>
                        No completed tasks
                    </h3>

                    <p>
                        Completed tasks will appear here.
                    </p>

                </div>

            @endforelse

        </div>

    </div>

</div>

@endsection