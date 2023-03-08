@php
    use App\Enums\PaymentStatus;
    use App\Enums\FormOfAttendance;
@endphp
<x-invite-layout>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="text-center mb-4">
                            {{ __('EACVI Teaching Course 17-18 марта 2023 г.') }}
                        </h2>
                        
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>{{ __('Participant') }}</th>
                                    <td>{{ $invite->full_name }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Date of submit') }}</th>
                                    <td>{{ $invite->created_at }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Form of attendance') }}</th>
                                    <td>{{ __(FormOfAttendance::from($invite->form_of_attendance)->name) }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Payment Status') }}</th>
                                    <td>
                                        <strong style="color:{{ PaymentStatus::from($invite->payment_status)->getColor() }}">
                                            {{ __(PaymentStatus::from($invite->payment_status)->name) }}
                                        </strong>
                                    </td>
                                </tr>
                                @if(
                                    PaymentStatus::Completed === PaymentStatus::from($invite->payment_status) &&
                                    FormOfAttendance::Offline === FormOfAttendance::from($invite->form_of_attendance)
                                )
                                    <tr>
                                        <th>{{ __('Zoom link') }}:</th>
                                        <td>{{ \App\Models\Settings::where('name', \App\Enums\Settings::ZOOM_URL->value)->value('value') }}</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-invite-layout>