<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Tasks</title>
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

        /* Top bar */
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

        .topbar-right { display: flex; align-items: center; gap: 16px; }

        .progress-wrap {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 12px;
            color: #86efac;
        }

        .progress-bar-bg {
            width: 80px; height: 6px;
            background: #14532d;
            border-radius: 10px;
            overflow: hidden;
        }

        .progress-bar-fill {
            height: 100%;
            background: #4ade80;
            border-radius: 10px;
            transition: width 0.3s;
        }

        .btn-add {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: #4ade80;
            color: #14532d;
            padding: 9px 18px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            font-family: inherit;
            transition: background 0.15s;
        }
        .btn-add:hover { background: #22c55e; }

        /* Page body */
        .page { max-width: 1060px; margin: 0 auto; padding: 36px 24px; }

        .page-top {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            margin-bottom: 28px;
        }

        .page-top h1 { font-size: 22px; font-weight: 600; color: #14532d; }
        .page-top p  { font-size: 13px; color: #4ade80; margin-top: 2px; }

        .summary-row {
            display: flex;
            gap: 12px;
            margin-bottom: 28px;
        }

        .sbox {
            flex: 1;
            background: white;
            border-radius: 12px;
            border: 1px solid #bbf7d0;
            padding: 18px 20px;
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .sbox-icon {
            width: 40px; height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .sbox-icon.all  { background: #dcfce7; color: #16a34a; }
        .sbox-icon.pend { background: #fef9c3; color: #ca8a04; }
        .sbox-icon.done { background: #d1fae5; color: #059669; }

        .sbox-val  { font-size: 26px; font-weight: 700; color: #14532d; line-height: 1; }
        .sbox-lbl  { font-size: 12px; color: #86efac; margin-top: 2px; }

        /* Toast */
        .toast {
            background: #dcfce7;
            border: 1px solid #86efac;
            color: #166534;
            padding: 11px 16px;
            border-radius: 8px;
            font-size: 13px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* Task cards grid */
        .tasks-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 16px;
        }

        .task-card {
            background: white;
            border-radius: 14px;
            border: 1px solid #bbf7d0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            gap: 12px;
            transition: box-shadow 0.15s;
        }

        .task-card:hover { box-shadow: 0 4px 20px rgba(22,101,52,0.08); }

        .task-card.completed {
            opacity: 0.75;
            border-color: #d1fae5;
        }

        .task-card-top {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 10px;
        }

        .task-card-name {
            font-size: 14px;
            font-weight: 600;
            color: #14532d;
            line-height: 1.4;
        }

        .task-card.completed .task-card-name {
            text-decoration: line-through;
            color: #86efac;
        }

        .status-dot {
            width: 10px; height: 10px;
            border-radius: 50%;
            flex-shrink: 0;
            margin-top: 4px;
        }

        .dot-pending   { background: #facc15; }
        .dot-completed { background: #22c55e; }

        .task-card-desc {
            font-size: 12.5px;
            color: #4ade80;
            line-height: 1.5;
        }

        .task-card-meta {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 12px;
            color: #86efac;
        }

        .task-card-actions {
            display: flex;
            gap: 7px;
            padding-top: 4px;
            border-top: 1px solid #f0fdf4;
        }

        .ca {
            flex: 1;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            padding: 7px 10px;
            border-radius: 7px;
            font-size: 12px;
            font-weight: 500;
            border: none;
            cursor: pointer;
            text-decoration: none;
            font-family: inherit;
            transition: opacity 0.15s;
        }
        .ca:hover { opacity: 0.8; }

        .ca-edit   { background: #f0fdf4; color: #166534; border: 1px solid #bbf7d0; }
        .ca-done   { background: #dcfce7; color: #15803d; }
        .ca-undo   { background: #fef9c3; color: #854d0e; }
        .ca-del    { background: #fef2f2; color: #b91c1c; }

        /* Empty */
        .empty-card {
            grid-column: 1 / -1;
            text-align: center;
            padding: 64px 24px;
            background: white;
            border-radius: 14px;
            border: 1px dashed #bbf7d0;
        }

        .empty-icon {
            width: 56px; height: 56px;
            background: #dcfce7;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 14px;
            color: #16a34a;
        }

        .empty-card h3 { font-size: 15px; font-weight: 600; color: #14532d; margin-bottom: 5px; }
        .empty-card p  { font-size: 13px; color: #86efac; }
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
    <div class="topbar-right">
        @if($totalCount > 0)
        <div class="progress-wrap">
            <div class="progress-bar-bg">
                <div class="progress-bar-fill" style="width: {{ $totalCount > 0 ? ($completedCount / $totalCount) * 100 : 0 }}%"></div>
            </div>
            {{ $completedCount }}/{{ $totalCount }} done
        </div>
        @endif
        <a href="{{ route('tasks.create') }}" class="btn-add">
            <i data-lucide="plus" style="width:14px;height:14px;"></i>
            Add Task
        </a>
    </div>
</header>

<div class="page">

    <div class="page-top">
        <div>
            <h1>My Tasks</h1>
            <p>{{ now()->format('l, F j, Y') }}</p>
        </div>
    </div>

    @if(session('toast'))
    <div class="toast">
        <i data-lucide="check-circle-2" style="width:15px;height:15px;flex-shrink:0;"></i>
        {{ session('toast') }}
    </div>
    @endif

    <div class="summary-row">
        <div class="sbox">
            <div class="sbox-icon all">
                <i data-lucide="layers" style="width:20px;height:20px;"></i>
            </div>
            <div>
                <div class="sbox-val">{{ $totalCount }}</div>
                <div class="sbox-lbl">Total Tasks</div>
            </div>
        </div>
        <div class="sbox">
            <div class="sbox-icon pend">
                <i data-lucide="clock-4" style="width:20px;height:20px;"></i>
            </div>
            <div>
                <div class="sbox-val">{{ $pendingCount }}</div>
                <div class="sbox-lbl">Pending</div>
            </div>
        </div>
        <div class="sbox">
            <div class="sbox-icon done">
                <i data-lucide="circle-check-big" style="width:20px;height:20px;"></i>
            </div>
            <div>
                <div class="sbox-val">{{ $completedCount }}</div>
                <div class="sbox-lbl">Completed</div>
            </div>
        </div>
    </div>

    <div class="tasks-grid">
        @forelse($taskList as $task)
        <div class="task-card {{ $task->is_completed ? 'completed' : '' }}">
            <div class="task-card-top">
                <div class="task-card-name">{{ $task->task_name }}</div>
                <div class="status-dot {{ $task->is_completed ? 'dot-completed' : 'dot-pending' }}"></div>
            </div>

            @if($task->description)
            <div class="task-card-desc">{{ $task->description }}</div>
            @endif

            @if($task->due_date)
            <div class="task-card-meta">
                <i data-lucide="calendar" style="width:12px;height:12px;"></i>
                Due {{ $task->due_date->format('M d, Y') }}
            </div>
            @endif

            <div class="task-card-actions">
                <a href="{{ route('tasks.edit', $task) }}" class="ca ca-edit">
                    <i data-lucide="pencil" style="width:11px;height:11px;"></i>
                    Edit
                </a>
                <form action="{{ route('tasks.updateStatus', $task) }}" method="POST" style="display:contents">
                    @csrf @method('PATCH')
                    @if($task->is_pending)
                    <button type="submit" class="ca ca-done">
                        <i data-lucide="check" style="width:11px;height:11px;"></i>
                        Complete
                    </button>
                    @else
                    <button type="submit" class="ca ca-undo">
                        <i data-lucide="rotate-ccw" style="width:11px;height:11px;"></i>
                        Reopen
                    </button>
                    @endif
                </form>
                <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="display:contents" onsubmit="return confirm('Delete this task?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="ca ca-del">
                        <i data-lucide="trash-2" style="width:11px;height:11px;"></i>
                        Delete
                    </button>
                </form>
            </div>
        </div>
        @empty
        <div class="empty-card">
            <div class="empty-icon">
                <i data-lucide="clipboard-list" style="width:26px;height:26px;"></i>
            </div>
            <h3>No tasks yet</h3>
            <p>Click <strong>Add Task</strong> to create your first task.</p>
        </div>
        @endforelse
    </div>
</div>

<script>lucide.createIcons();</script>
</body>
</html>