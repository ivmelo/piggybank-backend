<x-layouts.app>
    <div class="container">
        <div>
            <h3 class="float-start mt-4 mb-4">Users</h3>
            <a href="{{ route('users.create') }}" class="btn btn-primary float-end mt-4 mb-4">Add User</a>
        </div>

        <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">First</th>
                <th scope="col">Last</th>
                <th scope="col">Admin</th>
                <th scope="col">Created_at</th>
                <th scope="col">Updated_at</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    </th>
                        <td><a href="{{ route('users.edit', $user->id) }}">{{ $user->id }}</a></td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if ($user->is_admin)
                                <span class="badge bg-primary">Admin</span> 
                            @else
                                <span class="badge bg-secondary">User</span> 
                            @endif
                        </td>
                        <td>{{ $user->created_at->format(config('app.dtdisplayformat')) }}</td>
                        <td>{{ $user->updated_at->format(config('app.dtdisplayformat')) }}</td>
                    <tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layouts.app>
