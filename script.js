const gejalaDictionary = {"G1":"Poliuria (Sering Kencing)","G2":"Mual dan muntah","G3":"Pusing","G4":"Polifagia (Cepat Lapar)","G5":"Keringat berlebihan","G6":"Gelisah","G7":"Mudah lelah","G8":"Polidipsia (Sering Haus)","G9":"Gangguan Keseimbangan","G10":"Disfungsi ereksi","G11":"Gemetar","G12":"Pandangan Kabur","G13":"Sulit berkonsentrasi","G14":"Gula darah tinggi","G15":"Nafas cepat dan berbau keton","G16":"Penglihatan menurun","G17":"Tampak bercak hitam pada penglihatan","G18":"Nyeri pada mata","G19":"Gatal-gatal","G20":"Hilangnya nafsu makan","G21":"Insomnia","G22":"Lemas","G23":"Penurunan libido","G24":"Sembelit","G25":"Sesak nafas","G26":"Luka infeksi yang sukar sembuh","G27":"Mati rasa atau kelemahan pada kaki","G28":"Tidak ada nadi atau nadi di kaki lemah","G29":"Kelumpuhan pada anggota tubuh","G30":"Sulit berbicara","G31":"Sulit untuk melihat","G32":"Kesulitan menelan"};

const penyakitDictionary = {"P1":"Hipoglikemia","P2":"Hiperglikemia","P3":"Ketoasidosis Diabetik","P4":"Retinopati Diabetik","P5":"Nefropati Diabetik","P6":"Neuropati Diabetik","P7":"Penyakit Jantung Koroner","P8":"Penyakit Pembuluh Darah Tepi","P9":"Penyakit Pembuluh Darah Otak"};

const rules = {
    "R1": {"gejala": ["G3","G4","G5","G6","G7","G11","G12","G13"], "penyakit": "P1"},
    "R2": {"gejala": ["G1","G4","G8","G14"], "penyakit": "P2"},
    "R3": {"gejala": ["G1","G2","G7","G8","G15"], "penyakit": "P3"},
    "R4": {"gejala": ["G16","G17","G18"], "penyakit": "P4"},
    "R5": {"gejala": ["G1","G2","G19","G20","G21","G22"], "penyakit": "P5"},
    "R6": {"gejala": ["G5","G9","G10","G23","G24"], "penyakit": "P6"},
    "R7": {"gejala": ["G2","G6","G25"], "penyakit": "P7"},
    "R8": {"gejala": ["G1","G10","G26","G27","G28"], "penyakit": "P8"},
    "R9": {"gejala": ["G1","G3","G9","G29","G30","G31","G32"], "penyakit": "P9"}
};

const penyakitDetail = {
    "P1": {"nama": "Hipoglikemia", "deskripsi": "Kondisi ketika kadar gula darah terlalu rendah (di bawah 70 mg/dL). Gejala meliputi pusing, lelah, gemetar, dan sulit berkonsentrasi.", "tingkat_keparahan": "Sedang", "warna_status": "#FF6B6B", "rekomendasi": ["Minum minuman yang mengandung gula (jus, soda)", "Konsumsi makanan yang cepat diserap (permen, madu)", "Istirahat dan hindari aktivitas berat", "Segera periksakan ke dokter untuk pengecekan gula darah", "Konsultasi dengan ahli gizi untuk penyesuaian diet"]},
    "P2": {"nama": "Hiperglikemia", "deskripsi": "Kondisi ketika kadar gula darah terlalu tinggi. Gejala termasuk sering kencing, cepat lapar, sering haus, dan gula darah tinggi.", "tingkat_keparahan": "Sedang", "warna_status": "#FFA500", "rekomendasi": ["Batasi konsumsi makanan manis dan karbohidrat sederhana", "Perbanyak minum air putih", "Lakukan olahraga teratur minimal 30 menit setiap hari", "Periksakan gula darah secara berkala", "Konsultasi dengan dokter untuk penyesuaian obat"]},
    "P3": {"nama": "Ketoasidosis Diabetik", "deskripsi": "Komplikasi serius diabetes yang ditandai dengan penumpukan asam dalam darah. Memerlukan penanganan medis segera.", "tingkat_keparahan": "Sangat Berat", "warna_status": "#DC3545", "rekomendasi": ["⚠️ SEGERA ke rumah sakit atau Unit Gawat Darurat (UGD)", "Jangan menunda perawatan medis", "Bawa kartu identitas dan data medis Anda", "Hubungi anggota keluarga untuk menemani", "Siapkan riwayat kesehatan untuk dibawa ke dokter"]},
    "P4": {"nama": "Retinopati Diabetik", "deskripsi": "Komplikasi diabetes yang menyerang mata dan dapat menyebabkan kebutaan jika tidak ditangani.", "tingkat_keparahan": "Berat", "warna_status": "#FF6B6B", "rekomendasi": ["Periksa ke dokter mata (oftalmolog) segera", "Lakukan pemeriksaan mata secara berkala (setiap 6-12 bulan)", "Kontrol gula darah dengan ketat", "Hindari paparan sinar matahari langsung yang berlebihan", "Konsumsi makanan kaya antioksidan (blueberry, carrot)"]},
    "P5": {"nama": "Nefropati Diabetik", "deskripsi": "Kerusakan ginjal akibat diabetes. Dapat berkembang menjadi gagal ginjal jika tidak ditangani dengan baik.", "tingkat_keparahan": "Berat", "warna_status": "#FF6B6B", "rekomendasi": ["Periksa fungsi ginjal melalui tes laboratorium", "Kurangi asupan garam dalam makanan", "Batasi konsumsi protein (terutama daging merah)", "Konsultasi dengan dokter spesialis ginjal (nephrologi)", "Minum air putih cukup (2-3 liter per hari)"]},
    "P6": {"nama": "Neuropati Diabetik", "deskripsi": "Kerusakan saraf akibat diabetes yang dapat mempengaruhi berbagai bagian tubuh.", "tingkat_keparahan": "Sedang", "warna_status": "#FFA500", "rekomendasi": ["Lakukan pemeriksaan saraf secara berkala", "Hindari cedera pada kaki (gunakan alas kaki yang nyaman)", "Jaga kelembaban kulit dengan krim pelembab", "Olahraga ringan seperti jalan kaki 20-30 menit", "Konsultasi dengan dokter untuk manajemen nyeri neuropati"]},
    "P7": {"nama": "Penyakit Jantung Koroner", "deskripsi": "Penyakit jantung yang terjadi ketika pembuluh darah yang memasok darah ke jantung menyempit atau tersumbat.", "tingkat_keparahan": "Sangat Berat", "warna_status": "#DC3545", "rekomendasi": ["⚠️ Konsultasi dengan dokter spesialis jantung (kardiologi)", "Lakukan pemeriksaan EKG dan stress test", "Hindari stres dan istirahat yang cukup", "Batasi asupan lemak jenuh dan kolesterol", "Lakukan program rehabilitasi jantung yang dipandu dokter"]},
    "P8": {"nama": "Penyakit Pembuluh Darah Tepi", "deskripsi": "Gangguan pada pembuluh darah di luar jantung dan otak, terutama di kaki.", "tingkat_keparahan": "Berat", "warna_status": "#FF6B6B", "rekomendasi": ["Periksa ke dokter spesialis pembuluh darah (vaskular)", "Hindari merokok dan paparan asap rokok", "Jaga kebersihan kaki dan hindari luka", "Gunakan kaus kaki yang nyaman dan tidak ketat", "Olahraga ringan seperti berjalan untuk meningkatkan sirkulasi"]},
    "P9": {"nama": "Penyakit Pembuluh Darah Otak", "deskripsi": "Gangguan pembuluh darah otak yang dapat menyebabkan stroke. Memerlukan penanganan segera.", "tingkat_keparahan": "Sangat Berat", "warna_status": "#DC3545", "rekomendasi": ["⚠️ Jika ada gejala stroke, segera hubungi ambulans (112)", "Tanda stroke: kesulitan bicara, kelemahan separuh tubuh, pusing ekstrem", "Konsultasi dengan dokter saraf (neurologi)", "Hindari stres dan tidur teratur", "Batasi asupan garam dan alkohol"]}
};

// Forward Chaining Algorithm (JavaScript version)
function forwardChaining(gejalInput) {
    if (!Array.isArray(gejalInput) || gejalInput.length === 0) {
        return [];
    }
    
    const gejalSet = new Set(gejalInput);
    const hasilMatch = [];
    
    // PRIORITAS 1: Cek gejala unik terlebih dahulu
    const uniqueGejala = {
        "G13": "P1", "G15": "P3", "G16": "P4", "G17": "P4", "G18": "P4",
        "G19": "P5", "G20": "P5", "G27": "P8", "G28": "P8"
    };
    
    for (const [g, p] of Object.entries(uniqueGejala)) {
        if (gejalSet.has(g)) {
            return [{
                penyakit_id: p,
                penyakit_nama: penyakitDictionary[p],
                confidence: 100,
                rule_id: 'UNIQUE',
                gejala_match: 1,
                jenis_match: 'UNIQUE_INDICATOR'
            }];
        }
    }
    
    // PRIORITAS 1b: Heuristic
    if (gejalSet.has("G5") && gejalSet.has("G7")) {
        hasilMatch.push({
            penyakit_id: 'P1',
            penyakit_nama: penyakitDictionary['P1'],
            confidence: 100,
            rule_id: 'HEURISTIC',
            gejala_match: 2,
            jenis_match: 'HEURISTIC_PRIORITY'
        });
    }
    
    if (gejalSet.has("G10") && gejalSet.has("G23") && gejalSet.has("G26")) {
        return [{
            penyakit_id: 'P8',
            penyakit_nama: penyakitDictionary['P8'],
            confidence: 100,
            rule_id: 'HEURISTIC_G26',
            gejala_match: 3,
            jenis_match: 'HEURISTIC_PRIORITY'
        }];
    }
    
    // PRIORITAS 2: Exact match
    for (const [ruleId, rule] of Object.entries(rules)) {
        let matchCount = 0;
        for (const g of rule.gejala) {
            if (gejalSet.has(g)) matchCount++;
        }
        
        if (matchCount === rule.gejala.length) {
            hasilMatch.push({
                penyakit_id: rule.penyakit,
                penyakit_nama: penyakitDictionary[rule.penyakit],
                confidence: 100,
                rule_id: ruleId,
                gejala_match: matchCount,
                jenis_match: 'EXACT'
            });
        }
    }
    
    if (hasilMatch.length > 0) {
        hasilMatch.sort((a, b) => b.confidence - a.confidence);
        return hasilMatch;
    }
    
    // PRIORITAS 3: Partial match >= 50%
    for (const [ruleId, rule] of Object.entries(rules)) {
        let matchCount = 0;
        for (const g of rule.gejala) {
            if (gejalSet.has(g)) matchCount++;
        }
        
        const confidence = (matchCount / rule.gejala.length) * 100;
        
        if (confidence >= 50 && matchCount < rule.gejala.length) {
            hasilMatch.push({
                penyakit_id: rule.penyakit,
                penyakit_nama: penyakitDictionary[rule.penyakit],
                confidence: Math.round(confidence),
                rule_id: ruleId,
                gejala_match: matchCount,
                jenis_match: 'PARTIAL'
            });
        }
    }
    
    hasilMatch.sort((a, b) => {
        if (a.confidence !== b.confidence) return b.confidence - a.confidence;
        if (a.jenis_match !== b.jenis_match) return a.jenis_match === 'EXACT' ? -1 : 1;
        return 0;
    });
    
    return hasilMatch;
}

function populateGejala() {
    const grid = document.querySelector('.gejala-grid');
    if (!grid) return;
    let html = '';
    Object.entries(gejalaDictionary).forEach(([k, v]) => {
        html += `<label class="gejala-item"><input type="checkbox" class="gejala-checkbox" name="gejala[]" value="${k}"><span class="gejala-label">${v}</span><span class="gejala-code">${k}</span></label>`;
    });
    grid.innerHTML = html;
    grid.querySelectorAll('input[type="checkbox"]').forEach(cb => cb.addEventListener('change', updateProgress));
    updateProgress();
}

function updateProgress() {
    const all = document.querySelectorAll('.gejala-grid input[type="checkbox"]');
    const checked = document.querySelectorAll('.gejala-grid input[type="checkbox"]:checked');
    const pct = (checked.length / all.length) * 100;
    const fill = document.getElementById('progressFill');
    const count = document.getElementById('selectedCount');
    const btn = document.getElementById('submitBtn');
    if (fill) fill.style.width = pct + '%';
    if (count) count.textContent = checked.length;
    if (btn) btn.disabled = checked.length === 0;
    document.querySelectorAll('.gejala-item').forEach((item, i) => {
        if (all[i]?.checked) item.classList.add('active');
        else item.classList.remove('active');
    });
}

function showAlert(message, type = 'info') {
    const alert = document.createElement('div');
    alert.style.cssText = `position: fixed; top: 20px; right: 20px; padding: 15px 20px; border-radius: 8px; 
        background: ${type === 'error' ? '#FF6B6B' : type === 'success' ? '#4CAF50' : '#2196F3'}; 
        color: white; z-index: 3000; min-width: 300px; box-shadow: 0 5px 20px rgba(0,0,0,0.2);`;
    alert.textContent = message;
    document.body.appendChild(alert);
    setTimeout(() => alert.remove(), 4000);
}

document.addEventListener('DOMContentLoaded', () => {
    // Clear previous diagnosis result
    sessionStorage.removeItem('diagnosisResult');
    
    console.log('=== DOMContentLoaded START ===');
    console.log('localStorage at page load:', {
        targetAccordionId: localStorage.getItem('targetAccordionId'),
        openAccordionOnLoad: localStorage.getItem('openAccordionOnLoad')
    });
    
    populateGejala();
    console.log('✓ DOMContentLoaded - gejala populated');
    
    // CHECK QUERY PARAMETER untuk accordion
    const urlParams = new URLSearchParams(window.location.search);
    const accordionToOpen = urlParams.get('openAccordion');
    if (accordionToOpen) {
        console.log('🎯 Query param found: openAccordion=' + accordionToOpen);
        // Wait untuk element tersedia
        setTimeout(() => {
            openAccordionById('disease-' + accordionToOpen);
        }, 500);
    }
    
    const resetBtn = document.getElementById('resetBtn');
    if (resetBtn) {
        resetBtn.addEventListener('click', () => {
            document.querySelectorAll('.gejala-grid input[type="checkbox"]').forEach(cb => cb.checked = false);
            updateProgress();
            showAlert('Gejala telah direset', 'info');
        });
    }
    
    const form = document.getElementById('diagnosisForm');
    if (form) {
        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            console.log('✓ Form submit event triggered');
            
            // Get all checked checkboxes
            const checkboxes = form.querySelectorAll('input[name="gejala[]"]:checked');
            console.log('✓ Found', checkboxes.length, 'checked checkboxes');
            
            const gejala = Array.from(checkboxes).map(cb => cb.value);
            console.log('✓ Gejala array:', gejala);
            
            if (gejala.length === 0) { 
                showAlert('Pilih minimal 1 gejala untuk diagnosis', 'error');
                return; 
            }
            
            const submitBtn = document.getElementById('submitBtn');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';
            submitBtn.disabled = true;
            
            showAlert('Sedang memproses diagnosis...', 'info');
            
            try {
                // Run forward chaining algorithm
                const hasilDiagnosis = forwardChaining(gejala);
                console.log('✓ Forward chaining completed, results:', hasilDiagnosis.length);
                
                if (hasilDiagnosis.length === 0) {
                    throw new Error('Gejala yang Anda pilih tidak cocok dengan pola penyakit yang diketahui');
                }
                
                // Prepare diagnosis result
                const diagnosisUtama = hasilDiagnosis[0];
                const data = {
                    status: 'success',
                    timestamp: new Date().toISOString(),
                    gejala_input: gejala.map(g => ({
                        id: g,
                        nama: gejalaDictionary[g]
                    })),
                    diagnosis_utama: diagnosisUtama,
                    kemungkinan_lain: hasilDiagnosis.slice(1, 2),
                    penyakit_detail: penyakitDetail[diagnosisUtama.penyakit_id] || {}
                };
                
                console.log('✓ Success! Diagnosis found');
                showAlert('✓ Diagnosis berhasil! Mengarahkan ke hasil...', 'success');
                
                // Store in both sessionStorage dan URL parameter
                sessionStorage.setItem('diagnosisResult', JSON.stringify(data));
                
                // Encode data untuk URL
                const encodedData = btoa(JSON.stringify(data));
                
                setTimeout(() => {
                    window.location.href = 'hasil.html?data=' + encodedData;
                }, 1500);
            } catch (error) {
                console.error('❌ Error:', error.message);
                showAlert('⚠️ ' + error.message, 'error');
            } finally {
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            }
        });
    } else {
        console.error('❌ Form #diagnosisForm not found!');
    }
    
    // Setup accordion listeners
    setupAccordionListeners();
    
    // Check initial hash immediately
    console.log('📍 DOMContentLoaded - checking hash');
    handleDiseaseHash();
    
    // Also check after a short delay to ensure DOM is fully ready
    setTimeout(() => {
        console.log('📍 Delayed hash check after 300ms');
        handleDiseaseHash();
    }, 300);
    
    // Additional check if localStorage flag is set
    if (localStorage.getItem('openAccordionOnLoad') === 'true') {
        console.log('🚩 openAccordionOnLoad flag detected');
        setTimeout(() => {
            console.log('📍 Hash check after 500ms (openAccordionOnLoad)');
            handleDiseaseHash();
            localStorage.removeItem('openAccordionOnLoad');
        }, 500);
    }
    
    // Extra aggressive check after page fully loaded
    window.addEventListener('load', () => {
        console.log('📍 Window load event - final hash check');
        handleDiseaseHash();
    });
    
    // Also check on hashchange event
    window.addEventListener('hashchange', () => {
        console.log('📍 Hashchange detected, checking disease hash');
        handleDiseaseHash();
    });
});

function setupAccordionListeners() {
    document.querySelectorAll('.accordion-header').forEach((header) => {
        header.addEventListener('click', function() {
            const item = this.closest('.accordion-item');
            const isActive = item.classList.contains('active');
            
            // Close all
            document.querySelectorAll('.accordion-item').forEach(i => i.classList.remove('active'));
            
            // Open this one if it wasn't active
            if (!isActive) {
                item.classList.add('active');
            }
        });
    });
}

function openAccordionById(id) {
    console.log('🔓 openAccordionById called with:', id);
    
    // Clean ID jika ada hash
    if (id.startsWith('#')) {
        id = id.substring(1);
    }
    
    const element = document.getElementById(id);
    console.log('  Looking for element with ID:', id);
    console.log('  Element found:', element ? 'YES ✅' : 'NO ❌');
    
    if (!element) {
        console.warn('  ⚠️ Element not found:', id);
        return false;
    }
    
    console.log('  Element class before:', element.className);
    
    // Close semua accordion
    document.querySelectorAll('.accordion-item').forEach(item => {
        item.classList.remove('active');
    });
    
    // FORCE open target dengan class
    element.classList.add('active');
    console.log('  ✅ Added .active class');
    console.log('  Element class after:', element.className);
    
    // FORCE dengan inline style juga (backup)
    const content = element.querySelector('.accordion-content');
    if (content) {
        content.style.maxHeight = '1000px';
        content.style.padding = '1.5rem';
        console.log('  ✅ Applied inline styles to content');
    }
    
    // Verify class is present
    const hasActive = element.classList.contains('active');
    console.log('  Verify .active class present:', hasActive ? 'YES ✅' : 'NO ❌');
    
    if (!hasActive) {
        console.error('  ❌ FAILED TO ADD ACTIVE CLASS!');
        return false;
    }
    
    // Scroll into view
    setTimeout(() => {
        console.log('  Scrolling to element...');
        element.scrollIntoView({ behavior: 'smooth', block: 'center' });
        console.log('  ✅ Scroll initiated');
    }, 100);
    
    console.log('  ✅ openAccordionById SUCCESS\n');
    return true;
}

// Handle hash link untuk auto-scroll dan auto-open accordion
function handleDiseaseHash() {
    let hash = window.location.hash;
    console.log('\n=== handleDiseaseHash START ===');
    console.log('Current hash:', hash);
    console.log('localStorage content:', {
        targetAccordionId: localStorage.getItem('targetAccordionId'),
        openAccordionOnLoad: localStorage.getItem('openAccordionOnLoad')
    });
    
    // ALWAYS check localStorage first (priority)
    const storageId = localStorage.getItem('targetAccordionId');
    if (storageId) {
        hash = '#' + storageId;
        console.log('✅ Using localStorage targetAccordionId:', hash);
    }
    
    // Check localStorage as backup if hash is #info
    if (hash === '#info' && !storageId) {
        console.log('Hash is #info but no targetAccordionId in localStorage');
    }
    
    if (hash.startsWith('#disease-')) {
        const id = hash.substring(1);
        console.log('🎯 Processing disease ID:', id);
        
        // First, ensure we scroll to #info section jika accordion belum ter-render
        const infoSection = document.getElementById('info');
        if (!infoSection) {
            console.log('⚠️ Info section not found, trying to scroll anyway');
        }
        
        // STEP 1: Try immediately first
        console.log('1️⃣ Attempt immediate open');
        if (openAccordionById(id)) {
            console.log('✅ SUCCESS on first attempt');
            localStorage.removeItem('targetAccordionId');
            console.log('=== handleDiseaseHash END (SUCCESS) ===\n');
            return;
        }
        
        // STEP 2: If not found, wait for element with aggressive polling
        console.log('2️⃣ Element not found yet, polling...');
        let attempts = 0;
        const maxAttempts = 120; // 120 * 50ms = 6 seconds (lebih lama untuk safety)
        
        const waitForElement = setInterval(() => {
            attempts++;
            const element = document.getElementById(id);
            
            if (element) {
                clearInterval(waitForElement);
                console.log(`✅ Element found on attempt ${attempts}! Opening accordion`);
                openAccordionById(id);
                localStorage.removeItem('targetAccordionId');
                console.log('=== handleDiseaseHash END (POLLING SUCCESS) ===\n');
            } else if (attempts >= maxAttempts) {
                clearInterval(waitForElement);
                console.error(`❌ Element not found after ${attempts} attempts (${attempts * 50}ms)`);
                
                // Debug: list available
                const availableIds = Array.from(document.querySelectorAll('[id^="disease-"]')).map(e => e.id);
                console.log('Available accordion IDs:', availableIds);
                
                // Try force scroll to info section
                const infoSec = document.getElementById('info');
                if (infoSec) {
                    console.log('Scrolling to #info section');
                    infoSec.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
                
                console.log('=== handleDiseaseHash END (TIMEOUT) ===\n');
            }
        }, 50);
    }
    console.log('=== handleDiseaseHash END ===\n');
}

// Listen for hash changes
window.addEventListener('hashchange', () => {
    console.log('\n🔄 HASHCHANGE EVENT FIRED');
    console.log('New hash:', window.location.hash);
    handleDiseaseHash();
});

// PUBLIC DEBUG FUNCTION - bisa di-call dari console untuk test
window.testAccordion = function(id) {
    console.log('\n🧪 TEST ACCORDION:', id);
    openAccordionById(id);
};
