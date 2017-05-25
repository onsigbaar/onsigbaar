<footer class="app-footer">
    <div class="site-footer-right">
        @if (rand(1,100) == 100)
            <i class="voyager-rum-1"></i> Gaboot Foundation
        @else
            Made with <i class="voyager-heart"></i> by <a href="https://github.com/gaboots/gaboot" target="_blank">Gaboot Foundation</a>
        @endif
        @php $version = Voyager::getVersion(); @endphp
        @if (!empty($version))
            - {{ $version }}
        @endif
    </div>
</footer>
