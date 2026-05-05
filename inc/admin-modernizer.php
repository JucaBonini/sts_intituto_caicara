<?php
/**
 * ICDDH Admin Modernizer & Branding
 * This file handles the UI/UX transformation of the WordPress Admin
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * 1. CUSTOM LOGIN PAGE BRANDING
 */
function icddh_custom_login_styles() {
    ?>
    <style type="text/css">
        body.login {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%) !important;
            background-attachment: fixed !important;
        }
        #login {
            padding: 5% 0 0 !important;
            width: 350px !important;
        }
        #login h1 a, .login h1 a {
            background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/logo-branco-2.webp') !important;
            height: 120px !important;
            width: 100% !important;
            background-size: contain !important;
            background-position: center !important;
            margin-bottom: 20px !important;
        }
        .login form {
            background: rgba(255, 255, 255, 0.03) !important;
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            border-radius: 24px !important;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5) !important;
            padding: 30px !important;
        }
        .login label { color: #e2e8f0 !important; font-size: 13px !important; font-weight: 600 !important; }
        .login input[type="text"], .login input[type="password"] {
            background: rgba(255, 255, 255, 0.05) !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            border-radius: 12px !important;
            color: #fff !important;
            padding: 12px !important;
            margin-top: 8px !important;
        }
        .wp-core-ui .button-primary {
            background: linear-gradient(to r, #2563eb, #1e40af) !important;
            border: none !important;
            border-radius: 12px !important;
            width: 100% !important;
            height: 50px !important;
            font-size: 16px !important;
            font-weight: 800 !important;
            margin-top: 20px !important;
            box-shadow: 0 10px 20px rgba(37, 99, 235, 0.3) !important;
            text-transform: uppercase;
        }
        .login #backtoblog a, .login #nav a { color: #94a3b8 !important; text-align: center !important; }
        .login #backtoblog a:hover, .login #nav a:hover { color: #fbbf24 !important; }
        
        /* Language Switcher Fix */
        .language-switcher {
            margin-top: 20px !important;
            color: #94a3b8 !important;
        }
        .language-switcher select {
            background: rgba(255,255,255,0.1) !important;
            border-color: rgba(255,255,255,0.2) !important;
            color: #fff !important;
            border-radius: 8px !important;
        }
    /* Completely hide the switcher if filter fails */
        .language-switcher { display: none !important; }

        /* Turnstile Styling */
        .cf-turnstile {
            margin: 20px 0 10px !important;
            display: flex;
            justify-content: center;
        }
    </style>
    <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
    <?php
}
add_action( 'login_enqueue_scripts', 'icddh_custom_login_styles' );

/**
 * Insert Turnstile Widget into Login Form
 */
function icddh_add_turnstile_to_login() {
    // USE SUA SITE KEY AQUI (Atualmente usando chave de teste que sempre passa)
    $site_key = '1x00000000000000000000AA'; 
    echo '<div class="cf-turnstile" data-sitekey="' . $site_key . '" data-theme="dark"></div>';
}
add_action( 'login_form', 'icddh_add_turnstile_to_login' );

/**
 * Verify Turnstile Token on Login Attempt
 */
function icddh_verify_turnstile_on_login( $user ) {
    if ( isset( $_POST['wp-submit'] ) ) {
        $turnstile_response = isset( $_POST['cf-turnstile-response'] ) ? $_POST['cf-turnstile-response'] : '';
        
        // USE SUA SECRET KEY AQUI (Atualmente usando chave de teste que sempre passa)
        $secret_key = '1x0000000000000000000000000000000AA';

        $response = wp_remote_post( 'https://challenges.cloudflare.com/turnstile/v0/siteverify', array(
            'body' => array(
                'secret'   => $secret_key,
                'response' => $turnstile_response,
                'remoteip' => $_SERVER['REMOTE_ADDR'],
            ),
        ) );

        $response_body = wp_remote_retrieve_body( $response );
        $result = json_decode( $response_body );

        if ( ! $result || ! $result->success ) {
            return new WP_Error( 'authentication_failed', '<strong>ERRO DE SEGURANÇA:</strong> Verificação de robô falhou. Tente novamente.' );
        }
    }
    return $user;
}
add_filter( 'wp_authenticate_user', 'icddh_verify_turnstile_on_login', 10, 1 );

// Hide the language dropdown natively
add_filter( 'login_display_language_dropdown', '__return_false' );

/**
 * 2. ADMIN UI MODERNIZATION (CSS Injection)
 */
function icddh_admin_modern_styles() {
    ?>
    <style>
        /* Global Reset & Typography */
        @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap');
        
        :root {
            --primary: #1e40af;
            --primary-dark: #1e3a8a;
            --accent: #fbbf24;
            --sidebar: #0f172a;
            --bg: #f1f5f9;
        }

        body, #wpadminbar, #adminmenu, #adminmenu .wp-submenu, #wpfooter, .postbox, .wp-core-ui .button {
            font-family: 'Outfit', sans-serif !important;
        }

        /* Sidebar Styling */
        #adminmenuback, #adminmenuwrap, #adminmenu {
            background-color: var(--sidebar) !important;
        }
        #adminmenu li.wp-has-current-submenu a.wp-has-current-submenu, 
        #adminmenu li.current a.menu-top,
        .wp-menu-separator {
            background-color: rgba(255,255,255,0.05) !important;
        }
        #adminmenu li.menu-top:hover, 
        #adminmenu li.opensub > a.menu-top, 
        #adminmenu li > a.menu-top:focus {
            background-color: rgba(255,255,255,0.08) !important;
            color: var(--accent) !important;
        }
        #adminmenu .wp-has-current-submenu .wp-submenu,
        #adminmenu .wp-has-current-submenu.opensub .wp-submenu,
        #adminmenu a.wp-has-current-submenu:focus + .wp-submenu {
            background-color: #1e293b !important;
        }
        
        /* Modern Buttons */
        .wp-core-ui .button-primary {
            background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%) !important;
            border: none !important;
            border-radius: 8px !important;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2) !important;
            transition: all 0.3s ease !important;
        }
        .wp-core-ui .button-primary:hover {
            transform: translateY(-1px) !important;
            box-shadow: 0 6px 15px rgba(37, 99, 235, 0.3) !important;
        }

        /* Dashboard Widgets */
        .postbox {
            border-radius: 12px !important;
            border: 1px solid #e2e8f0 !important;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05) !important;
            overflow: hidden;
        }
        .postbox-header {
            background: #f8fafc !important;
            border-bottom: 1px solid #e2e8f0 !important;
        }

        /* Admin Bar */
        #wpadminbar {
            background: var(--sidebar) !important;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        
        /* Highlighting Custom Post Types */
        #toplevel_page_gestao-caicaras .wp-menu-name {
            color: var(--accent) !important;
            font-weight: 700 !important;
        }

        /* Profile Page Cleaning */
        .user-rich-editing-wrap, 
        .user-syntax-highlighting-wrap, 
        .user-admin-color-wrap, 
        .user-comment-shortcuts-wrap, 
        .user-admin-bar-front-wrap, 
        .user-language-wrap,
        .user-description-wrap + h2,
        .user-profile-picture {
            display: none !important;
        }

        .profile-php h1 { font-weight: 800 !important; color: var(--sidebar) !important; margin-bottom: 30px !important; }
        .profile-php .form-table th { font-weight: 700 !important; color: #475569 !important; padding: 20px 0 !important; }
        .profile-php .form-table td { padding: 15px 0 !important; }
        .profile-php input[type="text"], .profile-php input[type="email"], .profile-php textarea {
            border-radius: 10px !important;
            border: 1px solid #cbd5e1 !important;
            padding: 10px 15px !important;
            width: 100% !important;
            max-width: 500px !important;
        }
        .profile-php .application-passwords { display: none !important; }
        
        /* Custom Avatar Style */
        .icddh-avatar-preview {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid var(--accent);
            margin-bottom: 15px;
            background: #e2e8f0;
        }

        /* Responsive Improvements */
        @media screen and (max-width: 782px) {
            .icddh-dashboard { padding: 10px; }
        }
    </style>
    <?php
}
add_action( 'admin_enqueue_scripts', 'icddh_admin_modern_styles' );

/**
 * 3. HIERARCHY & DYNAMIC MENU PRUNING
 */
function icddh_prune_admin_bar() {
    global $wp_admin_bar;
    if ( is_object( $wp_admin_bar ) ) {
        $wp_admin_bar->remove_menu('wp-logo');
    }
}
add_action( 'admin_bar_menu', 'icddh_prune_admin_bar', 999 );

function icddh_prune_admin_menus() {
    if ( !is_admin() || current_user_can( 'administrator' ) ) {
        return; 
    }

    $user = wp_get_current_user();
    $role = !empty($user->roles) ? $user->roles[0] : '';
    $permissions = get_option('icddh_permissions', array());
    
    // Default safe blocks if no permissions set
    if (empty($permissions)) {
        remove_menu_page( 'plugins.php' );
        remove_menu_page( 'options-general.php' );
        remove_menu_page( 'users.php' );
        return;
    }

    // Module Mapping to Slugs
    $modules = array(
        'posts'    => 'edit.php',
        'pages'    => 'edit.php?post_type=page',
        'agenda'   => 'edit.php?post_type=agenda',
        'acoes'    => 'edit.php?post_type=acao',
        'recursos' => 'edit.php?post_type=recurso',
        'diretoria'=> 'edit.php?post_type=diretoria',
        'comments' => 'edit-comments.php',
        'users'    => 'users.php',
        'tools'    => 'tools.php',
        'settings' => 'options-general.php',
        'plugins'  => 'plugins.php'
    );

    foreach ($modules as $mod_key => $slug) {
        if ( !isset($permissions[$role][$mod_key]) || $permissions[$role][$mod_key] !== '1' ) {
            remove_menu_page( $slug );
        }
    }
    
    remove_menu_page( 'index.php' );
}
add_action( 'admin_menu', 'icddh_prune_admin_menus', 999 );

/**
 * 4. REDIRECT NON-ADMINS TO CUSTOM DASHBOARD
 */
function icddh_login_redirect( $redirect_to, $request, $user ) {
    if ( isset( $user->roles ) && is_array( $user->roles ) ) {
        if ( ! in_array( 'administrator', $user->roles ) ) {
            return admin_url( 'admin.php?page=gestao-caicaras' );
        }
    }
    return $redirect_to;
}
add_filter( 'login_redirect', 'icddh_login_redirect', 10, 3 );

/**
 * 5. CUSTOM DASHBOARD PAGE (CENTRAL DO INSTITUTO)
 */
function icddh_register_custom_dashboard() {
    add_menu_page(
        'Central do Instituto',
        'Gestão Caiçaras',
        'edit_posts',
        'gestao-caicaras',
        'icddh_render_dashboard',
        'dashicons-dashboard',
        2
    );
}
add_action( 'admin_menu', 'icddh_register_custom_dashboard' );

/**
 * 6. CUSTOM URL: /painel & /entrar
 */
function icddh_custom_admin_url() {
    add_rewrite_rule('^painel/?$', 'wp-login.php', 'top');
    add_rewrite_rule('^entrar/?$', 'wp-login.php', 'top');
}
add_action('init', 'icddh_custom_admin_url');

/**
 * Force flush rules once
 */
function icddh_force_flush_once() {
    if ( ! get_option( 'icddh_rules_flushed' ) ) {
        icddh_custom_admin_url();
        flush_rewrite_rules();
        update_option( 'icddh_rules_flushed', 1 );
    }
}
add_action( 'init', 'icddh_force_flush_once', 99 );

/**
 * Handle /painel logic and protect wp-login.php
 */
function icddh_protect_login_page() {
    $request_uri = $_SERVER['REQUEST_URI'];
    
    // 1. If visits /painel or /entrar, redirect to wp-login with a secret key
    if ( untrailingslashit($request_uri) == home_url('/painel', 'relative') || untrailingslashit($request_uri) == home_url('/entrar', 'relative') ) {
        if ( is_user_logged_in() ) {
            wp_redirect( admin_url( 'admin.php?page=gestao-caicaras' ) );
        } else {
            // Secret key to allow access
            wp_redirect( site_url('wp-login.php?access=painel', 'login') );
        }
        exit;
    }

    $is_login_page = strpos($request_uri, 'wp-login.php') !== false;
    $has_secret = isset($_GET['access']) && $_GET['access'] == 'painel';
    $is_post = $_SERVER['REQUEST_METHOD'] === 'POST';

    // 2. Block direct wp-login.php if no secret, not post, and not logged in
    if ( $is_login_page && !is_user_logged_in() && !$has_secret && !$is_post ) {
        // Allow standard actions like logout, lostpassword, etc.
        $allowed_actions = array('logout', 'lostpassword', 'register', 'resetpass', 'rp');
        $current_action = isset($_GET['action']) ? $_GET['action'] : '';
        
        if ( !in_array($current_action, $allowed_actions) && ! ( defined( 'DOING_AJAX' ) && DOING_AJAX ) ) {
             wp_redirect( home_url() );
             exit;
        }
    }
}
add_action('init', 'icddh_protect_login_page', 1);

/**
 * 7. NATIVE PROFILE PICTURE (No Gravatar)
 */
function icddh_user_profile_avatar_field( $user ) {
    $avatar_id = get_user_meta( $user->ID, 'icddh_custom_avatar', true );
    $avatar_url = $avatar_id ? wp_get_attachment_url( $avatar_id ) : '';
    ?>
    <h3>⚓ Identidade do Instituto</h3>
    <table class="form-table">
        <tr>
            <th><label for="icddh_custom_avatar">Foto de Perfil</label></th>
            <td>
                <div id="icddh-avatar-container">
                    <?php if ( $avatar_url ) : ?>
                        <img src="<?php echo esc_url( $avatar_url ); ?>" class="icddh-avatar-preview" id="icddh-avatar-img">
                    <?php else : ?>
                        <div class="icddh-avatar-preview" id="icddh-avatar-img" style="display: flex; align-items: center; justify-content: center; font-size: 40px; color: #cbd5e1;">👤</div>
                    <?php endif; ?>
                    <input type="hidden" name="icddh_custom_avatar" id="icddh_custom_avatar" value="<?php echo esc_attr( $avatar_id ); ?>">
                    <div style="display: flex; gap: 10px;">
                        <button type="button" class="button icddh-upload-avatar">Escolher Foto</button>
                        <button type="button" class="button icddh-remove-avatar" style="color: #ef4444; <?php echo !$avatar_id ? 'display:none;' : ''; ?>">Remover</button>
                    </div>
                </div>
                <p class="description">Escolha uma foto quadrada para melhor visualização no painel.</p>
            </td>
        </tr>
    </table>
    <script>
    jQuery(document).ready(function($){
        var frame;
        $('.icddh-upload-avatar').on('click', function(e){
            e.preventDefault();
            if ( frame ) { frame.open(); return; }
            frame = wp.media({ title: 'Escolher Foto de Perfil', button: { text: 'Usar esta foto' }, multiple: false });
            frame.on('select', function() {
                var attachment = frame.state().get('selection').first().toJSON();
                $('#icddh_custom_avatar').val(attachment.id);
                if($('#icddh-avatar-img').is('img')){
                    $('#icddh-avatar-img').attr('src', attachment.url);
                } else {
                    $('#icddh-avatar-img').replaceWith('<img src="'+attachment.url+'" class="icddh-avatar-preview" id="icddh-avatar-img">');
                }
                $('.icddh-remove-avatar').show();
            });
            frame.open();
        });
        $('.icddh-remove-avatar').on('click', function(){
            $('#icddh_custom_avatar').val('');
            $('#icddh-avatar-img').replaceWith('<div class="icddh-avatar-preview" id="icddh-avatar-img" style="display: flex; align-items: center; justify-content: center; font-size: 40px; color: #cbd5e1;">👤</div>');
            $(this).hide();
        });
    });
    </script>
    <?php
}
add_action( 'show_user_profile', 'icddh_user_profile_avatar_field' );
add_action( 'edit_user_profile', 'icddh_user_profile_avatar_field' );

function icddh_save_custom_avatar( $user_id ) {
    if ( ! current_user_can( 'edit_user', $user_id ) ) return false;
    update_user_meta( $user_id, 'icddh_custom_avatar', $_POST['icddh_custom_avatar'] );
}
add_action( 'personal_options_update', 'icddh_save_custom_avatar' );
add_action( 'edit_user_profile_update', 'icddh_save_custom_avatar' );

/**
 * Filter get_avatar to use our custom image
 */
function icddh_custom_avatar_filter( $avatar, $id_or_email, $size, $default, $alt ) {
    $user_id = 0;
    if ( is_numeric( $id_or_email ) ) {
        $user_id = (int) $id_or_email;
    } elseif ( is_object( $id_or_email ) && isset( $id_or_email->user_id ) && $id_or_email->user_id ) {
        $user_id = (int) $id_or_email->user_id;
    } elseif ( is_string( $id_or_email ) && ( $user = get_user_by( 'email', $id_or_email ) ) ) {
        $user_id = $user->ID;
    }

    if ( $user_id ) {
        $custom_avatar_id = get_user_meta( $user_id, 'icddh_custom_avatar', true );
        if ( $custom_avatar_id ) {
            $avatar_url = wp_get_attachment_image_url( $custom_avatar_id, array($size, $size) );
            if ( $avatar_url ) {
                $avatar = "<img alt='{$alt}' src='{$avatar_url}' class='avatar avatar-{$size} photo icddh-custom-avatar' height='{$size}' width='{$size}' style='border-radius:50%; object-fit:cover;' />";
            }
        }
    }
    return $avatar;
}
add_filter( 'get_avatar', 'icddh_custom_avatar_filter', 10, 5 );

function icddh_render_dashboard() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'caicaras_pre_inscricao';
    $tab = isset($_GET['tab']) ? $_GET['tab'] : 'geral';

    // Handle Permissions Save
    if ( isset($_POST['icddh_save_perms']) && current_user_can('administrator') ) {
        check_admin_referer('icddh_perms_action', 'icddh_perms_nonce');
        update_option('icddh_permissions', $_POST['perms']);
        echo '<div class="notice notice-success is-dismissible"><p>Permissões atualizadas com sucesso!</p></div>';
    }

    // Stats
    $total_inscritos = $wpdb->get_var("SELECT COUNT(*) FROM $table_name");
    $hoje = $wpdb->get_var("SELECT COUNT(*) FROM $table_name WHERE DATE(time) = CURDATE()");
    
    ?>
    <div class="wrap icddh-dashboard">
        <h1 style="font-weight: 800; color: #1e293b; margin-bottom: 10px;">⚓ Central de Gestão - Instituto Caiçara</h1>
        
        <h2 class="nav-tab-wrapper" style="margin-bottom: 30px; border-bottom: 2px solid #e2e8f0; padding-bottom: 0;">
            <a href="?page=gestao-caicaras&tab=geral" class="nav-tab <?php echo $tab == 'geral' ? 'nav-tab-active' : ''; ?>" style="border-radius: 10px 10px 0 0; margin-right: 5px;">📊 Estatísticas</a>
            <?php if (current_user_can('administrator')) : ?>
                <a href="?page=gestao-caicaras&tab=permissoes" class="nav-tab <?php echo $tab == 'permissoes' ? 'nav-tab-active' : ''; ?>" style="border-radius: 10px 10px 0 0;">🛡️ Controle de Permissões</a>
            <?php endif; ?>
        </h2>

        <?php if ($tab == 'geral') : ?>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-bottom: 40px;">
                <!-- Card 1 -->
                <div style="background: white; padding: 30px; border-radius: 15px; box-shadow: 0 10px 25px rgba(0,0,0,0.05); border-left: 5px solid #2563eb;">
                    <span style="color: #64748b; font-size: 14px; font-weight: 600; text-transform: uppercase;">Total de Inscrições</span>
                    <div style="font-size: 36px; font-weight: 800; color: #1e293b; margin-top: 10px;"><?php echo $total_inscritos ?: '0'; ?></div>
                </div>
                
                <!-- Card 2 -->
                <div style="background: white; padding: 30px; border-radius: 15px; box-shadow: 0 10px 25px rgba(0,0,0,0.05); border-left: 5px solid #10b981;">
                    <span style="color: #64748b; font-size: 14px; font-weight: 600; text-transform: uppercase;">Novas Hoje</span>
                    <div style="font-size: 36px; font-weight: 800; color: #1e293b; margin-top: 10px;"><?php echo $hoje ?: '0'; ?></div>
                </div>

                <!-- Card 3 -->
                <div style="background: white; padding: 30px; border-radius: 15px; box-shadow: 0 10px 25px rgba(0,0,0,0.05); border-left: 5px solid #fbbf24;">
                    <span style="color: #64748b; font-size: 14px; font-weight: 600; text-transform: uppercase;">Ações Sociais Ativas</span>
                    <div style="font-size: 36px; font-weight: 800; color: #1e293b; margin-top: 10px;"><?php echo wp_count_posts('acao')->publish; ?></div>
                </div>
            </div>

            <div class="postbox" style="padding: 30px; border-radius: 20px;">
                <h2 style="font-weight: 700; font-size: 20px; margin-bottom: 15px;">Acesso Rápido</h2>
                <p style="color: #64748b; margin-bottom: 25px;">Seja bem-vindo à Central do Instituto. Gerencie os principais módulos do site com um clique.</p>
                <div style="display: flex; gap: 15px; flex-wrap: wrap;">
                    <a href="edit.php?post_type=agenda" class="button button-primary button-hero" style="background: #2563eb !important; border: none; padding: 0 30px;">🗓️ Agenda Social</a>
                    <a href="edit.php?post_type=acao" class="button button-primary button-hero" style="background: #10b981 !important; border: none; padding: 0 30px;">📢 Ações Sociais</a>
                    <a href="edit.php" class="button button-primary button-hero" style="background: #1e293b !important; border: none; padding: 0 30px;">📰 Blog/Notícias</a>
                </div>
            </div>

        <?php elseif ($tab == 'permissoes' && current_user_can('administrator')) : ?>
            <div class="postbox" style="padding: 40px; border-radius: 20px;">
                <h2 style="font-weight: 800; font-size: 24px; color: #1e293b; margin-bottom: 10px;">🛡️ Painel de Controle de Acesso</h2>
                <p style="color: #64748b; margin-bottom: 40px;">Como Administrador, você define exatamente o que cada cargo pode ver ou modificar no sistema.</p>
                
                <form method="post" action="">
                    <?php wp_nonce_field('icddh_perms_action', 'icddh_perms_nonce'); ?>
                    <input type="hidden" name="icddh_save_perms" value="1">
                    
                    <?php 
                    $roles = array(
                        'editor' => 'Editor',
                        'author' => 'Autor',
                        'contributor' => 'Colaborador'
                    );
                    $modules = array(
                        'posts'    => '📰 Blog e Notícias',
                        'pages'    => '📄 Páginas do Site',
                        'agenda'   => '🗓️ Agenda Social',
                        'acoes'    => '📢 Ações Sociais',
                        'recursos' => '📚 Biblioteca de Recursos',
                        'diretoria'=> '👥 Diretoria e Membros',
                        'comments' => '💬 Comentários',
                        'users'    => '👥 Gestão de Usuários',
                        'plugins'  => '🔌 Plugins (Avançado)',
                        'settings' => '⚙️ Configurações do Site',
                        'tools'    => '🛠️ Ferramentas WP'
                    );
                    $current_perms = get_option('icddh_permissions', array());
                    ?>

                    <table class="wp-list-table widefat fixed striped" style="border: none; border-radius: 15px; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);">
                        <thead style="background: #f8fafc;">
                            <tr>
                                <th style="padding: 20px; font-weight: 700; color: #1e293b;">Módulo do Sistema</th>
                                <?php foreach ($roles as $r_id => $r_name) : ?>
                                    <th style="text-align: center; padding: 20px; font-weight: 700; color: #1e293b;"><?php echo $r_name; ?></th>
                                <?php endforeach; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($modules as $m_id => $m_name) : ?>
                                <tr>
                                    <td style="padding: 15px 20px; font-weight: 500; color: #475569;"><?php echo $m_name; ?></td>
                                    <?php foreach ($roles as $r_id => $r_name) : ?>
                                        <td style="text-align: center; padding: 15px;">
                                            <?php $checked = isset($current_perms[$r_id][$m_id]) && $current_perms[$r_id][$m_id] == '1' ? 'checked' : ''; ?>
                                            <input type="checkbox" name="perms[<?php echo $r_id; ?>][<?php echo $m_id; ?>]" value="1" <?php echo $checked; ?> style="width: 20px; height: 20px; border-radius: 6px; border: 2px solid #cbd5e1;">
                                        </td>
                                    <?php endforeach; ?>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    
                    <div style="margin-top: 40px; border-top: 1px solid #f1f5f9; pt-30px; display: flex; justify-content: flex-end;">
                        <input type="submit" class="button button-primary button-hero" value="✅ Salvar Todas as Permissões" style="background: #2563eb !important; border: none; padding: 0 40px; height: 60px; font-size: 16px; font-weight: 700; border-radius: 12px; box-shadow: 0 10px 15px -3px rgba(37, 99, 235, 0.4);">
                    </div>
                </form>
            </div>
        <?php endif; ?>
    </div>
    <?php
}

/**
 * Custom Admin Footer Text
 */
function icddh_custom_admin_footer() {
    echo '<span id="footer-thankyou">Feito por <a href="#" style="color: #2563eb; font-weight: bold; text-decoration: none;">Juca Souza</a></span>';
}
add_filter( 'admin_footer_text', 'icddh_custom_admin_footer' );
