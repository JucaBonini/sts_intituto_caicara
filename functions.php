<?php
/**
 * ICDDH Functions and definitions
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Admin Modernizer & Branding
 */
require_once get_template_directory() . '/inc/admin-modernizer.php';

/**
 * Setup Theme Supports
 */
function icddh_theme_setup() {
    // Add title-tag support
    add_theme_support( 'title-tag' );

    // Register primary menu
    register_nav_menus( array(
        'primary-menu' => __( 'Primary Menu', 'icddh' ),
    ) );

    // Enable post thumbnails
    add_theme_support( 'post-thumbnails' );

    // Enable custom logo
    add_theme_support( 'custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ) );

    // Enable HTML5 support
    add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
}
add_action( 'after_setup_theme', 'icddh_theme_setup' );

/**
 * Register Custom Post Types: Membros, Ações e Agenda
 */
function icddh_register_custom_post_types() {
    $labels = array(
        'name'               => _x( 'Membros', 'post type general name', 'icddh' ),
        'singular_name'      => _x( 'Membro', 'post type singular name', 'icddh' ),
        'menu_name'          => _x( 'Diretoria', 'admin menu', 'icddh' ),
        'add_new'            => _x( 'Adicionar Novo', 'membro', 'icddh' ),
        'add_new_item'       => __( 'Adicionar Novo Membro', 'icddh' ),
        'new_item'           => __( 'Novo Membro', 'icddh' ),
        'edit_item'          => __( 'Editar Membro', 'icddh' ),
        'view_item'          => __( 'Ver Membro', 'icddh' ),
        'all_items'          => __( 'Todos os Membros', 'icddh' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'has_archive'        => false,
        'menu_icon'          => 'dashicons-groups',
        'supports'           => array( 'title', 'thumbnail', 'excerpt', 'page-attributes' ),
        'rewrite'            => array( 'slug' => 'diretoria' ),
        'show_in_rest'       => true,
    );

    register_post_type( 'membro', $args );

    // Register Dynamic Ações Sociais CPT
    register_post_type( 'acao', array(
        'labels' => array(
            'name' => 'Ações Sociais',
            'singular_name' => 'Ação Social',
        ),
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-heart',
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'show_in_rest' => true,
    ) );
    // 4. CPT AGENDA SOCIAL (Eventos)
    $labels_agenda = array(
        'name'               => 'Agenda Social',
        'singular_name'      => 'Evento',
        'menu_name'          => 'Agenda Social',
        'add_new'            => 'Novo Evento',
        'add_new_item'       => 'Adicionar Novo Evento',
        'edit_item'          => 'Editar Evento',
        'all_items'          => 'Todos os Eventos',
        'search_items'       => 'Procurar Eventos',
        'not_found'          => 'Nenhum evento encontrado',
    );

    $args_agenda = array(
        'labels'             => $labels_agenda,
        'public'             => true,
        'has_archive'        => true,
        'menu_icon'          => 'dashicons-calendar-alt',
        'supports'           => array( 'title', 'editor', 'thumbnail' ),
        'show_in_rest'       => true,
        'rewrite'            => array('slug' => 'agenda-social'),
    );
    register_post_type( 'agenda', $args_agenda );

    // 5. CPT CERTIFICAÇÕES
    register_post_type( 'certificacao', array(
        'labels' => array(
            'name' => 'Certificações',
            'singular_name' => 'Certificação',
            'add_new' => 'Nova Certificação',
            'add_new_item' => 'Adicionar Nova Certificação',
            'edit_item' => 'Editar Certificação',
            'all_items' => 'Todas as Certificações',
        ),
        'public' => true,
        'has_archive' => false,
        'menu_icon' => 'dashicons-awards',
        'supports' => array('title', 'excerpt'), // Excerpt used for law/details
        'show_in_rest' => true,
    ) );

    // 6. CPT RECURSOS (Documentos e PDFs)
    register_post_type( 'recurso', array(
        'labels' => array(
            'name' => 'Recursos',
            'singular_name' => 'Recurso',
            'add_new' => 'Novo Recurso',
            'all_items' => 'Todos os Recursos',
        ),
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-media-document',
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'show_in_rest' => true,
        'rewrite' => array('slug' => 'recursos-institucionais'),
    ) );
}
add_action( 'init', 'icddh_register_custom_post_types' );

/**
 * Redireciona os Arquivos de CPT para os Templates Customizados
 */
function icddh_custom_template_redirect( $template ) {
    if ( is_post_type_archive( 'acao' ) ) {
        $new_template = locate_template( array( 'template-acoes.php' ) );
        if ( '' != $new_template ) {
            return $new_template;
        }
    }
    if ( is_post_type_archive( 'agenda' ) ) {
        $new_template = locate_template( array( 'template-agenda.php' ) );
        if ( '' != $new_template ) {
            return $new_template;
        }
    }
    return $template;
}
add_filter( 'template_include', 'icddh_custom_template_redirect' );

/**
 * Grant publish powers to all staff roles
 */
function icddh_grant_publish_capabilities() {
    $roles = array( 'editor', 'author', 'contributor' );
    $caps = array(
        'publish_posts',
        'publish_pages',
        'edit_published_posts',
        'delete_published_posts'
    );

    foreach ( $roles as $role_name ) {
        $role = get_role( $role_name );
        if ( ! $role ) continue;
        
        foreach ( $caps as $cap ) {
            $role->add_cap( $cap );
        }
    }
}
add_action( 'admin_init', 'icddh_grant_publish_capabilities' );

/**
 * ELITE SECURITY HARDENING (Modo Deus)
 */
// 1. Disable XML-RPC
add_filter( 'xmlrpc_enabled', '__return_false' );

// 2. Remove WordPress version from header
remove_action( 'wp_head', 'wp_generator' );

// 3. Disable REST API User Enumeration (Protects usernames)
add_filter( 'rest_authentication_errors', function( $result ) {
    if ( ! empty( $result ) ) {
        return $result;
    }
    if ( ! is_user_logged_in() && strpos( $_SERVER['REQUEST_URI'], '/wp/v2/users' ) !== false ) {
        return new WP_Error( 'rest_forbidden', 'Acesso restrito.', array( 'status' => 401 ) );
    }
    return $result;
});

// 4. Remove WP version from scripts and styles
function icddh_remove_wp_ver_css_js( $src ) {
    if ( strpos( $src, 'ver=' . get_bloginfo( 'version' ) ) ) {
        $src = remove_query_arg( 'ver', $src );
    }
    return $src;
}
add_filter( 'style_loader_src', 'icddh_remove_wp_ver_css_js', 9999 );
add_filter( 'script_loader_src', 'icddh_remove_wp_ver_css_js', 9999 );

/**
 * Meta Boxes para a Agenda Social (Campos customizados)
 */
function icddh_add_agenda_metaboxes() {
    add_meta_box(
        'ic_agenda_details',
        'Detalhes do Evento',
        'ic_agenda_details_callback',
        'agenda',
        'normal',
        'high'
    );
    add_meta_box(
        'ic_membro_details',
        'Informações do Membro',
        'ic_membro_details_callback',
        'membro',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'icddh_add_agenda_metaboxes' );

function ic_membro_details_callback( $post ) {
    $cargo = get_post_meta( $post->ID, '_ic_membro_cargo', true );
    $avatar_id = get_post_meta( $post->ID, '_ic_membro_avatar', true );
    $avatar_url = $avatar_id ? wp_get_attachment_url( $avatar_id ) : '';
    wp_nonce_field( 'ic_membro_save_meta', 'ic_membro_nonce' );
    ?>
    <div style="padding: 10px 0;">
        <div style="margin-bottom: 25px;">
            <label style="font-weight: bold; display: block; margin-bottom: 10px; font-size: 14px;">Cargo na Instituição:</label>
            <select name="ic_membro_cargo" style="width: 100%; max-width: 400px; height: 40px; border-radius: 8px;">
                <option value="">-- Selecione o Cargo --</option>
                <optgroup label="Diretoria Executiva">
                    <option value="Diretor Presidente" <?php selected($cargo, 'Diretor Presidente'); ?>>Diretor Presidente</option>
                    <option value="Vice-Presidente" <?php selected($cargo, 'Vice-Presidente'); ?>>Vice-Presidente</option>
                    <option value="Diretor Administrativo" <?php selected($cargo, 'Diretor Administrativo'); ?>>Diretor Administrativo</option>
                    <option value="Diretor Financeiro" <?php selected($cargo, 'Diretor Financeiro'); ?>>Diretor Financeiro</option>
                    <option value="Diretor Técnico" <?php selected($cargo, 'Diretor Técnico'); ?>>Diretor Técnico</option>
                </optgroup>
                <optgroup label="Conselho Fiscal">
                    <option value="Membro 1" <?php selected($cargo, 'Membro 1'); ?>>Membro 1</option>
                    <option value="Membro 2" <?php selected($cargo, 'Membro 2'); ?>>Membro 2</option>
                    <option value="Membro 3" <?php selected($cargo, 'Membro 3'); ?>>Membro 3</option>
                </optgroup>
            </select>
        </div>

        <div style="margin-top: 20px;">
            <label style="font-weight: bold; display: block; margin-bottom: 10px; font-size: 14px;">Foto do Membro:</label>
            <div id="ic-membro-avatar-container">
                <?php if ( $avatar_url ) : ?>
                    <img src="<?php echo esc_url( $avatar_url ); ?>" style="width: 120px; height: 120px; border-radius: 15px; object-fit: cover; border: 3px solid #2563eb; margin-bottom: 15px; display: block;" id="ic-membro-img">
                <?php else : ?>
                    <div style="width: 120px; height: 120px; border-radius: 15px; background: #f1f5f9; display: flex; align-items: center; justify-content: center; font-size: 40px; color: #cbd5e1; margin-bottom: 15px;" id="ic-membro-img">👤</div>
                <?php endif; ?>
                <input type="hidden" name="ic_membro_avatar" id="ic_membro_avatar" value="<?php echo esc_attr( $avatar_id ); ?>">
                <div style="display: flex; gap: 10px;">
                    <button type="button" class="button ic-upload-membro-btn">Escolher Foto</button>
                    <button type="button" class="button ic-remove-membro-btn" style="color: #ef4444; <?php echo !$avatar_id ? 'display:none;' : ''; ?>">Remover</button>
                </div>
            </div>
        </div>
    </div>
    <script>
    jQuery(document).ready(function($){
        var frame;
        $('.ic-upload-membro-btn').on('click', function(e){
            e.preventDefault();
            if ( frame ) { frame.open(); return; }
            frame = wp.media({ title: 'Escolher Foto do Membro', button: { text: 'Usar esta foto' }, multiple: false });
            frame.on('select', function() {
                var attachment = frame.state().get('selection').first().toJSON();
                $('#ic_membro_avatar').val(attachment.id);
                if($('#ic-membro-img').is('img')){
                    $('#ic-membro-img').attr('src', attachment.url);
                } else {
                    $('#ic-membro-img').replaceWith('<img src="'+attachment.url+'" style="width: 120px; height: 120px; border-radius: 15px; object-fit: cover; border: 3px solid #2563eb; margin-bottom: 15px; display: block;" id="ic-membro-img">');
                }
                $('.ic-remove-membro-btn').show();
            });
            frame.open();
        });
        $('.ic-remove-membro-btn').on('click', function(){
            $('#ic_membro_avatar').val('');
            $('#ic-membro-img').replaceWith('<div style="width: 120px; height: 120px; border-radius: 15px; background: #f1f5f9; display: flex; align-items: center; justify-content: center; font-size: 40px; color: #cbd5e1; margin-bottom: 15px;" id="ic-membro-img">👤</div>');
            $(this).hide();
        });
    });
    </script>
    <?php
}

function ic_agenda_details_callback( $post ) {
    $date = get_post_meta( $post->ID, '_ic_agenda_date', true );
    $time = get_post_meta( $post->ID, '_ic_agenda_time', true );
    $location = get_post_meta( $post->ID, '_ic_agenda_location', true );
    $address = get_post_meta( $post->ID, '_ic_agenda_address', true );
    
    wp_nonce_field( 'ic_agenda_save_meta', 'ic_agenda_nonce' );
    ?>
    <style>
        .ic-meta-row { margin-bottom: 15px; display: flex; flex-direction: column; }
        .ic-meta-row label { font-weight: bold; margin-bottom: 5px; display: block; }
        .ic-meta-row input { padding: 8px; border: 1px solid #ccc; border-radius: 4px; width: 100%; }
        .ic-meta-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
    </style>
    <div class="ic-meta-grid">
        <div class="ic-meta-row">
            <label>Data do Evento</label>
            <input type="date" name="ic_agenda_date" value="<?php echo esc_attr($date); ?>">
        </div>
        <div class="ic-meta-row">
            <label>Horário</label>
            <input type="time" name="ic_agenda_time" value="<?php echo esc_attr($time); ?>">
        </div>
    </div>
    <div class="ic-meta-row">
        <label>Localidade (Cidade/Bairro)</label>
        <input type="text" name="ic_agenda_location" value="<?php echo esc_attr($location); ?>" placeholder="Ex: Comunidade Caiçara, Bertioga">
    </div>
    <div class="ic-meta-row">
        <label>Endereço Completo</label>
        <input type="text" name="ic_agenda_address" value="<?php echo esc_attr($address); ?>" placeholder="Rua, Número, Referência...">
    </div>
    <?php
}

function ic_agenda_save_meta( $post_id ) {
    if ( ! isset( $_POST['ic_agenda_nonce'] ) || ! wp_verify_nonce( $_POST['ic_agenda_nonce'], 'ic_agenda_save_meta' ) ) return;
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

    $fields = array( 'ic_agenda_date', 'ic_agenda_time', 'ic_agenda_location', 'ic_agenda_address' );
    foreach ( $fields as $field ) {
        if ( isset( $_POST[$field] ) ) {
            update_post_meta( $post_id, '_' . $field, sanitize_text_field( $_POST[$field] ) );
        }
    }
}
add_action( 'save_post', 'ic_agenda_save_meta' );

function ic_membro_save_meta( $post_id ) {
    if ( ! isset( $_POST['ic_membro_nonce'] ) || ! wp_verify_nonce( $_POST['ic_membro_nonce'], 'ic_membro_save_meta' ) ) return;
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

    if ( isset( $_POST['ic_membro_cargo'] ) ) {
        update_post_meta( $post_id, '_ic_membro_cargo', sanitize_text_field( $_POST['ic_membro_cargo'] ) );
    }
    if ( isset( $_POST['ic_membro_avatar'] ) ) {
        update_post_meta( $post_id, '_ic_membro_avatar', sanitize_text_field( $_POST['ic_membro_avatar'] ) );
    }
}
add_action( 'save_post', 'ic_membro_save_meta' );

/**
 * CONFIGURAÇÃO SMTP (Opcional - Use se não quiser plugin)
 * Preencha os dados abaixo para o site enviar e-mails via seu servidor.
 */
function icddh_phpmailer_init( $phpmailer ) {
    $phpmailer->isSMTP();
    $phpmailer->Host       = 'smtp.exemplo.com'; // EX: smtp.gmail.com
    $phpmailer->SMTPAuth   = true;
    $phpmailer->Port       = 587; // Ou 465 (SSL)
    $phpmailer->Username   = 'seu-email@exemplo.com';
    $phpmailer->Password   = 'sua-senha-ou-app-password';
    $phpmailer->SMTPSecure = 'tls'; // OU 'ssl'
    $phpmailer->From       = 'contato@icddh.org.br';
    $phpmailer->FromName   = 'Instituto Caiçara (ICDDH)';
}
// Remova o comentário abaixo para ATIVAR o SMTP via código:
// add_action( 'phpmailer_init', 'icddh_phpmailer_init' );


/**
 * Register Custom Post Type: Ações Sociais
 */
function icddh_register_acoes_cpt() {
    $labels = array(
        'name'               => _x( 'Ações Sociais', 'post type general name', 'icddh' ),
        'singular_name'      => _x( 'Ação Social', 'post type singular name', 'icddh' ),
        'menu_name'          => _x( 'Ações Sociais', 'admin menu', 'icddh' ),
        'add_new'            => _x( 'Nova Ação', 'acao', 'icddh' ),
        'add_new_item'       => __( 'Adicionar Nova Ação Social', 'icddh' ),
        'new_item'           => __( 'Nova Ação', 'icddh' ),
        'edit_item'          => __( 'Editar Ação', 'icddh' ),
        'view_item'          => __( 'Ver Ação', 'icddh' ),
        'all_items'          => __( 'Todas as Ações', 'icddh' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'has_archive'        => true,
        'menu_icon'          => 'dashicons-heart',
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
        'rewrite'            => array( 'slug' => 'acoes-sociais' ),
        'show_in_rest'       => true,
    );

    register_post_type( 'acao', $args );
}
add_action( 'init', 'icddh_register_acoes_cpt' );

/**
 * Meta boxes for Social Actions (Event Date)
 */
function icddh_add_acao_metabox() {
    add_meta_box( 'acao_details', 'Detalhes da Ação', 'icddh_acao_metabox_callback', 'acao', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'icddh_add_acao_metabox' );

function icddh_acao_metabox_callback( $post ) {
    $data_evento = get_post_meta( $post->ID, '_acao_data', true );
    wp_nonce_field( 'acao_details_save', 'acao_details_nonce' );
    echo '<p><label for="acao_data">Data do Evento:</label></p>';
    echo '<input type="date" id="acao_data" name="acao_data" value="' . esc_attr( $data_evento ) . '" style="width:100%;" />';
    echo '<p class="description">Defina a data em que esta ação social ocorreu.</p>';
}

function icddh_save_acao_metabox( $post_id ) {
    if ( ! isset( $_POST['acao_details_nonce'] ) || ! wp_verify_nonce( $_POST['acao_details_nonce'], 'acao_details_save' ) ) return;
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;

    if ( isset( $_POST['acao_data'] ) ) {
        update_post_meta( $post_id, '_acao_data', sanitize_text_field( $_POST['acao_data'] ) );
    }
}
add_action( 'save_post', 'icddh_save_acao_metabox' );

/**
 * Meta boxes for Social Actions (Image Gallery)
 */
function icddh_add_acao_gallery_metabox() {
    add_meta_box( 'acao_gallery', 'Galeria de Imagens da Ação', 'icddh_acao_gallery_callback', 'acao', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'icddh_add_acao_gallery_metabox' );

function icddh_acao_gallery_callback( $post ) {
    $gallery_ids = get_post_meta( $post->ID, '_acao_gallery_ids', true );
    wp_nonce_field( 'acao_gallery_save', 'acao_gallery_nonce' );
    ?>
    <div id="acao_gallery_container" style="display: flex; flex-wrap: wrap; gap: 10px; margin-bottom: 15px;">
        <?php
        if ( ! empty( $gallery_ids ) ) {
            $ids = explode( ',', $gallery_ids );
            foreach ( $ids as $id ) {
                $img_url = wp_get_attachment_image_url( $id, 'thumbnail' );
                if ( $img_url ) {
                    echo '<div class="gallery-item" data-id="' . $id . '" style="position: relative; border: 1px solid #ddd; padding: 2px;">';
                    echo '<img src="' . $img_url . '" style="width: 80px; height: 80px; object-cover: cover; display: block;" />';
                    echo '<button type="button" class="remove-gallery-img" style="position: absolute; top: -5px; right: -5px; background: red; color: white; border: none; border-radius: 50%; width: 20px; height: 20px; cursor: pointer; font-size: 12px;">×</button>';
                    echo '</div>';
                }
            }
        }
        ?>
    </div>
    <input type="hidden" name="acao_gallery_ids" id="acao_gallery_ids" value="<?php echo esc_attr( $gallery_ids ); ?>" />
    <button type="button" id="add_acao_gallery_btn" class="button button-secondary">Adicionar Imagens à Galeria</button>

    <script>
        jQuery(document).ready(function($) {
            var frame;
            $('#add_acao_gallery_btn').on('click', function(e) {
                e.preventDefault();
                if (frame) { frame.open(); return; }
                frame = wp.media({
                    title: 'Selecionar Imagens para a Galeria',
                    button: { text: 'Adicionar à Galeria' },
                    multiple: true
                });
                frame.on('select', function() {
                    var selection = frame.state().get('selection');
                    var ids = $('#acao_gallery_ids').val() ? $('#acao_gallery_ids').val().split(',') : [];
                    selection.map(function(attachment) {
                        attachment = attachment.toJSON();
                        if ($.inArray(attachment.id.toString(), ids) === -1) {
                            ids.push(attachment.id);
                            $('#acao_gallery_container').append(
                                '<div class="gallery-item" data-id="' + attachment.id + '" style="position: relative; border: 1px solid #ddd; padding: 2px;">' +
                                '<img src="' + (attachment.sizes.thumbnail ? attachment.sizes.thumbnail.url : attachment.url) + '" style="width: 80px; height: 80px; object-fit: cover; display: block;" />' +
                                '<button type="button" class="remove-gallery-img" style="position: absolute; top: -5px; right: -5px; background: red; color: white; border: none; border-radius: 50%; width: 20px; height: 20px; cursor: pointer; font-size: 12px;">×</button>' +
                                '</div>'
                            );
                        }
                    });
                    $('#acao_gallery_ids').val(ids.join(','));
                });
                frame.open();
            });

            $(document).on('click', '.remove-gallery-img', function() {
                var item = $(this).parent();
                var id = item.data('id').toString();
                var ids = $('#acao_gallery_ids').val().split(',');
                ids = ids.filter(function(i) { return i !== id; });
                $('#acao_gallery_ids').val(ids.join(','));
                item.remove();
            });
        });
    </script>
    <?php
}

function icddh_save_acao_gallery_metabox( $post_id ) {
    if ( ! isset( $_POST['acao_gallery_nonce'] ) || ! wp_verify_nonce( $_POST['acao_gallery_nonce'], 'acao_gallery_save' ) ) return;
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    
    if ( isset( $_POST['acao_gallery_ids'] ) ) {
        update_post_meta( $post_id, '_acao_gallery_ids', sanitize_text_field( $_POST['acao_gallery_ids'] ) );
    }
}
add_action( 'save_post', 'icddh_save_acao_gallery_metabox' );

/**
 * Custom Nav Menu Walker for Tailwind CSS
 */
/**
 * Custom Nav Menu Walker for Dropdowns
 */
class ICDDH_Walker_Nav_Menu extends Walker_Nav_Menu {
    function start_lvl( &$output, $depth = 0, $args = null ) {
        $indent = str_repeat("\t", $depth);
        // Mobile: hidden by default | Desktop: absolute, hidden/hover
        $output .= "\n$indent<div class=\"mobile-submenu hidden md:block md:absolute md:top-full md:left-0 md:mt-2 w-full md:w-56 bg-gray-50/50 md:bg-white md:rounded-2xl md:shadow-2xl md:border md:border-primary-50 py-1 md:py-3 md:opacity-0 md:invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform md:translate-y-2 group-hover:translate-y-0 z-[60]\">\n";
        $output .= "$indent<ul class=\"flex flex-col\">\n";
    }

    function end_lvl( &$output, $depth = 0, $args = null ) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n";
        $output .= "$indent</div>\n";
    }

    function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $has_children = in_array( 'menu-item-has-children', $classes );
        
        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
        $url = $item->url;
        if ( strpos( $url, '#' ) === 0 && ! is_front_page() ) {
            $url = esc_url( home_url( '/' ) ) . $url;
        }

        if ( $depth === 0 ) {
            // Main level items - Vertical stack on mobile, horizontal on desktop
            $output .= '<div class="relative group w-full md:w-auto flex flex-col md:flex-row md:items-center">';
            
            $link_classes = "w-full md:w-auto hover:text-primary-700 hover:bg-primary-50 transition-all px-4 md:px-3 py-3 md:py-2 rounded-xl flex items-center justify-between md:justify-start gap-2 text-gray-700 font-bold md:font-medium " . esc_attr( $class_names );
            
            // If has children, we add a toggle behavior for mobile
            $toggle_attr = $has_children ? ' onclick="toggleMobileSubmenu(event, this)" ' : '';
            
            $output .= '<a href="' . esc_url( $url ) . '" ' . $toggle_attr . ' class="' . $link_classes . '">';
            $output .= apply_filters( 'the_title', $item->title, $item->ID );
            
            if ( $has_children ) {
                $output .= '<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 md:h-3 md:w-3 opacity-50 group-hover:rotate-180 transition-transform submenu-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7" /></svg>';
            }
            
            $output .= '</a>';
        } else {
            // Sub-menu level items
            $output .= '<li class="px-2">';
            $output .= '<a href="' . esc_url( $url ) . '" class="block px-6 py-2.5 rounded-xl text-sm font-semibold text-gray-600 hover:text-primary-700 hover:bg-primary-50 transition-all ' . esc_attr( $class_names ) . '">';
            $output .= apply_filters( 'the_title', $item->title, $item->ID );
            $output .= '</a>';
            $output .= '</li>';
        }
    }

    function end_el( &$output, $item, $depth = 0, $args = null ) {
        if ( $depth === 0 ) {
            $output .= '</div>';
        }
    }
}

/**
 * Enqueue styles and scripts
 */
function icddh_enqueue_scripts() {
    // Tailwind CSS via CDN as requested in the HTML snippet
    wp_enqueue_script( 'tailwind-cdn', 'https://cdn.tailwindcss.com', array(), '3.4.1', false );

    // Custom Inter font from Google
    wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap', array(), null );

    // Main theme stylesheet (standard WP way)
    wp_enqueue_style( 'icddh-style', get_stylesheet_uri(), array(), '1.0.0' );

    // Inline Tailwind config and custom CSS
    $tailwind_config = "
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            200: '#bfdbfe',
                            300: '#93c5fd',
                            400: '#60a5fa',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                            800: '#1e40af',
                            900: '#1e3a8a',
                            950: '#020617',
                        },
                        ocean: '#0c4e6e',
                        wave: '#eef2ff',
                    },
                    fontFamily: {
                        'sans': ['Inter', 'system-ui', 'Segoe UI', 'Roboto', 'Helvetica Neue', 'sans-serif'],
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.6s ease-out',
                        'slide-up': 'slideUp 0.5s ease-out',
                        'float': 'float 4s ease-in-out infinite',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' },
                        },
                        slideUp: {
                            '0%': { opacity: '0', transform: 'translateY(20px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        },
                        float: {
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-8px)' },
                        },
                    },
                }
            }
        }
    ";
    wp_add_inline_script( 'tailwind-cdn', $tailwind_config, 'after' );
}
add_action( 'wp_enqueue_scripts', 'icddh_enqueue_scripts' );

/**
 * Custom CSS for transitions and waves
 */
function icddh_custom_css() {
    ?>
    <style>
        html { scroll-behavior: smooth; }
        .hero-wave { background: linear-gradient(135deg, #eff6ff 0%, #ffffff 100%); }
        .card-hover { transition: all 0.3s cubic-bezier(0.2, 0, 0, 1); }
        .card-hover:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 25px -12px rgba(0, 0, 0, 0.1), 0 4px 8px -4px rgba(0, 0, 0, 0.02);
        }
        
        /* Dropdown Transitions */
        .group:hover svg { transform: rotate(180deg); }
        .transition-smooth { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        
        /* Hover Desktop Menu */
        @media (min-width: 768px) {
            .group:hover > div {
                opacity: 1 !important;
                visibility: visible !important;
                transform: translateY(0) !important;
            }
        }
        
        /* Mobile Menu Indentation */
        @media (max-width: 767px) {
            .menu-item-has-children > div {
                position: relative !important;
                left: 0 !important;
                top: 0 !important;
                margin-top: 0 !important;
                padding-left: 1.5rem !important;
                box-shadow: none !important;
                border: none !important;
                opacity: 1 !important;
                visibility: visible !important;
                display: block !important;
            }
            .menu-item-has-children > div ul {
                border-l-2 border-primary-50 ml-2;
            }
        }

        /* Prose Typography for standard pages */
        .prose-icddh h2 { font-size: 1.875rem; font-weight: 900; margin-top: 3.5rem; margin-bottom: 1.5rem; letter-spacing: -0.05em; color: #111827; border-left: 6px solid #2563eb; padding-left: 1.25rem; line-height: 1.2; }
        .prose-icddh h3 { font-size: 1.5rem; font-weight: 800; margin-top: 2.5rem; margin-bottom: 1rem; color: #1f2937; letter-spacing: -0.025em; }
        .prose-icddh h4 { font-size: 1.25rem; font-weight: 800; margin-top: 2rem; margin-bottom: 0.75rem; color: #374151; }
        .prose-icddh p { font-size: 1.125rem; line-height: 1.85; color: #4b5563; margin-bottom: 1.75rem; font-weight: 500; }
        .prose-icddh a { color: #2563eb; font-weight: 700; text-decoration: none; border-bottom: 2px solid #dbeafe; transition: all 0.3s ease; }
        .prose-icddh a:hover { border-bottom-color: #2563eb; background: #eff6ff; }
        .prose-icddh ul { list-style: none; padding-left: 0; margin-bottom: 2rem; }
        .prose-icddh ul li { position: relative; padding-left: 1.75rem; margin-bottom: 1rem; color: #4b5563; font-weight: 500; }
        .prose-icddh ul li::before { content: "→"; position: absolute; left: 0; color: #2563eb; font-weight: 900; }
        .prose-icddh blockquote { border-left: 4px solid #e5e7eb; padding-left: 1.5rem; color: #6b7280; font-style: italic; margin: 3rem 0; font-size: 1.25rem; line-height: 1.6; }
        .prose-icddh img { border-radius: 2rem; margin: 3rem auto; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.08); display: block; }
        .prose-icddh table { border-collapse: collapse; width: 100%; margin: 2rem 0; font-size: 0.95rem; }
        .prose-icddh th { background: #f9fafb; padding: 1rem; text-align: left; font-weight: 900; color: #111827; border-bottom: 2px solid #f3f4f6; }
        .prose-icddh td { padding: 1rem; border-bottom: 1px solid #f3f4f6; color: #4b5563; }
    </style>
    <?php
}
add_action( 'wp_head', 'icddh_custom_css' );

/**
 * ==========================================
 * IC-AUTH: CUSTOM AUTHENTICATION SYSTEM
 * ==========================================
 */

/**
 * 1. Logic for Custom Login & Registration
 */
function icddh_handle_custom_auth() {
    if ( is_admin() && ! ( defined( 'DOING_AJAX' ) && DOING_AJAX ) ) return;

    // HANDLE EMAIL CONFIRMATION
    if ( isset( $_GET['ic_action'] ) && $_GET['ic_action'] === 'confirm_email' && isset( $_GET['token'] ) && isset( $_GET['uid'] ) ) {
        $user_id = intval( $_GET['uid'] );
        $saved_token = get_user_meta( $user_id, '_ic_conf_token', true );
        
        if ( $saved_token && $saved_token === $_GET['token'] ) {
            update_user_meta( $user_id, '_ic_user_status', 'approved' );
            delete_user_meta( $user_id, '_ic_conf_token' );
            wp_redirect( add_query_arg( 'msg', 'confirmed', home_url( '/entrar' ) ) );
            exit;
        } else {
            wp_die( 'Token de confirmação inválido ou expirado.' );
        }
    }

    if ( ! isset( $_POST['ic_auth_action'] ) ) return;

    $action = $_POST['ic_auth_action'];
    $nonce = $_POST['ic_auth_nonce'] ?? '';

    if ( ! wp_verify_nonce( $nonce, 'ic_auth_action' ) ) {
        wp_die( 'Erro de segurança. Tente novamente.' );
    }

    // LOGIN ACTION
    if ( $action === 'login' ) {
        $username = sanitize_user( $_POST['user_login'] );
        $password = $_POST['user_password'];

        $user = get_user_by( 'login', $username );
        if ( ! $user ) $user = get_user_by( 'email', $username );

        if ( $user ) {
            $status = get_user_meta( $user->ID, '_ic_user_status', true );
            
            if ( $status === 'pending' ) {
                wp_redirect( add_query_arg( 'login', 'pending_approval', home_url( '/entrar' ) ) );
                exit;
            }
            if ( $status === 'pending_confirmation' ) {
                wp_redirect( add_query_arg( 'login', 'pending_confirmation', home_url( '/entrar' ) ) );
                exit;
            }
        }

        $info = array(
            'user_login'    => $username,
            'user_password' => $password,
            'remember'      => isset( $_POST['rememberme'] )
        );

        $user_signon = wp_signon( $info, false );

        if ( is_wp_error( $user_signon ) ) {
            wp_redirect( add_query_arg( 'login', 'failed', home_url( '/entrar' ) ) );
            exit;
        } else {
            wp_redirect( home_url( '/painel' ) );
            exit;
        }
    }

    // REGISTER ACTION
    if ( $action === 'register' ) {
        $user_email = sanitize_email( $_POST['user_email'] );
        $user_login = sanitize_user( $_POST['user_login'] );
        $user_pass  = $_POST['user_password'];
        $user_name  = sanitize_text_field( $_POST['first_name'] );

        // Basic validation
        if ( empty( $user_email ) || empty( $user_login ) || empty( $user_pass ) ) {
            wp_redirect( add_query_arg( 'register', 'missing_fields', home_url( '/entrar' ) ) );
            exit;
        }

        if ( email_exists( $user_email ) ) {
            wp_redirect( add_query_arg( 'register', 'email_exists', home_url( '/entrar' ) ) );
            exit;
        }

        if ( username_exists( $user_login ) ) {
            wp_redirect( add_query_arg( 'register', 'user_exists', home_url( '/entrar' ) ) );
            exit;
        }

        // TODOS começam como Assinante (subscriber) por segurança
        $user_id = wp_insert_user( array(
            'user_login' => $user_login,
            'user_pass'  => $user_pass,
            'user_email' => $user_email,
            'first_name' => $user_name,
            'display_name' => $user_name ?: $user_login,
            'role'       => 'subscriber'
        ) );

        if ( is_wp_error( $user_id ) ) {
            wp_redirect( add_query_arg( 'register', 'failed', home_url( '/entrar' ) ) );
            exit;
        } else {
            update_user_meta( $user_id, '_ic_user_status', 'pending_confirmation' );
            
            // SEND CONFIRMATION EMAIL
            $token = wp_generate_password( 20, false );
            update_user_meta( $user_id, '_ic_conf_token', $token );
            
            $conf_url = add_query_arg( array(
                'ic_action' => 'confirm_email',
                'uid'       => $user_id,
                'token'     => $token
            ), home_url( '/entrar' ) );

            $subject = "Confirme seu cadastro - Instituto Caiçara";
            $message = "Olá $user_name,\n\nPara ativar sua conta de assinante, clique no link abaixo:\n$conf_url\n\nEquipe ICDDH.";
            wp_mail( $user_email, $subject, $message );

            wp_redirect( add_query_arg( 'register', 'success_pending_confirm', home_url( '/entrar' ) ) );
            exit;
        }
    }
}
add_action( 'init', 'icddh_handle_custom_auth' );

/**
 * 2. Redirect wp-login.php to /entrar
 */
function icddh_redirect_login_page() {
    $login_page  = home_url( '/entrar' );
    $page_viewed = basename( $_SERVER['REQUEST_URI'] );

    if ( $page_viewed == "wp-login.php" && $_SERVER['REQUEST_METHOD'] == 'GET' && ! isset( $_GET['action'] ) ) {
        wp_redirect( $login_page );
        exit;
    }
}
add_action( 'init', 'icddh_redirect_login_page' );

/**
 * 3. Logout Redirect
 */
function icddh_redirect_after_logout() {
    wp_redirect( home_url( '/' ) );
    exit;
}
add_action( 'wp_logout', 'icddh_redirect_after_logout' );

/**
 * 4. Admin Bar Visibility
 * Only shows the admin bar for Staff (Editors and Admins)
 */
function icddh_smart_admin_bar() {
    if ( ! current_user_can( 'edit_posts' ) ) {
        show_admin_bar( false );
    }
}
add_action( 'after_setup_theme', 'icddh_smart_admin_bar' );

/**
 * 6. AJAX: Toggle User Role (Editor <-> Subscriber)
 */
function icddh_ajax_change_user_role() {
    if ( ! current_user_can( 'editor' ) && ! current_user_can( 'administrator' ) ) {
        wp_send_json_error( 'Permissão negada.' );
    }

    $user_id = intval( $_POST['user_id'] );
    $new_role = sanitize_text_field( $_POST['new_role'] );

    if ( $user_id && in_array($new_role, ['editor', 'subscriber']) ) {
        $u = new WP_User( $user_id );
        $u->set_role( $new_role );
        wp_send_json_success( 'Função atualizada com sucesso!' );
    }
    wp_send_json_error( 'Ocorreu um erro ao atualizar a função.' );
}
add_action( 'wp_ajax_ic_change_user_role', 'icddh_ajax_change_user_role' );

/**
 * ==========================================
 * CAIÇARAS DO FUTURO: PRE-REGISTRATION SYSTEM
 * ==========================================
 */

/**
 * 1. Create Pre-registration Table
 */
function ic_create_pre_registration_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'caicaras_pre_inscricao';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
        name tinytext NOT NULL,
        email varchar(100) NOT NULL,
        whatsapp varchar(20) NOT NULL,
        age int(3) NOT NULL,
        city varchar(50) NOT NULL,
        neighborhood varchar(100) NOT NULL,
        guardian_name varchar(100) DEFAULT '' NOT NULL,
        guardian_whatsapp varchar(20) DEFAULT '' NOT NULL,
        batch int(1) NOT NULL,
        status varchar(20) DEFAULT 'pending' NOT NULL,
        PRIMARY KEY  (id)
    ) $charset_collate;";

    // Create Waitlist Table
    $table_waitlist = $wpdb->prefix . 'caicaras_lista_espera';
    $sql_waitlist = "CREATE TABLE $table_waitlist (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
        name tinytext NOT NULL,
        whatsapp varchar(20) NOT NULL,
        batch int(1) NOT NULL,
        PRIMARY KEY  (id)
    ) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
    dbDelta( $sql_waitlist );

    // Initialize Settings if not exists
    if ( false === get_option( 'caicaras_current_batch' ) ) {
        update_option( 'caicaras_current_batch', 1 );
    }
    if ( false === get_option( 'caicaras_registration_status' ) ) {
        update_option( 'caicaras_registration_status', 'open' );
    }
}
add_action( 'after_switch_theme', 'ic_create_pre_registration_table' );
// Also run check on init for development
add_action( 'init', function() {
    if ( isset($_GET['setup_caicaras_table']) ) {
        ic_create_pre_registration_table();
        echo "Sistema Caiçaras do Futuro Atualizado com Sucesso!";
        exit;
    }
});

/**
 * 2. AJAX Handler for Pre-registration
 */
function ic_handle_pre_inscricao() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'caicaras_pre_inscricao';

    // Verify Nonce (will be sent from JS)
    if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'caicaras_nonce' ) ) {
        wp_send_json_error( 'Erro de segurança. Por favor, recarregue a página.' );
    }

    // Check Limit and Status
    $current_batch = (int) get_option( 'caicaras_current_batch', 1 );
    $reg_status = get_option( 'caicaras_registration_status', 'open' );
    $count = ic_get_pre_inscricao_count($current_batch);
    $limit = 20; // 20 fixed per batch

    if ( $reg_status !== 'open' || $count >= $limit ) {
        wp_send_json_error( 'As vagas para esta turma foram pausadas para seleção.' );
    }

    // Sanitize and Validate
    $name = sanitize_text_field( $_POST['name'] );
    $email = sanitize_email( $_POST['email'] );
    $whatsapp = sanitize_text_field( $_POST['whatsapp'] );
    $age = intval( $_POST['age'] );
    $city = sanitize_text_field( $_POST['city'] );
    $neighborhood = sanitize_text_field( $_POST['neighborhood'] );
    $guardian_name = sanitize_text_field( $_POST['guardian_name'] ?? '' );
    $guardian_whatsapp = sanitize_text_field( $_POST['guardian_whatsapp'] ?? '' );

    if ( empty( $name ) || empty( $whatsapp ) || empty( $age ) ) {
        wp_send_json_error( 'Campos obrigatórios ausentes.' );
    }

    // Insert into DB
    $result = $wpdb->insert(
        $table_name,
        array(
            'time' => current_time( 'mysql' ),
            'name' => $name,
            'email' => $email,
            'whatsapp' => $whatsapp,
            'age' => $age,
            'city' => $city,
            'neighborhood' => $neighborhood,
            'guardian_name' => $guardian_name,
            'guardian_whatsapp' => $guardian_whatsapp,
            'batch' => $current_batch,
            'status' => 'pending'
        )
    );

    if ( $result ) {
        // Send Notification Email to Admin
        $admin_email = 'direitoscaicara@gmail.com';
        $subject = "Nova Pré-Inscrição: Caiçaras do Futuro - $name";
        $message = "Uma nova pré-inscrição foi recebida!\n\n";
        $message .= "Nome: $name\n";
        $message .= "Idade: $age\n";
        $message .= "Cidade: $city\n";
        $message .= "Bairro: $neighborhood\n";
        $message .= "WhatsApp: $whatsapp\n";
        if ( $age < 18 ) {
            $message .= "Responsável: $guardian_name ($guardian_whatsapp)\n";
        }
        $message .= "\nVeja todos os inscritos no banco de dados.";

        wp_mail( $admin_email, $subject, $message );

        wp_send_json_success( 'Sua pré-inscrição foi recebida com sucesso! Aguarde nosso contato.' );
    } else {
        wp_send_json_error( 'Ocorreu um erro ao salvar seus dados. Tente novamente mais tarde.' );
    }
}
add_action( 'wp_ajax_ic_pre_inscricao', 'ic_handle_pre_inscricao' );
add_action( 'wp_ajax_nopriv_ic_pre_inscricao', 'ic_handle_pre_inscricao' );

/**
 * Handle Waitlist Submission
 */
function ic_handle_waitlist() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'caicaras_lista_espera';

    // Verify Nonce
    if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'caicaras_nonce' ) ) {
        wp_send_json_error( 'Erro de segurança. Recarregue a página.' );
    }

    $name = sanitize_text_field( $_POST['name'] );
    $whatsapp = sanitize_text_field( $_POST['whatsapp'] );
    $batch = (int) get_option( 'caicaras_current_batch', 1 );

    if ( empty( $name ) || empty( $whatsapp ) ) {
        wp_send_json_error( 'Preencha seu nome e whatsapp.' );
    }

    // REGRA: Verificar se o número já existe na lista de espera desta turma
    $exists = $wpdb->get_var( $wpdb->prepare(
        "SELECT COUNT(*) FROM $table_name WHERE whatsapp = %s AND batch = %d",
        $whatsapp,
        $batch
    ));

    if ( $exists > 0 ) {
        wp_send_json_error( 'Este WhatsApp já está cadastrado na nossa lista de avisos! Fique tranquilo, você será avisado.' );
    }

    $result = $wpdb->insert(
        $table_name,
        array(
            'time' => current_time( 'mysql' ),
            'name' => $name,
            'whatsapp' => $whatsapp,
            'batch' => $batch
        )
    );

    if ( $result ) {
        // Notificar Instituto
        $to = 'direitoscaicara@gmail.com';
        $subject = "Lista de Espera: $name";
        $body = "Um novo jovem se cadastrou na lista de espera!\n\nNome: $name\nWhatsApp: $whatsapp\nInteressado na próxima turma.";
        wp_mail( $to, $subject, $body );

        wp_send_json_success( 'Você foi adicionado à lista de avisos!' );
    } else {
        wp_send_json_error( 'Erro ao salvar. Tente novamente.' );
    }
    wp_die();
}
add_action( 'wp_ajax_ic_waitlist', 'ic_handle_waitlist' );
add_action( 'wp_ajax_nopriv_ic_waitlist', 'ic_handle_waitlist' );

/**
 * Add Settings Page to Dashboard
 */
function ic_caicaras_menu() {
    add_menu_page(
        'Caiçaras do Futuro',
        'Caiçaras',
        'edit_posts', // Permite Admins e Editores
        'caicaras-settings',
        'ic_caicaras_settings_page',
        'dashicons-groups',
        30
    );
}
add_action( 'admin_menu', 'ic_caicaras_menu' );

function ic_caicaras_settings_page() {
    global $wpdb;
    $table_reg = $wpdb->prefix . 'caicaras_pre_inscricao';
    $table_wait = $wpdb->prefix . 'caicaras_lista_espera';

    // 1. Handle Deletion
    if ( isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id']) ) {
        $id = intval($_GET['id']);
        $type = sanitize_text_field($_GET['type']);
        $target_table = ($type === 'wait') ? $table_wait : $table_reg;
        
        $wpdb->delete($target_table, array('id' => $id));
        echo '<div class="updated"><p>Registro excluído com sucesso!</p></div>';
    }

    // 2. Handle Edit Save
    if ( isset($_POST['update_caicara']) ) {
        $id = intval($_POST['edit_id']);
        $wpdb->update($table_reg, array(
            'name' => sanitize_text_field($_POST['name']),
            'whatsapp' => sanitize_text_field($_POST['whatsapp']),
            'city' => sanitize_text_field($_POST['city']),
            'neighborhood' => sanitize_text_field($_POST['neighborhood'])
        ), array('id' => $id));
        echo '<div class="updated"><p>Registro atualizado!</p></div>';
    }

    // 3. Handle Batch/Status Settings
    if ( isset($_POST['save_caicaras']) ) {
        update_option('caicaras_current_batch', intval($_POST['batch']));
        update_option('caicaras_registration_status', sanitize_text_field($_POST['status']));
        echo '<div class="updated"><p>Configurações salvas!</p></div>';
    }

    $current_batch = get_option('caicaras_current_batch', 1);
    $status = get_option('caicaras_registration_status', 'open');
    $count = ic_get_pre_inscricao_count($current_batch);
    $limit = 20;

    // 3. Fetch Data
    $registrations = $wpdb->get_results("SELECT * FROM $table_reg ORDER BY time ASC");
    $waitlist = $wpdb->get_results("SELECT * FROM $table_wait ORDER BY time ASC");

    // 4. Check if we are Editing or Viewing
    $edit_reg = null;
    $view_reg = null;
    if ( isset($_GET['action']) && isset($_GET['id']) ) {
        $action_id = intval($_GET['id']);
        if ($_GET['action'] === 'edit') {
            $edit_reg = $wpdb->get_row("SELECT * FROM $table_reg WHERE id = $action_id");
        } elseif ($_GET['action'] === 'view') {
            $view_reg = $wpdb->get_row("SELECT * FROM $table_reg WHERE id = $action_id");
        }
    }
    ?>
    <div class="wrap">
        <h1>Gestão Caiçaras do Futuro</h1>

        <?php if ($view_reg) : ?>
            <div class="card" style="max-width: 600px; padding: 25px; border-left: 6px solid #00a0d2; margin-bottom: 30px; background: #fff; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                <h2 style="margin-top:0; border-bottom: 1px solid #eee; padding-bottom: 10px;">Ficha Completa: <?php echo $view_reg->name; ?></h2>
                <table class="form-table">
                    <tr><th>Data da Inscrição</th><td><?php echo date('d/m/Y H:i', strtotime($view_reg->time)); ?></td></tr>
                    <tr><th>Turma</th><td><strong><?php echo $view_reg->batch; ?>ª Turma</strong></td></tr>
                    <tr><th>Idade</th><td><?php echo $view_reg->age; ?> anos</td></tr>
                    <tr><th>WhatsApp</th><td><strong><?php echo $view_reg->whatsapp; ?></strong> <a href="https://wa.me/55<?php echo preg_replace('/\D/', '', $view_reg->whatsapp); ?>" target="_blank" class="button button-small">Abrir Conversa</a></td></tr>
                    <tr><th>E-mail</th><td><?php echo $view_reg->email; ?></td></tr>
                    <tr><th>Localização</th><td><?php echo $view_reg->city; ?> - <?php echo $view_reg->neighborhood; ?></td></tr>
                    
                    <?php if ($view_reg->age < 18) : ?>
                        <tr style="background: #fff8e5;"><th colspan="2" style="padding: 10px; font-weight: bold; color: #856404;">DADOS DO RESPONSÁVEL LEGAL (MENOR)</th></tr>
                        <tr style="background: #fff8e5;"><th>Nome do Responsável</th><td><?php echo $view_reg->guardian_name; ?></td></tr>
                        <tr style="background: #fff8e5;"><th>WhatsApp Responsável</th><td><?php echo $view_reg->guardian_whatsapp; ?> <a href="https://wa.me/55<?php echo preg_replace('/\D/', '', $view_reg->guardian_whatsapp); ?>" target="_blank" class="button button-small">Falar com Responsável</a></td></tr>
                    <?php endif; ?>
                </table>
                <p style="margin-top: 20px;">
                    <a href="?page=caicaras-settings" class="button button-primary">Voltar para a Lista</a>
                    <a href="?page=caicaras-settings&action=edit&id=<?php echo $view_reg->id; ?>" class="button">Editar Dados</a>
                </p>
            </div>
        <?php endif; ?>

        <?php if ($edit_reg) : ?>
            <div class="card" style="max-width: 500px; padding: 20px; border-top: 4px solid #ffb900; margin-bottom: 30px;">
                <h2>Editar Inscrito</h2>
                <form method="post">
                    <input type="hidden" name="edit_id" value="<?php echo $edit_reg->id; ?>">
                    <table class="form-table">
                        <tr><th>Nome</th><td><input type="text" name="name" value="<?php echo $edit_reg->name; ?>" class="regular-text"></td></tr>
                        <tr><th>Zap</th><td><input type="text" name="whatsapp" value="<?php echo $edit_reg->whatsapp; ?>" class="regular-text"></td></tr>
                        <tr><th>Cidade</th><td><input type="text" name="city" value="<?php echo $edit_reg->city; ?>" class="regular-text"></td></tr>
                        <tr><th>Bairro</th><td><input type="text" name="neighborhood" value="<?php echo $edit_reg->neighborhood; ?>" class="regular-text"></td></tr>
                    </table>
                    <p>
                        <button type="submit" name="update_caicara" class="button button-primary">Salvar Alterações</button>
                        <a href="?page=caicaras-settings" class="button">Cancelar</a>
                    </p>
                </form>
            </div>
        <?php endif; ?>
        
        <div style="display: flex; gap: 20px; flex-wrap: wrap; margin-bottom: 30px;">
            <div class="card" style="flex: 1; min-width: 300px; padding: 20px;">
                <h2>Controle de Turma</h2>
                <form method="post">
                    <table class="form-table">
                        <tr>
                            <th>Turma Ativa</th>
                            <td>
                                <select name="batch">
                                    <option value="1" <?php selected($current_batch, 1); ?>>1ª Turma</option>
                                    <option value="2" <?php selected($current_batch, 2); ?>>2ª Turma</option>
                                    <option value="3" <?php selected($current_batch, 3); ?>>3ª Turma</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>Status do Site</th>
                            <td>
                                <select name="status">
                                    <option value="open" <?php selected($status, 'open'); ?>>Aberto</option>
                                    <option value="paused" <?php selected($status, 'paused'); ?>>Pausado (Seleção)</option>
                                </select>
                            </td>
                        </tr>
                    </table>
                    <p><button type="submit" name="save_caicaras" class="button button-primary">Salvar Configurações</button></p>
                </form>
            </div>

            <div class="card" style="flex: 1; min-width: 300px; padding: 20px; background: #f0f0f1; border-left: 4px solid #0073aa;">
                <h2>Resumo da Turma <?php echo $current_batch; ?></h2>
                <p style="font-size: 24px; margin: 10px 0;"><strong><?php echo $count; ?> / <?php echo $limit; ?></strong> Inscritos</p>
                <div style="background: #ddd; height: 10px; border-radius: 5px; overflow: hidden;">
                    <div style="background: #0073aa; width: <?php echo min(100, ($count/$limit)*100); ?>%; height: 100%;"></div>
                </div>
            </div>
        </div>

        <h2>Lista de Pré-Inscritos (Oficiais)</h2>
        <table class="wp-list-table widefat fixed striped">
            <thead>
                <tr>
                    <th style="width: 40px;">#</th>
                    <th>Data</th>
                    <th>Nome</th>
                    <th>Zap</th>
                    <th>Localização</th>
                    <th>Turma</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($registrations) : $pos = 1; foreach ($registrations as $reg) : ?>
                <tr>
                    <td><strong><?php echo $pos++; ?></strong></td>
                    <td><?php echo date('d/m H:i', strtotime($reg->time)); ?></td>
                    <td><strong><?php echo $reg->name; ?></strong></td>
                    <td><a href="https://wa.me/55<?php echo preg_replace('/\D/', '', $reg->whatsapp); ?>" target="_blank"><?php echo $reg->whatsapp; ?></a></td>
                    <td><?php echo $reg->city; ?> - <?php echo $reg->neighborhood; ?></td>
                    <td><span class="badge"><?php echo $reg->batch; ?>ª</span></td>
                    <td>
                        <a href="?page=caicaras-settings&action=view&id=<?php echo $reg->id; ?>" class="button button-small">Ver</a>
                        <a href="?page=caicaras-settings&action=edit&id=<?php echo $reg->id; ?>" class="button button-small">Editar</a>
                        <a href="?page=caicaras-settings&action=delete&type=reg&id=<?php echo $reg->id; ?>" class="button button-small" style="color: #a00;" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
                    </td>
                </tr>
                <?php endforeach; else : ?>
                <tr><td colspan="6">Ninguém inscrito ainda.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>

        <h2 style="margin-top: 40px;">Lista de Espera</h2>
        <table class="wp-list-table widefat fixed striped">
            <thead>
                <tr>
                    <th style="width: 40px;">#</th>
                    <th>Data</th>
                    <th>Nome</th>
                    <th>Zap</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($waitlist) : $pos = 1; foreach ($waitlist as $wait) : ?>
                <tr>
                    <td><strong><?php echo $pos++; ?></strong></td>
                    <td><?php echo date('d/m H:i', strtotime($wait->time)); ?></td>
                    <td><?php echo $wait->name; ?></td>
                    <td><?php echo $wait->whatsapp; ?></td>
                    <td>
                        <a href="?page=caicaras-settings&action=delete&type=wait&id=<?php echo $wait->id; ?>" class="button button-small" style="color: #a00;" onclick="return confirm('Excluir da espera?')">Excluir</a>
                    </td>
                </tr>
                <?php endforeach; else : ?>
                <tr><td colspan="5">Ninguém na lista de espera.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <style>
        .badge { background: #0073aa; color: white; padding: 2px 8px; border-radius: 10px; font-size: 11px; }
        .card h2 { margin-top: 0; }
    </style>
    <?php
}

/**
 * Get current pre-registration count for a specific batch
 */
function ic_get_pre_inscricao_count($batch = 1) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'caicaras_pre_inscricao';
    return (int) $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM $table_name WHERE batch = %d", $batch));
}
