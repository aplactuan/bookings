<?php

namespace App\Http\Livewire;

use App\Models\Service;
use Livewire\Component;

class CreateBooking extends Component
{
    public $employees;

    public $state = [
        'service' => '',
        'employee' => ''
    ];

    public function updatedStateService($serviceId)
    {
        $this->state['employee'] = null;

        $this->employees = $this->selectedService->employees;
    }

    public function mount()
    {
        $this->employees = collect();
    }

    public function getSelectedServiceProperty()
    {
        if (!$this->state['service']) {
            return '';
        }

        return Service::find($this->state['service']);
    }

    public function render()
    {
        $services = Service::get();

        return view('livewire.create-booking', [
            'services' => $services
        ])
            ->layout('layouts.guest');
    }
}