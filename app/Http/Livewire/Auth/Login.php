<?php

namespace App\Http\Livewire\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Symfony\Component\HttpFoundation\Session\Session;

class Login extends Component
{
    public $email;
    public $password;
    public $remember;

    // protected $listeners = ['error' => '$refresh'];


    public function rules(){
        return [
            'email' => 'required|email',
            'password' => 'required|min:8',
        ];
    }


    public function mount(){
        $this->emit('error', '$refresh');
    }
    // public function save(): void
    // {
    //     // use a simple syntax: success | error | warning | info
    //     $this->notification()->success(
    //         $title = 'Profile saved',
    //         $description = 'Your profile was successfull saved'
    //     );
    //     $this->notification()->error(
    //         $title = 'Error !!!',
    //         $description = 'Your profile was not saved'
    //     );
 
    //     // or use a full syntax
    //     $this->notification([
    //         'title'       => 'Profile saved!',
    //         'description' => 'Your profile was successfull saved',
    //         'icon'        => 'success'
    //     ]);
    //     $this->notification()->send([
    //         'title'       => 'Profile saved!',
    //         'description' => 'Your profile was successfull saved',
    //         'icon'        => 'success'
    //     ]);
    // }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    
    public function store(Request $request){
        $validatedData = $this->validate();

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember))
        {
            session()->put('success', 'Succesfully logged in.');
            $this->emit('redirect', '/dashboard');
        }else{
            // session()->put('message', 'weird!');
            session()->flash('error', 'email or password must be wrong.');
            $this->emit('error');
        }
    }

    public function clear(){
        session()->forget('message');
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
