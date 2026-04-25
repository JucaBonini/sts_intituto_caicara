<?php
/**
 * Template Name: Diretoria do Instituto
 * Description: Template para exibir os membros da diretoria e conselho.
 */

get_header(); ?>

<main id="primary" class="site-main">
    <!-- Header da Página -->
    <section class="bg-primary-50 py-16 md:py-24 border-b border-primary-100">
        <div class="container mx-auto px-5 lg:px-8 text-center animate-fade-in">
            <span class="text-primary-600 font-semibold tracking-wide uppercase text-sm">Nossa Equipe</span>
            <h1 class="text-4xl md:text-5xl font-bold mt-2 text-gray-900">Membros da Diretoria</h1>
            <div class="w-20 h-1 bg-primary-500 mx-auto mt-4 rounded-full"></div>
            <p class="text-gray-600 mt-4 max-w-2xl mx-auto">Conheça as pessoas dedicadas que lideram e orientam as ações em defesa dos direitos humanos pelo ICDDH.</p>
        </div>
    </section>

    <!-- Listagem da Diretoria -->
    <section class="py-16 md:py-24 bg-white">
        <div class="container mx-auto px-5 lg:px-8">
            <?php
            $args = array(
                'post_type'      => 'membro',
                'posts_per_page' => -1,
                'orderby'        => 'menu_order',
                'order'          => 'ASC'
            );
            $membros_query = new WP_Query( $args );

            if ( $membros_query->have_posts() ) :
                $executiva = array();
                $conselho = array();

                // Grupos de Cargos conforme solicitado
                $cargos_executiva = array('Diretor Presidente', 'Vice-Presidente', 'Diretor Administrativo', 'Diretor Financeiro', 'Diretor Técnico');
                $cargos_conselho = array('Membro 1', 'Membro 2', 'Membro 3');

                while ( $membros_query->have_posts() ) {
                    $membros_query->the_post();
                    $cargo = get_post_meta( get_the_ID(), '_ic_membro_cargo', true );
                    
                    if ( in_array($cargo, $cargos_executiva) ) {
                        $executiva[] = get_the_ID();
                    } else {
                        $conselho[] = get_the_ID();
                    }
                }
                wp_reset_postdata();

                // Função auxiliar para renderizar o card
                function render_membro_card( $post_id ) {
                    $cargo = get_post_meta( $post_id, '_ic_membro_cargo', true );
                    $custom_avatar_id = get_post_meta( $post_id, '_ic_membro_avatar', true );
                    $img_url = $custom_avatar_id ? wp_get_attachment_image_url( $custom_avatar_id, 'medium' ) : get_the_post_thumbnail_url( $post_id, 'medium' );
                    ?>
                    <article class="bg-white rounded-3xl border border-gray-100 shadow-sm text-center p-8 transition-all duration-300">
                        <!-- Foto -->
                        <div class="relative w-32 h-32 mx-auto mb-6">
                            <?php if ( $img_url ) : ?>
                                <div class="w-full h-full rounded-2xl overflow-hidden shadow-inner ring-4 ring-primary-50">
                                    <img src="<?php echo esc_url($img_url); ?>" class="w-full h-full object-cover" alt="<?php echo get_the_title($post_id); ?>">
                                </div>
                            <?php else : ?>
                                <div class="w-full h-full rounded-2xl overflow-hidden shadow-inner ring-4 ring-primary-50 bg-primary-100 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-primary-300" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Dados -->
                        <div class="space-y-3">
                            <h2 class="text-xl font-extrabold text-gray-900 leading-tight">
                                <?php echo get_the_title($post_id); ?>
                            </h2>
                            <?php if ( $cargo ) : ?>
                                <div class="inline-block px-4 py-1.5 bg-primary-600 text-white text-xs font-bold uppercase tracking-widest rounded-full shadow-lg shadow-primary-200">
                                    <?php echo esc_html( $cargo ); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </article>
                    <?php
                }

                // Render Diretoria Executiva
                if ( !empty($executiva) ) : ?>
                    <div class="mb-20">
                        <div class="flex items-center gap-4 mb-10">
                            <h2 class="text-2xl md:text-3xl font-black text-gray-900">Diretoria Executiva</h2>
                            <div class="flex-grow h-px bg-gray-100"></div>
                        </div>
                        <div class="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                            <?php foreach ( $executiva as $id ) render_membro_card( $id ); ?>
                        </div>
                    </div>
                <?php endif;

                // Render Conselho Fiscal
                if ( !empty($conselho) ) : ?>
                    <div>
                        <div class="flex items-center gap-4 mb-10">
                            <h2 class="text-2xl md:text-3xl font-black text-gray-900">Conselho Fiscal</h2>
                            <div class="flex-grow h-px bg-gray-100"></div>
                        </div>
                        <div class="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                            <?php foreach ( $conselho as $id ) render_membro_card( $id ); ?>
                        </div>
                    </div>
                <?php endif; ?>

            <?php else : ?>
                <div class="text-center py-20 bg-gray-50 rounded-3xl border-2 border-dashed border-gray-200">
                    <p class="text-gray-500 italic">Nenhum membro cadastrado ainda.</p>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- CTAs de Apoio -->
    <section class="py-16 bg-primary-900 overflow-hidden relative">
        <div class="container mx-auto px-5 lg:px-8 text-center relative z-10">
            <h2 class="text-3xl font-bold text-white mb-6">Quer contribuir com o nosso conselho?</h2>
            <p class="text-primary-100 mb-8 max-w-xl mx-auto">Sua experiência pode fortalecer a defesa dos direitos humanos. Entre em contato para saber como se tornar um conselheiro voluntário.</p>
            <a href="mailto:contato@icddh.org.br" class="bg-white text-primary-900 px-8 py-3 rounded-full font-bold hover:scale-105 transition-transform inline-block shadow-xl">Fale Conosco</a>
        </div>
        <div class="absolute inset-0 opacity-10">
            <svg class="h-full w-full" fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none">
                <path d="M0 100 C 20 0 50 0 100 100 Z"></path>
            </svg>
        </div>
    </section>
</main>

<?php get_footer(); ?>
