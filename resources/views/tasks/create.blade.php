<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Task — GreenTask</title>
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600&display=swap');

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'DM Sans', sans-serif;
            background: #f0fdf4;
            color: #14532d;
            min-height: 100vh;
        }

        .topbar {
            background: #166534;
            padding: 0 36px;
            height: 62px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .topbar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            color: white;
            font-size: 16px;
            font-weight: 600;
        }

        .brand-mark {
            width: 34px; height: 34px;
            background: #15803d;
            border: 2px solid #4ade80;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #4ade80;
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: #86efac;
            font-size: 13px;
            text-decoration: none;
            transition: color 0.15s;
        }
        .btn-back:hover { color: white; }

        .page { max-width: 560px; margin: 48px auto; padding: 0 24px; }

        .page-title { font-size: 20px; font-weight: 600; color: #14532d; margin-bottom: 4px; }
        .page-sub   { font-size: 13px; color: #16a34a; margin-bottom: 28px; }

        .form-card {
            background: white;
            border-radius: 16px;
            border: 1px solid #bbf7d0;
            padding: 32px;
        }

        .field { margin-bottom: 22px; }

        label {
            display: block;
            font-size: 12.5px;
            font-weight: 600;
            color: #166534;
            margin-bottom: 7px;
        }

        .req { color: #16a34a; }

        input[type="text"],
        input[type="date"],
        textarea {
            width: 100%;
            padding: 11px 14px;
            border: 1.5px solid #bbf7d0;
            border-radius: 9px;
            font-size: 13.5px;
            font-family: inherit;
            color: #14532d;
            background: #f0fdf4;
            outline: none;
            transition: border-color 0.15s, box-shadow 0.15s;
        }

        input:focus, textarea:focus {
            border-color: #16a34a;
            background: white;
            box-shadow: 0 0 0 3px rgba(22,163,74,0.1);
        }

        textarea { resize: vertical; min-height: 90px; line-height: 1.6; }

        .err {
            font-size: 12px;
            color: #dc2626;
            margin-top: 5px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .divider { height: 1px; background: #dcfce7; margin: 24px 0; }

        .form-btns { display: flex; gap: 10px; }

        .btn-save {
            flex: 1;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: #16a34a;
            color: white;
            padding: 12px 20px;
            border-radius: 9px;
            font-size: 14px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            font-family: inherit;
            transition: background 0.15s;
        }
        .btn-save:hover { background: #15803d; }

        .btn-cancel {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #f0fdf4;
            color: #166534;
            border: 1px solid #bbf7d0;
            padding: 12px 20px;
            border-radius: 9px;
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            transition: background 0.15s;
        }
        .btn-cancel:hover { background: #dcfce7; }
    </style>
</head>
<body>

<header class="topbar">
    <div class="topbar-brand">
        <div class="brand-mark">
            <i data-lucide="list-checks" style="width:16px;height:16px;"></i>
        </div>
        GreenTask
    </div>
    <a href="{{ route('tasks.index') }}" class="btn-back">
        <i data-lucide="arrow-left" style="width:14px;height:14px;"></i>
        Back to tasks
    </a>
</header>

<div class="page">
    <div class="page-title">Add New Task</div>
    <div class="page-sub">Create a new task to keep track of your work.</div>

    <div class="form-card">
        <form action="{{ route('tasks.store') }}" method="POST">
            @csrf

            <div class="field">
                <label>Task Name <span class="req">*</span></label>
                <input type="text" name="task_name" value="{{ old('task_name') }}" placeholder="What needs to be done?">
                @error('task_name')
                <div class="err">
                    <i data-lucide="alert-circle" style="width:12px;height:12px;"></i>
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="field">
                <label>Description</label>
                <textarea name="description" placeholder="Add details about this task (optional)">{{ old('description') }}</textarea>
            </div>

            <div class="field">
                <label>Due Date</label>
                <input type="date" name="due_date" value="{{ old('due_date') }}">
            </div>

            <div class="divider"></div>

            <div class="form-btns">
                <button type="submit" class="btn-save">
                    <i data-lucide="plus-circle" style="width:15px;height:15px;"></i>
                    Create Task
                </button>
                <a href="{{ route('tasks.index') }}" class="btn-cancel">Cancel</a>
            </div>
        </form>
    </div>
</div>

<script>lucide.createIcons();</script>
</body>
</html>