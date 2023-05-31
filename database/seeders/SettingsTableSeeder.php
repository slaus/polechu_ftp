<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['group' => 'main', 'name' => 'socials', 'value' => json_decode('[{"url": "https://www.facebook.com/", "icon": "ti-facebook", "name": {"en": "Insta", "uk": "Facebook"}}, {"url": "https://dribbble.com/", "icon": "ti-dribbble", "name": {"en": "Facebook", "uk": "Dribbble"}}, {"url": "https://twitter.com/", "icon": "ti-twitter", "name": {"en": null, "uk": "Twitter"}}, {"url": "https://www.instagram.com/", "icon": "ti-instagram", "name": {"en": null, "uk": "Instagram"}}, {"url": "https://www.linkedin.com/", "icon": "ti-linkedin", "name": {"en": null, "uk": "Linkedin"}}]', true)],
            ['group' => 'main', 'name' => 'logo', 'value' => json_decode('{"dark": "/media/logo/logo-black.png", "light": "/media/logo/logo-white.png", "white": "/media/logo/logo.png"}', true)],
            ['group' => 'main', 'name' => 'company', 'value' => json_decode('{"email": "contact@luxury.com", "phone": "+02151 7778 009", "description": {"en": null, "uk": "Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec mollis. Quisque convallis libero in sapien pharetra tincidunt. Aliquam elit ante, malesuada id, tempor eu, gravida id, odio. Maecenas suscipit, risus et eleifend imperdiet, nisi orci ullamcorper massa adipiscing."}}', true)],
        ];

        foreach ($data as $item) {
            Setting::create($item);
        }
    }
}
