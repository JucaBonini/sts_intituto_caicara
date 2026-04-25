    <!-- ========== FOOTER com dados reais ========== -->
    <footer class="bg-gray-900 text-gray-300 pt-14 pb-8">
        <div class="container mx-auto px-5 lg:px-8">
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center gap-3">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.webp" alt="<?php bloginfo( 'name' ); ?>" class="h-10 w-auto">
                        <span class="font-bold text-white text-lg">ICDDH</span>
                    </div>
                    <p class="text-sm mt-3 text-gray-400">Instituto Caiçara de Defesa dos Direitos Humanos — fundado em 2018, com sede em São Vicente/SP.</p>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-3">Instituto</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#sobre" class="hover:text-primary-400 transition">Estatuto e missão</a></li>
                        <li><a href="#atuacao" class="hover:text-primary-400 transition">Objetivos sociais</a></li>
                        <li><a href="#impacto" class="hover:text-primary-400 transition">Transparência</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-3">Contato e sede</h4>
                    <ul class="space-y-2 text-sm">
                        <li>📍 R. Prof. André Retz, 283 - Esplanada dos Barreiros, São Vicente - SP, 11340-250</li>
                        <li>📧 contato@icddh.org.br</li>
                        <li>📞 (13) 99999-1234</li>
                        <li class="text-xs text-gray-400">CNPJ: 34.120.033/0001-97</li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-3">Redes</h4>
                    <div class="flex gap-4 text-xl">
                        <a href="#" class="hover:text-primary-400 transition">📘</a>
                        <a href="#" class="hover:text-primary-400 transition">📸</a>
                        <a href="#" class="hover:text-primary-400 transition">🐦</a>
                        <a href="#" class="hover:text-primary-400 transition">▶️</a>
                    </div>
                    <p class="text-xs text-gray-500 mt-4">Organização da Sociedade Civil sem fins econômicos.</p>
                </div>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-12 py-8 border-y border-gray-800">
                <?php
                $footer_certs = new WP_Query(array(
                    'post_type' => 'certificacao',
                    'posts_per_page' => 4,
                    'orderby' => 'menu_order',
                    'order' => 'ASC'
                ));
                if ($footer_certs->have_posts()) :
                    while ($footer_certs->have_posts()) : $footer_certs->the_post();
                        ?>
                        <div class="flex items-center gap-3">
                            <span class="text-xl opacity-70">📜</span>
                            <div class="leading-none">
                                <p class="text-[10px] font-black uppercase text-white tracking-widest leading-none m-0"><?php the_title(); ?></p>
                                <p class="text-[9px] text-gray-500 italic mt-1 m-0"><?php echo wp_trim_words(get_the_excerpt(), 4); ?></p>
                            </div>
                        </div>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                else:
                    echo '<p class="text-gray-600 text-[10px] font-bold italic tracking-widest uppercase">ICDDH — Transparência e Compromisso Social</p>';
                endif;
                ?>
            </div>
            <div class="mt-10 pt-6 text-center text-gray-500 text-sm">
                © <?php echo date('Y'); ?> <?php bloginfo( 'name' ); ?> — Defesa dos direitos humanos de crianças, adolescentes e jovens com base nos ODS/ONU.
            </div>
        </div>
    </footer>

    <!-- ========== BANNER DE PRIVACIDADE & ECA DIGITAL (LGPD) ========== -->
    <div id="lgpd-banner" class="fixed bottom-6 left-6 right-6 md:left-auto md:max-w-md bg-white/95 backdrop-blur-xl p-8 rounded-[2.5rem] shadow-[0_20px_60px_-15px_rgba(0,0,0,0.15)] border border-gray-100 z-[9999] animate-slide-up hidden">
        <div class="flex items-start gap-4 mb-6">
            <div class="w-14 h-14 bg-primary-600 rounded-2xl flex items-center justify-center text-2xl flex-shrink-0 shadow-lg shadow-primary-200">🛡️</div>
            <div>
                <h4 class="text-gray-900 font-black text-lg tracking-tight leading-tight">Privacidade & <span class="text-primary-600 italic">ECA Digital</span></h4>
                <p class="text-gray-500 text-[11px] font-medium uppercase tracking-[0.1em] mt-1 italic">Compromisso Institucional</p>
            </div>
        </div>
        
        <p class="text-gray-600 text-sm leading-relaxed mb-8">
            O **ICDDH** utiliza cookies para garantir a melhor experiência. Ao continuar, você concorda com nossa política de proteção de dados e as diretrizes de segurança do programa <span class="font-bold text-gray-900">ECA Digital</span>. ⚖️
        </p>

        <div class="flex flex-col sm:flex-row gap-3">
            <button id="acceptLgpd" class="flex-1 bg-primary-600 hover:bg-primary-700 text-white font-black uppercase text-[10px] tracking-widest py-4 rounded-2xl transition-all shadow-xl shadow-primary-100 transform hover:-translate-y-0.5">
                Aceitar e Continuar
            </button>
            <a href="<?php echo home_url('/eca-digital'); ?>" class="px-6 py-4 bg-gray-50 text-gray-400 font-black uppercase text-[10px] tracking-widest rounded-2xl hover:bg-gray-100 transition-all text-center">
                Diretrizes
            </a>
        </div>
    </div>

    <?php 
        // Global Enrollment Modal for Caiçaras do Futuro
        get_template_part('template-parts/modal-inscricao'); 
    ?>
    <?php wp_footer(); ?>

    <script>
        // Lógica do Banner LGPD
        const lgpdBanner = document.getElementById('lgpd-banner');
        const acceptBtn = document.getElementById('acceptLgpd');

        if (lgpdBanner && acceptBtn) {
            // Verificar se o usuário já aceitou anteriormente
            if (!localStorage.getItem('icddh_lgpd_accepted')) {
                setTimeout(() => {
                    lgpdBanner.classList.remove('hidden');
                }, 2000); // Aparece após 2 segundos de navegação
            }

            acceptBtn.addEventListener('click', () => {
                localStorage.setItem('icddh_lgpd_accepted', 'true');
                lgpdBanner.classList.add('translate-y-full', 'opacity-0');
                setTimeout(() => {
                    lgpdBanner.remove();
                }, 5000);
            });
        }

        // Lógica do Menu Mobile
        const menuBtn = document.getElementById('menuBtn');
        const mobileMenu = document.getElementById('mobileMenu');
        if(menuBtn && mobileMenu){
            menuBtn.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });
            const mobileLinks = mobileMenu.querySelectorAll('a');
            mobileLinks.forEach(link => {
                link.addEventListener('click', () => {
                    mobileMenu.classList.add('hidden');
                });
            });
        }

        // Scroll Suave
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                if(href === "#" || href === "") return;
                const target = document.querySelector(href);
                if(target) {
                    e.preventDefault();
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });
        });
    </script>
</body>
</html>
