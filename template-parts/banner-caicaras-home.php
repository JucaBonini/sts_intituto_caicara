<?php
/**
 * Template Part: Banner Caiçaras do Futuro (Home)
 * High-impact banner for pre-enrollment.
 */
?>

<style>
    .banner-caicaras-home {
        position: relative;
        padding: 80px 0;
        background: url('<?php echo get_template_directory_uri(); ?>/assets/images/fundo-banner-ca.webp') no-repeat center center;
        background-size: cover;
        overflow: hidden;
        color: white;
    }

    .banner-caicaras-home::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(90deg, rgba(5, 11, 24, 0.9) 0%, rgba(5, 11, 24, 0.6) 50%, rgba(5, 11, 24, 0.3) 100%);
        z-index: 1;
    }

    .banner-caicaras-home .container {
        position: relative;
        z-index: 2;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .banner-tag {
        display: inline-block;
        background: #14b8a6; /* Accent Teal */
        color: white;
        font-size: 11px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 2px;
        padding: 6px 16px;
        border-radius: 100px;
        margin-bottom: 24px;
        box-shadow: 0 4px 15px rgba(20, 184, 166, 0.3);
    }

    .banner-title-brush {
        position: relative;
        font-family: 'Outfit', sans-serif;
        font-size: 3rem;
        font-weight: 800;
        line-height: 1.1;
        margin-bottom: 20px;
        max-width: 600px;
    }

    .banner-title-brush span {
        position: relative;
        display: inline-block;
        color: #fde047; /* Bright Yellow/Gold */
        padding: 0 10px;
    }

    /* Efeito de pincelada simulado com CSS */
    .banner-title-brush span::after {
        content: '';
        position: absolute;
        bottom: 5px;
        left: 0;
        width: 100%;
        height: 12px;
        background: rgba(253, 224, 71, 0.3);
        z-index: -1;
        transform: rotate(-1deg);
        border-radius: 100px;
    }

    .banner-description {
        font-size: 1.1rem;
        color: rgba(255, 255, 255, 0.8);
        max-width: 500px;
        margin-bottom: 24px;
        line-height: 1.6;
    }

    .banner-highlight-box {
        display: inline-flex;
        align-items: center;
        gap: 15px;
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(5px);
        padding: 12px 20px;
        border-radius: 16px;
        border: 1px solid rgba(255, 255, 255, 0.2);
        margin-bottom: 40px;
    }

    .banner-highlight-box p {
        margin: 0;
        font-size: 14px;
        color: white;
    }

    .banner-highlight-box strong {
        color: #fde047;
    }

    .highlight-icon {
        font-size: 24px;
    }

    .banner-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        align-items: center;
    }

    .btn-caicaras-green {
        background: linear-gradient(135deg, #22c55e 0%, #15803d 100%);
        color: white;
        padding: 18px 36px;
        border-radius: 100px;
        font-weight: 800;
        font-size: 14px;
        letter-spacing: 1px;
        text-transform: uppercase;
        border: none;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 10px 30px rgba(34, 197, 94, 0.3);
    }

    .btn-caicaras-green:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(34, 197, 94, 0.5);
        filter: brightness(1.1);
    }

    .btn-caicaras-outline {
        color: white;
        font-weight: 700;
        text-decoration: none;
        border-bottom: 2px solid rgba(255, 255, 255, 0.3);
        transition: all 0.3s;
        padding-bottom: 4px;
    }

    .btn-caicaras-outline:hover {
        border-color: white;
        color: #fde047;
    }

    .banner-disclaimer {
        margin-top: 24px;
        font-size: 12px;
        color: rgba(255, 255, 255, 0.5);
        font-style: italic;
        max-width: 500px;
    }

    @media (max-width: 768px) {
        .banner-caicaras-home {
            padding: 60px 0;
            text-align: center;
        }
        .banner-title-brush {
            font-size: 2.2rem;
            margin: 0 auto 20px;
        }
        .banner-description {
            margin: 0 auto 40px;
        }
        .banner-actions {
            justify-content: center;
        }
        .banner-caicaras-home::before {
            background: rgba(5, 11, 24, 0.85);
        }
    }
</style>

<section class="banner-caicaras-home">
    <div class="container">
        <div class="banner-content animate-fade-in">
            <span class="banner-tag">Oportunidade Real</span>
            <h2 class="banner-title-brush">
                Projeto <br>
                <span>Caiçaras do Futuro</span>
            </h2>
            <p class="banner-description">
                Conectando a juventude caiçara às oportunidades do complexo portuário. Educação, inclusão e transformação social.
            </p>

            <div class="banner-highlight-box">
                <span class="highlight-icon">💰</span>
                <p>Bolsa-auxílio de <strong>R$ 500,00</strong> para todos os concluintes do curso.</p>
            </div>
            
            <div class="banner-actions">
                <button onclick="openModal()" class="btn-caicaras-green">
                    GARANTA A PRÉ-INSCRIÇÃO
                </button>
                <a href="<?php echo home_url('/caicaras-do-futuro'); ?>" class="btn-caicaras-outline">
                    Conhecer o projeto
                </a>
            </div>

            <p class="banner-disclaimer">
                * A pré-inscrição não garante a vaga. Nossa equipe entrará em contato para realizar uma avaliação socioeconômica.
            </p>
        </div>
    </div>
</section>
