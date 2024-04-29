### Cara instalasi project ini

## Persiapan

1. pastikan sudah install mysql (bisa pakai XAMPP)
2. project ini menggunkan php version min. 8.1
3. pastikan sudah menginstall nodeJS (jika belum bisa download dan instal di link ini [NodeJS](https://nodejs.org/en). Pilih yang LTS aja)
4. pastikan juga sudah install composer

jika udah semua lanjut ke tahap selanjutnya.

## Instalasi (proses ini hanya sekali saja)

1. buka Visual Studio code lalu pilih `source code` (di sebelak kiri)
2. kemudian pilih `clone repository`
3. kemudian copy link ini

```
https://github.com/jaffrantirta/project-ta-suci-cashier.git
```

4. dan `paste` di vs code itu dan enter
5. lalu pilih lokasi project dan selesaikan prosesnya dan buat database di mysql dengan nama `ta_suci_cashier`
6. kemudian setelah semua sudah selesai, buka peoject nya
7. lalu tekan `ctr` + `shift` + `~` agar terbuka `terminal``
8. lalu pada terminal ketik

```
composer update
```

9. kemudian

```
cp .env.example .env
```

```
php artisan migrate
```

10. kemudian setting role/jabatan seperti owner, cashier dan operation dengan cara jalankan

```
php artisan persiapan-sistem
```

11. lanjut sinkronasi hak akses role/jabatan (jika command dibawah error coba ulangi command diatas dan coba lagi command di bawah)

```
php artisan peddos-permission-role:sync
```

12. kemudian buat akun untuk owner sebagai super admin

```
php artisan buat:owner
```

13. setelah selessai sekarang install tampilannya dengan cara

```
npm i
```

14. terakhir

```
php artisan generate:key
```

14. setelah berhasil tanpa error program sudah bisa dijalankan

## Cara jalankan sistem

1. buka project di vscode (rekomendasi) atau di mana pun editor nya
2. jika di vscode buka `terminal` di vscode dengan cara diatas
3. kemudian jalankan laravel dengan cara

```
php artisan serve
```

4. kemudian buka `terminal` baru (jangan tutup terminal laravel nya)
5. lalu jalankan tampilannya

```
npm run dev
```

dan sistem sudah berjalan bisa dilihat di browser dengan link [ini](http://127.0.0.1:8000/home)

## Selesai

instalasi nya memang agak ribet untuk pemula dan kalo ada yang masih bingung jangan ragu untuk hubungi saya :)
