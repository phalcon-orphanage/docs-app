<section class="advantages">
    <a href="https://phalconphp.com" target="_blank">
        <div class="advantages-item">
            <div class="advantages-item__pictures">
                {{ filesystem.read('/public/images/icons/advantages-help-icon.svg') }}
            </div>
            <p class="advantages-item__header">{{ home['what_is_phalcon'] }}</p>
            <p class="advantages-item__description">
                {{ home['unlike_traditional_frameworks'] }}
            </p>
        </div>
    </a>
    <a href="{{ url ~ '/' ~ language ~ '/latest/api/index' }}" target="_blank">
        <div class="advantages-item">
            <div class="advantages-item__pictures">
                {{ filesystem.read('/public/images/icons/advantages-developer-icon.svg') }}
            </div>
            <p class="advantages-item__header">{{ home['api_documentation'] }}</p>
            <p class="advantages-item__description">
                {{ home['incredible_api'] }}
            </p>
        </div>
    </a>
    <a href="https://github.com/phalcon/incubator" target="_blank">
        <div class="advantages-item">
            <div class="advantages-item__pictures">
                {{ filesystem.read('/public/images/icons/advantages-community-icon.svg') }}
            </div>
            <p class="advantages-item__header">{{ home['meet_incubator'] }}</p>
            <p class="advantages-item__description">
                {{ home['incubator_amazing_features'] }}
            </p>
        </div>
    </a>
</section>
