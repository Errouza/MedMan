# Sistem Informasi Rekam Medis Praktik Dokter Mandiri (MedMan)

Sistem Informasi Rekam Medis (SIRM) berbasis web untuk mengelola operasional praktik dokter mandiri. Aplikasi ini dibangun dengan mengedepankan performa, keamanan, dan kemudahan antarmuka pengguna.

## 🚀 Teknologi yang Digunakan (Tech Stack)
- **Framework**: Laravel 11
- **Database**: MariaDB / MySQL
- **Frontend / Styling**: TailwindCSS + Alpine.js (TALL Stack minimalis)
- **Authentication**: Laravel Breeze / Spatie Permission (untuk RBAC)

## 👥 Peran Pengguna (Roles)
Aplikasi ini memiliki 2 peran utama dengan wewenang yang berbeda:

1. **🧑‍💻 Admin**
   - Mengelola data pasien (Pendaftaran/Update/Hapus).
   - Mendaftarkan kunjungan pasien ke antrean dokter.
   - Mengelola pembayaran (Kasir) setelah pasien selesai diperiksa.
   - Mengelola data master (obat, tindakan medis, dll.).

2. **🩺 Dokter**
   - Melihat daftar pasien dalam antrean sesuai urutan.
   - Mengisi rekam medis elektronik (anamnesis, diagnosis, dll.).
   - Menambahkan tindakan medis custom yang dilakukan pada pasien.
   - Meresepkan obat.
   - Melihat riwayat rekam medis (Electronic Health Records) pasien.

## 🏗️ Skema Database (Database Schema)

Skema direlasikan dengan baik memakai 3rd Normal Form (3NF). Berikut desain skema intinya:

### 1. `users` (Admin & Dokter)
- `id` (PK)
- `name`
- `email`
- `password`
- `role` (enum: 'admin', 'doctor')
- `timestamps`

### 2. `patients` (Data Pasien)
- `id` (PK)
- `medical_record_number` (string, unique) - Nomor RM (misal: RM-20240408-001)
- `name`
- `nik`
- `dob` (date - tanggal lahir)
- `gender`
- `address`
- `phone`
- `timestamps`

### 3. `visits` (Kunjungan / Antrean)
- `id` (PK)
- `patient_id` (FK -> patients)
- `doctor_id` (FK -> users)
- `visit_date` (datetime)
- `complaint` (text - keluhan awal)
- `status` (enum: 'waiting', 'in_progress', 'completed', 'cancelled')
- `timestamps`

### 4. `medical_records` (Rekam Medis)
- `id` (PK)
- `visit_id` (FK -> visits)
- `anamnesis` (text - riwayat penyakit/pemeriksaan subjektif)
- `physical_examination` (text - pemeriksaan objektif)
- `diagnosis` (text - ICD-10 atau text biasa)
- `notes` (text - catatan tambahan)
- `timestamps`

### 5. `medical_treatments` (Tindakan Medis yang diberikan ke pasien)
- `id` (PK)
- `medical_record_id` (FK -> medical_records)
- `treatment_name` (string)
- `cost` (decimal)
- `timestamps`

### 6. `payments` (Kasir / Pembayaran)
- `id` (PK)
- `visit_id` (FK -> visits)
- `total_amount` (decimal)
- `status` (enum: 'unpaid', 'paid')
- `payment_method` (string)
- `paid_at` (datetime)
- `timestamps`

## 🧩 Logika Controller (Controller Stack)

### Admin Controller: `Admin\PatientController` & `Admin\VisitController`
- **Pendaftaran Pasien**: Validasi NIK dan generate `medical_record_number` unik lalu simpan ke `patients`.
- **Registrasi Kunjungan**: Setelah pasien ada, admin membuat entri di tabel `visits` dengan status 'waiting'.
- **Pembayaran (Kasir)**: Admin menarik data `visits` berstatus 'completed' beserta relasi `medical_records` dan `medical_treatments` untuk diakumulasi di tagihan/pembayaran, kemudian mengupdate status di tabel `payments` menjadi 'paid'.

### Doctor Controller: `Doctor\QueueController` & `Doctor\MedicalRecordController`
- **Antrean**: Query `visits` dengan status 'waiting' untuk dokter yang sedang login, diurutkan ascending.
- **Pemeriksaan**: Mengubah status `visits` berstatus 'waiting' menjadi 'in_progress'. 
- **Pengisian Rekam Medis**: Menyimpan SOAP (Subjective, Objective, Assessment, Plan) ke dalam `medical_records` beserta rincian di `medical_treatments`.
- **Selesai**: Jika dokter telah menekan selesai, status `visits` menjadi 'completed'. Rekam medis dikunci dari perubahan lebih lanjut.
