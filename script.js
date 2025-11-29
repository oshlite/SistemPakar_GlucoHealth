const gejalaDictionary = {"G1":"Poliuria (Sering Kencing)","G2":"Mual dan muntah","G3":"Pusing","G4":"Polifagia (Cepat Lapar)","G5":"Keringat berlebihan","G6":"Gelisah","G7":"Mudah lelah","G8":"Polidipsia (Sering Haus)","G9":"Gangguan Keseimbangan","G10":"Disfungsi ereksi","G11":"Gemetar","G12":"Pandangan Kabur","G13":"Sulit berkonsentrasi","G14":"Gula darah tinggi","G15":"Nafas cepat dan berbau keton","G16":"Penglihatan menurun","G17":"Tampak bercak hitam pada penglihatan","G18":"Nyeri pada mata","G19":"Gatal-gatal","G20":"Hilangnya nafsu makan","G21":"Insomnia","G22":"Lemas","G23":"Penurunan libido","G24":"Sembelit","G25":"Sesak nafas","G26":"Luka infeksi yang sukar sembuh","G27":"Mati rasa atau kelemahan pada kaki","G28":"Tidak ada nadi atau nadi di kaki lemah","G29":"Kelumpuhan pada anggota tubuh","G30":"Sulit berbicara","G31":"Sulit untuk melihat","G32":"Kesulitan menelan"};

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
            
            // Get all checked checkboxes (note: name is now "gejala[]")
            const checkboxes = form.querySelectorAll('input[name="gejala[]"]:checked');
            console.log('✓ Found', checkboxes.length, 'checked checkboxes');
            
            const gejala = Array.from(checkboxes).map(cb => cb.value);
            console.log('✓ Gejala array:', gejala);
            
            if (gejala.length === 0) { 
                showAlert('Pilih minimal 1 gejala untuk diagnosis', 'error');
                return; 
            }
            
            // Create FormData manually
            const formData = new FormData();
            gejala.forEach(g => {
                formData.append('gejala[]', g);
                console.log('  Added gejala:', g);
            });
            
            console.log('✓ FormData prepared with', gejala.length, 'items');
            
            const submitBtn = document.getElementById('submitBtn');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';
            submitBtn.disabled = true;
            
            showAlert('Sedang memproses diagnosis...', 'info');
            
            try {
                console.log('✓ Sending to diagnosis.php...');
                
                const res = await fetch('diagnosis.php', { 
                    method: 'POST', 
                    body: formData
                });
                
                console.log('✓ Response received, status:', res.status);
                
                const text = await res.text();
                console.log('✓ Response length:', text.length, 'chars');
                
                if (!text || text.trim() === '') {
                    throw new Error('Server returned empty response');
                }
                
                // Try to parse JSON
                let data;
                try {
                    data = JSON.parse(text);
                    console.log('✓ Parsed JSON:', data.status);
                } catch (parseErr) {
                    console.error('❌ JSON parse error');
                    console.error('Response:', text.substring(0, 200));
                    throw new Error('Invalid JSON response');
                }
                
                if (data.status === 'success') {
                    console.log('✓ Success! Diagnosis found');
                    showAlert('✓ Diagnosis berhasil! Mengarahkan ke hasil...', 'success');
                    sessionStorage.setItem('diagnosisResult', JSON.stringify(data));
                    setTimeout(() => {
                        window.location.href = 'hasil.php';
                    }, 1500);
                } else if (data.status === 'warning' || data.status === 'error') {
                    console.warn('⚠️ No diagnosis match:', data.message);
                    showAlert('⚠️ ' + data.message, 'error');
                } else {
                    console.error('? Unknown status:', data);
                    showAlert('Status tidak dikenali', 'error');
                }
            } catch (error) {
                console.error('❌ Error:', error.message);
                showAlert('Kesalahan: ' + error.message, 'error');
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
