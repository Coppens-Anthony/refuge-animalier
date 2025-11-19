<section class="flex flex-col gap-6 md:w-1/2 md:sticky md:top-32">
    <div class="flex flex-col gap-2">
        <h2 class="text-[1.125rem] md:text-[1.5rem] lg:text-[2rem] font-bold lg:font-medium">{!! __('client/contact.title') !!}</h2>
        <p>{!! __('client/contact.desc') !!}</p>
    </div>
    <div class="flex flex-col gap-2">
        <div class="flex gap-2 items-center">
            <img src="{{asset('assets/icons/email.svg')}}" alt="{!! __('global.email_icon') !!}">
            <a href="mailto:lespattesheureuse@gmail.com" class="link">lespattesheureuse@gmail.com</a>
        </div>
        <div class="flex gap-2 items-center">
            <img src="{{asset('assets/icons/telephone.svg')}}" alt="{!! __('global.telephone_icon') !!}">
            <a href="tel:0123.45.67.89" class="link">0123.45.67.89</a>
        </div>
    </div>
</section>
