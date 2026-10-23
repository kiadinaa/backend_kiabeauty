import React from "react";
import ReactDOM from "react-dom/client";
import { BrowserRouter } from "react-router-dom";
import App from "./App";
import "./index.css";

import { CartProvider } from "./utils/CartContext";
import {
  QueryClient,
  QueryClientProvider,
} from "@tanstack/react-query";
import { ProductProvider } from "./utils/ProductContext";
import { Toaster } from "react-hot-toast";
import { AuthProvider } from "./utils/AuthContext";

const queryClient = new QueryClient();

ReactDOM.createRoot(document.getElementById("root")).render(
  <React.StrictMode>
    <BrowserRouter basename="/KiaBeauty">
      <QueryClientProvider client={queryClient}>
        <AuthProvider>
          <ProductProvider>
            <CartProvider>
              <App />
              <Toaster
                position="top-right"
                reverseOrder={false}
              />
            </CartProvider>
          </ProductProvider>
        </AuthProvider>
      </QueryClientProvider>
    </BrowserRouter>
  </React.StrictMode>
);