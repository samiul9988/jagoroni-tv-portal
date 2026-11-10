<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Several header menu items had their `link` set to a literal English
     * translation of the label (e.g. "international") instead of the real
     * category slug (e.g. "antorjatik") — presumably typed by hand when the
     * menu was first set up. Every one of these 404s. Matches on the
     * previous (wrong) value so it's a no-op wherever someone has already
     * corrected a link by hand.
     */
    private array $linkFixes = [
        'জাতীয়' => ['from' => 'national', 'to' => 'jatiyo'],
        'রাজনীতি' => ['from' => 'politics', 'to' => 'rajniti'],
        'সারাদেশ' => ['from' => 'nationwide', 'to' => 'saradesh'],
        'আন্তর্জাতিক' => ['from' => 'international', 'to' => 'antorjatik'],
        'বিনোদন' => ['from' => 'entertainment', 'to' => 'binodon'],
        'খেলাধুলা' => ['from' => 'sports', 'to' => 'kheladhula'],
        'স্বাস্থ্য' => ['from' => 'health', 'to' => 'swasthya'],
        'প্রযুক্তি' => ['from' => 'technology', 'to' => 'projukti'],
        'আমাদের টিম' => ['from' => 'our-team', 'to' => '/team'],
    ];

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        foreach ($this->linkFixes as $label => $fix) {
            DB::table('menu_items')
                ->where('label', $label)
                ->where('link', $fix['from'])
                ->update(['link' => $fix['to']]);
        }

        // The "খেলাধুলা" (Sports) category itself never got a slug at all,
        // which is why its link 404s regardless of the menu fix above.
        DB::table('terms')
            ->where('taxonomy', 'category')
            ->where('name', 'খেলাধুলা')
            ->where('slug', '')
            ->update(['slug' => 'kheladhula']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        foreach ($this->linkFixes as $label => $fix) {
            DB::table('menu_items')
                ->where('label', $label)
                ->where('link', $fix['to'])
                ->update(['link' => $fix['from']]);
        }
    }
};
