<x-admin.layouts.login>
    <div>
        <div class="relative w-fit mt-4">
            <a href="{{route('client_home')}}" title="{!! __('client/header.to_home') !!}"
               class="absolute top-0 left-0 w-full h-full"></a>
            <x-client.global.logo/>
        </div>
        <section class="flex flex-col items-center md:flex-row gap-8 md:gap-15 lg:gap-30 mb-16 lg:mb-32 mt-8 md:mt-16">
            <div class="flex flex-col gap-2 md:w-2/3 lg:w-1/2">
                <h2 class="text-[1.125rem] md:text-[1.5rem] lg:text-[2rem] font-bold lg:font-medium">{!! __('login.title') !!}</h2>
                <p>{!! __('login.desc') !!}</p>
                <form action="{{ route('login.store') }}" method="post" class="mt-8 flex flex-col gap-8">
                    @csrf
                    <fieldset class="flex flex-col gap-6">
                        <x-client.form.input
                            name="email"
                            type="email"
                            required="{{true}}"
                            placeholder="john@doe.com"
                        >
                            Email
                        </x-client.form.input>
                        <x-client.form.input
                            name="password"
                            type="password"
                            placeholder=""
                            required="{{true}}"
                        >
                            Mot de passe
                        </x-client.form.input>

                        <div class="flex items-center gap-2">
                            <input
                                type="checkbox"
                                name="remember"
                                id="remember"
                            >
                            <label for="remember" class="cursor-pointer">
                                {!! __('login.remember_me') !!}
                            </label>
                        </div>
                    </fieldset>
                    <div class="mx-auto">
                        <x-client.global.button
                            title="{!! __('login.login_title') !!}"
                        >
                            {!! __('login.login') !!}
                        </x-client.global.button>
                    </div>
                </form>
            </div>
            <div class="md:w-1/2">
                <img src="{{asset('assets/images/login.jpg')}}"
                     srcset="{{asset('assets/images/300x300/login.jpg')}} 300w,
                     {{asset('assets/images/600x600/login.jpg')}} 600w,
                        {{asset('assets/images/900x900/login.jpg')}} 900w"
                     sizes="(max-width: 768px) 100vw, 50vw" alt="{!! __('login.image_alt') !!}"
                     class="w-full h-full rounded-4xl">
            </div>
        </section>
    </div>
</x-admin.layouts.login>
