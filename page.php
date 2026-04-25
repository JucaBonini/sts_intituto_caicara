<?php
/**
 * The template for displaying all pages
 */

get_header(); ?>

<main id="primary" class="site-main bg-white min-h-[60vh]">
    <?php
    while ( have_posts() ) :
        the_post();
        ?>
        <!-- PAGE HEADER -->
        <header class="bg-gray-50 py-16 md:py-24 border-b border-gray-100 mb-16 animate-fade-in">
            <div class="container mx-auto px-5 lg:px-8">
                <div class="max-w-4xl mx-auto text-center">
                    <h1 class="text-4xl md:text-5xl font-black text-gray-900 tracking-tighter leading-tight mb-6 italic">
                        <?php the_title(); ?>
                    </h1>
                    <div class="w-20 h-1.5 bg-primary-600 mx-auto rounded-full shadow-lg shadow-primary-100"></div>
                </div>
            </div>
        </header>

        <!-- PAGE CONTENT -->
        <div class="container mx-auto px-5 lg:px-8 pb-32">
            <article id="post-<?php the_ID(); ?>" <?php post_class('prose-icddh max-w-4xl mx-auto animate-slide-up'); ?>>
                <?php if ( has_post_thumbnail() ) : ?>
                    <div class="post-thumbnail mb-12 overflow-hidden rounded-[2.5rem] shadow-2xl border border-gray-100">
                        <?php the_post_thumbnail( 'large', array( 'class' => 'w-full h-auto' ) ); ?>
                    </div>
                <?php endif; ?>

                <div class="entry-content">
                    <?php the_content(); ?>
                </div>
            </article>
        </div>
    <?php
    endwhile; 
    ?>
</main>

<?php get_footer(); ?>
