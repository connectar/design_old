<form id="FormSubmit" action="{{ route('admins.users.update', $user->id) }}" method="POST" novalidate>
    @method('PUT')
    @csrf
    <div class="box p-0">
        <div class="box-body">
            @if ($user->getStatusText() != null)
                <div class="row">
                    <div class="col p-0 m-0">
                        <span class="badge badge-lg pull-right badge-danger">
                            {{-- <i class="fa fa-clock-o text-white"></i> --}}
                            {{ $user->getStatusText() }}
                        </span>
                    </div>
                </div>
            @endif
            @include('backend.admins.users.includes.edit')
        </div>
        <x-box-footer cancelRoute="{{ route('admins.users.index') }}"
            submitText="{{ __('website.save') }}" />
    </div>
</form>
