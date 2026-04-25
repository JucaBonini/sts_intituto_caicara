<?php
/**
 * Template Name: Painel Admin
 * Description: Dashboard customizado para usuários do instituto.
 */

// Se o usuário não estiver logado, manda para a Home
if ( ! is_user_logged_in() ) {
    wp_redirect( home_url( '/entrar' ) ); 
    exit;
}

$user = wp_get_current_user();
$is_staff = ( current_user_can('editor') || current_user_can('administrator') );
$aba = $_GET['aba'] ?? 'geral';

// LOGICA DE PROCESSAMENTO DE EVENTO (AGENDA) - CRIAR OU EDITAR
if ($is_staff && isset($_POST['ic_save_agenda'])) {
    if ( ! isset( $_POST['ic_agenda_dash_nonce'] ) || ! wp_verify_nonce( $_POST['ic_agenda_dash_nonce'], 'ic_save_agenda_dash' ) ) {
        $msg = "Erro de segurança. Tente novamente.";
    } else {
        $event_id = isset($_POST['event_id']) ? intval($_POST['event_id']) : 0;
        
        $post_data = array(
            'post_title'    => sanitize_text_field($_POST['event_title']),
            'post_content'  => wp_kses_post($_POST['event_content']),
            'post_status'   => 'publish',
            'post_type'     => 'agenda',
        );

        if ($event_id > 0) {
            $post_data['ID'] = $event_id;
            $post_id = wp_update_post($post_data);
        } else {
            $post_data['post_author'] = get_current_user_id();
            $post_id = wp_insert_post($post_data);
        }
        
        if ($post_id) {
            update_post_meta($post_id, '_ic_agenda_date', sanitize_text_field($_POST['event_date']));
            update_post_meta($post_id, '_ic_agenda_time', sanitize_text_field($_POST['event_time']));
            update_post_meta($post_id, '_ic_agenda_location', sanitize_text_field($_POST['event_location']));
            update_post_meta($post_id, '_ic_agenda_address', sanitize_text_field($_POST['event_address']));
            
            // HANDLE IMAGE UPLOAD (Featured Image)
            if ( ! empty( $_FILES['event_thumbnail']['name'] ) ) {
                require_once( ABSPATH . 'wp-admin/includes/image.php' );
                require_once( ABSPATH . 'wp-admin/includes/file.php' );
                require_once( ABSPATH . 'wp-admin/includes/media.php' );
                
                $attachment_id = media_handle_upload( 'event_thumbnail', $post_id );
                if ( ! is_wp_error( $attachment_id ) ) {
                    set_post_thumbnail( $post_id, $attachment_id );
                }
            }
            
            wp_redirect(add_query_arg('aba', 'agenda', home_url('/painel')));
            exit;
        }
    }
}

// LOGICA DE PROCESSAMENTO DE CERTIFICAÇÃO (CRIAR, EDITAR OU DELETAR)
if ($is_staff && isset($_POST['ic_save_certificacao'])) {
    if ( ! isset( $_POST['ic_cert_dash_nonce'] ) || ! wp_verify_nonce( $_POST['ic_cert_dash_nonce'], 'ic_save_cert_dash' ) ) {
        $msg = "Erro de segurança.";
    } else {
        $cert_id = isset($_POST['cert_id']) ? intval($_POST['cert_id']) : 0;
        $post_data = array(
            'post_title'    => sanitize_text_field($_POST['cert_title']),
            'post_excerpt'  => sanitize_textarea_field($_POST['cert_excerpt']),
            'post_status'   => 'publish',
            'post_type'     => 'certificacao',
        );
        if ($cert_id > 0) {
            $post_data['ID'] = $cert_id;
            wp_update_post($post_data);
        } else {
            wp_insert_post($post_data);
        }
        wp_redirect(add_query_arg('aba', 'certificacoes', home_url('/painel')));
        exit;
    }
}

if ($is_staff && isset($_GET['del_cert'])) {
    $del_id = intval($_GET['del_cert']);
    if (get_post_type($del_id) === 'certificacao') {
        wp_delete_post($del_id);
        wp_redirect(add_query_arg('aba', 'certificacoes', home_url('/painel')));
        exit;
    }
}

// LOGICA DE PROCESSAMENTO DE RECURSO (CRIAR, EDITAR OU DELETAR)
if ($is_staff && isset($_POST['ic_save_recurso'])) {
    if ( ! isset( $_POST['ic_recurso_dash_nonce'] ) || ! wp_verify_nonce( $_POST['ic_recurso_dash_nonce'], 'ic_save_recurso_dash' ) ) {
        $msg = "Erro de segurança.";
    } else {
        $recurso_id = isset($_POST['recurso_id']) ? intval($_POST['recurso_id']) : 0;
        $post_data = array(
            'post_title'    => sanitize_text_field($_POST['recurso_title']),
            'post_excerpt'  => sanitize_textarea_field($_POST['recurso_excerpt']),
            'post_status'   => 'publish',
            'post_type'     => 'recurso',
        );
        if ($recurso_id > 0) {
            $post_data['ID'] = $recurso_id;
            wp_update_post($post_data);
        } else {
            $recurso_id = wp_insert_post($post_data);
        }
        
        if($recurso_id) {
            update_post_meta($recurso_id, '_ic_recurso_link', esc_url_raw($_POST['recurso_link']));
            update_post_meta($recurso_id, '_ic_recurso_icon', sanitize_text_field($_POST['recurso_icon']));
        }
        
        wp_redirect(add_query_arg('aba', 'recursos', home_url('/painel')));
        exit;
    }
}

if ($is_staff && isset($_GET['del_recurso'])) {
    $del_id = intval($_GET['del_recurso']);
    if (get_post_type($del_id) === 'recurso') {
        wp_delete_post($del_id);
        wp_redirect(add_query_arg('aba', 'recursos', home_url('/painel')));
        exit;
    }
}

// LOGICA DE PROCESSAMENTO DE BLOG (POSTS)
if ($is_staff && isset($_POST['ic_save_blog_post'])) {
    if ( ! isset( $_POST['ic_blog_dash_nonce'] ) || ! wp_verify_nonce( $_POST['ic_blog_dash_nonce'], 'ic_save_blog_dash' ) ) {
        $msg = "Erro de segurança.";
    } else {
        $blog_post_id = isset($_POST['blog_id']) ? intval($_POST['blog_id']) : 0;
        $post_data = array(
            'post_title'    => sanitize_text_field($_POST['blog_title']),
            'post_content'  => wp_kses_post($_POST['blog_content']),
            'post_status'   => 'publish',
            'post_type'     => 'post',
        );

        if ($blog_post_id > 0) {
            $post_data['ID'] = $blog_post_id;
            $post_id = wp_update_post($post_data);
        } else {
            $post_data['post_author'] = get_current_user_id();
            $post_id = wp_insert_post($post_data);
        }
        
        if ($post_id) {
            // CATEGORIAS
            if (isset($_POST['post_cats']) && is_array($_POST['post_cats'])) {
                $categories = array_map('intval', $_POST['post_cats']);
                wp_set_post_categories($post_id, $categories);
            }

            // IMAGEM DE DESTAQUE
            if ( ! empty( $_FILES['blog_thumbnail']['name'] ) ) {
                require_once( ABSPATH . 'wp-admin/includes/image.php' );
                require_once( ABSPATH . 'wp-admin/includes/file.php' );
                require_once( ABSPATH . 'wp-admin/includes/media.php' );
                $attachment_id = media_handle_upload( 'blog_thumbnail', $post_id );
                if ( ! is_wp_error( $attachment_id ) ) {
                    set_post_thumbnail( $post_id, $attachment_id );
                }
            }
            wp_redirect(add_query_arg('aba', 'posts', home_url('/painel')));
            exit;
        }
    }
}

if ($is_staff && isset($_GET['del_post'])) {
    $del_id = intval($_GET['del_post']);
    if (get_post_type($del_id) === 'post') {
        wp_delete_post($del_id);
        wp_redirect(add_query_arg('aba', 'posts', home_url('/painel')));
        exit;
    }
}

// LOGICA DE TESTE DE E-MAIL
if ($is_staff && isset($_GET['test_email'])) {
    $to = $user->user_email;
    $subject = '📡 Teste de Conectividade - ICDDH';
    $msg_body = '<h1>Olá, ' . $user->display_name . '!</h1><p>Se você está lendo isso, o sistema de e-mail do <strong>Instituto Caiçara</strong> está funcionando perfeitamente.</p><br><p>Equipe Técnica ICDDH</p>';
    $headers = array('Content-Type: text/html; charset=UTF-8');
    
    $sent = wp_mail($to, $subject, $msg_body, $headers);
    if ($sent) {
        $msg = "✅ E-mail de teste enviado para: " . $to;
    } else {
        $msg = "❌ Erro ao enviar. Verifique as configurações de SMTP.";
    }
}

get_header(); ?>

<div class="min-h-screen bg-gray-50 flex">
    <!-- BARRA LATERAL (SIDEBAR) -->
    <aside class="w-72 bg-white border-r border-gray-200 hidden lg:flex flex-col sticky top-[73px] h-[calc(100vh-73px)] shadow-sm">
        <div class="flex-1 px-6 py-10 space-y-8">
            
            <?php if ( $is_staff ) : ?>
                <!-- SIDEBAR PARA EDITORES / ADMINS -->
                <div>
                    <span class="text-xs font-bold text-gray-400 uppercase tracking-widest px-4 font-sans">Administração</span>
                    <nav class="mt-4 space-y-2">
                        <a href="?aba=geral" class="flex items-center gap-3 px-4 py-3 rounded-xl <?php echo ($aba == 'geral') ? 'bg-primary-600 text-white shadow-lg' : 'text-gray-600 hover:bg-primary-50'; ?> transition-all font-semibold">
                            <span class="text-xl">📊</span> Painel Geral
                        </a>
                        <a href="?aba=posts" class="flex items-center gap-3 px-4 py-3 rounded-xl <?php echo (in_array($aba, ['posts', 'post_novo'])) ? 'bg-primary-600 text-white shadow-lg' : 'text-gray-600 hover:bg-primary-50'; ?> transition-all font-semibold">
                            <span class="text-xl">✍️</span> Artigos / Notícias
                        </a>
                        <a href="?aba=acoes" class="flex items-center gap-3 px-4 py-3 rounded-xl <?php echo ($aba == 'acoes') ? 'bg-primary-600 text-white shadow-lg' : 'text-gray-600 hover:bg-primary-50'; ?> transition-all font-semibold">
                            <span class="text-xl">📢</span> Ações Sociais
                        </a>
                        <a href="?aba=agenda" class="flex items-center gap-3 px-4 py-3 rounded-xl <?php echo (in_array($aba, ['agenda', 'agenda_novo'])) ? 'bg-primary-600 text-white shadow-lg' : 'text-gray-600 hover:bg-primary-50'; ?> transition-all font-semibold">
                            <span class="text-xl">🗓️</span> Gestão de Agenda
                        </a>
                        <a href="?aba=aprovacoes" class="flex items-center gap-3 px-4 py-3 rounded-xl <?php echo ($aba == 'aprovacoes') ? 'bg-primary-600 text-white shadow-lg' : 'text-gray-600 hover:bg-primary-50'; ?> transition-all font-semibold">
                            <span class="text-xl">👥</span> Gestão de Membros
                        </a>
                        <a href="?aba=certificacoes" class="flex items-center gap-3 px-4 py-3 rounded-xl <?php echo (in_array($aba, ['certificacoes', 'certificacao_novo'])) ? 'bg-primary-600 text-white shadow-lg' : 'text-gray-600 hover:bg-primary-50'; ?> transition-all font-semibold">
                            <span class="text-xl">📜</span> Certificações
                        </a>
                        <a href="?aba=recursos" class="flex items-center gap-3 px-4 py-3 rounded-xl <?php echo (in_array($aba, ['recursos', 'recurso_novo'])) ? 'bg-primary-600 text-white shadow-lg' : 'text-gray-600 hover:bg-primary-50'; ?> transition-all font-semibold">
                            <span class="text-xl">📚</span> Gestão de Recursos
                        </a>
                    </nav>
                </div>
            <?php else : ?>
                <!-- SIDEBAR PARA ASSINANTES / APOIADORES -->
                <div>
                    <span class="text-xs font-bold text-gray-400 uppercase tracking-widest px-4">Minha Área</span>
                    <nav class="mt-4 space-y-2">
                        <a href="?aba=geral" class="flex items-center gap-3 px-4 py-3 rounded-xl <?php echo ($aba == 'geral') ? 'bg-primary-600 text-white shadow-lg' : 'text-gray-600 hover:bg-primary-50'; ?> transition-all font-semibold">
                            <span class="text-xl">🏠</span> Início / Impacto
                        </a>
                        <a href="?aba=agenda" class="flex items-center gap-3 px-4 py-3 rounded-xl <?php echo ($aba == 'agenda') ? 'bg-primary-600 text-white shadow-lg' : 'text-gray-600 hover:bg-primary-50'; ?> transition-all font-semibold">
                            <span class="text-xl">🗓️</span> Agenda Social
                        </a>
                        <a href="?aba=recursos" class="flex items-center gap-3 px-4 py-3 rounded-xl <?php echo ($aba == 'recursos') ? 'bg-primary-600 text-white shadow-lg' : 'text-gray-600 hover:bg-primary-50'; ?> transition-all font-semibold">
                            <span class="text-xl">📚</span> Materiais & PDFs
                        </a>
                    </nav>
                </div>
            <?php endif; ?>

            <div class="pt-10 border-t border-gray-100">
                <a href="<?php echo wp_logout_url( home_url() ); ?>" class="flex items-center gap-3 px-4 py-3 rounded-xl text-red-500 hover:bg-red-50 transition-all font-bold">
                    <span class="text-xl">🚪</span> Sair do Sistema
                </a>
            </div>
        </div>

        <div class="p-6 bg-gray-50 border-t border-gray-200">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-primary-100 flex items-center justify-center text-primary-700 font-bold text-lg uppercase shadow-sm">
                    <?php echo substr($user->display_name, 0, 1); ?>
                </div>
                <div class="overflow-hidden">
                    <p class="text-sm font-bold text-gray-900 truncate"><?php echo $user->display_name; ?></p>
                    <p class="text-[10px] text-gray-500 uppercase tracking-tight"><?php echo $is_staff ? 'Diretoria / Editor' : 'Apoiador / Assinante'; ?></p>
                </div>
            </div>
        </div>
    </aside>

    <!-- CONTEÚDO PRINCIPAL (MAIN) -->
    <main class="flex-1 p-6 md:p-10 lg:p-16">
        <?php 
        // OCULTAR CABEÇALHO GLOBAL EM ABAS QUE JÁ TEM SEU PRÓPRIO TÍTULO/BOTÃO
        $abas_com_header_proprio = array('posts', 'post_novo', 'recursos', 'recurso_novo', 'certificacoes', 'certificacao_novo');
        if ( !in_array($aba, $abas_com_header_proprio) ) : 
        ?>
        <header class="flex flex-col md:flex-row md:items-center justify-between mb-12 gap-4">
            <div>
                <h1 class="text-4xl font-black text-gray-900 tracking-tight">
                    <?php 
                        if ($is_staff) {
                            switch($aba) {
                                case 'acoes': echo "Ações Sociais"; break;
                                case 'agenda': echo "Gerenciar Agenda"; break;
                                case 'agenda_novo': echo "Criar Novo Evento"; break;
                                case 'aprovacoes': echo "Membros"; break;
                                default: echo "Olá, Coordenador(a)! 👋";
                            }
                        } else {
                            switch($aba) {
                                case 'agenda': echo "Agenda Social"; break;
                                default: echo "Olá, " . ($user->first_name ?: $user->display_name) . "! ✨";
                            }
                        }
                    ?>
                </h1>
                <p class="text-gray-500 mt-2 font-medium italic">
                    <?php echo $is_staff ? "Painel administrativo do Instituto Caiçara." : "Seja bem-vindo à sua área exclusiva de apoio ao Instituto."; ?>
                </p>
            </div>
            
            <?php if ($is_staff && $aba == 'agenda') : ?>
                <a href="?aba=agenda_novo" class="bg-primary-600 hover:bg-primary-700 text-white px-8 py-4 rounded-2xl font-bold shadow-xl transition-all transform hover:-translate-y-1 flex items-center gap-2">
                    ✨ Adicionar Evento
                </a>
            <?php endif; ?>
        </header>
        <?php endif; ?>

        <!-- DASHBOARD GERAL -->
        <?php if($aba == 'geral') : ?>
            
            <?php if (!$is_staff) : ?>
                <!-- MENSAGEM ESPECIAL PARA ASSINANTE -->
                <div class="mb-12 bg-gradient-to-r from-primary-600 to-primary-700 rounded-[2.5rem] p-10 text-white shadow-2xl relative overflow-hidden group">
                    <div class="relative z-10 space-y-4 max-w-xl">
                        <h2 class="text-3xl font-black">Você faz a diferença! 💛</h2>
                        <p class="text-primary-50 opacity-90 text-lg leading-relaxed">Obrigado por apoiar o ICDDH. Sua presença como assinante fortalece nossa luta pela justiça e direitos humanos em nossa região.</p>
                        <div class="pt-4 flex gap-4">
                            <a href="?aba=agenda" class="bg-white text-primary-700 px-6 py-3 rounded-xl font-bold text-sm shadow-lg hover:bg-primary-50 transition-all">Ver Agenda Social</a>
                            <a href="#" class="bg-primary-500/30 backdrop-blur-md text-white border border-white/20 px-6 py-3 rounded-xl font-bold text-sm hover:bg-primary-500/50 transition-all">Manual do Apoiador</a>
                        </div>
                    </div>
                    <div class="absolute right-10 top-1/2 -translate-y-1/2 opacity-10 grayscale brightness-200 text-[120px] font-black hidden lg:block">UNIDOS</div>
                </div>
            <?php endif; ?>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Card Stats 1 -->
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 flex flex-col justify-between group hover:border-primary-200 transition-all">
                    <span class="text-4xl group-hover:scale-110 transition-transform">🌍</span>
                    <div>
                        <h3 class="text-gray-400 font-bold uppercase text-[10px] tracking-widest mt-6">Impacto Social</h3>
                        <p class="text-4xl font-black text-gray-900 mt-2">120 <span class="text-lg font-medium text-gray-400">Pessoas</span></p>
                    </div>
                </div>
                <!-- Card Stats 2 -->
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 flex flex-col justify-between group hover:border-primary-200 transition-all">
                    <span class="text-4xl group-hover:scale-110 transition-transform">🤝</span>
                    <div>
                        <h3 class="text-gray-400 font-bold uppercase text-[10px] tracking-widest mt-6">Ações Concluídas</h3>
                        <p class="text-4xl font-black text-gray-900 mt-2"><?php echo wp_count_posts('acao')->publish; ?> <span class="text-lg font-medium text-gray-400">Total</span></p>
                    </div>
                </div>
                <!-- Card Stats 3 -->
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 flex flex-col justify-between group hover:border-primary-200 transition-all">
                    <span class="text-4xl group-hover:scale-110 transition-transform">💎</span>
                    <div>
                        <h3 class="text-gray-400 font-bold uppercase text-[10px] tracking-widest mt-6">Seu Nível de Apoio</h3>
                        <p class="text-2xl font-black text-primary-600 mt-2 uppercase">Membro Solidário</p>
                    </div>
                </div>
            </div>

            <!-- ÁREA DE FEEDS INTERNOS -->
            <div class="mt-12 grid grid-cols-1 lg:grid-cols-2 gap-8">
                <div class="bg-white p-6 md:p-10 rounded-[2rem] border border-gray-100 shadow-sm">
                    <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-2">✍️ Recentes no Blog</h3>
                    <div class="space-y-4">
                        <?php 
                        $recent_posts = get_posts(array('numberposts' => 3));
                        if($recent_posts) : 
                            foreach($recent_posts as $post) : setup_postdata($post); ?>
                                <a href="<?php the_permalink(); ?>" class="flex items-center gap-4 p-4 rounded-2xl hover:bg-gray-50 transition-all border border-transparent hover:border-gray-100">
                                    <div class="w-12 h-12 rounded-xl bg-primary-50 flex-shrink-0 flex items-center justify-center font-bold text-primary-600"><?php echo get_the_date('d'); ?></div>
                                    <div>
                                        <h4 class="font-bold text-gray-800 line-clamp-1"><?php the_title(); ?></h4>
                                        <p class="text-xs text-gray-400"><?php echo get_the_date(); ?></p>
                                    </div>
                                </a>
                            <?php endforeach; wp_reset_postdata(); 
                        else: ?>
                            <p class="text-gray-400 italic text-sm">Nenhuma notícia recente.</p>
                        <?php endif; ?>
                    </div>
                </div>
                
                <div class="bg-white p-6 md:p-10 rounded-[2rem] border border-gray-100 shadow-sm relative overflow-hidden">
                    <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-2">🎯 Próxima Ação Social</h3>
                    <?php 
                    $next_event = get_posts(array('post_type' => 'agenda', 'numberposts' => 1, 'meta_key' => '_ic_agenda_date', 'orderby' => 'meta_value', 'order' => 'ASC'));
                    if($next_event) : $e = $next_event[0]; 
                        $e_date = get_post_meta($e->ID, '_ic_agenda_date', true);
                        $e_loc = get_post_meta($e->ID, '_ic_agenda_location', true);
                    ?>
                        <div class="bg-amber-50 p-6 rounded-2xl border border-amber-100 relative z-10">
                            <p class="text-amber-700 font-bold text-lg"><?php echo $e->post_title; ?></p>
                            <p class="text-amber-600 text-sm mt-1 flex items-center gap-2">📅 <?php echo date('d/m/Y', strtotime($e_date)); ?> | 📍 <?php echo $e_loc; ?></p>
                            <a href="?aba=agenda" class="mt-4 block text-center w-full bg-amber-600 text-white py-3 rounded-xl text-xs font-black uppercase tracking-widest shadow-md hover:bg-amber-700 transition-all">Ver Detalhes</a>
                        </div>
                    <?php else: ?>
                        <div class="p-10 border-2 border-dashed border-gray-100 rounded-3xl text-center text-gray-300 italic">Nenhum evento agendado.</div>
                    <?php endif; ?>
                </div>
            </div>

        <?php elseif($aba == 'agenda') : ?>
            <!-- VISUALIZAÇÃO DA AGENDA (DINÂMICA) -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php 
                $args = array('post_type' => 'agenda', 'posts_per_page' => 9);
                $agenda_query = new WP_Query($args);
                
                if($agenda_query->have_posts()) : 
                    while($agenda_query->have_posts()) : $agenda_query->the_post(); 
                        $e_date = get_post_meta(get_the_ID(), '_ic_agenda_date', true);
                        $e_time = get_post_meta(get_the_ID(), '_ic_agenda_time', true);
                        $e_loc = get_post_meta(get_the_ID(), '_ic_agenda_location', true);
                        $e_addr = get_post_meta(get_the_ID(), '_ic_agenda_address', true);
                ?>
                    <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100 hover:shadow-xl transition-all group overflow-hidden relative">
                        <div class="absolute top-0 left-0 w-2 h-full bg-primary-600"></div>
                        <div class="flex justify-between items-start mb-6">
                            <span class="bg-primary-50 text-primary-700 px-4 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest">
                                <?php echo date('M', strtotime($e_date)); ?> <?php echo date('d', strtotime($e_date)); ?>
                            </span>
                            <span class="text-gray-400 text-xs font-bold"><?php echo $e_time; ?>h</span>
                        </div>
                        <h4 class="text-xl font-bold text-gray-900 group-hover:text-primary-600 transition-colors"><?php the_title(); ?></h4>
                        <div class="mt-4 space-y-2">
                            <p class="text-sm text-gray-500 flex items-center gap-2 italic">📍 <?php echo $e_loc; ?></p>
                            <p class="text-[11px] text-gray-400 line-clamp-1"><?php echo $e_addr; ?></p>
                        </div>
                        
                        <?php if($is_staff) : ?>
                            <div class="mt-6 pt-6 border-t border-gray-50 flex gap-4">
                                <a href="?aba=agenda_novo&num=<?php the_ID(); ?>" class="text-[10px] font-bold text-primary-600 uppercase tracking-widest hover:underline flex items-center gap-1">
                                    <span>✏️</span> Editar
                                </a>
                                <a href="<?php echo get_delete_post_link(get_the_ID()); ?>" class="text-[10px] font-bold text-red-400 uppercase tracking-widest hover:underline flex items-center gap-1">
                                    <span>🗑️</span> Excluir
                                </a>
                            </div>
                        <?php else : ?>
                            <button class="mt-8 w-full bg-gray-900 text-white py-4 rounded-2xl text-[10px] font-black uppercase tracking-widest shadow-xl hover:bg-primary-600 transition-all">Quero Participar</button>
                        <?php endif; ?>
                    </div>
                <?php endwhile; wp_reset_postdata(); else: echo "<p class='col-span-full italic text-gray-400'>Nenhum evento.</p>"; endif; ?>
            </div>

        <?php elseif($aba == 'agenda_novo' && $is_staff) : ?>
            <!-- FORMULÁRIO DE NOVO/EDITAR EVENTO -->
            <?php 
            $edit_id = isset($_GET['num']) ? intval($_GET['num']) : 0;
            $e_data = $edit_id ? get_post($edit_id) : null;
            $v_title = $e_data ? $e_data->post_title : '';
            $v_content = $e_data ? $e_data->post_content : '';
            $v_date = $edit_id ? get_post_meta($edit_id, '_ic_agenda_date', true) : '';
            $v_time = $edit_id ? get_post_meta($edit_id, '_ic_agenda_time', true) : '';
            $v_loc = $edit_id ? get_post_meta($edit_id, '_ic_agenda_location', true) : '';
            $v_addr = $edit_id ? get_post_meta($edit_id, '_ic_agenda_address', true) : '';
            ?>
            <div class="max-w-4xl bg-white rounded-[2.5rem] shadow-2xl p-10 md:p-16 border border-gray-100 animate-fade-in mx-auto">
                <div class="flex items-center gap-4 mb-10">
                    <div class="w-16 h-16 bg-primary-100 rounded-3xl flex items-center justify-center text-3xl"><?php echo $edit_id ? '✏️' : '🗓️'; ?></div>
                    <div>
                        <h2 class="text-3xl font-black text-gray-900 tracking-tight"><?php echo $edit_id ? 'Editar Evento' : 'Novo Evento Social'; ?></h2>
                        <p class="text-gray-400 font-medium"><?php echo $edit_id ? 'Atualize as informações do evento selecionado.' : 'Preencha os detalhes para publicar na agenda.'; ?></p>
                    </div>
                </div>

                <form action="" method="POST" enctype="multipart/form-data" class="space-y-8">
                    <?php wp_nonce_field( 'ic_save_agenda_dash', 'ic_agenda_dash_nonce' ); ?>
                    <input type="hidden" name="ic_save_agenda" value="1">
                    <?php if($edit_id) : ?><input type="hidden" name="event_id" value="<?php echo $edit_id; ?>"><?php endif; ?>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="col-span-full space-y-2">
                            <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Título do Evento</label>
                            <input type="text" name="event_title" value="<?php echo esc_attr($v_title); ?>" required class="w-full bg-gray-50 border-none rounded-2xl p-5 focus:ring-2 focus:ring-primary-600 transition-all font-bold text-gray-900 placeholder-gray-300 shadow-inner" placeholder="Ex: Mutirão de Limpeza na Praia">
                        </div>

                        <div class="col-span-full space-y-2">
                            <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Imagem de Destaque (Capa)</label>
                            <?php if ($edit_id && has_post_thumbnail($edit_id)) : ?>
                                <div class="mb-4 relative w-32 h-32 rounded-2xl overflow-hidden border-2 border-primary-100 shadow-lg">
                                    <?php echo get_the_post_thumbnail($edit_id, 'thumbnail', array('class' => 'w-full h-full object-cover')); ?>
                                </div>
                            <?php endif; ?>
                            <label class="block w-full cursor-pointer">
                                <div class="w-full bg-gray-50 border-2 border-dashed border-gray-200 rounded-2xl p-8 text-center hover:bg-primary-50 hover:border-primary-300 transition-all group">
                                    <span class="text-3xl mb-2 block group-hover:scale-110 transition-transform">📸</span>
                                    <span class="text-xs font-bold text-gray-500 uppercase tracking-widest block"><?php echo $edit_id ? 'Trocar imagem atual' : 'Clique para selecionar imagem'; ?></span>
                                    <input type="file" name="event_thumbnail" accept="image/*" class="hidden">
                                </div>
                            </label>
                        </div>
                        
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Data</label>
                            <input type="date" name="event_date" value="<?php echo esc_attr($v_date); ?>" required class="w-full bg-gray-50 border-none rounded-2xl p-5 focus:ring-2 focus:ring-primary-600 transition-all font-bold text-gray-700 shadow-inner">
                        </div>

                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Horário</label>
                            <input type="time" name="event_time" value="<?php echo esc_attr($v_time); ?>" required class="w-full bg-gray-50 border-none rounded-2xl p-5 focus:ring-2 focus:ring-primary-600 transition-all font-bold text-gray-700 shadow-inner">
                        </div>

                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Cidade / Bairro</label>
                            <input type="text" name="event_location" value="<?php echo esc_attr($v_loc); ?>" class="w-full bg-gray-50 border-none rounded-2xl p-5 focus:ring-2 focus:ring-primary-600 transition-all font-bold text-gray-900 shadow-inner" placeholder="Bertioga, SP">
                        </div>

                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Endereço Completo</label>
                            <input type="text" name="event_address" value="<?php echo esc_attr($v_addr); ?>" class="w-full bg-gray-50 border-none rounded-2xl p-5 focus:ring-2 focus:ring-primary-600 transition-all font-bold text-gray-900 shadow-inner" placeholder="Rua exemplo, 123">
                        </div>

                        <div class="col-span-full space-y-2">
                            <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Descrição do Evento</label>
                            <textarea name="event_content" rows="4" class="w-full bg-gray-50 border-none rounded-2xl p-5 focus:ring-2 focus:ring-primary-600 transition-all font-medium text-gray-700 shadow-inner" placeholder="Conte mais detalhes..."><?php echo esc_textarea($v_content); ?></textarea>
                        </div>
                    </div>

                    <div class="flex gap-4 pt-6">
                        <button type="submit" class="flex-1 bg-primary-600 text-white py-6 rounded-3xl font-black uppercase tracking-widest shadow-2xl shadow-primary-200 hover:bg-primary-700 hover:-translate-y-1 transition-all">
                            <?php echo $edit_id ? 'Salvar Alterações ✅' : 'Publicar na Agenda 📨'; ?>
                        </button>
                        <a href="?aba=agenda" class="px-10 py-6 bg-gray-100 text-gray-500 rounded-3xl font-black uppercase tracking-widest hover:bg-gray-200 transition-all flex items-center">
                            Voltar
                        </a>
                    </div>
                </form>
            </div>

        <?php elseif($aba == 'aprovacoes' && $is_staff) : ?>
            <!-- GESTÃO DE MEMBROS (SOMENTE EDITOR) -->
            <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-8 border-b border-gray-50 flex justify-between items-center">
                    <h2 class="text-xl font-bold text-gray-800 tracking-tight">Gestão de Membros e Funções</h2>
                    <span class="bg-primary-100 text-primary-700 text-[10px] font-black uppercase px-3 py-1 rounded-full">Controle Staff</span>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-gray-50 uppercase text-[10px] font-bold text-gray-400 tracking-widest">
                            <tr>
                                <th class="px-8 py-5">Usuário</th>
                                <th class="px-8 py-5">E-mail</th>
                                <th class="px-8 py-5">Função</th>
                                <th class="px-8 py-5 text-right">Ação</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50 text-sm">
                            <?php 
                            $all_users = get_users(array('role__in' => array('editor', 'subscriber'), 'orderby' => 'display_name'));
                            foreach($all_users as $u) : 
                                if($u->ID == get_current_user_id()) continue;
                                $u_is_editor = in_array('editor', $u->roles);
                            ?>
                                <tr class="hover:bg-gray-50 transition-all">
                                    <td class="px-8 py-6 font-bold text-gray-900"><?php echo $u->display_name; ?></td>
                                    <td class="px-8 py-6 text-gray-500"><?php echo $u->user_email; ?></td>
                                    <td class="px-8 py-6"><span class="px-2 py-1 rounded-md <?php echo $u_is_editor ? 'bg-purple-100 text-purple-700' : 'bg-blue-100 text-blue-700'; ?> font-bold text-[10px]"><?php echo $u_is_editor ? 'EDITOR' : 'ASSINANTE'; ?></span></td>
                                    <td class="px-8 py-6 text-right">
                                        <button onclick="toggleUserRole(<?php echo $u->ID; ?>, '<?php echo $u_is_editor ? 'subscriber' : 'editor'; ?>')" class="text-xs font-bold text-primary-600 hover:bg-primary-50 px-4 py-2 rounded-lg transition-all border border-transparent hover:border-primary-100">Alternar Função</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <script>
            function toggleUserRole(userId, newRole) {
                if(!confirm('Deseja mudar a função deste membro?')) return;
                const formData = new FormData();
                formData.append('action', 'ic_change_user_role');
                formData.append('user_id', userId);
                formData.append('new_role', newRole);
                fetch('<?php echo admin_url('admin-ajax.php'); ?>', { method: 'POST', body: formData })
                .then(res => res.json()).then(data => data.success ? location.reload() : alert('Erro ao atualizar.'));
            }
            </script>
        
        <?php elseif($aba == 'certificacoes' && $is_staff) : ?>
            <!-- LISTA DE CERTIFICAÇÕES -->
            <div class="flex justify-end mb-8 relative z-20">
                <a href="?aba=certificacao_novo" class="bg-primary-600 text-white px-8 py-4 rounded-3xl font-black uppercase text-xs tracking-widest shadow-xl shadow-primary-100 hover:bg-primary-700 hover:-translate-y-1 transition-all">
                    ➕ Nova Certificação
                </a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 animate-fade-in relative z-10">
                <?php
                $certs = new WP_Query(array('post_type' => 'certificacao', 'posts_per_page' => -1));
                if ($certs->have_posts()) :
                    while ($certs->have_posts()) : $certs->the_post();
                        ?>
                        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100 hover:shadow-2xl transition-all duration-500 group flex flex-col justify-between">
                            <div>
                                <div class="w-14 h-14 bg-primary-50 rounded-2xl flex items-center justify-center text-2xl mb-6 group-hover:scale-110 transition-transform">📜</div>
                                <h4 class="text-lg font-black text-gray-900 tracking-tight leading-tight mb-2"><?php the_title(); ?></h4>
                                <p class="text-xs text-gray-400 font-medium italic mb-6"><?php echo get_the_excerpt(); ?></p>
                            </div>
                            <div class="flex items-center gap-2 pt-6 border-t border-gray-50 mt-auto">
                                <a href="?aba=certificacao_novo&edit_cert=<?php the_ID(); ?>" class="flex-1 bg-gray-50 text-gray-500 py-3 rounded-xl text-[10px] font-black uppercase tracking-widest text-center hover:bg-primary-50 hover:text-primary-600 transition-all">Editar</a>
                                <a href="?del_cert=<?php the_ID(); ?>" onclick="return confirm('Excluir esta certificação permanentemente?')" class="px-4 py-3 bg-red-50 text-red-500 rounded-xl text-[10px] font-black hover:bg-red-500 hover:text-white transition-all">🗑️</a>
                            </div>
                        </div>
                        <?php
                    endwhile;
                else :
                    echo '<div class="col-span-full p-20 text-center bg-white rounded-[3rem] border-2 border-dashed border-gray-100 italic text-gray-400">Nenhuma certificação cadastrada ainda. 👋</div>';
                endif;
                wp_reset_postdata();
                ?>
            </div>

        <?php elseif($aba == 'certificacao_novo' && $is_staff) : 
            $edit_id = isset($_GET['edit_cert']) ? intval($_GET['edit_cert']) : 0;
            $v_title = $edit_id ? get_the_title($edit_id) : '';
            $v_excerpt = $edit_id ? get_the_excerpt($edit_id) : '';
            ?>
            <!-- FORMULÁRIO DE CERTIFICAÇÃO -->
            <div class="max-w-2xl bg-white rounded-[2.5rem] shadow-2xl p-12 border border-gray-100 animate-slide-up mx-auto">
                <div class="flex items-center gap-4 mb-10">
                    <div class="w-16 h-16 bg-primary-100 rounded-3xl flex items-center justify-center text-3xl">🛡️</div>
                    <div>
                        <h2 class="text-2xl font-black text-gray-900 tracking-tight leading-tight uppercase tracking-tighter"><?php echo $edit_id ? 'Editar Registro' : 'Novo Registro Oficial'; ?></h2>
                        <p class="text-gray-400 text-sm font-medium">As informações aparecerão na página do Estatuto e no Rodapé.</p>
                    </div>
                </div>

                <form action="" method="POST" class="space-y-8">
                    <?php wp_nonce_field( 'ic_save_cert_dash', 'ic_cert_dash_nonce' ); ?>
                    <input type="hidden" name="ic_save_certificacao" value="1">
                    <?php if($edit_id) : ?><input type="hidden" name="cert_id" value="<?php echo $edit_id; ?>"><?php endif; ?>

                    <div class="space-y-4">
                        <label class="text-[10px] font-black uppercase text-gray-400 tracking-widest pl-4">Nome da Certificação / Título</label>
                        <input type="text" name="cert_title" value="<?php echo esc_attr($v_title); ?>" required class="w-full bg-gray-50 border-none rounded-2xl p-5 focus:ring-2 focus:ring-primary-600 transition-all font-bold text-gray-900 shadow-inner" placeholder="Ex: Utilidade Pública Municipal">
                    </div>

                    <div class="space-y-4">
                        <label class="text-[10px] font-black uppercase text-gray-400 tracking-widest pl-4 italic">Detalhes (Lei, Decreto ou Descrição)</label>
                        <textarea name="cert_excerpt" rows="3" required class="w-full bg-gray-50 border-none rounded-2xl p-5 focus:ring-2 focus:ring-primary-600 transition-all font-medium text-gray-700 shadow-inner" placeholder="Ex: Lei nº 1234/2024 - Registro no CMDCA nº 55"><?php echo esc_textarea($v_excerpt); ?></textarea>
                        <p class="text-[10px] text-gray-400 font-medium italic mt-2">Dica: No rodapé, o texto será encurtado se for muito longo.</p>
                    </div>

                    <div class="flex gap-4 pt-4">
                        <button type="submit" aria-label="<?php echo $edit_id ? 'Atualizar registro de certificação' : 'Salvar nova certificação'; ?>" class="flex-1 bg-primary-600 text-white py-5 rounded-2xl font-black uppercase text-xs tracking-widest shadow-xl shadow-primary-100 hover:bg-primary-700 hover:-translate-y-1 transition-all flex items-center justify-center gap-2">
                            <?php echo $edit_id ? 'Atualizar Registro' : 'Salvar Certificação'; ?>
                            <span class="text-lg">✅</span>
                        </button>
                        <a href="?aba=certificacoes" aria-label="Cancelar e voltar para lista" class="px-8 py-5 bg-gray-100 text-gray-500 rounded-2xl font-black uppercase text-xs tracking-widest hover:bg-gray-200 transition-all flex items-center">
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>

        <?php elseif($aba == 'recursos') : ?>
            <!-- BIBLIOTECA DE RECURSOS (DINÂMICA) -->
             <?php if($is_staff) : ?>
                <div class="flex justify-end mb-8 relative z-20">
                    <a href="?aba=recurso_novo" class="bg-primary-600 text-white px-8 py-4 rounded-3xl font-black uppercase text-xs tracking-widest shadow-xl shadow-primary-100 hover:bg-primary-700 hover:-translate-y-1 transition-all">
                        ➕ Adicionar Documento
                    </a>
                </div>
            <?php endif; ?>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 animate-fade-in relative z-10">
                <?php
                $recursos = new WP_Query(array('post_type' => 'recurso', 'posts_per_page' => -1));
                if ($recursos->have_posts()) :
                    while ($recursos->have_posts()) : $recursos->the_post();
                        $down_link = get_post_meta(get_the_ID(), '_ic_recurso_link', true);
                        $down_icon = get_post_meta(get_the_ID(), '_ic_recurso_icon', true) ?: '📄';
                        ?>
                        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100 hover:shadow-2xl transition-all duration-500 group flex flex-col justify-between">
                            <div>
                                <div class="w-14 h-14 bg-gray-50 rounded-2xl flex items-center justify-center text-2xl mb-6 group-hover:scale-110 transition-transform"><?php echo esc_html($down_icon); ?></div>
                                <h4 class="text-lg font-black text-gray-900 tracking-tight leading-tight mb-2"><?php the_title(); ?></h4>
                                <p class="text-xs text-gray-400 font-medium italic mb-6"><?php echo get_the_excerpt(); ?></p>
                            </div>
                            
                            <div class="space-y-3 pt-6 border-t border-gray-50 mt-auto">
                                <?php if($down_link) : ?>
                                    <a href="<?php echo esc_url($down_link); ?>" target="_blank" class="block w-full py-4 bg-primary-600 text-white rounded-2xl text-[10px] font-black uppercase tracking-widest text-center shadow-lg shadow-primary-50 hover:bg-primary-700 transition-all">Baixar Arquivo ↓</a>
                                <?php endif; ?>

                                <?php if($is_staff) : ?>
                                    <div class="flex items-center gap-2">
                                        <a href="?aba=recurso_novo&edit_recurso=<?php the_ID(); ?>" class="flex-1 bg-gray-50 text-gray-400 py-3 rounded-xl text-[10px] font-black uppercase tracking-widest text-center hover:bg-primary-50 hover:text-primary-600 transition-all border border-transparent hover:border-primary-100">Editar</a>
                                        <a href="?del_recurso=<?php the_ID(); ?>" onclick="return confirm('Excluir este recurso permanentemente?')" class="px-4 py-3 bg-red-50 text-red-500 rounded-xl text-[10px] font-black hover:bg-red-500 hover:text-white transition-all">🗑️</a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php
                    endwhile;
                else :
                    echo '<div class="col-span-full p-20 text-center bg-white rounded-[3rem] border-2 border-dashed border-gray-100 italic text-gray-400">Nenhum recurso disponível no momento. 📚</div>';
                endif;
                wp_reset_postdata();
                ?>
            </div>

        <?php elseif($aba == 'recurso_novo' && $is_staff) : 
            $edit_id = isset($_GET['edit_recurso']) ? intval($_GET['edit_recurso']) : 0;
            $v_title = $edit_id ? get_the_title($edit_id) : '';
            $v_excerpt = $edit_id ? get_the_excerpt($edit_id) : '';
            $v_link = $edit_id ? get_post_meta($edit_id, '_ic_recurso_link', true) : '';
            $v_icon = $edit_id ? get_post_meta($edit_id, '_ic_recurso_icon', true) : '📄';
            ?>
            <!-- FORMULÁRIO DE RECURSO -->
            <div class="max-w-2xl bg-white rounded-[2.5rem] shadow-2xl p-12 border border-gray-100 animate-slide-up mx-auto">
                <div class="flex items-center gap-4 mb-10">
                    <div class="w-16 h-16 bg-primary-100 rounded-3xl flex items-center justify-center text-3xl">📚</div>
                    <div>
                        <h2 class="text-2xl font-black text-gray-900 tracking-tight leading-tight uppercase tracking-tighter"><?php echo $edit_id ? 'Editar Recurso' : 'Novo Material Digital'; ?></h2>
                        <p class="text-gray-400 text-sm font-medium">Cadastre cartilhas, PDFs ou links de apoio para os membros.</p>
                    </div>
                </div>

                <form action="" method="POST" class="space-y-8">
                    <?php wp_nonce_field( 'ic_save_recurso_dash', 'ic_recurso_dash_nonce' ); ?>
                    <input type="hidden" name="ic_save_recurso" value="1">
                    <?php if($edit_id) : ?><input type="hidden" name="recurso_id" value="<?php echo $edit_id; ?>"><?php endif; ?>

                    <div class="grid grid-cols-5 gap-6">
                        <div class="col-span-1 space-y-4">
                            <label class="text-[10px] font-black uppercase text-gray-400 tracking-widest pl-2">Ícone</label>
                            <input type="text" name="recurso_icon" value="<?php echo esc_attr($v_icon); ?>" class="w-full bg-gray-50 border-none rounded-2xl p-5 text-center text-2xl focus:ring-2 focus:ring-primary-600 shadow-inner" placeholder="📄">
                        </div>
                        <div class="col-span-4 space-y-4">
                            <label class="text-[10px] font-black uppercase text-gray-400 tracking-widest pl-4">Título do Material</label>
                            <input type="text" name="recurso_title" value="<?php echo esc_attr($v_title); ?>" required class="w-full bg-gray-50 border-none rounded-2xl p-5 focus:ring-2 focus:ring-primary-600 transition-all font-bold text-gray-900 shadow-inner" placeholder="Ex: Cartilha Direito Digital 2026">
                        </div>
                    </div>

                    <div class="space-y-4">
                        <label class="text-[10px] font-black uppercase text-gray-400 tracking-widest pl-4">Link de Download (URL do PDF)</label>
                        <input type="url" name="recurso_link" value="<?php echo esc_url($v_link); ?>" required class="w-full bg-gray-50 border-none rounded-2xl p-5 focus:ring-2 focus:ring-primary-600 transition-all font-medium text-primary-700 shadow-inner" placeholder="https://site.com/documento.pdf">
                        <p class="text-[10px] text-gray-400 font-medium italic mt-2">Dica: Suba o arquivo na "Mídia" do WordPress e cole o link aqui.</p>
                    </div>

                    <div class="space-y-4">
                        <label class="text-[10px] font-black uppercase text-gray-400 tracking-widest pl-4">Breve Descrição</label>
                        <textarea name="recurso_excerpt" rows="2" class="w-full bg-gray-50 border-none rounded-2xl p-5 focus:ring-2 focus:ring-primary-600 transition-all font-medium text-gray-700 shadow-inner" placeholder="O que este material ensina?"><?php echo esc_textarea($v_excerpt); ?></textarea>
                    </div>

                    <div class="flex gap-4 pt-4">
                        <button type="submit" class="flex-1 bg-primary-600 text-white py-5 rounded-2xl font-black uppercase text-xs tracking-widest shadow-xl shadow-primary-100 hover:bg-primary-700 hover:-translate-y-1 transition-all flex items-center justify-center gap-2">
                            <?php echo $edit_id ? 'Atualizar Material' : 'Salvar Material'; ?>
                            <span class="text-lg">💾</span>
                        </button>
                        <a href="?aba=recursos" class="px-8 py-5 bg-gray-100 text-gray-500 rounded-2xl font-black uppercase text-xs tracking-widest hover:bg-gray-200 transition-all flex items-center">
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>

        <?php elseif($aba == 'posts' && $is_staff) : ?>
            <!-- GESTAO DO BLOG (DINAMICA) -->
            <div class="flex justify-between items-center mb-12">
                <div>
                    <h2 class="text-3xl font-black text-gray-900 tracking-tight leading-tight">Gestão de <span class="text-primary-600 italic">Artigo</span></h2>
                    <p class="text-gray-400 font-medium text-sm">Painel administrativo do Instituto Caiçara.</p>
                </div>
                <a href="?aba=post_novo" class="bg-primary-600 text-white px-10 py-4 rounded-[1.5rem] font-black uppercase text-xs tracking-[0.1em] shadow-xl shadow-primary-100 hover:bg-primary-700 hover:-translate-y-1 transition-all flex items-center gap-2">
                    ✨ Adicionar Novo
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10 animate-fade-in relative z-10">
                <?php
                $my_posts = new WP_Query(array('post_type' => 'post', 'posts_per_page' => -1));
                if ($my_posts->have_posts()) :
                    while ($my_posts->have_posts()) : $my_posts->the_post();
                        ?>
                        <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden hover:shadow-2xl transition-all duration-500 group flex flex-col">
                            <div class="relative h-56 overflow-hidden">
                                <?php if(has_post_thumbnail()) : ?>
                                    <?php the_post_thumbnail('medium_large', array('class' => 'w-full h-full object-cover group-hover:scale-110 transition-transform duration-700')); ?>
                                <?php else : ?>
                                    <div class="w-full h-full bg-primary-50 flex items-center justify-center text-4xl">🗞️</div>
                                <?php endif; ?>
                            </div>
                            <div class="p-8 flex-1 flex flex-col justify-between">
                                <div>
                                    <div class="text-[10px] text-primary-600 font-black uppercase tracking-widest mb-3 italic">
                                        <?php 
                                        $cats = get_the_category();
                                        echo !empty($cats) ? esc_html($cats[0]->name) : 'Sem Categoria'; 
                                        ?>
                                    </div>
                                    <h4 class="text-xl font-black text-gray-900 leading-tight mb-4 tracking-tight group-hover:text-primary-600 transition-colors uppercase"><?php the_title(); ?></h4>
                                </div>
                                <div class="flex gap-2 pt-6 border-t border-gray-50">
                                    <a href="?aba=post_novo&edit_blog=<?php the_ID(); ?>" class="flex-1 bg-gray-50 text-gray-400 py-3 rounded-xl text-[10px] font-black uppercase tracking-widest text-center hover:bg-primary-50 hover:text-primary-600 transition-all font-sans">Editar</a>
                                    <a href="?del_post=<?php the_ID(); ?>" onclick="return confirm('Excluir post permanentemente?')" class="px-4 py-3 bg-red-50 text-red-500 rounded-xl text-[10px] font-black hover:bg-red-500 hover:text-white transition-all">🗑️</a>
                                </div>
                            </div>
                        </div>
                        <?php
                    endwhile;
                else :
                    echo '<div class="col-span-full p-20 text-center bg-white rounded-[3rem] border-2 border-dashed border-gray-100 italic text-gray-400">Nenhuma postagem no blog ainda. 🖋️</div>';
                endif;
                wp_reset_postdata();
                ?>
            </div>

        <?php elseif($aba == 'post_novo' && $is_staff) : 
            $edit_id = isset($_GET['edit_blog']) ? intval($_GET['edit_blog']) : 0;
            $v_title = $edit_id ? get_the_title($edit_id) : '';
            $v_content = $edit_id ? get_post_field('post_content', $edit_id) : '';
            ?>
            <div class="max-w-4xl bg-white rounded-[3.5rem] shadow-2xl p-10 md:p-16 border border-gray-100 animate-slide-up mx-auto">
                <div class="flex flex-col md:flex-row md:items-center gap-6 mb-12">
                    <div class="w-16 h-16 bg-primary-100 rounded-3xl flex items-center justify-center text-3xl">🖋️</div>
                    <div>
                        <h2 class="text-3xl font-black text-gray-900 tracking-tight leading-tight italic"><?php echo $edit_id ? 'Editar Artigo' : 'Nova Publicação de Artigo'; ?></h2>
                        <p class="text-gray-400 font-medium text-sm">O conteúdo aparecerá na página oficial de notícias do ICDDH.</p>
                    </div>
                </div>

                <form action="" method="POST" enctype="multipart/form-data" class="space-y-10">
                    <?php wp_nonce_field( 'ic_save_blog_dash', 'ic_blog_dash_nonce' ); ?>
                    <input type="hidden" name="ic_save_blog_post" value="1">
                    <?php if($edit_id) : ?><input type="hidden" name="blog_id" value="<?php echo $edit_id; ?>"><?php endif; ?>

                    <div class="space-y-3">
                        <label class="text-[10px] font-black uppercase text-gray-400 tracking-widest pl-4">Título do Post / Manchete</label>
                        <input type="text" name="blog_title" value="<?php echo esc_attr($v_title); ?>" required class="w-full bg-gray-50 border-none rounded-2xl p-6 focus:ring-2 focus:ring-primary-600 transition-all font-black text-2xl text-gray-900 shadow-inner" placeholder="Ex: Grande evento social em Bertioga">
                    </div>

                    <div class="space-y-3">
                         <label class="text-[10px] font-black uppercase text-gray-400 tracking-widest pl-4">Imagem de Capa</label>
                         <?php if ($edit_id && has_post_thumbnail($edit_id)) echo get_the_post_thumbnail($edit_id, 'medium', array('class' => 'rounded-2xl mb-4 w-40')); ?>
                         <label class="block cursor-pointer">
                             <div class="bg-gray-50 border-2 border-dashed border-gray-200 rounded-3xl p-10 text-center hover:bg-primary-50 transition-all border-dashed border-primary-200">
                                 <span class="text-3xl block mb-2">📸</span>
                                 <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest italic">Anexar Fotografia</span>
                                 <input type="file" name="blog_thumbnail" class="hidden" accept="image/*">
                             </div>
                         </label>
                    </div>

                    <div class="space-y-3">
                         <label class="text-[10px] font-black uppercase text-gray-400 tracking-widest pl-4">Conteúdo do Post</label>
                         <div class="prose-editor-dash rounded-3xl overflow-hidden border border-gray-100 shadow-inner">
                            <?php 
                            $settings = array( 'textarea_name' => 'blog_content', 'media_buttons' => true, 'textarea_rows' => 12, 'editor_class' => 'custom-dash-editor' );
                            wp_editor( $v_content, 'blog_editor_id', $settings ); 
                            ?>
                         </div>
                    </div>

                    <div class="space-y-4">
                        <label class="text-[10px] font-black uppercase text-gray-400 tracking-widest pl-4">Categorias do Blog</label>
                        <div class="flex flex-wrap gap-3">
                            <?php 
                            $cats = get_categories(array('hide_empty' => 0));
                            $active_cats = $edit_id ? wp_get_post_categories($edit_id) : array();
                            foreach($cats as $c) : ?>
                                <label class="cursor-pointer group">
                                    <input type="checkbox" name="post_cats[]" value="<?php echo $c->term_id; ?>" <?php checked(in_array($c->term_id, $active_cats)); ?> class="hidden peer">
                                    <div class="px-6 py-3 bg-gray-50 border border-gray-100 rounded-full text-[10px] font-black uppercase tracking-widest text-gray-500 peer-checked:bg-primary-600 peer-checked:text-white transition-all peer-checked:shadow-lg peer-checked:shadow-primary-100">
                                        # <?php echo $c->name; ?>
                                    </div>
                                </label>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="flex gap-4 pt-10">
                        <button type="submit" class="flex-1 bg-primary-600 text-white py-6 rounded-[2rem] font-black uppercase tracking-widest shadow-2xl shadow-primary-200 hover:bg-primary-700 hover:-translate-y-1 transition-all flex items-center justify-center gap-3">
                            <?php echo $edit_id ? 'Atualizar Matéria' : 'Publicar Agora 🖋️'; ?>
                        </button>
                        <a href="?aba=posts" class="px-10 py-6 bg-gray-100 text-gray-400 rounded-[2rem] font-black uppercase tracking-[0.2em] text-[10px] flex items-center justify-center">Voltar</a>
                    </div>
                </form>
            </div>

        <?php else : ?>
            <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 p-20 text-center text-gray-400 italic">
                Área em desenvolvimento para o tópico: <?php echo esc_html($aba); ?>
            </div>
        <?php endif; ?>
    </main>
</div>

<?php get_footer(); ?>
