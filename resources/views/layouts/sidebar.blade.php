<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show {{ request()->routeIs('app.pos.*') ? 'c-sidebar-minimized' : '' }}"
    id="sidebar">
    <div class="c-sidebar-brand d-md-down-none">
        <a href="{{ route('home') }}">
            @php
                $logoUrl = settings()->getFirstMediaUrl('settings');
            @endphp

            @if ($logoUrl)
                <img class="c-sidebar-brand-full" src="{{ $logoUrl }}" alt="Site Logo" width="110">
                <img class="c-sidebar-brand-minimized" src="{{ $logoUrl }}" alt="Site Logo" width="40">
            @else
                <div class="c-sidebar-brand-full d-flex align-items-center justify-content-center"
                    style="width: 110px; height: 40px; background: #f8f9fa; border-radius: 4px;">
                    <span style="font-size: 14px; font-weight: bold; color: #495057;">{{ config('app.name') }}</span>
                </div>
                <div class="c-sidebar-brand-minimized d-flex align-items-center justify-content-center"
                    style="width: 40px; height: 40px; background: #f8f9fa; border-radius: 4px;">
                    <span
                        style="font-size: 12px; font-weight: bold; color: #495057;">{{ substr(config('app.name'), 0, 2) }}</span>
                </div>
            @endif
        </a>
    </div>
    <ul class="c-sidebar-nav">
        @include('layouts.menu')
        <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
        </div>
        <div class="ps__rail-y" style="top: 0px; height: 692px; right: 0px;">
            <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 369px;"></div>
        </div>
    </ul>
    <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent"
        data-class="c-sidebar-minimized"></button>
</div>
