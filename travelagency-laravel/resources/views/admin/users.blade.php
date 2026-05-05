<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>User Management - TravelAgency</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', sans-serif; background: #f5f5f5; min-height: 100vh; display: flex; flex-direction: column; }
        .container { max-width: 1200px; margin: 40px auto; padding: 0 20px; flex: 1; }
        h1 { color: #333; margin-bottom: 25px; font-size: 1.8rem; }

        /* Stats */
        .stats { display: grid; grid-template-columns: repeat(auto-fit, minmax(160px, 1fr)); gap: 20px; margin-bottom: 30px; }
        .stat-card { background: white; border-radius: 12px; padding: 20px; text-align: center; box-shadow: 0 4px 15px rgba(0,0,0,0.08); }
        .stat-number { font-size: 2rem; font-weight: 700; color: #667eea; }
        .stat-label { color: #888; font-size: 0.9rem; margin-top: 5px; }

        /* Table */
        .table-wrap { background: white; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.08); overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; min-width: 750px; }
        thead { background: linear-gradient(135deg, #667eea, #764ba2); color: white; }
        th { padding: 12px 15px; text-align: left; font-size: 0.85rem; font-weight: 600; white-space: nowrap; }
        td { padding: 12px 15px; border-bottom: 1px solid #f0f0f0; font-size: 0.85rem; color: #555; vertical-align: middle; white-space: nowrap; }
        tr:last-child td { border-bottom: none; }
        tr:hover td { background: #f9f9ff; }

        /* Mobile scroll hint */
        .scroll-hint { display: none; color: #888; font-size: 0.8rem; margin-bottom: 8px; text-align: right; }
        @media (max-width: 800px) { .scroll-hint { display: block; } }

        /* Current user row highlight */
        tr.current-user td { background: #f0f4ff; }
        tr.current-user:hover td { background: #e8eeff; }
        .you-badge { display: inline-block; padding: 2px 8px; background: #667eea; color: white; border-radius: 10px; font-size: 0.7rem; font-weight: 700; margin-left: 6px; vertical-align: middle; }

        /* Role badges */
        .badge { padding: 4px 12px; border-radius: 20px; font-size: 0.78rem; font-weight: 700; }
        .badge-admin { background: #fef3c7; color: #d97706; }
        .badge-agent { background: #d1fae5; color: #065f46; }
        .badge-traveler { background: #dbeafe; color: #1d4ed8; }

        /* Role select */
        .role-select { padding: 7px 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 0.85rem; cursor: pointer; transition: all 0.3s; background: white; min-width: 120px; }
        .role-select:focus { outline: none; border-color: #667eea; }
        .role-select:hover { border-color: #667eea; }
        .role-select:disabled { background: #f5f5f5; cursor: not-allowed; opacity: 0.7; border-color: #e0e0e0; }

        /* Save button */
        .btn-save { padding: 7px 16px; background: #667eea; color: white; border: none; border-radius: 8px; font-size: 0.85rem; font-weight: 600; cursor: pointer; transition: all 0.3s; }
        .btn-save:hover { background: #764ba2; transform: translateY(-1px); }
        .btn-save:disabled { background: #ccc; cursor: not-allowed; transform: none; }

        /* Toast notification */
        .toast { position: fixed; bottom: 30px; right: 30px; padding: 14px 20px; border-radius: 12px; color: white; font-weight: 600; font-size: 0.9rem; z-index: 9999; opacity: 0; transform: translateY(20px); transition: all 0.3s; pointer-events: none; }
        .toast.show { opacity: 1; transform: translateY(0); }
        .toast.success { background: #28a745; }
        .toast.error { background: #dc3545; }

        /* Lock icon for admin */
        .lock-icon { color: #d97706; font-size: 1rem; }

        @media (max-width: 600px) {
            .container { margin: 20px auto; }
            h1 { font-size: 1.4rem; }
        }
    </style>
</head>
<body>
@include('components.navbar')

<div class="container">
    <h1>👥 {{ __('lang.user_management') }}</h1>

    <div class="stats">
        <div class="stat-card">
            <div class="stat-number">{{ $users->count() }}</div>
            <div class="stat-label">Total Users</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ $users->where('role','admin')->count() }}</div>
            <div class="stat-label">Admins</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ $users->where('role','agent')->count() }}</div>
            <div class="stat-label">Agents</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ $users->where('role','traveler')->count() }}</div>
            <div class="stat-label">Travelers</div>
        </div>
    </div>
    <p class="scroll-hint">← Scroll to see more →</p>
    <div class="table-wrap">
        <table>
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Country</th>
                <th>Current Role</th>
                <th>Change Role</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr class="{{ $user->id == session('user_id') ? 'current-user' : '' }}">
                    <td>#{{ $user->id }}</td>
                    <td>
                        <strong>{{ $user->name }}</strong>
                        @if($user->id == session('user_id'))
                            <span class="you-badge">YOU</span>
                        @endif
                    </td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->country ?? '—' }}</td>
                    <td>
                        <span class="badge badge-{{ $user->role }}">
                            {{ strtoupper($user->role) }}
                        </span>
                    </td>
                    <td>
                        @if($user->role === 'admin' || $user->id == session('user_id'))
                            {{-- Нельзя менять роль admin или себя --}}
                            <span class="lock-icon">🔒</span>
                            <select class="role-select" disabled>
                                <option>{{ strtoupper($user->role) }}</option>
                            </select>
                        @else
                            <select class="role-select" id="role-{{ $user->id }}" data-user-id="{{ $user->id }}" data-original="{{ $user->role }}">
                                <option value="traveler" {{ $user->role === 'traveler' ? 'selected' : '' }}>TRAVELER</option>
                                <option value="agent" {{ $user->role === 'agent' ? 'selected' : '' }}>AGENT</option>
                                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>ADMIN</option>

                            </select>
                        @endif
                    </td>
                    <td>
                        @if($user->role !== 'admin' && $user->id != session('user_id'))
                            <button class="btn-save" id="btn-{{ $user->id }}" onclick="saveRole({{ $user->id }})">
                                Save
                            </button>
                        @else
                            —
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="toast" id="toast"></div>

@include('components.footer')

<script>
    const token = document.querySelector('meta[name="csrf-token"]').content;

    async function saveRole(userId) {
        const select = document.getElementById('role-' + userId);
        const btn = document.getElementById('btn-' + userId);
        const newRole = select.value;
        const originalRole = select.dataset.original;

        if (newRole === originalRole) {
            showToast('Role is already ' + newRole.toUpperCase(), 'error');
            return;
        }

        btn.disabled = true;
        btn.textContent = '⏳';

        try {
            const response = await fetch('/users/' + userId + '/role', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token
                },
                body: JSON.stringify({ role: newRole })
            });

            const result = await response.json();

            if (response.ok) {
                select.dataset.original = newRole;

                // Обновляем badge в колонке "Current Role"
                const row = select.closest('tr');
                const badge = row.querySelector('.badge');
                badge.className = 'badge badge-' + newRole;
                badge.textContent = newRole.toUpperCase();

                showToast('✅ Role updated to ' + newRole.toUpperCase(), 'success');
            } else {
                showToast('❌ ' + (result.error || 'Error'), 'error');
                select.value = originalRole;
            }
        } catch (err) {
            showToast('❌ Network error', 'error');
            select.value = originalRole;
        } finally {
            btn.disabled = false;
            btn.textContent = 'Save';
        }
    }

    function showToast(message, type) {
        const toast = document.getElementById('toast');
        toast.textContent = message;
        toast.className = 'toast ' + type + ' show';
        setTimeout(() => { toast.classList.remove('show'); }, 3000);
    }
</script>
</body>
</html>
