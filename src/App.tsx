import { BrowserRouter, Routes, Route } from "react-router-dom";
import { AdminLayout } from "./layouts/AdminLayout";
import { DashboardPage } from "./pages/DashboardPage";
import { ProductPage } from "./pages/ProductPage";
import { SkemaHargaPage } from "./pages/SkemaHargaPage";
import { PesananPage } from "./pages/PesananPage";
import { CustomerPage } from "./pages/CustomerPage";
import { MetodePembayaranPage } from "./pages/MetodePembayaranPage";

import Home from "./pages/Home";
import { LoginPage } from "./pages/LoginPage";
import { RegisterPage } from "./pages/RegisterPage";

function App() {
  return (
    <BrowserRouter>
      <Routes>
        <Route path="/" element={<Home />} />
        <Route path="/login" element={<LoginPage />} />
        <Route path="/register" element={<RegisterPage />} />
        
        <Route path="/admin" element={<AdminLayout />}>
          <Route index element={<DashboardPage />} />
          <Route path="product" element={<ProductPage />} />
          <Route path="skema-harga" element={<SkemaHargaPage />} />
          <Route path="pesanan" element={<PesananPage />} />
          <Route path="customer" element={<CustomerPage />} />
          <Route path="metode-pembayaran" element={<MetodePembayaranPage />} />
        </Route>
      </Routes>
    </BrowserRouter>
  );
}

export default App;
