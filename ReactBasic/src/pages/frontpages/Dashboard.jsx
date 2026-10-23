
import { Link } from "react-router-dom";
import ProductCard from "../../components/ProductCard";
import { products } from "../../utils/data";

export default function Dashboard() {
  const featuredProducts = products.slice(0, 4);

  return (
    <div className="mx-auto max-w-7xl space-y-8 pb-8 sm:space-y-10">

      {/* HERO PROMO */}
      <section className="relative overflow-hidden rounded-3xl bg-gradient-to-r from-[#F8D7E2] via-[#FCE7EF] to-[#FFF5F8] px-6 py-10 shadow-sm sm:px-10 md:py-14 lg:px-12">
        <div className="relative z-10 max-w-2xl">
          <p className="mb-3 text-xs font-bold uppercase tracking-[0.2em] text-[#A84D70] sm:text-sm">
            KiaBeauty Special
          </p>

          <h1 className="text-3xl font-bold leading-tight text-[#2B2024] sm:text-4xl md:text-5xl">
            Spesial Akhir Bulan
            <span className="mt-2 block text-[#A84D70]">
              Diskon 15%
            </span>
          </h1>

          <p className="mt-4 max-w-xl text-sm leading-6 text-[#6B555D] sm:text-base">
            Saatnya manjakan dirimu! Temukan makeup dan skincare
            favoritmu dengan penawaran spesial dari KiaBeauty.
          </p>

          <p className="mt-2 text-xs text-[#8B6875]">
            Promo simulasi untuk demonstrasi aplikasi.
          </p>

          <Link
            to="/produk"
            className="mt-6 inline-flex items-center rounded-xl bg-[#A84D70] px-6 py-3 text-sm font-semibold text-white shadow-md transition hover:bg-[#8F3F60]"
          >
            Belanja Sekarang →
          </Link>
        </div>

        {/* Dekorasi */}
        <div className="pointer-events-none absolute -right-16 -top-16 h-64 w-64 rounded-full bg-white/40" />
        <div className="pointer-events-none absolute -bottom-24 right-10 h-48 w-48 rounded-full bg-[#E9AFC2]/30 sm:right-24 sm:h-56 sm:w-56" />
      </section>

      {/* KATEGORI CEPAT */}
      <section className="grid grid-cols-4 gap-2 rounded-2xl border border-pink-100 bg-[#FFF8FA] p-3 sm:gap-4 sm:p-5">
        <Link
          to="/produk?category=Makeup"
          className="group flex flex-col items-center gap-2 rounded-xl p-2 text-center transition hover:bg-white"
        >
          <span className="flex h-12 w-12 items-center justify-center rounded-2xl bg-[#FCE7EF] text-2xl transition group-hover:scale-105">
            ✨
          </span>
          <span className="text-xs font-medium text-[#4B3A40] sm:text-sm">
            Makeup
          </span>
        </Link>

        <Link
          to="/produk?category=Skincare"
          className="group flex flex-col items-center gap-2 rounded-xl p-2 text-center transition hover:bg-white"
        >
          <span className="flex h-12 w-12 items-center justify-center rounded-2xl bg-[#FCE7EF] text-2xl transition group-hover:scale-105">
            💧
          </span>
          <span className="text-xs font-medium text-[#4B3A40] sm:text-sm">
            Skincare
          </span>
        </Link>

        <Link
          to="/produk"
          className="group flex flex-col items-center gap-2 rounded-xl p-2 text-center transition hover:bg-white"
        >
          <span className="flex h-12 w-12 items-center justify-center rounded-2xl bg-[#FCE7EF] text-2xl transition group-hover:scale-105">
            🏷️
          </span>
          <span className="text-xs font-medium text-[#4B3A40] sm:text-sm">
            Promo
          </span>
        </Link>

        <Link
          to="/chat"
          className="group flex flex-col items-center gap-2 rounded-xl p-2 text-center transition hover:bg-white"
        >
          <span className="flex h-12 w-12 items-center justify-center rounded-2xl bg-[#FCE7EF] text-2xl transition group-hover:scale-105">
            💬
          </span>
          <span className="text-xs font-medium text-[#4B3A40] sm:text-sm">
            Bantuan
          </span>
        </Link>
      </section>

      {/* PRODUK PILIHAN */}
      <section>
        <div className="mb-5 flex items-end justify-between gap-3">
          <div>
            <p className="text-xs font-semibold uppercase tracking-widest text-[#A84D70]">
              Pilihan untukmu
            </p>

            <h2 className="mt-1 text-xl font-bold text-[#2B2024] sm:text-2xl">
              Produk Pilihan
            </h2>

            <p className="mt-1 text-sm text-gray-500">
              Temukan produk kecantikan favoritmu.
            </p>
          </div>

          <Link
            to="/produk"
            className="shrink-0 text-sm font-semibold text-[#A84D70] hover:underline"
          >
            Lihat Semua →
          </Link>
        </div>

        {featuredProducts.length > 0 ? (
          <div className="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
            {featuredProducts.map((product) => (
              <ProductCard key={product.id} p={product} />
            ))}
          </div>
        ) : (
          <div className="rounded-2xl border border-dashed border-pink-200 bg-[#FFF8FA] py-12 text-center">
            <p className="text-sm text-gray-500">
              Belum ada produk yang tersedia.
            </p>
          </div>
        )}
      </section>

      {/* PROMO INFORMASI */}
      <section className="flex flex-col justify-between gap-4 rounded-2xl border border-pink-100 bg-[#FFF1F5] p-5 sm:flex-row sm:items-center sm:p-7">
        <div>
          <p className="text-xs font-bold uppercase tracking-widest text-[#A84D70]">
            Beauty Made Simple
          </p>

          <h2 className="mt-2 text-lg font-bold text-[#2B2024] sm:text-xl">
            Temukan rutinitas kecantikanmu
          </h2>

          <p className="mt-1 text-sm text-[#6B555D]">
            Jelajahi pilihan makeup dan skincare dalam satu tempat.
          </p>
        </div>

        <Link
          to="/produk"
          className="inline-flex shrink-0 items-center justify-center rounded-xl border border-[#D98FA7] bg-white px-5 py-3 text-sm font-semibold text-[#A84D70] transition hover:bg-[#FCE7EF]"
        >
          Jelajahi Produk →
        </Link>
      </section>

    </div>
  );
}
