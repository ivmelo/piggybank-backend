<div class="mb-4">
    <h2>{{ $experiment->name }}</h2>
</div>

<ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link @if(request()->routeIs('experiments.show') || request()->routeIs('participants.create') || request()->routeIs('participants.show') || request()->routeIs('participants.edit')) active @endif" aria-current="page" href="{{ route('experiments.show', $experiment->id) }}">Participants</a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if(request()->routeIs('experiments.fields.index'))) active @endif" href="{{ route('experiments.fields.index', $experiment->id) }}">Fields</a>
    </li>
    @can('update-experiment')
    <li class="nav-item">
        <a class="nav-link @if(request()->routeIs('experiments.edit'))) active @endif" href="{{ route('experiments.edit', $experiment->id) }}">Edit</a>
    </li>
    @endcan
    <li class="nav-item">
        <a class="nav-link @if(request()->routeIs('experiments.download-csv'))) active @endif" href="{{ route('experiments.download-csv', $experiment->id) }}">Download CSV</a>
    </li>
</ul>
