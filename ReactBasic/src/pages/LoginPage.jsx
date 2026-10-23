import React, { useState, useEffect } from "react";
import { Link, useNavigate } from "react-router-dom";
import { useAuth } from "../utils/AuthContext";

const EyeIcon = ({ onClick, isVisible }) => (
  <button
    type="button"
    onClick={onClick}
    aria-label={isVisible ? "Sembunyikan password" : "Tampilkan password"}
    className="absolute inset-y-0 right-0 flex items-center px-4 text-[#A84D70] hover:text-[#8F3E5E]"
  >
    {isVisible ? (
      <svg xmlns="http://www.w3.org/2000/svg" className="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
      </svg>
    ) : (
      <svg xmlns="http://www.w3.org/2000/svg" className="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7 .946-3.02 3.498-5.36 6.54-6.32m7.89 7.89a3 3 0 01-4.24-4.24" />
        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M3 3l18 18" />
      </svg>
    )}
  </button>
);

export default function LoginPage() {
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const [showPassword, setShowPassword] = useState(false);
  const [error, setError] = useState(null);
  const [isSubmitting, setIsSubmitting] = useState(false);

  const { login, user } = useAuth();
  const navigate = useNavigate();

  useEffect(() => {
    if (user) {
      navigate(user.role === "admin" ? "/admin/dashboard" : "/", {
        replace: true,
      });
    }
  }, [user, navigate]);

  const handleSubmit = async (e) => {
    e.preventDefault();
    setError(null);
    setIsSubmitting(true);

    try {
      const result = await login(email, password);

      if (result && result.success === false) {
        setError(result.message || "Email atau password tidak sesuai.");
      }
    } catch (err) {
      console.error(err);
      setError("Terjadi kesalahan. Silakan coba lagi.");
    } finally {
      setIsSubmitting(false);
    }
  };

  return (
    <main className="flex min-h-screen items-center justify-center bg-[#FFFAFC] px-4 py-10">
      <div className="pointer-events-none fixed -right-24 -top-24 h-72 w-72 rounded-full bg-[#FCE8EF] opacity-70" />
      <div className="pointer-events-none fixed -bottom-28 -left-20 h-80 w-80 rounded-full bg-[#FCE8EF] opacity-60" />

      <section className="relative w-full max-w-md overflow-hidden rounded-3xl border border-[#F0E4E9] bg-white shadow-xl shadow-[#A84D70]/10">
        <div className="h-2 bg-[#A84D70]" />

        <div className="px-6 py-9 sm:px-10 sm:py-10">
          <Link to="/" className="mb-8 block text-center">
            <span className="text-3xl font-bold tracking-tight text-[#A84D70]">
              KiaBeauty
            </span>
            <span className="mt-1 block text-[10px] tracking-[0.22em] text-[#82747B]">
              BEAUTY, MADE SIMPLE
            </span>
          </Link>

          <div className="mb-7 text-center">
            <div className="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-[#FCE8EF] text-2xl text-[#A84D70]">
              ♡
            </div>
            <h1 className="text-3xl font-bold text-[#34252C]">
              Selamat Datang!
            </h1>
            <p className="mt-2 text-sm leading-6 text-[#82747B]">
              Masuk ke akunmu dan temukan produk kecantikan favoritmu.
            </p>
          </div>

          <form className="space-y-5" onSubmit={handleSubmit}>
            {error && (
              <div
                role="alert"
                className="rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700"
              >
                {error}
              </div>
            )}

            <div>
              <label htmlFor="email" className="mb-2 block text-sm font-semibold text-[#34252C]">
                Email
              </label>
              <input
                id="email"
                name="email"
                type="email"
                autoComplete="email"
                required
                placeholder="nama@email.com"
                value={email}
                onChange={(e) => setEmail(e.target.value)}
                className="w-full rounded-xl border border-[#F0E4E9] bg-[#FFFAFC] px-4 py-3 text-sm text-[#34252C] outline-none transition placeholder:text-[#B4A5AC] focus:border-[#A84D70] focus:ring-2 focus:ring-[#A84D70]/15"
              />
            </div>

            <div>
              <label htmlFor="password" className="mb-2 block text-sm font-semibold text-[#34252C]">
                Password
              </label>
              <div className="relative">
                <input
                  id="password"
                  name="password"
                  type={showPassword ? "text" : "password"}
                  autoComplete="current-password"
                  required
                  placeholder="Masukkan password"
                  value={password}
                  onChange={(e) => setPassword(e.target.value)}
                  className="w-full rounded-xl border border-[#F0E4E9] bg-[#FFFAFC] px-4 py-3 pr-12 text-sm text-[#34252C] outline-none transition placeholder:text-[#B4A5AC] focus:border-[#A84D70] focus:ring-2 focus:ring-[#A84D70]/15"
                />
                <EyeIcon
                  isVisible={showPassword}
                  onClick={() => setShowPassword(!showPassword)}
                />
              </div>
            </div>

            <button
              type="submit"
              disabled={isSubmitting}
              className="flex w-full items-center justify-center rounded-xl bg-[#A84D70] px-4 py-3.5 text-sm font-semibold text-white shadow-md shadow-[#A84D70]/20 transition hover:bg-[#8F3E5E] disabled:cursor-not-allowed disabled:opacity-60"
            >
              {isSubmitting ? "Sedang masuk..." : "Masuk ke Akun"}
            </button>
          </form>

          <div className="mt-7 border-t border-[#F0E4E9] pt-5 text-center">
            <Link to="/" className="text-sm font-medium text-[#A84D70] transition hover:text-[#8F3E5E]">
              ← Kembali ke KiaBeauty
            </Link>
          </div>
        </div>
      </section>
    </main>
  );
}