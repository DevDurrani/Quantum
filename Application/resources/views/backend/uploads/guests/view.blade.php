@extends('backend.layouts.grid')
@section('section', __('Guests uploads'))
@section('title', $fileEntry->name)
@section('back', route('admin.uploads.guests.index'))
@section('content')
    <div class="row g-3">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body text-center">
                    <div class="file d-flex h-100 justify-content-center align-items-center">
                        @if ($fileEntry->type == 'image')
                            <img src="{{ route('admin.uploads.secure', hashid($fileEntry->id)) }}"
                                alt="{{ $fileEntry->name }}" class="responsive-image rounded-2">
                        @else
                            <div class="p-5">
                                <div class="mb-3">
                                    {!! fileIcon($fileEntry->extension, 'vi-4x') !!}
                                </div>
                                <h4>{{ shortertext($fileEntry->name, 50) }}</h4>
                                <h5 class="text-muted">{{ formatBytes($fileEntry->size) }}</h5>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <ul class="custom-list-group list-group list-group-flush">
                    <li class="list-group-item">
                        <a href="{{ route('file.download', $fileEntry->shared_id) }}" target="_blank"
                            class="btn btn-primary btn-lg w-100 mb-3"><i
                                class="fas fa-external-link-alt me-2"></i>{{ __('Preview') }}</a>
                        <a href="{{ route('admin.uploads.guests.download', $fileEntry->shared_id) }}"
                            class="btn btn-success btn-lg w-100 mb-3"><i
                                class="fas fa-download me-2"></i>{{ __('Download') }}</a>
                        <form action="{{ route('admin.uploads.guests.destroy', $fileEntry->shared_id) }}" method="POST">
                            @csrf @method('DELETE')
                            <button class="vironeer-able-to-delete btn btn-danger btn-lg w-100"><i
                                    class="far fa-trash-alt me-2"></i>{{ __('Delete') }}</button>
                        </form>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <strong>{{ __('Name') }}</strong>
                        <span>{{ shortertext($fileEntry->name, 30) }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <strong>{{ __('Shared id') }}</strong>
                        <span>{{ $fileEntry->shared_id }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <strong>{{ __('Type') }}</strong>
                        <span>{{ shortertext($fileEntry->mime, 30) ?? __('Unknown') }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <strong>{{ __('Size') }}</strong>
                        <span>{{ formatBytes($fileEntry->size) }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <strong>{{ __('Storage') }}</strong>
                        <span>
                            @if ($fileEntry->storageProvider->symbol == 'local')
                                <span><i class="fas fa-server me-2"></i>{{ $fileEntry->storageProvider->symbol }}</span>
                            @else
                                <a class="text-dark capitalize"
                                    href="{{ route('admin.settings.storage.edit', $fileEntry->storageProvider->id) }}">
                                    <i class="fas fa-server me-2"></i>{{ $fileEntry->storageProvider->symbol }}
                                </a>
                            @endif
                        </span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <strong>{{ __('Upload date') }}</strong>
                        <span>{{ vDate($fileEntry->created_at) }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <strong>{{ __('Expiry date') }}</strong>
                        <span>{{ $fileEntry->expiry_at ? vDate($fileEntry->expiry_at) : __('Unlimited time') }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <strong>{{ __('Downloads') }}</strong>
                        <span>{{ formatNumber($fileEntry->downloads) }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <strong>{{ __('Views') }}</strong>
                        <span>{{ formatNumber($fileEntry->views) }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    @push('styles_libs')
        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/vironeer/vironeer-icons.min.css') }}">
    @endpush
@endsection
