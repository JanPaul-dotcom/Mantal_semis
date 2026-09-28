<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>@yield('title', 'Personal Task Manager')</title>

<style>
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    body {
        font-family: Arial, sans-serif;
        background: #e5e7eb;
        color: #1f2937;
    }

    /* Navbar */

    .navbar {
        background: #3f444b;
        color: white;
        padding: 18px 7%;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .logo {
        font-size: 21px;
        font-weight: bold;
    }

    .nav-link {
        color: #f9fafb;
        text-decoration: none;
        margin-left: 20px;
        font-size: 14px;
    }

    .nav-link:hover {
        color: #93c5fd;
    }

    /* Container */

    .container {
        width: 86%;
        max-width: 1200px;
        margin: 35px auto;
    }

    /* Alert */

    .alert {
        background: #dcfce7;
        color: #166534;
        padding: 13px 17px;
        border-radius: 8px;
        margin-bottom: 20px;
        border: 1px solid #bbf7d0;
    }

    /* Buttons */

    .btn {
        display: inline-block;
        padding: 10px 17px;
        border-radius: 8px;
        border: none;
        text-decoration: none;
        cursor: pointer;
        font-size: 14px;
    }

    /* Primary: Blue */

    .btn-primary {
        background: #2563eb;
        color: white;
    }

    .btn-primary:hover {
        background: #1d4ed8;
    }

    /* Edit: Light Blue */

    .btn-edit {
        background: #dbeafe;
        color: #1d4ed8;
    }

    .btn-edit:hover {
        background: #bfdbfe;
    }

    /* Delete: Red */

    .btn-delete {
        background: #fee2e2;
        color: #b91c1c;
    }

    .btn-delete:hover {
        background: #fecaca;
    }

    /* Secondary: Grey */

    .btn-secondary {
        background: #e5e7eb;
        color: #374151;
    }

    .btn-secondary:hover {
        background: #d1d5db;
    }

    /* Forms */

    .form-card {
        max-width: 700px;
        background: white;
        padding: 30px;
        margin: auto;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    }

    .form-card h2 {
        color: #374151;
        margin-bottom: 25px;
    }

    .form-group {
        margin-bottom: 18px;
    }

    .form-group label {
        display: block;
        margin-bottom: 7px;
        font-weight: bold;
        color: #374151;
    }

    .form-control {
        width: 100%;
        padding: 11px;
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        font-size: 14px;
        background: white;
    }

    .form-control:focus {
        outline: none;
        border-color: #2563eb;
        box-shadow: 0 0 0 3px #dbeafe;
    }

    textarea.form-control {
        min-height: 120px;
        resize: vertical;
    }

    .error {
        color: #dc2626;
        font-size: 13px;
        margin-top: 5px;
    }

    /* Form Buttons */

    .form-buttons {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 25px;
        gap: 10px;
    }

    .form-buttons-right {
        display: flex;
        gap: 8px;
    }

    /* Responsive */

    @media (max-width: 700px) {

        .navbar {
            padding: 18px 5%;
            flex-direction: column;
            gap: 12px;
            align-items: flex-start;
        }

        .nav-link {
            margin-left: 0;
            margin-right: 15px;
        }

        .container {
            width: 92%;
            margin: 25px auto;
        }

        .form-buttons {
            flex-direction: column;
            align-items: stretch;
        }

        .form-buttons-right {
            flex-direction: column;
        }

        .form-buttons .btn {
            text-align: center;
        }
    }
</style>


</head>

<body>

<nav class="navbar">

    <div class="logo">
        Personal Task Manager
    </div>

    <div>

        <a
            href="{{ route('tasks.index') }}"
            class="nav-link"
        >
            Dashboard
        </a>

        <a
            href="{{ route('tasks.create') }}"
            class="nav-link"
        >
            Add Task
        </a>

    </div>

</nav>


<main class="container">

    @if(session('success'))

        <div class="alert">
            {{ session('success') }}
        </div>

    @endif

    @yield('content')

</main>


</body>
</html>
