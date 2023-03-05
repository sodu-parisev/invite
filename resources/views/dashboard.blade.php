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
                        {{ $invite->passport }}
                    </td>

                    <td>
                        {{ $invite->diploma }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div>
        {{ $invites->links() }}
    </div>
</x-app-layout>
