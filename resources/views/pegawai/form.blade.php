<div class="row g-3">
    <div class="col-md-6">
        <label for="nama">Nama</label>
        <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama', $pegawai->nama ?? '') }}" required>
        @error('nama')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-3">
        <label for="tempat_lahir">Tempat Lahir</label>
        <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" value="{{ old('tempat_lahir', $pegawai->tempat_lahir ?? '') }}" required>
        @error('tempat_lahir')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-3">
        <label for="tanggal_lahir">Tanggal Lahir</label>
        <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir', $pegawai->tanggal_lahir ?? '') }}" required>
        @error('tanggal_lahir')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-3">
        <label for="nip">NIP</label>
        <input type="text"
            name="nip"
            id="nip"
            class="form-control"
            maxlength="18"
            pattern="\d{18}"
            value="{{ old('nip', $pegawai->nip ?? '') }}"
            required
            title="NIP harus terdiri dari 18 digit angka">
        <small class="text-muted">NIP harus terdiri dari 18 digit angka tanpa spasi</small>
        @error('nip')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-3">
        <label for="pangkat">Pangkat</label>
        <select name="pangkat" id="pangkat" class="form-select" required>
            @foreach([
                'Pembina Utama',
                'Pembina Utama Madya',
                'Pembina Utama Muda',
                'Pembina Tingkat I',
                'Pembina',
                'Penata Tingkat I',
                'Penata',
                'Penata Muda Tingkat I',
                'Penata Muda',
                'Pengatur Tingkat I',
                'Pengatur',
                'Pengatur Muda Tingkat I',
                'Pengatur Muda',
                'PPPK'
            ] as $pangkat)
                <option value="{{ $pangkat }}" {{ old('pangkat', $pegawai->pangkat ?? '') == $pangkat ? 'selected' : '' }}>{{ $pangkat }}</option>
            @endforeach
        </select>
        @error('pangkat')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-3">
        <label for="golongan">Golongan</label>
        <select name="golongan" id="golongan" class="form-select" required>
            @foreach([
                'IVe','IVd','IVc','IVb','IVa',
                'IIId','IIIc','IIIb','IIIa',
                'IId','IIc','IIb','IIa','PPPK'
            ] as $golongan)
                <option value="{{ $golongan }}" {{ old('golongan', $pegawai->golongan ?? '') == $golongan ? 'selected' : '' }}>{{ $golongan }}</option>
            @endforeach
        </select>
        @error('golongan')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-3">
        <label for="jabatan">Jabatan</label>
        <input type="text" name="jabatan" id="jabatan" class="form-control" value="{{ old('jabatan', $pegawai->jabatan ?? '') }}" required>
        @error('jabatan')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-3">
        <label for="masa_kerja_tahun">Masa Kerja (Tahun)</label>
        <input type="number" name="masa_kerja_tahun" id="masa_kerja_tahun" class="form-control" value="{{ old('masa_kerja_tahun', $pegawai->masa_kerja_tahun ?? '') }}" required min="0">
        @error('masa_kerja_tahun')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-3">
        <label for="masa_kerja_bulan">Masa Kerja (Bulan)</label>
        <input type="number" name="masa_kerja_bulan" id="masa_kerja_bulan" class="form-control" value="{{ old('masa_kerja_bulan', $pegawai->masa_kerja_bulan ?? '') }}" required min="0" max="11">
        @error('masa_kerja_bulan')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-3">
        <label for="status_kepegawaian">Status Kepegawaian</label>
        <select name="status_kepegawaian" id="status_kepegawaian" class="form-select" required>
            @foreach(['PNS','PPPK'] as $status)
                <option value="{{ $status }}" {{ old('status_kepegawaian', $pegawai->status_kepegawaian ?? '') == $status ? 'selected' : '' }}>{{ $status }}</option>
            @endforeach
        </select>
        @error('status_kepegawaian')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-3">
        <label for="nama_sekolah">Nama Sekolah</label>
        <input type="text" name="nama_sekolah" id="nama_sekolah" class="form-control" value="{{ old('nama_sekolah', $pegawai->nama_sekolah ?? '') }}" required>
        @error('nama_sekolah')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-3">
        <label for="tahun_lulus">Tahun Lulus</label>
        <input type="number" name="tahun_lulus" id="tahun_lulus" class="form-control" value="{{ old('tahun_lulus', $pegawai->tahun_lulus ?? '') }}" required min="1900" max="{{ now()->year }}">
        @error('tahun_lulus')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-3">
        <label for="tingkat_pendidikan">Tingkat Pendidikan</label>
        <select name="tingkat_pendidikan" id="tingkat_pendidikan" class="form-select" required>
            @foreach(['SD','SLTP','SLTA','D1','D2','D3','D4','S1','S2','S3'] as $tp)
                <option value="{{ $tp }}" {{ old('tingkat_pendidikan', $pegawai->tingkat_pendidikan ?? '') == $tp ? 'selected' : '' }}>{{ $tp }}</option>
            @endforeach
        </select>
        @error('tingkat_pendidikan')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-3">
        <label for="jenis_kelamin">Jenis Kelamin</label>
        <select name="jenis_kelamin" id="jenis_kelamin" class="form-select" required>
            @foreach(['Laki-laki','Perempuan'] as $jk)
                <option value="{{ $jk }}" {{ old('jenis_kelamin', $pegawai->jenis_kelamin ?? '') == $jk ? 'selected' : '' }}>{{ $jk }}</option>
            @endforeach
        </select>
        @error('jenis_kelamin')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-3">
        <label for="usia">Usia</label>
        <input type="number" name="usia" id="usia" class="form-control" value="{{ old('usia', $pegawai->usia ?? '') }}" readonly tabindex="-1">
        @error('usia')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-3">
        <label for="tempat_tugas">Tempat Tugas</label>
        <select name="tempat_tugas" id="tempat_tugas" class="form-select" required>
            <option value="">-- Pilih Tempat Tugas --</option>
            @foreach([
                'Dinas Kesehatan',
                'RSUD Bangkinang',
                'UPTD Labkesmas',
                'UPTD IFK',
                'UPTD Puskesmas Air Tiris',
                'UPTD Puskesmas Bangkinang',
                'UPTD Puskesmas Batu Bersurat',
                'UPTD Puskesmas Batu Sasak',
                'UPTD Puskesmas Gema',
                'UPTD Puskesmas Gunung Bungsu',
                'UPTD Puskesmas Gunung Sahilan',
                'UPTD Puskesmas Gunung Sari',
                'UPTD Puskesmas Kampa',
                'UPTD Puskesmas Kota Garo',
                'UPTD Puskesmas Kubang Jaya',
                'UPTD Puskesmas Kuntu',
                'UPTD Puskesmas Kuok',
                'UPTD Puskesmas Laboy Jaya',
                'UPTD Puskesmas Lipat Kain',
                'UPTD Puskesmas Muara Uwai',
                'UPTD Puskesmas Pandau Jaya',
                'UPTD Puskesmas Pangkalan Baru',
                'UPTD Puskesmas Pantai Cermin',
                'UPTD Puskesmas Pantai Raja',
                'UPTD Puskesmas Petapahan',
                'UPTD Puskesmas Pulau Gadang',
                'UPTD Puskesmas Rumbio',
                'UPTD Puskesmas Salo',
                'UPTD Puskesmas Sawah',
                'UPTD Puskesmas Sibiruang',
                'UPTD Puskesmas Simalinyang',
                'UPTD Puskesmas Sinamanenek',
                'UPTD Puskesmas Suka Ramai',
                'UPTD Puskesmas Sungai Pagar',
                'UPTD Puskesmas Tambang',
                'UPTD Puskesmas Tanah Tinggi',
                'UPTD Puskesmas Tapung',
            ] as $unit)
                <option value="{{ $unit }}" {{ old('tempat_tugas', $pegawai->tempat_tugas ?? '') == $unit ? 'selected' : '' }}>
                    {{ $unit }}
                </option>
            @endforeach
        </select>
        @error('tempat_tugas')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-3">
        <label for="nomor_seri_karpeg">Nomor Seri Karpeg</label>
        <input type="text" name="nomor_seri_karpeg" id="nomor_seri_karpeg" class="form-control" value="{{ old('nomor_seri_karpeg', $pegawai->nomor_seri_karpeg ?? '') }}" required>
        @error('nomor_seri_karpeg')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-4">
    <label for="sk_pangkat_terakhir">Upload SK Pangkat Terakhir (PDF/JPG/PNG, maks 2MB)</label>
    <input type="file" name="sk_pangkat_terakhir" id="sk_pangkat_terakhir" class="form-control" accept=".pdf,.jpg,.jpeg,.png" required>
    @error('sk_pangkat_terakhir')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

</div>

<script>
function hitungUsia() {
    const tglLahirInput = document.getElementById('tanggal_lahir');
    const usiaField = document.getElementById('usia');
    if (!tglLahirInput || !usiaField) return;
    const tglLahir = tglLahirInput.value;
    if (tglLahir) {
        const today = new Date();
        const birthDate = new Date(tglLahir);
        let age = today.getFullYear() - birthDate.getFullYear();
        const m = today.getMonth() - birthDate.getMonth();
        if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
            age--;
        }
        usiaField.value = age > 0 ? age : 0;
    } else {
        usiaField.value = '';
    }
}

window.addEventListener('DOMContentLoaded', function() {
    const tglLahirInput = document.getElementById('tanggal_lahir');
    if (tglLahirInput) {
        tglLahirInput.addEventListener('change', hitungUsia);
        // Hitung otomatis jika sudah ada value (misal di edit form)
        if (tglLahirInput.value) {
            hitungUsia();
        }
    }
});
</script>