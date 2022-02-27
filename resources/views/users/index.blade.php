<x-layouts.app>
    <div class="container">

        <h1>Users</h1>

        <a href="{{ route('users.create') }}" class="btn btn-primary">Add User</a>

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
                        <td>{{ $user->id }}</td>
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

        <div class="row">
            
        </div>
    </div>
</x-layouts.app>
