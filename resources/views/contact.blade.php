@extends('layouts.app')

@section('title', 'Contactez-Nous | ElecShop - Cotonou, Marimilitaire')

@section('content')

{{-- Hero --}}
<section class="relative bg-slate-900 py-28 overflow-hidden">
    <div class="absolute inset-0 opacity-10" style="background-image: linear-gradient(#3b82f6 1px, transparent 1px), linear-gradient(90deg, #3b82f6 1px, transparent 1px); background-size: 60px 60px;"></div>
    <div class="absolute top-0 right-0 w-96 h-96 bg-blue-600/20 rounded-full blur-3xl"></div>
    <div class="relative z-10 max-w-4xl mx-auto text-center px-4">
        <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-blue-500/10 border border-blue-500/30 text-blue-400 text-xs font-bold uppercase tracking-widest mb-6">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0zM15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            Marimilitaire, Cotonou — Bénin
        </span>
        <h1 class="text-5xl lg:text-6xl font-extrabold text-white font-display mb-6">
            Parlons de votre <span class="text-blue-400">projet</span>
        </h1>
        <p class="text-slate-400 text-lg max-w-2xl mx-auto">
            Une question sur un produit ? Un devis pour votre chantier ? Notre équipe est disponible et répond rapidement. Choisissez le canal qui vous convient le mieux.
        </p>
    </div>
</section>

{{-- Contact Cards Row --}}
<section class="bg-white -mt-1 pt-12 pb-0">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 -mt-20 relative z-20">
            {{-- WhatsApp --}}
            <a href="https://wa.me/22997587762?text=Bonjour%20ElecShop%2C%20j'ai%20une%20question%20%3A%20"
               target="_blank"
               class="group bg-white border border-slate-100 rounded-2xl p-8 shadow-xl hover:shadow-2xl hover:border-green-200 transition-all flex flex-col items-center text-center hover:-translate-y-2">
                <div class="w-16 h-16 bg-green-50 text-green-600 rounded-2xl flex items-center justify-center mb-5 group-hover:bg-green-600 group-hover:text-white transition-colors">
                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2">WhatsApp</h3>
                <p class="text-slate-500 text-sm mb-3">Réponse instantanée. Commandes, conseils et devis directement sur WhatsApp.</p>
                <span class="font-bold text-green-600 text-sm">+229 97 58 77 62</span>
            </a>

            {{-- Téléphone --}}
            <a href="tel:+22997587762"
               class="group bg-white border border-slate-100 rounded-2xl p-8 shadow-xl hover:shadow-2xl hover:border-blue-200 transition-all flex flex-col items-center text-center hover:-translate-y-2">
                <div class="w-16 h-16 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mb-5 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2">Téléphone</h3>
                <p class="text-slate-500 text-sm mb-3">Appelez-nous directement. Disponibles du lundi au samedi de 8h à 18h.</p>
                <span class="font-bold text-blue-600 text-sm">+229 97 58 77 62</span>
            </a>

            {{-- Localisation --}}
            <div class="group bg-white border border-slate-100 rounded-2xl p-8 shadow-xl hover:shadow-2xl hover:border-orange-200 transition-all flex flex-col items-center text-center hover:-translate-y-2">
                <div class="w-16 h-16 bg-orange-50 text-orange-600 rounded-2xl flex items-center justify-center mb-5 group-hover:bg-orange-500 group-hover:text-white transition-colors">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0zM15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2">Notre Boutique</h3>
                <p class="text-slate-500 text-sm mb-3">Venez nous rendre visite. Nous vous accueillons avec plaisir dans notre showroom.</p>
                <span class="font-bold text-orange-600 text-sm">Marimilitaire, Cotonou</span>
            </div>
        </div>
    </div>
</section>

{{-- Main Content: Form + Info --}}
<section class="bg-white py-24">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-5 gap-12">

            {{-- Contact Form --}}
            <div class="lg:col-span-3">
                <div class="bg-slate-50 rounded-3xl p-8 lg:p-10 border border-slate-100">
                    <div class="mb-8">
                        <h2 class="text-3xl font-extrabold text-slate-900 font-display mb-2">Envoyez-nous un message</h2>
                        <p class="text-slate-500">Remplissez ce formulaire et nous vous répondrons sous 2 heures ouvrées.</p>
                    </div>

                    <form id="contactForm" class="space-y-6" action="#" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label for="contact_name" class="block text-sm font-semibold text-slate-700 mb-2">Nom complet <span class="text-red-500">*</span></label>
                                <input type="text" id="contact_name" name="name" required
                                    class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                                    placeholder="Ex : Jean Dupont">
                            </div>
                            <div>
                                <label for="contact_phone" class="block text-sm font-semibold text-slate-700 mb-2">Téléphone</label>
                                <input type="tel" id="contact_phone" name="phone"
                                    class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                                    placeholder="+229 XX XX XX XX">
                            </div>
                        </div>

                        <div>
                            <label for="contact_email" class="block text-sm font-semibold text-slate-700 mb-2">Adresse e-mail</label>
                            <input type="email" id="contact_email" name="email"
                                class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                                placeholder="votre@email.com">
                        </div>

                        <div>
                            <label for="contact_subject" class="block text-sm font-semibold text-slate-700 mb-2">Objet de votre demande <span class="text-red-500">*</span></label>
                            <select id="contact_subject" name="subject" required
                                class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl text-slate-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                                <option value="" disabled selected>Sélectionnez un objet...</option>
                                <option value="devis">Demande de devis</option>
                                <option value="conseil">Conseil technique</option>
                                <option value="commande">Information sur une commande</option>
                                <option value="disponibilite">Disponibilité d'un produit</option>
                                <option value="partenariat">Partenariat / Grossiste</option>
                                <option value="autre">Autre</option>
                            </select>
                        </div>

                        <div>
                            <label for="contact_message" class="block text-sm font-semibold text-slate-700 mb-2">Votre message <span class="text-red-500">*</span></label>
                            <textarea id="contact_message" name="message" required rows="5"
                                class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all resize-none"
                                placeholder="Décrivez votre besoin, le type de produit recherché, la quantité, ou posez votre question technique..."></textarea>
                        </div>

                        {{-- WhatsApp redirect button --}}
                        <button type="button" id="sendWhatsApp"
                            class="w-full flex items-center justify-center gap-3 px-6 py-4 bg-green-500 hover:bg-green-600 text-white font-bold rounded-xl transition-all hover:-translate-y-1 shadow-lg shadow-green-200">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                            </svg>
                            Envoyer via WhatsApp
                        </button>

                        <p class="text-xs text-slate-400 text-center">
                            En cliquant, vous serez redirigé vers WhatsApp avec votre message pré-rempli.
                        </p>
                    </form>
                </div>
            </div>

            {{-- Info Panel --}}
            <div class="lg:col-span-2 flex flex-col gap-6">
                {{-- Hours --}}
                <div class="bg-slate-900 rounded-2xl p-8 text-white">
                    <h3 class="text-xl font-bold font-display mb-6 flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Heures d'ouverture
                    </h3>
                    <ul class="space-y-3">
                        @foreach([
                            ['Lundi – Vendredi', '08h00 – 18h00', true],
                            ['Samedi', '08h00 – 17h00', true],
                            ['Dimanche', 'Fermé', false],
                        ] as [$day, $time, $open])
                        <li class="flex justify-between items-center py-2 border-b border-white/10 last:border-0">
                            <span class="text-slate-300 font-medium text-sm">{{ $day }}</span>
                            <span class="text-sm font-bold {{ $open ? 'text-green-400' : 'text-slate-500' }}">{{ $time }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>

                {{-- Address --}}
                <div class="bg-blue-600 rounded-2xl p-8 text-white">
                    <h3 class="text-xl font-bold font-display mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0zM15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        Notre Adresse
                    </h3>
                    <address class="not-italic text-blue-100 leading-relaxed mb-5 text-sm">
                        Quartier Marimilitaire<br>
                        Cotonou, République du Bénin<br>
                    </address>
                    <a href="https://www.google.com/maps/search/Marimilitaire+Cotonou" target="_blank"
                       class="inline-flex items-center gap-2 bg-white/15 hover:bg-white/25 text-white text-sm font-semibold px-4 py-2.5 rounded-xl transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                        Voir sur Google Maps
                    </a>
                </div>

                {{-- Quick Tips --}}
                <div class="bg-amber-50 border border-amber-200 rounded-2xl p-6">
                    <h4 class="font-bold text-amber-900 mb-3 flex items-center gap-2 text-sm uppercase tracking-wide">
                        <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>
                        Bon à savoir
                    </h4>
                    <ul class="space-y-2 text-amber-800 text-sm">
                        <li class="flex items-start gap-2">
                            <svg class="w-4 h-4 mt-0.5 text-amber-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            Réponse WhatsApp en moins de 30 min
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="w-4 h-4 mt-0.5 text-amber-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            Devis gratuit sous 24h pour les chantiers
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="w-4 h-4 mt-0.5 text-amber-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            Livraison disponible sur tout Cotonou
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Map Section --}}
<section class="bg-slate-50 py-16">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10">
            <h2 class="text-3xl font-extrabold text-slate-900 font-display mb-2">Trouvez-Nous</h2>
            <p class="text-slate-500">Nous sommes facilement accessibles au quartier Marimilitaire, Cotonou.</p>
        </div>
        <div class="rounded-3xl overflow-hidden shadow-2xl border border-slate-200" style="height: 420px;">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15901.0!2d2.4228!3d6.3663!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1024a8f5b6f73ec7%3A0x0!2sCotonou%2C+B%C3%A9nin!5e0!3m2!1sfr!2sbj!4v1714000000000!5m2!1sfr!2sbj"
                width="100%"
                height="100%"
                style="border:0;"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
                title="ElecShop - Marimilitaire, Cotonou">
            </iframe>
        </div>
    </div>
</section>

{{-- FAQ --}}
<section class="bg-white py-24">
    <div class="max-w-3xl mx-auto px-4">
        <div class="text-center mb-16">
            <span class="text-blue-600 font-bold text-xs uppercase tracking-[0.2em] mb-4 block">Réponses rapides</span>
            <h2 class="text-4xl font-extrabold text-slate-900 font-display">Questions Fréquentes</h2>
        </div>
        <div class="space-y-4" x-data="{ open: null }">
            @foreach([
                [
                    'q' => 'Proposez-vous des livraisons en dehors de Cotonou ?',
                    'a' => 'Oui ! Nous livrons dans tout le Bénin via des transporteurs partenaires fiables. Les délais de livraison varient entre 24h et 72h selon votre localisation. Contactez-nous pour obtenir un tarif de livraison vers votre ville.'
                ],
                [
                    'q' => 'Puis-je venir acheter directement en boutique ?',
                    'a' => 'Absolument. Notre showroom à Marimilitaire est ouvert du lundi au vendredi de 8h à 18h et le samedi de 8h à 17h. Vous pourrez y voir et tester nos produits, et bénéficier des conseils de notre équipe de techniciens.'
                ],
                [
                    'q' => 'Comment obtenir un devis pour un chantier ?',
                    'a' => 'C\'est simple : contactez-nous via WhatsApp ou ce formulaire en décrivant votre projet (surface, nombre de pièces, besoins spécifiques). Nous vous préparerons un devis complet et gratuit sous 24 heures ouvrées.'
                ],
                [
                    'q' => 'Vos produits sont-ils garantis ?',
                    'a' => 'Oui, tous nos produits sont garantis par leurs fabricants et respectent les normes électriques en vigueur. En cas de défaut constaté, nous assurons le remplacement ou le remboursement selon les conditions de garantie du produit.'
                ],
                [
                    'q' => 'Proposez-vous des tarifs grossistes ?',
                    'a' => 'Oui, nous avons des offres spéciales pour les professionnels du bâtiment, les électriciens et les acheteurs en gros. Contactez-nous directement pour discuter de nos grilles tarifaires professionnelles.'
                ],
            ] as $i => $faq)
            <div class="border border-slate-100 rounded-2xl overflow-hidden" x-data="{ open: false }">
                <button @click="open = !open"
                    class="w-full flex items-center justify-between px-6 py-5 text-left hover:bg-slate-50 transition-colors"
                    :aria-expanded="open">
                    <span class="font-semibold text-slate-900">{{ $faq['q'] }}</span>
                    <svg class="w-5 h-5 text-blue-600 flex-shrink-0 transition-transform duration-300"
                         :class="{ 'rotate-180': open }"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div x-show="open" x-collapse class="px-6 pb-5">
                    <p class="text-slate-600 leading-relaxed text-sm">{{ $faq['a'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const btn = document.getElementById('sendWhatsApp');
    if (!btn) return;

    btn.addEventListener('click', function () {
        const name    = document.getElementById('contact_name').value.trim();
        const phone   = document.getElementById('contact_phone').value.trim();
        const email   = document.getElementById('contact_email').value.trim();
        const subject = document.getElementById('contact_subject');
        const subjectText = subject.options[subject.selectedIndex]?.text || '';
        const message = document.getElementById('contact_message').value.trim();

        if (!name || !message || !subjectText || subject.value === '') {
            alert('Veuillez remplir les champs obligatoires : Nom, Objet et Message.');
            return;
        }

        let text = `Bonjour ElecShop ! 👋\n\n`;
        text += `*Nom :* ${name}\n`;
        if (phone)  text += `*Téléphone :* ${phone}\n`;
        if (email)  text += `*Email :* ${email}\n`;
        text += `*Objet :* ${subjectText}\n\n`;
        text += `*Message :*\n${message}`;

        const encoded = encodeURIComponent(text);
        window.open(`https://wa.me/22997587762?text=${encoded}`, '_blank');
    });
});
</script>
@endpush
@endsection
