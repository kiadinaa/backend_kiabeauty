import { useState } from "react";
import { Link, useLocation } from "react-router-dom";
import { useCart } from "../../utils/CartContext";

export default function ProductDetail() {
  const location = useLocation();
  const p = location.state;

  const { addToCart } = useCart();

  const [rating, setRating] = useState(0);
  const [review, setReview] = useState("");
  const [reviews, setReviews] = useState([]);
  const [quantity, setQuantity] = useState(1);

  // Jika produk tidak ditemukan
  if (!p) {
    return (
      <div className="flex min-h-[60vh] items-center justify-center">
        <div className="text-center">
          <div className="text-5xl">😕</div>

          <h1 className="mt-4 text-2xl font-bold text-[#2B2024]">
            Produk tidak ditemukan
          </h1>

          <Link
            to="/"
            className="mt-5 inline-block rounded-xl bg-[#A84D70] px-6 py-3 text-sm font-semibold text-white"
          >
            Kembali ke Home
          </Link>
        </div>
      </div>
    );
  }

  const formatPrice = (price) => {
    return new Intl.NumberFormat("id-ID", {
      style: "currency",
      currency: "IDR",
      maximumFractionDigits: 0,
    }).format(price);
  };

  const handleSubmit = (e) => {
    e.preventDefault();

    if (!rating || !review.trim()) {
      alert("Silakan berikan rating dan review terlebih dahulu.");
      return;
    }

    const newReview = {
      id: Date.now(),
      rating,
      review,
    };

    setReviews([...reviews, newReview]);
    setRating(0);
    setReview("");
  };

  const handleAddToCart = () => {
    for (let i = 0; i < quantity; i++) {
      addToCart(p);
    }

    alert(`${p.name} berhasil ditambahkan ke keranjang!`);
  };

  return (
    <div className="mx-auto max-w-6xl space-y-8">

      {/* BREADCRUMB */}
      <div className="text-sm text-gray-500">
        <Link to="/" className="hover:text-[#A84D70]">
          Home
        </Link>

        <span className="mx-2">/</span>

        <span>{p.category_name}</span>

        <span className="mx-2">/</span>

        <span className="text-[#A84D70]">{p.name}</span>
      </div>

      {/* PRODUCT DETAIL */}
      <section className="grid gap-8 lg:grid-cols-2">

        {/* IMAGE */}
        <div className="flex min-h-[500px] items-center justify-center rounded-3xl bg-[#FFF8FA] p-10">

          <img
            src={p.img}
            alt={p.name}
            className="max-h-[450px] w-full object-contain"
          />

        </div>

        {/* INFO */}
        <div className="flex flex-col justify-center">

          {/* BRAND */}
          <p className="text-sm font-bold uppercase tracking-[0.2em] text-[#A84D70]">
            {p.brand}
          </p>

          {/* NAME */}
          <h1 className="mt-2 text-3xl font-bold leading-tight text-[#2B2024] md:text-4xl">
            {p.name}
          </h1>

          {/* RATING */}
          <div className="mt-4 flex items-center gap-3">

            <div className="text-lg text-yellow-500">
              ★★★★★
            </div>

            <span className="text-sm text-gray-500">
              {p.rating} / 5
            </span>

          </div>

          {/* PRICE */}
          <p className="mt-6 text-3xl font-bold text-[#A84D70]">
            {formatPrice(p.price)}
          </p>

          {/* STOCK */}
          <div className="mt-3">

            {p.stock > 5 ? (
              <span className="text-sm font-medium text-green-600">
                ✓ Stok tersedia ({p.stock} produk)
              </span>
            ) : p.stock > 0 ? (
              <span className="text-sm font-semibold text-orange-500">
                ⚠ Stok terbatas — tersisa {p.stock} produk
              </span>
            ) : (
              <span className="text-sm font-semibold text-red-500">
                ✕ Produk habis
              </span>
            )}

          </div>

          {/* DESCRIPTION */}
          <div className="mt-6 border-t border-gray-100 pt-6">

            <h2 className="font-bold text-[#2B2024]">
              Tentang Produk
            </h2>

            <p className="mt-2 text-sm leading-7 text-gray-500">
              {p.name} dari {p.brand} merupakan salah satu pilihan
              produk {p.category_name.toLowerCase()} yang tersedia
              di KiaBeauty. Temukan produk beauty favoritmu dengan
              mudah melalui KiaBeauty.
            </p>

          </div>

          {/* QUANTITY */}
          <div className="mt-6 flex items-center gap-4">

            <span className="text-sm font-semibold text-gray-600">
              Jumlah
            </span>

            <div className="flex items-center overflow-hidden rounded-xl border border-gray-200">

              <button
                onClick={() =>
                  setQuantity((q) => Math.max(1, q - 1))
                }
                className="px-4 py-2 text-lg hover:bg-gray-50"
              >
                −
              </button>

              <span className="min-w-[45px] text-center font-semibold">
                {quantity}
              </span>

              <button
                onClick={() =>
                  setQuantity((q) =>
                    Math.min(p.stock || 1, q + 1)
                  )
                }
                className="px-4 py-2 text-lg hover:bg-gray-50"
              >
                +
              </button>

            </div>

          </div>

          {/* ADD TO CART */}
          <button
            disabled={p.stock <= 0}
            onClick={handleAddToCart}
            className={`mt-6 w-full rounded-xl px-6 py-4 font-semibold text-white shadow-md transition ${
              p.stock <= 0
                ? "cursor-not-allowed bg-gray-300"
                : "bg-[#A84D70] hover:bg-[#8F3F60]"
            }`}
          >
            {p.stock <= 0
              ? "Produk Habis"
              : "🛍️ Tambah ke Keranjang"}
          </button>

        </div>
      </section>

      {/* REVIEWS */}
      <section className="grid gap-6 lg:grid-cols-2">

        {/* REVIEW LIST */}
        <div className="rounded-2xl border border-pink-100 bg-white p-6 shadow-sm">

          <h2 className="text-xl font-bold text-[#2B2024]">
            Customer Reviews
          </h2>

          <p className="mt-1 text-sm text-gray-500">
            Bagikan pengalamanmu menggunakan produk ini.
          </p>

          <div className="mt-6">

            {reviews.length === 0 ? (
              <div className="rounded-xl bg-[#FFF8FA] p-6 text-center">

                <div className="text-3xl">💬</div>

                <p className="mt-2 text-sm text-gray-500">
                  Belum ada review.
                </p>

                <p className="text-xs text-gray-400">
                  Jadilah orang pertama yang memberikan review.
                </p>

              </div>
            ) : (
              <div className="space-y-4">

                {reviews.map((r) => (
                  <div
                    key={r.id}
                    className="rounded-xl border border-gray-100 p-4"
                  >

                    <div className="text-yellow-500">
                      {"★".repeat(r.rating)}
                      <span className="text-gray-300">
                        {"★".repeat(5 - r.rating)}
                      </span>
                    </div>

                    <p className="mt-2 text-sm leading-6 text-gray-600">
                      {r.review}
                    </p>

                  </div>
                ))}

              </div>
            )}

          </div>
        </div>

        {/* REVIEW FORM */}
        <div className="rounded-2xl border border-pink-100 bg-white p-6 shadow-sm">

          <h2 className="text-xl font-bold text-[#2B2024]">
            Tulis Review
          </h2>

          <form
            onSubmit={handleSubmit}
            className="mt-6"
          >

            {/* RATING */}
            <label className="text-sm font-semibold text-gray-700">
              Rating
            </label>

            <div className="mt-2 flex gap-2">

              {[1, 2, 3, 4, 5].map((star) => (
                <button
                  type="button"
                  key={star}
                  onClick={() => setRating(star)}
                  className={`text-3xl transition ${
                    star <= rating
                      ? "text-yellow-500"
                      : "text-gray-300"
                  }`}
                >
                  ★
                </button>
              ))}

            </div>

            {/* REVIEW */}
            <label className="mt-5 block text-sm font-semibold text-gray-700">
              Review
            </label>

            <textarea
              value={review}
              onChange={(e) => setReview(e.target.value)}
              className="mt-2 w-full rounded-xl border border-gray-200 p-3 text-sm outline-none transition focus:border-[#D98BA7] focus:ring-2 focus:ring-[#F8D7E2]"
              rows="5"
              placeholder="Tulis pengalaman kamu menggunakan produk ini..."
            />

            {/* SUBMIT */}
            <button
              type="submit"
              className="mt-4 rounded-xl bg-[#A84D70] px-6 py-3 text-sm font-semibold text-white transition hover:bg-[#8F3F60]"
            >
              Kirim Review
            </button>

          </form>
        </div>

      </section>

    </div>
  );
}