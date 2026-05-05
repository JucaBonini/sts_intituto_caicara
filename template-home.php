<?php
/**
 * Template Name: Página Inicial (Landing Page)
 * Description: Template customizado para a Home do ICDDH.
 */

get_header(); ?>

<main id="primary" class="site-main">
    <!-- ========== HERO ========== -->
    <section id="inicio" class="hero-wave pt-12 pb-20 md:pt-20 md:pb-28 overflow-hidden">
        <div class="container mx-auto px-5 lg:px-8">
            <div class="flex flex-col lg:flex-row items-center gap-12">
                <div class="flex-1 text-center lg:text-left animate-fade-in">
                    <div class="inline-flex items-center gap-2 bg-primary-100 text-primary-800 rounded-full px-4 py-1.5 text-sm font-medium mb-5">
                        <span class="relative flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-primary-500 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-primary-600"></span>
                        </span>
                        Fundado em 14 de dezembro de 2018
                    </div>
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold tracking-tight text-gray-900 leading-tight">
                        Instituto Caiçara de <span class="text-primary-600">Defesa dos Direitos Humanos</span>
                    </h1>
                    <p class="text-lg md:text-xl text-gray-600 mt-6 max-w-2xl mx-auto lg:mx-0">
                        Promovemos e defendemos os direitos humanos de crianças, adolescentes e jovens, com ações nas áreas de educação, cultura, esporte, meio ambiente e assistência social — sempre alinhados aos Objetivos de Desenvolvimento Sustentável (ODS/ONU).
                    </p>
                    <div class="flex flex-wrap gap-4 justify-center lg:justify-start mt-8">
                        <a href="#sobre" class="bg-primary-600 hover:bg-primary-700 text-white px-7 py-3 rounded-full font-semibold shadow-md transition-all hover:shadow-lg flex items-center gap-2">Conheça o ICDDH →</a>
                        <a href="#apoie" class="border-2 border-primary-300 text-primary-700 hover:bg-primary-50 px-7 py-3 rounded-full font-semibold transition-all">Seja voluntário</a>
                    </div>
                </div>
                <div class="flex-1 flex justify-center animate-float">
                    <div class="relative w-72 h-72 md:w-96 md:h-96 bg-gradient-to-tr from-primary-200 to-blue-50 rounded-full flex items-center justify-center shadow-xl p-12">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.webp" alt="<?php bloginfo( 'name' ); ?>" class="h-full w-auto object-contain opacity-95">
                        <div class="absolute -bottom-4 -right-4 bg-white rounded-full p-2 shadow-md">
                            <span class="bg-primary-100 text-primary-700 text-xs font-bold px-2 py-1 rounded-full">🌊 ICDDH</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php get_template_part('template-parts/banner-caicaras-home'); ?>

    <!-- ========== SOBRE / INSTITUTO ========== -->
    <section id="sobre" class="py-16 md:py-24 bg-white">
        <div class="container mx-auto px-5 lg:px-8">
            <div class="max-w-3xl mx-auto text-center mb-14 animate-fade-in">
                <span class="text-primary-600 font-semibold tracking-wide uppercase text-sm">O Instituto</span>
                <h2 class="text-3xl md:text-4xl font-bold mt-2 text-gray-900">Instituto Caiçara de Defesa dos Direitos Humanos</h2>
                <div class="w-20 h-1 bg-primary-500 mx-auto mt-4 rounded-full"></div>
            </div>
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div class="space-y-5 text-gray-600 text-lg animate-slide-up">
                    <p class="leading-relaxed">O <strong class="text-primary-700">ICDDH</strong> é uma Organização da Sociedade Civil, pessoa jurídica de direito privado, <strong>sem fins econômicos</strong>, constituído em Assembleia Geral de Fundação em <strong>14 de dezembro de 2018</strong>.</p>
                    <p class="leading-relaxed">Com sede em <strong>São Vicente/SP</strong> (R. Prof. André Retz, 283 - Esplanada dos Barreiros, São Vicente - SP, 11340-250), atua em todo o território brasileiro. Todo e qualquer resultado é integralmente aplicado na consecução de seus objetivos sociais, sem distribuição de lucros ou vantagens pessoais.</p>
                    <div class="flex items-center gap-3 pt-2">
                        <div class="h-12 w-12 rounded-full bg-primary-100 flex items-center justify-center"><span class="text-primary-700 text-xl">📅</span></div>
                        <div><span class="font-bold text-gray-800">CNPJ: 34.120.033/0001-97</span><br><span class="text-sm">Tempo indeterminado de atuação</span></div>
                    </div>
                </div>
                <div class="bg-gradient-to-br from-primary-50 to-white p-6 rounded-2xl shadow-lg border border-primary-100">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-white p-4 rounded-xl shadow-sm text-center">
                            <div class="text-3xl mb-1">🏝️</div>
                            <p class="font-semibold text-primary-800">Cultura Caiçara</p>
                            <p class="text-xs text-gray-500">Tradição e território</p>
                        </div>
                        <div class="bg-white p-4 rounded-xl shadow-sm text-center">
                            <div class="text-3xl mb-1">📚</div>
                            <p class="font-semibold text-primary-800">Educação Integral</p>
                            <p class="text-xs text-gray-500">Formal + não formal</p>
                        </div>
                        <div class="bg-white p-4 rounded-xl shadow-sm text-center">
                            <div class="text-3xl mb-1">🤝</div>
                            <p class="font-semibold text-primary-800">Assistência Social</p>
                            <p class="text-xs text-gray-500">Vínculos comunitários</p>
                        </div>
                        <div class="bg-white p-4 rounded-xl shadow-sm text-center">
                            <div class="text-3xl mb-1">🌎</div>
                            <p class="font-semibold text-primary-800">ODS/ONU</p>
                            <p class="text-xs text-gray-500">Desenvolvimento sustentável</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== OBJETIVOS ESPECÍFICOS ========== -->
    <section id="atuacao" class="py-16 md:py-24 bg-primary-50/30">
        <div class="container mx-auto px-5 lg:px-8">
            <div class="text-center mb-14">
                <span class="text-primary-600 font-semibold uppercase tracking-wide">Nossos objetivos</span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mt-2">Eixos de atuação</h2>
                <p class="text-gray-500 max-w-2xl mx-auto mt-3">Com base no artigo 5º do Estatuto Social — objetivos gerais e específicos.</p>
            </div>
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-white rounded-2xl p-6 shadow-md card-hover border border-gray-100">
                    <div class="w-12 h-12 bg-primary-100 rounded-xl flex items-center justify-center mb-5"><span class="text-primary-700 text-2xl">🎓</span></div>
                    <h3 class="text-xl font-bold text-gray-800">Educação e qualificação</h3>
                    <p class="text-gray-500 mt-2 leading-relaxed">Cursos técnicos, profissionalizantes, livres, inclusão digital, formação continuada de trabalhadores da educação, cultura e esporte.</p>
                </div>
                <div class="bg-white rounded-2xl p-6 shadow-md card-hover border border-gray-100">
                    <div class="w-12 h-12 bg-primary-100 rounded-xl flex items-center justify-center mb-5"><span class="text-primary-700 text-2xl">🎨</span></div>
                    <h3 class="text-xl font-bold text-gray-800">Arte, cultura e esporte</h3>
                    <p class="text-gray-500 mt-2 leading-relaxed">Dança, teatro, música, eventos esportivos, lazer e desenvolvimento intelectual. Valorização do patrimônio histórico e artístico.</p>
                </div>
                <div class="bg-white rounded-2xl p-6 shadow-md card-hover border border-gray-100">
                    <div class="w-12 h-12 bg-primary-100 rounded-xl flex items-center justify-center mb-5"><span class="text-primary-700 text-2xl">🌿</span></div>
                    <h3 class="text-xl font-bold text-gray-800">Meio ambiente e sustentabilidade</h3>
                    <p class="text-gray-500 mt-2 leading-relaxed">Defesa, preservação, educação ambiental e desenvolvimento sustentável, alinhado aos ODS.</p>
                </div>
                <div class="bg-white rounded-2xl p-6 shadow-md card-hover border border-gray-100">
                    <div class="w-12 h-12 bg-primary-100 rounded-xl flex items-center justify-center mb-5"><span class="text-primary-700 text-2xl">👧🏽</span></div>
                    <h3 class="text-xl font-bold text-gray-800">Infância, adolescência e juventude</h3>
                    <p class="text-gray-500 mt-2 leading-relaxed">Garantia de direitos com base na Constituição, na Convenção Internacional dos Direitos da Criança e no ECA. Combate ao trabalho infantil e situação de rua.</p>
                </div>
                <div class="bg-white rounded-2xl p-6 shadow-md card-hover border border-gray-100">
                    <div class="w-12 h-12 bg-primary-100 rounded-xl flex items-center justify-center mb-5"><span class="text-primary-700 text-2xl">🍲</span></div>
                    <h3 class="text-xl font-bold text-gray-800">Segurança alimentar</h3>
                    <p class="text-gray-500 mt-2 leading-relaxed">Estratégias para ampliar a segurança alimentar e nutricional em territórios vulneráveis.</p>
                </div>
                <div class="bg-white rounded-2xl p-6 shadow-md card-hover border border-gray-100">
                    <div class="w-12 h-12 bg-primary-100 rounded-xl flex items-center justify-center mb-5"><span class="text-primary-700 text-2xl">✊🏿</span></div>
                    <h3 class="text-xl font-bold text-gray-800">Igualdade racial e gênero</h3>
                    <p class="text-gray-500 mt-2 leading-relaxed">Fortalecimento de mulheres, população negra e grupos historicamente vulnerabilizados. Ações de articulação e mobilização.</p>
                </div>
            </div>
            <div class="mt-12 text-center text-sm text-gray-500 italic">
                + Promoção de políticas públicas, inclusão de pessoas com deficiência, apoio a movimentos de mulheres e defesa dos direitos humanos em todos os territórios.
            </div>
        </div>
    </section>

    <!-- ========== IMPACTO ========== -->
    <section id="impacto" class="py-16 md:py-24 bg-white">
        <div class="container mx-auto px-5 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="order-2 lg:order-1">
                    <span class="text-primary-600 font-semibold text-sm uppercase tracking-wider">Transparência e compromisso</span>
                    <h2 class="text-3xl md:text-4xl font-bold mt-2 text-gray-900 leading-tight">Gestão ética e impacto real</h2>
                    <p class="text-gray-600 mt-4 text-lg">O ICDDH adota práticas de gestão que coíbem benefícios ou vantagens pessoais nos processos decisórios. Não distribui resultados, sobras ou dividendos — tudo é reinvestido na missão social.</p>
                    <div class="grid grid-cols-2 gap-6 mt-8">
                        <div class="border-l-4 border-primary-500 pl-4">
                            <div class="text-3xl font-black text-primary-700">2018</div>
                            <div class="text-gray-600">ano de fundação</div>
                        </div>
                        <div class="border-l-4 border-primary-500 pl-4">
                            <div class="text-3xl font-black text-primary-700">Brasil</div>
                            <div class="text-gray-600">atuação nacional</div>
                        </div>
                        <div class="border-l-4 border-primary-500 pl-4">
                            <div class="text-3xl font-black text-primary-700">ODS/ONU</div>
                            <div class="text-gray-600">metas sustentáveis</div>
                        </div>
                        <div class="border-l-4 border-primary-500 pl-4">
                            <div class="text-3xl font-black text-primary-700">100%</div>
                            <div class="text-gray-600">sem fins lucrativos</div>
                        </div>
                    </div>
                </div>
                <div class="order-1 lg:order-2 bg-primary-50 rounded-3xl p-6 shadow-inner">
                    <div class="relative overflow-hidden rounded-2xl shadow-md h-[400px]">
                        <!-- Google Maps Iframe -->
                        <iframe 
                            width="100%" 
                            height="100%" 
                            style="border:0;" 
                            loading="lazy" 
                            allowfullscreen 
                            referrerpolicy="no-referrer-when-downgrade"
                            src="https://www.google.com/maps/embed/v1/place?key=SEU_GOOGLE_MAPS_API_KEY_AQUI&q=R.+Prof.+André+Retz,+283+-+Esplanada+dos+Barreiros,+São+Vicente+-+SP+11340-250">
                        </iframe>
                        <!-- Fallback Free Embed (caso não queira usar API Key agora) -->
                        <iframe 
                            width="100%" 
                            height="100%" 
                            style="border:0; position: absolute; top: 0; left: 0;" 
                            frameborder="0" 
                            scrolling="no" 
                            marginheight="0" 
                            marginwidth="0" 
                            src="https://maps.google.com/maps?q=R.%20Prof.%20Andr%C3%A9%20Retz%2C%20283%20-%20Esplanada%20dos%20Barreiros%2C%20S%C3%A3o%20Vicente%20-%20SP&t=&z=15&ie=UTF8&iwloc=&output=embed">
                        </iframe>
                        <div class="absolute bottom-4 left-4 right-4 flex justify-center">
                            <a href="https://www.google.com/maps/dir//R.+Prof.+André+Retz,+283+-+Esplanada+dos+Barreiros,+São+Vicente+-+SP,+11340-250/" target="_blank" class="bg-white text-primary-700 px-6 py-2.5 rounded-full font-bold shadow-xl flex items-center gap-2 hover:bg-primary-50 transition-all transform hover:-translate-y-1">
                                📍 Como Chegar via GPS
                            </a>
                        </div>
                    </div>
                    <p class="text-center text-sm text-gray-500 mt-4 italic">Nossa sede: R. Prof. André Retz, 283 | Aberto para a comunidade</p>
                </div>
            </div>
        </div>
    </section>
    <!-- ========== AGENDA SOCIAL NA HOME ========== -->
    <section id="agenda-home" class="py-16 md:py-24 bg-white border-t border-gray-100">
        <div class="container mx-auto px-5 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-6">
                <div class="max-w-2xl animate-fade-in">
                    <span class="text-primary-600 font-semibold uppercase tracking-wide text-sm">Programe-se Conosco</span>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mt-2 tracking-tight line-height-[1.1]">Próximos Eventos e Atividades</h2>
                    <p class="text-gray-500 mt-4 leading-relaxed">Fique por dentro das datas e locais de nossas próximas ações sociais, mutirões e encontros comunitários.</p>
                </div>
                <div>
                    <a href="<?php echo home_url('/painel?aba=agenda'); ?>" class="bg-primary-600 hover:bg-primary-700 text-white px-8 py-3 rounded-full font-bold shadow-xl transition-all transform hover:-translate-y-1 inline-flex items-center gap-2">
                        Ver Agenda Completa 🗓️
                    </a>
                </div>
            </div>

            <?php
            $agenda_home = new WP_Query( array(
                'post_type'      => 'agenda',
                'posts_per_page' => 6,
                'meta_key'       => '_ic_agenda_date',
                'orderby'        => 'meta_value',
                'order'          => 'ASC',
                // 'meta_query'     => array( array('key' => '_ic_agenda_date', 'value' => date('Y-m-d'), 'compare' => '>=', 'type' => 'DATE') ) // Opcional: mostrar apenas futuros
            ) );

            if ( $agenda_home->have_posts() ) :
            ?>
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8 md:gap-10">
                    <?php
                    while ( $agenda_home->have_posts() ) :
                        $agenda_home->the_post();
                        $e_date = get_post_meta( get_the_ID(), '_ic_agenda_date', true );
                        $e_time = get_post_meta( get_the_ID(), '_ic_agenda_time', true );
                        $e_loc  = get_post_meta( get_the_ID(), '_ic_agenda_location', true );
                        ?>
                        <article class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden hover:shadow-2xl transition-all duration-500 flex flex-col group relative">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <div class="aspect-[4/3] overflow-hidden relative">
                                    <?php the_post_thumbnail( 'large', array( 'class' => 'w-full h-full object-cover group-hover:scale-110 transition-transform duration-700' ) ); ?>
                                    <div class="absolute inset-x-0 bottom-0 h-1/2 bg-gradient-to-t from-gray-900/60 to-transparent"></div>
                                    <div class="absolute bottom-4 left-6">
                                        <span class="bg-white/20 backdrop-blur-md text-white text-[10px] font-black uppercase px-3 py-1.5 rounded-lg border border-white/30">
                                            <?php echo $e_time; ?>H
                                        </span>
                                    </div>
                                </div>
                            <?php else : ?>
                                <div class="aspect-[4/3] bg-primary-50 flex items-center justify-center text-4xl opacity-40">🗓️</div>
                            <?php endif; ?>
                            
                            <div class="p-8 flex-1 flex flex-col relative">
                                <div class="absolute -top-10 right-8 bg-white w-20 h-20 rounded-2xl shadow-xl flex flex-col items-center justify-center border border-gray-50 transform group-hover:-translate-y-2 transition-transform duration-500">
                                    <span class="text-gray-400 text-[10px] font-black uppercase"><?php echo date_i18n('M', strtotime($e_date)); ?></span>
                                    <span class="text-gray-900 text-3xl font-black leading-none"><?php echo date_i18n('d', strtotime($e_date)); ?></span>
                                </div>

                                <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-primary-600 transition-colors pr-16 line-clamp-2"><?php the_title(); ?></h3>
                                <p class="text-gray-400 text-sm leading-relaxed line-clamp-3 mb-6"><?php echo wp_trim_words(get_the_excerpt(), 15); ?></p>
                                
                                <div class="mt-auto pt-6 border-t border-gray-50 flex items-center justify-between">
                                    <div class="flex items-center gap-2 text-gray-500 text-xs font-bold">
                                        <span class="text-lg">📍</span> <?php echo $e_loc; ?>
                                    </div>
                                    <a href="<?php the_permalink(); ?>" class="w-10 h-10 bg-primary-50 rounded-full flex items-center justify-center text-primary-600 group-hover:bg-primary-600 group-hover:text-white transition-all transform group-hover:rotate-45">
                                        →
                                    </a>
                                </div>
                            </div>
                        </article>
                    <?php
                    endwhile;
                    wp_reset_postdata();
                    ?>
                </div>
            <?php else : ?>
                <div class="py-20 bg-gray-50 rounded-[3rem] border-2 border-dashed border-gray-200 text-center flex flex-col items-center gap-4">
                    <span class="text-5xl opacity-20">📭</span>
                    <p class="text-gray-400 font-bold italic tracking-tight uppercase">Nenhum evento agendado no momento.</p>
                    <p class="text-gray-300 text-xs">Volte em breve para conferir as novidades da nossa agenda.</p>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- ========== AÇÕES SOCIAIS NA HOME ========== -->
    <section id="acoes-home" class="py-16 md:py-24 bg-gray-50">
        <div class="container mx-auto px-5 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-6">
                <div class="max-w-2xl">
                    <span class="text-primary-600 font-semibold uppercase tracking-wide text-sm">Nosso Trabalho em Campo</span>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mt-2">Últimas Ações Sociais</h2>
                    <p class="text-gray-500 mt-4">Confira os projetos e eventos mais recentes realizados pelo Instituto em benefício da comunidade.</p>
                </div>
                <div>
                    <a href="<?php echo esc_url( home_url( '/acoes-sociais' ) ); ?>" class="text-primary-700 font-bold flex items-center gap-2 hover:gap-3 transition-all group">
                        Ver todas as ações 
                        <span class="bg-primary-100 p-2 rounded-full group-hover:bg-primary-600 group-hover:text-white transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </span>
                    </a>
                </div>
            </div>

            <?php
            $acoes_home = new WP_Query( array(
                'post_type'      => 'acao',
                'posts_per_page' => 6,
            ) );

            if ( $acoes_home->have_posts() ) :
            ?>
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    <?php
                    while ( $acoes_home->have_posts() ) :
                        $acoes_home->the_post();
                        $data_evento = get_post_meta( get_the_ID(), '_acao_data', true );
                        ?>
                        <article class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden card-hover flex flex-col group">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <div class="aspect-video overflow-hidden">
                                    <?php the_post_thumbnail( 'large', array( 'class' => 'w-full h-full object-cover group-hover:scale-105 transition-transform duration-500' ) ); ?>
                                </div>
                            <?php endif; ?>
                            <div class="p-6 flex-1 flex flex-col">
                                <?php if ( $data_evento ) : ?>
                                    <span class="text-[10px] font-bold text-primary-600 uppercase tracking-widest mb-2 flex items-center gap-1">
                                        <span class="w-1.5 h-1.5 bg-primary-500 rounded-full"></span>
                                        <?php echo date_i18n( get_option( 'date_format' ), strtotime( $data_evento ) ); ?>
                                    </span>
                                <?php endif; ?>
                                <h3 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2"><?php the_title(); ?></h3>
                                <div class="text-gray-500 text-xs mb-4 line-clamp-2"><?php the_excerpt(); ?></div>
                                <a href="<?php the_permalink(); ?>" class="mt-auto text-primary-700 font-bold text-xs flex items-center gap-1">
                                    Detalhes da ação →
                                </a>
                            </div>
                        </article>
                    <?php
                    endwhile;
                    wp_reset_postdata();
                    ?>
                </div>
            <?php else : ?>
                <div class="bg-white p-12 rounded-3xl border-2 border-dashed border-gray-200 text-center">
                    <p class="text-gray-400">Nenhuma ação social cadastrada ainda.</p>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- ========== DEPOIMENTO ========== -->
    <div class="bg-primary-900/5 py-12">
        <div class="container mx-auto px-5 lg:px-8 text-center">
            <div class="max-w-3xl mx-auto italic text-gray-700 text-xl font-medium">
                “Promover o desenvolvimento dos territórios, por meio de ações de assistência social, educativas, culturais, esportivas, lazer e saúde, apoiando crianças, adolescentes, jovens e suas famílias.”
            </div>
            <div class="mt-4 flex justify-center items-center gap-2">
                <div class="w-8 h-8 rounded-full bg-primary-300"></div>
                <span class="font-semibold text-primary-800">— Missão institucional do ICDDH (art. 4º)</span>
            </div>
        </div>
    </div>

    <!-- ========== APOIE ========== -->
    <section id="apoie" class="py-20 md:py-28 bg-gradient-to-r from-primary-800 to-primary-900 text-white">
        <div class="container mx-auto px-5 lg:px-8 text-center">
            <span class="bg-white/20 text-white text-sm rounded-full px-4 py-1 inline-block mb-4">✊🏽 Transforme vidas</span>
            <h2 class="text-3xl md:text-5xl font-bold max-w-3xl mx-auto">Junte-se à defesa dos direitos humanos</h2>
            <p class="text-primary-100 text-lg max-w-2xl mx-auto mt-4">Sua contribuição fortalece nossas ações nas áreas de educação, cultura, esporte, meio ambiente e assistência social — sempre com transparência e gestão ética.</p>
            <div class="flex flex-wrap justify-center gap-5 mt-10">
                <a href="#" class="bg-white text-primary-800 hover:bg-gray-100 px-8 py-3 rounded-full font-bold shadow-lg transition-all hover:scale-105 inline-flex items-center gap-2">💙 Doar agora</a>
                <a href="#" class="border-2 border-white/60 text-white hover:bg-white/10 px-8 py-3 rounded-full font-semibold transition-all">🤝 Voluntariado</a>
            </div>
            <div class="mt-12 flex flex-wrap justify-center gap-8 text-sm text-primary-100">
                <div class="flex items-center gap-2"><span>✅</span> Transparência total</div>
                <div class="flex items-center gap-2"><span>🌱</span> Sem fins lucrativos</div>
                <div class="flex items-center gap-2"><span>📢</span> Gestão ética</div>
            </div>
        </div>
    </section>
    <!-- ========== INSTAGRAM FEED SECTION ========== -->
    <section id="instagram-feed" class="py-20 bg-white overflow-hidden">
        <div class="container mx-auto px-5 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-center justify-between mb-12 gap-4">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 flex items-center gap-2">
                        <span class="text-primary-600">📸</span> Acompanhe no Instagram
                    </h2>
                    <p class="text-gray-500 mt-2">Veja nosso dia a dia e os bastidores das ações sociais.</p>
                </div>
                <a href="https://instagram.com/instituto.caicara" target="_blank" class="inline-flex items-center gap-2 text-primary-700 font-bold hover:gap-3 transition-all group">
                    @instituto.caicara
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>

            <!-- Instagram Grid - 6 columns on desktop -->
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-2 md:gap-4">
                <?php 
                // Representativos de um feed real - Idealmente integrar com plugin tipo Smash Balloon ou API futuramente
                $insta_placeholders = [
                    'https://placehold.co/400x400/eff6ff/3b82f6?text=Ação+Comunitária',
                    'https://placehold.co/400x400/eff6ff/3b82f6?text=Educação+Integral',
                    'https://placehold.co/400x400/eff6ff/3b82f6?text=Cultura+Caiçara',
                    'https://placehold.co/400x400/eff6ff/3b82f6?text=Meio+Ambiente',
                    'https://placehold.co/400x400/eff6ff/3b82f6?text=Assistência+Social',
                    'https://placehold.co/400x400/eff6ff/3b82f6?text=Direitos+Humanos'
                ];

                foreach($insta_placeholders as $img) : ?>
                <div class="relative group aspect-square overflow-hidden rounded-xl shadow-sm hover:shadow-md transition-all">
                    <img src="<?php echo $img; ?>" alt="Instagram Post" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    <div class="absolute inset-0 bg-primary-900/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <div class="flex gap-4 text-white font-bold text-sm">
                            <span class="flex items-center gap-1">❤️ 24</span>
                            <span class="flex items-center gap-1">💬 8</span>
                        </div>
                    </div>
                    <a href="https://instagram.com/instituto.caicara" target="_blank" class="absolute inset-0 z-10"></a>
                </div>
                <?php endforeach; ?>
            </div>

            <div class="mt-12 text-center">
                <a href="https://instagram.com/instituto.caicara" target="_blank" class="bg-gradient-to-tr from-pink-600 via-red-500 to-yellow-500 text-white px-8 py-3 rounded-full font-bold shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-1 inline-flex items-center gap-2">
                    Seguir no Instagram
                </a>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
