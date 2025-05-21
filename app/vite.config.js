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
    },
  },
});
