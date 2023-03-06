<x-app-layout>
    <form action="{{ route('dashboard.settings-submit') }}" method="POST">
        <x-bootstrap-input
                required
                :name="\App\Enums\Settings::PAYMENT_AMOUNT->value"
                :field_label=" __('Amount of payment') "
                value="{{ $settings->where('name', \App\Enums\Settings::PAYMENT_AMOUNT->value)->value('value') }}"
        />
    </form>
</x-app-layout>