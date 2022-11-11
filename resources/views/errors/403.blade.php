@extends('errors.layout')
@section('title', 'Forbidden')
@section('code', 403)
@section('text', $exception->getMessage() ?: 'Forbidden')

{{-- @section('title', __('Forbidden'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'Forbidden')) --}}
