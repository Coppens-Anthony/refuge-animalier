<?php

use App\Enums\Status;
use App\Models\Adoption;
use App\Models\Animal;
use App\Models\User;
use Livewire\Component;

new class extends Component {
    public $animals;
    public $adoptions;
    public $members;

    public function mount()
    {
        $this->animals = Animal::where('status', Status::PENDING)->count();
        $this->adoptions = Adoption::count();
        $this->members = User::count();
    }
};
?>

<div class="col-span-full">
    <section>
        <h3 class="sr-only">{!! __('admin/dashboard.key_numbers') !!}</h3>
        <ul class="grid grid-cols-2 sx:grid-cols-3 md:grid-cols-5 gap-4">
            <livewire:admin.dashboard.key_card
                title="{!! __('admin/nav.adoptions') !!}"
                number="{{$this->adoptions}}"
                image="dashboard_requests"
                image_alt="{!! __('admin/nav.request_icon') !!}"
                link_title="{!! __('admin/nav.to_requests') !!}"
                route="index.adoptions"
            />
            @can('view-any', User::class)
                <livewire:admin.dashboard.key_card
                    title="{!! __('admin/nav.validations') !!}"
                    number="{{$this->animals}}"
                    image="dashboard_validations"
                    image_alt="{!! __('admin/nav.validation_icon') !!}"
                    link_title="{!! __('admin/nav.to_validations') !!}"
                    route="index.validations"
                />
            @endcan
            <livewire:admin.dashboard.key_card
                title="{!! __('admin/nav.messages') !!}"
                number="4"
                image="dashboard_messages"
                image_alt="{!! __('admin/nav.message_icon') !!}"
                link_title="{!! __('admin/nav.to_messages') !!}"
                route="index.messages"
            />
            <livewire:admin.dashboard.key_card
                title="{!! __('admin/nav.alerts') !!}"
                number="4"
                image="dashboard_alerts"
                image_alt="alert_icon"
                link_title="{!! __('admin/nav.to_messages') !!}"
                route="index.messages"
            />
            <livewire:admin.dashboard.key_card
                title="{!! __('admin/nav.members') !!}"
                number="{{$this->members}}"
                image="dashboard_messages"
                image_alt="{!! __('admin/nav.member_icon') !!}"
                link_title="{!! __('admin/nav.to_members') !!}"
                route="index.members"
            />
        </ul>
    </section>
</div>
