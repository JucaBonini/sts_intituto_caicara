<?php
/**
 * The template for displaying 404 pages (not found)
 */

get_header(); ?>

<main id="primary" class="site-main">
    <section class="error-404 not-found min-h-[60vh] flex items-center justify-center text-center">
        <div class="container mx-auto px-5 lg:px-8">
            <div class="max-w-2xl mx-auto py-16 animate-fade-in">
                <div class="text-9xl font-black text-primary-100 mb-4 select-none">404</div>
                <h1 class="page-title text-4xl font-extrabold text-gray-900 mb-6">Página não encontrada</h1>
                <p class="text-gray-600 text-lg mb-10 leading-relaxed">Sentimos muito, mas a página que você está procurando não existe ou foi movida. Verifique o URL ou volte para a página inicial.</p>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="bg-primary-600 hover:bg-primary-700 text-white px-8 py-4 rounded-full font-bold shadow-lg transition-all hover:scale-105 inline-flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                    Voltar para o Início
                </a>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
