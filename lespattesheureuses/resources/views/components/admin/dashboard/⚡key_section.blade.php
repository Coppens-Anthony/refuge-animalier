<?php

use Livewire\Component;

new class extends Component
{
    //
};
?>

<div class="col-span-full">
    <section>
        <h2 class="sr-only">{!! __('admin/dashboard.key_numbers') !!}</h2>
        <ul class="flex gap-4">
            <livewire:admin.dashboard.key_card
                title="{!! __('admin/nav.requests') !!}"
                number="4"
                image="dashboard_requests"
                image_alt="{!! __('admin/nav.request_icon') !!}"
                link_title="{!! __('admin/nav.to_requests') !!}"
                route="index.requests"
            />
            <livewire:admin.dashboard.key_card
                title="{!! __('admin/nav.validations') !!}"
                number="4"
                image="dashboard_validations"
                image_alt="{!! __('admin/nav.validation_icon') !!}"
                link_title="{!! __('admin/nav.to_validations') !!}"
                route="index.validations"
            />
            <livewire:admin.dashboard.key_card
                title="{!! __('admin/nav.messages') !!}"
                number="4"
                image="dashboard_messages"
                image_alt="{!! __('admin/nav.message_icon') !!}"
                link_title="{!! __('admin/nav.to_messages') !!}"
                route="index.messages"
            />
            <livewire:admin.dashboard.key_card
                title="Alertes"
                number="4"
                image="dashboard_alerts"
                image_alt="alert_icon"
                link_title=""
                route="dashboard"
            />
            <livewire:admin.dashboard.key_card
                title="{!! __('admin/nav.members') !!}"
                number="4"
                image="dashboard_messages"
                image_alt="{!! __('admin/nav.member_icon') !!}"
                link_title="{!! __('admin/nav.to_members') !!}"
                route="index.members"
            />
        </ul>
    </section>
</div>
