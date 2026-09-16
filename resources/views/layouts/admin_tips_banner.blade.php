<!-- Admin Tips & Guide Banner -->
<div class="container-fluid pt-3 px-3 pb-0" id="adminTipsBannerContainer">
    <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #0d2346 0%, #173b75 100%); color: #fff; border-radius: 12px; overflow: hidden;">
        <div class="card-header border-0 d-flex align-items-center justify-content-between py-2 px-3" style="background: rgba(0, 0, 0, 0.15);">
            <div class="d-flex align-items-center">
                <div class="rounded-circle d-flex align-items-center justify-content-center mr-2 shadow-sm" style="width: 32px; height: 32px; background: rgba(255, 193, 7, 0.2);">
                    <i class="fas fa-lightbulb text-warning" style="font-size: 16px;"></i>
                </div>
                <div>
                    <h6 class="mb-0 font-weight-bold text-white" style="font-size: 14px; letter-spacing: 0.3px;">
                        Pusat Bantuan & Tips Operasional Admin SPMB
                    </h6>
                    <small class="text-white-50" style="font-size: 11px;">Panduan ringkas alur verifikasi berkas, pembayaran, kelulusan, dan ekspor data</small>
                </div>
            </div>
            <div class="card-tools d-flex align-items-center">
                <button type="button" class="btn btn-tool text-white" id="toggleAdminTipsBtn" title="Sembunyikan / Tampilkan Panduan" style="opacity: 0.85;">
                    <i class="fas fa-chevron-up" id="toggleAdminTipsIcon"></i>
                </button>
            </div>
        </div>

        <div class="card-body p-3" id="adminTipsBody" style="transition: all 0.3s ease;">
            <div class="row g-2">
                <!-- Tip 1: Verifikasi Terpadu 1 Pintu -->
                <div class="col-md-3 col-sm-6 mb-2 mb-md-0">
                    <div class="h-100 p-3 rounded" style="background: rgba(255, 255, 255, 0.08); border-left: 4px solid #20c997;">
                        <div class="d-flex align-items-center mb-1">
                            <span class="badge badge-success px-2 py-1 mr-2" style="font-size: 10px;">Alur 1 Pintu</span>
                            <span class="font-weight-bold text-white" style="font-size: 13px;">Verifikasi Pendaftaran</span>
                        </div>
                        <p class="mb-0 text-white-50" style="font-size: 12px; line-height: 1.4;">
                            Semua calon siswa terpantau di <strong>Verifikasi Pendaftaran</strong>. Klik <em>Berkas</em> untuk preview bukti transfer dan cek kelengkapan biodata.
                        </p>
                    </div>
                </div>

                <!-- Tip 2: Kelulusan, NIS & Validasi Bayar Otomatis -->
                <div class="col-md-3 col-sm-6 mb-2 mb-md-0">
                    <div class="h-100 p-3 rounded" style="background: rgba(255, 255, 255, 0.08); border-left: 4px solid #007bff;">
                        <div class="d-flex align-items-center mb-1">
                            <span class="badge badge-primary px-2 py-1 mr-2" style="font-size: 10px;">Otomatis</span>
                            <span class="font-weight-bold text-white" style="font-size: 13px;">Terima & Terbitkan NIS</span>
                        </div>
                        <p class="mb-0 text-white-50" style="font-size: 12px; line-height: 1.4;">
                            Klik <strong>Terima</strong> per siswa atau tombol <strong>Terima Semua</strong>: sistem otomatis memvalidasi bayar, terbitkan <strong>NIS</strong>, & kirim surat kelulusan ke email siswa.
                        </p>
                    </div>
                </div>

                <!-- Tip 3: Ekspor Excel -->
                <div class="col-md-3 col-sm-6 mb-2 mb-md-0">
                    <div class="h-100 p-3 rounded" style="background: rgba(255, 255, 255, 0.08); border-left: 4px solid #ffc107;">
                        <div class="d-flex align-items-center mb-1">
                            <span class="badge badge-warning text-dark px-2 py-1 mr-2" style="font-size: 10px;">Rekap Data</span>
                            <span class="font-weight-bold text-white" style="font-size: 13px;">Ekspor ke Excel (.xlsx)</span>
                        </div>
                        <p class="mb-0 text-white-50" style="font-size: 12px; line-height: 1.4;">
                            Unduh rekapitulasi data pendaftar lengkap (32 kolom biodata, orang tua, & status) via tombol <strong>Unduh Rekap Excel (.xlsx)</strong>.
                        </p>
                    </div>
                </div>

                <!-- Tip 4: Konfigurasi & Berita -->
                <div class="col-md-3 col-sm-6">
                    <div class="h-100 p-3 rounded" style="background: rgba(255, 255, 255, 0.08); border-left: 4px solid #e83e8c;">
                        <div class="d-flex align-items-center mb-1">
                            <span class="badge badge-danger px-2 py-1 mr-2" style="font-size: 10px;">Pengaturan</span>
                            <span class="font-weight-bold text-white" style="font-size: 13px;">Konfigurasi & CMS</span>
                        </div>
                        <p class="mb-0 text-white-50" style="font-size: 12px; line-height: 1.4;">
                            Perbarui biaya pendaftaran, nomor rekening Bank BRI, kontak sekolah, serta buat artikel di menu <strong>Pengaturan</strong> & <strong>Artikel</strong>.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleBtn = document.getElementById('toggleAdminTipsBtn');
        const body = document.getElementById('adminTipsBody');
        const icon = document.getElementById('toggleAdminTipsIcon');

        if (!toggleBtn || !body || !icon) return;

        // Restore state from localStorage
        const isCollapsed = localStorage.getItem('adminTipsCollapsed') === 'true';
        if (isCollapsed) {
            body.style.display = 'none';
            icon.classList.remove('fa-chevron-up');
            icon.classList.add('fa-chevron-down');
        }

        toggleBtn.addEventListener('click', function() {
            if (body.style.display === 'none') {
                body.style.display = 'block';
                icon.classList.remove('fa-chevron-down');
                icon.classList.add('fa-chevron-up');
                localStorage.setItem('adminTipsCollapsed', 'false');
            } else {
                body.style.display = 'none';
                icon.classList.remove('fa-chevron-up');
                icon.classList.add('fa-chevron-down');
                localStorage.setItem('adminTipsCollapsed', 'true');
            }
        });
    });
</script>
