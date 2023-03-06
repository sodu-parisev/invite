<x-app-layout>
    <form action="{{ route('dashboard.settings-submit') }}" method="POST">
        @csrf

        @foreach(\App\Enums\Settings::getDbSettings() as $setting)
            <x-bootstrap-input
                    required
                    :name="$setting->value"
                    :field_label=" __($setting->getLabel()) "
                    value="{{ $settings->where('name', $setting->value)->value('value') ?? $setting->defaultValue() }}"
            />
        @endforeach

        <button type="submit" class="btn btn-success">
            {{ __('Save') }}
        </button>
    </form>
</x-app-layout>