<?php
/**
 * Template Name: Caiçaras do Futuro (Landing Page)
 * Description: Landing page premium para o projeto social Caiçaras do Futuro.
 */

get_header(); ?>

<!-- Fonts and Additional Styles -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;800&display=swap" rel="stylesheet">

<style>
    :root {
        --primary-deep: #050b18; /* Deep Midnight Blue */
        --accent-teal: #14b8a6; 
        --accent-orange: #c2410c; /* Muted Terracotta */
        --accent-gold: #b2935c;   /* Satin Gold */
        --accent-white: #ffffff;
        --brand-green: #0a4d3c;   /* Forest Green */
        --glass-bg: rgba(255, 255, 255, 0.02);
        --glass-border: rgba(255, 255, 255, 0.07);
    }

    body {
        font-family: 'Inter', 'Outfit', sans-serif;
        background-color: var(--primary-deep);
        color: #f8fafc;
        overflow-x: hidden;
    }

    /* Header Alignment & Transparency Fix */


    /* Accessibility: Better Text Contrast */
    .text-slate-400 {
        color: #cbd5e1 !important; /* Lighter slate (300ish) for better visibility on dark bg */
    }

    .text-slate-300 {
        color: #f1f5f9 !important; /* Closer to white (100ish) */
    }

    /* Keyboard Accessibility */
    a:focus-visible, button:focus-visible {
        outline: 3px solid var(--accent-orange) !important;
        outline-offset: 4px !important;
    }

    .hero-section {
        position: relative;
        min-height: 90vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: url('<?php echo get_template_directory_uri(); ?>/assets/images/hero-caicaras.png') no-repeat center center;
        background-size: cover;
        padding-top: 50px;
    }

    .hero-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to bottom, rgba(15, 23, 42, 0.8), rgba(15, 23, 42, 0.95));
        z-index: 1;
    }

    .hero-content {
        position: relative;
        z-index: 2;
        max-width: 1000px;
        text-align: center;
        padding: 0 20px;
    }

    .glass-card {
        background: rgba(255, 255, 255, 0.03);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 24px;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
    }

    .title-gradient {
        color: #ffffff;
        background: linear-gradient(135deg, #ffffff 0%, #cbd5e1 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        font-weight: 800;
        letter-spacing: -0.03em;
    }

    .btn-premium {
        background: linear-gradient(135deg, var(--accent-gold) 0%, #8e7345 100%);
        color: #050b18;
        padding: 16px 36px;
        border-radius: 100px;
        font-weight: 800;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        display: inline-block;
        box-shadow: 0 10px 25px -5px rgba(178, 147, 92, 0.3);
    }

    .btn-premium:hover {
        transform: translateY(-4px) scale(1.05);
        box-shadow: 0 20px 25px -5px rgba(13, 148, 136, 0.4);
        background: linear-gradient(135deg, #14b8a6 0%, #0d9488 100%);
    }

    .reveal {
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.8s ease-out;
    }

    .reveal.active {
        opacity: 1;
        transform: translateY(0);
    }

    .stat-box {
        padding: 30px;
        border-radius: 20px;
        background: rgba(13, 148, 136, 0.1);
        border: 1px solid rgba(13, 148, 136, 0.2);
    }

    .stat-number {
        font-size: 3.5rem;
        font-weight: 800;
        color: var(--accent-gold);
        display: block;
        line-height: 1;
        margin-bottom: 8px;
    }

    .section-label {
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 2px;
        color: #FFFFFF !important;
        font-weight: 900;
        margin-bottom: 12px;
        display: block;
        opacity: 1 !important;
    }

    .floating {
        animation: floating 3s ease-in-out infinite;
    }

    @keyframes floating {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }

    .aps-logo-placeholder {
        padding: 20px 40px;
        background: white;
        border-radius: 12px;
        color: #0f172a;
        font-weight: 800;
        font-size: 1.5rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }

    .border-gold-premium {
        position: relative;
        background: rgba(15, 23, 42, 0.6);
        border: 1px solid transparent;
        background-clip: padding-box;
    }

    .border-gold-premium::before {
        content: "";
        position: absolute;
        inset: -2px;
        z-index: -1;
        background: linear-gradient(135deg, #fde047, #c5a059, #fde047);
        border-radius: inherit;
        opacity: 0.6;
    }

    .icon-circle {
        width: 56px;
        height: 56px;
        border-radius: 50%;
        background: rgba(253, 224, 71, 0.1);
        border: 1px solid rgba(253, 224, 71, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        color: var(--accent-gold);
        box-shadow: 0 0 20px rgba(253, 224, 71, 0.1);
    }

    /* Modal Styles */
    #caicarasModal {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(5, 11, 24, 0.95);
        backdrop-filter: blur(8px);
        z-index: 9999;
        align-items: center;
        justify-content: center;
        padding: 10px; /* Margem de respiro no mobile */
    }

    #caicarasModal.active {
        display: flex;
        animation: fadeIn 0.4s ease-out;
    }

    .modal-container {
        width: 100%;
        max-width: 600px;
        max-height: 95vh;
        overflow-y: auto;
        position: relative;
        border-radius: 24px;
        /* Custom scrollbar for mobile */
        scrollbar-width: thin;
        scrollbar-color: var(--accent-gold) transparent;
    }
    
    .modal-container::-webkit-scrollbar {
        width: 4px;
    }
    .modal-container::-webkit-scrollbar-thumb {
        background: var(--accent-gold);
        border-radius: 10px;
    }

    .modal-progress {
        height: 4px;
        background: rgba(255, 255, 255, 0.05);
        width: 100%;
    }

    .modal-progress-bar {
        height: 100%;
        background: linear-gradient(90deg, var(--accent-gold), var(--accent-teal));
        width: 33%;
        transition: width 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .modal-step {
        display: none;
        padding: 40px;
        animation: slideUpModal 0.4s ease-out;
    }

    .modal-step.active {
        display: block;
    }

    @keyframes slideUpModal {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .input-premium {
        width: 100%;
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 16px;
        padding: 16px 20px;
        color: white;
        outline: none;
        transition: all 0.3s;
        font-family: 'Outfit', sans-serif;
    }

    .input-premium:focus {
        border-color: var(--accent-gold);
        background: rgba(255, 255, 255, 0.06);
        box-shadow: 0 0 20px rgba(178, 147, 92, 0.1);
    }

    /* Select specific styling */
    select.input-premium {
        appearance: none;
        color-scheme: dark;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='white'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 20px center;
        background-size: 16px;
        padding-right: 45px;
    }

    select.input-premium option {
        background-color: #0f172a;
        color: white;
        padding: 10px;
    }

    .modal-close {
        position: absolute;
        top: 20px;
        right: 20px;
        color: white;
        opacity: 0.5;
        cursor: pointer;
        transition: opacity 0.3s;
    }

    .modal-close:hover {
        opacity: 1;
    }

    /* Smooth Error Message */
    #modalError {
        display: none;
        background: rgba(239, 68, 68, 0.1);
        border: 1px solid rgba(239, 68, 68, 0.2);
        color: #fca5a5;
        padding: 12px 20px;
        border-radius: 12px;
        margin-bottom: 20px;
        font-size: 13px;
        font-weight: 600;
        text-align: center;
        animation: fadeInDown 0.3s ease-out;
    }

    @keyframes fadeInDown {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<main id="main-content">    
    <!-- Hero Section -->
    <section class="hero-section px-6">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <span class="section-label reveal">Iniciativa Inovadora</span>
            <h1 class="text-4xl sm:text-6xl md:text-8xl mb-8 title-gradient leading-tight reveal">Caiçaras do Futuro</h1>
            <p class="text-base md:text-xl text-slate-300 mb-12 max-w-3xl mx-auto font-normal leading-relaxed tracking-wide reveal">
                Uma Ponte Sustentável para o Desenvolvimento Regional. <br class="hidden md:block"> Conectando a juventude caiçara às oportunidades do complexo portuário.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center reveal">
                <a href="#proposta" class="btn-premium text-center" aria-label="Ir para detalhes do lançamento oficial">Conhecer o projeto</a>
                <a href="javascript:void(0)" onclick="openModal()" class="px-8 py-4 rounded-full border border-white/40 hover:bg-white/10 transition-all font-semibold backdrop-blur-sm text-white text-center">Garanta sua inscrição</a>
            </div>
        </div>
    </section>

    <!-- Lançamento Oficial Section -->
    <section id="lancamento" class="py-20 md:py-32 bg-slate-900 relative border-b border-white/10 z-10">
        <div class="container mx-auto px-6 text-center">
            <span class="section-label reveal" style="color: var(--accent-gold);">Evento Oficial</span>
            <h2 class="text-3xl md:text-6xl mb-12 md:mb-16 font-extrabold text-white reveal">Cerimônia de Abertura</h2>
            
            <div class="max-w-5xl mx-auto reveal">
                <div class="grid md:grid-cols-3 gap-8 md:gap-12 text-center">
                    
                    <!-- Data -->
                    <div class="p-4 border-b border-white/5 md:border-b-0">
                        <span class="text-white/40 font-bold block mb-2 uppercase tracking-[0.3em] text-[0.6rem]">Data</span>
                        <p class="text-3xl md:text-4xl font-extrabold text-white mb-1">08 de Maio</p>
                        <p class="text-white/50 text-xs md:text-sm italic">Sexta-feira</p>
                    </div>

                    <!-- Horário -->
                    <div class="p-4 border-b border-white/5 md:border-b-0 md:border-x border-white/10">
                        <span class="text-white/40 font-bold block mb-2 uppercase tracking-[0.3em] text-[0.6rem]">Horário</span>
                        <p class="text-3xl md:text-4xl font-extrabold text-white mb-1">19h às 22h</p>
                        <p class="text-white/80 font-medium font-outfit uppercase tracking-wider text-[0.6rem]">Solenidade de Início</p>
                    </div>

                    <!-- Local -->
                    <div class="p-4">
                        <span class="text-white/40 font-bold block mb-2 uppercase tracking-[0.3em] text-[0.6rem]">Localização</span>
                        <p class="text-2xl md:text-3xl font-extrabold text-white mb-1">SEST SENAT</p>
                        <p class="text-white/50 text-xs md:text-sm italic">Praça Adalberto Panzan, 151 - Cidade Náutica III, São Vicente - SP</p>
                    </div>

                </div>
                
                <div class="mt-12 md:mt-20 text-center">
                    <p class="text-base md:text-lg text-white/60 font-medium max-w-2xl mx-auto border-t border-white/5 pt-10 px-4">
                        Marca-se aqui o início de uma jornada transformadora que impactará diretamente a vida dos <span class="text-white font-bold">45 jovens selecionados</span>.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Apresentação Section -->
    <section id="proposta" class="py-20 md:py-32 px-6 md:px-12 bg-slate-950 relative overflow-hidden">
        <!-- Background Accents -->
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-teal-500/5 rounded-full blur-[120px] hidden md:block"></div>
        <div class="absolute bottom-0 left-0 w-[300px] h-[300px] bg-orange-500/5 rounded-full blur-[100px] hidden md:block"></div>
        
        <div class="container mx-auto">
            <div class="grid lg:grid-cols-2 gap-12 md:gap-20 items-center">
                
                <div class="reveal">
                    <span class="section-label" style="color: var(--accent-gold);">Nossa Missão</span>
                    <h2 class="text-3xl md:text-6xl font-extrabold mb-6 md:mb-8 leading-tight text-white">Uma Ponte para o <span style="color: var(--accent-gold);">Desenvolvimento</span></h2>
                    
                    <div class="space-y-6 md:space-y-8 text-white/80 text-base md:text-lg leading-relaxed font-medium mb-12">
                        <p>
                            O <span class="text-white font-bold border-b-2 border-accent-gold/30">Projeto Caiçaras do Futuro</span> é uma iniciativa inovadora desenhada para conectar a juventude da comunidade caiçara às oportunidades reais do complexo portuário de Santos.
                        </p>
                    </div>

                    <!-- Mission Pillars -->
                    <div class="grid gap-4 md:gap-6">
                        <div class="flex items-start gap-4 md:gap-5 p-4 md:p-5 rounded-2xl bg-white/5 border border-white/10 hover:border-white/30 transition-colors group">
                            <div class="w-10 h-10 md:w-12 md:h-12 shrink-0 rounded-xl bg-white/10 flex items-center justify-center text-white group-hover:scale-110 transition-transform">
                                <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                            </div>
                            <div>
                                <h4 class="text-white font-bold text-lg md:text-xl mb-1">Identidade Cultural</h4>
                                <p class="text-white/60 text-xs md:text-sm">Valorizamos as raízes locais integrando conhecimento histórico ao futuro profissional.</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4 md:gap-5 p-4 md:p-5 rounded-2xl bg-white/5 border border-white/10 hover:border-white/30 transition-colors group">
                            <div class="w-10 h-10 md:w-12 md:h-12 shrink-0 rounded-xl bg-white/10 flex items-center justify-center text-white group-hover:scale-110 transition-transform">
                                <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                            </div>
                            <div>
                                <h4 class="text-white font-bold text-lg md:text-xl mb-1">Conexão Estratégica</h4>
                                <p class="text-white/60 text-xs md:text-sm">Ligação direta entre a juventude e as demandas do maior complexo portuário da América Latina.</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4 md:gap-5 p-4 md:p-5 rounded-2xl bg-white/5 border border-white/10 hover:border-white/30 transition-colors group">
                            <div class="w-10 h-10 md:w-12 md:h-12 shrink-0 rounded-xl bg-white/10 flex items-center justify-center text-white group-hover:scale-110 transition-transform">
                                <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path></svg>
                            </div>
                            <div>
                                <h4 class="text-white font-bold text-lg md:text-xl mb-1">Sustentabilidade</h4>
                                <p class="text-white/60 text-xs md:text-sm">Formamos agentes de transformação preparados para o desenvolvimento socioambiental consciente.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="relative reveal lg:pl-10 mt-8 lg:mt-0">
                    <!-- Premium Image Frame -->
                    <div class="relative z-10 rounded-[2rem] overflow-hidden border border-white/20 shadow-2xl md:skew-x-1 hover:skew-x-0 transition-transform duration-700">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/youth-education.png" alt="Educação Portuária" class="w-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 to-transparent"></div>
                    </div>
                    
                    <!-- Floating badges -->
                    <div class="absolute -bottom-8 -left-4 md:-left-8 glass-card border-accent-teal/30 p-4 md:p-6 floating z-20">
                        <div class="flex items-center gap-3 md:gap-4">
                            <div class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-accent-teal flex items-center justify-center text-white font-bold text-xs md:text-base">Serão</div>
                            <div>
                                <p class="text-white font-bold text-[0.6rem] md:text-sm leading-tight">45 Jovens<br>Impactados</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Justificativa Section -->
    <section class="py-20 md:py-32 px-6 md:px-12 bg-slate-900 border-y border-white/5">
        <div class="container mx-auto">
            <div class="max-w-4xl mx-auto text-center mb-12 md:mb-20 reveal">
                <span class="section-label" style="color: var(--accent-gold);">O Cenário</span>
                <h2 class="text-3xl md:text-5xl font-extrabold mb-6 md:mb-8 text-white">Fortalecendo o vínculo Porto-Cidade</h2>
                <p class="text-white/60 text-base md:text-lg leading-relaxed">
                    O crescimento acelerado do complexo portuário traz desafios sociais significativos. <br class="hidden md:block"> O Caiçaras do Futuro atua como uma ponte estratégica para reverter esse cenário.
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-6 md:gap-10">
                <div class="glass-card p-6 md:p-10 reveal border border-white/10 hover:border-white/30 transition-all">
                    <div class="w-12 h-12 md:w-14 md:h-14 bg-white/10 rounded-2xl flex items-center justify-center mb-6 md:mb-8 border border-white/20">
                        <svg class="w-6 h-6 md:w-7 md:h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </div>
                    <h3 class="text-xl md:text-2xl font-bold mb-3 md:mb-4 text-white">Inclusão Social</h3>
                    <p class="text-white/50 text-sm md:text-base leading-relaxed">Atuamos diretamente na sensação de exclusão, oferecendo oportunidades reais para as comunidades vizinhas.</p>
                </div>
                
                <div class="glass-card p-6 md:p-10 reveal border border-white/10 hover:border-white/30 transition-all" style="transition-delay: 0.1s;">
                    <div class="w-12 h-12 md:w-14 md:h-14 bg-white/10 rounded-2xl flex items-center justify-center mb-6 md:mb-8 border border-white/20">
                        <svg class="w-6 h-6 md:w-7 md:h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    </div>
                    <h3 class="text-xl md:text-2xl font-bold mb-3 md:mb-4 text-white">Capacitação</h3>
                    <p class="text-white/50 text-sm md:text-base leading-relaxed">Promovemos conhecimento sobre a história e as operações do maior porto da América Latina.</p>
                </div>

                <div class="glass-card p-6 md:p-10 reveal border border-white/10 hover:border-white/30 transition-all" style="transition-delay: 0.2s;">
                    <div class="w-12 h-12 md:w-14 md:h-14 bg-white/10 rounded-2xl flex items-center justify-center mb-6 md:mb-8 border border-white/20">
                        <svg class="w-6 h-6 md:w-7 md:h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path></svg>
                    </div>
                    <h3 class="text-xl md:text-2xl font-bold mb-3 md:mb-4 text-white">Sustentabilidade</h3>
                    <p class="text-white/50 text-sm md:text-base leading-relaxed">Valorizamos a responsabilidade socioambiental e a preservação da identidade caiçara.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Objetivos & Detalhes Section -->
    <section class="py-20 md:py-24 px-6 md:px-12 bg-slate-950">
        <div class="container mx-auto">
            <div class="grid lg:grid-cols-2 gap-12 md:gap-16">
                <div class="reveal">
                    <span class="section-label">Objetivos do Primeiro Ciclo</span>
                    <h2 class="text-3xl md:text-4xl text-white font-bold mb-6 md:mb-8">Estrutura do Programa <span class="text-orange-500">2026</span></h2>
                    <p class="text-slate-400 text-base md:text-lg mb-8 md:mb-10">
                        Nossa meta é capacitar jovens em situação de vulnerabilidade, conectando história, realidade operacional e perspectivas de carreira.
                    </p>
                    
                    <ul class="space-y-4 md:space-y-6">
                        <li class="flex items-start gap-3 md:gap-4 text-sm md:text-base">
                            <div class="mt-1 w-5 h-5 md:w-6 md:h-6 shrink-0 rounded-full bg-teal-500/20 flex items-center justify-center text-teal-400">✓</div>
                            <div>
                                <h4 class="font-bold text-white">Ciclo Formativo Completo</h4>
                                <p class="text-slate-400">3 encontros presenciais + visita monitorada ao Porto e Museu.</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-3 md:gap-4 text-sm md:text-base">
                            <div class="mt-1 w-5 h-5 md:w-6 md:h-6 shrink-0 rounded-full bg-teal-500/20 flex items-center justify-center text-teal-400">✓</div>
                            <div>
                                <h4 class="font-bold text-white">Bolsa-Auxílio Exclusiva</h4>
                                <p class="text-slate-400">R$ 500,00 pagos ao final de cada ciclo para todos os concluintes.</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-3 md:gap-4 text-sm md:text-base">
                            <div class="mt-1 w-5 h-5 md:w-6 md:h-6 shrink-0 rounded-full bg-teal-500/20 flex items-center justify-center text-teal-400">✓</div>
                            <div>
                                <h4 class="font-bold text-white">Metodologia Visual</h4>
                                <p class="text-slate-400">Apostilas, vídeos e gráficos atualizados com as demandas modernas.</p>
                            </div>
                        </li>
                    </ul>
                </div>

                <div class="grid grid-cols-2 gap-4 md:gap-6 mt-12 lg:mt-0 reveal">
                    <div class="stat-box p-6 md:p-8">
                        <span class="stat-number text-3xl md:text-6xl">45</span>
                        <p class="text-slate-400 font-semibold text-xs md:text-sm">Jovens por Ciclo</p>
                    </div>
                    <div class="stat-box p-6 md:p-8">
                        <span class="stat-number text-3xl md:text-6xl">20h</span>
                        <p class="text-slate-400 font-semibold text-xs md:text-sm">Carga Horária</p>
                    </div>
                    <div class="stat-box p-6 md:p-8">
                        <span class="stat-number text-3xl md:text-6xl">03</span>
                        <p class="text-slate-400 font-semibold text-xs md:text-sm">Turmas Iniciais</p>
                    </div>
                    <div class="stat-box p-6 md:p-8">
                        <span class="stat-number text-3xl md:text-6xl">08</span>
                        <p class="text-slate-400 font-semibold text-xs md:text-sm">Meses de Duração</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Parceiros & Patrocínio Section -->
    <section id="patrocinio" class="py-20 md:py-32 px-6 md:px-12 bg-slate-950 border-t border-white/5 relative overflow-hidden">
        <!-- Subtle Glow -->
        <div class="absolute -bottom-24 left-1/2 -translate-x-1/2 w-full max-w-4xl h-64 bg-accent-gold/5 blur-[120px] pointer-events-none hidden md:block"></div>

        <div class="container mx-auto text-center relative z-10">
            <span class="section-label reveal" style="color: var(--accent-gold);">Aliança Estratégica</span>
            <h2 class="text-3xl md:text-6xl font-extrabold text-white mb-12 md:mb-16 reveal">Unindo forças pela Transformação</h2>
            
            <!-- Consolidated Partner Image in White Box -->
            <div class="max-w-5xl mx-auto mb-16 md:mb-20 reveal">
                <div class="bg-white p-4 md:p-12 shadow-2xl overflow-hidden rounded-2xl md:rounded-[2rem] border border-white/10">
                    <img 
                        src="<?php echo get_template_directory_uri(); ?>/assets/images/patrocinio.webp" 
                        alt="Patrocinadores Oficiais: Porto de Santos, Ministério de Portos e Aeroportos e Governo Federal" 
                        class="w-full h-auto object-contain mx-auto"
                        loading="lazy"
                    >
                </div>
            </div>

            <div class="max-w-2xl mx-auto mb-12 md:mb-16 reveal px-4">
                <p class="text-base md:text-lg text-white/50 font-medium leading-relaxed italic">
                    "O Caiçaras do Futuro conta com o suporte estratégico de instituições fundamentais para o desenvolvimento do Brasil."
                </p>
            </div>

            <div class="flex flex-col md:flex-row gap-8 justify-center items-center reveal">
                <a href="javascript:void(0)" onclick="openModal()" class="btn-premium w-full sm:w-auto text-center">Garanta sua inscrição</a>                
            </div>
        </div>
    </section>

</main>

<script>
    // Scroll Reveal Animation (Exclusive to Landing Page)
    function reveal() {
        var reveals = document.querySelectorAll(".reveal");
        for (var i = 0; i < reveals.length; i++) {
            var windowHeight = window.innerHeight;
            var elementTop = reveals[i].getBoundingClientRect().top;
            var elementVisible = 150;
            if (elementTop < windowHeight - elementVisible) {
                reveals[i].classList.add("active");
            }
        }
    }
    window.addEventListener("scroll", reveal);
    window.addEventListener("load", reveal);
</script>

<?php get_footer(); ?>
