<div @class(['card', $class ?? ''])>
    <div class="card-body">
        <h5 class="card-title">{{ $title ?? '' }}</h5>
        <h6 class="card-subtitle text-muted mb-2">{{ $subtitle ?? '' }}</h6>
        <p class="card-text">
            {{ $slot ?? '' }}
        </p>
    </div>
</div>
