<?php
/**
 * Template Name: Contato
 * Description: Template para a página de contato com formulário e mapa.
 */

get_header(); ?>

<main id="primary" class="site-main">
    <!-- Header da Página -->
    <section class="bg-primary-50 py-16 md:py-24 border-b border-primary-100">
        <div class="container mx-auto px-5 lg:px-8 text-center animate-fade-in">
            <span class="text-primary-600 font-semibold tracking-wide uppercase text-sm">Fale Conosco</span>
            <h1 class="text-4xl md:text-5xl font-bold mt-2 text-gray-900">Contato</h1>
            <div class="w-20 h-1 bg-primary-500 mx-auto mt-4 rounded-full"></div>
            <p class="text-gray-600 mt-4 max-w-2xl mx-auto">Estamos aqui para ouvir você. Tire suas dúvidas, envie sugestões ou saiba como colaborar com o ICDDH.</p>
        </div>
    </section>

    <section class="py-16 md:py-24 bg-white">
        <div class="container mx-auto px-5 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-16">
                
                <!-- Informações de Contato -->
                <div class="animate-slide-up">
                    <h2 class="text-3xl font-bold text-gray-900 mb-8">Informações Institucionais</h2>
                    
                    <div class="space-y-8">
                        <div class="flex gap-4">
                            <div class="w-12 h-12 bg-primary-100 rounded-2xl flex items-center justify-center shrink-0 shadow-sm">
                                <span class="text-2xl text-primary-700">📍</span>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900 text-lg">Nossa Sede</h3>
                                <p class="text-gray-600 mt-1">R. Prof. André Retz, 283<br>Esplanada dos Barreiros, São Vicente - SP<br>CEP: 11340-250</p>
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <div class="w-12 h-12 bg-primary-100 rounded-2xl flex items-center justify-center shrink-0 shadow-sm">
                                <span class="text-2xl text-primary-700">📧</span>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900 text-lg">E-mail</h3>
                                <p class="text-gray-600 mt-1">contato@icddh.org.br</p>
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <div class="w-12 h-12 bg-primary-100 rounded-2xl flex items-center justify-center shrink-0 shadow-sm">
                                <span class="text-2xl text-primary-700">📞</span>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900 text-lg">Telefone / WhatsApp</h3>
                                <p class="text-gray-600 mt-1">(13) 99999-1234</p>
                            </div>
                        </div>

                        <div class="pt-8">
                            <h3 class="font-bold text-gray-900 text-lg mb-4">Siga o Instituto</h3>
                            <div class="flex gap-4">
                                <a href="https://instagram.com/instituto.caicara" target="_blank" class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center hover:bg-primary-600 hover:text-white transition-all shadow-sm">📸</a>
                                <a href="#" target="_blank" class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center hover:bg-primary-600 hover:text-white transition-all shadow-sm">📘</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Formulário de Contato -->
                <div class="bg-gray-50 p-8 md:p-10 rounded-[2rem] shadow-sm border border-gray-100 animate-fade-in">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Envie uma mensagem</h2>
                    
                    <form id="contactForm" class="space-y-5">
                        <div class="grid md:grid-cols-2 gap-5">
                            <div>
                                <label for="name" class="block text-sm font-semibold text-gray-700 mb-1">Nome Completo</label>
                                <input type="text" id="name" name="name" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none transition-all placeholder-gray-400" placeholder="Seu nome">
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">E-mail</label>
                                <input type="email" id="email" name="email" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none transition-all placeholder-gray-400" placeholder="exemplo@email.com">
                            </div>
                        </div>
                        
                        <div>
                            <label for="subject" class="block text-sm font-semibold text-gray-700 mb-1">Assunto</label>
                            <select id="subject" name="subject" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none transition-all appearance-none bg-white">
                                <option value="duvida">Dúvida Geral</option>
                                <option value="doacao">Doações</option>
                                <option value="voluntariado">Voluntariado</option>
                                <option value="parceria">Parcerias</option>
                            </select>
                        </div>

                        <div>
                            <label for="message" class="block text-sm font-semibold text-gray-700 mb-1">Mensagem</label>
                            <textarea id="message" name="message" rows="5" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none transition-all placeholder-gray-400" placeholder="Como podemos ajudar?"></textarea>
                        </div>

                        <button type="submit" class="w-full bg-primary-600 hover:bg-primary-700 text-white font-bold py-4 rounded-xl shadow-lg transition-all hover:scale-[1.02] flex items-center justify-center gap-2">
                            Enviar Mensagem 🚀
                        </button>
                    </form>
                    
                    <div id="formSuccess" class="hidden mt-6 p-4 bg-green-100 text-green-700 rounded-xl text-center font-semibold">
                        Mensagem enviada com sucesso! Em breve entraremos em contato.
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mapa Full Width no fundo -->
    <section class="h-[500px] w-full border-t border-gray-100 grayscale hover:grayscale-0 transition-all duration-700">
        <iframe 
            width="100%" 
            height="100%" 
            style="border:0;" 
            loading="lazy" 
            allowfullscreen 
            src="https://maps.google.com/maps?q=R.%20Prof.%20Andr%C3%A9%20Retz%2C%20283%20-%20Esplanada%20dos%20Barreiros%2C%20S%C3%A3o%20Vicente%20-%20SP&t=&z=16&ie=UTF8&iwloc=&output=embed">
        </iframe>
    </section>
</main>

<script>
    document.getElementById('contactForm').addEventListener('submit', function(e) {
        e.preventDefault();
        // Simulação de envio - Para funcionar de verdade, integre com CF7 ou um endpoint AJAX no WP
        this.style.opacity = '0.5';
        this.style.pointerEvents = 'none';
        
        setTimeout(() => {
            this.classList.add('hidden');
            document.getElementById('formSuccess').classList.remove('hidden');
        }, 1500);
    });
</script>

<?php get_footer(); ?>
