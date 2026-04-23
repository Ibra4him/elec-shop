@extends('layouts.app')

@section('content')
    <!-- Hero Slider Section -->
    <div x-data="{
        currentSlide: 0,
        interval: null,
        slides: [
            {
                image: '/images/slider-1.png',
                badge: 'Équipement Électrique de Luxe',
                title: 'Illuminez votre intérieur<br>avec <span class=\'text-blue-500\'>élégance</span>.',
                text: 'Découvrez notre collection exclusive d\'appareillages et luminaires résidentiels. Performance technique et esthétique minimaliste pour votre maison.'
            },
            {
                image: '/images/slider-2.png',
                badge: 'Sécurité & Fiabilité',
                title: 'L\'excellence au service<br>de votre <span class=\'text-blue-500\'>sécurité</span>.',
                text: 'Des équipements électriques robustes, certifiés et conçus pour durer. Sécurisez vos installations avec le meilleur de la technologie.'
            },
            {
                image: '/images/slider-3.png',
                badge: 'Domotique & Design',
                title: 'Innovation & Design<br>pour chaque <span class=\'text-blue-500\'>espace</span>.',
                text: 'Alliez modernité et fonctionnalité. Des finitions premium qui s\'intègrent parfaitement à votre architecture.'
            }
        ],
        startAutoplay() {
            this.interval = setInterval(() => { this.next(); }, 5000);
        },
        stopAutoplay() {
            clearInterval(this.interval);
        },
        next() {
            this.currentSlide = (this.currentSlide === this.slides.length - 1) ? 0 : this.currentSlide + 1;
        },
        prev() {
            this.currentSlide = (this.currentSlide === 0) ? this.slides.length - 1 : this.currentSlide - 1;
        },
        goTo(index) {
            this.currentSlide = index;
            this.stopAutoplay();
            this.startAutoplay();
        }
    }" 
         x-init="startAutoplay()"
         class="relative w-full h-[80vh] min-h-[600px] overflow-hidden bg-slate-900 group">
        
        <!-- Slides -->
        <template x-for="(slide, index) in slides" :key="index">
            <div x-show="currentSlide === index"
                 x-transition:enter="transition-all duration-[1500ms] ease-out"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition-all duration-[1500ms] ease-in"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="absolute inset-0 w-full h-full">
                
                <!-- Background Image with Ken Burns effect -->
                <img :src="slide.image" 
                     class="absolute inset-0 w-full h-full object-cover transition-transform duration-[10000ms] ease-linear"
                     :class="{ 'scale-110': currentSlide === index, 'scale-100': currentSlide !== index }"
                     :alt="slide.title">
                     
                <!-- Gradient Overlay -->
                <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/50 to-transparent"></div>
                
                <!-- Content -->
                <div class="absolute inset-0 flex flex-col justify-center px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto z-10">
                    <div class="max-w-2xl" 
                         x-show="currentSlide === index"
                         x-transition:enter="transition-all duration-1000 delay-500 ease-out"
                         x-transition:enter-start="opacity-0 translate-y-8"
                         x-transition:enter-end="opacity-100 translate-y-0">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold leading-5 bg-white/20 text-white uppercase tracking-widest mb-6 backdrop-blur-sm border border-white/30" x-text="slide.badge"></span>
                        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-white font-display leading-[1.1] mb-6 drop-shadow-lg" x-html="slide.title"></h1>
                        <p class="text-lg sm:text-xl text-slate-200 mb-10 leading-relaxed drop-shadow-md" x-text="slide.text"></p>
                        <div class="flex gap-4">
                            <a href="/shop" class="px-8 py-4 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl transition-all hover:-translate-y-1 shadow-xl shadow-blue-500/30">
                                Découvrir la Boutique
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </template>

        <!-- Controls -->
        <button @click="prev(); stopAutoplay(); startAutoplay();" class="absolute left-4 top-1/2 -translate-y-1/2 w-12 h-12 rounded-full bg-white/10 hover:bg-white/20 backdrop-blur-md flex items-center justify-center text-white transition-all opacity-0 group-hover:opacity-100 z-20 border border-white/20">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
        </button>
        
        <button @click="next(); stopAutoplay(); startAutoplay();" class="absolute right-4 top-1/2 -translate-y-1/2 w-12 h-12 rounded-full bg-white/10 hover:bg-white/20 backdrop-blur-md flex items-center justify-center text-white transition-all opacity-0 group-hover:opacity-100 z-20 border border-white/20">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
        </button>

        <!-- Indicators -->
        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex gap-3 z-20">
            <template x-for="(slide, index) in slides" :key="index">
                <button @click="goTo(index)" 
                        class="h-1.5 rounded-full transition-all duration-500"
                        :class="currentSlide === index ? 'w-8 bg-blue-500' : 'w-2 bg-white/50 hover:bg-white/80'"></button>
            </template>
        </div>

    </div>

    <!-- Installation Électrique Section -->
    <div class="relative overflow-hidden" style="min-height: 520px;" x-data="{ shown: false }" x-init="
        const observer = new IntersectionObserver(entries => {
            if (entries[0].isIntersecting) {
                shown = true;
                observer.disconnect();
            }
        }, { threshold: 0.15 });
        observer.observe($el);
    ">
        <!-- Background: white top, blue gradient blur bottom-to-middle -->
        <div class="absolute inset-0 pointer-events-none" style="background: linear-gradient(to top, rgba(37, 99, 235, 0.18) 0%, rgba(59, 130, 246, 0.10) 35%, rgba(255,255,255,0.95) 60%, #fff 80%);"></div>
        <div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-[120%] h-[55%] pointer-events-none" style="background: radial-gradient(ellipse at 50% 100%, rgba(37,99,235,0.22) 0%, rgba(59,130,246,0.08) 50%, transparent 80%); filter: blur(60px);"></div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-28">
            <div class="flex flex-col lg:flex-row items-center gap-12 lg:gap-20">

                <!-- Image Left -->
                <div class="w-full lg:w-[45%] flex-shrink-0 transition-all duration-1000 ease-out"
                     :class="shown ? 'opacity-100 translate-x-0' : 'opacity-0 -translate-x-16'">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl shadow-blue-900/20 border border-white/60 bg-white">
                        <img src="/images/slider-1.png" 
                             alt="Installation électrique professionnelle" 
                             class="w-full h-auto object-cover" 
                             style="aspect-ratio: 4/3;">
                        <!-- Subtle blue overlay at bottom of image -->
                        <div class="absolute inset-x-0 bottom-0 h-1/4 bg-gradient-to-t from-blue-600/15 to-transparent pointer-events-none"></div>
                    </div>
                </div>

                <!-- Text Right -->
                <div class="w-full lg:w-[55%] transition-all duration-1000 delay-300 ease-out"
                     :class="shown ? 'opacity-100 translate-x-0' : 'opacity-0 translate-x-16'">
                    
                    <!-- Title -->
                    <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold font-display leading-tight mb-6" style="color: #1e3a5f;">
                        UNE INSTALLATION ÉLECTRIQUE FIABLE
                        <br>
                        <span class="text-blue-600">COMMENCE PAR LES BONS ÉQUIPEMENTS !</span>
                    </h2>

                    <!-- Decorative separator -->
                    <div class="flex items-center gap-2 mb-6">
                        <div class="w-10 h-1 rounded-full bg-blue-600"></div>
                        <div class="w-2 h-2 rounded-full bg-blue-400"></div>
                    </div>

                    <!-- Subtitle -->
                    <p class="text-slate-600 text-base sm:text-lg leading-relaxed mb-8">
                        Optimisez la sécurité et la performance de vos installations
                        avec des produits robustes, certifiés et conçus pour durer.
                    </p>

                    <!-- Bullet Points -->
                    <ul class="space-y-4 mb-10">
                        <li class="flex items-start gap-4 group">
                            <span class="flex-shrink-0 w-8 h-8 rounded-full bg-blue-600/10 flex items-center justify-center mt-0.5 group-hover:bg-blue-600 transition-colors duration-300">
                                <svg class="w-4 h-4 text-blue-600 group-hover:text-white transition-colors duration-300" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                            </span>
                            <span class="text-slate-700 text-sm sm:text-base leading-relaxed">
                                <strong class="text-slate-900">Protection électrique avancée</strong> (disjoncteurs haute précision)
                            </span>
                        </li>
                        <li class="flex items-start gap-4 group">
                            <span class="flex-shrink-0 w-8 h-8 rounded-full bg-blue-600/10 flex items-center justify-center mt-0.5 group-hover:bg-blue-600 transition-colors duration-300">
                                <svg class="w-4 h-4 text-blue-600 group-hover:text-white transition-colors duration-300" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                            </span>
                            <span class="text-slate-700 text-sm sm:text-base leading-relaxed">
                                <strong class="text-slate-900">Appareillage élégant</strong> (interrupteurs & prises design)
                            </span>
                        </li>
                        <li class="flex items-start gap-4 group">
                            <span class="flex-shrink-0 w-8 h-8 rounded-full bg-blue-600/10 flex items-center justify-center mt-0.5 group-hover:bg-blue-600 transition-colors duration-300">
                                <svg class="w-4 h-4 text-blue-600 group-hover:text-white transition-colors duration-300" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                            </span>
                            <span class="text-slate-700 text-sm sm:text-base leading-relaxed">
                                <strong class="text-slate-900">Matériel durable</strong> pour usage résidentiel et professionnel
                            </span>
                        </li>
                        <li class="flex items-start gap-4 group">
                            <span class="flex-shrink-0 w-8 h-8 rounded-full bg-blue-600/10 flex items-center justify-center mt-0.5 group-hover:bg-blue-600 transition-colors duration-300">
                                <svg class="w-4 h-4 text-blue-600 group-hover:text-white transition-colors duration-300" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                            </span>
                            <span class="text-slate-700 text-sm sm:text-base leading-relaxed">
                                <strong class="text-slate-900">Solutions adaptées</strong> à tous les niveaux d'installation
                            </span>
                        </li>
                    </ul>

                    <!-- CTA Button -->
                    <a href="/shop" class="inline-flex items-center gap-3 px-8 py-4 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl transition-all hover:-translate-y-1 shadow-xl shadow-blue-500/25 group">
                        Découvrir nos équipements
                        <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Categories Carousel -->
    <div class="bg-slate-50 py-24" x-data="{
        scrollNext() {
            $refs.slider.scrollBy({ left: 300, behavior: 'smooth' });
        },
        scrollPrev() {
            $refs.slider.scrollBy({ left: -300, behavior: 'smooth' });
        }
    }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-end mb-12">
                <div>
                    <h2 class="text-3xl font-extrabold text-slate-900 font-display">Nos catégories</h2>
                </div>
                <div class="flex items-center gap-2">
                    <button @click="scrollPrev" class="w-10 h-10 rounded-full border border-slate-200 flex items-center justify-center text-slate-400 hover:text-slate-900 hover:border-slate-300 transition-all bg-white shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 19l-7-7 7-7" /></svg>
                    </button>
                    <button @click="scrollNext" class="w-10 h-10 rounded-full border border-slate-200 flex items-center justify-center text-slate-400 hover:text-slate-900 hover:border-slate-300 transition-all bg-white shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5l7 7-7 7" /></svg>
                    </button>
                </div>
            </div>

            <div class="flex overflow-x-auto snap-x snap-mandatory gap-6 pb-8 -mx-4 px-4 sm:mx-0 sm:px-0 scrollbar-hide items-stretch" x-ref="slider" style="scrollbar-width: none; -ms-overflow-style: none;">
                @foreach($rootCategories as $category)
                <a href="/shop?categories[0]={{ $category->id }}" class="flex-none w-[280px] snap-start group relative flex flex-col h-full">
                    <div class="w-full aspect-square bg-white rounded-[2rem] mb-5 flex items-center justify-center overflow-hidden transition-all group-hover:shadow-lg group-hover:shadow-slate-200/50 border border-slate-100 p-8">
                        @if($category->image)
                            <img src="{{ Storage::url($category->image) }}" alt="{{ $category->name }}" class="w-full h-full object-contain mix-blend-multiply group-hover:scale-105 transition-transform duration-500">
                        @else
                            <svg class="w-16 h-16 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        @endif
                    </div>
                    <div class="flex-1 flex flex-col">
                        <h3 class="text-lg font-bold text-slate-900 mb-1 leading-tight group-hover:text-blue-600 transition-colors line-clamp-2">{{ $category->name }}</h3>
                        <p class="text-sm text-slate-500 mt-auto">{{ $category->products_count }} produits</p>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        <style>
            .scrollbar-hide::-webkit-scrollbar {
                display: none;
            }
        </style>
    </div>

    <!-- Brands Carousel -->
    @if($brands->count() > 0)
    <div class="bg-slate-50 py-12" x-data="{
        scrollNext() {
            $refs.brandSlider.scrollBy({ left: 300, behavior: 'smooth' });
        },
        scrollPrev() {
            $refs.brandSlider.scrollBy({ left: -300, behavior: 'smooth' });
        }
    }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 border-t border-slate-200 pt-16">
            <div class="flex justify-between items-end mb-8">
                <div>
                    <h2 class="text-3xl font-extrabold text-slate-900 font-display">Nos Marques</h2>
                </div>
                <div class="flex items-center gap-2">
                    <button @click="scrollPrev" class="w-10 h-10 rounded-full border border-slate-200 flex items-center justify-center text-slate-400 hover:text-slate-900 hover:border-slate-300 transition-all bg-white shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 19l-7-7 7-7" /></svg>
                    </button>
                    <button @click="scrollNext" class="w-10 h-10 rounded-full border border-slate-200 flex items-center justify-center text-slate-400 hover:text-slate-900 hover:border-slate-300 transition-all bg-white shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5l7 7-7 7" /></svg>
                    </button>
                </div>
            </div>

            <div class="flex overflow-x-auto snap-x snap-mandatory gap-6 pb-8 -mx-4 px-4 sm:mx-0 sm:px-0 scrollbar-hide" x-ref="brandSlider" style="scrollbar-width: none; -ms-overflow-style: none;">
                @foreach($brands as $brand)
                <a href="/shop?brands[0]={{ $brand->id }}" class="flex-none w-[200px] snap-start group relative flex flex-col items-center">
                    <div class="w-full aspect-[4/3] bg-white rounded-2xl mb-4 flex items-center justify-center overflow-hidden transition-all group-hover:shadow-md border border-slate-100 p-6">
                        @if($brand->logo_url)
                            <img src="{{ Storage::url($brand->logo_url) }}" alt="{{ $brand->name }}" class="w-full h-full object-contain mix-blend-multiply group-hover:scale-105 transition-transform duration-500 filter grayscale group-hover:grayscale-0">
                        @else
                            <span class="font-bold text-slate-400">{{ $brand->name }}</span>
                        @endif
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    <!-- Pourquoi choisir ElecShop -->
    <div class="bg-white py-24 overflow-hidden relative" x-data="{ shown: false }" x-init="
        const observer = new IntersectionObserver(entries => {
            if (entries[0].isIntersecting) {
                shown = true;
                observer.disconnect();
            }
        }, { threshold: 0.2 });
        observer.observe($el);
    ">
        <!-- Background decorative elements -->
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none opacity-40">
            <div class="absolute -top-[20%] -left-[10%] w-[50%] h-[50%] rounded-full bg-blue-50 blur-3xl"></div>
            <div class="absolute -bottom-[20%] -right-[10%] w-[50%] h-[50%] rounded-full bg-blue-50 blur-3xl"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 font-display uppercase tracking-wider mb-4">Pourquoi choisir ElecShop ?</h2>
                <div class="flex items-center justify-center gap-2 mb-8">
                    <div class="w-2 h-2 rounded-full bg-blue-600"></div>
                    <div class="w-2 h-2 rounded-full bg-blue-600"></div>
                    <div class="w-2 h-2 rounded-full bg-blue-600"></div>
                    <div class="w-16 h-1 rounded-full bg-blue-600"></div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Bloc 1 -->
                <div class="bg-blue-600 border border-blue-400/50 rounded-xl p-8 text-center text-white shadow-2xl transition-all duration-1000 ease-out transform"
                     :class="shown ? 'translate-x-0 opacity-100' : '-translate-x-[150%] opacity-0'">
                    <div class="flex justify-center mb-6">
                        <div class="p-4 bg-white/10 rounded-full backdrop-blur-sm border border-white/20">
                            <svg class="w-10 h-10 text-white" viewBox="0 0 24 24" fill="currentColor">
                                <path fill-rule="evenodd" d="M12.516 2.17a.75.75 0 00-1.032 0 11.209 11.209 0 01-7.877 3.08.75.75 0 00-.722.515A12.74 12.74 0 002.25 9.75c0 5.942 4.064 10.933 9.563 12.348a.749.749 0 00.374 0c5.499-1.415 9.563-6.406 9.563-12.348 0-1.39-.223-2.73-.635-3.985a.75.75 0 00-.722-.516l-.143.001c-2.996 0-5.717-1.17-7.734-3.08zm3.094 8.016a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold mb-4 font-display uppercase tracking-widest text-white">Sécurité Maximale</h3>
                    <p class="text-blue-100/90 leading-relaxed text-sm sm:text-base">
                        Ne jouez pas avec l'électricité. Nos disjoncteurs et fusibles sont certifiés CE et testés rigoureusement pour protéger votre famille et vos biens contre les courts-circuits et les surtensions.
                    </p>
                </div>

                <!-- Bloc 2 -->
                <div class="bg-blue-600 border border-blue-400/50 rounded-xl p-8 text-center text-white shadow-2xl transition-all duration-1000 delay-300 ease-out transform"
                     :class="shown ? 'translate-y-0 opacity-100' : '-translate-y-[150%] opacity-0'">
                    <div class="flex justify-center mb-6">
                        <div class="p-4 bg-white/10 rounded-full backdrop-blur-sm border border-white/20">
                            <svg class="w-10 h-10 text-white" viewBox="0 0 24 24" fill="currentColor">
                                <path fill-rule="evenodd" d="M14.615 1.595a.75.75 0 01.359.852L12.982 9.75h7.268a.75.75 0 01.548 1.262l-10.5 11.25a.75.75 0 01-1.272-.71l1.992-7.302H3.75a.75.75 0 01-.548-1.262l10.5-11.25a.75.75 0 01.913-.143z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold mb-4 font-display uppercase tracking-widest text-white">Économies Durables</h3>
                    <p class="text-blue-100/90 leading-relaxed text-sm sm:text-base">
                        Nos ampoules LED et luminaires modernes consomment 90% moins d'énergie que les modèles classiques, pour une facture d'électricité allégée chaque mois.
                    </p>
                </div>

                <!-- Bloc 3 -->
                <div class="bg-blue-600 border border-blue-400/50 rounded-xl p-8 text-center text-white shadow-2xl transition-all duration-1000 delay-500 ease-out transform"
                     :class="shown ? 'translate-x-0 opacity-100' : 'translate-x-[150%] opacity-0'">
                    <div class="flex justify-center mb-6">
                        <div class="p-4 bg-white/10 rounded-full backdrop-blur-sm border border-white/20">
                            <svg class="w-10 h-10 text-white" viewBox="0 0 24 24" fill="currentColor">
                                <path fill-rule="evenodd" d="M11.078 2.25c-.917 0-1.699.663-1.85 1.567L9.05 4.889c-.02.12-.115.26-.297.348a7.493 7.493 0 00-.986.57c-.166.115-.334.126-.45.083L6.3 5.508a1.875 1.875 0 00-2.282.819l-.922 1.597a1.875 1.875 0 00.432 2.385l1.093.93c.12.103.181.246.181.385v.651c0 .139-.061.282-.181.386l-1.093.93a1.875 1.875 0 00-.432 2.385l.922 1.597a1.875 1.875 0 002.282.818l1.019-.382c.115-.043.283-.031.45.082.312.214.641.405.985.57.182.088.277.228.297.35l.178 1.071c.151.904.933 1.567 1.85 1.567h1.844c.916 0 1.699-.663 1.85-1.567l.178-1.072c.02-.12.114-.26.297-.349.344-.165.673-.356.985-.57.167-.114.335-.125.45-.082l1.02.382a1.875 1.875 0 002.28-.819l.923-1.597a1.875 1.875 0 00-.432-2.385l-1.093-.93c-.12-.104-.181-.247-.181-.386v-.651c0-.139.061-.282.181-.386l1.093-.93a1.875 1.875 0 00.432-2.385l-.922-1.597a1.875 1.875 0 00-2.282-.818l-1.02.382c-.114.043-.282.031-.449-.083a7.49 7.49 0 00-.985-.57c-.183-.087-.277-.227-.297-.348l-.179-1.072a1.875 1.875 0 00-1.85-1.567h-1.843zM12 15.75a3.75 3.75 0 100-7.5 3.75 3.75 0 000 7.5z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold mb-4 font-display uppercase tracking-widest text-white">Installation Facile</h3>
                    <p class="text-blue-100/90 leading-relaxed text-sm sm:text-base">
                        Du câblage aux tableaux électriques, nous fournissons du matériel aux normes, compatible avec toutes les installations modernes au Bénin.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Featured Products -->
    <div id="featured" class="bg-white py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <span class="text-blue-600 font-bold text-xs uppercase tracking-[0.2em] mb-4 block">Sélection du mois</span>
                <h2 class="text-4xl font-extrabold text-slate-900 font-display mb-4">Produits Mis en Avant</h2>
                <div class="w-16 h-1 bg-blue-600 mx-auto rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-x-6 gap-y-10">
                @foreach($featuredProducts as $product)
                    <x-product-card :product="$product" />
                @endforeach
            </div>

            <div class="mt-20 text-center">
                <a href="/shop" class="inline-flex items-center px-10 py-4 border-2 border-blue-600 text-blue-600 font-bold rounded-xl hover:bg-blue-600 hover:text-white transition-all">
                    Voir Tout le Catalogue
                </a>
            </div>
        </div>
    </div>

    <!-- Trust Section -->
    <div class="bg-slate-900 py-20 overflow-hidden relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <div class="flex flex-col items-center">
                    <div class="w-12 h-12 bg-white/10 rounded-full flex items-center justify-center text-white mb-6">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    </div>
                    <h3 class="text-white font-bold mb-2">Qualité Certifiée</h3>
                    <p class="text-slate-400 text-sm">Normes ISO & NF garanties pour tous nos produits.</p>
                </div>
                <div class="flex flex-col items-center">
                    <div class="w-12 h-12 bg-white/10 rounded-full flex items-center justify-center text-white mb-6">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <h3 class="text-white font-bold mb-2">Livraison Rapide</h3>
                    <p class="text-slate-400 text-sm">Expédition sous 24h partout au Bénin.</p>
                </div>
                <div class="flex flex-col items-center">
                    <div class="w-12 h-12 bg-white/10 rounded-full flex items-center justify-center text-white mb-6">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                    </div>
                    <h3 class="text-white font-bold mb-2">Support WhatsApp</h3>
                    <p class="text-slate-400 text-sm">Conseils techniques et commandes simplifiées.</p>
                </div>
            </div>
        </div>
        <!-- Decorative lines -->
        <div class="absolute top-0 right-0 w-full h-full opacity-5 pointer-events-none">
            <svg class="w-full h-full" viewBox="0 0 1000 1000" preserveAspectRatio="none">
                <path d="M0,1000 C300,800 400,200 1000,0" stroke="white" fill="none" />
                <path d="M0,800 C400,600 500,100 1000,-100" stroke="white" fill="none" />
            </svg>
        </div>
    </div>
@endsection
