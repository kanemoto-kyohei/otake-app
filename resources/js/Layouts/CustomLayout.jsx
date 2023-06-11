import { Link } from '@inertiajs/react';

export default function CustomLayout({ children }) {
  return (
    <div className="min-h-screen flex flex-col items-center justify-center bg-gray-100">
      <div className="w-96 h-96 mx-auto p-8 bg-white text-black rounded-lg shadow-lg">
        {children}
      </div>
    </div>
  );
}
