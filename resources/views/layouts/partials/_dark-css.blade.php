@push('css')
<style>
.dark-mode hr, .retenvi hr {
	 border-color: #6c757d;
}

.dark-mode .form-control-custom, .retenvi .form-control-custom {
	 height: calc(1.5rem + 2px);
	 background-color: #343a40;
	 color: #fff;
	 font-size: 1rem;
	 font-weight: 400;
	 border: 1px solid #6c757d;
	 border-radius: 0.25rem;
}

.dark-mode .form-control-custom:focus, .retenvi .form-control-custom:focus {
	 border: 1px solid #80bdff;
	 outline: 0;
	 box-shadow: inset 0 0 0 #000;
}

.dark-mode .select2-selection, .retenvi .select2-selection {
	 background: #454d55;
}

.dark-mode .select2-container--bootstrap4 .select2-selection--multiple .select2-selection__choice, .retenvi .select2-container--bootstrap4 .select2-selection--multiple .select2-selection__choice {
	 color: #ced4c1;
}

.dark-mode .select2-selection {
	 background: #454d55;
}

.dark-mode .form-control:foucs {
    background: #343a40
}

/* Select2 */

.dark-mode .select2-container--bootstrap4 .select2-selection {
    background-color: #343a40
}

.dark-mode .select2-container--bootstrap4 .select2-selection--single .select2-selection__rendered {
    color: #fafafa;
}

.dark-mode .select2-container--default .select2-selection--single .select2-selection__placeholder {
  color: #444;
}

.dark-mode .select2-container--bootstrap4 .select2-dropdown .select2-results__option[aria-selected="true"] {
  color: #b2b2b2;
}

/* Menu */

.dark-mode .dd-handle {
    color: #fafafa;
    background: #454d55;
}

.dark-mode .dd-handle:hover {
    color: #343a40;
    background: #697178;
}

/* Filemanager */

.dark-mode .fm {
    background: #343a40
}

.dark-mode .fm-tree .fm-tree-disk, .dark-mode .fm-breadcrumb .breadcrumb.active-manager {
    background: #6c757d;
}

.dark-mode .fm-table thead th {
    background: #343a40
}

.dark-mode .fm-table tr:hover, .dark-mode .fm-tree-branch li>p:hover, .dark-mode .fm-tree-branch li>p.selected {
    background: #3e4348
}

.dark-mode .bg-link-input {
    background: #343a40!important
}

.dark-mode input:-webkit-autofill, .dark-mode input:-webkit-autofill:focus, .dark-mode input:-webkit-autofill:hover, .dark-mode select:-webkit-autofill, .dark-mode select:-webkit-autofill:focus, .dark-mode select:-webkit-autofill:hover, .dark-mode textarea:-webkit-autofill, .dark-mode textarea:-webkit-autofill:focus, .dark-mode textarea:-webkit-autofill:hover {
    -webkit-text-fill-color: #fff;
    transition: background-color 5000s ease-in-out 0s;
    -webkit-background-clip: text;
}

/* IconPicker */

.dark-mode .iconpicker-popover.popover {
    background: #343a40;
}

.dark-mode .iconpicker-popover.popover.bottom>.arrow:after, .iconpicker-popover.popover.bottomRight>.arrow:after, .iconpicker-popover.popover.bottomLeft>.arrow:after {
    background: #343a40;
}

.dark-mode .iconpicker-popover.popover .popover-title {
    background: #343a40;
    border-bottom: 1px solid #343a40;
}

.dark-mode .iconpicker .iconpicker-items {
    background: #343a40;
}

/* Menu */

.dark-mode .dd3-content {
    background: #343a40;
    border: 1px solid #138496;
    color: #ffffff;
}
</style>
@endpush