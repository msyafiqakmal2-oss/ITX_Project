<style>

/* =========================================
   CREATE PAGE
========================================= */

.create-page {
    min-height: 100vh;
    padding: 35px 5.7% 100px;
    position: relative;

    background:
        linear-gradient(
            rgba(17, 24, 39, 0.035) 1px,
            transparent 1px
        ),
        linear-gradient(
            90deg,
            rgba(17, 24, 39, 0.035) 1px,
            transparent 1px
        );

    background-size: 40px 40px;
}


/* =========================================
   META
========================================= */

.page-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;

    font-size: 11px;
    letter-spacing: 2px;
    color: #94a3b8;

    margin-bottom: 55px;
}

.meta-left {
    display: flex;
    align-items: center;
    gap: 12px;
}

.meta-dot {
    width: 7px;
    height: 7px;

    background: #dc2626;
    border-radius: 50%;
}

.meta-right {
    letter-spacing: 3px;
}


/* =========================================
   HERO
========================================= */

.create-hero {
    max-width: 850px;
    margin-bottom: 75px;
}

.hero-label {
    font-size: 12px;
    font-weight: 700;

    letter-spacing: 4px;

    color: #dc2626;

    margin-bottom: 22px;
}

.create-title {
    font-size: clamp(90px, 11vw, 180px);

    line-height: 0.78;

    letter-spacing: -7px;

    font-weight: 800;

    color: #111827;

    margin: 0;
}

.create-title span {
    color: #dc2626;
}

.create-description {
    max-width: 520px;

    margin-top: 42px;

    font-size: 16px;

    line-height: 1.7;

    color: #64748b;
}


/* =========================================
   FORM SECTION
========================================= */

.form-section {
    display: grid;

    grid-template-columns: 330px 1fr;

    gap: 75px;

    align-items: start;

    max-width: 1360px;

    margin: 0 auto;
}


/* =========================================
   LEFT INFO
========================================= */

.form-info {
    position: relative;

    min-height: 400px;

    padding-top: 10px;
}

.info-number {
    font-size: 68px;

    line-height: 1;

    font-weight: 700;

    color: #111827;

    margin-bottom: 20px;
}

.info-title {
    font-size: 11px;

    letter-spacing: 4px;

    color: #94a3b8;

    line-height: 1.3;

    margin-bottom: 14px;
}

.form-info p {
    max-width: 190px;

    font-size: 13px;

    line-height: 1.7;

    color: #94a3b8;
}

.info-line {
    position: absolute;

    width: 1px;
    height: 170px;

    background: #dbe1e8;

    right: 45px;
    top: 0;
}

.info-circle {
    position: absolute;

    width: 36px;
    height: 36px;

    border: 1px solid #334155;

    border-radius: 50%;

    right: 27px;
    top: 55px;

    background: #f8fafc;
}


/* =========================================
   FORM CARD
========================================= */

.form-card {
    position: relative;

    background: rgba(255,255,255,0.92);

    border: 1px solid #e2e8f0;

    padding: 70px 70px 55px;

    box-shadow:
        25px 25px 70px rgba(15, 23, 42, 0.06);
}

.form-top-line {
    position: absolute;

    top: -1px;
    left: 0;

    width: 100%;
    height: 4px;

    background: #111827;
}

.form-top-line::after {
    content: "";

    position: absolute;

    left: 95px;
    top: 0;

    width: 7px;
    height: 7px;

    background: #dc2626;
}


/* =========================================
   INPUT
========================================= */

.input-group {
    margin-bottom: 45px;
}

.input-label {
    display: flex;

    align-items: center;

    gap: 18px;

    font-size: 11px;

    font-weight: 700;

    letter-spacing: 3px;

    color: #64748b;

    margin-bottom: 24px;
}

.input-label span {
    font-size: 11px;

    color: #94a3b8;

    letter-spacing: 0;
}

.input-group input {
    width: 100%;

    border: 0;

    outline: none;

    background: transparent;

    font-size: 28px;

    font-family: inherit;

    color: #111827;

    padding: 0 0 15px;
}

.input-group input::placeholder {
    color: #cbd5e1;
}

.input-line {
    width: 100%;
    height: 1px;

    background: #cbd5e1;

    position: relative;

    overflow: hidden;
}

.input-line::after {
    content: "";

    position: absolute;

    left: 0;
    bottom: 0;

    width: 0;
    height: 2px;

    background: #dc2626;

    transition: width 0.8s cubic-bezier(.16,1,.3,1);
}

.input-group:focus-within .input-line::after {
    width: 100%;
}


/* =========================================
   ERROR
========================================= */

.error-message {
    margin-top: 10px;

    font-size: 12px;

    color: #dc2626;
}


/* =========================================
   ACTION
========================================= */

.form-actions {
    display: flex;

    align-items: center;

    justify-content: space-between;

    padding-top: 15px;

    border-top: 1px solid #e2e8f0;
}

.back-link {
    text-decoration: none;

    color: #64748b;

    font-size: 11px;

    font-weight: 700;

    letter-spacing: 2px;

    transition: color 0.5s ease;
}

.back-link span {
    margin-right: 8px;

    font-size: 16px;
}

.back-link:hover {
    color: #111827;
}


/* =========================================
   SAVE BUTTON
========================================= */

.save-button {
    border: 0;

    background: #111827;

    color: white;

    padding: 19px 27px;

    min-width: 190px;

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 30px;

    cursor: pointer;

    font-family: inherit;

    font-size: 11px;

    font-weight: 700;

    letter-spacing: 2px;

    transition:
        background 0.5s ease,
        transform 0.5s cubic-bezier(.16,1,.3,1);
}

.save-button strong {
    font-size: 17px;

    font-weight: 400;

    color: #fbbf24;

    transition: transform 0.5s ease;
}

.save-button:hover {
    background: #1e293b;
}

.save-button:hover strong {
    transform: translateX(7px);
}


/* =========================================
   SLOW MOTION INITIAL STATE
========================================= */

.create-hero,
.form-info,
.form-card {
    opacity: 0;
    transform: translateY(70px);
}


/* =========================================
   RESPONSIVE
========================================= */

@media (max-width: 900px) {

    .create-page {
        padding: 30px 6% 70px;
    }

    .create-title {
        font-size: clamp(70px, 16vw, 130px);
        letter-spacing: -4px;
    }

    .form-section {
        grid-template-columns: 1fr;

        gap: 35px;
    }

    .form-info {
        min-height: auto;
    }

    .info-line,
    .info-circle {
        display: none;
    }

    .form-card {
        padding: 45px 30px;
    }

}


@media (max-width: 600px) {

    .page-meta {
        margin-bottom: 40px;
    }

    .create-title {
        font-size: 72px;
        letter-spacing: -3px;
    }

    .create-description {
        font-size: 14px;
    }

    .form-card {
        padding: 40px 22px;
    }

    .input-group input {
        font-size: 22px;
    }

    .form-actions {
        flex-direction: column;

        align-items: stretch;

        gap: 25px;
    }

    .save-button {
        width: 100%;
    }

}

</style>
