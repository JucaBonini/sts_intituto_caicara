<?php
/**
 * Template Name: Autenticação (Login/Cadastro)
 * Description: Página simplificada para Login e Cadastro de usuários.
 */

if ( is_user_logged_in() ) {
    wp_redirect( home_url( '/painel' ) );
    exit;
}

get_header(); ?>

<div class="min-h-[80vh] flex items-center justify-center p-6 bg-gray-50">
    <div class="max-w-md w-full bg-white rounded-[2.5rem] shadow-2xl overflow-hidden border border-gray-100 p-8 lg:p-12">
        
        <!-- LOGO (Opcional, mas mantém identidade) -->
        <div class="flex justify-center mb-10">
            <div class="w-16 h-16 bg-primary-50 rounded-2xl flex items-center justify-center border border-primary-100">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.webp" alt="Logo" class="w-10 h-10 object-contain">
            </div>
        </div>

        <!-- ABAS DE NAVEGAÇÃO -->
        <div class="flex gap-8 mb-10 border-b border-gray-100 pb-4">
            <button onclick="switchTab('login')" id="tab-login" class="text-lg font-bold transition-all border-b-2 border-primary-600 text-primary-600 pb-4 -mb-5">Entrar</button>
            <button onclick="switchTab('register')" id="tab-register" class="text-lg font-bold text-gray-400 hover:text-gray-600 transition-all pb-4 -mb-5">Cadastrar</button>
        </div>

        <!-- FEEDBACK MESSAGES -->
        <?php if(isset($_GET['login'])) : ?>
            <div class="p-4 rounded-xl mb-6 text-xs font-medium border animate-slide-up <?php echo ($_GET['login'] == 'failed') ? 'bg-red-50 text-red-600 border-red-100' : 'bg-amber-50 text-amber-700 border-amber-100'; ?>">
                <?php 
                    switch($_GET['login']) {
                        case 'failed': echo "⚠️ Usuário ou senha incorretos."; break;
                        case 'pending_approval': echo "⏳ Sua conta de Editor ainda está em análise pela diretoria."; break;
                        case 'pending_confirmation': echo "📧 Por favor, confirme seu e-mail para acessar sua conta."; break;
                    }
                ?>
            </div>
        <?php endif; ?>

        <?php if(isset($_GET['msg']) && $_GET['msg'] == 'confirmed') : ?>
            <div class="bg-green-50 text-green-700 p-4 rounded-xl mb-6 text-xs font-medium border border-green-100 animate-slide-up">
                ✅ E-mail confirmado com sucesso! Você já pode entrar.
            </div>
        <?php endif; ?>

        <?php if(isset($_GET['register'])) : ?>
            <div class="p-4 rounded-xl mb-6 text-xs font-medium border animate-slide-up <?php echo (strpos($_GET['register'], 'success') !== false) ? 'bg-green-50 text-green-700 border-green-100' : 'bg-red-50 text-red-600 border-red-100'; ?>">
                <?php 
                    switch($_GET['register']) {
                        case 'email_exists': echo "⚠️ Este e-mail já está cadastrado."; break;
                        case 'user_exists': echo "⚠️ Usuário já existe."; break;
                        case 'missing_fields': echo "⚠️ Preencha todos os campos."; break;
                        case 'failed': echo "❌ Erro no cadastro."; break;
                        case 'success_pending_editor': echo "🎉 Cadastro realizado! Um editor irá revisar seus dados para liberação."; break;
                        case 'success_pending_confirm': echo "📩 Quase lá! Enviamos um link de confirmação para seu e-mail."; break;
                    }
                ?>
            </div>
        <?php endif; ?>

        <!-- LOGIN FORM -->
        <form id="form-login" action="" method="POST" class="space-y-5">
            <input type="hidden" name="ic_auth_action" value="login">
            <?php wp_nonce_field( 'ic_auth_action', 'ic_auth_nonce' ); ?>
            
            <div>
                <label class="block text-[10px] font-bold text-gray-400 mb-1.5 uppercase tracking-widest">E-mail ou Usuário</label>
                <input type="text" name="user_login" required class="w-full px-5 py-3.5 rounded-xl bg-gray-50 border border-gray-100 focus:bg-white focus:ring-4 focus:ring-primary-100 focus:border-primary-400 outline-none transition-all text-sm" placeholder="Seu acesso">
            </div>

            <div>
                <label class="block text-[10px] font-bold text-gray-400 mb-1.5 uppercase tracking-widest">Senha</label>
                <input type="password" name="user_password" required class="w-full px-5 py-3.5 rounded-xl bg-gray-50 border border-gray-100 focus:bg-white focus:ring-4 focus:ring-primary-100 focus:border-primary-400 outline-none transition-all text-sm" placeholder="••••••••">
                <div class="flex justify-end mt-2">
                    <a href="<?php echo wp_lostpassword_url(); ?>" class="text-[10px] font-bold text-primary-600 hover:underline tracking-tight">Esqueceu a senha?</a>
                </div>
            </div>

            <button type="submit" class="w-full bg-primary-600 hover:bg-primary-700 text-white py-4 rounded-xl font-bold shadow-lg shadow-primary-200 transition-all active:scale-[0.98]">
                ENTRAR AGORA
            </button>
        </form>

        <!-- REGISTER FORM (Hidden by default) -->
        <form id="form-register" action="" method="POST" class="hidden space-y-5 animate-fade-in">
            <input type="hidden" name="ic_auth_action" value="register">
            <?php wp_nonce_field( 'ic_auth_action', 'ic_auth_nonce' ); ?>

            <!-- Todos os cadastros começam como Assinante por padrão (Segurança) -->
            <div class="bg-primary-50 p-4 rounded-xl border border-primary-100 mb-2">
                <p class="text-[10px] font-bold text-primary-700 uppercase tracking-widest text-center">Cadastro de Assinante</p>    
            </div>

            <div>
                <label class="block text-[10px] font-bold text-gray-400 mb-1.5 uppercase tracking-widest">Nome Completo</label>
                <input type="text" name="first_name" required class="w-full px-5 py-3.5 rounded-xl bg-gray-50 border border-gray-100 focus:bg-white focus:ring-4 focus:ring-primary-100 focus:border-primary-400 outline-none transition-all text-sm" placeholder="João Silva">
            </div>

            <div>
                <label class="block text-[10px] font-bold text-gray-400 mb-1.5 uppercase tracking-widest">Usuário</label>
                <input type="text" name="user_login" required class="w-full px-5 py-3.5 rounded-xl bg-gray-50 border border-gray-100 focus:bg-white focus:ring-4 focus:ring-primary-100 focus:border-primary-400 outline-none transition-all text-sm" placeholder="usuario123">
            </div>

            <div>
                <label class="block text-[10px] font-bold text-gray-400 mb-1.5 uppercase tracking-widest">E-mail</label>
                <input type="email" name="user_email" required class="w-full px-5 py-3.5 rounded-xl bg-gray-50 border border-gray-100 focus:bg-white focus:ring-4 focus:ring-primary-100 focus:border-primary-400 outline-none transition-all text-sm" placeholder="email@exemplo.com">
            </div>

            <div>
                <label class="block text-[10px] font-bold text-gray-400 mb-1.5 uppercase tracking-widest">Senha</label>
                <input type="password" name="user_password" required class="w-full px-5 py-3.5 rounded-xl bg-gray-50 border border-gray-100 focus:bg-white focus:ring-4 focus:ring-primary-100 focus:border-primary-400 outline-none transition-all text-sm" placeholder="••••••••">
            </div>

            <button type="submit" class="w-full bg-primary-600 hover:bg-primary-700 text-white py-4 rounded-xl font-bold shadow-lg shadow-primary-200 transition-all active:scale-[0.98]">
                CRIAR MINHA CONTA
            </button>
        </form>

    </div>
</div>

<script>
function switchTab(type) {
    const loginForm = document.getElementById('form-login');
    const registerForm = document.getElementById('form-register');
    const tabLogin = document.getElementById('tab-login');
    const tabRegister = document.getElementById('tab-register');

    if (type === 'login') {
        loginForm.classList.remove('hidden');
        registerForm.classList.add('hidden');
        tabLogin.classList.add('text-primary-600', 'border-primary-600');
        tabLogin.classList.remove('text-gray-400');
        tabRegister.classList.add('text-gray-400');
        tabRegister.classList.remove('text-primary-600', 'border-primary-600');
    } else {
        loginForm.classList.add('hidden');
        registerForm.classList.remove('hidden');
        tabRegister.classList.add('text-primary-600', 'border-primary-600');
        tabRegister.classList.remove('text-gray-400');
        tabLogin.classList.add('text-gray-400');
        tabLogin.classList.remove('text-primary-600', 'border-primary-600');
    }
}

if (window.location.search.includes('register')) {
    switchTab('register');
}
</script>

<?php get_footer(); ?>
