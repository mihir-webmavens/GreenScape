<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class AdminUserManagement extends Component
{
    public $users, $user_id, $name, $email, $age, $phone,$profile, $role,$password;
    public $showModal = false; // Controls modal visibility
    protected $listeners = ['editUser','refreshComponent'];
    public $data;

    public function GetUser()
    {
        $this->users = User::where('role',operator: 'admin')->get();
    }

    public function addUserForm(){
        $this->name = $this->email = $this->age = $this->phone = $this->role = '';
        $this->profile = "Users/default1.png";
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
        $this->profile = $user->profile;
        $this->role = $user->role;
        if(isset($user->password)){
            $this->password = $user->password;
        }else{
            $this->password = "123456";
        }
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
            'profile' => $this->profile,
            'password' => bcrypt('123456'),
        ]);
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
        session()->flash('message', value: 'User Deleted successfully.');
    }


    public function closeModal()
    {
        $this->showModal = false;
    }

    public function render()
    {
        $this->GetUser();
        return view('livewire.admin-user-management');
    }
}

