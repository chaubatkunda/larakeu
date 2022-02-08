@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'text-danger']) }}>
        {{ $status }}
    </div>
@endif
