<section class="advantages">
    <a href="https://phalconphp.com" target="_blank">
        <div class="advantages-item">
            <div class="advantages-item__pictures">
                {{ filesystem.read('/public/images/icons/advantages-help-icon.svg') }}
            </div>
            <p class="advantages-item__header">{{ homeArray[34] }}</p>
            <p class="advantages-item__description">
                {{ homeArray[31] }}
            </p>
        </div>
    </a>
    <a href="{{ url ~ '/' ~ language ~ '/latest/api/index' }}" target="_blank">
        <div class="advantages-item">
            <div class="advantages-item__pictures">
                {{ filesystem.read('/public/images/icons/advantages-developer-icon.svg') }}
            </div>
            <p class="advantages-item__header">{{ homeArray[2] }}</p>
            <p class="advantages-item__description">
                {{ homeArray[1] }}
            </p>
        </div>
    </a>
    <a href="https://github.com/phalcon/incubator" target="_blank">
        <div class="advantages-item">
            <div class="advantages-item__pictures">
                {{ filesystem.read('/public/images/icons/advantages-community-icon.svg') }}
            </div>
            <p class="advantages-item__header">{{ homeArray[22] }}</p>
            <p class="advantages-item__description">
                {{ homeArray[25] }}
            </p>
        </div>
    </a>
</section>
