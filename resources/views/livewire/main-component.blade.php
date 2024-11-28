<div>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students</title>
    @livewireStyles
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <button class="btn btn-primary mb-3" wire:click="toggleForm">
            {{ $active_form ? 'Cancel' : 'Student create' }}
        </button>

        @if($success_message)
            <div class="alert alert-success" role="alert">
                {{ $success_message }}
            </div>
        @endif
        @if($active_form)
            <form wire:submit.prevent="createStudent">
                <div class="form-group mt-4">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" wire:model="name" placeholder="Enter name">
                </div>
                <div class="form-group mt-4">
                    <label for="surname">Surname</label>
                    <input type="text" class="form-control" id="surname" wire:model="surname" placeholder="Enter surname">
                </div>
                <div class="form-group mt-4">
                    <label for="age">Age</label>
                    <input type="number" class="form-control" id="age" wire:model="age" placeholder="Enter age">
                </div>
                <div class="form-group mt-4">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" wire:model="address" placeholder="Enter address">
                </div>
                <div class="form-group my-4">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control" id="phone" wire:model="phone" placeholder="Enter phone">
                </div>
                <button type="submit" class="btn btn-success">Submit</button>
            </form>
        @else
            <h1>Students</h1>
            <div class="row mb-3">
                <div class="col">
                    <input type="text" class="form-control" placeholder="Search by name" wire:model="name" wire:keydown="search">
                </div>
                <div class="col">
                    <input type="text" class="form-control" placeholder="Search by surname" wire:model="surname" wire:keydown="search">
                </div>
                <div class="col">
                    <input type="number" class="form-control" placeholder="Search by age" wire:model="age" wire:keydown="search">
                </div>
                <div class="col">
                    <input type="text" class="form-control" placeholder="Search by address" wire:model="address" wire:keydown="search">
                </div>
                <div class="col">
                    <input type="text" class="form-control" placeholder="Search by phone" wire:model="phone" wire:keydown="search">
                </div>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Surname</th>
                        <th>Age</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Is active</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pagination_students as $student)
                        <tr>
                            <td>
                                @if($student->is_active)
                                    <span class="badge bg-success">
                                        {{ $student->name }}
                                    </span>
                                @else
                                    <span class="badge bg-danger">
                                        {{ $student->name }}
                                    </span>
                                @endif
                            </td>
                            <td>{{ $student->surname }}</td>
                            <td>{{ $student->age }}</td>
                            <td>{{ $student->address }}</td>
                            <td>{{ $student->phone }}</td>
                            <td>
                                <div class="form-check form-switch">
                                    <input wire:change="updateStatus({{ $student->id }})" class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" {{ $student->is_active ? 'checked' : '' }}>
                                </div>
                            </td>
                            <td>
                                <button class="btn btn-danger" wire:click="delete({{ $student->id }})">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                </svg>
                                </button>
                                <button class="btn btn-warning" wire:click="edit({{ $student->id }})">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325"/>
                                </svg>
                                </button>
                            </td>
                        </tr>
                        @if($edit_student_id === $student->id)
                            <tr>
                                <td colspan="7">
                                    <form wire:submit.prevent="updateStore">
                                        <input type="hidden" wire:model="edit_student_id">
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group mt-4">
                                                    <label for="edit_name">Name</label>
                                                    <input type="text" class="form-control" id="edit_name" wire:model="edit_name" placeholder="Enter name">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group mt-4">
                                                    <label for="edit_surname">Surname</label>
                                                    <input type="text" class="form-control" id="edit_surname" wire:model="edit_surname" placeholder="Enter surname">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group mt-4">
                                                    <label for="edit_age">Age</label>
                                                    <input type="number" class="form-control" id="edit_age" wire:model="edit_age" placeholder="Enter age">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group mt-4">
                                                    <label for="edit_address">Address</label>
                                                    <input type="text" class="form-control" id="edit_address" wire:model="edit_address" placeholder="Enter address">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group my-4">
                                                    <label for="edit_phone">Phone</label>
                                                    <input type="text" class="form-control" id="edit_phone" wire:model="edit_phone" placeholder="Enter phone">
                                                </div>
                                            </div>
                                            <div class="col d-flex justify-content-center align-items-center">
                                                <button type="submit" class="btn btn-success mt-4">Update</button>
                                            </div>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
            {{
                $pagination_students->links(data:['scrollTo' => false])
            }}
        @endif
    </div>
    @livewireScripts
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>
</div>
