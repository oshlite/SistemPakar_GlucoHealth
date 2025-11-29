<?php
header('Content-Type: application/json; charset=utf-8');

// Data Gejala
$gejala = [
    "G1" => "Poliuria (Sering Kencing)",
    "G2" => "Mual dan muntah",
    "G3" => "Pusing",
    "G4" => "Polifagia (Cepat Lapar)",
    "G5" => "Keringat berlebihan",
    "G6" => "Gelisah",
    "G7" => "Mudah lelah",
    "G8" => "Polidipsia (Sering Haus)",
    "G9" => "Gangguan Keseimbangan",
    "G10" => "Disfungsi ereksi",
    "G11" => "Gemetar",
    "G12" => "Pandangan Kabur",
    "G13" => "Sulit berkonsentrasi",
    "G14" => "Gula darah tinggi",
    "G15" => "Nafas cepat dan berbau keton",
    "G16" => "Penglihatan menurun",
    "G17" => "Tampak bercak hitam pada penglihatan",
    "G18" => "Nyeri pada mata",
    "G19" => "Gatal-gatal",
    "G20" => "Hilangnya nafsu makan",
    "G21" => "Insomnia",
    "G22" => "Lemas",
    "G23" => "Penurunan libido",
    "G24" => "Sembelit",
    "G25" => "Sesak nafas",
    "G26" => "Luka infeksi yang sukar sembuh",
    "G27" => "Mati rasa atau kelemahan pada kaki",
    "G28" => "Tidak ada nadi atau nadi di kaki lemah",
    "G29" => "Kelumpuhan pada anggota tubuh",
    "G30" => "Sulit berbicara",
    "G31" => "Sulit untuk melihat",
    "G32" => "Kesulitan menelan"
];

// Data Penyakit
$penyakit = [
    "P1" => "Hipoglikemia",
    "P2" => "Hiperglikemia",
    "P3" => "Ketoasidosis Diabetik",
    "P4" => "Retinopati Diabetik",
    "P5" => "Nefropati Diabetik",
    "P6" => "Neuropati Diabetik",
    "P7" => "Penyakit Jantung Koroner",
    "P8" => "Penyakit Pembuluh Darah Tepi",
    "P9" => "Penyakit Pembuluh Darah Otak"
];

// Rule-based Knowledge Base (SESUAI DENGAN PYTHON NOTEBOOK)
$rules = [
    // P1 - Hipoglikemia (low blood sugar)
    "R1" => ["gejala" => ["G3","G4","G5","G6","G7","G11","G12","G13"], "penyakit" => "P1"],
    // P2 - Hiperglikemia (high blood sugar)
    "R2" => ["gejala" => ["G1","G4","G8","G14"], "penyakit" => "P2"],
    // P3 - Ketoasidosis Diabetik (diabetic ketoacidosis)
    "R3" => ["gejala" => ["G1","G2","G7","G8","G15"], "penyakit" => "P3"],
    // P4 - Retinopati Diabetik (diabetic retinopathy)
    "R4" => ["gejala" => ["G16","G17","G18"], "penyakit" => "P4"],
    // P5 - Nefropati Diabetik (diabetic nephropathy)
    "R5" => ["gejala" => ["G1","G2","G19","G20","G21","G22"], "penyakit" => "P5"],
    // P6 - Neuropati Diabetik (diabetic neuropathy)
    "R6" => ["gejala" => ["G5","G9","G10","G23","G24"], "penyakit" => "P6"],
    // P7 - Penyakit Jantung Koroner (coronary heart disease)
    "R7" => ["gejala" => ["G2","G6","G25"], "penyakit" => "P7"],
    // P8 - Penyakit Pembuluh Darah Tepi (peripheral artery disease)
    "R8" => ["gejala" => ["G1","G10","G26","G27","G28"], "penyakit" => "P8"],
    // P9 - Penyakit Pembuluh Darah Otak (cerebrovascular disease)
    "R9" => ["gejala" => ["G1","G3","G9","G29","G30","G31","G32"], "penyakit" => "P9"]
];

// Deskripsi Penyakit dan Rekomendasi
$penyakit_detail = [
    "P1" => [
        "nama" => "Hipoglikemia",
        "deskripsi" => "Kondisi ketika kadar gula darah terlalu rendah (di bawah 70 mg/dL). Gejala meliputi pusing, lelah, gemetar, dan sulit berkonsentrasi.",
        "tingkat_keparahan" => "Sedang",
        "warna_status" => "#FF6B6B",
        "rekomendasi" => [
            "Minum minuman yang mengandung gula (jus, soda)",
            "Konsumsi makanan yang cepat diserap (permen, madu)",
            "Istirahat dan hindari aktivitas berat",
            "Segera periksakan ke dokter untuk pengecekan gula darah",
            "Konsultasi dengan ahli gizi untuk penyesuaian diet"
        ]
    ],
    "P2" => [
        "nama" => "Hiperglikemia",
        "deskripsi" => "Kondisi ketika kadar gula darah terlalu tinggi. Gejala termasuk sering kencing, cepat lapar, sering haus, dan gula darah tinggi.",
        "tingkat_keparahan" => "Sedang",
        "warna_status" => "#FFA500",
        "rekomendasi" => [
            "Batasi konsumsi makanan manis dan karbohidrat sederhana",
            "Perbanyak minum air putih",
            "Lakukan olahraga teratur minimal 30 menit setiap hari",
            "Periksakan gula darah secara berkala",
            "Konsultasi dengan dokter untuk penyesuaian obat"
        ]
    ],
    "P3" => [
        "nama" => "Ketoasidosis Diabetik",
        "deskripsi" => "Komplikasi serius diabetes yang ditandai dengan penumpukan asam dalam darah. Memerlukan penanganan medis segera.",
        "tingkat_keparahan" => "Sangat Berat",
        "warna_status" => "#DC3545",
        "rekomendasi" => [
            "⚠️ SEGERA ke rumah sakit atau Unit Gawat Darurat (UGD)",
            "Jangan menunda perawatan medis",
            "Bawa kartu identitas dan data medis Anda",
            "Hubungi anggota keluarga untuk menemani",
            "Siapkan riwayat kesehatan untuk dibawa ke dokter"
        ]
    ],
    "P4" => [
        "nama" => "Retinopati Diabetik",
        "deskripsi" => "Komplikasi diabetes yang menyerang mata dan dapat menyebabkan kebutaan jika tidak ditangani.",
        "tingkat_keparahan" => "Berat",
        "warna_status" => "#FF6B6B",
        "rekomendasi" => [
            "Periksa ke dokter mata (oftalmolog) segera",
            "Lakukan pemeriksaan mata secara berkala (setiap 6-12 bulan)",
            "Kontrol gula darah dengan ketat",
            "Hindari paparan sinar matahari langsung yang berlebihan",
            "Konsumsi makanan kaya antioksidan (blueberry, carrot)"
        ]
    ],
    "P5" => [
        "nama" => "Nefropati Diabetik",
        "deskripsi" => "Kerusakan ginjal akibat diabetes. Dapat berkembang menjadi gagal ginjal jika tidak ditangani dengan baik.",
        "tingkat_keparahan" => "Berat",
        "warna_status" => "#FF6B6B",
        "rekomendasi" => [
            "Periksa fungsi ginjal melalui tes laboratorium",
            "Kurangi asupan garam dalam makanan",
            "Batasi konsumsi protein (terutama daging merah)",
            "Konsultasi dengan dokter spesialis ginjal (nephrologi)",
            "Minum air putih cukup (2-3 liter per hari)"
        ]
    ],
    "P6" => [
        "nama" => "Neuropati Diabetik",
        "deskripsi" => "Kerusakan saraf akibat diabetes yang dapat mempengaruhi berbagai bagian tubuh.",
        "tingkat_keparahan" => "Sedang",
        "warna_status" => "#FFA500",
        "rekomendasi" => [
            "Lakukan pemeriksaan saraf secara berkala",
            "Hindari cedera pada kaki (gunakan alas kaki yang nyaman)",
            "Jaga kelembaban kulit dengan krim pelembab",
            "Olahraga ringan seperti jalan kaki 20-30 menit",
            "Konsultasi dengan dokter untuk manajemen nyeri neuropati"
        ]
    ],
    "P7" => [
        "nama" => "Penyakit Jantung Koroner",
        "deskripsi" => "Penyakit jantung yang terjadi ketika pembuluh darah yang memasok darah ke jantung menyempit atau tersumbat.",
        "tingkat_keparahan" => "Sangat Berat",
        "warna_status" => "#DC3545",
        "rekomendasi" => [
            "⚠️ Konsultasi dengan dokter spesialis jantung (kardiologi)",
            "Lakukan pemeriksaan EKG dan stress test",
            "Hindari stres dan istirahat yang cukup",
            "Batasi asupan lemak jenuh dan kolesterol",
            "Lakukan program rehabilitasi jantung yang dipandu dokter"
        ]
    ],
    "P8" => [
        "nama" => "Penyakit Pembuluh Darah Tepi",
        "deskripsi" => "Gangguan pada pembuluh darah di luar jantung dan otak, terutama di kaki.",
        "tingkat_keparahan" => "Berat",
        "warna_status" => "#FF6B6B",
        "rekomendasi" => [
            "Periksa ke dokter spesialis pembuluh darah (vaskular)",
            "Hindari merokok dan paparan asap rokok",
            "Jaga kebersihan kaki dan hindari luka",
            "Gunakan kaus kaki yang nyaman dan tidak ketat",
            "Olahraga ringan seperti berjalan untuk meningkatkan sirkulasi"
        ]
    ],
    "P9" => [
        "nama" => "Penyakit Pembuluh Darah Otak",
        "deskripsi" => "Gangguan pembuluh darah otak yang dapat menyebabkan stroke. Memerlukan penanganan segera.",
        "tingkat_keparahan" => "Sangat Berat",
        "warna_status" => "#DC3545",
        "rekomendasi" => [
            "⚠️ Jika ada gejala stroke, segera hubungi ambulans (112)",
            "Tanda stroke: kesulitan bicara, kelemahan separuh tubuh, pusing ekstrem",
            "Konsultasi dengan dokter saraf (neurologi)",
            "Hindari stres dan tidur teratur",
            "Batasi asupan garam dan alkohol"
        ]
    ]
];

// Forward Chaining Algorithm
function forward_chaining($gejala_input, $rules, $penyakit) {
    // Ensure gejala_input is array
    if (!is_array($gejala_input)) {
        return [];
    }
    
    $gejala_input_set = array_flip($gejala_input);
    $hasil_match = [];
    
    // PRIORITAS 1: Cek gejala unik terlebih dahulu
    $unique_gejala = [
        "G13" => "P1",  // Sulit berkonsentrasi → P1 Hipoglikemia
        "G15" => "P3",  // Nafas cepat dan berbau keton → P3 Ketoasidosis
        "G16" => "P4",  // Penglihatan menurun → P4 Retinopati
        "G17" => "P4",  // Tampak bercak hitam pada penglihatan → P4 Retinopati
        "G18" => "P4",  // Nyeri pada mata → P4 Retinopati
        "G19" => "P5",  // Gatal-gatal → P5 Nefropati
        "G20" => "P5",  // Hilangnya nafsu makan → P5 Nefropati
        "G27" => "P8",  // Mati rasa atau kelemahan pada kaki → P8 PAD
        "G28" => "P8"   // Tidak ada nadi atau nadi di kaki lemah → P8 PAD
    ];
    
    foreach ($unique_gejala as $g => $p) {
        if (isset($gejala_input_set[$g])) {
            return [[
                'penyakit_id' => $p,
                'penyakit_nama' => $penyakit[$p],
                'confidence' => 100,
                'rule_id' => 'UNIQUE',
                'gejala_match' => 1,
                'jenis_match' => 'UNIQUE_INDICATOR'
            ]];
        }
    }
    
    // PRIORITAS 1b: Heuristic untuk disambiguasi (seperti di Python)
    // Jika ada G5 dan G7 → P1 (lebih spesifik dari P5/P3)
    if (isset($gejala_input_set["G5"]) && isset($gejala_input_set["G7"])) {
        $hasil_match[] = [
            'penyakit_id' => 'P1',
            'penyakit_nama' => $penyakit['P1'],
            'confidence' => 100,
            'rule_id' => 'HEURISTIC',
            'gejala_match' => 2,
            'jenis_match' => 'HEURISTIC_PRIORITY'
        ];
    }
    
    // Jika ada G10, G23, G26 → P8 (Heuristic: G26 adalah indicator kuat P8)
    if (isset($gejala_input_set["G10"]) && isset($gejala_input_set["G23"]) && isset($gejala_input_set["G26"])) {
        return [[
            'penyakit_id' => 'P8',
            'penyakit_nama' => $penyakit['P8'],
            'confidence' => 100,
            'rule_id' => 'HEURISTIC_G26',
            'gejala_match' => 3,
            'jenis_match' => 'HEURISTIC_PRIORITY'
        ]];
    }
    
    // PRIORITAS 2: Cek exact match (semua gejala di rule harus ada di input)
    foreach ($rules as $rule_id => $rule) {
        $match_count = 0;
        foreach ($rule['gejala'] as $g) {
            if (isset($gejala_input_set[$g])) {
                $match_count++;
            }
        }
        
        // Jika EXACT match (semua gejala rule cocok)
        if ($match_count === count($rule['gejala'])) {
            $hasil_match[] = [
                'penyakit_id' => $rule['penyakit'],
                'penyakit_nama' => $penyakit[$rule['penyakit']],
                'confidence' => 100,
                'rule_id' => $rule_id,
                'gejala_match' => $match_count,
                'jenis_match' => 'EXACT'
            ];
        }
    }
    
    // If ada exact match, return sekarang
    if (!empty($hasil_match)) {
        usort($hasil_match, function($a, $b) {
            return $b['confidence'] - $a['confidence'];
        });
        return $hasil_match;
    }
    
    // PRIORITAS 3: Partial match dengan confidence >= 50%
    foreach ($rules as $rule_id => $rule) {
        $match_count = 0;
        foreach ($rule['gejala'] as $g) {
            if (isset($gejala_input_set[$g])) {
                $match_count++;
            }
        }
        
        $confidence = ($match_count / count($rule['gejala'])) * 100;
        
        // Jika partial match >= 50%
        if ($confidence >= 50 && $match_count < count($rule['gejala'])) {
            $hasil_match[] = [
                'penyakit_id' => $rule['penyakit'],
                'penyakit_nama' => $penyakit[$rule['penyakit']],
                'confidence' => round($confidence, 2),
                'rule_id' => $rule_id,
                'gejala_match' => $match_count,
                'jenis_match' => 'PARTIAL'
            ];
        }
    }
    
    // Sort by confidence (highest first)
    usort($hasil_match, function($a, $b) {
        if ($a['confidence'] !== $b['confidence']) {
            return $b['confidence'] - $a['confidence'];
        }
        // Jika confidence sama, prioritas EXACT match
        if ($a['jenis_match'] !== $b['jenis_match']) {
            return $a['jenis_match'] === 'EXACT' ? -1 : 1;
        }
        return 0;
    });
    
    return $hasil_match;
}

// Validasi input
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get gejala dari POST - bisa array atau string
    $gejala_raw = isset($_POST['gejala']) ? $_POST['gejala'] : [];
    
    // Debug: Log apa yang diterima
    error_log("POST gejala raw type: " . gettype($gejala_raw));
    error_log("POST gejala raw: " . print_r($gejala_raw, true));
    
    // Convert ke array jika string
    $gejala_input = [];
    if (is_array($gejala_raw)) {
        $gejala_input = $gejala_raw;
    } elseif (is_string($gejala_raw) && !empty($gejala_raw)) {
        $gejala_input = [$gejala_raw];
    }
    
    // Remove empty values
    $gejala_input = array_filter($gejala_input);
    
    error_log("After processing - gejala count: " . count($gejala_input));
    error_log("After processing - gejala: " . print_r($gejala_input, true));
    
    // Validasi gejala
    if (empty($gejala_input)) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Pilih minimal 1 gejala untuk diagnosis',
            'code' => 400
        ]);
        exit;
    }
    
    // Jalankan forward chaining
    $hasil_diagnosis = forward_chaining($gejala_input, $rules, $penyakit);
    
    error_log("Hasil diagnosis count: " . count($hasil_diagnosis));
    error_log("Hasil diagnosis: " . print_r($hasil_diagnosis, true));
    
    if (empty($hasil_diagnosis)) {
        echo json_encode([
            'status' => 'warning',
            'message' => 'Gejala yang Anda pilih tidak cocok dengan pola penyakit yang diketahui',
            'gejala_dipilih' => count($gejala_input),
            'code' => 404
        ]);
        exit;
    }
    
    // Ambil hasil tertinggi
    $diagnosis_utama = $hasil_diagnosis[0];
    
    // Persiapan data untuk halaman hasil
    $data_hasil = [
        'status' => 'success',
        'timestamp' => date('Y-m-d H:i:s'),
        'gejala_input' => array_map(function($g) use ($gejala) {
            return ['id' => $g, 'nama' => $gejala[$g]];
        }, $gejala_input),
        'diagnosis_utama' => $diagnosis_utama,
        'kemungkinan_lain' => array_slice($hasil_diagnosis, 1, 2),
        'penyakit_detail' => $penyakit_detail[$diagnosis_utama['penyakit_id']] ?? []
    ];
    
    // Simpan ke session atau return
    session_start();
    $_SESSION['diagnosis_result'] = $data_hasil;
    
    echo json_encode($data_hasil);
    exit;
}

// Jika tidak POST, return error
echo json_encode([
    'status' => 'error',
    'message' => 'Invalid request method',
    'code' => 405
]);
?>
