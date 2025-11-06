# 🏢 Sistem Reservasi Ruangan Kantor — Mini Project Laravel

---

## 🎯 Tujuan Pembelajaran

- Membangun sistem login dan manajemen role dengan Laravel
- Membuat relasi antar tabel (One-to-Many dan Many-to-Many)
- Menerapkan validasi data dan upload image
- Menggunakan Tailwind CSS untuk UI/UX
- Menampilkan data dengan Blade Template yang terstruktur dan responsif

---

## 🧩 Deskripsi Singkat

Aplikasi memiliki tiga role pengguna:

| Role     | Hak Akses                                                                 |
|----------|---------------------------------------------------------------------------|
| Admin    | Mengelola semua data (ruangan, jadwal, user)                              |
| Karyawan | Membuat reservasi ruangan                                                 |
| Petugas  | Memverifikasi dan mengonfirmasi reservasi ruangan                        |

---

## 🧱 Struktur Database

### 1. Tabel `users`

| Field     | Keterangan             |
|-----------|------------------------|
| id        | Primary Key            |
| name      | Nama pengguna          |
| email     | Unik                   |
| password  | Password terenkripsi   |
| role      | admin, petugas, karyawan |

### 2. Tabel `ruangan`

| Field         | Keterangan               |
|---------------|--------------------------|
| id            | Primary Key              |
| nama_ruangan  | Nama ruangan             |
| kapasitas     | Jumlah maksimal orang    |
| lokasi        | Lokasi ruangan           |
| deskripsi     | Opsional                 |
| foto          | Nama file gambar         |
| status        | tersedia, maintenance    |

### 3. Tabel `reservasi`

| Field           | Keterangan               |
|-----------------|--------------------------|
| id              | Primary Key              |
| user_id         | ID karyawan              |
| ruangan_id      | ID ruangan               |
| tanggal_mulai   | Tanggal mulai            |
| tanggal_selesai | Tanggal selesai          |
| keterangan      | Opsional                 |
| status          | pending, disetujui, ditolak |

---

## ⚙️ Spesifikasi Fitur

### 1. 🔐 Autentikasi & Role

- Gunakan sistem login Laravel (Laravel Breeze atau Fortify)
- Hanya admin yang dapat menambah user baru atau mengganti role
- Gunakan middleware role-based untuk membatasi akses halaman

### 2. 🏠 Manajemen Ruangan

Admin dan Petugas dapat:

- Menambah, mengedit, dan menghapus data ruangan
- Upload foto ruangan ke `storage/app/public/ruangan`

#### Validasi:

- `nama_ruangan`, `kapasitas`, dan `lokasi` wajib diisi
- `foto` wajib diupload saat tambah, opsional saat edit
- Format foto: jpg, jpeg, png maksimal 2MB

### 3. 📅 Reservasi Ruangan

- Karyawan dapat membuat reservasi
- Petugas memverifikasi (menyetujui atau menolak)
- Jika disetujui, ruangan dianggap tidak tersedia selama periode tersebut

### 4. 📖 Riwayat Reservasi

- Karyawan dapat melihat daftar reservasi miliknya beserta status
- Petugas dan admin dapat melihat semua riwayat reservasi

### 5. 🎨 UI/UX dengan Tailwind CSS

- Semua tampilan wajib menggunakan Tailwind CSS
- Komponen dasar yang digunakan:
  - Card layout untuk daftar ruangan
  - Form responsif untuk input data
  - Badge warna untuk menampilkan status (tersedia, pending, dll)

#### Halaman Minimal:

- Login / Register
- Dashboard
- Data Ruangan
- Form Reservasi
- Riwayat Reservasi

---

## 💾 Relasi Tabel

- `users` → `memiliki banyak (reservasi)`
- `ruangan` → `memiliki banyak (reservasi)`
- `reservasi` → `berelasi ke (user)` dan `berelasi ke(ruangan)`

---

## 💡 Validasi Penting

- `tanggal_mulai` harus sebelum `tanggal_selesai`
- Tidak boleh ada reservasi pada waktu yang sama untuk ruangan yang sama (gunakan query pengecekan bentrok)
- `foto` harus valid format jpg, jpeg, png maksimal 2MB

---
