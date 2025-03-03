<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class UserManagement extends Component
{

    public $users, $user_id, $name, $email, $age, $phone, $role;
    public $showModal = false; // Controls modal visibility
    protected $listeners = ['editUser'];

    public function mount()
    {
        $this->users = User::where('role', 'user')->get();
    }

    public function addUserForm(){
        $this->name = $this->email = $this->age = $this->phone = $this->role = '';
        $this->showModal = true;
    }

    public function editUser($id)
    {
        $user = User::findOrFail($id);

        // Set user details in variables
        $this->user_id = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->age = $user->age;
        $this->phone = $user->phone;
        $this->role = $user->role;

        // Show modal
        $this->showModal = true;
    }

    public function updateUser()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email',
            'age' => 'required|numeric',
            'phone' => 'required',
            'role' => 'required',
        ]);


            $user = User::updateOrCreate(['id' =>$this->user_id],[
                'name' => $this->name,
                'email' => $this->email,
                'age' => $this->age,
                'phone' => $this->phone,
                'role' => $this->role,
                'profile' => 'img/users/default1.png',
                'password' => '123456',
            ]);
        $this->users = User::where('role', 'user')->get();
        if ($this->user_id) {
            session()->flash('message', 'User updated successfully.');
        } else {
            session()->flash('message', 'User created successfully.');
        }
        $this->showModal = false;
    }

    public function RemoveUser($id)
    {
        User::find($id)->delete();
        $this->users = User::where('role', 'user')->get();
    }


    public function closeModal()
    {
        $this->showModal = false;
    }

    public function render()
    {
        return view('livewire.user-management');
    }
}
