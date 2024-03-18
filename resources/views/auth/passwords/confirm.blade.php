@extends('adminlte::auth.passwords.confirm')

@section('title_prefix', __('auth.confirmation'))
@section('title', ' - '. strip_tags(config('adminlte.logo')))