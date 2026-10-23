
import { useEffect, useState } from "react";
import { useSearchParams } from "react-router-dom";
import ProductCard from "../../components/ProductCard";
import { products } from "../../utils/data";

export default function Products() {
  const [searchParams, setSearchParams] = useSearchParams();

  const [search, setSearch] = useState(searchParams.get("q") || "");
  const [category, setCategory] = useState(
    searchParams.get("category") || "All"
  );
  const [sort, setSort] = useState("default");

  // Sinkronkan filter dengan URL dari navbar atau Beranda.
  useEffect(() => {
    setSearch(searchParams.get("q") || "");

    const urlCategory = searchParams.get("category");
    setCategory(
      ["Makeup", "Skincare"].includes(urlCategory)
        ? urlCategory
        : "All"
    );
  }, [searchParams]);

  const filteredProducts = products
    .filter((product) => {
      const keyword = search.trim().toLowerCase();

      const matchSearch =
        product.name.toLowerCase().includes(keyword) ||
        product.brand.toLowerCase().includes(keyword);

      const matchCategory =
        category === "All" ||
        product.category_name === category;

      return matchSearch && matchCategory;
    })
    .sort((a, b) => {
      if (sort === "low") return a.price - b.price;
      if (sort === "high") return b.price - a.price;
      if (sort === "rating") return b.rating - a.rating;
      return 0;
    });

  const resetFilters = () => {
    setSearch("");
    setCategory("All");
    setSort("default");
    setSearchParams({});
  };

  return (
    <div className="space-y-7">
      {/* Header */}
      <section>
        <p className="text-xs font-semibold uppercase tracking-widest text-[#A84D70]">
          KiaBeauty Marketplace
        </p>

        <h1 className="mt-2 text-3xl font-bold text-[#2B2024]">
          Kategori Produk
        </h1>

        <p className="mt-2 text-sm text-gray-500">
          Cari dan temukan makeup serta skincare yang sesuai kebutuhanmu.
        </p>
      </section>

      {/* Filter Katalog */}
      <section className="rounded-2xl border border-pink-100 bg-[#FFF8FA] p-4">
        <div className="grid gap-3 md:grid-cols-2">
          <select
            value={category}
            onChange={(e) => setCategory(e.target.value)}
            className="w-full rounded-xl border border-pink-100 bg-white px-4 py-3 text-sm outline-none focus:border-[#A84D70]"
          >
            <option value="All">Semua Kategori</option>
            <option value="Makeup">Makeup</option>
            <option value="Skincare">Skincare</option>
          </select>

          <select
            value={sort}
            onChange={(e) => setSort(e.target.value)}
            className="w-full rounded-xl border border-pink-100 bg-white px-4 py-3 text-sm outline-none focus:border-[#A84D70]"
          >
            <option value="default">Urutan Default</option>
            <option value="low">Harga Terendah</option>
            <option value="high">Harga Tertinggi</option>
            <option value="rating">Rating Tertinggi</option>
          </select>
        </div>
      </section>

      {/* Jumlah Hasil */}
      <section className="flex flex-wrap items-center justify-between gap-3">
        <p className="text-sm text-gray-500">
          Menampilkan{" "}
          <span className="font-semibold text-[#A84D70]">
            {filteredProducts.length}
          </span>{" "}
          produk
          {search && (
            <>
              {" "}untuk pencarian{" "}
              <span className="font-semibold text-[#2B2024]">
                "{search}"
              </span>
            </>
          )}
        </p>

        {(search || category !== "All" || sort !== "default") && (
          <button
            onClick={resetFilters}
            className="text-sm font-semibold text-[#A84D70] hover:underline"
          >
            Reset Filter
          </button>
        )}
      </section>

      {/* Daftar Produk */}
      {filteredProducts.length > 0 ? (
        <section className="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
          {filteredProducts.map((product) => (
            <ProductCard
              key={product.id}
              p={product}
            />
          ))}
        </section>
      ) : (
        <section className="rounded-2xl border border-dashed border-pink-200 bg-[#FFF8FA] px-5 py-16 text-center">
          <div className="text-4xl text-[#A84D70]">⌕</div>

          <h2 className="mt-4 text-lg font-bold text-[#2B2024]">
            Produk tidak ditemukan
          </h2>

          <p className="mt-2 text-sm text-gray-500">
            Coba kata kunci atau kategori lainnya.
          </p>

          <button
            onClick={resetFilters}
            className="mt-5 rounded-xl bg-[#A84D70] px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-[#8F3F60]"
          >
            Tampilkan Semua Produk
          </button>
        </section>
      )}
    </div>
  );
}
