import { Outlet } from "react-router-dom";
import { Sidebar } from "../components/Sidebar";

export function AdminLayout() {
  return (
    <div className="flex min-h-screen bg-slate-50 font-sans text-slate-900">
      <Sidebar />
      <main className="flex-1 flex flex-col h-screen overflow-hidden">
        {/* Top Header Placeholder (Optional, can add user menu/notifications here) */}
        <header className="h-16 bg-white border-b border-slate-200 flex items-center justify-end px-8 shadow-sm shrink-0">
          <div className="text-sm font-medium text-slate-500">
            {new Date().toLocaleDateString('id-ID', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' })}
          </div>
        </header>
        
        {/* Main Content Area */}
        <div className="flex-1 overflow-auto p-8">
          <Outlet />
        </div>
      </main>
    </div>
  );
}
