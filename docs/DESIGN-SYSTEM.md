# DESIGN SYSTEM — WEBSITE KEDAI KOPI IRAMA SANTRI

**Versi:** 1.0  
**Status:** Disetujui untuk implementasi frontend  
**Berdasarkan:** `BRIEF.md`, `PRD.md`, dan `ARCHITECTURE.md` 1.1  
**Terakhir diperbarui:** 3 November 2026

---

## 1. Arah Desain

**Konsep:** Warm & Cozy Modern Coffee Shop.

Karakter yang dijaga:

- hangat dan nyaman;
- modern dan bersih;
- ramah dan inklusif;
- terasa sebagai community space;
- menampilkan suasana kedai secara autentik.

Desain tidak boleh terasa seperti kafe mewah yang eksklusif, korporat, atau generik. Prioritasnya adalah keterbacaan, ruang napas, dan kesan mengundang.

---

## 2. Prinsip

1. **Konten dahulu.** Layout melayani informasi menu, fasilitas, dan lokasi.
2. **Satu fokus per layar.** Setiap section memiliki satu pesan utama.
3. **Hangat, bukan ramai.** Warna bumi, foto besar, dan ruang kosong yang cukup.
4. **Mobile setara desktop.** Tidak ada fitur yang hanya dapat diakses di desktop.
5. **Aksesibel sejak awal.** Target WCAG 2.1 AA.
6. **Ringan.** Tidak ada font eksternal, slider, atau library UI besar.

---

## 3. Palet Warna

| Token | Hex | Penggunaan |
|---|---|---|
| `cream-50` | `#FBF8F2` | Latar utama |
| `cream-100` | `#F4ECDD` | Section alternatif, hover lembut |
| `cream-200` | `#E8D9C2` | Border, pemisah |
| `coffee-500` | `#8A5A3B` | Aksen sekunder, gradien |
| `coffee-700` | `#5A3A28` | Teks sekunder, tombol utama |
| `coffee-900` | `#2E1C13` | Judul dan teks utama |
| `accent-500` | `#C08A5A` | Aksen hangat, seleksi |
| `accent-600` | `#A86F42` | Badge featured, garis fokus |
| `accent-700` | `#86562F` | Tautan dan eyebrow |
| `sage-100` | `#E4EBDD` | Latar badge tersedia |
| `sage-700` | `#3F5A38` | Teks badge tersedia |

Aturan:

- Teks utama memakai `coffee-900`; teks pendukung `coffee-700`.
- Jangan memakai warna sebagai satu-satunya penanda status.
- Kontras teks terhadap latar minimal 4.5:1 untuk teks normal.
- Warna aksen tidak dipakai untuk blok teks panjang.

---

## 4. Tipografi

| Peran | Font | Ukuran |
|---|---|---|
| Display / H1 | Georgia, serif | 2.25–3.5 rem |
| H2 | Georgia, serif | 1.75–2.25 rem |
| H3 | Georgia, serif | 1.25–1.5 rem |
| Body | System sans-serif | 1 rem / 1.75 |
| Small | System sans-serif | 0.875 rem |
| Eyebrow | System sans-serif | 0.75 rem, uppercase, tracking lebar |

Alasan:

- Font sistem menghindari request eksternal dan layout shift.
- Georgia memberi karakter editorial yang hangat tanpa biaya performa.
- Font merek final dapat menggantikan token `--font-display` setelah tersedia.

Aturan:

- Maksimal satu H1 per halaman.
- Jangan melompati level heading.
- Panjang baris teks 60–75 karakter.
- Jangan memakai huruf kapital untuk paragraf panjang.

---

## 5. Spacing dan Layout

- Basis spacing: 4 px (skala Tailwind).
- Container maksimal: `72rem` (1152 px).
- Gutter: 16 px mobile, 24 px tablet, 32 px desktop.
- Jarak antar-section: 64–96 px.
- Lebar konten teks: maksimal `42rem`.

Breakpoint mengikuti Tailwind:

| Nama | Lebar |
|---|---|
| `sm` | 640 px |
| `md` | 768 px |
| `lg` | 1024 px |
| `xl` | 1280 px |

---

## 6. Radius, Border, dan Shadow

| Elemen | Nilai |
|---|---|
| Tombol | Pill (`9999px`) |
| Card | `1.25rem` |
| Gambar hero | `1.5rem` |
| Badge | Pill |
| Border | 1 px `cream-200` |
| Shadow | `0 18px 40px -24px rgba(46,28,19,0.35)` |

Shadow dipakai hemat, hanya untuk card dan elemen yang perlu terangkat.

---

## 7. Komponen

### 7.1 Tombol

| Varian | Penggunaan |
|---|---|
| Primary | Aksi utama: Lihat Menu |
| Secondary | Aksi pendukung: Kunjungi Kedai |
| Light | Aksi di atas latar gelap |

Aturan:

- Tinggi minimum 44 px.
- Fokus terlihat jelas.
- Teks singkat, 2–4 kata.
- Jangan memakai tombol untuk navigasi yang sudah ada di menu.

### 7.2 Card Produk

- Rasio gambar 1:1.
- Nama produk menjadi tautan.
- Kategori, harga, dan status terlihat tanpa hover.
- Badge featured dan tidak tersedia memakai teks, bukan warna saja.
- Seluruh card tidak harus dapat diklik; hanya judul dan gambar.

### 7.3 Badge

- `Featured` — latar `accent-600`, teks putih.
- `Tidak tersedia` — latar `coffee-900/10`, teks `coffee-700`.
- Badge tidak boleh menutupi informasi penting.

### 7.4 Navigasi

- Sticky di atas dengan latar semi-transparan.
- Item aktif memiliki indikator visual.
- Mobile memakai tombol toggle dengan `aria-expanded`.
- Menu dapat dioperasikan dengan keyboard.

### 7.5 Form Admin

- Label selalu terlihat.
- Pesan bantuan di bawah field.
- Pesan error di dekat field.
- Tidak mengandalkan placeholder sebagai label.

---

## 8. Gambar

| Jenis | Rasio | Ukuran |
|---|---|---|
| Hero | 4:3 | 1200 px+ |
| Foto produk | 1:1 | 600 px |
| Foto fasilitas | 3:2 | 800 px |
| Galeri | 1:1 | 480 px |

Aturan:

- Gunakan `alt` deskriptif untuk gambar informatif.
- `alt=""` untuk gambar dekoratif.
- Lazy loading untuk gambar di bawah fold.
- Sertakan `width`/`height` melalui WordPress attachment metadata.
- Jangan meregangkan gambar.

---

## 9. Motion

- Durasi 150–300 ms.
- Hanya untuk hover, fokus, dan transisi state.
- Tidak ada animasi otomatis yang mengganggu.
- Hormati `prefers-reduced-motion`.

---

## 10. Aksesibilitas

- Skip link ke konten utama.
- Fokus terlihat pada semua elemen interaktif.
- Kontras minimum 4.5:1.
- Target sentuh minimum 44 × 44 px.
- Status tidak disampaikan hanya dengan warna.
- Heading berurutan.
- Tabel varian memiliki header.
- Gambar memiliki alt text.
- Bahasa halaman: `id-ID`.

---

## 11. Nada Konten

- Hangat, mengundang, tidak berlebihan.
- Kalimat pendek dan konkret.
- Hindari klaim yang tidak dapat dibuktikan.
- Gunakan Bahasa Indonesia.
- Sebut lokasi sebagai Cirebon, bukan nama kota lain.
- Jangan menampilkan harga fiktif; gunakan "Harga belum tersedia" bila kosong.

---

## 12. Token Tailwind

Token didefinisikan di `wp-content/themes/irama-santri-theme/src/css/app.css` melalui `@theme`.

| Token | Nilai |
|---|---|
| `--color-cream-50` | `#FBF8F2` |
| `--color-cream-100` | `#F4ECDD` |
| `--color-cream-200` | `#E8D9C2` |
| `--color-coffee-500` | `#8A5A3B` |
| `--color-coffee-700` | `#5A3A28` |
| `--color-coffee-900` | `#2E1C13` |
| `--color-accent-500` | `#C08A5A` |
| `--color-accent-600` | `#A86F42` |
| `--color-accent-700` | `#86562F` |
| `--color-sage-100` | `#E4EBDD` |
| `--color-sage-700` | `#3F5A38` |
| `--font-sans` | System UI stack |
| `--font-display` | Georgia, serif |
| `--shadow-soft` | Shadow card |
| `--radius-card` | `1.25rem` |

---

## 13. Yang Belum Final

1. Logo final dan clear space.
2. Font merek berlisensi.
3. Foto interior, produk, dan fasilitas.
4. Tagline resmi.
5. Ilustrasi atau pattern merek.
6. Panduan tone of voice yang lebih rinci.

**Status: disetujui untuk implementasi. Perubahan token dan komponen wajib diperbarui di dokumen ini.**
