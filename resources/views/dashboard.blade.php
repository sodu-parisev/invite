<x-app-layout>
    <form action="" class="row g-3 mb-3">
        <div class="col-sm-2">
            <input
                    type="text"
                    class="form-control"
                    name="full_name"
                    placeholder="{{ __('Search by name') }}"
                    value="{{ request()->query('full_name') }}"
            >
        </div>
        <div class="col-sm-8">
            <button type="submit" class="btn btn-primary">{{ __('Search') }}</button>

            <a class="btn btn-secondary" href="{{ route('dashboard') }}">{{ __('Reset') }}</a>
        </div>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>{{ __('Date and time') }}</th>
                <th>{{ __('Full name') }}</th>
                <th>{{ __('Work place') }}</th>
                <th>{{ __('Phone number') }}</th>
                <th>{{ __('Email') }}</th>
                <th>{{ __('Form of attendance') }}</th>
                <th>{{ __('Passport') }}</th>
                <th>{{ __('Diploma') }}</th>
            </tr>
        </thead>

        <tbody>
            @foreach($invites as $invite)
                <tr>
                    <td>
                        <a href="{{ route('invite-confirm-page', ['invite' => $invite->token]) }}">
                            #{{ $invite->id }}
                        </a>
                    </td>
                    <td>
                        {{ $invite->created_at }}
                    </td>
                    <td>
                        {{ $invite->full_name }}
                    </td>
                    <td>
                        {{ $invite->work_place }}
                    </td>

                    <td>
                        {{ $invite->phone_number }}
                    </td>

                    <td>
                        {{ $invite->email }}
                    </td>

                    <td>
                        {{ __(\App\Enums\FormOfAttendance::from($invite->form_of_attendance)->name) }}
                    </td>

                    <td>
                        @if(!empty($invite->passport))
                        <a
                                href="{{ route('dashboard.download-file', ['filename' => $invite->passport]) }}"
                                class="btn btn-success"
                        >
                            {{ __('Download') }}
                        </a>
                        @endif
                    </td>

                    <td>
                        @if(!empty($invite->diploma))
                        <a
                                href="{{ route('dashboard.download-file', ['filename' => $invite->diploma]) }}"
                                class="btn btn-success"
                        >
                            {{ __('Download') }}
                        </a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div>
        {{ $invites->links() }}
    </div>
</x-app-layout>
