<div>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students</title>
    @livewireStyles
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
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $student)
                        <tr>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->surname }}</td>
                            <td>{{ $student->age }}</td>
                            <td>{{ $student->address }}</td>
                            <td>{{ $student->phone }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
    @livewireScripts
</body>
</div>
