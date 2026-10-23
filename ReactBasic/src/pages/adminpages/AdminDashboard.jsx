import { Link } from "react-router-dom";
import { confirmDeleteToast } from "../../components/confirmDeleteToast";
import ProductSearchBar from "../../components/productSearchBar";
import { useProducts } from "../../utils/ProductContext";
import Pagination from "../../components/Pagination";

//nama komponen
export default function AdminDashboard() {
  const { products, isLoading, isError, deleteProduct } = useProducts();
  if (isLoading) return <p>Loading...</p>;
  if (isError) return <p>Error loading products.</p>;
  const handleDelete = async (id) => {
    const confirmDelete = window.confirm(
      "Apakah kamu yakin ingin menghapus produk ini?"
    );
    if (!confirmDelete) return;

    try {
      await deleteProduct.mutateAsync(id);
    } catch (error) {
      toast.error("Terjadi kesalahan saat menghapus produk.");
    }
  };
  const handleSearch = ({ keyword, category }) => {

  };

  return (
    <div className="p-4 bg-white rounded shadow">
      <h1 className="text-xl font-bold mb-4">Manajemen Produk</h1>
      <div className="mb-4">
        <Link
          to="/admin/add-product"
          className="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"
        >
          Tambah Produk
        </Link>
      </div>
      <table className="table-auto w-full border">
        <thead>
          <tr className="bg-gray-100 text-left">
            <th className="p-2 border">#</th>
            <th>Image</th>
            <th className="p-2 border">Nama</th>
            <th className="p-2 border">Harga</th>
            <th className="p-2 border">Stok</th>
            <th className="p-2 border">Aksi</th>
          </tr>
        </thead>
        <tbody>
          {products?.map((p, index) => (
            <tr key={p.id}>
              <td className="p-2 border">{index + 1}</td>
              <td className="p-2 border"><img src={p.img_url} alt={p.name} className="w-16 h-16 object-cover" /></td>
              <td className="p-2 border">{p.name} <br />  
              <small className="text-gray-500">#{p.category?.name}</small></td>
              <td className="p-2 border">Rp. {p.price}</td>
              <td className="p-2 border">{p.stock}</td>
              <td className="p-2 border space-x-2">
                <Link to={`/admin/edit-product/${p.id}`} className="text-blue-600 hover:underline">Edit</Link>
                <button
                  onClick={() => handleDelete(p.id)}
                  className="cursor-pointer text-red-600 hover:underline"
                >
                  Hapus
                </button>
              </td>
            </tr>
          ))}
        </tbody>
      </table>
        </div>
  );
}
