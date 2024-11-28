<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Student;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

class MainComponent extends Component
{       
    public $students;
    public $success_message;
    public $active_form = false;
    public $name;
    public $surname;
    public $age;
    public $address;
    public $phone;
    public $edit_student_id = null;
    use WithPagination, WithoutUrlPagination;

    // edit variables
    public $edit_name;
    public $edit_surname;
    public $edit_age;
    public $edit_address;
    public $edit_phone;

    public function toggleForm()
    {   
        $this->active_form = !$this->active_form;
    }

    public function mount()
    {
        $this->students = Student::all();
    }

    public function createStudent()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'age' => 'required|integer',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
        ]);

        Student::create([
            'name' => $this->name,
            'surname' => $this->surname,
            'age' => $this->age,
            'address' => $this->address,
            'phone' => $this->phone,
        ]);

        $this->students = Student::all();
        $this->toggleForm();
        $this->success_message = 'Student created successfully.';
    }

    public function delete($id)
    {
        Student::destroy($id);
        $this->students = Student::all();
        $this->success_message = 'Student deleted successfully.';
    }

    public function render()
    {   
        $pagination_students = Student::paginate(10);
        return view('livewire.main-component', compact('pagination_students'));
    }

    public function search()
    {
        $this->students = Student::query()
            ->when($this->name, fn($query) => $query->where('name', 'like', "%{$this->name}%"))
            ->when($this->surname, fn($query) => $query->where('surname', 'like', "%{$this->surname}%"))
            ->when($this->age, fn($query) => $query->where('age', $this->age))
            ->when($this->address, fn($query) => $query->where('address', 'like', "%{$this->address}%"))
            ->when($this->phone, fn($query) => $query->where('phone', 'like', "%{$this->phone}%"))
            ->get();
    }

    public function updateStatus($id)
    {   
        $student = Student::find($id);
        $student->is_active = !$student->is_active;
        $student->save();
        $this->students = Student::all();
    }

    public function edit($id){
        $this -> edit_student_id = $id;
        $student = Student::find($id);
        $this -> edit_name = $student -> name;
        $this -> edit_surname = $student -> surname;
        $this -> edit_age = $student -> age;
        $this -> edit_address = $student -> address;
        $this -> edit_phone = $student -> phone;
    }

    public function updateStore(){
        $student = Student::find($this -> edit_student_id);
        $student -> name = $this -> edit_name;
        $student -> surname = $this -> edit_surname;
        $student -> age = $this -> edit_age;
        $student -> address = $this -> edit_address;
        $student -> phone = $this -> edit_phone;
        $student -> save();
        $this -> students = Student::all();
        $this -> edit_student_id = null;
    }
}
