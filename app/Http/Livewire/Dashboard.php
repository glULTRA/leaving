<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Dashboard extends Component
{
    public $listeners = ['success'];
    
    public function mount(){
    }
    public function render()
    {
        return view('livewire.dashboard');
    }
}
