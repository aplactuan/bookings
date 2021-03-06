<div class="bg-gray-200 max-w-sm mx-auto m-6 p-5 rounded-lg">
    <form>
        <div class="mb-6">
            <label for="service" class="inline-block text-gray-700 font-bold mb-2">Select Service</label>
            <select name="service" id="service" class="bg-white h-10 w-full border-none rounded-lg" wire:model="state.service">
                <option value="">Select a service</option>
                @foreach($services as $service)
                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-6 {{ !$employees->count() ? 'opacity-25' : '' }}">
            <label for="employee" class="inline-block text-gray-700 font-bold mb-2">Select Employee</label>
            <select name="employee"
                    id="employee"
                    class="bg-white h-10 w-full border-none rounded-lg"
                    wire:model="state.employee"
                    {{ !$employees->count() ? 'disabled="disabled"' : '' }}
            >
                <option value="">Select an employee</option>
                @foreach($employees as $employee)
                    <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-6 {{ !$this->selectedService || !$this->selectedEmployee ? 'opacity-25' : '' }}">
            <label for="appointment-time" class="inline-block text-gray-700 font-bold mb-2">Select appointment time</label>
        </div>
        <livewire:booking-calendar />
    </form>
</div>
