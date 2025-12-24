<?php

use App\Models\User;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Modifier mon profil')]
class extends Component {
    public User $member;

    public function mount()
    {
        $this->authorize('edit', $this->member);
    }
};
?>

<div class="grid grid-cols-10 gap-4">
    <livewire:admin.members.edit_form :memberId="$this->member->id"/>
</div>
