@extends('backend.layouts.grid')
@section('title', __('Languages'))
@section('section', __('Settings'))
@section('link', route('languages.create'))
@section('modal', __('Settings'))
@section('content')
    <div class="card">
        <table id="datatable" class="table w-100">
            <thead>
                <tr>
                    <th class="tb-w-3x">{{ __('#') }}</th>
                    <th class="tb-w-10x">{{ __('Name') }}</th>
                    <th class="tb-w-3x">{{ __('Code') }}</th>
                    <th class="tb-w-3x">{{ __('Translate status') }}</th>
                    <th class="tb-w-7x">{{ __('Added date') }}</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($languages as $language)
                    <tr class="item">
                        <td>{{ $language->id }}</td>
                        <td>{{ $language->name . ' - ' . $language->native }} @if (env('DEFAULT_LANGUAGE') == $language->code)
                                ({{ __('Default') }})
                                </span>
                            @endif
                        </td>
                        <td><a href="{{ route('language.translate', $language->code) }}">{{ $language->code }}</a></td>
                        <td>
                            @if ($language->translates_count != 0)
                                <span class="badge bg-yellow text-dark">{{ $language->translates_count }}
                                    {{ __('Translations are missing') }}</span>
                            @else
                                <span class="badge bg-success">{{ __('Translate are completed') }}</span>
                            @endif
                        </td>
                        <td>{{ vDate($language->created_at) }}</td>
                        <td>
                            <div class="text-end">
                                <button type="button" class="btn btn-sm rounded-3" data-bs-toggle="dropdown"
                                    aria-expanded="true">
                                    <i class="fa fa-ellipsis-v fa-sm text-muted"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-sm-end" data-popper-placement="bottom-end">
                                    @if (env('DEFAULT_LANGUAGE') != $language->code)
                                        <li>
                                            <form action="{{ route('language.default', encrypt($language->id)) }}"
                                                method="POST">
                                                @csrf
                                                <button class="vironeer-form-confirm dropdown-item"><i
                                                        class="fas fa-star me-2"></i>{{ __('Set as default') }}</button>
                                            </form>
                                        </li>
                                    @endif
                                    <li>
                                        <a class="dropdown-item"
                                            href="{{ route('language.translate', $language->code) }}"><i
                                                class="fas fa-language me-2"></i>{{ __('Translate') }}</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('languages.edit', $language->id) }}"><i
                                                class="fa fa-edit me-2"></i>{{ __('Edit') }}</a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider" />
                                    </li>
                                    <li>
                                        <form action="{{ route('languages.destroy', $language->id) }}" method="POST">
                                            @csrf @method('DELETE')
                                            <button class="vironeer-able-to-delete dropdown-item text-danger"><i
                                                    class="far fa-trash-alt me-2"></i>{{ __('Delete') }}</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewModalLabel">{{ __('Language Settings') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="langSettingsForm" action="{{ route('language.settings.update') }}" method="POST">
                        @csrf
                        <label class="form-label">{{ __('Include language code in URL') }} : <span
                                class="red">*</span></label>
                        <input type="checkbox" name="website_language_type" data-toggle="toggle"
                            data-on="{{ __('Yes') }}" data-off="{{ __('No') }}"
                            {{ $settings['website_language_type'] ? 'checked' : '' }}>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
                    <button form="langSettingsForm" class="btn btn-primary">{{ __('Save changes') }}</button>
                </div>
            </div>
        </div>
    </div>
@endsection
