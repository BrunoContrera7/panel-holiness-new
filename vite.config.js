import { defineConfig } from 'vite'
import react from '@vitejs/plugin-react-swc'
import tailwindcss from '@tailwindcss/vite'

// https://vite.dev/config/
export default defineConfig({
  plugins: [react(), tailwindcss()],
  server: {
    host: '0.0.0.0',   // acepta conexiones externas
    port: 5173,
    allowedHosts: ['.ngrok-free.app'], // acepta cualquier subdominio de ngrok
  },
})
