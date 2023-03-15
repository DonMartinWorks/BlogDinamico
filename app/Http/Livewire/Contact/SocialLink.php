<?php

namespace App\Http\Livewire\Contact;

use Livewire\Component;
use App\Http\Livewire\Traits\SlideOver;
use App\Http\Livewire\Traits\Notification;
use App\Models\SocialLink as SocialLinkModel;

class SocialLink extends Component
{
    use Notification, SlideOver;

    public SocialLinkModel $socialLink;
    public $socialLinkSelected = '';

    protected $listeners = ['deleteSocialLink'];

    protected $rules = [
        'socialLink.name' => 'required|max:20',
        'socialLink.url' => 'required|url',
        'socialLink.icon' => ['nullable', 'regex:/^(fa-brands|fa-solid)\sfa-[a-z-]+/i'],
    ];

    public function updatedSocialLinkSelected()
    {
        $data = SocialLinkModel::find($this->socialLinkSelected);

        if ($data) {
            $this->socialLink = $data;
        } else {
            $this->socialLinkSelected = '';
        }
    }

    public function mount()
    {
        $this->socialLink = new SocialLinkModel();
    }

    public function create()
    {
        if ($this->socialLink->getKey()) {
            $this->socialLink = new SocialLinkModel();
        }

        $this->openSlide(true);
    }

    public function save()
    {
        $this->validate();

        $this->socialLink->save();

        $this->reset(['openSlideOver', 'socialLinkSelected']);

        $this->notify(__('Social link saved successfully!'));
    }

    public function deleteSocialLink()
    {
        $this->socialLink->delete();
        $this->reset('socialLinkSelected');
        $this->notify(__('Social link has been deleted.'), 'deleteMessage');
    }

    public function render()
    {
        $socialLinks = SocialLinkModel::get();
        return view('livewire.contact.social-link', ['socialLinks' => $socialLinks]);
    }
}
