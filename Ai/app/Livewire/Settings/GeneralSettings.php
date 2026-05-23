<?php

namespace App\Livewire\Settings;

use App\Models\GeneralSetting;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class GeneralSettings extends Component
{
    use WithFileUploads;

    public $activeTab = 'site';

    // ── Site Info ──
    public $site_name, $site_tagline, $site_email, $site_phone, $site_address;
    public $site_logo, $existingLogo = '';
    public $site_favicon, $existingFavicon = '';

    // ── SEO ──
    public $meta_title, $meta_description, $meta_keywords;
    public $og_image, $existingOgImage = '';
    public $google_analytics_id, $header_scripts, $footer_scripts;

    // ── Currency & Language ──
    public $currency_code, $currency_symbol;
    public $currency_position = 'before';
    public $timezone, $date_format, $language;

    // ── Mail ──
    public $mail_driver = 'smtp';
    public $mail_host, $mail_port, $mail_username, $mail_password;
    public $mail_encryption = 'tls';
    public $mail_from_address, $mail_from_name;
    public $showMailPassword = false;
    public $testMailTo = '';
    public $testMailSent = false;

    // ── Social ──
    public $facebook, $instagram, $twitter, $youtube, $tiktok, $linkedin, $whatsapp;

    // ── Maintenance ──
    public $maintenance_mode = false;
    public $maintenance_message, $maintenance_allowed_ips;

    // ────────────────────────────────────────
    public function mount()
    {
        $s = GeneralSetting::instance();

        // Site
        $this->site_name        = $s->site_name;
        $this->site_tagline     = $s->site_tagline;
        $this->site_email       = $s->site_email;
        $this->site_phone       = $s->site_phone;
        $this->site_address     = $s->site_address;
        $this->existingLogo     = $s->site_logo ?? '';
        $this->existingFavicon  = $s->site_favicon ?? '';

        // SEO
        $this->meta_title           = $s->meta_title;
        $this->meta_description     = $s->meta_description;
        $this->meta_keywords        = $s->meta_keywords;
        $this->existingOgImage      = $s->og_image ?? '';
        $this->google_analytics_id  = $s->google_analytics_id;
        $this->header_scripts       = $s->header_scripts;
        $this->footer_scripts       = $s->footer_scripts;

        // Currency
        $this->currency_code     = $s->currency_code;
        $this->currency_symbol   = $s->currency_symbol;
        $this->currency_position = $s->currency_position;
        $this->timezone          = $s->timezone;
        $this->date_format       = $s->date_format;
        $this->language          = $s->language;

        // Mail
        $this->mail_driver       = $s->mail_driver;
        $this->mail_host         = $s->mail_host;
        $this->mail_port         = $s->mail_port;
        $this->mail_username     = $s->mail_username;
        $this->mail_password     = $s->mail_password;
        $this->mail_encryption   = $s->mail_encryption;
        $this->mail_from_address = $s->mail_from_address;
        $this->mail_from_name    = $s->mail_from_name;

        // Social
        $this->facebook  = $s->facebook;
        $this->instagram = $s->instagram;
        $this->twitter   = $s->twitter;
        $this->youtube   = $s->youtube;
        $this->tiktok    = $s->tiktok;
        $this->linkedin  = $s->linkedin;
        $this->whatsapp  = $s->whatsapp;

        // Maintenance
        $this->maintenance_mode         = $s->maintenance_mode;
        $this->maintenance_message      = $s->maintenance_message;
        $this->maintenance_allowed_ips  = $s->maintenance_allowed_ips;
    }

    // ════════════════════════════════════════
    // SAVE
    // ════════════════════════════════════════
    public function save()
    {
        $this->validate([
            // Site
            'site_name'           => 'nullable|string|max:200',
            'site_tagline'        => 'nullable|string|max:300',
            'site_email'          => 'nullable|email|max:200',
            'site_phone'          => 'nullable|string|max:50',
            'site_address'        => 'nullable|string|max:500',
            'site_logo'           => 'nullable|image|max:2048',
            'site_favicon'        => 'nullable|image|max:512',
            // SEO
            'meta_title'          => 'nullable|string|max:200',
            'meta_description'    => 'nullable|string|max:500',
            'meta_keywords'       => 'nullable|string|max:500',
            'og_image'            => 'nullable|image|max:2048',
            'google_analytics_id' => 'nullable|string|max:50',
            // Currency
            'currency_code'       => 'nullable|string|max:10',
            'currency_symbol'     => 'nullable|string|max:10',
            'currency_position'   => 'nullable|in:before,after',
            'timezone'            => 'nullable|string|max:100',
            'date_format'         => 'nullable|string|max:30',
            'language'            => 'nullable|string|max:10',
            // Mail
            'mail_host'           => 'nullable|string|max:200',
            'mail_port'           => 'nullable|integer',
            'mail_username'       => 'nullable|string|max:200',
            'mail_encryption'     => 'nullable|in:tls,ssl,none',
            'mail_from_address'   => 'nullable|email|max:200',
            'mail_from_name'      => 'nullable|string|max:200',
            // Social
            'facebook'            => 'nullable|url|max:300',
            'instagram'           => 'nullable|url|max:300',
            'twitter'             => 'nullable|url|max:300',
            'youtube'             => 'nullable|url|max:300',
            'tiktok'              => 'nullable|url|max:300',
            'linkedin'            => 'nullable|url|max:300',
            'whatsapp'            => 'nullable|string|max:20',
        ]);

        $s    = GeneralSetting::instance();
        $data = [
            'site_name'              => $this->site_name,
            'site_tagline'           => $this->site_tagline,
            'site_email'             => $this->site_email,
            'site_phone'             => $this->site_phone,
            'site_address'           => $this->site_address,
            'meta_title'             => $this->meta_title,
            'meta_description'       => $this->meta_description,
            'meta_keywords'          => $this->meta_keywords,
            'google_analytics_id'    => $this->google_analytics_id,
            'header_scripts'         => $this->header_scripts,
            'footer_scripts'         => $this->footer_scripts,
            'currency_code'          => $this->currency_code,
            'currency_symbol'        => $this->currency_symbol,
            'currency_position'      => $this->currency_position,
            'timezone'               => $this->timezone,
            'date_format'            => $this->date_format,
            'language'               => $this->language,
            'mail_driver'            => $this->mail_driver,
            'mail_host'              => $this->mail_host,
            'mail_port'              => $this->mail_port,
            'mail_username'          => $this->mail_username,
            'mail_encryption'        => $this->mail_encryption,
            'mail_from_address'      => $this->mail_from_address,
            'mail_from_name'         => $this->mail_from_name,
            'facebook'               => $this->facebook,
            'instagram'              => $this->instagram,
            'twitter'                => $this->twitter,
            'youtube'                => $this->youtube,
            'tiktok'                 => $this->tiktok,
            'linkedin'               => $this->linkedin,
            'whatsapp'               => $this->whatsapp,
            'maintenance_mode'       => $this->maintenance_mode,
            'maintenance_message'    => $this->maintenance_message,
            'maintenance_allowed_ips'=> $this->maintenance_allowed_ips,
        ];

        // Password: only update if changed
        if ($this->mail_password) {
            $data['mail_password'] = $this->mail_password;
        }

        // Handle file uploads
        foreach ([
            'site_logo'    => ['prop' => 'site_logo',    'existing' => 'existingLogo',    'folder' => 'settings'],
            'site_favicon' => ['prop' => 'site_favicon', 'existing' => 'existingFavicon', 'folder' => 'settings'],
            'og_image'     => ['prop' => 'og_image',     'existing' => 'existingOgImage', 'folder' => 'settings/seo'],
        ] as $field => $cfg) {
            if ($this->{$cfg['prop']} && is_object($this->{$cfg['prop']})) {
                if ($this->{$cfg['existing']}) {
                    Storage::disk('public')->delete($this->{$cfg['existing']});
                }
                $path = $this->{$cfg['prop']}->store($cfg['folder'], 'public');
                $data[$field]              = $path;
                $this->{$cfg['existing']} = $path;
                $this->{$cfg['prop']}     = null;
            }
        }

        $s->update($data);
        session()->flash('success', 'Settings saved successfully.');
    }

    // ════════════════════════════════════════
    // SEND TEST EMAIL
    // ════════════════════════════════════════
    public function sendTestMail()
    {
        $this->validate(['testMailTo' => 'required|email']);

        try {
            config([
                'mail.mailers.smtp.host'       => $this->mail_host,
                'mail.mailers.smtp.port'       => $this->mail_port,
                'mail.mailers.smtp.username'   => $this->mail_username,
                'mail.mailers.smtp.password'   => $this->mail_password,
                'mail.mailers.smtp.encryption' => $this->mail_encryption,
                'mail.from.address'            => $this->mail_from_address,
                'mail.from.name'               => $this->mail_from_name,
            ]);

            \Illuminate\Support\Facades\Mail::raw(
                'This is a test email from your ' . ($this->site_name ?? 'store') . ' admin panel.',
                fn($msg) => $msg->to($this->testMailTo)->subject('Test Email')
            );

            $this->testMailSent = true;
            session()->flash('success', 'Test email sent to ' . $this->testMailTo);
        } catch (\Exception $e) {
            session()->flash('error', 'Failed: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.settings.general-settings')
            ->layout('layouts.admin');
    }
}