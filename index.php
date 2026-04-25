<?php
/**
 * The main template file (used for the blog/posts index)
 */

get_header(); ?>

<main id="primary" class="site-main">
    <!-- Header do Blog -->
    <section class="bg-primary-50 py-16 md:py-24 border-b border-primary-100">
        <div class="container mx-auto px-5 lg:px-8 text-center animate-fade-in">
            <span class="text-primary-600 font-semibold tracking-wide uppercase text-sm">Atualidades & Impacto</span>
            <h1 class="text-4xl md:text-5xl font-bold mt-2 text-gray-900"><?php echo get_the_title( get_option('page_for_posts') ); ?></h1>
            <div class="w-20 h-1 bg-primary-500 mx-auto mt-4 rounded-full"></div>
            <?php if ( is_home() && ! is_front_page() ) : ?>
                <p class="text-gray-600 mt-4 max-w-2xl mx-auto">Acompanhe as últimas notícias, projetos e ações do Instituto Caiçara em defesa dos direitos humanos.</p>
            <?php endif; ?>
        </div>
    </section>

    <!-- Listagem de Posts -->
    <section class="py-16 md:py-24 bg-white">
        <div class="container mx-auto px-5 lg:px-8">
            <?php if ( have_posts() ) : ?>
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <?php
                    while ( have_posts() ) :
                        the_post();
                        ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class( 'bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden card-hover flex flex-col' ); ?>>
                            <?php if ( has_post_thumbnail() ) : ?>
                                <a href="<?php the_permalink(); ?>" class="block aspect-video overflow-hidden">
                                    <?php the_post_thumbnail( 'large', array( 'class' => 'w-full h-full object-cover transition-transform duration-500 hover:scale-105' ) ); ?>
                                </a>
                            <?php endif; ?>

                            <div class="p-6 flex-1 flex flex-col">
                                <div class="flex items-center gap-2 text-xs font-semibold text-primary-600 uppercase mb-3">
                                    <span class="bg-primary-50 px-2 py-1 rounded-md"><?php the_category(', '); ?></span>
                                    <span class="text-gray-400">•</span>
                                    <time datetime="<?php echo get_the_date('c'); ?>"><?php echo get_the_date(); ?></time>
                                </div>
                                
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
                                        Ler artigo completo
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </article>
                        <?php
                    endwhile;
                    ?>
                </div>

                <!-- Paginação -->
                <div class="mt-16 flex justify-center">
                    <?php
                    the_posts_pagination( array(
                        'prev_text'          => '<span class="px-4 py-2 border border-gray-200 rounded-full hover:bg-primary-50 transition-colors">Anterior</span>',
                        'next_text'          => '<span class="px-4 py-2 border border-gray-200 rounded-full hover:bg-primary-50 transition-colors">Próxima</span>',
                        'before_page_number' => '<span class="w-10 h-10 flex items-center justify-center rounded-full hover:bg-primary-50 transition-colors">',
                        'after_page_number'  => '</span>',
                    ) );
                    ?>
                </div>

            <?php else : ?>
                <div class="text-center py-20 bg-gray-50 rounded-3xl border-2 border-dashed border-gray-200">
                    <p class="text-gray-500 mb-6"><?php esc_html_e( 'Nenhum post encontrado no momento.', 'icddh' ); ?></p>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="text-primary-700 font-bold bg-white px-6 py-2 rounded-full shadow-sm hover:shadow-md transition-all">Voltar ao Início</a>
                </div>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php get_footer(); ?>
