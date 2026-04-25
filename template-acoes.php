<?php
/**
 * Template Name: Ações Sociais
 * Description: Template para listagem das ações sociais realizadas pelo instituto.
 */

get_header(); ?>

<main id="primary" class="site-main">
    <!-- Header da Página -->
    <section class="bg-primary-50 py-16 md:py-24 border-b border-primary-100">
        <div class="container mx-auto px-5 lg:px-8 text-center animate-fade-in">
            <span class="text-primary-600 font-semibold tracking-wide uppercase text-sm">Nossa Atuação</span>
            <h1 class="text-4xl md:text-5xl font-bold mt-2 text-gray-900">Ações Sociais</h1>
            <div class="w-20 h-1 bg-primary-500 mx-auto mt-4 rounded-full"></div>
            <p class="text-gray-600 mt-4 max-w-2xl mx-auto">Registros de nossas atividades e projetos realizados em prol da comunidade e dos direitos humanos.</p>
        </div>
    </section>

    <!-- Listagem de Ações -->
    <section class="py-16 md:py-24 bg-white">
        <div class="container mx-auto px-5 lg:px-8">
            <?php
            $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
            $args = array(
                'post_type'      => 'acao',
                'posts_per_page' => 9,
                'paged'          => $paged
            );
            $acoes_query = new WP_Query( $args );

            if ( $acoes_query->have_posts() ) :
            ?>
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <?php
                    while ( $acoes_query->have_posts() ) :
                        $acoes_query->the_post();
                        $data_evento = get_post_meta( get_the_ID(), '_acao_data', true );
                        ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class( 'bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden card-hover flex flex-col' ); ?>>
                            <?php if ( has_post_thumbnail() ) : ?>
                                <a href="<?php the_permalink(); ?>" class="block aspect-video overflow-hidden">
                                    <?php the_post_thumbnail( 'large', array( 'class' => 'w-full h-full object-cover transition-transform duration-500 hover:scale-105' ) ); ?>
                                </a>
                            <?php endif; ?>

                            <div class="p-6 flex-1 flex flex-col">
                                <?php if ( $data_evento ) : ?>
                                    <div class="flex items-center gap-2 text-xs font-semibold text-primary-600 uppercase mb-3">
                                        <span class="bg-primary-50 px-2 py-1 rounded-md flex items-center gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2-2v12a2 2 0 002 2z" />
                                            </svg>
                                            <?php echo date_i18n( get_option( 'date_format' ), strtotime( $data_evento ) ); ?>
                                        </span>
                                    </div>
                                <?php endif; ?>
                                
                                <h2 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2">
                                    <a href="<?php the_permalink(); ?>" class="hover:text-primary-600 transition-colors">
                                        <?php the_title(); ?>
                                    </a>
                                </h2>

                                <div class="text-gray-600 text-sm mb-5 line-clamp-3">
                                    <?php the_excerpt(); ?>
                                </div>

                                <div class="mt-auto pt-5 border-t border-gray-100 flex items-center justify-between">
                                    <a href="<?php the_permalink(); ?>" class="text-primary-700 font-bold text-sm flex items-center gap-1 hover:gap-2 transition-all">
                                        Ver detalhes e galeria
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </article>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                    ?>
                </div>

                <!-- Paginação -->
                <div class="mt-16 flex justify-center">
                    <?php
                    echo paginate_links( array(
                        'total'     => $acoes_query->max_num_pages,
                        'current'   => $paged,
                        'prev_text' => 'Anterior',
                        'next_text' => 'Próximo',
                        'type'      => 'plain',
                    ) );
                    ?>
                </div>

            <?php else : ?>
                <div class="text-center py-20 bg-gray-50 rounded-3xl border-2 border-dashed border-gray-200">
                    <p class="text-gray-500 mb-4"><?php esc_html_e( 'Nenhuma ação social cadastrada ainda.', 'icddh' ); ?></p>
                    <a href="<?php echo admin_url('post-new.php?post_type=acao'); ?>" class="bg-primary-600 text-white px-6 py-2 rounded-full font-bold shadow-md hover:bg-primary-700 transition">Adicionar Primeira Ação</a>
                </div>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php get_footer(); ?>
