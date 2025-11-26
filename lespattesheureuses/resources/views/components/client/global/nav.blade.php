<header class="flex items-center justify-between px-8 md:px-12 lg:px-16 border-b py-4 mb-16 z-50 bg-white sticky top-0">
    <h1 class="sr-only">
        {!! __('global.happies_paws') !!}
    </h1>
    <div class="relative z-50">
        <a href="{{route('client_home')}}" class="absolute top-0 left-0 w-full h-full"
           title="{!! __('client/header.home_title') !!}"></a>
        <x-client.global.logo/>
    </div>
    <input type="checkbox" id="menu-toggle" class="peer hidden" />
    <label for="menu-toggle" class="flex flex-col gap-1 justify-between cursor-pointer z-50 md:invisible">
        <span class="span_burger_menu"></span>
        <span class="span_burger_menu"></span>
        <span class="span_burger_menu"></span>
    </label>

    <nav aria-labelledby="navigation-haut-de-page"
        class="fixed inset-0 bg-white text-center transform translate-x-full
         peer-checked:translate-x-0 transition-transform duration-700 ease-in-out z-40
         md:static md:translate-x-0 md:flex md:justify-between
         ">
        <h2 class="sr-only" id="navigation-haut-de-page">{!! __('client/header.main_nav') !!}</h2>
        <ul class="flex flex-col gap-8 origin-center absolute top-[25%] left-1/2 -translate-x-1/2
            md:flex-row md:static md:translate-x-0 md:top-auto md:w-auto md:justify-between md:items-center">
            <li>
                <a href="{{route('client_home')}}"
                   title="{!! __('client/header.to_home') !!}" class="{{ request()->routeIs('client_home') ? 'active' : 'link' }}">{!! __('client/header.home') !!}</a>
            </li>
            <li>
                <a href="{!!route('client_animals')!!}" title="{!! __('client/home.to_animals') !!}" class="{{ request()->routeIs('client_animals') ? 'active' : 'link' }}">{!! __('client/header.our_animals') !!}</a>
            </li>
            <li>
                <a href="{!!route('client_team')!!}" title="{!! __('client/home.to_team') !!}" class="{{ request()->routeIs('client_team') ? 'active' : 'link' }}">{!! __('client/header.our_team') !!}</a>
            </li>
            <li>
                <x-client.global.cta route="{!!route('client_contact')!!}" title="{!! __('client/header.to_contact') !!}">{!! __('client/header.contact') !!}</x-client.global.cta>
            </li>
        </ul>
    </nav>
</header>
