@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <h3 class="mb-4">Danh sách người dùng</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.users.create') }}" class="btn btn-primary mb-3">➕ Thêm người dùng</a>

    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Tên</th>
                <th>Email</th>
                <th>Role</th>
                <th class="text-center">Hành động</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role }}</td>
                <td class="text-center">
                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-warning">✏️ Sửa</a>
                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Bạn có chắc muốn xóa?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">🗑️ Xóa</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center text-muted">Chưa có người dùng nào</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{ $users->links() }}
</div>
@endsection
