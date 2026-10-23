import React, { useState } from "react";
import { useNavigate } from "react-router-dom";
import { useAuth } from "../utils/AuthContext";

export default function LogoutPage() {
  const [isLoggingOut, setIsLoggingOut] = useState(false);
  const [error, setError] = useState("");
  const { logout } = useAuth();
  const navigate = useNavigate();

  const handleLogout = async () => {
    setIsLoggingOut(true);
    setError("");

    try {
      await logout();
      navigate("/login", { replace: true });
    } catch (err) {
      console.error("Failed to log out", err);
      setError("Logout gagal. Silakan coba lagi.");
      setIsLoggingOut(false);
    }
  };

  const handleCancel = () => {
    navigate(-1);
  };

  return (
    <main className="relative flex min-h-screen items-center justify-center overflow-hidden bg-[#FFFAFC] px-4 py-10">
      <div className="pointer-events-none absolute -right-20 -top-20 h-64 w-64 rounded-full bg-[#FCE8EF] opacity-70" />
      <div className="pointer-events-none absolute -bottom-24 -left-16 h-72 w-72 rounded-full bg-[#FCE8EF] opacity-60" />

      <section className="relative w-full max-w-md overflow-hidden rounded-3xl border border-[#F0E4E9] bg-white shadow-xl shadow-[#A84D70]/10">
        <div className="h-2 bg-[#A84D70]" />

        <div className="px-6 py-9 text-center sm:px-10">
          <div className="mx-auto mb-5 flex h-16 w-16 items-center justify-center rounded-2xl bg-[#FCE8EF] text-3xl text-[#A84D70]">
            ♡
          </div>

          <LinkBrand />

          <h1 className="mt-7 text-3xl font-bold text-[#34252C]">
            Keluar dari Akun?
          </h1>

          <p className="mt-3 text-sm leading-6 text-[#82747B]">
            Apakah kamu yakin ingin keluar dari akun KiaBeauty?
          </p>

          {error && (
            <div
              role="alert"
              className="mt-5 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700"
            >
              {error}
            </div>
          )}

          <div className="mt-7 space-y-3">
            <button
              type="button"
              onClick={handleLogout}
              disabled={isLoggingOut}
              className="flex w-full items-center justify-center rounded-xl bg-[#A84D70] px-4 py-3.5 text-sm font-semibold text-white shadow-md shadow-[#A84D70]/20 transition hover:bg-[#8F3E5E] disabled:cursor-not-allowed disabled:opacity-60"
            >
              {isLoggingOut ? "Sedang keluar..." : "Ya, Keluar"}
            </button>

            <button
              type="button"
              onClick={handleCancel}
              disabled={isLoggingOut}
              className="w-full rounded-xl border border-[#F0E4E9] bg-white px-4 py-3.5 text-sm font-semibold text-[#A84D70] transition hover:bg-[#FFFAFC] disabled:cursor-not-allowed disabled:opacity-60"
            >
              Batal, Kembali
            </button>
          </div>

          <p className="mt-7 text-xs tracking-widest text-[#82747B]">
            BEAUTY, MADE SIMPLE ♡
          </p>
        </div>
      </section>
    </main>
  );
}

function LinkBrand() {
  return (
    <div>
      <div className="text-2xl font-bold tracking-tight text-[#A84D70]">
        KiaBeauty
      </div>
      <div className="mt-1 text-[10px] tracking-[0.22em] text-[#82747B]">
        BEAUTY, MADE SIMPLE
      </div>
    </div>
  );
}