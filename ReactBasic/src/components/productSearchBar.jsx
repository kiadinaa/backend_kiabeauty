import { Link } from "react-router-dom";
import { useCart } from "../utils/CartContext";

export default function ProductCard({ p }) {
  const { addToCart } = useCart();

  const formatPrice = (price) => {
    return new Intl.NumberFormat("id-ID", {
      style: "currency",
      currency: "IDR",
      maximumFractionDigits: 0,
    }).format(price);
  };

  return (
    <div className="group overflow-hidden rounded-2xl bg-white border border-pink-100 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-xl">
      
      {/* Product Image */}
      <Link to={`/product/${p.slug}`} state={p}>
        <div className="relative aspect-square overflow-hidden bg-[#FFF5F7]">
          <img
            src={p.img}
            alt={p.name}
            className="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105"
          />

          {/* Category Badge */}
          <span className="absolute left-3 top-3 rounded-full bg-white/90 px-3 py-1 text-xs font-medium text-[#A84D70] shadow-sm backdrop-blur">
            {p.category_name}
          </span>

          {/* Stock Badge */}
          {p.stock <= 5 && (
            <span className="absolute right-3 top-3 rounded-full bg-[#A84D70] px-3 py-1 text-xs font-medium text-white">
              Stok Terbatas
            </span>
          )}
        </div>
      </Link>

      {/* Product Information */}
      <div className="p-4">
        
        {/* Rating */}
        <div className="mb-2 flex items-center gap-1 text-sm">
          <span className="text-yellow-500">★</span>
          <span className="font-medium text-gray-700">
            {p.rating}
          </span>
          <span className="text-gray-400">
            · {p.stock} tersedia
          </span>
        </div>

        {/* Product Name */}
        <Link to={`/product/${p.slug}`} state={p}>
          <h2 className="line-clamp-2 min-h-[48px] text-base font-semibold text-[#2B2024] transition-colors hover:text-[#A84D70]">
            {p.name}
          </h2>
        </Link>

        {/* Price */}
        <div className="mt-3">
          <p className="text-lg font-bold text-[#A84D70]">
            {formatPrice(p.price)}
          </p>
        </div>

        {/* Actions */}
        <div className="mt-4 flex gap-2">
          
          <Link
            to={`/product/${p.slug}`}
            state={p}
            className="flex-1 rounded-xl border border-[#D98FA7] px-3 py-2.5 text-center text-sm font-medium text-[#A84D70] transition hover:bg-[#FFF1F5]"
          >
            Lihat Detail
          </Link>

          <button
            onClick={() => addToCart(p)}
            disabled={p.stock <= 0}
            className={`rounded-xl px-4 py-2.5 text-sm font-medium text-white transition ${
              p.stock <= 0
                ? "cursor-not-allowed bg-gray-300"
                : "bg-[#A84D70] hover:bg-[#8F3E5E]"
            }`}
          >
            {p.stock <= 0 ? "Habis" : "+ Keranjang"}
          </button>

        </div>
      </div>
    </div>
  );
}