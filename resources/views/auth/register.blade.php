<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Créer un Compte | ElecShop</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@400;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <style>
        body { font-family: 'Inter', sans-serif; }
        h1,h2,h3,.font-display { font-family: 'Outfit', sans-serif; }

        .auth-bg {
            background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 40%, #0f172a 100%);
            position: relative; overflow: hidden;
        }
        .auth-bg::before {
            content: '';
            position: absolute; inset: 0;
            background-image:
                linear-gradient(rgba(59,130,246,0.07) 1px, transparent 1px),
                linear-gradient(90deg, rgba(59,130,246,0.07) 1px, transparent 1px);
            background-size: 50px 50px;
        }
        .orb-1 { position:absolute; top:-15%; right:-5%; width:550px; height:550px; background:radial-gradient(circle,rgba(99,102,241,.2) 0%,transparent 70%); border-radius:50%; pointer-events:none; }
        .orb-2 { position:absolute; bottom:-15%; left:-5%; width:450px; height:450px; background:radial-gradient(circle,rgba(37,99,235,.18) 0%,transparent 70%); border-radius:50%; pointer-events:none; }
        .glass-card { background:rgba(255,255,255,0.04); border:1px solid rgba(255,255,255,0.10); backdrop-filter:blur(24px); -webkit-backdrop-filter:blur(24px); }
        .form-input { background:rgba(255,255,255,0.06); border:1.5px solid rgba(255,255,255,0.12); color:white; transition:all 0.25s; }
        .form-input::placeholder { color:rgba(255,255,255,0.3); }
        .form-input:focus { outline:none; border-color:#3b82f6; background:rgba(59,130,246,0.08); box-shadow:0 0 0 3px rgba(59,130,246,0.15); }
        .form-input.error-border { border-color:#f87171; background:rgba(248,113,113,0.06); }
        .form-input.valid-border { border-color:#34d399; background:rgba(52,211,153,0.05); }
        .btn-primary { background:linear-gradient(135deg,#3b82f6,#2563eb); transition:all 0.25s; position:relative; overflow:hidden; }
        .btn-primary::after { content:''; position:absolute; inset:0; background:linear-gradient(135deg,rgba(255,255,255,.12),transparent); opacity:0; transition:opacity 0.25s; }
        .btn-primary:hover { transform:translateY(-2px); box-shadow:0 12px 30px rgba(37,99,235,0.4); }
        .btn-primary:hover::after { opacity:1; }
        .btn-primary:active { transform:translateY(0); }
        .btn-primary:disabled { opacity:0.5; transform:none; cursor:not-allowed; }
        .eye-btn { color:rgba(255,255,255,0.4); transition:color 0.2s; }
        .eye-btn:hover { color:rgba(255,255,255,0.8); }
        .strength-segment { height: 4px; border-radius: 2px; background: rgba(255,255,255,0.1); transition: background 0.4s; }
        .check-item { display:flex; align-items:center; gap:6px; font-size:11px; color:rgba(255,255,255,0.4); transition:color 0.3s; }
        .check-item.valid { color:#34d399; }
        .check-item svg { width:12px; height:12px; flex-shrink:0; }
        .field-error { font-size:11px; color:#f87171; margin-top:5px; display:flex; align-items:center; gap:4px; }
    </style>
</head>
<body class="auth-bg min-h-screen flex items-center justify-center py-10 px-4">
    <div class="orb-1"></div>
    <div class="orb-2"></div>

    <div class="relative z-10 w-full max-w-lg">

        {{-- Logo --}}
        <div class="text-center mb-7">
            <a href="/" class="inline-flex items-center gap-3 group">
                <div class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center shadow-xl shadow-blue-900/50 group-hover:scale-105 transition-transform">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <span class="text-2xl font-bold text-white font-display">Elec<span class="text-blue-400">Shop</span></span>
            </a>
            <p class="text-slate-400 text-sm mt-3">Rejoignez notre communauté à Cotonou</p>
        </div>

        {{-- Card --}}
        <div class="glass-card rounded-3xl p-8 shadow-2xl">

            <div class="mb-7">
                <h1 class="text-2xl font-bold text-white font-display mb-1">Créer votre compte ✨</h1>
                <p class="text-slate-400 text-sm">Remplissez le formulaire pour commencer vos achats.</p>
            </div>

            {{-- Errors --}}
            @if($errors->any())
            <div class="bg-red-500/10 border border-red-500/30 text-red-400 text-sm px-4 py-3 rounded-xl mb-6">
                <div class="flex items-center gap-2 font-semibold mb-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Veuillez corriger les erreurs suivantes :
                </div>
                <ul class="space-y-1 ml-6 list-disc text-xs">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form method="POST" action="{{ route('register') }}" id="registerForm" novalidate>
                @csrf

                {{-- Name --}}
                <div class="mb-4">
                    <label for="reg_name" class="block text-sm font-semibold text-slate-300 mb-2">Nom complet <span class="text-blue-400">*</span></label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <input type="text" id="reg_name" name="name" value="{{ old('name') }}" required autocomplete="name" placeholder="Ex : Jean Dupont"
                            class="form-input w-full pl-12 pr-4 py-3.5 rounded-xl text-sm {{ $errors->has('name') ? 'error-border' : '' }}">
                    </div>
                    @error('name') <p class="field-error"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>{{ $message }}</p> @enderror
                </div>

                {{-- Email --}}
                <div class="mb-4">
                    <label for="reg_email" class="block text-sm font-semibold text-slate-300 mb-2">Adresse Gmail / Email <span class="text-blue-400">*</span></label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <input type="email" id="reg_email" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="vous@gmail.com"
                            class="form-input w-full pl-12 pr-10 py-3.5 rounded-xl text-sm {{ $errors->has('email') ? 'error-border' : '' }}"
                            oninput="validateEmail(this)">
                        <span id="email_check" class="absolute inset-y-0 right-0 pr-4 flex items-center hidden">
                            <svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        </span>
                    </div>
                    @error('email') <p class="field-error"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>{{ $message }}</p> @enderror
                </div>

                {{-- Phone + Quartier --}}
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="reg_phone" class="block text-sm font-semibold text-slate-300 mb-2">Téléphone <span class="text-blue-400">*</span></label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </div>
                            <input type="tel" id="reg_phone" name="phone" value="{{ old('phone') }}" required autocomplete="tel" placeholder="+229 97..."
                                class="form-input w-full pl-12 pr-4 py-3.5 rounded-xl text-sm {{ $errors->has('phone') ? 'error-border' : '' }}">
                        </div>
                        @error('phone') <p class="field-error"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="reg_quartier" class="block text-sm font-semibold text-slate-300 mb-2">Quartier <span class="text-blue-400">*</span></label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0zM15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <input type="text" id="reg_quartier" name="quartier" value="{{ old('quartier') }}" required placeholder="Ex : Akpakpa, Cadjehoun..."
                                class="form-input w-full pl-12 pr-4 py-3.5 rounded-xl text-sm {{ $errors->has('quartier') ? 'error-border' : '' }}">
                        </div>
                        @error('quartier') <p class="field-error"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>{{ $message }}</p> @enderror
                    </div>
                </div>

                {{-- Password --}}
                <div class="mb-4">
                    <label for="reg_password" class="block text-sm font-semibold text-slate-300 mb-2">Mot de passe <span class="text-blue-400">*</span></label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </div>
                        <input type="password" id="reg_password" name="password" required autocomplete="new-password" placeholder="Min. 8 caractères"
                            class="form-input w-full pl-12 pr-12 py-3.5 rounded-xl text-sm {{ $errors->has('password') ? 'error-border' : '' }}"
                            oninput="checkStrength(this.value)">
                        <button type="button" class="eye-btn absolute inset-y-0 right-0 pr-4 flex items-center" onclick="togglePassword('reg_password', this)">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                    </div>

                    {{-- Strength meter --}}
                    <div class="mt-3 space-y-2" id="strength_section" style="display:none;">
                        <div class="flex gap-1.5">
                            <div class="strength-segment flex-1" id="s1"></div>
                            <div class="strength-segment flex-1" id="s2"></div>
                            <div class="strength-segment flex-1" id="s3"></div>
                            <div class="strength-segment flex-1" id="s4"></div>
                        </div>
                        <div class="grid grid-cols-2 gap-x-4 gap-y-1">
                            <div class="check-item" id="check_len">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                8 caractères minimum
                            </div>
                            <div class="check-item" id="check_letter">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                Lettres (a-z, A-Z)
                            </div>
                            <div class="check-item" id="check_num">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                Chiffres (0-9)
                            </div>
                            <div class="check-item" id="check_special">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                Caractère spécial
                            </div>
                        </div>
                    </div>
                    @error('password') <p class="field-error mt-2"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>{{ $message }}</p> @enderror
                </div>

                {{-- Confirm password --}}
                <div class="mb-7">
                    <label for="reg_password_confirmation" class="block text-sm font-semibold text-slate-300 mb-2">Confirmer le mot de passe <span class="text-blue-400">*</span></label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                        </div>
                        <input type="password" id="reg_password_confirmation" name="password_confirmation" required autocomplete="new-password" placeholder="Répétez le mot de passe"
                            class="form-input w-full pl-12 pr-12 py-3.5 rounded-xl text-sm"
                            oninput="checkConfirm(this.value)">
                        <button type="button" class="eye-btn absolute inset-y-0 right-0 pr-4 flex items-center" onclick="togglePassword('reg_password_confirmation', this)">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                    </div>
                    <p class="field-error mt-1 hidden" id="confirm_error">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width:12px;height:12px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Les mots de passe ne correspondent pas.
                    </p>
                </div>

                <button type="submit" id="submitBtn" class="btn-primary w-full py-4 rounded-xl text-white font-bold text-sm tracking-wide flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                    </svg>
                    Créer mon compte
                </button>
            </form>

            <p class="text-center text-slate-500 text-sm mt-6">
                Déjà un compte ?
                <a href="{{ route('login') }}" class="text-blue-400 font-semibold hover:text-blue-300 transition-colors ml-1">Se connecter →</a>
            </p>
        </div>

        {{-- Back --}}
        <div class="text-center mt-6">
            <a href="/" class="text-slate-500 hover:text-slate-300 text-sm transition-colors flex items-center justify-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Retour à l'accueil
            </a>
        </div>
    </div>

    @livewireScripts
    <script>
    function togglePassword(fieldId, btn) {
        const input = document.getElementById(fieldId);
        const isHidden = input.type === 'password';
        input.type = isHidden ? 'text' : 'password';
        btn.querySelector('svg').innerHTML = isHidden
            ? '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>'
            : '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>';
    }

    function validateEmail(input) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        const check = document.getElementById('email_check');
        if (re.test(input.value)) {
            input.classList.remove('error-border');
            input.classList.add('valid-border');
            check.classList.remove('hidden');
        } else {
            input.classList.remove('valid-border');
            input.classList.add('error-border');
            check.classList.add('hidden');
        }
    }

    function checkStrength(val) {
        const section = document.getElementById('strength_section');
        section.style.display = val.length > 0 ? 'block' : 'none';

        const checks = {
            check_len:     val.length >= 8,
            check_letter:  /[a-zA-Z]/.test(val),
            check_num:     /[0-9]/.test(val),
            check_special: /[^a-zA-Z0-9]/.test(val),
        };

        let score = Object.values(checks).filter(Boolean).length;

        const colors = ['#f87171', '#fb923c', '#facc15', '#34d399'];
        const labels = ['Très faible', 'Faible', 'Moyen', 'Fort'];
        const segs   = ['s1','s2','s3','s4'];

        segs.forEach((id, i) => {
            const el = document.getElementById(id);
            el.style.background = i < score ? colors[score - 1] : 'rgba(255,255,255,0.1)';
        });

        Object.entries(checks).forEach(([id, valid]) => {
            const el = document.getElementById(id);
            el.classList.toggle('valid', valid);
        });
    }

    function checkConfirm(val) {
        const pwd = document.getElementById('reg_password').value;
        const err = document.getElementById('confirm_error');
        const input = document.getElementById('reg_password_confirmation');
        const match = val === pwd && val.length > 0;
        
        // Use direct style manipulation to avoid conflict with .field-error's display:flex
        if (match || val.length === 0) {
            err.style.display = 'none';
        } else {
            err.style.display = 'flex';
        }
        
        input.classList.toggle('error-border', !match && val.length > 0);
        input.classList.toggle('valid-border', match);
    }
    </script>
</body>
</html>
