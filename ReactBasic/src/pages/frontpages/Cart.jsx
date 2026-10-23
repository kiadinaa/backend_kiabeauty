import { useCart } from "../../utils/CartContext";

export default function Cart() {
  const { cart, updateQty, removeFromCart } = useCart();

  const formatPrice = (price) => {
    return new Intl.NumberFormat("id-ID", {
      style: "currency",
      currency: "IDR",
      maximumFractionDigits: 0,
    }).format(price);
  };

  const totalItems = cart.reduce((total, item) => {
    return total + item.qty;
  }, 0);

  const subtotal = cart.reduce((total, item) => {
    return total + item.price * item.qty;
  }, 0);

  // EMPTY CART
  if (cart.length === 0) {
    return (
      <div className="flex min-h-[60vh] items-center justify-center">
        <div className="text-center">

          <div className="text-6xl">🛍️</div>

          <h1 className="mt-5 text-2xl font-bold text-[#2B2024]">
            Keranjangmu masih kosong
          </h1>

          <p className="mt-2 text-sm text-gray-500">
            Yuk temukan produk beauty favoritmu!
          </p>

          <a
            href="/"
            className="mt-6 inline-block rounded-xl bg-[#A84D70] px-6 py-3 text-sm font-semibold text-white transition hover:bg-[#8F3F60]"
          >
            Mulai Belanja
          </a>

        </div>
      </div>
    );
  }

  return (
    <div className="mx-auto max-w-6xl space-y-6">

      {/* HEADER */}
      <div>
        <p className="text-sm font-semibold uppercase tracking-widest text-[#A84D70]">
          KiaBeauty Shopping Bag
        </p>

        <h1 className="mt-1 text-3xl font-bold text-[#2B2024]">
          Keranjang Belanja
        </h1>

        <p className="mt-1 text-sm text-gray-500">
          {totalItems} produk ada di keranjangmu.
        </p>
      </div>

      <div className="grid gap-6 lg:grid-cols-3">

        {/* CART ITEMS */}
        <div className="space-y-4 lg:col-span-2">

          {cart.map((item) => (
            <div
              key={item.id}
              className="rounded-2xl border border-pink-100 bg-white p-4 shadow-sm transition hover:shadow-md"
            >

              <div className="flex flex-col gap-4 sm:flex-row sm:items-center">

                {/* IMAGE */}
                <div className="flex h-28 w-28 shrink-0 items-center justify-center rounded-xl bg-[#FFF8FA] p-3">
                  <img
                    src={item.img}
                    alt={item.name}
                    className="h-full w-full object-contain"
                  />
                </div>

                {/* INFO */}
                <div className="flex-1">

                  <p className="text-xs font-bold uppercase tracking-widest text-[#A84D70]">
                    {item.brand}
                  </p>

                  <h2 className="mt-1 text-lg font-semibold text-[#2B2024]">
                    {item.name}
                  </h2>

                  <p className="mt-2 text-base font-bold text-[#A84D70]">
                    {formatPrice(item.price)}
                  </p>

                  {/* QUANTITY */}
                  <div className="mt-3 flex items-center gap-3">

                    <span className="text-sm text-gray-500">
                      Jumlah:
                    </span>

                    <input
                      type="number"
                      value={item.qty}
                      min="1"
                      onChange={(e) =>
                        updateQty(
                          item.id,
                          Math.max(
                            1,
                            parseInt(e.target.value) || 1
                          )
                        )
                      }
                      className="w-20 rounded-lg border border-gray-200 px-3 py-2 text-center text-sm outline-none focus:border-[#D98BA7] focus:ring-2 focus:ring-[#F8D7E2]"
                    />

                  </div>
                </div>

                {/* RIGHT SIDE */}
                <div className="flex items-center justify-between gap-4 sm:flex-col sm:items-end">

                  <p className="text-lg font-bold text-[#2B2024]">
                    {formatPrice(item.price * item.qty)}
                  </p>

                  <button
                    onClick={() => removeFromCart(item.id)}
                    className="rounded-lg px-3 py-2 text-sm font-semibold text-red-500 transition hover:bg-red-50"
                  >
                    🗑 Hapus
                  </button>

                </div>

              </div>
            </div>
          ))}

        </div>

        {/* SUMMARY */}
        <div className="h-fit rounded-2xl border border-pink-100 bg-white p-6 shadow-sm">

          <h2 className="text-xl font-bold text-[#2B2024]">
            Ringkasan Pesanan
          </h2>

          <div className="mt-6 space-y-4 text-sm">

            <div className="flex justify-between">
              <span className="text-gray-500">
                Total Produk
              </span>

              <span className="font-semibold">
                {totalItems}
              </span>
            </div>

            <div className="flex justify-between">
              <span className="text-gray-500">
                Subtotal
              </span>

              <span className="font-semibold">
                {formatPrice(subtotal)}
              </span>
            </div>

            <div className="flex justify-between">
              <span className="text-gray-500">
                Pengiriman
              </span>

              <span className="font-semibold text-green-600">
                GRATIS
              </span>
            </div>

            <div className="border-t border-gray-100 pt-4">
              <div className="flex justify-between">
                <span className="font-bold text-[#2B2024]">
                  Total
                </span>

                <span className="text-xl font-bold text-[#A84D70]">
                  {formatPrice(subtotal)}
                </span>
              </div>
            </div>

          </div>

          <button
            onClick={() =>
              alert("Checkout KiaBeauty akan segera tersedia! 💕")
            }
            className="mt-6 w-full rounded-xl bg-[#A84D70] px-5 py-3 font-semibold text-white shadow-md transition hover:bg-[#8F3F60]"
          >
            Checkout →
          </button>

          <p className="mt-3 text-center text-xs text-gray-400">
            Secure & easy shopping with KiaBeauty
          </p>

        </div>

      </div>
    </div>
  );
}