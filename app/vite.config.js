import { defineConfig } from "vite";
import path from "path";

export default defineConfig({
  root: "resources",
  build: {
    outDir: "../public/vite",
    emptyOutDir: true,
    rollupOptions: {
      input: {
        main: path.resolve(__dirname, "resources/js/app.js"),
        style: path.resolve(__dirname, "resources/scss/theme.scss"),
      },
      output: {
        entryFileNames: "app.js", // ⬅️ Output JS utama
        chunkFileNames: "chunks/[name].js", // ⬅️ Untuk chunk
        assetFileNames: ({ name }) => {
          if (name && name.endsWith(".css")) {
            return "style.css"; // ⬅️ Output CSS
          }
          return "assets/[name]"; // ⬅️ File lain seperti font/image
        },
      },
    },
  },
});
