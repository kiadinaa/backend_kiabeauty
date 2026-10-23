
import { useState } from "react";
import { Link } from "react-router-dom";
import { useCart } from "../../utils/CartContext";

export default function Checkout() {
  const { cart } = useCart();

  const [form, setForm] = useState({
    name: "",
    phone: "",
    address: "",
    payment: "Transfer Bank",
  });

  const [completedOrder, setCompletedOrder] = useState(null);

  const formatPrice = (price) =>
    new Intl.NumberFormat("id-ID", {
      style: "currency",
      currency: "IDR",
      maximumFractionDigits: 0,
    }).format(price);

  const totalItems = cart.reduce(
    (total, item) => total + item.quantity,
    0
  );

  const subtotal = cart.reduce(
    (total, item) => total + item.price * item.quantity,
    0
  );

  const handleChange = (e) => {
    setForm({
      ...form,
      [e.target.name]: e.target.value,
    });
  };

  const handleSubmit = (e) => {
    e.preventDefault();

    if (cart.length === 0) return;

    setCompletedOrder({
      ...form,
      items: cart.map((item) => ({ ...item })),
      totalItems,
      subtotal,
      orderNumber: `KIA-${Date.now().toString().slice(-8)}`,
    });

    window.scrollTo({ top: 0, behavior: "smooth" });
  };

  // KONFIRMASI PESANAN
  if (completedOrder) {
    return (
      <div className="mx-auto max-w-2xl py-10">
        <div className="rounded-3xl border border-pink-100 bg-white p-6 text-center shadow-sm sm:p-10">
          <div className="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-green-50 text-4xl text-green-600">
            ✓
          </div>

          <p className="mt-5 text-sm font-semibold uppercase tracking-widest text-[#A84D70]">
            KiaBeauty
          </p>

          <h1 className="mt-2 text-3xl font-bold text-[#2B2024]">
            Pesanan Berhasil Dibuat!
          </h1>

          <p className="mt-3 text-sm leading-6 text-gray-500">
            Terima kasih telah berbelanja di KiaBeauty.
            Pesanan demo kamu berhasil dicatat di halaman ini.
          </p>

          <div className="mt-6 rounded-2xl bg-[#FFF5F8] p-5 text-left">
            <div className="flex justify-between gap-3">
              <span className="text-sm text-gray-500">
                Nomor Pesanan
              </span>
              <span className="font-semibold text-[#A84D70]">
                {completedOrder.orderNumber}
              </span>
            </div>

            <div className="mt-4 border-t border-pink-100 pt-4">
              <p className="font-semibold text-[#2B2024]">
                Detail Pembeli
              </p>
              <p className="mt-2 text-sm text-gray-600">
                {completedOrder.name}
              </p>
              <p className="text-sm text-gray-600">
                {completedOrder.phone}
              </p>
              <p className="mt-1 text-sm text-gray-600">
                {completedOrder.address}
              </p>
              <p className="mt-2 text-sm text-gray-600">
                Pembayaran: {completedOrder.payment}
              </p>
            </div>

            <div className="mt-4 border-t border-pink-100 pt-4">
              <p className="mb-3 font-semibold text-[#2B2024]">
                Rincian Produk
              </p>

              {completedOrder.items.map((item) => (
                <div
                  key={item.id}
                  className="flex justify-between gap-3 py-2 text-sm"
                >
                  <span className="flex-1 text-gray-600">
                    {item.name} × {item.quantity}
                  </span>
                  <span className="font-medium text-[#2B2024]">
                    {formatPrice(item.price * item.quantity)}
                  </span>
                </div>
              ))}

              <div className="mt-3 flex justify-between border-t border-pink-100 pt-4">
                <span className="font-bold">Total Pembayaran</span>
                <span className="font-bold text-[#A84D70]">
                  {formatPrice(completedOrder.subtotal)}
                </span>
              </div>
            </div>
          </div>

          <p className="mt-4 text-xs text-gray-400">
            Ini adalah simulasi pemesanan untuk prototype tugas.
            Pembayaran dan pengiriman belum diproses secara nyata.
          </p>

          <Link
            to="/"
            className="mt-6 inline-flex w-full items-center justify-center rounded-xl bg-[#A84D70] px-6 py-3 font-semibold text-white transition hover:bg-[#8F3F60]"
          >
            Kembali ke Beranda
          </Link>
        </div>
      </div>
    );
  }

  // KERANJANG KOSONG
  if (cart.length === 0) {
    return (
      <div className="mx-auto max-w-xl py-16 text-center">
        <div className="text-5xl">🛒</div>

        <h1 className="mt-4 text-2xl font-bold text-[#2B2024]">
          Keranjangmu Masih Kosong
        </h1>

        <p className="mt-2 text-sm text-gray-500">
          Tambahkan produk terlebih dahulu sebelum checkout.
        </p>

        <Link
          to="/produk"
          className="mt-6 inline-flex rounded-xl bg-[#A84D70] px-6 py-3 font-semibold text-white hover:bg-[#8F3F60]"
        >
          Mulai Belanja
        </Link>
      </div>
    );
  }

  return (
    <div className="mx-auto max-w-5xl">
      {/* HEADER */}
      <div className="mb-8">
        <p className="text-sm font-semibold uppercase tracking-widest text-[#A84D70]">
          KiaBeauty
        </p>

        <h1 className="mt-1 text-3xl font-bold text-[#2B2024]">
          Checkout
        </h1>

        <p className="mt-2 text-sm text-gray-500">
          Lengkapi informasi pengiriman untuk menyelesaikan pesananmu.
        </p>
      </div>

      <form
        onSubmit={handleSubmit}
        className="grid items-start gap-6 lg:grid-cols-3"
      >
        {/* FORM PENGIRIMAN */}
        <section className="rounded-2xl border border-pink-100 bg-white p-6 shadow-sm lg:col-span-2">
          <h2 className="text-xl font-bold text-[#2B2024]">
            Informasi Pengiriman
          </h2>

          <div className="mt-6 space-y-5">
            <div>
              <label
                htmlFor="name"
                className="mb-2 block text-sm font-semibold text-gray-700"
              >
                Nama Lengkap
              </label>

              <input
                id="name"
                name="name"
                value={form.name}
                onChange={handleChange}
                type="text"
                autoComplete="name"
                placeholder="Masukkan nama lengkap"
                required
                className="w-full rounded-xl border border-gray-200 px-4 py-3 text-sm outline-none focus:border-[#D98BA7] focus:ring-2 focus:ring-[#F8D7E2]"
              />
            </div>

            <div>
              <label
                htmlFor="phone"
                className="mb-2 block text-sm font-semibold text-gray-700"
              >
                Nomor Telepon
              </label>

              <input
                id="phone"
                name="phone"
                value={form.phone}
                onChange={handleChange}
                type="tel"
                autoComplete="tel"
                placeholder="08xxxxxxxxxx"
                pattern="[0-9+\-\s]{8,20}"
                title="Masukkan nomor telepon yang valid."
                required
                className="w-full rounded-xl border border-gray-200 px-4 py-3 text-sm outline-none focus:border-[#D98BA7] focus:ring-2 focus:ring-[#F8D7E2]"
              />
            </div>

            <div>
              <label
                htmlFor="address"
                className="mb-2 block text-sm font-semibold text-gray-700"
              >
                Alamat Pengiriman
              </label>

              <textarea
                id="address"
                name="address"
                value={form.address}
                onChange={handleChange}
                rows={4}
                autoComplete="street-address"
                placeholder="Nama jalan, nomor rumah, desa, kecamatan, dan kota"
                required
                className="w-full rounded-xl border border-gray-200 px-4 py-3 text-sm outline-none focus:border-[#D98BA7] focus:ring-2 focus:ring-[#F8D7E2]"
              />
            </div>

            <div>
              <label
                htmlFor="payment"
                className="mb-2 block text-sm font-semibold text-gray-700"
              >
                Metode Pembayaran
              </label>

              <select
                id="payment"
                name="payment"
                value={form.payment}
                onChange={handleChange}
                className="w-full rounded-xl border border-gray-200 bg-white px-4 py-3 text-sm outline-none focus:border-[#D98BA7]"
              >
                <option>Transfer Bank</option>
                <option>Virtual Account</option>
                <option>QRIS</option>
                <option>COD</option>
              </select>
            </div>
          </div>

          <button
            type="submit"
            className="mt-6 w-full rounded-xl bg-[#A84D70] px-6 py-3 font-semibold text-white shadow-md transition hover:bg-[#8F3F60]"
          >
            Buat Pesanan · {formatPrice(subtotal)}
          </button>

          <p className="mt-3 text-center text-xs text-gray-400">
            Pemesanan ini merupakan simulasi. Tidak ada pembayaran nyata.
          </p>
        </section>

        {/* RINGKASAN */}
        <aside className="h-fit rounded-2xl border border-pink-100 bg-white p-6 shadow-sm">
          <h2 className="text-xl font-bold text-[#2B2024]">
            Ringkasan Pesanan
          </h2>

          <p className="mt-2 text-sm text-gray-500">
            {totalItems} barang dalam keranjang
          </p>

          <div className="mt-5 max-h-72 space-y-4 overflow-y-auto">
            {cart.map((item) => (
              <div key={item.id} className="flex gap-3">
                <img
                  src={item.img}
                  alt={item.name}
                  className="h-16 w-16 rounded-xl bg-[#FFF5F8] object-contain"
                />

                <div className="min-w-0 flex-1">
                  <p className="line-clamp-2 text-sm font-medium text-[#2B2024]">
                    {item.name}
                  </p>

                  <p className="mt-1 text-xs text-gray-500">
                    {item.quantity} × {formatPrice(item.price)}
                  </p>

                  <p className="mt-1 text-sm font-semibold text-[#A84D70]">
                    {formatPrice(item.quantity * item.price)}
                  </p>
                </div>
              </div>
            ))}
          </div>

          <div className="mt-5 space-y-3 border-t border-gray-100 pt-4 text-sm">
            <div className="flex justify-between gap-3">
              <span className="text-gray-500">Subtotal Produk</span>
              <span className="font-medium">{formatPrice(subtotal)}</span>
            </div>

            <div className="flex justify-between gap-3">
              <span className="text-gray-500">Pengiriman</span>
              <span className="font-medium text-green-600">GRATIS</span>
            </div>

            <div className="flex justify-between gap-3 border-t border-gray-100 pt-4">
              <span className="font-bold">Total</span>
              <span className="text-lg font-bold text-[#A84D70]">
                {formatPrice(subtotal)}
              </span>
            </div>
          </div>

          <Link
            to="/cart"
            className="mt-6 block text-center text-sm font-semibold text-[#A84D70] hover:underline"
          >
            ← Kembali ke Keranjang
          </Link>
        </aside>
      </form>
    </div>
  );
}
