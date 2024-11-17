<div>


    <div class="d-flex flex-column justify-content-center align-items-center pt-3">
        <h1 class="fw-bold text-center">ToDo List</h1>
        <div class="my-5" style="width:50%">
            {{-- <form wire:submit.prevent="addItem" class="d-flex">
                <input type="text" class="form-control me-2" wire:model="item" placeholder="New Item">
                <button type="submit" class="btn btn-primary btn-sm">Add Item</button>
            </form> --}}
            <form wire:submit="{{ $editId ? 'updateTodo' : 'addItem' }}">
                <input type="text" wire:model="item" placeholder="Enter a task" />
                @error('item')
                    <span class="error">{{ $message }}</span>
                @enderror

                <input type="file" wire:model="image" placeholder="Enter a task" />
                @if ($image)
                    <div class="mt-3">

                        <img src="{{ $image->temporaryUrl() }}" alt="Image Preview"
                            style="max-width: 200px; max-height: 200px;">
                    </div>
                @endif
                @if ($editId)
                    <small>
                        <img src="{{ asset('storage/images/' . $existingImg) }}" alt="Image">
                    </small>
                @endif
                @error('image')
                    <span class="error">{{ $message }}</span>
                @enderror
                <button type="submit">
                    {{ $editId ? 'Update Task' : 'Add Task' }}
                </button>
            </form>

        </div>

        <table class="table table-hover text-center shadow rounded p-4" style="width: 50%;">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Item</th>
                    <th>Image</th>
                    <td>Action</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($todo_items as $todo_item)
                    <tr>
                        <td>{{ $todo_item->id }}</td>
                        <td>{{ $todo_item->title }}</td>
                        <td><img src="{{ asset('storage/images/' . $todo_item->image) }}" alt="Image"></td>

                        <td>
                            <button wire:click="editTodo({{ $todo_item->id }})"
                                class="btn btn-success btn-sm">Edit</button>
                            <button wire:click="deleteTodo({{ $todo_item->id }})"
                                class="btn btn-danger btn-sm">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if (session()->has('message'))
        <div class="alert alert-success mt-3">
            {{ session('message') }}
        </div>
    @endif


</div>
