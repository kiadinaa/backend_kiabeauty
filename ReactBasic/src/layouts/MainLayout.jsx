import { Outlet } from "react-router-dom";
import Navbar from "../components/Navbar";

export default function MainLayout() {
  return (
    <div className="flex min-h-screen flex-col bg-white">

      {/* Navbar */}
      <Navbar />

      {/* Main Content */}
      <main className="flex-1 px-4 py-6 md:px-6 lg:px-8">
        <Outlet />
      </main>

      {/* Footer */}
      <footer className="border-t border-pink-100 bg-[#2B2024] px-6 py-6 text-center text-white">
        <p className="text-sm">
          © 2026 KiaBeauty. All rights reserved.
        </p>

        <p className="mt-1 text-xs tracking-widest text-pink-200">
          BEAUTY, MADE SIMPLE
        </p>
      </footer>

    </div>
  );
}