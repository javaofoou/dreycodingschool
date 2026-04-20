<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-white antialiased dark:bg-linear-to-b dark:from-neutral-950 dark:to-neutral-900">
        <div class="min-h-screen w-full bg-background">
            <div class="mx-auto w-full max-w-7xl px-4 py-6 sm:px-6 md:py-8 lg:px-8">
                <div class="mb-6 flex justify-center">
                    <a href="{{ route('home') }}" class="inline-flex flex-col items-center gap-2 font-medium" wire:navigate>
                        <span class="flex items-center justify-center rounded-md">
                            <img
                                src="https://res.cloudinary.com/dxp2nia6s/image/upload/v1776687647/1002774238-removebg-preview_thfrai.png"
                                alt="DreyCoding School Logo"
                                class="h-12 w-auto"
                            />
                        </span>
                        <span class="sr-only">{{ config('app.name', 'Laravel') }}</span>
                    </a>
                </div>

                <div class="w-full">
                    {{ $slot }}
                </div>
            </div>
        </div>

        {{-- Tawk.to Live Chat --}}
        <!--Start of Tawk.to Script-->
 {{-- Tawk.to Live Chat --}}
       <!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/69e654e3464c9e20e5f543e6/1jmlrn6mv';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
<!--End of Tawk.to Script-->

        @fluxScripts
    </body>
</html>