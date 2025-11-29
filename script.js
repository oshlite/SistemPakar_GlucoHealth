const gejalaDictionary = {"G1":"Poliuria (Sering Kencing)","G2":"Mual dan muntah","G3":"Pusing","G4":"Polifagia (Cepat Lapar)","G5":"Keringat berlebihan","G6":"Gelisah","G7":"Mudah lelah","G8":"Polidipsia (Sering Haus)","G9":"Gangguan Keseimbangan","G10":"Disfungsi ereksi","G11":"Gemetar","G12":"Pandangan Kabur","G13":"Sulit berkonsentrasi","G14":"Gula darah tinggi","G15":"Nafas cepat dan berbau keton","G16":"Penglihatan menurun","G17":"Tampak bercak hitam pada penglihatan","G18":"Nyeri pada mata","G19":"Gatal-gatal","G20":"Hilangnya nafsu makan","G21":"Insomnia","G22":"Lemas","G23":"Penurunan libido","G24":"Sembelit","G25":"Sesak nafas","G26":"Luka infeksi yang sukar sembuh","G27":"Mati rasa atau kelemahan pada kaki","G28":"Tidak ada nadi atau nadi di kaki lemah","G29":"Kelumpuhan pada anggota tubuh","G30":"Sulit berbicara","G31":"Sulit untuk melihat","G32":"Kesulitan menelan"};

function populateGejala() {
    const grid = document.querySelector('.gejala-grid');
    if (!grid) return;
    let html = '';
    Object.entries(gejalaDictionary).forEach(([k, v]) => {
        html += `<label class="gejala-item"><input type="checkbox" name="gejala[]" value="${k}"><span class="gejala-label">${v}</span><span class="gejala-code">${k}</span></label>`;
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
    
    populateGejala();
    console.log('✓ DOMContentLoaded - gejala populated');
    
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
    
    document.querySelectorAll('.accordion-header').forEach(h => {
        h.addEventListener('click', () => {
            const item = h.closest('.accordion-item');
            const isActive = item.classList.contains('active');
            document.querySelectorAll('.accordion-item').forEach(i => i.classList.remove('active'));
            if (!isActive) {
                item.classList.add('active');
            }
        });
    });
    
    // Handle hash link untuk auto-scroll dan auto-open accordion
    function handleDiseaseHash() {
        const hash = window.location.hash;
        console.log('Checking hash:', hash);
        
        if (hash.startsWith('#disease-')) {
            const diseaseId = hash.substring(1); // Remove #
            console.log('Found disease hash:', diseaseId);
            
            setTimeout(() => {
                const diseaseElement = document.getElementById(diseaseId);
                console.log('Looking for element:', diseaseId);
                console.log('Element found:', diseaseElement ? 'YES' : 'NO');
                
                if (diseaseElement) {
                    // Open the accordion
                    diseaseElement.classList.add('active');
                    console.log('✓ Added active class to', diseaseId);
                    
                    // Scroll ke element
                    diseaseElement.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    console.log('✓ Scrolled to', diseaseId);
                }
            }, 300);
        }
    }
    
    // Call handler on DOMContentLoaded
    handleDiseaseHash();
    
    // Also handle hash change
    window.addEventListener('hashchange', () => {
        console.log('Hash changed to:', window.location.hash);
        handleDiseaseHash();
    });
});
