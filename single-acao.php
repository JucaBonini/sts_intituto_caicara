<?php
/**
 * The template for displaying all single social actions
 */

get_header(); ?>

<main id="primary" class="site-main">
    <?php
    while ( have_posts() ) :
        the_post();
        $data_evento = get_post_meta( get_the_ID(), '_acao_data', true );
        ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            
            <!-- Hero Post Section -->
            <header class="bg-primary-50 py-16 md:py-24 border-b border-primary-100 mb-12">
                <div class="container mx-auto px-5 lg:px-8 text-center animate-fade-in">
                    <div class="flex items-center justify-center gap-3 mb-6">
                        <span class="text-primary-600 font-bold bg-white px-4 py-1.5 rounded-full shadow-sm text-sm uppercase tracking-wide border border-primary-100 flex items-center gap-2">
                           ❤️ Ação Social
                        </span>
                        <?php if ( $data_evento ) : ?>
                            <span class="text-gray-500 font-medium bg-gray-100 px-4 py-1.5 rounded-full text-sm flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2-2v12a2 2 0 002 2z" />
                                </svg>
                                Realizada em: <?php echo date_i18n( get_option( 'date_format' ), strtotime( $data_evento ) ); ?>
                            </span>
                        <?php endif; ?>
                    </div>
                    <?php the_title( '<h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-gray-900 leading-tight">', '</h1>' ); ?>
                    <div class="w-24 h-1 bg-primary-500 mx-auto mt-6 rounded-full shadow-sm"></div>
                </div>
            </header>

            <div class="container mx-auto px-5 lg:px-8 pb-24">
                <div class="max-w-4xl mx-auto">
                    <!-- Featured Image -->
                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="post-thumbnail mb-12 overflow-hidden rounded-[2rem] shadow-2xl">
                            <?php the_post_thumbnail( 'full', array( 'class' => 'w-full h-auto' ) ); ?>
                        </div>
                    <?php endif; ?>

                    <!-- Content (Text and Gutenberg Gallery) -->
                    <div class="entry-content prose prose-lg prose-primary max-w-none text-gray-700 leading-relaxed space-y-8">
                        <?php
                        the_content();

                        // Custom Gallery Display (from metabox)
                        $gallery_ids = get_post_meta( get_the_ID(), '_acao_gallery_ids', true );
                        if ( ! empty( $gallery_ids ) ) :
                            $ids = explode( ',', $gallery_ids );
                            ?>
                            <div class="mt-16 pt-10 border-t border-gray-100 not-prose">
                                <h3 class="text-2xl font-bold text-gray-900 mb-8 flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    Galeria de Fotos
                                </h3>
                                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                                    <?php foreach ( $ids as $id ) : 
                                        $full_img = wp_get_attachment_image_url( $id, 'full' );
                                        $thumb_img = wp_get_attachment_image_url( $id, 'large' );
                                        if ( $thumb_img ) :
                                        ?>
                                        <a href="<?php echo esc_url( $full_img ); ?>" target="_blank" class="block overflow-hidden rounded-2xl shadow-sm hover:shadow-md transition-all group aspect-square">
                                            <img src="<?php echo esc_url( $thumb_img ); ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
                                        </a>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>


                    <!-- Compartilhamento ou Voltar -->
                    <div class="mt-20 pt-10 border-t border-gray-100">
                        <a href="<?php echo esc_url( get_post_type_archive_link( 'acao' ) ?: home_url( '/acoes-sociais' ) ); ?>" class="text-primary-700 font-bold bg-primary-50 px-8 py-3 rounded-full hover:bg-primary-100 transition inline-flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                            </svg>
                            Ver todas as Ações Sociais
                        </a>
                    </div>
                </div>
            </div>
        </article>
        <?php
    endwhile;
    ?>
</main>

<?php get_footer(); ?>
