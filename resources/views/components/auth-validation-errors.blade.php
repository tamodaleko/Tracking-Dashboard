@props(['errors', 'type'])

@if ($errors->$type->any())
    <div class="alert bg-light-danger border border-danger border-dashed align-items-center d-flex flex-column flex-sm-row p-5 mb-10">
        <i class="ki-duotone ki-shield-cross fs-3x">
            <span class="path1"></span>
            <span class="path2"></span>
            <span class="path3"></span>
        </i>
        <div class="d-flex flex-column pe-0 pe-sm-10">
            <h5 class="mb-1">{{ __('Whoops! Something went wrong.') }}</h5>
            <span>
                <ul class="mt-2">
                    @foreach ($errors->$type->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </span>
        </div>
    </div>
@endif
