<?php
/**
 * Template Part: Global Enrollment Modal
 * Description: High-performance, accessible modal for "Caiçaras do Futuro" enrollment.
 */

// Data Logic
$current_batch = (int) get_option('caicaras_current_batch', 1);
$count = ic_get_pre_inscricao_count($current_batch); 
$status = get_option('caicaras_registration_status', 'open');
$limit = 20; 
$is_full = ($count >= $limit || $status === 'paused');
$remaining = $limit - $count;
?>

<style>
    /* Modal Styles */
    #caicarasModal {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(5, 11, 24, 0.95);
        backdrop-filter: blur(8px);
        z-index: 9999;
        align-items: center;
        justify-content: center;
        padding: 10px;
    }

    #caicarasModal.active {
        display: flex;
        animation: icFadeIn 0.4s ease-out;
    }

    @keyframes icFadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    .modal-container {
        width: 100%;
        max-width: 600px;
        max-height: 95vh;
        overflow-y: auto;
        position: relative;
        border-radius: 24px;
        scrollbar-width: thin;
        scrollbar-color: #b2935c transparent;
    }
    
    .modal-container::-webkit-scrollbar { width: 4px; }
    .modal-container::-webkit-scrollbar-thumb { background: #b2935c; border-radius: 10px; }

    .modal-progress { height: 4px; background: rgba(255, 255, 255, 0.05); width: 100%; }
    .modal-progress-bar {
        height: 100%;
        background: linear-gradient(90deg, #b2935c, #14b8a6);
        width: 33%;
        transition: width 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .modal-step { display: none; padding: 40px; animation: slideUpModal 0.4s ease-out; }
    .modal-step.active { display: block; }

    @keyframes slideUpModal {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .input-premium {
        width: 100%;
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 16px;
        padding: 16px 20px;
        color: white;
        outline: none;
        transition: all 0.3s;
        font-family: 'Outfit', sans-serif;
    }

    .input-premium:focus {
        border-color: #b2935c;
        background: rgba(255, 255, 255, 0.06);
        box-shadow: 0 0 20px rgba(178, 147, 92, 0.1);
    }

    select.input-premium {
        appearance: none;
        color-scheme: dark;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='white'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 20px center;
        background-size: 16px;
        padding-right: 45px;
    }

    .modal-close { position: absolute; top: 20px; right: 20px; color: white; opacity: 0.5; cursor: pointer; transition: opacity 0.3s; }
    .modal-close:hover { opacity: 1; }

    #modalError {
        display: none;
        background: rgba(239, 68, 68, 0.1);
        border: 1px solid rgba(239, 68, 68, 0.2);
        color: #fca5a5;
        padding: 12px 20px;
        border-radius: 12px;
        margin-bottom: 20px;
        font-size: 13px;
        font-weight: 600;
        text-align: center;
        animation: fadeInDown 0.3s ease-out;
    }
</style>

<!-- Premium Registration Modal -->
<div id="caicarasModal" role="dialog" aria-modal="true">
    <div class="modal-container glass-card">
        <div class="modal-progress">
            <div id="progressBar" class="modal-progress-bar"></div>
        </div>
        
        <button class="modal-close z-50" onclick="closeModal()" aria-label="Fechar formulário">
            <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>

        <?php if (!$is_full) : ?>
        <form id="preInscricaoForm" class="p-6 md:p-10">
            <?php wp_nonce_field('caicaras_nonce', 'security_nonce'); ?>
            
            <div class="mb-6 flex justify-between items-center">
                <span class="text-[10px] uppercase tracking-widest text-white font-extrabold opacity-90">Status: Aberto</span>
                <?php if ($remaining <= 5 && $remaining > 0) : ?>
                    <span class="text-[10px] uppercase tracking-widest text-accent-orange font-bold animate-pulse">Apenas <?php echo $remaining; ?> vagas restantes!</span>
                <?php endif; ?>
            </div>

            <div id="modalError"></div>

            <!-- Passo 1 -->
            <div class="modal-step active" data-step="1">
                <span class="section-label">Passo 1 de 3</span>
                <h3 class="text-2xl font-bold text-white mb-6">Comece sua jornada</h3>
                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold text-white mb-2 uppercase tracking-widest">Seu nome completo</label>
                        <input type="text" name="name" required class="input-premium placeholder:text-white/50" placeholder="Ex: João da Silva">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-white mb-2 uppercase tracking-widest">Sua idade</label>
                        <input type="number" id="inputAge" name="age" min="14" max="24" required class="input-premium placeholder:text-white/50" placeholder="Ex: 17">
                    </div>
                </div>
                <button type="button" onclick="nextStep(1)" class="btn-premium w-full mt-8">Continuar</button>
            </div>

            <!-- Passo 2 -->
            <div class="modal-step" data-step="2">
                <span class="section-label">Passo 2 de 3</span>
                <h3 class="text-2xl font-bold text-white mb-2">Como te encontramos?</h3>
                <p class="text-[11px] text-white/90 mb-6 font-bold uppercase tracking-widest bg-white/10 py-1 px-3 rounded-lg inline-block">Preencha todos os campos para a pré-inscrição</p>
                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold text-white mb-2 uppercase tracking-widest">Seu WhatsApp *</label>
                        <input type="tel" id="whatsapp" name="whatsapp" required class="input-premium placeholder:text-white/50" placeholder="(13) 99999-9999">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-white mb-2 uppercase tracking-widest">Seu E-mail *</label>
                        <input type="email" id="inputEmail" name="email" required class="input-premium placeholder:text-white/50" placeholder="email@exemplo.com">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-white mb-2 uppercase tracking-widest">Cidade *</label>
                        <select id="selectCity" name="city" required class="input-premium">
                            <option value="" class="text-slate-900">Selecione sua cidade</option>
                            <option value="São Vicente" class="text-slate-900">São Vicente</option>
                            <option value="Santos" class="text-slate-900">Santos</option>
                            <option value="Praia Grande" class="text-slate-900">Praia Grande</option>
                            <option value="Guarujá" class="text-slate-900">Guarujá</option>
                            <option value="Cubatão" class="text-slate-900">Cubatão</option>
                            <option value="Bertioga" class="text-slate-900">Bertioga</option>
                            <option value="Mongaguá" class="text-slate-900">Mongaguá</option>
                            <option value="Itanhaém" class="text-slate-900">Itanhaém</option>
                            <option value="Peruíbe" class="text-slate-900">Peruíbe</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-white mb-2 uppercase tracking-widest">Bairro *</label>
                        <select id="selectNeighborhood" name="neighborhood" required class="input-premium">
                            <option value="" class="text-slate-900">Selecione a cidade primeiro</option>
                        </select>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4 mt-8">
                    <button type="button" onclick="prevStep(2)" class="btn-premium bg-slate-900 border border-white/10 hover:bg-slate-800">Voltar</button>
                    <button type="button" onclick="nextStep(2)" class="btn-premium">Continuar</button>
                </div>
            </div>

            <!-- Passo 3 -->
            <div class="modal-step" data-step="3">
                <span class="section-label">Passo Final</span>
                <h3 class="text-2xl font-bold text-white mb-6">Para finalizar</h3>
                <div class="space-y-6">
                    <div id="guardianFields" class="hidden space-y-4 p-5 rounded-2xl bg-white/10 border-2 border-accent-gold shadow-[0_0_20px_rgba(178,147,92,0.2)]">
                        <p class="text-[12px] text-white font-black uppercase mb-4 tracking-tight bg-accent-gold/40 py-2 px-3 rounded-lg flex items-center gap-2">
                            <span class="text-xl">⚠️</span> IDENTIFICAMOS QUE VOCÊ É MENOR DE IDADE
                        </p>
                        <div>
                            <label class="block text-xs font-bold text-white mb-2 uppercase tracking-widest">Nome do Responsável Legal *</label>
                            <input type="text" name="guardian_name" class="input-premium placeholder:text-white/50" placeholder="Nome Completo">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-white mb-2 uppercase tracking-widest">WhatsApp do Responsável *</label>
                            <input type="tel" name="guardian_whatsapp" class="input-premium placeholder:text-white/50" placeholder="(13) 99999-9999">
                        </div>
                    </div>
                    <label class="flex items-start gap-4 p-5 rounded-2xl bg-white/5 border border-white/10 hover:border-accent-gold/30 hover:bg-white/10 transition-all cursor-pointer w-full group">
                        <input type="checkbox" required class="mt-1 w-5 h-5 shrink-0 accent-accent-gold">
                        <span class="text-xs text-white leading-relaxed group-hover:text-white transition-colors font-medium">
                            Estou ciente de que esta é uma **pré-inscrição** para a **<?php echo $current_batch; ?>ª Turma**. Caso o número de inscritos supere as 15 vagas, o **Instituto Caiçara** realizará uma seleção técnica baseada em critérios socioeconômicos. O preenchimento deste formulário não garante a vaga imediata.
                        </span>
                    </label>
                </div>
                <div class="grid grid-cols-2 gap-4 mt-8">
                    <button type="button" onclick="prevStep(3)" class="btn-premium bg-slate-900 border border-white/10 hover:bg-slate-800">Voltar</button>
                    <button type="submit" id="submitBtn" class="btn-premium">Enviar Inscrição</button>
                </div>
            </div>
        </form>
        <?php else : ?>
        <!-- Tela de Lista de Espera -->
        <div id="waitListContent" class="modal-step active p-6 md:p-10 text-center">
            <div class="mb-6">
                <span class="inline-block px-4 py-1 rounded-full bg-accent-orange text-white text-xs font-bold uppercase tracking-wider mb-4 shadow-lg shadow-accent-orange/20">
                    <?php echo $current_batch; ?>ª Turma Completa!
                </span>
                <h3 class="text-3xl font-bold text-white mb-4">Vagas em processamento</h3>
                <p class="text-slate-200 text-sm leading-relaxed mb-6 font-medium">
                    A <?php echo $current_batch; ?>ª Turma está fechada. Deixe seu contato para a próxima!
                </p>
            </div>
            <div class="bg-white/5 border border-white/20 rounded-3xl p-6 mb-8">
                <p class="text-white font-bold mb-6 text-lg">Quer ser avisado no zap quando a <?php echo $current_batch + 1; ?>ª Turma abrir?</p>
                <form id="waitListForm" class="space-y-4">
                    <?php wp_nonce_field('caicaras_nonce', 'wait_nonce_field'); ?>
                    <input type="text" id="wait_name" required class="input-premium text-center border-white/20 text-white placeholder:text-white/40" placeholder="Seu Nome Completo">
                    <input type="tel" id="wait_whatsapp" required class="input-premium text-center border-white/20 text-white placeholder:text-white/40" placeholder="Seu WhatsApp">
                    <button type="button" id="waitBtn" onclick="submitWaitlist()" class="btn-premium w-full text-lg">Entrar na lista de avisos</button>
                </form>
                <div id="waitSuccessArea" class="hidden py-8 animate-in fade-in zoom-in duration-500">
                    <div class="w-16 h-16 bg-accent-gold/20 text-accent-gold rounded-full flex items-center justify-center mx-auto mb-4 text-2xl">✓</div>
                    <h4 class="text-xl font-bold text-white mb-2 text-center">Cadastro Realizado!</h4>
                    <p class="text-sm text-slate-300 text-center mb-6">Você receberá o link de inscrição em primeira mão assim que as vagas abrirem.</p>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <!-- Success Message -->
        <div id="modalSuccess" class="modal-step text-center py-12">
            <div class="w-20 h-20 bg-white/10 text-white rounded-full flex items-center justify-center mx-auto mb-6 text-4xl">✅</div>
            <h3 class="text-3xl font-bold text-white mb-4">Pré-Inscrição Realizada!</h3>
            <p class="text-slate-400 mb-8 max-w-xs mx-auto">Sua vaga está sendo processada. Fique de olho no WhatsApp.</p>
            <a href="https://wa.me/5513996450062" target="_blank" class="btn-premium">Falar no WhatsApp</a>
        </div>
    </div>
</div>

<!-- Universal Alert Modal -->
<div id="waitAlertModal" class="fixed inset-0 z-[99999] flex items-center justify-center p-4 bg-slate-950/90 backdrop-blur-md hidden opacity-0 transition-all duration-300">
    <div class="glass-card max-w-md w-full p-8 text-center transform scale-90 transition-all duration-300 shadow-[0_0_60px_rgba(255,255,255,0.1)] border border-white/30">
        <div id="waitAlertIcon" class="w-20 h-20 flex items-center justify-center mx-auto mb-6 text-4xl border-2">!</div>
        <h3 id="waitAlertTitle" class="text-3xl font-extrabold text-white mb-4 tracking-tight">Aviso</h3>
        <p id="waitAlertMsg" class="font-bold text-xl text-white mb-8"></p>
        <button type="button" onclick="closeWaitAlertModal()" class="btn-premium w-full text-xl py-5 shadow-2xl hover:scale-110 active:scale-95 transition-all">Entendido!</button>
    </div>
</div>

<script>
    (function() {
        const modal = document.getElementById('caicarasModal');
        const form = document.getElementById('preInscricaoForm');
        const progressBar = document.getElementById('progressBar');
        const guardianFields = document.getElementById('guardianFields');
        const modalError = document.getElementById('modalError');

        window.openModal = function() {
            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
        };

        window.closeModal = function() {
            modal.classList.remove('active');
            document.body.style.overflow = '';
        };

        window.showWaitAlert = function(title, msg, type = 'info') {
            const m = document.getElementById('waitAlertModal');
            document.getElementById('waitAlertTitle').innerText = title;
            document.getElementById('waitAlertMsg').innerText = msg;
            const icon = document.getElementById('waitAlertIcon');
            if (type === 'success') {
                icon.innerHTML = '✓';
                icon.className = 'w-20 h-20 bg-white/10 text-white rounded-full flex items-center justify-center mx-auto mb-6 text-4xl border-2 border-white/20';
            } else {
                icon.innerHTML = '!';
                icon.className = 'w-20 h-20 bg-accent-gold/20 text-accent-gold rounded-full flex items-center justify-center mx-auto mb-6 text-4xl border-2 border-accent-gold/40';
            }
            m.classList.remove('hidden');
            m.style.display = 'flex';
            setTimeout(() => m.classList.add('opacity-100'), 10);
        };

        window.closeWaitAlertModal = function() {
            const m = document.getElementById('waitAlertModal');
            m.classList.remove('opacity-100');
            setTimeout(() => { m.classList.add('hidden'); m.style.display = 'none'; }, 300);
        };

        const handlePhoneMask = (e) => {
            let v = e.target.value.replace(/\D/g, "");
            if (v.length > 11) v = v.substring(0, 11);
            v = v.replace(/^(\d{2})(\d)/g, "($1) $2");
            v = v.replace(/(\d)(\d{4})$/, "$1-$2");
            e.target.value = v;
        };

        document.querySelectorAll('input[type="tel"]').forEach(input => {
            input.addEventListener('input', handlePhoneMask);
        });

        window.nextStep = function(current) {
            if (current === 1) {
                const name = document.getElementsByName('name')[0].value.trim();
                const age = parseInt(document.getElementById('inputAge').value);
                if (name.split(' ').length < 2) { showError('Nome completo obrigatório.'); return; }
                if (isNaN(age) || age < 14 || age > 24) { showError('Idade permitida: 14 a 24 anos.'); return; }
                if (age < 18) {
                    guardianFields.classList.remove('hidden');
                    document.getElementsByName('guardian_name')[0].required = true;
                    document.getElementsByName('guardian_whatsapp')[0].required = true;
                } else {
                    guardianFields.classList.add('hidden');
                }
            }
            if (current === 2) {
                const zap = document.getElementById('whatsapp').value;
                const city = document.getElementById('selectCity').value;
                if (zap.length < 14 || !city) { showError('Preencha os campos obrigatórios.'); return; }
            }
            document.querySelector(`[data-step="${current}"]`).classList.remove('active');
            document.querySelector(`[data-step="${current + 1}"]`).classList.add('active');
            progressBar.style.width = `${((current + 1) / 3) * 100}%`;
            modalError.style.display = 'none';
        };

        window.prevStep = function(current) {
            document.querySelector(`[data-step="${current}"]`).classList.remove('active');
            document.querySelector(`[data-step="${current - 1}"]`).classList.add('active');
            progressBar.style.width = `${((current - 1) / 3) * 100}%`;
        };

        function showError(msg) {
            modalError.innerText = msg;
            modalError.style.display = 'block';
        }

        const locationData = <?php echo json_encode(array(
            "São Vicente" => ["Beira Mar", "Boa Vista", "Catiapoã", "Centro", "Cidade Náutica", "Humaitá", "Itararé", "Jockey Club", "México 70", "Parque Bitaru", "Vila Margarida", "Outro"],
            "Santos" => ["Aparecida", "Areia Branca", "Boqueirão", "Centro", "Gonzaga", "Macuco", "Marapé", "Ponta da Praia", "Quilombo", "São Manoel", "Vila Mathias", "Vila Nova", "Outro"],
            "Cubatão" => ["Água Fria", "Casqueiro", "Centro", "Vila Esperança", "Vila Natal", "Vila Nova", "Outro"],
            "Praia Grande" => ["Aviação", "Boqueirão", "Caiçara", "Canto do Forte", "Cidade Ocian", "Quietude", "Tupi", "Vila Sônia", "Outro"],
            "Guarujá" => ["Vicente de Carvalho", "Morrinhos", "Perequê", "Enseada", "Pitangueiras", "Outro"],
            "Bertioga" => ["Centro", "Indaiá", "Boracéia", "Outro"],
            "Mongaguá" => ["Agenor de Campos", "Vera Cruz", "Centro", "Outro"],
            "Itanhaém" => ["Belas Artes", "Suarão", "Centro", "Outro"],
            "Peruíbe" => ["Caraguava", "Centro", "Outro"]
        )); ?>;

        const selectCity = document.getElementById('selectCity');
        const selectNeighborhood = document.getElementById('selectNeighborhood');
        if (selectCity) {
            selectCity.addEventListener('change', function() {
                const city = this.value;
                selectNeighborhood.innerHTML = '<option value="">Selecione seu bairro</option>';
                if (city && locationData[city]) {
                    locationData[city].forEach(n => {
                        const opt = document.createElement('option');
                        opt.value = n; opt.textContent = n;
                        selectNeighborhood.appendChild(opt);
                    });
                }
            });
        }

        window.submitWaitlist = async function() {
            const btn = document.getElementById('waitBtn');
            const name = document.getElementById('wait_name').value;
            const zap = document.getElementById('wait_whatsapp').value;
            const nonce = document.querySelector('[name="wait_nonce_field"]').value;
            if (!name || !zap) { alert('Preencha os campos.'); return; }
            btn.disabled = true; btn.innerText = 'Processando...';
            const fd = new FormData();
            fd.append('action', 'ic_waitlist');
            fd.append('nonce', nonce);
            fd.append('name', name);
            fd.append('whatsapp', zap);
            try {
                const r = await fetch('<?php echo admin_url('admin-ajax.php'); ?>', { method: 'POST', body: fd });
                const d = await r.json();
                if (d.success) {
                    showWaitAlert('Cadastro Realizado!', 'Você entrou na lista de avisos!', 'success');
                    document.getElementById('waitListForm').style.display = 'none';
                    document.getElementById('waitSuccessArea').classList.remove('hidden');
                } else {
                    showWaitAlert('Aviso', d.data || 'Erro.', 'warning');
                    btn.disabled = false; btn.innerText = 'Tentar novamente';
                }
            } catch (e) { showWaitAlert('Erro', 'Conexão falhou.', 'warning'); btn.disabled = false; }
        };

        if (form) {
            form.onsubmit = async (e) => {
                e.preventDefault();
                const btn = document.getElementById('submitBtn');
                btn.disabled = true; btn.innerText = 'Enviando...';
                const fd = new FormData(form);
                fd.append('action', 'ic_pre_inscricao');
                fd.append('nonce', document.getElementById('security_nonce').value);
                try {
                    const r = await fetch('<?php echo admin_url('admin-ajax.php'); ?>', { method: 'POST', body: fd });
                    const d = await r.json();
                    if (d.success) {
                        document.querySelector('[data-step="3"]').classList.remove('active');
                        document.getElementById('modalSuccess').classList.add('active');
                        progressBar.style.width = '100%';
                    } else {
                        showError(d.data || 'Erro.');
                        btn.disabled = false; btn.innerText = 'Enviar Inscrição';
                    }
                } catch (e) { showError('Conexão falhou.'); btn.disabled = false; }
            };
        }

        // Regra Mestra Global
        document.addEventListener('click', function(e) {
            const btn = e.target.closest('a, button');
            if (!btn) return;
            const text = btn.innerText.toLowerCase();
            const href = btn.getAttribute('href');
            if (text.includes('inscrição') || text.includes('inscrever') || text.includes('vaga') || text.includes('lista') || text.includes('aviso')) {
                if (btn.type === 'submit' || btn.id === 'submitBtn' || btn.id === 'waitBtn') return;
                if (href === '#' || btn.classList.contains('btn-premium')) {
                    e.preventDefault();
                    openModal();
                }
            }
        });
    })();
</script>
