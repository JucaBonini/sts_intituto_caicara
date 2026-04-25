<?php
/**
 * Template Name: Estatuto Social
 * Description: Página institucional clássica para exibição do Estatuto Social (Layout Sidebar).
 */

get_header(); ?>

<main id="primary" class="site-main bg-white">
    <!-- HERO SECTION -->
    <section class="bg-gray-50 py-16 md:py-24 border-b border-gray-100 relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-2 bg-primary-600"></div>
        <div class="container mx-auto px-5 lg:px-8 relative z-10">
            <div class="max-w-3xl animate-fade-in">
                <?php 
                $uploads = wp_get_upload_dir();
                $pdf_url = $uploads['baseurl'] . '/2026/04/Estatuto-Instituto-Caicara.pdf';
                ?>
                <span class="text-primary-700 font-black uppercase text-xs tracking-widest mb-4 inline-block">📁 Transparência Institucional</span>
                <h1 class="text-4xl md:text-6xl font-black text-gray-900 leading-tight mb-6 tracking-tight">Estatuto <span class="text-primary-600 underline decoration-primary-100 decoration-8 underline-offset-8">Social</span></h1>
                <p class="text-gray-700 text-lg md:text-xl font-medium leading-relaxed">Confira o documento que rege as diretrizes, objetivos e a governança do Instituto Caiçara de Defesa dos Direitos Humanos.</p>
                <div class="mt-8">
                    <a href="<?php echo esc_url($pdf_url); ?>" target="_blank" class="bg-primary-600 text-white px-8 py-3.5 rounded-full font-bold shadow-xl hover:bg-primary-700 transition-all flex items-center gap-2">
                        📄 Baixar Estatuto em PDF (Oficial)
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- ESTATUTO CONTENT -->
    <div class="container mx-auto px-5 lg:px-8 py-20">
        <div class="flex flex-col lg:flex-row gap-16">
            
            <!-- SIDEBAR NAV (DESKTOP) -->
            <aside class="lg:w-1/4 hidden lg:block sticky top-32 h-fit">
                <div class="bg-white border border-gray-100 rounded-3xl p-8 shadow-sm">
                    <h3 class="text-gray-900 font-bold mb-6 flex items-center gap-2">
                        <span class="text-primary-600">📌</span> Capítulos
                    </h3>
                    <nav class="flex flex-col space-y-4">
                        <a href="#cap1" class="text-sm font-bold text-gray-600 hover:text-primary-700 transition-colors uppercase tracking-widest pl-4 border-l-2 border-transparent hover:border-primary-500">I. Denominação e Sede</a>
                        <a href="#cap2" class="text-sm font-bold text-gray-600 hover:text-primary-700 transition-colors uppercase tracking-widest pl-4 border-l-2 border-transparent hover:border-primary-500">II. Objetivos e Fins</a>
                        <a href="#cap3" class="text-sm font-bold text-gray-600 hover:text-primary-700 transition-colors uppercase tracking-widest pl-4 border-l-2 border-transparent hover:border-primary-500">III. Quadro Social</a>
                        <a href="#cap4" class="text-sm font-bold text-gray-600 hover:text-primary-700 transition-colors uppercase tracking-widest pl-4 border-l-2 border-transparent hover:border-primary-500">IV. Gestão Ética</a>
                        <a href="#cap5" class="text-sm font-bold text-gray-600 hover:text-primary-700 transition-colors uppercase tracking-widest pl-4 border-l-2 border-transparent hover:border-primary-500">V. Certificações</a>
                    </nav>
                </div>
            </aside>

            <!-- TEXT CONTENT -->
            <article class="lg:w-3/4 max-w-4xl prose prose-lg prose-primary mx-auto lg:mx-0">
                
                <section id="cap1" class="mb-20 scroll-mt-40">
                    <div class="flex items-center gap-4 mb-8">
                        <span class="text-primary-600 font-black text-xl italic opacity-30">01.</span>
                        <h2 class="text-3xl font-black text-gray-900 tracking-tight uppercase m-0 leading-tight">Denominação, Sede e Fins</h2>
                    </div>
                    <div class="bg-primary-50/50 p-8 rounded-[2rem] border border-primary-50 mb-8 font-medium text-gray-700 leading-relaxed italic">
                        O Instituto Caiçara de Defesa dos Direitos Humanos (ICDDH) é uma Organização da Sociedade Civil (OSC), pessoa jurídica de direito privado, sem fins econômicos.
                    </div>
                    <p class="text-gray-600 leading-relaxed">
                        Sua sede administrativa está localizada em São Vicente/SP (R. Prof. André Retz, 283 - Esplanada dos Barreiros, São Vicente - SP, 11340-250). O instituto atua em todo o território nacional, com prazo de duração indeterminado, regendo-se pelo presente estatuto e disposições legais vigentes.
                    </p>
                </section>

                <hr class="border-gray-50 my-16">

                <section id="cap2" class="mb-20 scroll-mt-40">
                    <div class="flex items-center gap-4 mb-8">
                        <span class="text-primary-600 font-black text-xl italic opacity-30">02.</span>
                        <h2 class="text-3xl font-black text-gray-900 tracking-tight uppercase m-0 leading-tight">Objetivos e Finalidades</h2>
                    </div>
                    <p class="text-gray-600 mb-8 font-medium leading-relaxed">O Instituto tem por finalidade a promoção e defesa dos direitos humanos, mediante o desenvolvimento de atividades de natureza educacional, cultural, social e inclusiva.</p>
                    <ul class="space-y-4 list-none pl-0">
                        <li class="flex gap-4 items-start p-5 bg-white border border-gray-100 rounded-2xl shadow-sm hover:border-primary-200 transition-all">
                            <span class="text-2xl">🌱</span>
                            <div>
                                <strong class="text-gray-900 block mb-1">Promoção de Direitos</strong>
                                <span class="text-gray-700 text-sm font-medium italic leading-relaxed">Defesa e garantia dos direitos de crianças, adolescentes e jovens em vulnerabilidade social.</span>
                            </div>
                        </li>
                        <li class="flex gap-4 items-start p-5 bg-white border border-gray-100 rounded-2xl shadow-sm hover:border-primary-200 transition-all">
                            <span class="text-2xl">🎓</span>
                            <div>
                                <strong class="text-gray-900 block mb-1">Educação e Cultura</strong>
                                <span class="text-gray-700 text-sm font-medium italic leading-relaxed">Desenvolvimento de cursos técnicos, atividades artísticas e esportivas na comunidade.</span>
                            </div>
                        </li>
                        <li class="flex gap-4 items-start p-5 bg-white border border-gray-100 rounded-2xl shadow-sm hover:border-primary-200 transition-all">
                            <span class="text-2xl">🌎</span>
                            <div>
                                <strong class="text-gray-900 block mb-1">Sustentabilidade</strong>
                                <span class="text-gray-700 text-sm font-medium italic leading-relaxed">Ações alinhadas aos Objetivos de Desenvolvimento Sustentável da Organização das Nações Unidas.</span>
                            </div>
                        </li>
                    </ul>
                </section>

                <hr class="border-gray-50 my-16">

                <section id="cap3" class="mb-20 scroll-mt-40">
                    <div class="flex items-center gap-4 mb-8">
                        <span class="text-primary-600 font-black text-xl italic opacity-30">03.</span>
                        <h2 class="text-3xl font-black text-gray-900 tracking-tight uppercase m-0 leading-tight">Dos Sócios e Associados</h2>
                    </div>
                    <p class="text-gray-600 leading-relaxed font-inter">
                        O quadro social é composto por membros admitidos na forma prevista em estatuto, classificados em categorias: fundadores, efetivos, contribuintes e colaboradores, observados os respectivos direitos e deveres estabelecidos nas normas internas.
                    </p>
                </section>

                <hr class="border-gray-50 my-16">

                <section id="cap4" class="mb-20 scroll-mt-40">
                    <div class="flex items-center gap-4 mb-8">
                        <span class="text-primary-600 font-black text-xl italic opacity-30">04.</span>
                        <h2 class="text-3xl font-black text-gray-900 tracking-tight uppercase m-0 leading-tight text-primary-600">Gestão Ética e Transparência</h2>
                    </div>
                    <div class="grid md:grid-cols-2 gap-8 mt-10">
                        <div class="p-8 bg-gray-900 text-white rounded-[2.5rem] shadow-2xl relative overflow-hidden group">
                            <div class="absolute -right-10 -bottom-10 w-24 h-24 bg-primary-600/20 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-700"></div>
                            <h4 class="text-primary-300 font-black uppercase text-[10px] tracking-widest mb-4">Reinvestimento Total</h4>
                            <p class="text-sm font-medium leading-relaxed italic italic">Qualquer superávit é integralmente reinvestido na manutenção e desenvolvimento de nossos projetos sociais nacionais.</p>
                        </div>
                        <div class="p-8 bg-gray-50 border border-gray-100 rounded-[2.5rem] shadow-sm italic text-gray-700 font-medium leading-relaxed">
                             O estatuto proíbe terminantemente a distribuição de lucros, resultados, dividendos ou vantagens a seus associados e dirigentes.
                        </div>
                    </div>
                </section>

                <section id="cap5" class="mb-20 scroll-mt-40">
                    <div class="flex items-center gap-4 mb-10">
                        <span class="text-primary-600 font-black text-xl italic opacity-30">05.</span>
                        <h2 class="text-3xl font-black text-gray-900 tracking-tight uppercase m-0 leading-tight tracking-tighter">Certificações e Registros Oficiais</h2>
                    </div>
                    <div class="grid md:grid-cols-2 gap-6">
                        <?php
                        $certs_query = new WP_Query(array(
                            'post_type' => 'certificacao',
                            'posts_per_page' => -1,
                            'orderby' => 'menu_order',
                            'order' => 'ASC'
                        ));

                        if ($certs_query->have_posts()) :
                            while ($certs_query->have_posts()) : $certs_query->the_post();
                                ?>
                                <div class="p-6 bg-white border border-gray-100 rounded-3xl shadow-sm hover:border-primary-200 transition-all flex items-center gap-5 group">
                                    <div class="w-14 h-14 bg-primary-50 rounded-2xl flex items-center justify-center text-2xl flex-shrink-0 group-hover:scale-110 transition-transform">📜</div>
                                    <div>
                                        <h4 class="text-sm font-black uppercase text-gray-900 tracking-widest mb-1 leading-tight"><?php the_title(); ?></h4>
                                        <div class="text-[10px] text-gray-600 font-medium italic italic">
                                            <?php echo get_the_excerpt(); ?>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            endwhile;
                            wp_reset_postdata();
                        else :
                            echo '<p class="text-gray-600 text-sm italic">Nenhuma certificação cadastrada ainda.</p>';
                        endif;
                        ?>
                    </div>
                </section>

                <!-- FOOTER PAGE -->
                <div class="mt-20 pt-10 border-t-2 border-gray-100 flex flex-col md:flex-row justify-between items-center gap-6">
                    <div class="text-center md:text-left">
                        <p class="text-gray-600 text-[10px] font-black uppercase tracking-widest mb-1 italic">Atualizado em:</p>
                        <p class="text-gray-900 font-bold italic tracking-tight">Janeiro de 2026</p>
                    </div>
                    <div class="flex flex-col items-end gap-1">
                        <p class="text-gray-600 text-[10px] font-black uppercase tracking-widest italic leading-none">CNPJ: 34.120.033/0001-97</p>
                        <a href="mailto:contato@icddh.org.br" class="text-primary-700 font-bold text-sm hover:underline decoration-primary-200">contato@icddh.org.br</a>
                    </div>
                </div>

            </article>

        </div>
    </div>
</main>

<?php get_footer(); ?>
