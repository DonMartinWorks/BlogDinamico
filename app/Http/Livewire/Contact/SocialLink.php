<?php

namespace App\Http\Livewire\Contact;

use App\Models\SocialLink as SocialLinkModel;
use Livewire\Component;

class SocialLink extends Component
{
    public function render()
    {
        $socialLinks = SocialLinkModel::get();
        return view('livewire.contact.social-link', ['socialLinks' => $socialLinks]);
    }
}
