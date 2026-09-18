<script src="{{ asset('themes/magz/js/jquery.js') }}"></script>
<script src="{{ asset('themes/magz/js/jquery.migrate.js') }}"></script>
<script src="{{ asset('themes/magz/scripts/bootstrap/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('vendor/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('themes/magz/scripts/jquery-number/jquery.number.min.js') }}"></script>
<script src="{{ asset('themes/magz/scripts/owlcarousel/dist/owl.carousel.min.js') }}"></script>
<script src="{{ asset('themes/magz/scripts/toast/jquery.toast.min.js') }}"></script>
<script src="{{ asset('themes/magz/js/e-magz.js') }}"></script>
@stack('scripts')

<script>
function toSystemMode() {
    localStorage.theme = 'system';
    window.updateTheme();
}

function toDarkMode() {
    localStorage.theme = 'dark';
    window.updateTheme();
}

function toLightMode() {
    localStorage.theme = 'light';
    window.updateTheme();
}
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchForm = document.querySelector('.jtv-search-form');

    if (!searchForm) {
        return;
    }

    const searchInput = searchForm.querySelector('.jtv-search-form input[type="search"]');
    const searchToggle = searchForm.querySelector('.jtv-search-toggle');

    if (!searchInput || !searchToggle) {
        return;
    }

    const setSearchState = (isOpen) => {
        searchForm.classList.toggle('is-open', isOpen);
        searchToggle.setAttribute('aria-expanded', String(isOpen));
        searchToggle.setAttribute('aria-label', isOpen ? 'Close search' : 'Open search');
    };

    searchToggle.addEventListener('click', function (event) {
        event.preventDefault();
        const isOpen = searchForm.classList.contains('is-open');

        if (isOpen && searchInput.value.trim() !== '') {
            searchForm.requestSubmit();
            return;
        }

        setSearchState(true);
        searchInput.focus();
    });

    searchInput.addEventListener('focus', () => setSearchState(true));

    searchInput.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') {
            searchInput.value = '';
            searchInput.blur();
            setSearchState(false);
        }
    });

    document.addEventListener('click', function (event) {
        if (!searchForm.contains(event.target) && searchInput.value.trim() === '') {
            setSearchState(false);
        }
    });
});
</script>

@if(session('success'))
<script>
swal("Success", "{{ session('success') }}", "success");
</script>
@endif

@if(session('error'))
<script>
swal("Error", "{{ session('error') }}", "error");
</script>
@endif

<script>
jQuery.event.special.touchstart = {
    setup: function( _, ns, handle ) {
        this.addEventListener("touchstart", handle, { passive: !ns.includes("noPreventDefault") });
    }
};
jQuery.event.special.touchmove = {
    setup: function( _, ns, handle ) {
        this.addEventListener("touchmove", handle, { passive: !ns.includes("noPreventDefault") });
    }
};
jQuery.event.special.wheel = {
    setup: function( _, ns, handle ){
        this.addEventListener("wheel", handle, { passive: true });
    }
};
jQuery.event.special.mousewheel = {
    setup: function( _, ns, handle ){
        this.addEventListener("mousewheel", handle, { passive: true });
    }
};
</script>
