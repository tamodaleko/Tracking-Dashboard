@props(['status', 'type'])

@if ($status)
    <div class="alert bg-light-{{ $type }} border border-{{ $type }} border-dashed p-5 mb-10">
        <div class="text-center">
            <h5 class="m-0">
                {{ $status }}
            </h5>
        </div>
    </div>
@endif
