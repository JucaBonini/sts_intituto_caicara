<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <?php wp_head(); ?>
</head>
<body <?php body_class( 'font-sans antialiased text-gray-800' ); ?>>
    <?php wp_body_open(); ?>

    <!-- ========== CABEÇALHO (Modelo Solicitado) ========== -->
    <header class="sticky top-0 z-50 bg-white/95 backdrop-blur-md shadow-sm border-b border-primary-100">
        <div class="container mx-auto px-5 lg:px-8 py-3 flex flex-wrap justify-between items-center">
            
            <!-- Logo Section -->
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="flex items-center space-x-3 group">
                <div class="w-12 h-12 bg-gray-100 rounded-xl flex items-center justify-center shadow-sm border border-gray-100 overflow-hidden p-1.5 transition-transform hover:scale-105">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.webp" alt="ICDDH" class="w-full h-full object-contain">
                </div>
                <div>
                    <span class="font-bold text-xl tracking-tight text-primary-800 block leading-tight group-hover:text-primary-600 transition-colors">ICDDH</span>
                    <span class="text-[10px] md:text-xs font-medium text-primary-600 block -mt-0.5">Instituto Caiçara de Defesa<br>dos Direitos Humanos</span>
                </div>
            </a>

            <!-- Desktop Nav -->
            <nav class="hidden md:flex space-x-1 lg:space-x-3 text-gray-700 font-medium">
                <?php
                if ( has_nav_menu( 'primary-menu' ) ) {
                    wp_nav_menu( array(
                        'theme_location' => 'primary-menu',
                        'container'      => false,
                        'items_wrap'     => '%3$s',
                        'walker'         => new ICDDH_Walker_Nav_Menu()
                    ) );
                } else {
                    ?>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>#inicio" class="hover:text-primary-700 hover:bg-primary-50 transition-all px-3 py-2 rounded-xl">Início</a>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>#sobre" class="hover:text-primary-700 hover:bg-primary-50 transition-all px-3 py-2 rounded-xl">Instituto</a>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>#atuacao" class="hover:text-primary-700 hover:bg-primary-50 transition-all px-3 py-2 rounded-xl">Objetivos</a>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>#impacto" class="hover:text-primary-700 hover:bg-primary-50 transition-all px-3 py-2 rounded-xl">Impacto</a>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>#apoie" class="hover:text-primary-700 hover:bg-primary-50 transition-all px-3 py-2 rounded-xl">Apoie</a>
                    <?php
                }
                ?>
            </nav>

            <div class="hidden md:flex items-center">
                <a href="javascript:void(0)" onclick="openModal()" class="bg-gradient-to-r from-primary-600 to-primary-800 hover:from-primary-700 hover:to-primary-900 text-white px-4 py-2 rounded-full text-[11px] font-extrabold shadow-[0_4px_12px_rgba(37,99,235,0.2)] transition-all duration-300 hover:shadow-[0_6px_18px_rgba(37,99,235,0.3)] hover:-translate-y-0.5 flex items-center gap-2 group tracking-tight uppercase">
                    <span class="w-1.5 h-1.5 bg-accent-gold rounded-full animate-pulse"></span>
                    Inscrição Caiçara do Futuro
                </a>
            </div>

            <!-- Mobile Menu Toggle -->
            <div class="md:hidden">
                <button id="menuBtn" class="text-primary-700 focus:outline-none p-1 transition-transform active:scale-95">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu Container -->
        <div id="mobileMenu" class="hidden md:hidden bg-white/98 backdrop-blur-lg border-t border-primary-50 px-5 py-8 flex flex-col space-y-4 shadow-2xl animate-fade-in">
            <?php
            if ( has_nav_menu( 'primary-menu' ) ) {
                wp_nav_menu( array(
                    'theme_location' => 'primary-menu',
                    'container'      => false,
                    'items_wrap'     => '%3$s',
                    'walker'         => new ICDDH_Walker_Nav_Menu()
                ) );
            } else {
                ?>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>#inicio" class="text-gray-700 hover:text-primary-700 font-bold text-lg py-3 transition border-l-4 border-transparent hover:border-primary-500 pl-3 hover:bg-gray-50 rounded-r-xl">Início</a>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>#sobre" class="text-gray-700 hover:text-primary-700 font-bold text-lg py-3 transition border-l-4 border-transparent hover:border-primary-500 pl-3 hover:bg-gray-50 rounded-r-xl">Instituto</a>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>#atuacao" class="text-gray-700 hover:text-primary-700 font-bold text-lg py-3 transition border-l-4 border-transparent hover:border-primary-500 pl-3 hover:bg-gray-50 rounded-r-xl">Objetivos</a>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>#impacto" class="text-gray-700 hover:text-primary-700 font-bold text-lg py-3 transition border-l-4 border-transparent hover:border-primary-500 pl-3 hover:bg-gray-50 rounded-r-xl">Impacto</a>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>#apoie" class="text-gray-700 hover:text-primary-700 font-bold text-lg py-3 transition border-l-4 border-transparent hover:border-primary-500 pl-3 hover:bg-gray-50 rounded-r-xl">Apoie</a>
                <?php
            }
            ?>
            
            <!-- Mobile Button (Inscrição) -->
            <a href="javascript:void(0)" onclick="openModal()" class="bg-gradient-to-r from-primary-600 to-primary-800 text-white text-center rounded-[1.5rem] py-4 mt-2 font-bold text-base shadow-xl flex items-center justify-center gap-3 hover:bg-primary-700 transition-all active:scale-95 px-4 uppercase tracking-tight">
                <span class="w-2.5 h-2.5 bg-accent-gold rounded-full animate-pulse"></span>
                Inscrição Caiçara do Futuro
            </a>
        </div>
    </header>

    <script>
        // Função para abrir/fechar sub-menus no mobile
        function toggleMobileSubmenu(event, element) {
            // Só executa se estiver no mobile (largura menor que 768px)
            if (window.innerWidth < 768) {
                event.preventDefault();
                event.stopPropagation();
                
                // Encontra a gaveta (submenu) logo após o link
                const parentDiv = element.closest('.relative.group');
                const submenu = parentDiv.querySelector('.mobile-submenu');
                const icon = element.querySelector('.submenu-icon');
                
                if (submenu) {
                    const isHidden = submenu.classList.contains('hidden');
                    
                    // Fecha todos os outros submenus abertos (opcional, para ficar mais limpo)
                    document.querySelectorAll('.mobile-submenu').forEach(s => {
                        if (s !== submenu) s.classList.add('hidden');
                    });
                    document.querySelectorAll('.submenu-icon').forEach(i => {
                        if (i !== icon) i.classList.remove('rotate-180');
                    });

                    // Abre/Fecha o atual
                    if (isHidden) {
                        submenu.classList.remove('hidden');
                        icon.classList.add('rotate-180');
                    } else {
                        submenu.classList.add('hidden');
                        icon.classList.remove('rotate-180');
                    }
                }
            }
        }

        // Lógica do botão de menu principal mobile (já existente, mas garantindo)
        const menuBtn = document.getElementById('menuBtn');
        const mobileMenu = document.getElementById('mobileMenu');
        if (menuBtn && mobileMenu) {
            menuBtn.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });
        }
    </script>