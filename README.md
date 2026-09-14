# Sistem Katering Nusantara (Advanced Eager Loading)

**Nama:** Salman
**Kelas:** XI 1

## Deskripsi

Sistem Katering Nusantara adalah proyek berbasis Laravel yang mensimulasikan sistem pengelolaan katering dengan **7 tabel yang memiliki relasi kompleks**.

Proyek ini dibuat untuk mendemonstrasikan penyelesaian **N+1 Query Problem** menggunakan teknik **Eager Loading** dan **Nested Eager Loading**.

Dengan optimasi tersebut, pengambilan data relasi menjadi lebih efisien dan jumlah query database dapat dikurangi secara signifikan.

## Teknologi yang Digunakan

* Laravel
* PHP
* MySQL
* Eloquent ORM
* Eager Loading
* Nested Eager Loading




## Hasil Optimasi

| Metode               | Hasil                                         |
| -------------------- | --------------------------------------------- |
| Lazy Loading         | Menghasilkan banyak query / N+1 Query Problem |
| Eager Loading        | Jumlah query lebih sedikit                    |
| Nested Eager Loading | Query relasi kompleks lebih efisien           |

Dengan menerapkan **Nested Eager Loading**, jumlah query berhasil ditekan menjadi **di bawah 10 query**.

## Kesimpulan

Masalah **N+1 Query Problem** dapat menyebabkan aplikasi melakukan query database secara berulang, terutama ketika jumlah data semakin banyak.

Penggunaan **Eager Loading** dan **Nested Eager Loading** membantu mengambil data relasi secara lebih efisien sehingga dapat mengurangi jumlah query dan meningkatkan performa aplikasi.

---

**Project:** Sistem Katering Nusantara
**Topik:** Advanced Eager Loading & N+1 Query Optimization
