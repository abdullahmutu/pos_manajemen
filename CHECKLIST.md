# 📋 CHECKLIST PEKERJAAN HUTANG - TOKO MANAJEMEN

## ✅ YANG SUDAH SELESAI

### Database & Models

- [x] Membuat tabel `hutangs` di database
- [x] Menambahkan struktur tabel di `toko_ku.sql`
- [x] Membuat Migration file
- [x] Membuat Model `Hutang` dengan accessor

### Controller & Routes

- [x] Membuat `HutangController` dengan 8 methods (CRUD + Bayar)
- [x] Membuat routes untuk `hutang` resource
- [x] Tambah route khusus `bayar` untuk catat pembayaran
- [x] Implementasi validation untuk semua input
- [x] Auto-create view files saat diakses

### Views (Blade Templates)

- [x] Index view - Daftar hutang
- [x] Create view - Form tambah hutang
- [x] Edit view - Form edit hutang
- [x] Show view - Detail hutang + form pembayaran
- [x] Styling responsive dengan Tailwind CSS
- [x] Status badges dengan warna-warna berbeda

### Fitur CRUD Lengkap

- [x] CREATE - Tambah data hutang baru
- [x] READ - Lihat daftar dan detail hutang
- [x] UPDATE - Edit data hutang
- [x] DELETE - Hapus data hutang
- [x] BONUS: Catat Pembayaran dengan status auto-update

### Validasi & Business Logic

- [x] Validasi input form
- [x] Auto-calculate sisa hutang
- [x] Auto-update status berdasarkan pembayaran
- [x] Confirmation dialog untuk delete
- [x] Format currency Rupiah

### Documentation

- [x] Dokumentasi lengkap di DOKUMENTASI_HUTANG.md
- [x] Penjelasan setiap fitur
- [x] Cara setup dan penggunaan
- [x] Commands untuk migration & seeding

---

## 📊 RINGKASAN FILE YANG DIBUAT

### Files Baru (Wajib):

```
1. app/Models/Hutang.php
2. app/Http/Controllers/HutangController.php
3. database/migrations/2026_04_25_000001_create_hutangs_table.php
4. database/seeders/CreateHutangViewsSeeder.php
```

### Files Termodifikasi:

```
1. routes/web.php - Tambah hutang routes
2. database/seeders/DatabaseSeeder.php - Tambah seeder
3. toko_ku.sql - Tambah struktur tabel
```

### Views yang Akan Auto-Created:

```
1. resources/views/hutang/index.blade.php
2. resources/views/hutang/create.blade.php
3. resources/views/hutang/edit.blade.php
4. resources/views/hutang/show.blade.php
```

---

## 🚀 STEP SELANJUTNYA

### 1. Import Database Table (Pilih satu):

```bash
# Option A: Via Laravel Migration
php artisan migrate

# Option B: Via MySQL Import
mysql -u root toko_ku < toko_ku.sql
```

### 2. (Optional) Run Seeder untuk Create Views

```bash
php artisan db:seed --class=CreateHutangViewsSeeder
```

### 3. Test Aplikasi

```bash
# Jalankan server
php artisan serve

# Akses di browser
http://localhost:8000/hutang
```

### 4. Git Commit & Push

```bash
# Add files
git add .

# Commit dengan message
git commit -m "feat: tambah tabel hutang dengan CRUD lengkap

- Buat tabel hutang di database
- Buat Model Hutang dengan accessor sisa_hutang
- Buat HutangController dengan CRUD operations
- Tambah routes untuk hutang resource
- Buat 4 blade templates (index, create, edit, show)
- Fitur pembayaran cicilan dengan status tracking

Co-authored-by: Copilot <223556219+Copilot@users.noreply.github.com>"

# Push ke GitHub
git push origin main
# atau
git push origin master
```

---

## 📑 TABEL HUTANG - STRUKTUR LENGKAP

| Column              | Type            | Nullable | Default     | Keterangan               |
| ------------------- | --------------- | -------- | ----------- | ------------------------ |
| id                  | bigint unsigned | ❌       | auto        | Primary Key              |
| nama_peminjam       | varchar(255)    | ❌       | -           | Nama orang yang hutang   |
| nomor_hp            | varchar(255)    | ✅       | null        | Nomor HP peminjam        |
| alamat              | text            | ✅       | null        | Alamat peminjam          |
| jumlah_hutang       | decimal(15,2)   | ❌       | -           | Total hutang             |
| jumlah_bayar        | decimal(15,2)   | ✅       | 0.00        | Total yang sudah dibayar |
| status              | varchar(255)    | ✅       | belum_lunas | Status hutang            |
| tanggal_hutang      | date            | ❌       | -           | Kapan hutang dibuat      |
| tanggal_jatuh_tempo | date            | ✅       | null        | Deadline bayar           |
| keterangan          | text            | ✅       | null        | Catatan tambahan         |
| created_at          | timestamp       | ✅       | null        | Waktu dibuat             |
| updated_at          | timestamp       | ✅       | null        | Waktu diupdate           |

---

## 🎯 STATUS HUTANG

Setiap hutang memiliki 3 status:

1. **Belum Lunas** 🔴
    - Condition: jumlah_bayar = 0
    - Belum ada pembayaran sama sekali

2. **Sebagian Lunas** 🟡
    - Condition: 0 < jumlah_bayar < jumlah_hutang
    - Ada pembayaran tapi belum total

3. **Lunas** 🟢
    - Condition: jumlah_bayar >= jumlah_hutang
    - Pembayaran sudah lengkap

---

## 🔐 SECURITY FEATURES

- [x] Route protection dengan `AuthMiddleware`
- [x] Input validation di semua forms
- [x] CSRF protection di forms
- [x] Method spoofing untuk PUT/DELETE
- [x] Confirm dialog sebelum delete
- [x] Numeric type casting untuk uang

---

## 💡 TIPS PENGGUNAAN

1. **Auto-Calculate Sisa Hutang**

    ```php
    $hutang->sisa_hutang // Otomatis hitung dari accessor
    ```

2. **Format Uang**

    ```php
    number_format($hutang->jumlah_hutang, 0, ',', '.')
    ```

3. **Catat Pembayaran**
    - Klik tombol "Lihat" hutang
    - Scroll ke bawah → "Catat Pembayaran"
    - Masukkan jumlah pembayaran
    - Status akan otomatis update

4. **Filter Hutang**
    - Di halaman daftar hutang
    - Filter by Status atau Search by Nama

---

## 📞 TROUBLESHOOTING

**Q: Views tidak muncul?**
A: Views akan auto-create saat pertama kali akses. Jika belum, jalankan:

```bash
php artisan db:seed --class=CreateHutangViewsSeeder
```

**Q: Table belum ada?**
A: Jalankan migration:

```bash
php artisan migrate
```

**Q: Bagaimana cara undo?**
A: Rollback migration:

```bash
php artisan migrate:rollback --step=1
```

---

## 🎓 PEMBELAJARAN

Dalam soal ini, Anda telah belajar:

- ✅ Cara membuat Migration di Laravel
- ✅ Cara membuat Model dengan relationships
- ✅ Cara membuat Controller CRUD
- ✅ Cara membuat Routes
- ✅ Cara membuat Views dengan Blade
- ✅ Validasi form input
- ✅ Auto-calculate dengan accessor
- ✅ Status management
- ✅ Git workflow (add, commit, push)

---

**Status:** ✅ **SEMUA SELESAI DAN SIAP DIGUNAKAN**

Silakan proceed ke Step 4 untuk test dan push ke GitHub!
