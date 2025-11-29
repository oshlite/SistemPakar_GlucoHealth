<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Diagnosis - GlucoHealth</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .hasil-container {
            min-height: 100vh;
            padding-top: 80px;
            background: linear-gradient(135deg, #f5f7fa 0%, #fff 100%);
        }

        .hasil-content {
            max-width: 1000px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .hasil-header {
            text-align: center;
            margin-bottom: 3rem;
            animation: fadeInDown 0.6s ease forwards;
        }

        .hasil-header h1 {
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
            color: var(--text-color);
        }

        .hasil-header p {
            color: #999;
            font-size: 1.1rem;
        }

        .diagnosis-cards {
            display: grid;
            gap: 2rem;
            margin-bottom: 3rem;
        }

        .diagnosis-card {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 10px 40px rgba(0,0,0,0.08);
            border-left: 6px solid;
            animation: slideInUp 0.6s ease forwards;
            transition: var(--transition);
        }

        .diagnosis-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 50px rgba(0,0,0,0.12);
        }

        .diagnosis-card.utama {
            border-left-color: var(--primary-color);
            background: linear-gradient(135deg, rgba(255,107,107,0.05) 0%, transparent 100%);
        }

        .diagnosis-card.alternatif {
            border-left-color: var(--accent-color);
            opacity: 0.9;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .card-title {
            display: flex;
            align-items: center;
            gap: 15px;
            flex: 1;
        }

        .card-title i {
            font-size: 2rem;
            color: var(--primary-color);
        }

        .card-title h2 {
            margin: 0;
            font-size: 1.5rem;
            color: var(--text-color);
        }

        .confidence-badge {
            background: linear-gradient(135deg, var(--primary-color), #FF5252);
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .confidence-meter {
            margin: 1.5rem 0;
        }

        .confidence-meter-label {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
            color: #666;
        }

        .confidence-meter-bar {
            height: 12px;
            background: #e0e0e0;
            border-radius: 10px;
            overflow: hidden;
        }

        .confidence-meter-fill {
            height: 100%;
            background: linear-gradient(90deg, var(--primary-color), #FF5252);
            border-radius: 10px;
            transition: width 1s ease;
            width: 0%;
        }

        .card-description {
            color: #666;
            line-height: 1.8;
            margin-bottom: 1.5rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid #f0f0f0;
        }

        .severity-indicator {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 10px 15px;
            background: rgba(255,107,107,0.1);
            border-radius: 10px;
            margin-bottom: 1.5rem;
        }

        .severity-indicator i {
            color: var(--primary-color);
            font-size: 1.2rem;
        }

        .severity-text {
            font-weight: 600;
            color: var(--text-color);
        }

        .rekomendasi-section h3 {
            color: var(--text-color);
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .rekomendasi-section h3 i {
            color: var(--primary-color);
            font-size: 1.3rem;
        }

        .rekomendasi-list {
            list-style: none;
        }

        .rekomendasi-list li {
            padding: 12px;
            margin-bottom: 10px;
            background: rgba(255,107,107,0.05);
            border-left: 3px solid var(--primary-color);
            border-radius: 5px;
            color: #666;
            line-height: 1.6;
        }

        .rekomendasi-list li strong {
            color: var(--text-color);
        }

        .rekomendasi-list i {
            color: var(--primary-color);
            margin-right: 8px;
        }

        .gejala-summary {
            background: rgba(78,205,196,0.05);
            padding: 1.5rem;
            border-radius: 15px;
            margin-top: 1.5rem;
        }

        .gejala-summary h4 {
            color: var(--secondary-color);
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .gejala-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .gejala-tag {
            background: white;
            border: 1px solid var(--secondary-color);
            color: var(--secondary-color);
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.9rem;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .action-buttons {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn-print {
            background: var(--secondary-color);
            color: white;
        }

        .btn-print:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(78,205,196,0.3);
        }

        .btn-new {
            background: var(--primary-color);
            color: white;
        }

        .btn-new:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(255,107,107,0.3);
        }

        .warning-box {
            background: #FFF3CD;
            border: 2px solid #FFD700;
            padding: 1.5rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            display: flex;
            gap: 15px;
            animation: slideInDown 0.6s ease forwards;
        }

        .warning-box i {
            font-size: 1.5rem;
            color: #FF9800;
            flex-shrink: 0;
        }

        .warning-content h4 {
            color: #333;
            margin-bottom: 0.5rem;
        }

        .warning-content p {
            color: #666;
            margin: 0;
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .loading {
            text-align: center;
            padding: 3rem;
        }

        .loading i {
            font-size: 3rem;
            color: var(--primary-color);
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .document-footer {
            margin-top: 4rem;
            padding-top: 2rem;
            border-top: 2px solid #e0e0e0;
            background: linear-gradient(135deg, rgba(255,107,107,0.05) 0%, transparent 100%);
            padding: 2rem;
            border-radius: 15px;
            text-align: center;
            color: #666;
            animation: slideInUp 0.6s ease forwards;
        }

        .document-footer p {
            margin: 0.8rem 0;
            font-size: 0.95rem;
            line-height: 1.6;
        }

        .document-footer p:first-child {
            color: var(--text-color);
            font-weight: 600;
            font-size: 1rem;
        }

        .document-footer p:nth-child(2) {
            color: #999;
            font-size: 0.9rem;
        }

        .document-footer p:last-child {
            color: var(--primary-color);
            font-weight: 700;
            background: rgba(255,107,107,0.1);
            padding: 1rem;
            border-left: 4px solid var(--primary-color);
            border-radius: 5px;
            text-align: left;
            margin-top: 1.5rem;
        }

        @media print {
            * {
                box-shadow: none !important;
                text-shadow: none !important;
            }
            
            .navbar, .action-buttons, .scroll-indicator {
                display: none !important;
            }

            .document-footer {
                display: block !important;
                margin-top: 3rem;
                padding-top: 2rem;
                border-top: 2px solid #333;
                background: #f9f9f9;
                padding: 1.5rem;
                page-break-inside: avoid;
            }

            .document-footer p {
                font-size: 11px;
                margin: 0.5rem 0;
                color: #333;
                page-break-inside: avoid;
            }

            .document-footer p:first-child {
                font-weight: bold;
                font-size: 12px;
            }

            .document-footer p:last-child {
                background: #fff3cd;
                padding: 0.8rem;
                border-left: 4px solid #ff6b6b;
                font-weight: bold;
                color: #333;
                margin-top: 1rem;
            }
            
            .hasil-container {
                padding-top: 20px;
                padding-bottom: 20px;
                background: white;
                min-height: auto;
            }
            
            .hasil-content {
                padding: 0;
                margin: 0;
            }
            
            .hasil-header {
                margin-bottom: 2rem;
                page-break-after: avoid;
            }
            
            .diagnosis-card {
                page-break-inside: avoid;
                border: 2px solid #ddd;
                border-left: 8px solid var(--primary-color);
                box-shadow: 0 1px 3px rgba(0,0,0,0.1) !important;
                margin-bottom: 2rem;
                padding: 1.5rem;
            }
            
            .diagnosis-card.alternatif {
                border-left-color: var(--accent-color);
                opacity: 1;
            }
            
            .card-header {
                margin-bottom: 1rem;
                page-break-after: avoid;
            }
            
            .confidence-badge {
                background: #333;
                color: white;
            }
            
            .confidence-meter {
                margin: 1rem 0;
                page-break-inside: avoid;
            }
            
            .card-description {
                color: #000;
                border-bottom: 1px solid #ccc;
            }
            
            .rekomendasi-section {
                page-break-inside: avoid;
            }
            
            .rekomendasi-section ul {
                margin: 0;
                padding-left: 20px;
            }
            
            .rekomendasi-section li {
                margin: 5px 0;
                font-size: 11px;
            }
            
            .gejala-summary {
                page-break-inside: avoid;
                background: #f9f9f9;
                padding: 1rem;
                border-radius: 5px;
                margin-top: 1rem;
            }
            
            .gejala-tags {
                display: flex;
                flex-wrap: wrap;
                gap: 8px;
            }
            
            .gejala-tag {
                display: inline-block;
                background: #e3f2fd;
                color: #1976d2;
                padding: 4px 8px;
                border-radius: 4px;
                font-size: 11px;
            }
            
            h1, h2, h3, h4 {
                page-break-after: avoid;
                color: #000;
            }
            
            p {
                orphans: 3;
                widows: 3;
            }
        }

        @media (max-width: 768px) {
            .hasil-header h1 {
                font-size: 2rem;
            }

            .card-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }

            .confidence-badge {
                align-self: flex-start;
            }

            .action-buttons {
                flex-direction: column;
            }

            .btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="container">
            <div class="nav-brand">
                <i class="fas fa-solid fa-heart-circle-check"></i>
                <span>GlucoHealth</span>
            </div>
            <ul class="nav-menu">
                <li><a href="index.html#home" class="nav-link">Home</a></li>
                <li><a href="index.html#about" class="nav-link">Tentang</a></li>
                <li><a href="index.html#diagnosis" class="nav-link">Diagnosis</a></li>
                <li><a href="index.html#info" class="nav-link">Info Diabetes</a></li>
                <li><a href="index.html#contact" class="nav-link">Kontak</a></li>
            </ul>
            <div class="hamburger">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </nav>

    <div class="hasil-container">
        <div class="hasil-content">
            <div class="hasil-header">
                <h1>📊 Hasil Diagnosis 📊</h1>
                <p>Analisis berdasarkan Forward Chaining Expert System</p>
            </div>

            <!-- Loading state -->
            <div id="loadingState" class="loading">
                <i class="fas fa-spinner fa-spin"></i>
                <p>Memproses hasil diagnosis...</p>
            </div>

            <!-- Content akan di-inject oleh JavaScript -->
            <div id="diagnosisResult"></div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-brand">
                    <h3><i class="fa-solid fa-heart-circle-check"></i> GlucoHealth</h3>
                    <p>Sistem Pakar Diagnosis Diabetes Mellitus Tipe 2</p>
                    <div class="social-links">
                        <a href="https://instagram.com/oshlite" target="_blank"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                <div class="footer-links">
                    <h4>Navigasi</h4>
                    <ul>
                        <li><a href="#home">Home</a></li>
                        <li><a href="#about">Tentang</a></li>
                        <li><a href="#diagnosis">Diagnosis</a></li>
                        <li><a href="#info">Info Diabetes</a></li>
                    </ul>
                </div>
                <div class="footer-info">
                    <h4>Informasi</h4>
                    <p><strong>Kelompok 8 - Kelas D</strong></p>
                    <p>Penerapan Metode Forward Chaining untuk Mendiagnosa Penyakit Diabetes Mellitus Tipe 2</p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2025 GlucoHealth. All rights reserved. Made with love by Kelompok 8</p>
            </div>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            loadDiagnosisResult();
        });

        function loadDiagnosisResult() {
            const resultData = sessionStorage.getItem('diagnosisResult');
            
            if (!resultData) {
                document.getElementById('loadingState').innerHTML = `
                    <div style="text-align: center; padding: 2rem;">
                        <i class="fas fa-exclamation-circle" style="font-size: 2rem; color: var(--primary-color);"></i>
                        <p>Tidak ada data diagnosis</p>
                        <a href="index.html#diagnosis" class="btn btn-primary">
                            <i class="fas fa-arrow-left"></i> Kembali ke Diagnosis
                        </a>
                    </div>
                `;
                return;
            }

            const data = JSON.parse(resultData);
            displayResults(data);
            
            // Don't remove session storage immediately - keep it for "Info Penyakit" navigation
            // Only remove when user navigates away or starts new diagnosis
        }

        function displayResults(data) {
            const container = document.getElementById('diagnosisResult');
            const loadingState = document.getElementById('loadingState');
            
            // Hide loading state
            if (loadingState) {
                loadingState.style.display = 'none';
            }
            
            container.innerHTML = '';
            
            // Warning jika diperlukan
            const diagnosisId = data.diagnosis_utama.penyakit_id;
            const isEmergency = ['P3', 'P7', 'P9'].includes(diagnosisId);
            
            if (isEmergency) {
                container.innerHTML += `
                    <div class="warning-box">
                        <i class="fas fa-exclamation-triangle"></i>
                        <div class="warning-content">
                            <h4>⚠️ PERHATIAN PENTING</h4>
                            <p>Hasil diagnosis menunjukkan kondisi yang memerlukan perhatian medis SEGERA. Segera konsultasikan dengan dokter atau pergi ke rumah sakit terdekat.</p>
                        </div>
                    </div>
                `;
            }

            // Diagnosis Utama
            container.innerHTML += createDiagnosisCard(data.diagnosis_utama, data.penyakit_detail, true, data.gejala_input);
            
            // Diagnosis Alternatif
            if (data.kemungkinan_lain && data.kemungkinan_lain.length > 0) {
                container.innerHTML += `<h3 style="margin-top: 2rem; margin-bottom: 1.5rem; color: var(--text-color);">
                    <i class="fas fa-list"></i> Kemungkinan Diagnosis Lain
                </h3>`;
                
                data.kemungkinan_lain.forEach(diagnosis => {
                    container.innerHTML += createDiagnosisCard(diagnosis, {}, false, data.gejala_input);
                });
            }

            // Document Footer Info (sebelum action buttons)
            container.innerHTML += `
                <div class="document-footer">
                    <p>Dokumen ini dihasilkan oleh GlucoHealth - Sistem Pakar Diagnosis Diabetes</p>
                    <p>Tanggal: ${new Date().toLocaleDateString('id-ID', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' })}</p>
                    <p><i class="fas fa-exclamation-circle"></i> PENTING: Hasil ini hanya untuk referensi. Konsultasikan dengan dokter untuk diagnosis yang lebih akurat.</p>
                </div>
            `;

            // Action buttons
            container.innerHTML += `
                <div class="action-buttons">
                    <button onclick="printResult()" class="btn btn-print">
                        <i class="fas fa-print"></i> Cetak Hasil
                    </button>
                    <a href="index.html#diagnosis" class="btn btn-secondary">
                        <i class="fas fa-redo"></i> Diagnosis Baru
                    </a>
                </div>
            `;
        }

        function createDiagnosisCard(diagnosis, detail, isUtama = false, gejalaDipilih = []) {
            const penyakitId = diagnosis.penyakit_id;
            const penyakitNama = diagnosis.penyakit_nama;
            const confidence = diagnosis.confidence;
            
            let html = `
                <div class="diagnosis-card ${isUtama ? 'utama' : 'alternatif'}">
                    <div class="card-header">
                        <div class="card-title">
                            <i class="fas fa-${getPenyakitIcon(penyakitId)}"></i>
                            <h2>${penyakitNama}</h2>
                        </div>
                        <div class="confidence-badge">
                            <i class="fas fa-bullseye"></i>
                            ${confidence.toFixed(1)}% Akurat
                        </div>
                    </div>

                    <div class="confidence-meter">
                        <div class="confidence-meter-label">
                            <span>Tingkat Kepercayaan</span>
                            <span>${confidence.toFixed(1)}%</span>
                        </div>
                        <div class="confidence-meter-bar">
                            <div class="confidence-meter-fill" style="width: ${confidence}%;"></div>
                        </div>
                    </div>
            `;

            if (detail.nama) {
                html += `<div class="card-description">${detail.deskripsi}</div>`;
                
                if (detail.tingkat_keparahan) {
                    html += `
                        <div class="severity-indicator">
                            <i class="fas fa-exclamation"></i>
                            <span class="severity-text">Tingkat Keparahan: ${detail.tingkat_keparahan}</span>
                        </div>
                    `;
                }

                if (detail.rekomendasi && detail.rekomendasi.length > 0) {
                    html += `
                        <div class="rekomendasi-section">
                            <h3><i class="fas fa-prescription-bottle-alt"></i> Rekomendasi Penanganan</h3>
                            <ul class="rekomendasi-list">
                                ${detail.rekomendasi.map(rec => `
                                    <li>
                                        <i class="fas fa-check"></i>
                                        ${rec}
                                    </li>
                                `).join('')}
                            </ul>
                        </div>
                    `;
                }
            }

            if (gejalaDipilih.length > 0) {
                html += `
                    <div class="gejala-summary">
                        <h4><i class="fas fa-symptoms"></i> Gejala yang Dipilih</h4>
                        <div class="gejala-tags">
                            ${gejalaDipilih.map(g => `
                                <span class="gejala-tag">
                                    <i class="fas fa-check"></i>
                                    ${g.nama}
                                </span>
                            `).join('')}
                        </div>
                    </div>
                `;
            }

            html += '</div>';
            return html;
        }

        function getPenyakitIcon(penyakitId) {
            const icons = {
                'P1': 'heartbeat',
                'P2': 'arrow-up',
                'P3': 'exclamation-triangle',
                'P4': 'eye',
                'P5': 'water',
                'P6': 'nerve',
                'P7': 'heart',
                'P8': 'walking',
                'P9': 'brain'
            };
            return icons[penyakitId] || 'heartbeat';
        }

        function printResult() {
            // Hide action buttons before print
            const actionButtons = document.querySelector('.action-buttons');
            const wasVisible = actionButtons.style.display !== 'none';
            if (actionButtons) actionButtons.style.display = 'none';
            
            // Trigger print dialog
            window.print();
            
            // Show action buttons again after print
            setTimeout(() => {
                if (actionButtons && wasVisible) {
                    actionButtons.style.display = 'block';
                }
            }, 500);
        }

        function downloadPDF() {
            try {
                const element = document.querySelector('.hasil-content');
                if (!element) {
                    alert('Tidak dapat menemukan konten untuk diunduh');
                    return;
                }
                
                // Create a new window for printing
                const printWindow = window.open('', 'PRINT', 'height=600,width=800');
                
                // Get all styles from current page
                let styles = '';
                const styleSheets = document.styleSheets;
                for (let i = 0; i < styleSheets.length; i++) {
                    try {
                        const rules = styleSheets[i].cssRules || styleSheets[i].rules;
                        for (let j = 0; j < rules.length; j++) {
                            styles += rules[j].cssText;
                        }
                    } catch (e) {
                        // Skip CORS issues
                    }
                }
                
                // Clone and clean the content
                const cloned = element.cloneNode(true);
                const buttons = cloned.querySelector('.action-buttons');
                if (buttons) buttons.remove();
                
                // Create print-friendly HTML
                const printContent = `
                    <!DOCTYPE html>
                    <html>
                    <head>
                        <meta charset="UTF-8">
                        <title>Hasil Diagnosis - GlucoHealth</title>
                        <style>
                            * {
                                margin: 0;
                                padding: 0;
                                box-sizing: border-box;
                            }
                            
                            body {
                                font-family: Arial, sans-serif;
                                font-size: 11pt;
                                color: #333;
                                line-height: 1.6;
                                padding: 20mm;
                            }
                            
                            h1 {
                                font-size: 24pt;
                                margin-bottom: 10mm;
                                color: #1a1a1a;
                                text-align: center;
                            }
                            
                            h2 {
                                font-size: 16pt;
                                margin: 10mm 0 5mm 0;
                                color: #2c3e50;
                                border-bottom: 2px solid #FF6B6B;
                                padding-bottom: 5mm;
                            }
                            
                            h3 {
                                font-size: 13pt;
                                margin: 8mm 0 4mm 0;
                                color: #34495e;
                            }
                            
                            p {
                                margin-bottom: 5mm;
                                text-align: justify;
                            }
                            
                            .diagnosis-card {
                                border: 2px solid #ddd;
                                border-left: 5px solid #FF6B6B;
                                padding: 10mm;
                                margin: 10mm 0;
                                page-break-inside: avoid;
                                background: #f9f9f9;
                            }
                            
                            .card-header {
                                margin-bottom: 8mm;
                                page-break-inside: avoid;
                            }
                            
                            .card-title {
                                display: flex;
                                align-items: center;
                                gap: 5mm;
                            }
                            
                            .card-title h2 {
                                margin: 0;
                                border: none;
                                padding: 0;
                            }
                            
                            .confidence-badge {
                                display: inline-block;
                                background: #FF6B6B;
                                color: white;
                                padding: 4mm 8mm;
                                border-radius: 3mm;
                                font-weight: bold;
                                font-size: 10pt;
                            }
                            
                            .confidence-meter {
                                margin: 8mm 0;
                                page-break-inside: avoid;
                            }
                            
                            .confidence-meter-bar {
                                height: 6pt;
                                background: #e0e0e0;
                                border: 1px solid #999;
                                overflow: hidden;
                            }
                            
                            .confidence-meter-fill {
                                height: 100%;
                                background: #FF6B6B;
                            }
                            
                            .card-description {
                                margin: 8mm 0;
                                padding: 8mm 0;
                                border-bottom: 1px solid #ddd;
                            }
                            
                            .severity-indicator {
                                display: block;
                                background: #fff3cd;
                                border-left: 3px solid #ffc107;
                                padding: 5mm 8mm;
                                margin: 5mm 0;
                                font-weight: bold;
                            }
                            
                            .rekomendasi-section {
                                page-break-inside: avoid;
                                margin: 8mm 0;
                            }
                            
                            .rekomendasi-list {
                                margin-left: 5mm;
                                padding-left: 5mm;
                            }
                            
                            .rekomendasi-list li {
                                margin: 3mm 0;
                                list-style: disc;
                            }
                            
                            .gejala-summary {
                                page-break-inside: avoid;
                                background: #e3f2fd;
                                border-left: 3px solid #2196F3;
                                padding: 8mm;
                                margin: 8mm 0;
                            }
                            
                            .gejala-tags {
                                display: flex;
                                flex-wrap: wrap;
                                gap: 3mm;
                            }
                            
                            .gejala-tag {
                                display: inline-block;
                                background: white;
                                border: 1px solid #2196F3;
                                color: #2196F3;
                                padding: 2mm 4mm;
                                border-radius: 2mm;
                                font-size: 9pt;
                            }
                            
                            .warning-box {
                                background: #fff3cd;
                                border: 2px solid #ffc107;
                                padding: 10mm;
                                margin-bottom: 10mm;
                                page-break-inside: avoid;
                            }
                            
                            .warning-box h4 {
                                color: #856404;
                                margin-bottom: 5mm;
                            }
                            
                            .warning-box p {
                                color: #856404;
                            }
                            
                            @page {
                                margin: 15mm;
                            }
                            
                            @media print {
                                body {
                                    padding: 0;
                                }
                            }
                        </style>
                    </head>
                    <body>
                        ${cloned.innerHTML}
                        <div style="margin-top: 20mm; padding-top: 10mm; border-top: 1px solid #ddd; font-size: 9pt; color: #999;">
                            <p>Dokumen ini dihasilkan oleh GlucoHealth - Sistem Pakar Diagnosis Diabetes</p>
                            <p>Tanggal: ${new Date().toLocaleDateString('id-ID')}</p>
                            <p style="color: #f00; font-weight: bold;">PENTING: Hasil ini hanya untuk referensi. Konsultasikan dengan dokter untuk diagnosis yang lebih akurat.</p>
                        </div>
                    </body>
                    </html>
                `;
                
                // Write to print window
                printWindow.document.write(printContent);
                printWindow.document.close();
                
                // Wait for content to load, then print
                setTimeout(() => {
                    printWindow.print();
                    // Optional: close window after print
                    // printWindow.close();
                }, 250);
                
                console.log('✓ PDF print dialog opened');
                
            } catch (error) {
                console.error('Error:', error);
                alert('Terjadi kesalahan: ' + error.message);
            }
        }
        
        function goToInfoPenyakit() {
            const resultData = sessionStorage.getItem('diagnosisResult');
            console.log('goToInfoPenyakit called, resultData:', resultData ? 'exists' : 'not found');
            
            if (resultData) {
                try {
                    const data = JSON.parse(resultData);
                    const penyakitId = data.diagnosis_utama.penyakit_id;
                    
                    // Store in localStorage as backup
                    localStorage.setItem('targetAccordionId', 'disease-' + penyakitId);
                    localStorage.setItem('openAccordionOnLoad', 'true');
                    
                    const targetUrl = 'index.html#info'; // First go to #info section
                    console.log('Redirecting to:', targetUrl);
                    console.log('Will then navigate to disease:', penyakitId);
                    
                    // Redirect ke info section dulu, baru ke accordion
                    window.location.href = targetUrl;
                } catch (e) {
                    console.error('Error:', e);
                    alert('Terjadi kesalahan saat membuka info penyakit');
                }
            } else {
                console.log('No diagnosis data, redirecting to index.html');
                window.location.href = 'index.html#info';
            }
        }
        
        // Handle hash link untuk scroll ke diagnosis di index.html
        document.addEventListener('DOMContentLoaded', () => {
            console.log('✓ hasil.php DOMContentLoaded');
            loadDiagnosisResult();
        });
    </script>

    <script src="script.js"></script>
</body>
</html>