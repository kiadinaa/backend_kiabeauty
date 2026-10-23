
import { useState } from "react";
import { Link, useNavigate } from "react-router-dom";
import { useCart } from "../utils/CartContext";

export default function Navbar() {
  const { cart } = useCart();
  const [search, setSearch] = useState("");
  const navigate = useNavigate();

  const cartCount = cart.reduce(
    (total, item) => total + item.quantity,
    0
  );

  const handleSearch = (e) => {
    e.preventDefault();
    const keyword = search.trim();

    navigate(
      keyword
        ? `/produk?q=${encodeURIComponent(keyword)}`
        : "/produk"
    );
  };

  return (
    <header className="sticky top-0 z-50 border-b border-pink-100 bg-white shadow-sm">
      <div className="bg-[#A84D70]">
        <div className="mx-auto flex max-w-7xl items-center gap-3 px-4 py-3 sm:gap-5 sm:px-6">
          <Link to="/" className="shrink-0">
            <div className="text-xl font-bold tracking-tight text-white sm:text-2xl">
              KiaBeauty
            </div>
            <div className="text-[9px] tracking-[0.15em] text-pink-100 sm:text-[10px]">
              BEAUTY, MADE SIMPLE
            </div>
          </Link>

          <form
            onSubmit={handleSearch}
            className="flex min-w-0 flex-1 items-center rounded-xl bg-white p-1"
          >
            <span className="px-2 text-lg text-[#A84D70]">⌕</span>
            <input
              type="search"
              value={search}
              onChange={(e) => setSearch(e.target.value)}
              placeholder="Cari makeup, skincare, atau brand..."
              aria-label="Cari produk"
              className="min-w-0 flex-1 bg-transparent py-2 text-xs text-[#2B2024] outline-none placeholder:text-gray-400 sm:text-sm"
            />
            <button
              type="submit"
              className="rounded-lg bg-[#A84D70] px-3 py-2.5 text-xs font-semibold text-white hover:bg-[#8F3E5E] sm:px-5 sm:text-sm"
            >
              Cari
            </button>
          </form>

          {/* Ikon Keranjang */}
          <Link
            to="/cart"
            aria-label="Keranjang"
            title="Keranjang"
            className="relative shrink-0 p-1 text-2xl text-white transition hover:text-pink-100"
          >
            🛒
            {cartCount > 0 && (
              <span className="absolute -right-1 -top-1 flex h-5 min-w-5 items-center justify-center rounded-full bg-white px-1 text-[10px] font-bold text-[#A84D70]">
                {cartCount}
              </span>
            )}
          </Link>

          {/* Ikon Akun */}
          <Link
            to="/login"
            aria-label="Akun"
            title="Akun"
            className="shrink-0 p-1 text-2xl text-white transition hover:text-pink-100"
          >
            👤
          </Link>
        </div>
      </div>
    </header>
  );
}
