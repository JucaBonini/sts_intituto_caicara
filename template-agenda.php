<?php
/**
 * Template Name: Agenda de Eventos
 * Description: Página pública para visualização da Agenda Social do Instituto.
 */

get_header(); ?>

<main id="primary" class="site-main bg-gray-50/50 min-h-screen pb-24">
    <!-- HERO SECTION -->
    <section class="bg-primary-900 text-white py-12 md:py-20 lg:py-24 relative overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none" fill="none">
                <circle cx="50" cy="50" r="40" stroke="currentColor" stroke-width="0.5"></circle>
                <circle cx="20" cy="80" r="20" stroke="currentColor" stroke-width="0.5"></circle>
            </svg>
        </div>
        <div class="container mx-auto px-5 lg:px-8 relative z-10">
            <div class="max-w-3xl">
                <span class="bg-primary-500/20 text-primary-200 px-4 py-1.5 rounded-full text-xs font-black uppercase tracking-widest mb-6 inline-block border border-white/10 backdrop-blur-sm">📅 Calendário ICDDH</span>
                <h1 class="text-4xl md:text-6xl font-black tracking-tight mb-6 mt-2 leading-[1.1]">Nossa <span class="text-primary-400">Agenda Social</span></h1>
                <p class="text-primary-100/80 text-lg md:text-xl leading-relaxed font-medium">Fique por dentro das datas, horários e locais de todas as nossas atividades e ações comunitárias em Bertioga e região.</p>
            </div>
        </div>
    </section>

    <!-- CALENDAR CONTENT -->
    <div class="container mx-auto px-5 lg:px-8 -mt-10 relative z-20">
        
        <?php
        $args = array(
            'post_type'      => 'agenda',
            'posts_per_page' => -1,
            'meta_key'       => '_ic_agenda_date',
            'orderby'        => 'meta_value',
            'order'          => 'ASC'
        );
        $query = new WP_Query($args);
        
        if ($query->have_posts()) :
            $events_by_month = array();
            
            while ($query->have_posts()) : $query->the_post();
                $date = get_post_meta(get_the_ID(), '_ic_agenda_date', true);
                if ($date) {
                    $month_year = date_i18n('F Y', strtotime($date));
                    $events_by_month[$month_year][] = array(
                        'id' => get_the_ID(),
                        'title' => get_the_title(),
                        'date' => $date,
                        'time' => get_post_meta(get_the_ID(), '_ic_agenda_time', true),
                        'location' => get_post_meta(get_the_ID(), '_ic_agenda_location', true),
                        'address' => get_post_meta(get_the_ID(), '_ic_agenda_address', true),
                        'content' => get_the_excerpt(),
                        'image' => get_the_post_thumbnail_url(get_the_ID(), 'large'),
                        'link' => get_the_permalink()
                    );
                }
            endwhile;
            wp_reset_postdata();
            ?>

            <!-- MONTHLY NAVIGATION (STICKY TABS) -->
            <div class="flex flex-wrap items-center justify-center gap-2 mb-16 sticky top-[80px] z-30 bg-white/40 backdrop-blur-xl p-3 rounded-full shadow-2xl border border-white/50 max-w-fit mx-auto transition-all duration-300 transform">
                <?php foreach(array_keys($events_by_month) as $m) : ?>
                    <a href="#<?php echo sanitize_title($m); ?>" class="px-6 py-3 rounded-full text-[10px] font-black uppercase tracking-widest text-gray-500 hover:bg-primary-600 hover:text-white transition-all">
                        <?php echo explode(' ', $m)[0]; ?>
                    </a>
                <?php endforeach; ?>
            </div>

            <!-- EVENTS GRID BY MONTH -->
            <div class="space-y-32">
                <?php foreach($events_by_month as $month => $events) : ?>
                    <section id="<?php echo sanitize_title($month); ?>" class="animate-fade-in scroll-mt-48">
                        <div class="flex items-center gap-8 mb-16">
                            <h2 class="text-4xl font-black text-gray-900 uppercase tracking-tighter"><?php echo $month; ?></h2>
                            <div class="h-[1px] flex-1 bg-gradient-to-r from-primary-600 to-transparent opacity-20"></div>
                            <div class="hidden md:flex gap-2 text-primary-200">
                                <span class="w-2 h-2 rounded-full border border-current"></span>
                                <span class="w-16 h-[1px] bg-current my-auto"></span>
                                <span class="w-2 h-2 rounded-full bg-current"></span>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
                            <?php foreach($events as $e) : ?>
                                <article class="bg-white rounded-[3rem] shadow-sm border border-gray-100 overflow-hidden hover:shadow-2xl transition-all duration-700 flex flex-col group h-full relative">
                                    
                                    <!-- IMAGE AREA -->
                                    <div class="aspect-[1.2/1] overflow-hidden relative">
                                        <?php if($e['image']) : ?>
                                            <img src="<?php echo $e['image']; ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-1000" alt="<?php echo $e['title']; ?>">
                                        <?php else: ?>
                                            <div class="w-full h-full bg-gradient-to-br from-primary-50 to-primary-100 flex items-center justify-center text-7xl opacity-40">🏝️</div>
                                        <?php endif; ?>
                                        
                                        <!-- DATE OVERLAY -->
                                        <div class="absolute top-8 left-8">
                                            <div class="bg-white/95 backdrop-blur-md w-14 h-14 rounded-2xl flex flex-col items-center justify-center shadow-2xl border border-white transform -rotate-3 group-hover:rotate-0 transition-transform">
                                                <span class="text-[9px] font-black text-primary-600 uppercase mb-0.5"><?php echo date_i18n('M', strtotime($e['date'])); ?></span>
                                                <span class="text-2xl font-black text-gray-900 leading-none"><?php echo date_i18n('d', strtotime($e['date'])); ?></span>
                                            </div>
                                        </div>

                                        <!-- TIME BADGE -->
                                        <?php if($e['time']) : ?>
                                            <div class="absolute bottom-6 left-8">
                                                <span class="bg-gray-900/40 backdrop-blur-md text-white text-[9px] font-black uppercase px-5 py-2.5 rounded-xl border border-white/20">
                                                    Horário: <?php echo $e['time']; ?>H
                                                </span>
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <!-- CONTENT AREA -->
                                    <div class="p-10 flex-1 flex flex-col relative">
                                        <h3 class="text-2xl font-bold text-gray-900 mb-6 group-hover:text-primary-600 transition-colors leading-[1.2]"><?php echo $e['title']; ?></h3>
                                        
                                        <div class="space-y-4 mb-8">
                                            <div class="flex items-start gap-4">
                                                <span class="text-2xl mt-0.5">📍</span>
                                                <div>
                                                    <p class="text-[13px] font-black text-gray-800 uppercase tracking-tight"><?php echo $e['location']; ?></p>
                                                    <p class="text-[11px] text-gray-400 mt-0.5 font-medium leading-relaxed"><?php echo $e['address']; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="mt-auto pt-8 border-t border-gray-100 flex items-center justify-between">
                                            <div class="flex gap-2">
                                                <?php 
                                                $google_cal_url = "https://www.google.com/calendar/render?action=TEMPLATE&text=" . urlencode($e['title']) . "&dates=" . date('Ymd', strtotime($e['date'])) . "/" . date('Ymd', strtotime($e['date'])) . "&details=" . urlencode($e['content']) . "&location=" . urlencode($e['address']);
                                                ?>
                                                <a href="<?php echo $google_cal_url; ?>" target="_blank" class="px-6 py-3 bg-primary-50 rounded-2xl text-[10px] font-black uppercase tracking-widest text-primary-700 hover:bg-primary-600 hover:text-white transition-all shadow-sm hover:shadow-lg" title="Adicionar ao meu Google Agenda">
                                                    💾 Add Agenda
                                                </a>
                                            </div>
                                            <a href="<?php echo $e['link']; ?>" class="w-12 h-12 rounded-full border-2 border-gray-100 flex items-center justify-center text-gray-300 hover:border-primary-600 hover:text-primary-600 transition-all font-bold text-xl group-hover:bg-primary-600 group-hover:text-white group-hover:border-primary-600 shadow-sm">
                                                →
                                            </a>
                                        </div>
                                    </div>
                                </article>
                            <?php endforeach; ?>
                        </div>
                    </section>
                <?php endforeach; ?>
            </div>

        <?php else : ?>
            <div class="bg-white rounded-[4rem] p-24 text-center border-2 border-dashed border-gray-100 max-w-4xl mx-auto shadow-2xl animate-fade-in group hover:border-primary-200 transition-all">
                <div class="w-32 h-32 bg-primary-50 rounded-full flex items-center justify-center text-6xl mx-auto mb-10 group-hover:scale-110 transition-transform">🏖️</div>
                <h3 class="text-3xl font-black text-gray-900 mb-4 tracking-tight">Em Breve Novas Datas</h3>
                <p class="text-gray-500 text-lg leading-relaxed font-medium">Estamos finalizando os detalhes das próximas ações sociais do ICDDH. <br>Fique ligado em nossas redes sociais!</p>
                <div class="mt-12">
                    <a href="<?php echo home_url(); ?>" class="bg-primary-600 text-white px-12 py-5 rounded-full font-black uppercase text-xs tracking-widest shadow-2xl shadow-primary-200 hover:bg-primary-700 transition-all inline-block hover:-translate-y-1">Voltar ao Início</a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>
