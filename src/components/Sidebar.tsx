import { NavLink } from "react-router-dom";
import { 
  LayoutDashboard, 
  Package, 
  Tags, 
  ShoppingCart, 
  Users, 
  CreditCard 
} from "lucide-react";
import { cn } from "../lib/utils";

const menuItems = [
  { name: "Dashboard Admin", icon: LayoutDashboard, path: "/admin" },
  { name: "Product", icon: Package, path: "/admin/product" },
  { name: "Skema dan Harga", icon: Tags, path: "/admin/skema-harga" },
  { name: "Pesanan", icon: ShoppingCart, path: "/admin/pesanan" },
  { name: "Customer", icon: Users, path: "/admin/customer" },
  { name: "Metode Pembayaran", icon: CreditCard, path: "/admin/metode-pembayaran" },
];

export function Sidebar() {
  return (
    <aside className="w-64 bg-slate-900 text-white min-h-screen flex flex-col shadow-xl">
      <div className="h-16 flex items-center px-6 border-b border-slate-800">
        <span className="text-xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-emerald-400 to-green-400">
          AdminPanel
        </span>
      </div>
      <nav className="flex-1 px-4 py-6 space-y-1">
        {menuItems.map((item) => (
          <NavLink
            key={item.path}
            to={item.path}
            end={item.path === "/admin"}
            className={({ isActive }) =>
              cn(
                "flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 group",
                isActive
                  ? "bg-emerald-600/10 text-emerald-400"
                  : "text-slate-400 hover:bg-slate-800 hover:text-white"
              )
            }
          >
            {({ isActive }) => (
              <>
                <item.icon
                  className={cn(
                    "w-5 h-5 transition-transform duration-200",
                    isActive ? "scale-110" : "group-hover:scale-110"
                  )}
                />
                <span className="font-medium">{item.name}</span>
                {isActive && (
                  <div className="ml-auto w-1.5 h-1.5 rounded-full bg-emerald-400" />
                )}
              </>
            )}
          </NavLink>
        ))}
      </nav>
      <div className="p-4 border-t border-slate-800">
        <div className="flex items-center gap-3 px-4 py-3 rounded-xl bg-slate-800/50">
          <div className="w-8 h-8 rounded-full bg-emerald-500 flex items-center justify-center text-white font-bold text-sm">
            A
          </div>
          <div className="flex flex-col">
            <span className="text-sm font-medium text-white">Admin User</span>
            <span className="text-xs text-slate-400">admin@microcell.com</span>
          </div>
        </div>
      </div>
    </aside>
  );
}
