import { Link } from "react-router-dom";
import { useCart } from "../utils/CartContext";

export default function ProductCard({ p }) {
  const { addToCart } = useCart();

  const isOutOfStock = p.stock <= 0;
  const isLowStock = p.stock > 0 && p.stock <= 5;

  const formatPrice = (price) => {
    return new Intl.NumberFormat("id-ID", {
      style: "currency",
      currency: "IDR",
      maximumFractionDigits: 0,
    }).format(price);
  };

  return (
    <div className="group overflow-hidden rounded-2xl border border-pink-100 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl">

      {/* IMAGE */}
      <div className="relative flex h-64 items-center justify-center overflow-hidden bg-[#FFF8FA] p-5">

        {/* Category Badge */}
        <span className="absolute left-3 top-3 z-10 rounded-full bg-white px-3 py-1 text-xs font-semibold text-[#A84D70] shadow-sm">
          {p.category_name}
        </span>

        {/* Stock Badge */}
        {isLowStock && (
          <span className="absolute right-3 top-3 z-10 rounded-full bg-[#FDE68A] px-3 py-1 text-xs font-semibold text-[#92400E]">
            Stok Terbatas
          </span>
        )}

        {isOutOfStock && (
          <span className="absolute right-3 top-3 z-10 rounded-full bg-gray-800 px-3 py-1 text-xs font-semibold text-white">
            Habis
          </span>
        )}

        <img
          src={p.img}
          alt={p.name}
          className="h-full w-full object-contain transition duration-500 group-hover:scale-105"
        />
      </div>

      {/* PRODUCT INFO */}
      <div className="p-5">

        {/* BRAND */}
        <p className="mb-1 text-xs font-bold uppercase tracking-widest text-[#A84D70]">
          {p.brand}
        </p>

        {/* PRODUCT NAME */}
        <h2 className="min-h-[48px] text-base font-semibold leading-6 text-[#2B2024]">
          {p.name}
        </h2>

        {/* RATING */}
        <div className="mt-3 flex items-center gap-2">
          <span className="text-sm text-yellow-500">
            ★★★★★
          </span>

          <span className="text-xs text-gray-500">
            {p.rating}
          </span>
        </div>

        {/* PRICE */}
        <p className="mt-3 text-xl font-bold text-[#A84D70]">
          {formatPrice(p.price)}
        </p>

        {/* STOCK */}
        <p className="mt-1 text-xs text-gray-500">
          {isOutOfStock
            ? "Produk sedang tidak tersedia"
            : `${p.stock} produk tersisa`}
        </p>

        {/* ACTION */}
        <div className="mt-4 flex gap-2">

          <Link
            to={`/product/${p.slug}`}
            state={p}
            className="flex flex-1 items-center justify-center rounded-xl border border-[#D98BA7] px-3 py-2.5 text-sm font-semibold text-[#A84D70] transition hover:bg-[#FFF1F5]"
          >
            Lihat Detail
          </Link>

          <button
            disabled={isOutOfStock}
            onClick={() => addToCart(p)}
            className={`rounded-xl px-4 py-2.5 text-sm font-semibold text-white transition ${
              isOutOfStock
                ? "cursor-not-allowed bg-gray-300"
                : "bg-[#A84D70] hover:bg-[#8F3F60]"
            }`}
          >
            {isOutOfStock ? "Habis" : "🛍️"}
          </button>

        </div>
      </div>
    </div>
  );
}