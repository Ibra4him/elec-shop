@extends('layouts.app')

@section('title', 'À Propos | ElecShop - Matériel Électrique à Cotonou')

@section('content')

{{-- Hero Section --}}
<section class="relative bg-slate-900 overflow-hidden min-h-[80vh] flex items-center">
    {{-- Animated background grid --}}
    <div class="absolute inset-0 opacity-10"
         style="background-image: linear-gradient(#3b82f6 1px, transparent 1px), linear-gradient(90deg, #3b82f6 1px, transparent 1px); background-size: 60px 60px;">
    </div>
    {{-- Glowing blobs --}}
    <div class="absolute top-1/4 -right-32 w-96 h-96 bg-blue-600/20 rounded-full blur-3xl"></div>
    <div class="absolute bottom-0 left-1/4 w-64 h-64 bg-indigo-500/20 rounded-full blur-3xl"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 grid lg:grid-cols-2 gap-16 items-center">
        <div>
            <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-blue-500/10 border border-blue-500/30 text-blue-400 text-xs font-bold uppercase tracking-widest mb-6">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                Depuis Cotonou, pour tout le Bénin
            </span>
            <h1 class="text-5xl lg:text-6xl font-extrabold text-white font-display leading-tight mb-6">
                Qui sommes-<span class="text-blue-400">nous</span> ?
            </h1>
            <p class="text-slate-300 text-lg leading-relaxed mb-8">
                ElecShop est votre spécialiste en matériel électrique résidentiel basé au cœur de Cotonou, à Marimilitaire. Nous mettons à votre disposition une sélection rigoureuse de produits alliant performance, sécurité et esthétique moderne.
            </p>
            <div class="flex flex-wrap gap-4">
                <a href="/shop" class="inline-flex items-center gap-2 px-6 py-3 bg-blue-600 hover:bg-blue-500 text-white font-bold rounded-xl transition-all hover:-translate-y-1 shadow-xl shadow-blue-900/50">
                    Voir notre boutique
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
                <a href="/contact" class="inline-flex items-center gap-2 px-6 py-3 border border-slate-600 hover:border-blue-500 text-slate-300 hover:text-white font-bold rounded-xl transition-all">
                    Nous contacter
                </a>
            </div>
        </div>
        {{-- Stats --}}
        <div class="grid grid-cols-2 gap-6">
            @foreach([
                ['500+', 'Références en stock', 'M13 10V3L4 14h7v7l9-11h-7z'],
                ['98%', 'Clients satisfaits', 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z'],
                ['5 ans', "D'expertise locale", 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
                ['24h', 'Livraison Cotonou', 'M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0zM15 11a3 3 0 11-6 0 3 3 0 016 0z'],
            ] as $stat)
            <div class="bg-white/5 border border-white/10 rounded-2xl p-6 backdrop-blur-sm hover:bg-white/10 transition-colors">
                <p class="text-4xl font-extrabold text-blue-400 font-display mb-2">{{ $stat[0] }}</p>
                <p class="text-slate-300 text-sm font-medium">{{ $stat[1] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- 3D Lamp Section --}}
<section id="lamp-section" class="bg-white py-32 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            {{-- Text --}}
            <div class="order-2 lg:order-1" data-animate="fade-up">
                <span class="text-blue-600 font-bold text-xs uppercase tracking-[0.2em] mb-4 block">Notre Spécialité</span>
                <h2 class="text-4xl font-extrabold text-slate-900 font-display mb-6 leading-tight">
                    L'éclairage, <br><span class="text-blue-600">une science et un art</span>
                </h2>
                <p class="text-slate-600 leading-relaxed mb-6 text-lg">
                    Nous croyons que l'éclairage est bien plus qu'une simple nécessité fonctionnelle. C'est un élément fondamental qui transforme un espace, crée une ambiance et reflète votre personnalité.
                </p>
                <p class="text-slate-500 leading-relaxed mb-8">
                    Nos luminaires — des spots LED haute performance aux suspensions design — sont sélectionnés auprès des meilleurs fabricants pour garantir une durabilité optimale et des économies d'énergie significatives.
                </p>
                <ul class="space-y-4">
                    @foreach([
                        'Lampes LED à haute efficacité énergétique',
                        'Suspensions et lustres design pour intérieur',
                        'Éclairage extérieur résistant aux intempéries',
                        'Spots encastrés et rails d\'éclairage modulables',
                    ] as $item)
                    <li class="flex items-center gap-3">
                        <div class="w-6 h-6 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <span class="text-slate-700 font-medium text-sm">{{ $item }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>
            {{-- Product Image --}}
            <div class="order-1 lg:order-2 flex items-center justify-center p-8" data-animate="fade-in">
                <div class="relative group">
                    {{-- Soft glow background --}}
                    <div class="absolute inset-0 bg-blue-500 rounded-full blur-[100px] opacity-20 scale-90 group-hover:opacity-40 transition-opacity duration-700"></div>
                    
                    {{-- The Image --}}
                    <img 
                        src="{{ asset('images/ampoule-akt.png') }}" 
                        alt="Ampoule AKT" 
                        class="relative z-10 w-full max-w-[450px] h-auto drop-shadow-[0_20px_50px_rgba(59,130,246,0.3)] transform transition-all duration-700 group-hover:scale-105 group-hover:-rotate-2"
                    >
                    
                    {{-- Decorative elements --}}
                    <div class="absolute -bottom-4 left-1/2 -translate-x-1/2 w-1/2 h-4 bg-slate-900/10 blur-xl rounded-[100%] opacity-50 group-hover:opacity-30 transition-opacity"></div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Products Categories --}}
<section class="bg-slate-50 py-24" data-animate="fade-up">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <span class="text-blue-600 font-bold text-xs uppercase tracking-[0.2em] mb-4 block">Ce que nous vendons</span>
            <h2 class="text-4xl font-extrabold text-slate-900 font-display mb-4">Notre Gamme de Produits</h2>
            <p class="text-slate-500 max-w-2xl mx-auto">Une sélection complète de matériel électrique pour la maison, le bureau et les projets de construction.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach([
                [
                    'icon' => 'M13 10V3L4 14h7v7l9-11h-7z',
                    'title' => 'Appareillage Électrique',
                    'desc' => 'Interrupteurs, prises de courant, disjoncteurs, tableaux de distribution et protections électriques des plus grandes marques.',
                    'tags' => ['Interrupteurs', 'Disjoncteurs', 'Prises', 'Tableaux']
                ],
                [
                    'icon' => 'M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z',
                    'title' => 'Luminaires & Éclairage',
                    'desc' => 'Ampoules LED basse consommation, luminaires design, spots encastrés, suspensions et solutions d\'éclairage pour tous les espaces.',
                    'tags' => ['LED', 'Suspensions', 'Spots', 'Ampoules']
                ],
                [
                    'icon' => 'M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z',
                    'title' => 'Énergie Solaire',
                    'desc' => 'Panneaux solaires, batteries, onduleurs et kits complets pour l\'autonomie énergétique de votre foyer ou entreprise.',
                    'tags' => ['Panneaux', 'Batteries', 'Onduleurs', 'Kits']
                ],
                [
                    'icon' => 'M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z',
                    'title' => 'Câbles & Fils Électriques',
                    'desc' => 'Câbles d\'installation aux normes, fils électriques rigides et souples, gaines, conduits et accessoires de câblage.',
                    'tags' => ['Câbles', 'Fils', 'Gaines', 'Conduits']
                ],
                [
                    'icon' => 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z',
                    'title' => 'Domotique & Smart Home',
                    'desc' => 'Thermostats connectés, interrupteurs intelligents, systèmes de gestion d\'énergie et automatisations pour la maison moderne.',
                    'tags' => ['Connecté', 'WiFi', 'Automatisme', 'Smart']
                ],
                [
                    'icon' => 'M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z',
                    'title' => 'Accessoires & Outils',
                    'desc' => 'Outils d\'électricien, testeurs, multimètres, chevilles, visseries et tout l\'outillage pour vos installations et réparations.',
                    'tags' => ['Outils', 'Testeurs', 'Visserie', 'Installation']
                ],
            ] as $cat)
            <div class="bg-white rounded-2xl p-8 border border-slate-100 hover:border-blue-200 hover:shadow-xl hover:shadow-blue-500/5 transition-all group">
                <div class="w-14 h-14 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-blue-600 group-hover:text-white transition-colors duration-300">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $cat['icon'] }}"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-3 font-display">{{ $cat['title'] }}</h3>
                <p class="text-slate-500 text-sm leading-relaxed mb-5">{{ $cat['desc'] }}</p>
                <div class="flex flex-wrap gap-2">
                    @foreach($cat['tags'] as $tag)
                    <span class="px-3 py-1 bg-slate-100 text-slate-600 text-xs font-semibold rounded-full">{{ $tag }}</span>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Our Story / Values --}}
<section class="bg-white py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <div data-animate="fade-right">
                <span class="text-blue-600 font-bold text-xs uppercase tracking-[0.2em] mb-4 block">Notre Histoire</span>
                <h2 class="text-4xl font-extrabold text-slate-900 font-display mb-6">Né à Cotonou, <br>pensé pour vous</h2>
                <div class="space-y-5 text-slate-600 leading-relaxed">
                    <p>
                        ElecShop est né d'un constat simple : au Bénin, l'accès à du matériel électrique de qualité, garanti et certifié, reste un défi pour de nombreux ménages et professionnels. Installés au quartier Marimilitaire à Cotonou, nous avons décidé de changer la donne.
                    </p>
                    <p>
                        Notre équipe de techniciens et de commerciaux passionnés travaille chaque jour pour vous proposer les meilleures références du marché, avec un accompagnement personnalisé pour chaque projet — qu'il s'agisse de la rénovation d'un appartement ou de l'équipement d'un chantier entier.
                    </p>
                    <p>
                        Nous collaborons avec les grandes marques internationales tout en soutenant les artisans locaux, afin de vous offrir le meilleur rapport qualité-prix disponible sur le marché béninois.
                    </p>
                </div>
            </div>
            <div class="grid grid-cols-1 gap-6" data-animate="fade-left">
                @foreach([
                    ['Qualité Garantie', 'Chaque produit est rigoureusement sélectionné et testé avant d\'intégrer notre catalogue. Nous refusons le matériel hors norme.', 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z'],
                    ['Conseil Expert', 'Nos techniciens sont là pour vous guider dans le choix de vos équipements et répondre à toutes vos questions techniques.', 'M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z'],
                    ['Proximité & Réactivité', 'Basés à Marimilitaire, nous assurons des livraisons rapides sur tout Cotonou et expédions dans tout le Bénin sous 24 à 48 heures.', 'M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0zM15 11a3 3 0 11-6 0 3 3 0 016 0z'],
                ] as [$title, $desc, $icon])
                <div class="flex gap-5 p-6 bg-slate-50 rounded-2xl hover:bg-blue-50 transition-colors group">
                    <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-xl flex items-center justify-center flex-shrink-0 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $icon }}"/>
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-slate-900 mb-2">{{ $title }}</h4>
                        <p class="text-slate-500 text-sm leading-relaxed">{{ $desc }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- CTA --}}
<section class="relative bg-slate-900 py-24 overflow-hidden">
    <div class="absolute inset-0 opacity-10" style="background-image: linear-gradient(#3b82f6 1px, transparent 1px), linear-gradient(90deg, #3b82f6 1px, transparent 1px); background-size: 60px 60px;"></div>
    <div class="relative z-10 max-w-3xl mx-auto text-center px-4">
        <h2 class="text-4xl font-extrabold text-white font-display mb-6">Prêt à équiper votre espace ?</h2>
        <p class="text-slate-400 text-lg mb-10">Parcourez notre catalogue en ligne ou visitez-nous directement à Marimilitaire, Cotonou. Notre équipe est à votre écoute du lundi au samedi, de 8h à 18h.</p>
        <div class="flex flex-wrap justify-center gap-4">
            <a href="/shop" class="inline-flex items-center gap-2 px-8 py-4 bg-blue-600 hover:bg-blue-500 text-white font-bold rounded-xl transition-all hover:-translate-y-1 shadow-2xl shadow-blue-900/50">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                Explorer la Boutique
            </a>
            <a href="/contact" class="inline-flex items-center gap-2 px-8 py-4 border-2 border-slate-600 hover:border-blue-500 text-white font-bold rounded-xl transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                Nous Contacter
            </a>
        </div>
    </div>
</section>

@push('scripts')

<script>
document.addEventListener('DOMContentLoaded', function () {

    // ─── Scroll animations ───────────────────────────────────────────────────
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animated');
            }
        });
    }, { threshold: 0.15 });

    document.querySelectorAll('[data-animate]').forEach(el => {
        el.classList.add('animate-prepare');
        observer.observe(el);
    });


});
</script>

<style>
[data-animate].animate-prepare {
    opacity: 0;
    transform: translateY(40px);
    transition: opacity 0.8s ease, transform 0.8s ease;
}
[data-animate="fade-right"].animate-prepare { transform: translateX(-40px); }
[data-animate="fade-left"].animate-prepare  { transform: translateX(40px); }
[data-animate="fade-in"].animate-prepare    { transform: none; }
[data-animate].animated {
    opacity: 1 !important;
    transform: none !important;
}
</style>
@endpush
@endsection
