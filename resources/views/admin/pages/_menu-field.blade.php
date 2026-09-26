@php $inMenu = old('show_in_menu', $inMenu ?? false); @endphp
<div class="form-group">
    <div class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" id="showInMenu" name="show_in_menu" value="1" @checked($inMenu)>
        <label class="custom-control-label" for="showInMenu">হেডার মেনুতে এই পেজ দেখান (Home page menu)</label>
    </div>
</div>
