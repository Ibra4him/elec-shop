<nav x-data="{ mobileMenuOpen: false }" class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="/" class="flex-shrink-0 flex items-center gap-2">
                    <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center shadow-lg shadow-blue-200">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <span class="text-2xl font-bold tracking-tight text-slate-900 font-display">Elec<span class="text-blue-600">Shop</span></span>
                </a>
            </div>

            <!-- Desktop Menu -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="/" class="text-sm font-semibold text-slate-700 hover:text-blue-600 transition-colors {{ request()->is('/') ? 'text-blue-600' : '' }}">Accueil</a>
                <a href="/shop" class="text-sm font-semibold text-slate-700 hover:text-blue-600 transition-colors {{ request()->is('shop*') ? 'text-blue-600' : '' }}">Boutique</a>
                <a href="/about" class="text-sm font-semibold text-slate-700 hover:text-blue-600 transition-colors {{ request()->is('about') ? 'text-blue-600' : '' }}">À propos</a>
                <a href="/contact" class="text-sm font-semibold text-slate-700 hover:text-blue-600 transition-colors {{ request()->is('contact') ? 'text-blue-600' : '' }}">Contact</a>
            </div>

            <!-- Right Icons -->
            <div class="flex items-center space-x-3">
                <!-- Search -->
                <button class="p-2 text-slate-500 hover:bg-slate-100 rounded-full transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>

                <!-- Cart -->
                @livewire('cart-count')

                <!-- Favorites -->
                @livewire('favorites-count')

                <!-- Auth -->
                @auth
                <div class="relative" x-data="{ userMenu: false }">
                    <button @click="userMenu = !userMenu" @click.away="userMenu = false"
                        class="flex items-center gap-2 px-3 py-2 rounded-xl hover:bg-slate-100 transition-colors group">
                        <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center text-white text-xs font-bold">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <span class="text-sm font-semibold text-slate-700 max-w-[100px] truncate">{{ Auth::user()->name }}</span>
                        <svg class="w-4 h-4 text-slate-400 transition-transform" :class="{ 'rotate-180': userMenu }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="userMenu" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0"
                        class="absolute right-0 mt-2 w-52 bg-white rounded-2xl shadow-xl border border-slate-100 overflow-hidden z-50">
                        <div class="px-4 py-3 border-b border-slate-100">
                            <p class="text-sm font-bold text-slate-900 truncate">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-slate-400 truncate">{{ Auth::user()->email }}</p>
                        </div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 text-sm text-red-600 hover:bg-red-50 transition-colors font-medium">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                Déconnexion
                            </button>
                        </form>
                    </div>
                </div>
                @else
                <a href="{{ route('login') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold rounded-xl transition-all hover:shadow-lg hover:shadow-blue-200 hover:-translate-y-0.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
                    Connexion
                </a>
                @endauth

                <!-- Mobile menu button -->
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden p-2 text-slate-500 hover:bg-slate-100 rounded-full transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path x-show="mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="mobileMenuOpen" @click.away="mobileMenuOpen = false" class="md:hidden bg-white border-b border-slate-200">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
            <a href="/" class="block px-3 py-4 text-base font-medium text-slate-700 hover:bg-slate-50 rounded-lg">Accueil</a>
            <a href="/shop" class="block px-3 py-4 text-base font-medium text-slate-700 hover:bg-slate-50 rounded-lg">Boutique</a>
            <a href="{{ route('favorites') }}" class="block px-3 py-4 text-base font-medium text-slate-700 hover:bg-slate-50 rounded-lg">Mes Favoris</a>
            <a href="/about" class="block px-3 py-4 text-base font-medium text-slate-700 hover:bg-slate-50 rounded-lg">À propos</a>
            <a href="/contact" class="block px-3 py-4 text-base font-medium text-slate-700 hover:bg-slate-50 rounded-lg">Contact</a>
            <div class="border-t border-slate-100 pt-2 mt-2">
                @auth
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-3 py-4 text-base font-medium text-red-600 hover:bg-red-50 rounded-lg text-left">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        Déconnexion ({{ Auth::user()->name }})
                    </button>
                </form>
                @else
                <a href="{{ route('login') }}" class="block px-3 py-4 text-base font-medium text-blue-600 hover:bg-blue-50 rounded-lg">
                    Connexion / Inscription
                </a>
                @endauth
            </div>
        </div>
    </div>
</nav>
