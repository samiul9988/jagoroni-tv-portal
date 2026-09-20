@php
    $locationPost = $post ?? null;
    $selectedDivision = old('division', $locationPost?->division ?? '');
    $selectedDistrict = old('district', $locationPost?->district ?? '');
    $selectedUpazila = old('upazila', $locationPost?->upazila ?? '');
@endphp

<div class="card card-default">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-location-dot mr-1"></i> সংবাদের স্থান</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <div class="form-group">
            <label for="post-division">বিভাগ</label>
            <select id="post-division" name="division" class="form-control" data-location-division data-selected="{{ $selectedDivision }}">
                <option value="">বিভাগ নির্বাচন করুন</option>
            </select>
        </div>
        <div class="form-group">
            <label for="post-district">জেলা</label>
            <select id="post-district" name="district" class="form-control" data-location-district data-selected="{{ $selectedDistrict }}" disabled>
                <option value="">আগে বিভাগ নির্বাচন করুন</option>
            </select>
        </div>
        <div class="form-group mb-0">
            <label for="post-upazila">উপজেলা</label>
            <select id="post-upazila" name="upazila" class="form-control" data-location-upazila data-selected="{{ $selectedUpazila }}" disabled>
                <option value="">আগে জেলা নির্বাচন করুন</option>
            </select>
        </div>
        <small class="form-text text-muted mt-2">এই তথ্যের ভিত্তিতে ওয়েবসাইটের এলাকাভিত্তিক সংবাদ খোঁজা হবে।</small>
    </div>
</div>

@once
@push('js')
<script>
    $(function () {
        const locationData = {
            'ঢাকা': ['ঢাকা', 'গাজীপুর', 'নরসিংদী', 'নারায়ণগঞ্জ', 'টাঙ্গাইল', 'কিশোরগঞ্জ', 'মানিকগঞ্জ', 'মুন্সিগঞ্জ', 'মাদারীপুর', 'রাজবাড়ী', 'শরীয়তপুর', 'ফরিদপুর', 'গোপালগঞ্জ'],
            'চট্টগ্রাম': ['চট্টগ্রাম', 'কক্সবাজার', 'কুমিল্লা', 'ফেনী', 'নোয়াখালী', 'লক্ষ্মীপুর', 'চাঁদপুর', 'ব্রাহ্মণবাড়িয়া', 'রাঙামাটি', 'খাগড়াছড়ি', 'বান্দরবান'],
            'রাজশাহী': ['রাজশাহী', 'নওগাঁ', 'নাটোর', 'চাঁপাইনবাবগঞ্জ', 'পাবনা', 'সিরাজগঞ্জ', 'বগুড়া', 'জয়পুরহাট'],
            'খুলনা': ['খুলনা', 'বাগেরহাট', 'সাতক্ষীরা', 'যশোর', 'ঝিনাইদহ', 'মাগুরা', 'নড়াইল', 'কুষ্টিয়া', 'চুয়াডাঙ্গা', 'মেহেরপুর'],
            'বরিশাল': ['বরিশাল', 'ভোলা', 'ঝালকাঠি', 'পটুয়াখালী', 'পিরোজপুর', 'বরগুনা'],
            'সিলেট': ['সিলেট', 'মৌলভীবাজার', 'হবিগঞ্জ', 'সুনামগঞ্জ'],
            'রংপুর': ['রংপুর', 'দিনাজপুর', 'কুড়িগ্রাম', 'গাইবান্ধা', 'ঠাকুরগাঁও', 'পঞ্চগড়', 'নীলফামারী', 'লালমনিরহাট'],
            'ময়মনসিংহ': ['ময়মনসিংহ', 'জামালপুর', 'নেত্রকোণা', 'শেরপুর']
        };
        const upazilaData = {
            'ঢাকা': ['সাভার', 'ধামরাই', 'দোহার', 'কেরানীগঞ্জ', 'নবাবগঞ্জ'],
            'গাজীপুর': ['গাজীপুর সদর', 'কালিয়াকৈর', 'কালীগঞ্জ', 'কাপাসিয়া', 'শ্রীপুর'],
            'চট্টগ্রাম': ['মীরসরাই', 'সীতাকুণ্ড', 'রাউজান', 'ফটিকছড়ি', 'পটিয়া', 'লোহাগাড়া'],
            'কক্সবাজার': ['কক্সবাজার সদর', 'চকরিয়া', 'টেকনাফ', 'উখিয়া', 'রামু'],
            'রাজশাহী': ['পবা', 'চারঘাট', 'বাঘা', 'পুঠিয়া', 'তানোর', 'মোহনপুর'],
            'খুলনা': ['দাকোপ', 'দিঘলিয়া', 'ডুমুরিয়া', 'কয়রা', 'পাইকগাছা', 'তেরখাদা'],
            'বরিশাল': ['বরিশাল সদর', 'আগৈলঝাড়া', 'বাকেরগঞ্জ', 'বানারীপাড়া', 'গৌরনদী', 'মেহেন্দিগঞ্জ'],
            'সিলেট': ['সিলেট সদর', 'বালাগঞ্জ', 'বিয়ানীবাজার', 'গোলাপগঞ্জ', 'জকিগঞ্জ', 'কানাইঘাট'],
            'রংপুর': ['রংপুর সদর', 'গংগাচড়া', 'কাউনিয়া', 'মিঠাপুকুর', 'পীরগাছা', 'তারাগঞ্জ'],
            'ময়মনসিংহ': ['ময়মনসিংহ সদর', 'ভালুকা', 'ত্রিশাল', 'ধোবাউড়া', 'ফুলবাড়ীয়া', 'গফরগাঁও']
        };

        const division = document.querySelector('[data-location-division]');
        const district = document.querySelector('[data-location-district]');
        const upazila = document.querySelector('[data-location-upazila]');
        if (!division || !district || !upazila) return;

        const fill = (select, values, placeholder, selected = '') => {
            select.innerHTML = `<option value="">${placeholder}</option>`;
            values.forEach(value => {
                const option = new Option(value, value, false, value === selected);
                select.add(option);
            });
            select.disabled = values.length === 0;
        };

        fill(division, Object.keys(locationData), 'বিভাগ নির্বাচন করুন', division.dataset.selected);
        const setDistricts = (selected = district.dataset.selected) => {
            const districts = locationData[division.value] || [];
            fill(district, districts, districts.length ? 'জেলা নির্বাচন করুন' : 'আগে বিভাগ নির্বাচন করুন', selected);
            setUpazilas(district.dataset.selected);
        };
        const setUpazilas = (selected = upazila.dataset.selected) => {
            const values = upazilaData[district.value] || (district.value ? [district.value + ' সদর'] : []);
            fill(upazila, values, values.length ? 'উপজেলা নির্বাচন করুন' : 'আগে জেলা নির্বাচন করুন', selected);
        };

        division.addEventListener('change', () => {
            district.dataset.selected = '';
            upazila.dataset.selected = '';
            setDistricts('');
        });
        district.addEventListener('change', () => {
            upazila.dataset.selected = '';
            setUpazilas('');
        });

        if (division.value) setDistricts();
    });
</script>
@endpush
@endonce
