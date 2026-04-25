<?php
/**
 * Template Name: ECA Digital
 * Description: Página educativa e informativa sobre o Estatuto da Criança e do Adolescente no ambiente digital.
 */

get_header(); ?>

<main id="primary" class="site-main bg-white">
    <!-- HERO SECTION: IMPACTO EDUCATIVO -->
    <section class="bg-gray-900 text-white py-24 md:py-32 relative overflow-hidden">
        <div class="absolute inset-0 opacity-10 pointer-events-none">
            <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-primary-400 rounded-full blur-[150px]"></div>
            <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-indigo-500 rounded-full blur-[120px]"></div>
        </div>
        <div class="container mx-auto px-5 lg:px-8 relative z-10 text-center">
            <div class="max-w-4xl mx-auto animate-fade-in">
                <span class="bg-primary-600/30 text-white px-6 py-2 rounded-full text-[10px] font-black uppercase tracking-[0.3em] mb-8 inline-block border border-white/20 backdrop-blur-md">Cidadania & Rede</span>
                <h1 class="text-5xl md:text-7xl font-black mb-8 leading-none tracking-tighter italic">ECA <span class="text-primary-400">Digital</span>.</h1>
                <p class="text-white text-xl md:text-2xl font-medium leading-relaxed max-w-2xl mx-auto">Protegendo direitos, garantindo segurança e educando para o futuro no ambiente conectado.</p>
            </div>
        </div>
    </section>

    <!-- O QUE É O ECA DIGITAL? -->
    <section class="py-24 bg-white relative">
        <div class="container mx-auto px-5 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-20 items-center">
                <div class="space-y-8 animate-slide-up">
                    <div class="inline-block px-4 py-1.5 bg-primary-600 text-white rounded-xl text-xs font-black uppercase tracking-widest">⚖️ MARCO LEGAL</div>
                    <h2 class="text-4xl md:text-5xl font-black text-gray-900 leading-tight tracking-tighter italic">Lei nº 15.211/2025 <br> <span class="text-primary-600">Lei Felca</span>.</h2>
                    <p class="text-gray-700 text-lg md:text-xl font-medium leading-relaxed font-sans">Formalizada em setembro de 2025, esta legislação atualiza o Estatuto da Criança e do Adolescente para a era digital. O **ECA Digital** exige que redes sociais, jogos e aplicativos garantam a proteção integral de menores de 18 anos.</p>
                    <div class="flex flex-col gap-4">
                        <div class="flex items-center gap-4 p-5 bg-gray-50 rounded-[2rem] border border-gray-100 hover:bg-white hover:shadow-xl transition-all group">
                            <span class="text-3xl group-hover:scale-110 transition-transform">🛡️</span>
                            <span class="text-sm font-bold text-gray-700 uppercase tracking-tight">Proteção contra crimes virtuais</span>
                        </div>
                        <div class="flex items-center gap-4 p-5 bg-gray-50 rounded-[2rem] border border-gray-100 hover:bg-white hover:shadow-xl transition-all group">
                            <span class="text-3xl group-hover:scale-110 transition-transform">👤</span>
                            <span class="text-sm font-bold text-gray-700 uppercase tracking-tight">Direito à privacidade e dados</span>
                        </div>
                    </div>
                </div>
                <div class="relative">
                    <div class="bg-primary-950 rounded-[3.5rem] p-12 text-white shadow-2xl relative z-10 overflow-hidden group hover:rotate-1 transition-transform duration-700">
                        <div class="absolute -right-20 -bottom-20 w-80 h-80 bg-primary-500/20 rounded-full blur-3xl"></div>
                        <h3 class="text-2xl font-black italic mb-8 border-l-4 border-primary-500 pl-6 uppercase tracking-tighter">Pilares do <br> ICDDH Digital</h3>
                        <ul class="space-y-6">
                            <li class="flex gap-4">
                                <span class="text-primary-400 font-black text-xl">01.</span>
                                <div>
                                    <h4 class="font-bold text-lg leading-tight mb-2 uppercase tracking-tighter">Corresponsabilidade</h4>
                                    <p class="text-sm text-white font-medium italic">Plataformas digitais agora são legalmente corresponsáveis pela segurança dos usuários menores.</p>
                                </div>
                            </li>
                            <li class="flex gap-4">
                                <span class="text-primary-400 font-black text-xl">02.</span>
                                <div>
                                    <h4 class="font-bold text-lg leading-tight mb-2 uppercase tracking-tighter">Vigência (Março 2026)</h4>
                                    <p class="text-sm text-white font-medium italic">Entrada oficial em pleno vigor em 17 de março de 2026, sob o Decreto nº 12.880/2026.</p>
                                </div>
                            </li>
                            <li class="flex gap-4">
                                <span class="text-primary-400 font-black text-xl">03.</span>
                                <div>
                                    <h4 class="font-bold text-lg leading-tight mb-2 uppercase tracking-tighter">Proteção Integral</h4>
                                    <p class="text-sm text-white font-medium italic">Foco absoluto em proteger contra algoritmos viciantes e exposição indevida em redes e jogos.</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="absolute inset-0 border-2 border-primary-100 rounded-[3.5rem] translate-x-6 translate-y-6 -z-0"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- GUIA DE SEGURANÇA (CARDS) -->
    <section class="py-24 bg-gray-50 border-y border-gray-100">
        <div class="container mx-auto px-5 lg:px-8">
            <div class="text-center mb-16 animate-fade-in">
                <span class="text-primary-600 font-black uppercase text-xs tracking-[0.3em] mb-4 inline-block italic">🧭 Guia Prático</span>
                <h3 class="text-4xl md:text-5xl font-black text-gray-900 tracking-tighter italic">Navegação <span class="text-primary-500 decoration-primary-100 underline underline-offset-8">Consciente</span>.</h3>
            </div>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- PRIVACIDADE -->
                <div class="bg-white p-10 rounded-[3rem] border border-gray-100 shadow-sm hover:shadow-2xl transition-all duration-500 group">
                    <div class="w-16 h-16 bg-blue-50 text-blue-700 rounded-2xl flex items-center justify-center text-3xl mb-8 group-hover:scale-110 transition-transform">🔐</div>
                    <h5 class="text-xl font-bold text-gray-900 mb-4 tracking-tight uppercase tracking-widest text-[13px]">Privacidade</h5>
                    <p class="text-gray-700 text-sm font-medium leading-relaxed">Nunca compartilhe senhas, endereços ou fotos íntimas. Suas informações são seu bem mais precioso no mundo digital.</p>
                </div>
                <!-- BULLYING -->
                <div class="bg-white p-10 rounded-[3rem] border border-gray-100 shadow-sm hover:shadow-2xl transition-all duration-500 group">
                    <div class="w-16 h-16 bg-red-50 text-red-700 rounded-2xl flex items-center justify-center text-3xl mb-8 group-hover:scale-110 transition-transform">🛡️</div>
                    <h5 class="text-xl font-bold text-gray-900 mb-4 tracking-tight uppercase tracking-widest text-[13px]">Cyberbullying</h5>
                    <p class="text-gray-700 text-sm font-medium leading-relaxed">O que você diz online tem impacto real. A prática de ofensas digitais é crime e fere o Estatuto da Criança e do Adolescente.</p>
                </div>
                <!-- APOIO -->
                <div class="bg-white p-10 rounded-[3rem] border border-gray-100 shadow-sm hover:shadow-2xl transition-all duration-500 group">
                    <div class="w-16 h-16 bg-green-50 text-green-700 rounded-2xl flex items-center justify-center text-3xl mb-8 group-hover:scale-110 transition-transform">💬</div>
                    <h5 class="text-xl font-bold text-gray-900 mb-4 tracking-tight uppercase tracking-widest text-[13px]">Peça Ajuda</h5>
                    <p class="text-gray-700 text-sm font-medium leading-relaxed">Viu algo estranho? Recebeu mensagens suspeitas? Procure imediatamente um responsável ou fale com os mentores do ICDDH.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ACTION BLOCK: CANAL SEGURO -->
    <section class="py-24 bg-white relative">
        <div class="container mx-auto px-5 lg:px-8">
            <div class="bg-gray-900 rounded-[4rem] p-12 md:p-24 text-white relative overflow-hidden shadow-2xl">
                <div class="absolute top-0 right-0 w-full h-full opacity-5 pointer-events-none flex items-center justify-center">
                    <div class="text-[500px] font-black italic tracking-tighter">REDE</div>
                </div>
                <div class="relative z-10 max-w-3xl mx-auto text-center space-y-12">
                    <div class="inline-block px-4 py-2 border border-primary-400 text-primary-300 rounded-full text-xs font-black uppercase tracking-widest font-sans">Espaço de Confiança</div>
                    <h3 class="text-4xl md:text-6xl font-black italic tracking-tighter leading-none">Você <span class="text-primary-500">não está</span> sozinho na rede.</h3>
                    <p class="text-white text-lg md:text-xl font-medium max-w-2xl mx-auto">Se você está sofrendo algum tipo de assédio digital ou conhece alguém em perigo, use nosso canal seguro ou ligue para o **Disque 100**.</p>
                    <div class="flex flex-col sm:flex-row justify-center gap-6 pt-10">
                        <a href="mailto:ajuda@icddh.org.br" class="bg-white text-primary-950 px-10 py-5 rounded-full font-black uppercase text-xs tracking-widest shadow-2xl hover:bg-primary-100 transition-all transform hover:-translate-y-1">Falar com o Instituto ✉️</a>
                        <a href="tel:100" class="border-2 border-white/20 text-white px-10 py-5 rounded-full font-black uppercase text-xs tracking-widest hover:border-white transition-all transform hover:-translate-y-1">Disque 100 📞</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- TIMELINE LEGAL -->
    <section class="py-24 bg-white border-b border-gray-100">
        <div class="container mx-auto px-5 lg:px-8">
            <div class="max-w-4xl mx-auto bg-gray-50 rounded-[3rem] p-10 md:p-16 border border-gray-100 shadow-sm relative overflow-hidden group">
                <div class="absolute top-0 right-0 p-12 text-6xl opacity-5">🏛️</div>
                <h4 class="text-2xl font-black italic mb-10 tracking-tighter text-gray-900 underline decoration-primary-500 decoration-4">ECA Digital: Prazos e Vigência</h4>
                <div class="grid sm:grid-cols-2 gap-10">
                    <div class="space-y-2">
                        <p class="text-gray-600 text-[10px] font-black uppercase tracking-[0.2em] italic">Sancionamento:</p>
                        <p class="text-gray-900 font-bold text-lg">17 de Setembro de 2025</p>
                    </div>
                    <div class="space-y-2">
                        <p class="text-gray-600 text-[10px] font-black uppercase tracking-[0.2em] italic">Entrada em Vigor:</p>
                        <p class="text-primary-700 font-black text-xl">17 de Março de 2026</p>
                    </div>
                    <div class="space-y-2">
                        <p class="text-gray-600 text-[10px] font-black uppercase tracking-[0.2em] italic">Regulamentação:</p>
                        <p class="text-gray-900 font-bold text-lg">Decreto nº 12.880/2026</p>
                    </div>
                    <div class="space-y-2">
                        <p class="text-gray-600 text-[10px] font-black uppercase tracking-[0.2em] italic">Público-Alvo:</p>
                        <p class="text-gray-900 font-bold text-lg">Menores de 18 anos</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- MATERIAIS PARA DOWNLOAD -->
    <section class="py-24 bg-gray-50">
        <div class="container mx-auto px-5 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <div>
                    <h3 class="text-3xl font-black text-gray-900 tracking-tight leading-tight uppercase tracking-tighter mb-6 underline decoration-primary-500 decoration-8 underline-offset-8 inline-block">Materiais Educativos</h3>
                    <p class="text-gray-700 font-medium mb-10 leading-relaxed">Baixe cartilhas digitais e guias de segurança feitos especialmente para você levar no seu celular ou compartilhar na sua escola.</p>
                    <div class="space-y-4">
                        <a href="#" class="p-6 bg-white border border-gray-100 rounded-3xl shadow-sm hover:shadow-xl hover:border-primary-200 transition-all flex items-center justify-between group">
                            <div class="flex items-center gap-5">
                                <span class="text-2xl">📘</span>
                                <span class="text-sm font-black text-gray-900 uppercase tracking-widest leading-none">Cartilha ECA Digital (PDF)</span>
                            </div>
                            <span class="text-primary-700 font-black text-xs group-hover:translate-x-2 transition-transform">BAIXAR →</span>
                        </a>
                        <a href="#" class="p-6 bg-white border border-gray-100 rounded-3xl shadow-sm hover:shadow-xl hover:border-primary-200 transition-all flex items-center justify-between group">
                            <div class="flex items-center gap-5">
                                <span class="text-2xl">📁</span>
                                <span class="text-sm font-black text-gray-900 uppercase tracking-widest leading-none">Guia Pais e Educadores</span>
                            </div>
                            <span class="text-primary-700 font-black text-xs group-hover:translate-x-2 transition-transform">BAIXAR →</span>
                        </a>
                    </div>
                </div>
                <div class="hidden lg:block relative h-[450px]">
                    <div class="w-full h-full rounded-[4rem] shadow-2xl relative overflow-hidden group border border-gray-100">
                         <img src="<?php echo get_template_directory_uri(); ?>/assets/images/eca-digital.png" alt="Proteção ECA Digital" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-1000">
                         <div class="absolute inset-0 bg-gradient-to-t from-gray-900/80 via-transparent to-transparent"></div>
                         <div class="absolute bottom-12 left-12 right-12 text-white">
                             <h4 class="text-2xl font-black italic mb-2 tracking-tighter">O ICDDH está ON.</h4>
                             <p class="text-primary-300 font-bold italic tracking-widest text-[10px] uppercase">Defendendo Direitos em tempo real.</p>
                         </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
