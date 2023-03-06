<x-invite-layout>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="mb-5 text-center">{{ __('Get your invitation to the event') }}</h2>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('invite-submit') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <x-bootstrap-input
                                    required
                                    :name="'full_name'"
                                    :field_label=" __('Full name') "
                            />

                            <x-bootstrap-input
                                    required
                                    :name="'work_place'"
                                    :field_label=" __('Work place') "
                            />

                            <x-bootstrap-input
                                    required
                                    :name="'phone_number'"
                                    :field_label=" __('Phone number') "
                            />

                            <x-bootstrap-input
                                    required
                                    :name="'email'"
                                    :field_label=" __('Email') "
                            />

                            <x-bootstrap-dropdown
                                    required
                                    :name="'form_of_attendance'"
                                    :field_label=" __('Form of attendance') "
                                    :options="App\Enums\FormOfAttendance::getDropdownOptions()"
                            />

                            <x-bootstrap-file-input
                                    :name="'passport'"
                                    :field_label=" __('Passport') "
                            />

                            <x-bootstrap-file-input
                                    :name="'diploma'"
                                    :field_label=" __('Diploma') "
                            />

                            <div>
                                <div class="card mb-4 rounded-3 shadow-sm">
                                    <div class="card-body">
                                        <h3 class="card-title pricing-card-title">
                                           {{ __('Attendance cost: ') }} {{ number_format(\App\Models\Settings::query()->where('name', \App\Enums\Settings::PAYMENT_AMOUNT->value)->value('value') ?? \App\Enums\Settings::PAYMENT_AMOUNT->defaultValue()) . ' ' . __('soum') }}
                                        </h3>
                                        <button class="btn btn-success">
                                            {{ __('Sign up and Pay') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-invite-layout>