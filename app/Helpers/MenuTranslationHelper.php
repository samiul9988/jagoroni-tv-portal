<?php

namespace App\Helpers;

class MenuTranslationHelper
{
    /**
     * Best-effort English labels for the Bangla menu text used across the
     * header/footer nav. Anything not listed here (already-English labels,
     * or future menu items an admin adds) just falls back to itself, so the
     * toggle never breaks on unknown labels — it just won't translate them.
     */
    protected static array $map = [
        'প্রচ্ছদ' => 'Home',
        'জাতীয়' => 'National',
        'বিনোদন' => 'Entertainment',
        'খেলাধুলা' => 'Sports',
        'রাজনীতি' => 'Politics',
        'সারাদেশ' => 'Nationwide',
        'আন্তর্জাতিক' => 'International',
        'মতামত' => 'Opinion',
        'আরও' => 'More',
        'আমাদের টিম' => 'Our Team',
        'লাইভ স্ট্রিমিং' => 'Live Streaming',
        'লাইভ' => 'Live',
        'শিক্ষা' => 'Education',
        'অর্থনীতি' => 'Economy',
        'স্বাস্থ্য' => 'Health',
        'প্রযুক্তি' => 'Technology',
        'যোগাযোগ' => 'Contact',
        'বাংলাদেশ' => 'Bangladesh',
        'বিশ্ব' => 'World',
        'ব্যবসা' => 'Business',
        'বিজ্ঞান' => 'Science',
        'ভ্রমণ' => 'Travel',
        'ফিচার' => 'Feature',
        'ধর্ম' => 'Religion',
        'চাকরি' => 'Jobs',
        'সাহিত্য' => 'Literature',
        'ক্যাম্পাস' => 'Campus',
        'পরিবেশ' => 'Environment',
    ];

    public static function toEnglish(?string $label): string
    {
        $original = trim((string) $label);
        $key = static::normalize($original);

        foreach (static::$map as $bn => $en) {
            if (static::normalize($bn) === $key) {
                return $en;
            }
        }

        return $original;
    }

    /**
     * Bengali conjuncts can be composed multiple ways in Unicode (e.g. "য়"
     * as one codepoint vs "য" + a combining nukta). Normalize to NFC so
     * labels typed in the admin panel still match the dictionary above
     * regardless of which form the browser/DB happened to save.
     */
    protected static function normalize(string $value): string
    {
        if (class_exists(\Normalizer::class)) {
            $normalized = \Normalizer::normalize($value, \Normalizer::FORM_C);
            if ($normalized !== false) {
                return $normalized;
            }
        }

        return $value;
    }
}
