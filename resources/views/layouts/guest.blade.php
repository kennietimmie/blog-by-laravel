<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  @if (isset($title))
    <title>{{ config('app.name') }} - {{ $title }}</title>
  @else
    <title>{{ config('app.name') }}</title>
  @endif

  <!-- Fonts -->

  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
  <!-- Styles -->
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>
</head>

<body style="font-family: Open Sans, sans-serif">
  <section class="px-6 py-8">
    <nav class="md:flex md:justify-between md:items-center">
      <div>
        <a href="/">
          <x-application-logo class="block h-10 w-auto fill-current text-gray-600" />
        </a>
      </div>

      <div class="flex justify-between align-middle items-center mt-8 md:mt-0">
        <a href="#newsletter" class="bg-blue-500 ml-3 rounded-md text-xs font-semibold text-white uppercase py-2 px-4">
          Subscribe for Updates
        </a>
        @if (Route::has('login'))
          @auth
            <a href="{{ url('/dashboard') }}"
              class="mx-4 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">Dashboard</a>
          @else
            <a href="{{ route('login') }}"
              class="mx-4 inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">Log
              in</a>

            @if (Route::has('register'))
              <a href="{{ route('register') }}"
                class="mx-4 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">Register</a>
            @endif
          @endauth
        @endif
      </div>
    </nav>
    {{ $slot }}
    <x-panel class="bg-gray-100">
      <footer class="text-center py-16 px-10 mt-16" id="newsletter">
        <img src="/images/lary-newsletter-icon.svg" alt="" class="mx-auto -mb-6" style="width: 145px;">
        <h5 class="text-3xl">Stay in touch with the latest posts</h5>
        <p class="text-sm mt-3">Promise to keep the inbox clean. No bugs.</p>

        <div class="mt-10">
          <div class="relative inline-block mx-auto lg:bg-gray-200 rounded-full">

            <form method="POST" action="{{route('mailchimp.newsletter.store')}}" class="lg:flex text-sm">
              @csrf
              @method('put')
              <div class="lg:py-3 lg:px-5 flex items-center">
                <label for="email" class="hidden lg:inline-block">
                  <img src="{{asset('/images/mailbox-icon.svg')}}" alt="mailbox letter">
                </label>

                <input id="email" name="email" type="text" placeholder="Your email address"
                  class="lg:bg-transparent py-2 lg:py-0 pl-4 focus-within:outline-none">
              </div>

              <button type="submit"
                class="transition-colors duration-300 bg-blue-500 hover:bg-blue-600 mt-4 lg:mt-0 lg:ml-3 rounded-full text-xs font-semibold text-white uppercase py-3 px-8">
                Subscribe
              </button>
            </form>
          </div>
        </div>
        <div class="ml-4 text-center text-sm text-gray-500 sm:text-right sm:ml-0">
          Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
        </div>
        <x-alert  />
      </footer>
    </x-panel>
  </section>
</body>

</html>
