<footer class="bg-primary px-8 md:px-12 lg:px-16 py-8 mt-16">
    <section class="flex gap-6 flex-col md:flex-row md:justify-between mb-16">
        <h2 class="sr-only">{!! __('client/footer.footer') !!}</h2>
        <div class="w-fit">
            <div class="relative">
                <a href="/" class="absolute h-full w-full"></a>
                <x-client.global.logo/>
            </div>
            <ul class="flex justify-center gap-2">
                <li class="relative">
                    <a href="" class="absolute top-0 left-0 h-full w-full "></a>
                    <img src="{{asset('assets/icons/facebook.svg')}}" alt="{!! __('client/footer.facebook') !!}">
                </li>
                <li class="relative">
                    <a href="" class="absolute top-0 left-0 h-full w-full "></a>
                    <img src="{{asset('assets/icons/instagram.svg')}}" alt="{!! __('client/footer.instagram') !!}">
                </li>
            </ul>
        </div>
        <section>
            <h3 class="text-xl mb-4">{!! __('client/footer.hourlies') !!}</h3>
            <ul class="font-nunito flex flex-col gap-2">
                <li>
                    {!! __('client/footer.monday_to_friday') !!}
                </li>
                <li>
                    {!! __('client/footer.saturday') !!}
                </li>
                <li>
                    {!! __('client/footer.sunday') !!}
                </li>
            </ul>
        </section>
        <nav aria-labelledby="navigation-bas-de-page">
            <h3 id="navigation-bas-de-page" class="text-xl mb-4">Navigation <span class="sr-only">{!! __('client/footer.secondary') !!}</span></h3>
            <ul class="font-nunito flex flex-col gap-2">
                <li>
                    <a href="{{route('client_home')}}"
                       title="{!! __('client/header.to_home') !!}"
                       class="link_footer">{!! __('client/header.home') !!}</a>
                </li>
                <li>
                    <a href="{!!route('client_animals')!!}" title="{!! __('client/home.to_animals') !!}"
                       class="link_footer">{!! __('client/header.our_animals') !!}</a>
                </li>
                <li>
                    <a href="{!!route('client_team')!!}" title="{!! __('client/home.to_team') !!}"
                       class="link_footer">{!! __('client/header.our_team') !!}</a>
                </li>
                <li>
                    <a href="{!!route('client_contact')!!}" title="{!! __('client/header.to_contact') !!}"
                       class="link_footer">{!! __('client/header.contact') !!}</a>
                </li>
            </ul>
        </nav>
        <section>
            <h3 class="text-xl mb-4">{!! __('client/footer.coords') !!}</h3>
            <ul class="font-nunito flex flex-col gap-2">
                <li>
                    {!! __('client/footer.address') !!}
                </li>
                <li>
                    {!! __('client/footer.city') !!}
                </li>
                <li>
                    <a href="mailto:lespattesheureuse@gmail.com" class="link_footer">lespattesheureuse@gmail.com</a>
                </li>
                <li>
                    <a href="tel:0123.45.67.89" class="link_footer">0123.45.67.89</a>
                </li>
            </ul>
        </section>
    </section>
    <section class="flex flex-col gap-2 md:flex-row justify-between font-poppins">
        <h2 class="sr-only">{!! __('client/footer.politics') !!}</h2>
        <p>{!! __('client/footer.rights') !!}</p>
        <p>
            {!! __('client/footer.made_by') !!}
            <a href="https://portfolio.anthony-coppens.be" class="link_footer"
               title="{!! __('client/footer.to_portfolio') !!}">Anthony Coppens</a>
            -
            <a href="" class="link_footer"
               title="{!! __('client/footer.to_politics') !!}">{!! __('client/footer.politics') !!}</a>
        </p>
    </section>
</footer>
