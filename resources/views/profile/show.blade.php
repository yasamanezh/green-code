<x-app-layout>
    @section('title','حساب کاربری')
    <div class="container-fluid">
        <div class="inner-body">
            <div class="page-header">
                <div>
                    <h2 class="main-content-title tx-24 mg-b-5">حساب کاربری</h2><br>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('Dashboard')}}">داشبورد</a></li>
                        <li class="breadcrumb-item active" aria-current="page">حساب کاربری</li>
                    </ol>
                </div>
            </div>
            @include('livewire.admin.layouts.error')
            <div class="row">
                <div class="col-12 ">
                    <div class="card custom-card">
                        <div class="card-header p-3 tx-medium my-auto tx-white bg-primary">
                            حساب کاربری
                        </div>
                        <div class="card-body">
                            <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                                    @livewire('profile.update-profile-information-form')

                                    <x-jet-section-border />
                                @endif

                                @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                                    @livewire('profile.update-password-form')

                                    <x-jet-section-border />
                                @endif

                                @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                                    @livewire('profile.two-factor-authentication-form')

                                    <x-jet-section-border />
                                @endif

                                @livewire('profile.logout-other-browser-sessions-form')

                                @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                                    <x-jet-section-border />

                                    @livewire('profile.delete-user-form')
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
