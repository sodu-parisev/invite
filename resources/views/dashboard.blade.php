<x-app-layout>
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
                <th>{{ __('Payment Status') }}</th>
                <th>{{ __('Passport') }}</th>
                <th>{{ __('Diploma') }}</th>
            </tr>
        </thead>

        <tbody>
            @foreach($invites as $invite)
                <tr>
                    <td>
                        {{ $invite->id }}
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
                        {{ $invite->form_of_attendance }}
                    </td>

                    <td>

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
