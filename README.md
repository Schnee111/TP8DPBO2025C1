# TP8DPBO2025C1

## Janji

*Saya, **Muhammad Daffa Ma'arif** dengan NIM **2305771**, mengerjakan **Tugas Praktikum 8** dalam mata kuliah **DPBO** dengan sebaik-baiknya demi keberkahan-Nya.
Saya berjanji tidak melakukan kecurangan sebagaimana yang telah dispesifikasikan. **Aamiin.***

---

## Deskripsi Program

**TP8DPBO2025C1 - Manajemen Klub** adalah aplikasi berbasis PHP native yang mengimplementasikan pola arsitektur **MVC (Model-View-Controller)** untuk mengelola kegiatan klub di sekolah.

Aplikasi ini terdiri dari 4 modul utama:

* **Siswa**
* **Klub**
* **Anggota Klub**

---

## Fitur

1. **Manajemen Siswa (CRUD)** – Tambah, edit, hapus, dan lihat data siswa.
2. **Manajemen Klub (CRUD)** – Tambah, edit, hapus, dan lihat data Klub.
4. **Manajemen Anggota Klub (CRD)** – Tambah, edit, hapus, dan lihat data keanggotaan siswa dalam Klub.

---

## Struktur Folder

```
project/
│
├── assets/
│   ├── bootstrap.min.css
│   ├── bootstrap.bundle.min.js
│   ├── bootstrap.min.js
│   ├── jquery.min.js
│   └── popper.min.js
│
├── controllers/
│   ├── StudentController.php
│   ├── ClubController.php
│   └── ClubMemberController.php
├── models/
│   ├── DB.class.php
│   ├── Student.class.php
│   ├── Club.class.php
│   └── ClubMember.class.php
│
├── templates/
│   ├── index.html
│   ├── club.html
│   ├── club_member.html
│   └── la.html
│
├── views/
│   ├── Template.class.php
│   ├── TemplateProcessor.class.php
│   ├── Student.view.php
│   ├── Club.view.php
│   └── ClubMember.view.php
│
├── index.php             ← halaman utama (redirect ke siswa)
├── student.php           ← halaman manajemen siswa
├── club.php              ← halaman manajemen klub
├── club_member.php       ← halaman anggota klub
├── connection.php        ← konfigurasi DB
└── conf.php
```

---

## Alur Navigasi Halaman

| Halaman           | Fungsi                                                                                                                                        |
| ----------------- | --------------------------------------------------------------------------------------------------------------------------------------------- |
| `student.php`     | Halaman utama yang menampilkan **form tambah siswa** dan **daftar siswa** dalam tabel. Bisa tambah, edit, dan hapus.                          |
| `club.php`        | Mengelola data **Klub**: tambah klub baru, edit, dan hapus klub.                                                                        |
| `club_member.php` | Menghubungkan **siswa** ke **Klub**. Tampilkan tabel keanggotaan dan bisa **menambah, mengedit, atau menghapus anggota Klub**.                       |

---

## Relasi Tabel MySQL

**Database: `db_student_club`**

<img width="500" src="https://github.com/user-attachments/assets/f527016f-6e7b-43c9-ac1d-bbb7aa658004">


* `students(id, name, nim, phone, join_date)`
* `clubs(id, name, description, founded_date)`
* `club_members(student_id, club_id, role, join_date)`

---

## Komponen Sistem

### Model (`models/`)

* **DB.class.php**
  Kelas dasar untuk koneksi database menggunakan `mysqli`. Semua model lain mewarisi dari kelas ini.

* **Student.class.php**
  Mengelola data siswa.
  Metode: `getStudents()`, `getStudentById()`, `add()`, `update()`, `delete()`

* **Club.class.php**
  Mengelola data klub.
  Metode: `getAll()`, `getById()`, `add()`, `update()`, `delete()`

* **ClubMember.class.php**
  Mengelola relasi siswa dan klub (many-to-many).
  Metode: `getAll()`, `add()`, `update()`, `delete()`

---

### View (`views/`)

* **Template.class.php**
  Engine parser HTML template. Menggunakan `replace()` dan `write()`.

* **TemplateProcessor.class.php**
  Implementasi layout sistem dan handle ekstraksi konten dari template

* **student.view\.php**
  Menampilkan form tambah/edit siswa dan tabel daftar siswa.

* **Club.view\.php**
  Menampilkan form tambah/edit ekskul dan tabel daftar klub.

* **ClubMember.view\.php**
  Menampilkan form tambah/edit tabel anggota klub.

---

### Controller (`controllers/`)

* **Student.controller.php**
  Menangani request data siswa: `index()`, `add()`, `edit()`, `update()`, `delete()`

* **Club.controller.php**
  Menangani request data klub: `index()`, `add()`, `edit()`, `update()`, `delete()`

* **ClubMember.controller.php**
  Menangani request data anggota klub: `index()`, `add()`,  `edit()`, `update()`, `delete()`

---

## Dokumentasi

https://github.com/user-attachments/assets/fbacaad0-9673-4aa5-a62a-c26453dbb1b2

