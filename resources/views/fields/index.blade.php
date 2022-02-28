<x-layouts.app>
    <div class="container">
        @include('partials.experiment-tabs')

        <div>
            <h3 class="float-start mt-4 mb-4">Fields</h3>
    
            <button id="addFieldBtn" type="button" class="btn btn-primary float-end mb-4 mt-4" data-bs-toggle="modal"
                data-bs-target="#addFieldModal">
                Add Field
            </button>
        </div>
    
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Field Name</th>
                    <th scope="col">Field Type</th>
                    <th scope="col">Created By</th>
                    <th scope="col">Updated By</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Updated At</th>
                </tr>
            </thead>
            <tbody id="sortable">
                @foreach ($experiment->fields as $field)
                    <tr data-id="{{ $field->id }}">
                        {{-- <td>{{ $field->id }}</td> --}}
                        <td>{{ $field->name }}</td>
                        <td>{{ $field->type }}</td>
                        <td>{{ $field->author->name }}</td>
                        <td>{{ $field->editor->name }}</td>
                        <td>{{ $field->created_at->format(config('app.dtdisplayformat')) }}</td>
                        <td>{{ $field->updated_at->format(config('app.dtdisplayformat')) }}</td>
                        <td>
                            <form action="{{ route('experiments.fields.destroy', [$experiment->id, $field->id]) }}"
                                method="POST">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure you want to remove this field?')">R</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    
        <form action="{{ route('experiments.fields.store', $experiment->id) }}" method="POST">
            <!-- Modal -->
            <div class="modal fade" id="addFieldModal" tabindex="-1" aria-labelledby="addFieldModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addFieldModalLabel">Add Field</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Field Name</label>
                                <input class="form-control @error('name') is-invalid @enderror" type="name" name="name"
                                    id="name" placeholder="field_name" value="{{ old('name') }}">
                                @error('name')
                                    <div id="validation-name-error" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
    
                            <div class="mb-3">
                                <label for="type" class="form-label">Field Type</label>
                                <select class="form-select @error('type') is-invalid @enderror" aria-label="Field type"
                                    name="type" id="type">
                                    @foreach ($types as $key => $type)
                                        <option value="{{ $key }}"
                                            @if (old('type') == $key) selected @endif>{{ $type }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('type')
                                    <div id="validation-type" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    
    @if (count($errors) > 0)
        <script>
            window.setTimeout(() => {
                document.getElementById('addFieldBtn').click();
            }, 500);
        </script>
    @endif
</x-layouts.app>
